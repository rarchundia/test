<?php
  $page_title = 'En Desarrollo';
  require_once('includes/load.php');
  page_require_level(5);
  $groups = find_all('user_groups');
?>
<?php include_once('layouts/header.php'); ?>
 <div class="row">
     <div class="col-md-13">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-13">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>En Desarrollo 
                   
	</strong>
        </div>
        <div class="panel-body">
			
			
			
			<div id="panel">
  <h1 align="center">En Desarrollo.</h1>
 <p></p> <p align="center"><img src="libs/images/desarrollo.gif"></p>
  
<?php include_once('layouts/footer.php'); ?>