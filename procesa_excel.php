<?php
  $page_title = 'Odometro';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(4);
  
?>
<?php 
$page_title = 'Importar Excel';

require_once('includes/load.php');


?>
<?php include_once('layouts/header.php'); ?>
 
<?php 





extract($_POST);
if (isset($_POST['action'])) {
$action=$_POST['action'];
}

if (isset($action)== "upload"){
//cargamos el fichero
$archivo = $_FILES['excel']['name'];
$tipo = $_FILES['excel']['type'];
$destino = "cop_".$archivo;//Le agregamos un prefijo para identificarlo el archivo cargado
if (copy($_FILES['excel']['tmp_name'],$destino))
{
//$session->msg("d", "Archivo Cargado Con Éxito");
//    echo '<meta http-equiv="Refresh" content="0; url=procesa_excel.php">';   
	//redirect('procesa_excel.php',false);
	echo '
  <div class="alert alert-success" role="alert">
  Excel Cargado Con Exito !!!!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  
  ';

}
	else{
//$session->msg("d", "Error Al Cargar el Archivo");
  //     echo '<meta http-equiv="Refresh" content="0; url=procesa_excel.php">';   
//		redirect('procesa_excel.php',false);
echo '<div class="alert alert-danger" role="alert">
  <strong>Error Al Cargar el Archivo</strong>  Intentalo de Nuevo!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
';		
	}
if (file_exists ("cop_".$archivo)){ 
/** Llamamos las clases necesarias PHPEcel */
require_once('Classes/PHPExcel.php');
require_once('Classes/PHPExcel/Reader/Excel2007.php');					
// Cargando la hoja de excel
$objReader = new PHPExcel_Reader_Excel2007();
$objPHPExcel = $objReader->load("cop_".$archivo);
$objFecha = new PHPExcel_Shared_Date();       
// Asignamon la hoja de excel activa
$objPHPExcel->setActiveSheetIndex(0);

// Importante - conexión con la base de datos 
	/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recoleccion";
*/
/*	$usuario = "envipaq_inven";
	$password = "3nvip4q2018";
	$servidor = "localhost";
	$basededatos = "envipaq_recoleccion";
	*/
$servername = "localhost";
$username = "envipaq_inven";
$password = "3nvip4q2018";
$dbname = "envipaq_recoleccion";

	$cn = mysqli_connect($servername, $username, $password, $dbname) or die("La conexion ha fallado: " . mysqli_connect_error());
//Condicional para verificar algún error
if (mysqli_connect_errno()) {
    printf("La conexión ha fallado: %s\n", mysqli_connect_error());
    exit();
}
	
	
	
	
	
	
	
//$cn = mysql_connect ("localhost","root","") or die ("ERROR EN LA CONEXION CON LA BD");
//$db = mysql_select_db ($cn, "recoleccion") or die ("ERROR AL CONECTAR A LA BD");

// Rellenamos el arreglo con los datos  del archivo xlsx que ha sido subido

$columnas = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

//Creamos un array con todos los datos del Excel importado
for ($i=2;$i<=$filas;$i++){
						$_DATOS_EXCEL[$i]['razon_social'] = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
						$_DATOS_EXCEL[$i]['guia'] = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
						$fecha_envio=$_DATOS_EXCEL[$i]['fecha_envio']= $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
							$_DATOS_EXCEL=(string)$fecha_envio;
						
							//FORMAT_DATE_DMYSLASH    FORMAT_DATE_DDMMYYYY
		/*					->getCell('C'.$i)->getValue();
	$_DATOS_EXCEL[$i]['fecha_envio']= $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getStyle()->getNumberFormat()->getFormatCode();
	*/
	                    $_DATOS_EXCEL[$i]['servicio'] = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
	                    $_DATOS_EXCEL[$i]['incidencia'] = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
						$_DATOS_EXCEL[$i]['asesor'] = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
						$_DATOS_EXCEL[$i]['activo'] = 1;
					}		
					$errores=0;


foreach($_DATOS_EXCEL as $campo => $valor){
						$sql = "INSERT INTO excel (razon_social, guia, fecha_envio, servicio, incidencia, asesor, activo)  VALUES ('";
						foreach ($valor as $campo2 => $valor2){
							$campo2 == "activo" ? $sql.= $valor2."');" : $sql.= $valor2."','";
						}

						$result = mysqli_query($cn, $sql);
						if (!$result){ echo "Error al insertar registro ".$campo;$errores+=1;}
	
					}	
	
	$campo=$campo-1;/////////////////////////////////////////////////////////////////////////	
echo "

<div class='row'>
     <div class='col-md-12'>";
       echo display_msg($msg);
     echo "</div>
    <div class='col-md-12'>
      <div class='panel panel-default'>
        <div class='panel-heading clearfix'>
<strong>Importar Excel</strong>
        </div>
        <div class='panel-body'>
		
<hr> <div class='col-xs-12'>
    	<div class='form-group'>";
	      echo "<center><p>
		  
		  
		  
		  
		  
		  ARCHIVO IMPORTADO CON EXITO, EN TOTAL <strong>$campo</strong> REGISTROS Y <strong>$errores</strong> ERRORES.</p></center>";
echo "</div>
</div>  ";
							//Borramos el archivo que esta en el servidor con el prefijo cop_
					unlink($destino);
					
				}
					//si por algun motivo no cargo el archivo cop_ 
				else{
					
					$session->msg("d", "Primero Debes Seleccionar Un Archivo Excel !!!");
   echo '<meta http-equiv="Refresh" content="0; url=excel.php">';

;
				}
			}
		?>
<?php 
			if (isset($action)) {
$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
				}
			if (isset($filas)) {
$columnas = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
				}
			if (isset($filas)) {
$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
				}

//echo 'getHighestColumn() =  [' . $columnas . ']<br/>';
//echo 'getHighestRow() =  [' . $filas . ']<br/>';
if (isset($action)== "upload"){
echo '<table border="1" class="table">';
	echo '<thead>';
		
		echo '</thead><tr></tr><tbody> ';

$count=0;
foreach ($objPHPExcel->setActiveSheetIndex(0)->getRowIterator() as $row) {
    $count++;
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);
    echo '<tr>';
    foreach ($cellIterator as $cell) {
        if (!is_null($cell)) {
            $value = $cell->getCalculatedValue();
            echo '<td>';
            echo $value . ' ';
            echo '</td>';
        }
    }
    echo '</tr>';
}
  echo '</tbody>';
  echo '</table>';

 echo '</div>';

}

?>
<?php include_once('layouts/footer.php'); ?>