<?php
  $page_title = 'Notas';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
?>
<?php


/*if(!$recent_sales){
  $session->msg("d","Id de Reunion Desconocido.");
  redirect('pipedrive.php');
}*/
?>
<?php
 if(isset($_POST['notas_reunion'])){
   if(empty($errors)){
       $p_notas  = remove_junk($db->escape($_POST['notas']));
	   $p_id_cita=remove_junk($db->escape($_POST['id_citas']));
	   $query   = "UPDATE citas SET";
       $query  .=" resumen ='{$p_notas}', cerrada=1, color='#A9A9A9'";
       $query  .=" WHERE id ='{$p_id_cita}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Notas Agregadas Correctamente. ");
                 redirect('calendario.php', false);
               } else {
                 $session->msg('d',' Lo siento, Fallo al Agregar las Notas, Intentalo de Nuevo.');
                 redirect('notas_reunion.php?id='.$_GET['id'], false);
               }

   } else{
       $session->msg("d", $errors);
      redirect('notas_reunion.php?id='.$_GET['id'], false);
   }

 }

?>
<?php include_once('layouts/header.php'); 

$recent_sales = citas_id((int)$_GET['id']);

?>
<div class="row">

			
			
			
							<div class="col-md-12 "><!--principio de contactos-->
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-tasks"></span>
            <span>Notas</span>
          </strong>
        </div>
        <div class="panel-body">
            <div class="row">
 <?php foreach ($recent_sales as  $recent_sale): ?>
           
           <table class="table table-striped table-hover table-responsive">
       <thead>
         <tr>
           <th class="text-center">Contacto</th>
			 <th class="text-center">Teléfono</th>
           <th class="text-center">Empresa</th>
           <th class="text-center">Domicilio</th>
           <th class="text-center">Fecha y Hora Reunión</th>
         </tr>
       </thead>
       <tbody>
         
         <tr > 
           <td class="text-center">
			   <?php echo remove_junk(first_character($recent_sale['contacto']));?>
			 
			 
			 </td>
			  <td class="text-center">
		
			 Teléfono: <?php echo remove_junk(first_character($recent_sale['telefono']));?>
			 
			 </td>
           <td class="text-center">
           
            <?php echo remove_junk(first_character($recent_sale['empresa'])); ?>
          
           </td>
           <td class="text-center"><?php echo remove_junk(ucfirst($recent_sale['domicilio'])); ?></td>
           <td class="text-center">
			<?php echo remove_junk(ucfirst($recent_sale['fecha_hora'])).' Hora: '.$recent_sale['tiempo']; ?></td>
              
			 
        </tr>
			
			
			
			
			   
       </tbody>
     </table>
								 <?php endforeach;  ?>
			<form method="post" action="notas_reunion.php?id=<?php echo $_GET['id'];?>">					
			
			<div class="col-md-12">			
  <div class="form-group"><br>
    <label for="exampleFormControlTextarea1">Notas</label>
	  <input type="hidden" name="id_citas" value="<?php echo $_GET['id'];?>">

            
       <p class="emoji-picker-container">
      <textarea class="form-control" name="notas" rows="4" data-emojiable="true" data-emoji-input="unicode" onkeyup="mayus(this);" autofocus placeholder="Escribe tus Notas Aqui"></textarea>
           </p>
  </div></div>
			<div class="col-md-12">			
  <div class="form-group" align="right">	
	 <button type="submit" name="notas_reunion" class="btn btn-info " ><i class="glyphicon glyphicon-floppy-disk"></i>     Guardar     </button>

	  </div></div>
			</form>	
           
    </div> </div>
   </div>
  </div><!--fin de contactos-->
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		
<?php include_once('layouts/footer.php'); ?>
