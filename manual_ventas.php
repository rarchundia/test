<?php
  $page_title = 'Manual  Ventas';
  require_once('includes/load.php');
?>
<?php
// Checkin What level user has permission to view this page
 page_require_level(10);
//pull out all user form database
?>
<?php include_once('layouts/header.php'); ?>
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
          <span class="glyphicon glyphicon-book"></span>
          <span>Manual Sistema</span>
       </strong>
       </div>
     <div class="panel-body">
      
		
		<embed src="manual/manual_ventas.pdf" type="application/pdf" width="100%" height="900px">
		
		
		
		
		
		
		
		</div>
    </div>
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>
