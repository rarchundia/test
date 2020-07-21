<?php
require_once('includes/load.php');
  // Checkin What level user has permission to view this page
 //  page_require_level(10);
//$todolist = todolist($user['id']);
//$todolist = todolist();



?>

<?php include_once('layouts/header.php'); ?>
<?php 
	
$task = strip_tags($_POST['task'] );
$id_usuario = strip_tags($_POST['id_usuario'] );
	$date =make_date();

	//require("connect.php");

	$query="INSERT INTO tareas_p (nombre, fecha_inicio, id_usuario) VALUES ('{$task}', '{$date}', '{$id_usuario}')";

if($db->query($query)){
          //sucess
          $session->msg('s'," Tarea Ingresada");
	
        } else {
          //failed
          $session->msg('d',' No se pudo Crear la Carpeta.');
            echo '<meta http-equiv="Refresh" content="0; url=archivos.php">';
        }

/*
	$query = mysql_query("SELECT * FROM tasks WHERE task='$task' and date='$date' and time='$time'");

	while( $row = mysql_fetch_assoc($query) ){
		$task_id = $row['id'];
		$task_name = $row['task'];
	}

	mysql_close();

	echo '<li><span>'.$task_name.'</span><img id="'.$task_id.'" class="delete-button" width="10px" src="images/close.svg" /></li>';



  if($db->query($query)){
          //sucess
          $session->msg('s'," Carpeta Creada");
           echo '<meta http-equiv="Refresh" content="0; url=archivos.php">';
        } else {
          //failed
          $session->msg('d',' No se pudo Crear la Carpeta.');
            echo '<meta http-equiv="Refresh" content="0; url=archivos.php">';
        }
   } else {
     $session->msg("d", $errors);
        echo '<meta http-equiv="Refresh" content="0; url=archivos.php">';
   }
 }
*/


?>