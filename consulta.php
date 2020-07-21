<?php
  $page_title = 'Estatus';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(4);
  
?>
<?php 
include_once('layouts/header.php');
 $products = guias_asignacion_andres();
 ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
		

		
		<!--<div class="col-md-6">
		<form class="clearfix" method="post" action="rango_recoleccion.php">
            <div class="form-group">
                <div class="input-group">
                  <input type="text" class="datepicker form-control" name="fecha"  autocomplete="off" placeholder="Primera Fecha Entrega" required title="Selecciona un Rango de Fechas de Recoleccion Para Generar el reporte" data-toggle="tooltip">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
                  
                     <input type="text" class="datepicker form-control" name="fecha2"  autocomplete="off" placeholder="Segunda Fecha Entrega" required>
										</div>
<button type="submit" name="fecha_entrega" class="btn btn-primary btn-block">Generar Reporte</button>
            </div>
          </form>
		
		</div>-->
		
		
		
		
		
		
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
			<div class="col-md-12"><br>
<strong>Estatus de Recolecciones.  <?php 
	
	//$fecha_rango1=strftime("%d %B del %Y", strtotime(date("d/m/Y"))) ;
	//echo $fecha_rango1;
	//echo date("d/m/Y");?></strong>
        </div></div>
        <div class="panel-body">
        
			
			<div class="panel panel-default">
  <div class="panel-body">
	  <?php foreach ($products as $product):
	  if($product['estatus']==0){
	?>	
	  <img src="uploads/guia_generada.png" width="100%">
	  <?php
	  }elseif($product['estatus']==2){
	  ?><img src="uploads/Asignada.png" width="100%">
			
			<?php }elseif($product['estatus']==4){
	  ?><img src="uploads/en_ruta.png" width="100%">
			
			<?php }elseif($product['estatus']==1){
	  ?><img src="uploads/entregada.png" width="100%">
			
			<?php }?>
		</div>
</div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
             <?php endforeach; ?>
          
        </div>
      </div>
   
  <?php include_once('layouts/footer.php'); ?>
