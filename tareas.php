<?php
  $page_title = 'Pendientes';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);

	


if(isset($_POST['agrega_proyecto'])){
 


  //$razonsocial_des = remove_junk($db->escape($_POST['razonsocial_des']));
 
   if(empty($errors)){
     $p_nombre = remove_junk($db->escape($_POST['nombre']));
	$p_descripcion = remove_junk($db->escape($_POST['descripcion']));
	$p_id_user = remove_junk($db->escape($_POST['id_user']));
	   
     $date    = make_date();
     $query  = "INSERT INTO t_proyecto (";
     $query .="  nombre, descripcion, id_user, fecha";
     $query .=") VALUES (";
     $query .="'{$p_nombre}','{$p_descripcion}','{$p_id_user}','{$date}' ";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
       
	  $session->msg('s',"Proyecto Generado Correctamente ");
      echo '<meta http-equiv="Refresh" content="0; url=tareas.php">';
		 // redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Generar el  Proyecto Intenta Nuevamente.');
      echo '<meta http-equiv="Refresh" content="0; url=tareas.php">';
			//redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
    echo '<meta http-equiv="Refresh" content="0; url=tareas.php">';
	   //redirect('entrega.php',false);
   }

 }


if(isset($_POST['tarea_btn'])){
 


  //$razonsocial_des = remove_junk($db->escape($_POST['razonsocial_des']));
 
   if(empty($errors)){
     $p_tarea = remove_junk($db->escape($_POST['tarea']));
	$p_descripcion = remove_junk($db->escape($_POST['descripcion']));
	$p_prioridad = remove_junk($db->escape($_POST['prioridad']));
	   $p_id_user = remove_junk($db->escape($_POST['id_user']));
	    $p_id_proyecto= remove_junk($db->escape($_POST['id_proyecto']));
     $date    = make_date();
     $query  = "INSERT INTO tareas_p (";
     $query .="  nombre, descripcion, fecha_inicio, id_proyecto, prioridad,  id_usuario";
     $query .=") VALUES (";
     $query .="'{$p_tarea}','{$p_descripcion}','{$date}','{$p_id_proyecto}','{$p_prioridad}','{$p_id_user}' ";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
       
	  $session->msg('s',"Tarea Agregada Correctamente ");
      echo '<meta http-equiv="Refresh" content="0; url=tareas.php">';
		 // redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Agregar la Tarea Intenta Nuevamente.');
      echo '<meta http-equiv="Refresh" content="0; url=tareas.php">';
			//redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
    echo '<meta http-equiv="Refresh" content="0; url=tareas.php">';
	   //redirect('entrega.php',false);
   }

 }



?>



<?php include_once('layouts/header.php');
$proyecto = t_proyectos($user['id']);	

?>
<style>

	.tab-pane{
		color:black;
		background-color: white;
		
	}
	ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 20px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
	
</style>

 <div class="row">
     <div class="col-md-13">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Pendientes </strong>
        </div>
        <div class="panel-body">
			
			<div class="col-md-3">
				Proyectos <button type="button" class="btn btn-default " data-toggle="modal" data-target="#nuevo_proyecto">+</button><br>
				 <!-- Modal -->
<div id="nuevo_proyecto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal agrega proyecto-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <center><h4 class="modal-title">Agregar un Proyecto</h4></center>
      </div>
      <div class="modal-body">
        
		  
		  <form action="tareas.php" method="post">
  <div class="form-group">
    <label for="nombre">Nombre del Proyecto:</label>
    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Proyecto" onkeyup="mayus(this);" required>
  </div>
  <div class="form-group">
  <label for="descripcion">Descripción <sub>(Opcional)</sub></label>
  <textarea class="form-control" rows="3" id="descripcion" name="descripcion" onkeyup="mayus(this);" placeholder="Puedes Agregar una Descripcion y esta es opcional "></textarea>
   </div>
			  <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo    $user['id'];?>"  >
			  
			  <div class="form-group pull-right">
  <button type="submit" class="btn btn-success " name="agrega_proyecto">Agregar Proyecto</button>
  </div><br><br>
</form>
		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div> 

  </div>

			</div><!-- fin Modal proyecto-->
			
		
       

		<ul class="list-group ">
			<?php foreach ($proyecto as  $proye): ?>
	  <a href="#<?php echo    $proye['id'];?>" data-toggle="tab" class="list-group-item" style="text-decoration:none; color: black;">
<?php echo    $proye['nombre'];?> <span class="badge">12</span>
	  </a>
  <?php endforeach; ?>
</ul>	   

				
				
	</div>
			
     
			
			
			
			
        <div class="col-md-8">
			
            <!-- Tab panes -->
            <div class="tab-content">
				<?php foreach ($proyecto as  $proye): ?>
                <div class="tab-pane fade" id="<?php echo    $proye['id'];?>">
		<div class="col-md-2">
					
					<h3><strong><?php echo    $proye['nombre'];?></strong></h3>
			</div>
				<div class="col-md-1 pull-right">
					
					<button type="button" class="btn btn-default " data-toggle="modal" data-target="#-<?php echo    $proye['id'];?>">Agregar Tarea</button>
					</div>
				 <!-- Modal -->
<div id="-<?php echo    $proye['id'];?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal agrega proyecto-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <center><h4 class="modal-title">Agregar Tarea a: <?php echo    $proye['nombre'];?></h4></center>
      </div>
      <div class="modal-body">
        
		  
		  <form action="tareas.php" method="post">
  <div class="form-group">
    <label for="nombre">Tarea</label>
    <input type="text" class="form-control" id="tarea" name="tarea" placeholder="Agrega una Tarea" onkeyup="mayus(this);" required>
  </div>
  <div class="form-group">
  <label for="descripcion">Descripción <sub>(Opcional)</sub></label>
  <textarea class="form-control" rows="3" id="descripcion" name="descripcion" onkeyup="mayus(this);" placeholder="Puedes Agregar una Descripcion y esta es opcional "></textarea>
   </div>
			  <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo    $user['id'];?>"  >
			 <input type="hidden" class="form-control" id="id_proyecto" name="id_proyecto" value="<?php echo    $proye['id'];?>"  >
			  <div class="form-group">
				  <label for="sel1">Selecciona la Prioridad</label>
				<select name="prioridad" class="form-control">
  <option value="1">Baja</option>
  <option value="2">Media</option>
  <option value="3">Alta</option>
  <option value="4">Urgente</option>
</select>  
			  </div>
			  <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo    $user['id'];?>"  >
			  <div class="form-group pull-right">
  <button type="submit" class="btn btn-success " name="tarea_btn">Agregar Proyecto</button>
  </div><br><br>
</form>
		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div> 

  </div>

			</div><!-- fin Modal proyecto-->
					
					<?php //if($proye['id_tarea']=$proye['id'])?>
					<!-- timeline--><br><br>
					<div class="container mt-8 mb-8">
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<h4>Tareas </h4>
			<ul class="timeline">
				<li>
					<div class="col-md-6">
						<i><h4><?php echo    $proye['tarea_nombre'];?></h4></i>
					</div>
					<div class="col-md-6">
						<i class="pull-right">Agregada el <?php echo    $proye['fecha_inicio'];?></i>
					</div><br><br>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>
				</li>
				
			</ul>
		</div>
	</div>
</div><!-- fin timeline-->
					
					
					
					
					
					</div>

			
					
				
				
                <?php endforeach; ?>
				</div>
				</div>
				
            </div>
        </div>
        
          
				
			
			
			
			
			
			
			 </div></div></div></div>
			
			
			
			
			
			<?php include_once('layouts/footer.php'); ?>