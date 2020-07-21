<?php
  $page_title = 'Editar Usuario';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>

<?php include_once('layouts/header.php'); ?>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-12">
     <div class="panel panel-default">
       <div class="panel-heading">
        
          <span class="glyphicon glyphicon-user"></span>
          Actualiza cuenta 
       </div>
       <div class="panel-body">
		   
				
	
		   
		   
       </div>
     </div>
  </div>
  

 </div>
<?php include_once('layouts/footer.php'); ?>
