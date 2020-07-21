<?php
  $page_title = 'Editar Usuario';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
//$todolist = todolist($user['id']);







?>

<?php include_once('layouts/header.php');

$todolist = todolist($user['id']);

?>
	<style>
		li {list-style:none;}
		.tachado{
			
		text-decoration: line-through;
		}
		
</style>  
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-12">
     <div class="panel panel-default">
       <div class="panel-heading">
        
		   
		   
		   
          <span class="glyphicon glyphicon-user"></span>
          Actualiza cuenta 
       </div>
       <div class="panel-body" id="panel-body">
		
		   <form class="add-new-task" autocomplete="off">
			<input type="text" name="new-task" class="form-control" placeholder="Agrega Pendiente" />
			   <input type="text" name="id_user" id="id_user"  value="<?php echo $user["id"];?>">
			   <button  type="submit">mandar</button>
		</form>
		   
		   
		   
		   
			  <!-- <form action="addItem.php" method="post" class="form-inline">
						
						<input type="text" name="new-task" id="new-task" class="form-control"  placeholder="Pendiente">
					
				<input type="text" name="id_user" id="id_user" class="form-control" value="<?php echo $user["id"];?>">
						<a class="editEntry" href="#" class="form-control" id="addEntry" > <span class="glyphicon glyphicon-plus"></span></a>
					
				</form>-->
		<div class="task-list">
				<ul>
			<?php foreach ($todolist as $list ):?>
                 
		
		<?php
		if($list["estatus"] == '1')
        {
         $style = 'text-decoration: line-through';
		}else{
		 $style = 'text-decoration: none';
        }
				
						
			echo '<li class="list-group-item" >
								<span style="'.$style.'">'.$list["nombre"].'</span>
								 <span class="badge delete-button" id="'.$list["id"].'">X</span>
									
							  </li>';
		   
		   
		   	
		
				?>
					<?php endforeach;?>
					 
		
					</ul>
			</div></div>
		   
		      
	<!--	   
		 <span class="badge" id="'.$list["id"].'">X</span>
		class="list-group-item"						
		-->   
		   
       </div>
     </div>
  </div>
  

<script>
		
		add_task(); // Call the add_task function
		delete_task(); // Call the delete_task function

		function add_task() {

			$('.add-new-task').submit(function(){

				var new_task = $('.add-new-task input[name=new-task]').val();
				var usuario = $('.add-new-task input[name=id_user]').val();

				if(new_task != ''){

					$.post('add-task.php', { task: new_task, user_id: usuario }, function( data ) {

						$('.add-new-task input[name=new-task]').val('');
					
						$(data).appendTo('.task-list ul').hide().fadeIn();
					
						delete_task();
					});
				}

				return false; // Ensure that the form does not submit twice
			});
		}
	
	
	
	
	
		function delete_task() {

			$('.delete-button').click(function(){

				var current_element = $(this);

				var id = $(this).attr('id');

				$.post('delete_task.php', { task_id: id }, function(data) {
				 current_element.parent().fadeOut("fast", function() { $(this).remove(); });
	$(data).appendTo('.task-list ul').hide().fadeIn();
					
						delete_task();
    				
					
					
				});
				return false; // Ensure that the form does not submit twice
			});
		}
	
	
	
	

	</script>
<?php include_once('layouts/footer.php'); ?>