<?php
  $page_title = 'Detalles correos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(8);

$correo=$_GET["correo"];
$correos=por_correos($correo);
?>

<?php include_once('layouts/header.php'); ?>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-12">
     <div class="panel panel-default">
       <div class="panel-heading">
        
          <span class="glyphicon glyphicon-envelope"></span>
          Detalles Correo <strong><?php echo $correo;?> </strong>
       </div>
       <div class="panel-body">
		   <div class="col-md-4">
			   <h2> DE:</h2>
		   </div>
		   <div class="col-md-4">
			<h2> PARA:</h2>
		   </div>
		   <div class="col-md-4">
				<h2> FECHA:</h2>
		   </div>
		<?php  foreach ($correos as  $detalles): 	?>
		   
		     <div class="col-md-4">
				 <?php echo $detalles['de'];?>	
		   </div>
		   <div class="col-md-4">
			   <a href="mailto:<?php echo $detalles['para'];?>"><?php echo $detalles['para'];?>	</a>
		   </div>
		   <div class="col-md-4">
<?php echo $detalles['enviado_hora'];?>	
		   </div>
		   	
		   
		    <?php endforeach;?> 
		   
       </div>
     </div>
  </div>
  

 </div>
<?php include_once('layouts/footer.php'); ?>
