<?php
  $page_title = 'Estatus Guia';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
  
?>
<?php 
include_once('layouts/header.php');
$id=$_GET['id'];
 $products = estatus_guias($id);
 ?>
<style>

	.tab-pane{
		color:black;
		background-color: white;
		
	}
	ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 20px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
	
</style>
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
<strong>Estatus de la Guia.  <?php 
	
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
			
			<?php }elseif($product['estatus']==1 OR $product['estatus']==50){
	  ?><img src="uploads/entregada.png" width="100%">
			
			<?php }
	  elseif($product['estatus']==99){
	  ?><h1 style="color: red;"><center>CANCELADA</center></h1>
			
			<?php }?>
		</div>
</div>
			
	<!-- timeline--><br><br>
					<div class="container mt-10 mb-10">
	<div class="row">
		<div class="col-md-8 offset-md-6">
			<h4>Acciones</h4>
			<ul class="timeline">
				<?php  if($product['estatus']==99){?>
				<li>
					
					<div class="col-md-6">
						<i><h4>Guia Cancelada</h4></i>
					</div>
					<div class="col-md-6">
						<i class="pull-right"> <?php echo    $product['fecha_cancelacion'];?></i>
					</div><br><br>
					</li>
				<?php }?>
				
				<?php  if($product['estatus']==1 OR $product['estatus']==50){?>
				<li>
					
					<div class="col-md-6">
						<i><h4>Guia Entregada</h4></i>
					</div>
					<div class="col-md-6">
						<i class="pull-right"> <?php echo    $product['fecha_entrega_bien'];?></i>
					</div><br><br>
					<p>Entregado a: <strong><?php echo    $product['recibido'];?></strong><br><br>
					<?php 
																			 if(is_null($product['file_name'])){
																				 echo "<strong>Sin Firma</strong>";
																			 }else{
																				 echo 'Firma: <img src="../uploads/products/'.$product['file_name'].'" width="100%"></p>' ;
																			 }
						
						?>
				</li>
				<?php }?>
				
				<?php  if($product['primera']==1){?>
				<li>
					
					<div class="col-md-6">
						<i><h4>Primer Intento de Entrega</h4></i>
					</div>
					<div class="col-md-6">
						<i class="pull-right"> <?php echo    $product['primera_fecha'];?></i>
					</div><br>
					<p><?php echo    $product['notas_entrega'];?></p>
				</li>
				<?php }?>
				<?php  if($product['segunda']==1){?>
				<li>
					
					<div class="col-md-6">
						<i><h4>Segundo Intento de Entrega</h4></i>
					</div>
					<div class="col-md-6">
						<i class="pull-right"> <?php echo    $product['segunda_fecha'];?></i>
					</div><br>
					<p><?php echo    $product['notas_entrega2'];?></p>
				</li>
				<?php }?>
				<?php  if($product['tercera']==1){?>
				<li>
					
					<div class="col-md-6">
						<i><h4>Tercer Intento de Entrega</h4></i>
					</div>
					<div class="col-md-6">
						<i class="pull-right"> <?php echo    $product['tercera_fecha'];?></i>
					</div><br>
					<p><?php echo    $product['notas_entrega3'];?></p>
					
				</li>
				<?php }?>
				
				<?php  if($product['en_ruta']!=0){?>
				<li>
					
					<div class="col-md-6">
						<i><h4>Salio a Ruta</h4></i>
					</div>
					<div class="col-md-6">
						<i class="pull-right"> <?php echo    $product['en_ruta'];?></i>
					</div><br><br>
					
				</li>
				<?php }?>
				
				
				<?php  if($product['fecha_asignacion']!=0){?>
				<li>
					
					<div class="col-md-6">
						<i><h4>Guia Asignada</h4></i>
					</div>
					<div class="col-md-6">
						<i class="pull-right"> <?php echo    $product['fecha_asignacion'];?></i>
					</div><br><br>
					
				</li>
				<?php }?>
				<li>
					<div class="col-md-6">
						<i><h4>Guia Creada</h4></i>
					</div>
					<div class="col-md-6">
						<i class="pull-right"><?php echo    $product['fecha'];?></i>
					</div><br><br>
					<!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>-->
				</li>
				
				
			</ul>
		</div>
	</div>
</div><!-- fin timeline-->		
					
					
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
             <?php endforeach; ?>
          
        </div>
      </div>
   
  <?php include_once('layouts/footer.php'); ?>