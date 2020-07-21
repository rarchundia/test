       <!-- Modal nueva tarea-->
<div id="tarea_otros" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar Pendientes</h4>
      </div>
      <div class="modal-body">
     
          
          <form action="home.php" method="post" autocomplete="off">
	
			  <div class="form-group">
          
                 
               
                   <label for="level">Agregar Tarea a Usuario</label>
    <p class="emoji-picker-container">
        
      <textarea class="input-field" data-emojiable="true" data-emoji-input="unicode" type="text" name="new-task" id="new-task" placeholder="Agrega Tarea"></textarea>
                  </p>
                  
                 
              </div>
				<?php 
              $users_t=users_tareas();
              ?>
                 <div class="form-group">
              <label for="level">Usuario</label>
                <select class="form-control" name="id_user">
                  <?php foreach ($users_t as $user_t ):?>
                   <option value="<?php echo $user_t['id'];?>"><?php echo ucwords($user_t['name']);?></option>
                <?php endforeach;?>
                </select>
            </div>
              <input type="hidden" name="id_user_que_asigna" id="id_user_que_asigna"  value="<?php echo $user["id"];?>">
              
              <center> <button  type="submit" name="tareas_otro" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i>Asigna Tarea</button>
                  </center>
								</form>
      
              
              </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>   
                           <!-- final Modal nueva tarea-->
                  













</div>
    </div>

<script type="text/javascript">
	
/*$(function () {
	// Initializes and creates emoji set from sprite sheet
	window.emojiPicker = new EmojiPicker({
		emojiable_selector: '[data-emojiable=true]',
		assetsPath: 'emoji/emoji-picker/lib/img/',
		popupButtonClasses: 'icon-smile'
	});

	window.emojiPicker.discover();
});*/

	
		add_task(); // Call the add_task function
		delete_task(); // Call the delete_task function

		function add_task() {

			$('.add-new-task').submit(function(){

				var new_task = $('.add-new-task input[name=new-task]').val();
				var usuario = $('.add-new-task input[name=id_user]').val();
				

				if(new_task != ''){

					$.post('layouts/add-task.php', { task: new_task, user_id: usuario }, function( data ) {

						$('.add-new-task input[name=new-task]').val('');
						//$('#new-task').attr({ value: '' });
					
						$(data).appendTo('.task-list').hide().fadeIn();
			var vscroll = (document.all ? document.scrollTop : window.pageYOffset);
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

				$.post('layouts/delete_task.php', { task_id: id }, function(data) {
				 current_element.parent().fadeOut("fast", function() { $(this).remove(); });
	$(data).appendTo('.task-list').hide().fadeIn();
					
						delete_task();
    				
						
					
				});
				return false; // Ensure that the form does not submit twice
			});
		}
	 $(function () {
	// Initializes and creates emoji set from sprite sheet
	window.emojiPicker = new EmojiPicker({
		emojiable_selector: '[data-emojiable=true]',
		assetsPath: 'emoji/emoji-picker/lib/img/',
		popupButtonClasses: 'icon-smile'
	});

	window.emojiPicker.discover();
	  });</script>
		


  <!--  <script src="libs/js/jquery.min.js"></script>-->
  <script src="libs/js/bootstrap.min.js"></script>
  <script src="libs/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="libs/js/functions.js"></script>
	

	
    


  </body>
</html>

<?php if(isset($db)) { $db->db_disconnect(); } ?>
