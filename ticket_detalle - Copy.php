<?php
  $page_title = 'Tickets Detalle';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);

	


if(isset($_POST['agrega_entrada'])){
 


  //$razonsocial_des = remove_junk($db->escape($_POST['razonsocial_des']));
 
   if(empty($errors)){
     $p_id_ticket = remove_junk($db->escape($_POST['id_ticket']));
	$p_detalles = remove_junk($db->escape($_POST['detalles']));
	$p_id_user = remove_junk($db->escape($_POST['id_user']));
	   $p_guia = remove_junk($db->escape($_POST['guia']));
     $date    = make_date();
     $query  = "INSERT INTO ticket_detalles (";
     $query .="  detalles, id_user, id_ticket, fecha_entrada";
     $query .=") VALUES (";
     $query .="'{$p_detalles}','{$p_id_user}','{$p_id_ticket}','{$date}' ";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
//con->set_charset('utf8mb4');
	   if($db->query($query)){
       
	  $session->msg('s',"Entrada Agregada");
      echo '<meta http-equiv="Refresh" content="0; url=ticket_detalle.php?id='.$p_id_ticket.'&guia='.$p_guia.'">';
		 // redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Generar el  Proyecto Intenta Nuevamente.');
      echo '<meta http-equiv="Refresh" content="0; url=ticket_detalle.php?id='.$p_id_ticket.'&guia='.$p_guia.'">';
			//redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
   echo '<meta http-equiv="Refresh" content="0; url=ticket_detalle.php?id='.$p_id_ticket.'&guia='.$p_guia.'">';
	   //redirect('entrega.php',false);
   }

 }



if(isset($_POST['estatus'])){

if(empty($errors)){
    
	 $p_id_ticket = remove_junk($db->escape($_POST['id_ticket']));
	 $p_estatus = remove_junk($db->escape($_POST['estatus']));
	$p_id_user = remove_junk($db->escape($_POST['id_user']));
	   $p_guia = remove_junk($db->escape($_POST['guia']));
	$date    = make_date();
	
	$query  = " UPDATE ticket SET fecha_cierre='{$date}', estatus ='{$p_estatus}', id_cierre ='{$p_id_user}'  WHERE id='{$p_id_ticket}'";
	
	 $result = $db->query($query);
          if($result && $db->affected_rows() === 1){
            $query  = "INSERT INTO ticket_detalles (";
     $query .="  detalles, id_user, id_ticket, fecha_entrada";
     $query .=") VALUES (";
     $query .="'SE CIERRA REPORTE','{$p_id_user}','{$p_id_ticket}','{$date}' ";
     $query .=")";
			  			  
			  $db->query($query);
			  
			  $session->msg('s',"Se ha Cambiado el Estatus del Ticket ");
            echo '<meta http-equiv="Refresh" content="0; url=ticket_detalle.php?id='.$p_id_ticket.'&guia='.$p_guia.'">';
	  //redirect('incidencias.php', false);
          } else {
            $session->msg('d',' Fallo al Cambiar el Estatus');
           echo '<meta http-equiv="Refresh" content="0; url=ticket_detalle.php?id='.$p_id_ticket.'&guia='.$p_guia.'">';
		  //redirect('incidencias.php', false);
          }
}
	else{
     $session->msg("d", $errors);
    // redirect('aclaraciones.php',false);
	 echo '<meta http-equiv="Refresh" content="0; url=ticket_detalle.php?id='.$p_id_ticket.'&guia='.$p_guia.'">';
	  }
	
	
	
}

if(isset($_POST['agrega_folio'])){

if(empty($errors)){
    
	 $p_id_ticket = remove_junk($db->escape($_POST['id_ticket']));
	 $p_folio = remove_junk($db->escape($_POST['folio']));
	   $p_guia = remove_junk($db->escape($_POST['guia']));
	$p_id_user = remove_junk($db->escape($_POST['id_user']));
		$date    = make_date();
	
	$query  = " UPDATE ticket SET folio_reporte='{$p_folio}', fecha_folio ='{$date}' WHERE id='{$p_id_ticket}'";
	
	 $result = $db->query($query);
          if($result && $db->affected_rows() === 1){
			  
			 $query  = "INSERT INTO ticket_detalles (";
     $query .="  detalles, id_user, id_ticket, fecha_entrada";
     $query .=") VALUES (";
     $query .="'SE AGREGA FOLIO DE REPORTE {$p_folio}','{$p_id_user}','{$p_id_ticket}','{$date}' ";
     $query .=")";
			  			  
			  $db->query($query);
			  
			  $session->msg('s',"Folio Agregado Correctamente ");
            echo '<meta http-equiv="Refresh" content="0; url=ticket_detalle.php?id='.$p_id_ticket.'&guia='.$p_guia.'">';
	  //redirect('incidencias.php', false);
          } else {
            $session->msg('d',' Fallo al Agregar el  Folio Intentalo Nuevamente');
           echo '<meta http-equiv="Refresh" content="0; url=ticket_detalle.php?id='.$p_id_ticket.'&guia='.$p_guia.'">';
		  //redirect('incidencias.php', false);
          }
}
	else{
     $session->msg("d", $errors);
    // redirect('aclaraciones.php',false);
	 echo '<meta http-equiv="Refresh" content="0; url=ticket_detalle.php?id='.$p_id_ticket.'&guia='.$p_guia.'">';
	  }
	
	
	
}






?>



<?php include_once('layouts/header.php');
//$proyecto = t_proyectos($user['id']);	

?>
<script src="drop/dropzone.js"></script>
<link rel="stylesheet" href="drop/dropzone.css">
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



<?php 
//    $detalles = ticket_detalle($user['id']);
//	  foreach ($sin_resolver as  $sin_r): ?>	

 <div class="row">
     <div class="col-md-13">
       <?php echo display_msg($msg);
		  $id=$_GET["id"];
		 $guia=$_GET["guia"];
		 $folio=folio($id);
		 ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
       
        <div class="panel-body">
			
		
  <div class="col-md-12">
	  
	  <div class="row">
    <div class="col-md-2 mb-3">
		
        <ul class="list-group ">
			<?php $tickets_poruser=contador_tickets_poruser("ticket",  $user['id']);?>
	  
			<a href="tickets.php"  class="list-group-item" style="text-decoration:none; color: black;">Tickets sin resolver
 <span class="badge  alert-danger"><?php  echo $tickets_poruser["contador_tickets"];?></span>
	  </a>
			
		<a href="tickets.php"  class="list-group-item" style="text-decoration:none; color: black;"><i class="glyphicon glyphicon-arrow-left"></i> Regresar
 
	  </a>	
</ul>	
		
		</div>	
	  <div class="col-md-10">
	
		  
		 
			  	  <div class="col-md-12">
  <label for="comment"> # de Ticket <strong>ENV<?php echo $id;?></strong> de la guia <strong><?php echo $guia;
		 ?></strong>
	   <?php foreach ($folio as $folios):
	  
	  if($folios["folio_reporte"]==0){
	  ?>
	  
	  <form action="ticket_detalle.php" method="post">
			<div class="form-group ">		  
			<input type="text" name="folio" placeholder="Agrega Folio de Reporte">
				<input type="hidden" name="guia" value="<?php echo $guia?>">
				<input type="hidden" name="id_ticket" value="<?php echo $id;?>">
				<input type="hidden" name="id_user" value="<?php echo $user['id'];?>">
		<button type="submit" class="btn btn-info pull-right" name="agrega_folio">Agrega Folio</button>
		  </div>
	  </form>	
	    <?php }
	 
	  
	  if($folios["estatus"]==1){
		  echo "<center><h2>El ticket ya se encuentra cerrado  no se puede Modificar.</center></h2><br><br>";
	  }else{
		  
		  
	  ?>
					  </label>
			  </div>	
			  
			  <div class="col-md-2 pull-right">
			  
			<form action="ticket_detalle.php" method="post">
	<div class="form-group ">
      <label for="inputState">Cambiar Estatus</label>
      <select id="prioridad" name="estatus" class="form-control" onchange="this.form.submit()">
        <option selected>Selecciona...</option>
        <option value="1">RESUELTO</option>
		  
      </select>
    </div>
	<input type="hidden" name="id_user" value="<?php echo $user['id'];?>">
		<input type="hidden" name="id_ticket" value="<?php echo $id;?>">
		 <input type="hidden" name="guia" value="<?php echo $guia?>">   
	</form>
				    </div>
		  <div class="col-md-10">
			  <form action="ticket_detalle.php" method="post">
				   <div class="form-group">
			 
			
				  <p class="lead emoji-picker-container">
  <textarea class="form-control" rows="5" id="comment" name="detalles" data-emojiable="true" data-emoji-input="unicode"  onkeyup="mayus(this);"></textarea>
					   </p>

		<input type="hidden" name="guia" value="<?php echo $guia?>">
		<input type="hidden" name="id_user" value="<?php echo $user['id'];?>">
		<input type="hidden" name="id_ticket" value="<?php echo $id;?>">
		<button type="submit" class="btn btn-info pull-right" name="agrega_entrada">Agrega Entrada</button>
		</div>
				  </form>   </div>
	
		  
		  <!--comentarios-->
	  <?php 
	  }
	   endforeach;
	  $detalles = ticket_detalles($id);
	  
	  foreach ($detalles as  $deta):
		 if (is_null($deta['name'])){
		  	  echo " <div class='col-md-10'><br><br><h2 style='color: red;'>No hay detalles agregados</h2></div>";
			  
		  }else{
		  
		  ?>	
		  
 
		  <div class="col-md-10">
	  <!-- Left-aligned -->
<div class="media">
  <div class="media-left">
   
	   <img src="uploads/users/<?php echo $deta['image'];?>"  style="width:100px" >
	  
	  
  </div>
  <div class="media-body">
    <h4 class="media-heading" style="color:maroon;"><?php echo $deta['name'];?> <small><i style="color: red;"><?php echo $deta['fecha_entrada'];?></i></small>
	  
	   <?php 
        
        if($deta['archivo']==0){
        ?>
        <i class="glyphicon glyphicon-paperclip pull-right" data-toggle="modal" data-target="#<?php echo $deta['id_detalles'];?>"></i>
        <?php }else{
           chmod("ticket_evidencia/".$deta['archivo'], 0777 );
        ?>
        
            <a href="ticket_evidencia/<?php echo $deta['archivo'];?>" download="<?php echo $deta['archivo'];?>" class="pull-right" data-toggle="tooltip" title="Descarga Archivo"><i class="glyphicon glyphicon-file"></i></a>
      
                <?php
        }
        
        
        ?>
	  
	  
	  </h4>
    <p><?php echo $deta['detalles'];?></p>
  </div>
    <hr>
</div>
			  
			   <!-- inicio de modal-->
             
              <div id="<?php echo $deta['id_detalles'];?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> <i class="glyphicon glyphicon-file"></i>  Carga Archivo </h4>
      </div>
      <div class="modal-body">
        <!--class="dropzone"-->
		  
          <div id="upload_proceso"></div>
          
		    <form method="post"  class="dropzone" action="sube_documentos_ajax.php" id="form_constitutiva" enctype="multipart/form-data">
    
       <div class="fallback">
		  <input type="file" name="archivo_contitutiva" id="archivo_contitutiva"/>
		   </div>
                 
				 
				  <input type="hidden" name="ticket_evidencia1" id="ticket_evidencia1" value="<?php echo $deta['id_detalles'];?>">
                
                
     	</form>
          
          
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>      <!-- fin  de modal-->
			  
			  
			  </div>

	  
		
	   <!-- fin de comentarios-->
	 <?php 
		  }
		  endforeach;?> 
	  
	 </div> 
			
		</div></div>
		  
		  </div></div></div></div>
			
			
			
		<script>

function getValues() {
    var formData = new FormData();
    // these image appends are getting dropzones instances
    formData.append("ticket_evidencia1", jQuery('#ticket_evidencia1').val()); // attach dropzone image element
   // formData.append("id_user", jQuery('#id_user').val());
 
    /*formData.append('image_2', $('#barfoo')[0].dropzone.getAcceptedFiles()[0]);
    formData.append("id", $("#id").val()); // regular text form attachment
    formData.append("_method", 'PUT'); // required to spoof a PUT request for a FormData object (not needed for POST request)
*/
    return formData;
}
				
		$("#form_constitutiva").dropzone({
    url: "sube_documentos_ajax.php",
			//acceptedFiles: ".pdf",
			//dictInvalidFileType: "Solo Se Aceptan Archivos PDF",
    dictDefaultMessage: "Arrastra El Archivo Aqui o Da Click para Cargarlo",
			maxFilesize: 10, // MB
                maxFiles: 1,
			addRemoveLinks: true,
			uploadprogress:function(file, response){
                console.log('WE NEVER REACH THIS POINT.');
				$('#btn_siguiente').attr("disabled", true);
				$("#upload_proceso").html("<h2><center>Subiendo espera <img src='libs/images/ajax-loader.gif'></center></h2>").fadeIn;
                            },
			
	success: function(file, response){
                console.log('WE NEVER REACH THIS POINT.');
               $('#btn_siguiente').attr("disabled", false);
		
		$("#upload_proceso").html("<h2><center>Carga Completa</center></h2>").fadeIn;
   location.reload();
        // setTimeout(function() {   
		//$("#upload_proceso").html("<h2><center>Carga Completa</center></h2>").fadeOut(100);
	//},2500);
	},
    	init: function() { 
     $.ajax({
      url: sube_documentos_ajax.php,
     method: 'POST',
     data: getValues(),
		 processData: false, // required for FormData with jQuery
        contentType: false
	 });
  }		
});		


</script>
			<?php include_once('layouts/footer.php'); ?>