<?php
  $page_title = 'Memo';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
$usuarios_envia=users_activos();
$envia_notificacion=envia_notificacion_memo();

$date    = make_date();
?>


<?php 

if(isset($_POST['memo'])){
 

 $p_asunto= remove_junk($db->escape($_POST['asunto']));
  $p_quien_genera = remove_junk($db->escape($_POST['quien_genera']));
	$p_contenido = remove_junk($db->escape($_POST['contenido']));
 
 
    if(empty($errors)){
     
	 
     
     $query  = "INSERT INTO memo (";
     $query .=" asunto, contenido, fecha, id_quien_genera";
     $query .=") VALUES (";
     $query .="'{$p_asunto}','{$p_contenido}','{$date}','{$p_quien_genera}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
		 
       $consulta_id_memo=id_memo($p_quien_genera);
	 
		 
		// $sql="INSERT INTO `memo_compartido`(`id`, `id_memo`, `id_quien_lo_ve`, `fecha_enviado`, `fecha_visto`, `veces_descargado`) VALUES (";
		 foreach ($_POST["usuarios"] as $usuarios_mandar):
		  $sql="INSERT INTO memo_compartido(id_memo, id_quien_lo_ve ) VALUES ('{$consulta_id_memo["id"]}','{$usuarios_mandar}')";
		  $db->query($sql);
			 endforeach; 
			  
		$session->msg('s',"Memo Guardado ");
     echo '<meta http-equiv="Refresh" content="0; url=memo.php">';	 
		 //  redirect('memo.php', false);
   
	 }
	    else {
       $session->msg('d',' Lo siento, Falló al Guardar el Memo.');
       redirect('memo.php', false);
	   }

   } else{
     $session->msg("d", $errors);
     redirect('memo.php',false);
   }

 }
 
 

?>

<style>
	body{background-color: white;
	}

	#nuevo{background: white;}
	#creados{background: white;}
	#memos_ver{background: white;}
</style>
<?php include_once('layouts/header.php');
$mis_memos=mis_memos_creados($user['id']);
?>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-12">
     <div class="panel panel-default">
       <div class="panel-heading">
        
          <span class="glyphicon glyphicon-list-alt"></span>
          Memos 
       </div>
       <div class="panel-body">
		   
		   <div class="container">
  <div class="col-md-2">
	  
  <ul class="nav nav-pills nav-stacked">
    <li class="active"><a data-toggle="pill" href="#memos_ver">Memos para Ver</a></li>
    
   
  </ul>
			   </div>
			   <div class="col-md-10">
  <div class="tab-content">
    <div id="nuevo" class="tab-pane fade in ">
   <div class="col-md-10">
	   
	   <center> <h3>Generar Nuevo Memo</h3></center>
		
		<form method="post" action="memo.php" class="clearfix">
                    <div class="form-group">
                <div class="row">
                   <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-pencil"></i>
                  </span>
                  <input type="text" class="form-control" name="asunto" placeholder="Asunto (Titulo)" autofocus  onkeyup="mayus(this);">
               </div></div>
               <input type="hidden" class="form-control" name="quien_genera" value="<?php echo $user['id']?>">
               </div></div>
              				 
				 
				 <div class="form-group">
                <div class="row">
		   
                <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-pencil"></i>
                  
                  </span>
					<textarea name="contenido" class="form-control" placeholder="Escribe todo el contenido " onkeyup="mayus(this);" rows="15"></textarea>
               
               </div></div></div></div>
               
          
 
   
     
		   
		
		
				</div>
			<div class="col-md-2">
			
			<h3>Usuarios</h3>
				<input type="button" id="BtnSeleccionar" class="btn btn-info btn-block" value="Seleccionar todos">
 <div id="checkbox_usuarios">
				<?php foreach ($usuarios_envia as $users):?>
				
				 <div class="checkbox">
  <label><input type="checkbox" name="usuarios[]" value="<?php echo   $users['id'];?>"><?php echo   $users['name'];?></label>
</div> 
				<?php endforeach; ?> 
			
				</div>	</div>
	     <button type="submit" name="memo" class="btn btn-danger btn-block"> Generar<button>
				</form>
    </div>
    <div id="creados" class="tab-pane fade">
     <center> <h3>Mis memos Creados</h3></center>
       <?php 
			 
			
			   ?>
		
		
		<table class="table table-striped table-hover table-responsive table-fixed "> <!--table-bordered-->
            <thead>
              <tr>
				  <th class="text-center">Abrir</th>
                 <th class="text-center">Resumen</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Usuarios Enviados</th>
				  
				 
              </tr>
            </thead>
            <tbody id="myTable">
				
				
              <?php  foreach ($mis_memos as $memos):?>
              <tr>
				  <td class="text-center">
					  
					  <br><a   onclick="window.open('pdf_memo.php?id=<?php echo ($memos['id']);?>&user=<?php echo ($user['id']);?>', 'Memo', 'width=700, height=600'); return false" title="Ver PDF" data-toggle="tooltip">
					  
			 <?php echo remove_junk($memos['asunto']);?> Abrir</a> </td>
				
				  
				<td class="text-center"><strong><br><strong><?php echo remove_junk($memos['resumen']);?>...</strong></td>

								<td class="text-center"><strong><strong><?php echo ($memos['fecha']);?></strong></td>

								<td class="text-center">
									
      <?php 
									$compartidos=mis_memos_enviados($memos['id']);
									
									foreach ($compartidos as $aquien_comparti):
									
									?>
									
									
									<div class="card" style="width: 14rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">
		<img src="uploads/users/<?php echo $memos['image'];?>"  style="width:80px" ><br>
		<?php echo ($aquien_comparti['name']);?><br>
		<?php if($aquien_comparti['fecha_visto']==0 ){
											?>
								<img src="libs/images/no_visto.png" width="25px" data-toggle="tooltip" title="Enviado">
		
		<?php	}else{

	?>
		<img src="libs/images/visto.png" width="25px" data-toggle="tooltip" title="Visto" >
		
		<?php
}
									
									?>
	  </li>

  </ul>
