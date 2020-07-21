<?php
  $page_title = 'Panel Archivos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(10);


?>
<?php 

	

if(isset($_POST['restaurar'])) {
    if(empty($errors)){
   $p_id_archivo= remove_junk($db->escape($_POST['id_archivo']));

		$sql = "UPDATE file SET estatus =0 WHERE id='{$p_id_archivo}'";
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Restaurado con Exito ");
           echo '<meta http-equiv="Refresh" content="0; url=archivos.php">';
			  //redirect('edit_user.php?id='.(int)$e_user['id'], false);
          } else {
            $session->msg('d',' Lo siento no se Pudo Restaurar Vuelve a Intentarlo.');
           echo '<meta http-equiv="Refresh" content="0; url=archivos.php">';			  //redirect('edit_user.php?id='.(int)$e_user['id'], false);
          }
    } else {
      $session->msg("d", $errors);
           echo '<meta http-equiv="Refresh" content="0; url=archivos.php">';
		//redirect('edit_user.php?id='.(int)$e_user['id'],false);
    }
  }








if(isset($_POST['eliminar_archivo'])) {
    if(empty($errors)){
   $p_id_archivo= remove_junk($db->escape($_POST['id_archivo']));

		$sql = "UPDATE file SET estatus =2 WHERE id='{$p_id_archivo}'";
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Eliminado  con Exito ");
           echo '<meta http-equiv="Refresh" content="0; url=archivos.php">';
			  //redirect('edit_user.php?id='.(int)$e_user['id'], false);
          } else {
            $session->msg('d',' Lo siento no se Pudo Eliminar Completamente Vuelve a Intentarlo.');
           echo '<meta http-equiv="Refresh" content="0; url=archivos.php">';			  //redirect('edit_user.php?id='.(int)$e_user['id'], false);
          }
    } else {
      $session->msg("d", $errors);
           echo '<meta http-equiv="Refresh" content="0; url=archivos.php">';
		//redirect('edit_user.php?id='.(int)$e_user['id'],false);
    }
  }



