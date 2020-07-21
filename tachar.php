<?php
require_once('includes/load.php');
  // Checkin What level user has permission to view this page
 //  page_require_level(10);
//$todolist = todolist($user['id']);
//$todolist = todolist();



?>

<?php// include_once('layouts/header.php'); ?>
<?php 


if(isset($_POST["task_id"] )){ 
$task_id = strip_tags($_POST['task_id'] );
//$id_usuario = strip_tags($_POST['user_id'] );
	$date =make_date();

	//require("connect.php");

	$query="UPDATE tareas_p SET fecha_fin='{$date}', estatus='1' WHERE id='{$task_id}'";

$db->query($query);
          //sucess
   /*  $todolist = todolist_despues($task, $date);    
	foreach ($todolist as $list ):
$task_name=$list["nombre"];
$task_id=$list["id"];

endforeach;

*/

 if(isset($db)) { $db->db_disconnect(); } 


//echo '<li class="list-group-item"><span>'.$task_name.'</span><span class="badge" data-id="'.$list["id"].'">X</span></li>';


}


?>