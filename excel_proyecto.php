<?php
  $page_title = 'Excel';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(6);
  
?>

<?php 
if(isset($_POST['incidencias'])){
 

 
    $p_rfc= remove_junk($db->escape($_POST['rfc']));
    $p_guia = remove_junk($db->escape($_POST['guia']));
    $p_servicio = remove_junk($db->escape($_POST['servicio']));
	$p_incidencia = remove_junk($db->escape($_POST['incidencia']));
	$p_fecha = remove_junk($db->escape($_POST['fecha']));
	$p_ejecutivo = remove_junk($db->escape($_POST['ejecutivo']));
	$p_paqueteria = remove_junk($db->escape($_POST['paqueteria']));
	
	
	 
	 
     $date    = make_date();
	   //INSERT INTO excel (razon_social, guia, fecha_envio, servicio, incidencia, asesor, activo)  VALUES 
     $query  = "INSERT INTO excel (";
     $query .=" razon_social, guia, fecha_envio, servicio, paqueteria, incidencia, asesor, activo, fecha_solucion, estatus";
     $query .=") VALUES (";
     $query .="'{$p_rfc}','{$p_guia}','{$p_fecha}','{$p_servicio}','{$p_paqueteria}','{$p_incidencia}','{$p_ejecutivo}','1','NULL','0'";
     $query .=")";
	   
	   if($db->query($query)){
       
	  $session->msg('s',"Incidencia Agregada Correctamente!!! :-)   ");
       redirect('excel.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Ingresar La Incidencia Intenta Otra Vez :(');
       redirect('excel.php', false);
	   }

   

 }
 
 

?>
<?php


//$conn = mysqli_connect("localhost","root","","recoleccion");   //PARA TEST
$conn = mysqli_connect("localhost","envipaq_inven","3nvip4q2018","envipaq_recoleccion");

require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');

