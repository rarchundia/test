<?php
require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
 //  page_require_level(10);
//$todolist = todolist($user['id']);
//$todolist = todolist();



?>


<?php 


if(isset($_POST["task_id"] )){ 
$task = strip_tags($_POST['task_id'] );
	
	 $todolistcom = todolist_despues_tachado($task);
	
	foreach ($todolistcom as $list1 ):
if($list1["estatus"]==0){
	
	$date =make_date();

	$query="UPDATE tareas_p SET fecha_fin='{$date}', estatus='1' WHERE id='{$task}'";

$db->query($query);
      //sucess
     $todolist1 = todolist_despues_tachado($task);    
	foreach ($todolist1 as $list ):
$task_name=$list["nombre"];
$task_id=$list["id"];

endforeach;


 //if(isset($db)) { $db->db_disconnect(); } 



echo '<li class="list-group-item"><span style="color: red; text-decoration: line-through">'.$task_name.'</span><span class="badge delete-button" id="'.$task_id.'">X</span></li>';

	
	
	
} 
	
	elseif($list1["estatus"]==1){
	$query="UPDATE tareas_p SET estatus='2' WHERE id='{$task}' ";
		$db->query($query);
}

endforeach;
	
	
	
	
	


}
   


?>