</div>
				<?php 	endforeach; ?>						
									
									</td>

								
</tr>

			<?php 	endforeach; ?>
			</tbody>
		</table>		
					
					
	   </div>
    <div id="memos_ver" class="tab-pane fade in active">
      <center><h3>Memos para Visualizar</h3></center>
    		<?php 
		$memos_que_me_han_enviado=memos_por_usuario($user['id']);  
    
		
		?>
		
		
		<table class="table table-striped table-hover table-responsive table-fixed "> <!--table-bordered-->
            <thead>
              <tr>
				  <th class="text-center">Abrir</th>
                  <th class="text-center">Asunto</th>
				  <th class="text-center">Resumen</th>
                <th class="text-center">Fecha  de Envio</th>
				  <th class="text-center">Visto</th>
               
				  
				 
              </tr>
            </thead>
            <tbody id="myTable">
		<?php  foreach ($memos_que_me_han_enviado as $memos):?>
              <tr>
				  <td class="text-center">
	
					  <br><a   onclick="window.open('pdf_memo.php?id=<?php echo ($memos['id_de_memo']);?>&user=<?php echo ($user['id']);?>', 'Memo', 'width=700, height=600'); return false" title="Ver PDF" data-toggle="tooltip">
					  
			 <?php echo count_id();?> Abrir</a> </td>
				<td class="text-center"><br><strong><br><strong><?php echo remove_junk($memos['asunto']);?></strong></td>
				<td class="text-center"><strong><strong><?php echo remove_junk($memos['resumen']);?>...</strong></td>

								<td class="text-center"><strong><br><strong><?php echo ($memos['fecha_enviado']);?></strong></td>

								
				
								<td class="text-center">
				  
				  
				  <?php if($memos['fecha_visto']==0 ){
											?>
								<img src="libs/images/no_visto.png" width="25px" data-toggle="tooltip" title="Pendiente">
		
		<?php	}else{

	?>
		<img src="libs/images/visto.png" width="25px" data-toggle="tooltip" title="Visto" >
		
		<?php
}
									
									?>
				  
				  
				  </td>	
					
								
</tr>

			<?php 	endforeach; ?>
			</tbody>
		</table>				
									
		
		</div>
    
  </div>
</div>
		   </div>
		   
		   
		   
		   
		   
		   
		     
	
		   
       
  
  

 </div>
			   

			   
			   <?php 
			  foreach ($envia_notificacion as $notificacion):
			   $id_memo=$notificacion['id_memo'];
			 $destinatario = $notificacion["email"]; 
$asunto = "Avisos Envipaq"; 
$cuerpo = ' 
<!DOCTYPE html>
  <html lang="es">
    <head>
    <meta charset="UTF-8">

<title>Tienes un nuevo memo que revisar</title>
 </head>
<body> 
<center><img src="http://envipaq.com.mx/images/logo.jpg" height="180">
<h1>Nuevo memo</h1> </center><br><br>
<h3>Te han mandado un nuevo memo que tienes que revisar ingresa a sci o da click 
		<a href="http://sci.envipaq.com.mx/login/memo.php" target="_blank">aqui</a> </h3><br><br>
		<img src="http://sci.envipaq.com.mx/login/uploads/medio_ambiente.jpg"  width="100%">
		
		'; 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Avisos Envipaq <avisos@envipaq.com.mx>\r\n"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente 
$headers .= "Reply-To: rarchundia@envipaq.com.mx\r\n"; 

//ruta del mensaje desde origen a destino 
$headers .= "Return-path: rarchundia@envipaq.com.mx\r\n";


//direcciones que recibián copia 
//$headers .= "Cc: rarchundia@envipaq.com.mx\r\n"; 

//direcciones que recibirán copia oculta 
$headers .= "Bcc: rarchundia@envipaq.com.mx\r\n"; 


$envio= mail($destinatario,$asunto,$cuerpo,$headers);
				
	 $memo_update_envio="UPDATE memo_compartido SET fecha_enviado='{$date}', enviado_notf='1' WHERE id='{$id_memo}'";
		 $result = $db->query($memo_update_envio);
			   if($result && $db->affected_rows() === 1){
			
					 
			   }

				 endforeach; 
			
			   
			   ?>
			   <script>
			   
			   
			   
			   $(document).ready(function() {
  selected = true;
  $('#BtnSeleccionar').click(function() {
    if (selected) {
      $('#checkbox_usuarios input[type=checkbox]').prop("checked", true);
      $('#BtnSeleccionar').val('Deseleccionar');
    } else {
      $('#checkbox_usuarios input[type=checkbox]').prop("checked", false);
      $('#BtnSeleccionar').val('Seleccionar todos');
    }
    selected = !selected;
  });
});
				   
				   
				   
			   
			   </script>
<?php include_once('layouts/footer.php'); ?>
