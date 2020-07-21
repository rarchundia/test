<?php
  $page_title = 'Bloqueados';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);

	$recent_products = clientes_envi_bloq();
$recent_sales = clientes_envi();
$ultima_fecha=find_ultima_fecha('clientes');	


?>


<style>

	

	.bloqueados{
		background-color: crimson;
		color: white;
	}
</style>

<?php include_once('layouts/header.php');


?>
 <div class="row">
     <div class="col-md-13">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-13">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Panel
                <span class="pull-right">

	<strong><h5><i class="glyphicon glyphicon-time"> Última Actualización</i> <?php echo $ultima_fecha["ultima_fecha"];?>
	</h5></strong><br>
					<input class="form-control" id="myInput" type="text" placeholder="Buscar..." autofocus>
				</span>   
	</strong>
        </div>
        <div class="panel-body" id="myDIV">
			
			
			
			
				  
				
					<!--<div class="col-md-3" id="muestradiv">
					<label class="btn btn-success glyphicon glyphicon-plus-sign" id="muestra"> Generar Alta De Contacto</label>
					 
					 </div>-->
					<div class="col-md-6"><!--principio de contactos-->
						
						
						
						
						
						<div class="card" style="width: 100%;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><center><span class="glyphicon glyphicon-folder-open" style="font-size:35px; color:gray;" ></span>
            <span><br> Cartera </span></center></li>
	  <?php foreach ($recent_sales as  $recent_sale): ?>
       <h4><li class="list-group-item"><?php echo    $recent_sale['nombre'];?></li></h4>
		          <?php endforeach; ?>
      </ul>
</div>
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
     <!-- <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-user"></span>
            <span>Clientes </span>
          </strong>
        </div>
        <div class="panel-body">
       
        <?php foreach ($recent_sales as  $recent_sale): ?>
       
<h4><?php echo    $recent_sale['nombre'];?><hr></h4>
		   
       <?php endforeach; ?>
    
    </div>
   </div>-->
  </div><!--fin de contactos-->
				
				
			
			<div class="col-md-6"><!--principio de bloquedos-->
			<div class="card" style="width: 100%;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item" ><center><span class="glyphicon glyphicon-remove" style="font-size:35px; color:red;" ></span>
            <span><br> Bloqueados </span></center></li>
    <?php foreach ($recent_products as  $recent_product): ?>
       <h4 title="Motivo: <?php echo remove_junk(first_character($recent_product['notas']));?>" data-toggle="tooltip"><li class="list-group-item" style="background: #EC7063; color:white;"><?php echo    $recent_product['nombre'];?></li></h4>
		          <?php endforeach; ?>
  </ul>
</div></div>
			
			
			
			
			
			
			
			
			
			<!--<div class="col-md-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-remove"></span>
          <span>Clientes Bloqueados</span>
        </strong>
      </div>
      <div class="panel-body" id="bloqueados">

        <div class="list-group">
			
      <?php foreach ($recent_products as  $recent_product): ?>
          
		<h4 title="Motivo: <?php echo remove_junk(first_character($recent_product['notas']));?>" data-toggle="tooltip"><?php echo    $recent_product['nombre'];?><hr></h4>
			
      <?php endforeach; ?>
    </div>
  </div>
 </div>
</div>
 </div>-->
  
				
				
				
				
	<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myDIV *").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>			
				
				
<?php include_once('layouts/footer.php'); ?>
