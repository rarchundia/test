<?php
  require_once('includes/load.php');
    $page_title = 'Directorio';
// Checkin What level user has permission to view this page
   page_require_level(10);
  
?>
<?php
 

 $directorio = directorio();


if(isset($_POST['add_cliente'])){
 
  $p_nombre= $_POST['nombre'];
	$p_correo= $_POST['correo'];
	$p_extension= $_POST['extension'];
    
     $query  = "INSERT INTO directorio (";
     $query .=" nombre, extencion, email";
     $query .=") VALUES (";
     $query .="'{$p_nombre}','{$p_extension}','{$p_correo}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
	 
		if($db->query($query)){
		 
	  $session->msg('s',"Alta Generada  Correctamente. ");
	//redirect('ingresa_odometro.php', false);
	  echo '<meta http-equiv="Refresh" content="0; url=directorio.php">';	 
	 
	 }
	    else {
       $session->msg('d',' Lo siento, Falló al Generar Alta.');
      //redirect('ingresa_odometro.php', false);
	   echo '<meta http-equiv="Refresh" content="0; url=directorio.php">';
		}

  

 }
 


include_once('layouts/header.php');
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
        <span class="glyphicon glyphicon-user"></span>
        <span>Directorio</span>
     </strong>
      <span class="pull-right">
		  <input class="form-control" id="myInput" type="text" placeholder="Buscar..">
		</span>
    </div></div>
     <div class="panel-bod panel panel-default">
      <table class="table table-striped table-hover table-responsive">
        <thead>
          <tr>
            
            <th class="text-center">Nombre </th>
            <th class="text-center">Extensión</th>
            <th class="text-center">Correo</th>
            <!--<th class="text-center">Cumpleaños</th>-->
			</tr>
        </thead>
        <tbody id="myTable">
						
			<tr>
           <?php foreach ($directorio as $direc):?>
           <td class="text-center"><?php echo remove_junk($direc['nombre']);?></td>
           <td class="text-center"><?php echo remove_junk($direc['extencion']);?></td>
           <td class="text-center">
			   <a href="mailto:<?php echo mb_strtolower($direc['email'],'UTF-8');?>" title="Da Click para Abrir Outlook" data-toggle="tooltip"><?php echo mb_strtolower($direc['email'],'UTF-8');?></a></td>
		<!--<td class="text-center">cumpleaños</td>
        -->   </tr>
   <?php endforeach;?>
       </tbody>
     </table>
		 
		 
		 
     </div>
    </div>
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>




	<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<?php include_once('layouts/footer.php'); ?>