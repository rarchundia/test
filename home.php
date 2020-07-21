<?php
  $page_title = 'Home Page';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}

if(isset($_POST['tareas_otro'])){
      
    if(empty($errors)){
     $p_new_task= remove_junk($db->escape($_POST['new-task']));
	 $p_id_user = remove_junk($db->escape($_POST['id_user']));
         $p_id_user_que_asigna = remove_junk($db->escape($_POST['id_user_que_asigna']));
    $date    = make_date();
   
     $query  = "INSERT INTO tareas_p (nombre,fecha_inicio,id_usuario, de) VALUES ('{$p_new_task}', '{$date}', '{$p_id_user}','{$p_id_user_que_asigna}')";
	  
	 
if($db->query($query)){
       $session->msg('s',"Tarea Asignada Correctamente. ");
       redirect('home.php', false);
     } else {
       $session->msg('d',' Lo siento, Falló al Al Asignar la tarea Intenta Otra Vez.');
       redirect('home.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('home.php',false);
   
   
   
 }}



?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
 <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center">
       <?php if($user['user_level'] === '3'){
		  echo '<meta http-equiv="Refresh" content="0; url=operador.php">';
}else{?>
		  
		  <center><h2>SISTEMA DE CONTROL INTERNO</h2></center><br><br>
		 <?php if($user["id"]==1){
	
}else{?>
		  <img src="libs/images/logos/envipaq.gif">
	
		  <?php }
		  ?>  
     
      </div>
    </div>
 </div>
</div>
<?php }include_once('layouts/footer.php'); ?>
