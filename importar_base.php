<?php
  $page_title = 'Excel';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
  
?>


<?php



ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once __DIR__.'/excel/simplexlsx.php';


if (isset($_POST["enviar"])){
	$usuario=$_POST['id_user'];
	if ( $xlsx = SimpleXLSX::parse( $_FILES['file']['tmp_name'] ) ) {

		$dim = $xlsx->dimension();
		$cols = $dim[0];

		 
	
/*	$db_host="localhost";
	$db_name="recoleccion";
	$db_user="root";
	$db_pass="";
	
	*/
		
			$db_host="localhost";
	$db_name="recoleccion";
	$db_user="root";
	$db_pass="";
		
		
$date    =make_date();


    try {
       $conn = new PDO( "mysql:host=$db_host;dbname=$db_name", "$db_user", "$db_pass");
       $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }

		
		    
		
		
		$stmt = $conn->prepare( "INSERT INTO correos_clientes (cliente, asesor, ventas, contacto, correo) VALUES (?, ?, ?, ?, ?)");
	
    $stmt->bindParam( 1, $cliente);
    $stmt->bindParam( 2, $asesor);
    $stmt->bindParam( 3, $ventas);
	$stmt->bindParam( 4, $contacto);   
    $stmt->bindParam( 5, $correo);
   
foreach ($xlsx->rows() as $fields)
    {
        $cliente = $fields[0];
        $asesor = $fields[1];
        $ventas = $fields[2];
        $contacto = $fields[3];
        $correo = $fields[4];
		
        $stmt->execute();
    }
		
		
}
	 else {
		echo SimpleXLSX::parseError();
	}
}




?>
<?php include_once('layouts/header.php'); ?>
 <div class="row">
     <div class="col-md-13">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-13">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Importar Excel 
                   
	</strong>
        </div>
        <div class="panel-body">
			
			
			
			<div id="panel">
			
			
			
<form name="importa" method="post" action="importar_base.php" enctype="multipart/form-data" >
  
	  <div class="col-md-5">
    <div class="form-group">
      <input type="file" accept=".xls,.xlsx"   class="btn btn-primary"  placeholder="Selecciona Archivo" name="file" id="excel" >
    </div>
  </div>
   <div class="col-md-5">
   <input class="btn btn-default btn-file btn-primary" type='submit' name='enviar'  value="Subir"  />
	
<!--  <input type="hidden" value="upload" name="action" />
  <input type="hidden" value="usuarios" name="mod">
  <input type="hidden" value="masiva" name="acc">-->
	  </div>
	<input type="hidden" name="id_user" value="<?php echo $user["id"]; ?>">
	   
	  
</form>
		  
		  	<div class="col-md-2">
			<div class="input-group">
			
                  <a href="excel/plantilla_tickets.xlsx" download="Plantilla tickets" title="Descargar Plantilla" data-toggle="tooltip"><img src="uploads/excel.png" width="80px" alt="Descargar Plantilla"></a><br>
				
				</div></div>
			 
<?php include_once('layouts/footer.php'); ?>
<!-- PROCESO DE CARGA Y PROCESAMIENTO DEL EXCEL-->
