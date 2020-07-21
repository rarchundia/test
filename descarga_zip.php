<?php
  $page_title = 'Descarga Zip';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
require('libs/pclzip.lib.php');
//require ("archivos/zips/");
$id=$_GET['id'];
 
?>
<?php include_once('layouts/header.php');

$products =contactos_pdf($id);
?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-ok"></span>
        <span> Descargar ZIP</span>
		  <a href="valida_historico.php" class="btn btn-info pull-right btn-sm"> Regresar</a>
     </strong>
      
    </div>
     <div class="panel-body">
		 
		 <?php foreach ($products as  $product):
	
		 
		 
		 $filename=$product['empresa'];
		$file ='archivos/zips/'.$filename.'.zip';
		if (file_exists($file)){ 
			 unlink($file);
			 $zip=new PclZip("archivos/zips/".$filename.".zip");
		 $zip->add("archivos/".$product['ruta_acta']);
		 $zip->add("archivos/".$product['ruta_fiscal']);
		 $zip->add("archivos/".$product['ruta_cumplimiento']);
		 $zip->add("archivos/".$product['ruta_identificacion']);
		 $zip->add("archivos/".$product['ruta_comprobante']);
		 $zip->add("archivos/".$product['ruta_cuenta']);
		 $zip->add("archivos/".$product['ruta_preanalisis']);
		 $zip->add("archivos/".$product['ruta_presta_serv']);
		 $zip->add("archivos/".$product['ruta_alta_envi']);
		 $zip->add("archivos/".$product['ruta_propuesta']);
		 $zip->add("archivos/".$product['ruta_propuesta_exc']);
		 $zip->add("archivos/".$product['ruta_preanalisis_excel']);
		 $zip->add("archivos/".$product['ruta_alta_envi_excel']);
		 $zip->add("archivos/".$product['ruta_tarifario']);
		 $zip->add("archivos/".$product['ruta_tarifario_excel']);
		 
		
		 echo '<a href="archivos/zips/'.$filename.'.zip" download="'.$filename.'.zip">Descargar '.$filename.'</a>';
			
		 }else{
			
		 $zip=new PclZip("archivos/zips/".$filename.".zip");
		 $zip->add("archivos/".$product['ruta_acta']);
		 $zip->add("archivos/".$product['ruta_fiscal']);
		 $zip->add("archivos/".$product['ruta_cumplimiento']);
		 $zip->add("archivos/".$product['ruta_identificacion']);
		 $zip->add("archivos/".$product['ruta_comprobante']);
		 $zip->add("archivos/".$product['ruta_cuenta']);
		 $zip->add("archivos/".$product['ruta_preanalisis']);
		 $zip->add("archivos/".$product['ruta_presta_serv']);
		 $zip->add("archivos/".$product['ruta_alta_envi']);
		 $zip->add("archivos/".$product['ruta_propuesta']);
		 $zip->add("archivos/".$product['ruta_propuesta_exc']);
		 $zip->add("archivos/".$product['ruta_preanalisis_excel']);
		 $zip->add("archivos/".$product['ruta_alta_envi_excel']);
		 $zip->add("archivos/".$product['ruta_tarifario']);
		 $zip->add("archivos/".$product['ruta_tarifario_excel']);
		 
		
		 echo '<a href="archivos/zips/'.$filename.'.zip" download="'.$filename.'.zip">Descargar '.$filename.'</a>';
		 //echo $product['ruta_preanalisis'];
		 //echo $product['empresa'];
		 //echo $product['ruta_tarifario_excel'];

		 }
		 
		
		 
		
		 
		 
		 
		 
		 endforeach; ?>
		  </div>
		 </div>
	   </div>
	 </div>

 <?php include_once('layouts/footer.php'); ?>