if (isset($_POST["enviar"]))
{
    
    
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                $razon_social = "";
                if(isset($Row[0])) {
                    $razon_social = mysqli_real_escape_string($conn,$Row[0]);
                }
                
                $guia = "";
                if(isset($Row[1])) {
                    $guia = mysqli_real_escape_string($conn,$Row[1]);
                }
				
				$fecha_envio = "";
                if(isset($Row[2])) {
                    $fecha_envio = mysqli_real_escape_string($conn,$Row[2]);
                }
				
				$servicio = "";
                if(isset($Row[3])) {
                    $servicio = mysqli_real_escape_string($conn,$Row[3]);
                }
				
				$paqueteria = "";
                if(isset($Row[4])) {
                    $paqueteria = mysqli_real_escape_string($conn,$Row[4]);
                }
				
				$incidencia = "";
                if(isset($Row[5])) {
                    $incidencia = mysqli_real_escape_string($conn,$Row[5]);
                }
				
				$asesor = "";
                if(isset($Row[6])) {
                    $asesor = mysqli_real_escape_string($conn,$Row[6]);
                }
				
				
				/*$activobase="1";
				$fecha_solucionbase="NULL";
				$estatusbase="0";*/
                
                if (!empty($razon_social)) {
                    $query = "insert into excel(razon_social, guia, fecha_envio, servicio, paqueteria, incidencia, asesor) values('".$razon_social."','".$guia."','".$fecha_envio."','".$servicio."','".$paqueteria."','".$incidencia."','".$asesor."')";
                  // echo $query;
					 $result = mysqli_query($conn, $query);
                
                    if (! empty($result)) {
                        $type = "success";
						echo $type;
						
						$query = "DELETE FROM excel WHERE razon_social='RAZON_SOCIAL' AND guia='guia'";
                   $result = mysqli_query($conn, $query);
						
					//$session->msg('s',' Excel Importado Correctamente :)');
       //redirect('excel.php', false);
						
                        //$message = "Excel Data Imported into the Database";
                    } else {
                        $type = "error";
                       
						//$session->msg('d',' Fallo al Importar el Archivo :(');
      // redirect('excel.php', false);
						//$message = "Problem in Importing Excel Data";
                    }
                }
             }
        
         }
  }
  else
  { 
        $type = "error";
	  
						$session->msg('d',' Tipo de Archivo No Valido :)');
       redirect('excel.php', false);
	  
        //$message = "Invalid File Type. Upload Excel File.";
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
			
			
			
<form name="importa" method="post" action="excel.php" enctype="multipart/form-data" >
  
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
</form>
		  
		  	<div class="col-md-2">
			<div class="input-group">
			
                  <a href="excel/plantilla.xlsx" download="Plantilla Incidencias" title="Descargar Plantilla" data-toggle="tooltip"><img src="uploads/excel.png" width="80px" alt="Descargar Plantilla"></a><br>
				
				</div></div>
			 <div class="row">
		  <div class="col-md-12">
		  <p><br><br><label class="btn btn-warning btn-block" id="muestra">O Puedes Agregarlos Manualmente</label>
   </p>
		  </div></div></div>
		  
		  
		  
		  
		  <div id="form2" style="display:none">
		  <div class="row">
		  <div class="col-md-2">
          <label class="btn btn-default" id="regresa">&lt;- Regresar</label>
			  </div>
			  
					 
				
			  </div><br>
			  <div class="row">
				  
				  <form action="excel.php" method="post">
                  <div class="col-md-6">
                     <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="rfc" placeholder="Razón Social (Nombre de la Empresa)" required onkeyup="mayus(this);">
               </div>
					  </div>
                  
                  
                   <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-sort-by-order"></i>
                  </span>
                  <input type="text" class="form-control" name="guia" placeholder="# de Guia" required onkeyup="mayus(this);">
               </div>
               </div>
			  
			  
			  
		  
		  
		  
		  </div>
			  <div class="row">
                  <div class="col-md-6">
                     <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-menu-right"></i>
                  </span>
                  <input type="text" class="form-control" name="servicio" placeholder="Tipo de Servicio" required onkeyup="mayus(this);">
               </div>
					  </div>
                  
                  
                   <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-list"></i>
                  </span>
                  <input type="text" class="form-control" name="incidencia" placeholder="Descripción de Incidencia" required onkeyup="mayus(this);">
               </div>
               </div></div>
			  
		  
		  
			 <div class="row">
			  <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-calendar"></i>
                  </span>
                  
                  <input type="text" class="datepicker form-control" name="fecha" autocomplete="off" required placeholder="Fecha de Recolección">
               </div></div>
				 
			  <div class="col-md-6">
                  <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-user"></i>
                      </span>
                    
                                      <select class="form-control" name="ejecutivo" >
                      <option value="0">Ejecutivo</option>
                      <option value="Elena_Ortiz">Elena Ortiz</option>
                      <option value="Yadira_Diazleal">Yadira Diazleal</option>
					<option value="David_Pimentel">David Pimentel</option>
                      
                      <option value="Daniel_Rangel">Daniel Rangel</option>
                    </select>
                  </div></div>
			  
			
			  </div>  
				  <br>
				  <div class="col-md-6">
					  <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-envelope"></i>
                      </span>
                    <select class="form-control"  name="paqueteria" >
                      <option>PAQUETERIA</option>
                      <option value="ESTAFETA">ESTAFETA</option>
                      <option value="REDPACK">REDPACK</option>
                      <option value="FEDEX">FEDEX</option>
                      <option value="DHL">DHL</option>
                      <option value="PAQUETE EXPRES">PAQUETE EXPRES</option>
                    
                    </select>
	</div></div>
				  
				 
				  <div class="col-md-6">
			  <button type="submit" name="incidencias" class="btn btn-success btn-block"><i class="glyphicon glyphicon-arrow-up"></i>     Agregar       </button>
				  </div>
			  </form>
			</div></div>
<?php include_once('layouts/footer.php'); ?>
<!-- PROCESO DE CARGA Y PROCESAMIENTO DEL EXCEL-->