if(isset($_POST['carpeta'])) {
 
	
	if(empty($errors)){
         $p_carpeta_nombre= remove_junk($db->escape($_POST['nombre_carpeta']));
		$p_carpeta_descripcion= remove_junk($db->escape($_POST['descripcion']));
		$p_id_user= remove_junk($db->escape($_POST['id_user']));

		
		$alphabeth ="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";
	$code = "";
	for($i=0;$i<12;$i++){
	    $code .= $alphabeth[rand(0,strlen($alphabeth)-1)];
	}

	
	$code= $code;
		
		
		    $fecha    = make_date();
         $query = "INSERT INTO file (";
        $query .="code,filename,description,is_folder,is_public,user_id,created_at";
        $query .=") VALUES (";
        $query .=" '{$code}', '{$p_carpeta_nombre}', '{$p_carpeta_descripcion}','1','0', '{$p_id_user}','{$fecha}'";
        $query .=")";
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



if(isset($_POST['permisos'])) {
 
	
	if(empty($errors)){
         $p_id_archivo= remove_junk($db->escape($_POST['id_archivo']));
		$p_id_correo= remove_junk($db->escape($_POST['correo']));
		$p_id_user= remove_junk($db->escape($_POST['id_user']));

		
		$accion = find_by_id('users',(int)$p_id_correo);
		
		
		    $fecha    = make_date();
         $query = "INSERT INTO permision (";
        $query .="p_id, file_id, user_id, created_at, dueno";
        $query .=") VALUES (";
        $query .=" '1', '{$p_id_archivo}', '{$p_id_correo}','{$fecha}','{$p_id_user}'";
        $query .=")";
        if($db->query($query)){
          //sucess
			
			$destinatario = $accion['email']; 
$asunto = "Notificacion de Archivo Compartido"; 
$cuerpo = ' 
<!DOCTYPE html>
  <html lang="es">
    <head>
    <meta charset="UTF-8">

<title>Notificacion de Archivo Compartido</title>
 </head>
<body> 
<center><img src="http://envipaq.com.mx/images/logo.jpg" height="170">
<h1>Envipaq Notificaciones</h1> </center>
<p> 
<b>Buen dia, nos complace informarte que te han Compartido un Archivo por favor ingresa para poder visualizarlo <a href="http://sci.envipaq.com.mx/login" >Ingresar</a> </b></p> 
<img src="http://sci.envipaq.com.mx/login/uploads/medio_ambiente.jpg"  width="100%">

';







 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Notificaciones Envipaq <notificaciones@envipaq.com.mx>\r\n"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente 
//$headers .= "Reply-To: rarchundia@envipaq.com.mx\r\n"; 

//ruta del mensaje desde origen a destino 
$headers .= "Return-path: rarchundia@envipaq.com.mx\r\n";


//direcciones que recibián copia 
//$headers .= "Cc: rarchundia@envipaq.com.mx\r\n"; 

//direcciones que recibirán copia oculta 
$headers .= "Bcc: rarchundia@envipaq.com.mx\r\n"; 


$envio= mail($destinatario,$asunto,$cuerpo,$headers);
/*if($envio){
	
	echo '<meta http-equiv="Refresh" content="2; url=../index.php">
	
	
	<center><h1><strong><br><br><br><img src="http://envipaq.com.mx/images/logo.jpg" height="220"><br><br>Solicitud Ingresada Correctamente</strong></h2></center>
	
	;
	
	}else{
		
    echo '<meta http-equiv="Refresh" content="3; url=../index.php">
	
	<center><h1><strong><br><br><br><img src="http://envipaq.com.mx/images/logo.jpg" height="220"><br><br>Fallo al Ingresar la Solicitud Intenta Otra Vez</strong></h2></center>';
}*/
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
          $session->msg('s'," Permiso Otrogado");
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











if(isset($_POST['boton_de_envio'])) {
 
	
	if(empty($errors)){
        $id_user=$_POST["id_user"];
	$folder=$_POST["folder_id"];
	$descripcion=$_POST["descripcion"];
	$alphabeth ="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";
	$code = "";
	for($i=0;$i<12;$i++){
	    $code .= $alphabeth[rand(0,strlen($alphabeth)-1)];
	}

	$code= $code;
	
	
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/$date    = make_date();
	
$uploaddir = "archivos_fact";
	
		
		
		
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$date"."$uploadfile";

rename($_FILES['file']['tmp_name'],"archivos_fact/$nombre_actual");
	
		
         $query = "INSERT INTO file (";
        $query .="code, filename, description, is_public, user_id, is_folder, folder_id, created_at";
        $query .=") VALUES (";
        $query .=" '{$code}', '{$nombre_actual}', '{$descripcion}', '0', '{$id_user}', '0', '{$folder}', '{$date}'";
        $query .=")";
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

?>




<?php include_once('layouts/header.php');
  $folders= folders($user['id']);
$listar_archivos=listar_archivos($user['id']);

$papelera=papelera($user['id']);
?>
  <?php echo display_msg($msg); ?>
<script src="drop/dropzone.js"></script>

<link rel="stylesheet" href="drop/dropzone.css">

  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-file"></span>
          <span>Mis Archivos 
			  
			  
			  
			  
			  
			  <div class="col-md-4 pull-right">
					<div id="panel_input">
						<input type="text" style="border-color: rgb(255, 144, 0);
    box-shadow: 0 1px 1px rgba(229, 103, 23, 0.075)inset, 0 0 8px rgba(255,144,0,0.6);" class="form-control" autofocus placeholder="Busca por Nombre o por Descripcción "  id="q" onkeyup="load(1);" />
			</div>	  
				  <div id="form2_input" style="display:none">
					  <input type="text" style="border-color: rgb(255, 144, 0);
    box-shadow: 0 1px 1px rgba(229, 103, 23, 0.075)inset, 0 0 8px rgba(255,144,0,0.6);" class="form-control" placeholder="Busca por Nombre o por  Descripcción "  id="q1" onkeyup="b_migo(1);" />
					  
        </div>
		</div>	  
                                        
                                    
			  </div></span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-12">
          
			
			<div class="card" style="width: 25%;">
  <ul class="list-group list-group-flush">
   
	  <li class="list-group-item">
		  
	<strong data-toggle="modal" data-target="#nueva_carpeta"> <i class="glyphicon glyphicon-folder-open"></i>  Crear Nueva Carpeta</strong>
		  
		  <div class="modal fade" id="nueva_carpeta"  tabindex="-1" role="dialog" aria-labelledby="nueva_carpeta" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button> <h5 class="modal-title" id="exampleModalLabel"> <i class="glyphicon glyphicon-folder-open"></i>   Nueva Carpeta</h5>
       
         
      </div>
      <div class="modal-body">
       <form role="form" action="archivos.php" method="post"><!-- form start -->
                           
		   
		   
		   
		   
		   
		   
                                <div class="form-group">
                                    <label for="name_folder">Nombre</label>
                                    <input type="text" name="nombre_carpeta" class="form-control" id="nombre_carpeta" placeholder="Nombre de la carpeta" onkeyup="mayus(this);">
									<input type="hidden" name="id_user" class="form-control" value="<?php echo $user['id']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea class="form-control" name="descripcion" rows="3" placeholder="Descripción ..." onkeyup="mayus(this);"></textarea>
                                </div>
                                
                          
                            
      </div>
      <div class="modal-footer">
         <button type="submit" name="carpeta" id="carpeta" class="btn btn-primary">Crear Carpeta  <i class="glyphicon glyphicon-folder-open"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>
	  
	  
	  </li>
	  
	  
	  
	  
	  
	  
	  
	  
	 
	  
	  
	  
	  
	  
    <li class="list-group-item">
	  
	  <strong data-toggle="modal" data-target="#subir_archivo">
		  <i class="glyphicon glyphicon-cloud-upload"></i> Subir Archivo </strong>
	  
	 
		
		
		<div class="modal fade" id="subir_archivo" tabindex="-1" role="dialog" aria-labelledby="subir_archivo" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		  <h5 class="modal-title" id="exampleModalLabel"> <i class="glyphicon glyphicon-cloud"></i> <i class="glyphicon glyphicon-upload"></i> <strong>Subir Archivo</strong><div id="upload_proceso"></div></h5>
        
      </div>
      <div class="modal-body"><!--class="dropzone"-->
		  
		      <form method="post"  class="dropzone" action="sube_documentos_ajax.php" id="form_constitutiva" enctype="multipart/form-data">
    
    			  <input type="hidden" name="id_user" id="id_user" value="<?php echo $user['id']; ?>" >
				  
				  <div class="form-group">
                                    <label>Carpeta</label>
                                    <select class="form-control select2" required name="folder_id" id="folder_id">
                                      <option value="" selected="selected">---Seleciona Una Carpeta Para Subir los Archivos---</option>
                                      <?php foreach($folders as $fld ):?>
                                      <option value="<?php echo $fld['id'];?>"><?php echo $fld['filename'];?></option>
                                      <?php endforeach; ?>
                                    </select>
                                </div>
				  <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea name="descripcion" id="descripcion" onkeyup="mayus(this);" class="form-control" rows="3" placeholder="Agrega Una Descripción al  Archivo"></textarea>
                                </div>
				  
				  <div class="fallback">
				  <input type="file" name="archivo_contitutiva" id="archivo_contitutiva"/>
	</div>
				  <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
				 
			</form>  
      
   
			  
		  
		  
      
      </div>
      <div class="modal-footer">
        
		  <a href="archivos.php" class="btn btn-info" id="id_subir" style="display: none;" >Subir</a>
		
		
      </div>
    </div>
  </div>
</div>
		
		
		
		
	  
	  
	  </li>
    <li class="list-group-item"><strong id="muestra">
		  <i class="glyphicon glyphicon-level-up"></i> Compartidos Conmigo </strong>
		
		
		</li>
	  
	    </li>
    <li class="list-group-item"><strong id="muestra"  data-toggle="modal" data-target="#modal_basura">
		  <i class="glyphicon glyphicon-trash" ></i> Papelera </strong>
		
		
		
		
		
		
		
		 <!--principio modal basura-->
		<div class="modal fade" id="modal_basura" tabindex="-1" role="dialog" aria-labelledby="modal_basura" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		  <h5 class="modal-title" id="exampleModalLabel"><i class="glyphicon glyphicon-trash" ></i> Papelera</h5>
        
      </div>
      <div class="modal-body">
        
		  <table class="table table-striped table-hover table-responsive">
				 <thead>
                                    <tr>
                                        <th>Archivo</th>
                                        <th>Descripción</th>
					                    <th>Acciones</th>
                                    </tr>
                                </thead> 
				<tbody>	
					<?php foreach($papelera as $pape ):?>
                                     
                                     
				<td><?php echo substr($pape['filename'], 19); ?></td>	
				<td><?php echo $pape['description'];?></td>	
				<td>
					<form role="form" action="archivos.php" method="post">
											<input type="hidden" name="id_archivo" value="<?php echo $pape['id'];?>"/>
										
									<button type="submit" name="restaurar" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-repeat"></i> Restaurar</button>
											
											</form>
					
					<form role="form" action="archivos.php" method="post">
											<input type="hidden" name="id_archivo" value="<?php echo $pape['id'];?>"/>
										
									<button type="submit" name="eliminar_archivo" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
											
											</form>
					
					
					</td>	
					 <?php endforeach; ?>
					<tbody>
		  </table>	
		  
		  
		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
     
      </div>
    </div>
  </div>
</div>  <!--fin modal basura-->
		
		
		
		
		
		
		</li>
  </ul>
</div>
			
			
			
			
			
			
			
			
			
			
<!--			comienzo de mostrar archivos-->
			<div id="panel"> <!--			panel predeterminado de vista-->
			
			  <div id="loader"></div><!-- Carga de datos ajax aqui -->
			<div id="resultados"></div><!-- Carga de datos ajax aqui -->
			<div class='outer_div'>
			  <!--id="muestra"                este es para abrir el toogle fade in fade out-->
			  
			  </div><!-- Carga de datos ajax aqui -->
				<!--			fin de mostrar archivos-->
			
        </div><!--			fin de panel predeterminado de vista-->
			
			
			
			
			<div id="form2" style="display:none"> <!--			panel  oculto-->
	
          
			  <div class="card" style="width: 30rem;">
			  <ul class="list-group list-group-flush">
   
	  <li class="list-group-item">
		  <strong id="regresa">
		  <i class="glyphicon glyphicon-arrow-left"></i>  Regresar </strong>
				  </li>
				  </ul>
			  </div>
		  
		 
		  
		 
				<div id="loader1"></div><!-- Carga de datos ajax aqui -->
			<div id="resultados1"></div><!-- Carga de datos ajax aqui -->
			<div class='outer_div1'>
			  <!--id="muestra"                este es para abrir el toogle fade in fade out-->
			  
			  </div><!-- Carga de datos ajax aqui -->
				<!--			fin de mostrar archivos-->
				
		  
		  </div><!--			fin de panel  oculto-->
		  
		  </div>

      </div>

    </div>
  </div>
<script>
	
	$(function() {
			load(1);
		});
		
	function load(page){
			var querys=$("#q").val();
			var parametros = {"action":"ajax",'query':querys, 'usuario':<?php echo $user['id'];?>};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'listar_carpetas.php',
				data: parametros,
				 beforeSend: function(objeto){
				$("#loader").html("Cargando...");
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$("#loader").html("");
				}
			})
		}
		
		
		
		$(function() {
			b_migo(1);
		});
		function b_migo(page){
			var querys=$("#q1").val();
			var parametros = {"action":"ajax1",'query':querys, 'usuario':<?php echo $user['id'];?>};
			$("#loader1").fadeIn('slow');
			$.ajax({
				url:'listar_compartidos.php',
				data: parametros,
				 beforeSend: function(objeto){
				$("#loader1").html("Cargando...");
			  },
				success:function(data){
					$(".outer_div1").html(data).fadeIn('slow');
					$("#loader1").html("");
				}
			})
		}
		
		
		
		
		
		
		
$(document).ready(function() {
     $('#carpeta').prop('disabled', true);
     $('#nombre_carpeta').keyup(function() {
        if($(this).val() != '') {
           $('#carpeta').prop('disabled', false);
        }
     });
 });
	
	
	
function getValues() {
    var formData = new FormData();
    // these image appends are getting dropzones instances
    formData.append("id_user", jQuery('#id_user').val());
	formData.append("folder_id", jQuery('#folder_id').val());
	formData.append("descripcion", jQuery('#descripcion').val());
	
	// attach dropzone image element
    /*formData.append('image_2', $('#barfoo')[0].dropzone.getAcceptedFiles()[0]);
    formData.append("id", $("#id").val()); // regular text form attachment
    formData.append("_method", 'PUT'); // required to spoof a PUT request for a FormData object (not needed for POST request)
*/
    return formData;
}
				
		
	$(".dropzone").dropzone({
    url: "sube_documentos_ajax.php",
			
    dictDefaultMessage: "Arrastra El Archivo Aqui o Da Click.<br>-Para Cargar Documento-",
		maxFilesize: 500, // MB
                maxFiles: 1,
		paramName: "file",
			addRemoveLinks: true,
		timeout: 180000,
		
		accept: function(file, done) {
   if ($('#folder_id').val().trim() === '') {
        alert('Debes Primero Seleccionar Una Carpeta');
	   location.reload();
	   
   } 
      else { 
		  
		 
		  done();
		   
		   }
  },
		
		
			uploadprogress:function(file, response){
                console.log('WE NEVER REACH THIS POINT.');
				
				$("#upload_proceso").html("<h2><center>Subiendo espera <img src='libs/images/ajax-loader.gif'></center></h2>").fadeIn;
                            },
			
	success: function(file, response){
                console.log('WE NEVER REACH THIS POINT.');
              $('#id_subir').show();

		$("#upload_proceso").html("<h2><center>Carga Completa</center></h2>").fadeIn;
    setTimeout(function() {   
		$("#upload_proceso").html("<h2><center>Carga Completa</center></h2>").fadeOut(100);
	},2500);
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
	
	
	
	
	
	
	
	
				
						
					
					
					

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*$(".dropzone").dropzone({
    url: "sube_documentos_ajax.php",
			
    dictDefaultMessage: "Arrastra El Archivo Aqui o Da Click.<br>-Para Cargar Documento-",
			maxFilesize: 10, // MB
                maxFiles: 1,
			addRemoveLinks: true,
			uploadprogress:function(file, response){
                console.log('WE NEVER REACH THIS POINT.');
				
				$("#upload_proceso").html("<h2><center>Subiendo espera <img src='libs/images/ajax-loader.gif'></center></h2>").fadeIn;
                            },
			
	success: function(file, response){
                console.log('WE NEVER REACH THIS POINT.');
              $('#id_subir').show();

		$("#upload_proceso").html("<h2><center>Carga Completa</center></h2>").fadeIn;
    setTimeout(function() {   
		$("#upload_proceso").html("<h2><center>Carga Completa</center></h2>").fadeOut(100);
	},2500);
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
});			*/
			
			
			
</script>
<?php include_once('layouts/footer.php'); ?>
