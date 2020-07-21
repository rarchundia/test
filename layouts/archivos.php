<?php
  $page_title = 'Panel Archivos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(10);


?>
<?php 

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
          redirect('archivos.php', false);
        } else {
          //failed
          $session->msg('d',' No se pudo Crear la Carpeta.');
          redirect('archivos.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('archivos.php',false);
   }
 }



if(isset($_POST['permisos'])) {
 
	
	if(empty($errors)){
         $p_id_archivo= remove_junk($db->escape($_POST['id_archivo']));
		$p_id_correo= remove_junk($db->escape($_POST['correo']));
		$p_id_user= remove_junk($db->escape($_POST['id_user']));

		
		
		
		
		    $fecha    = make_date();
         $query = "INSERT INTO permision (";
        $query .="p_id, file_id, user_id, created_at";
        $query .=") VALUES (";
        $query .=" '1', '{$p_id_archivo}', '{$p_id_user}','{$fecha}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s'," Permiso Otrogado");
          redirect('archivos.php', false);
        } else {
          //failed
          $session->msg('d',' No se pudo Crear la Carpeta.');
          redirect('archivos.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('archivos.php',false);
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
          redirect('archivos.php', false);
        } else {
          //failed
          $session->msg('d',' No se pudo Crear la Carpeta.');
          redirect('archivos.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('archivos.php',false);
   }
 }

?>




<?php include_once('layouts/header.php');
  $folders= folders($user['id']);
$listar_archivos=listar_archivos($user['id']);
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
          
			
			<div class="card" style="width: 30rem;">
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
		  <i class="glyphicon glyphicon-arrow-up"></i> Subir Archivo </strong>
	  
	 
		
		
		<div class="modal fade" id="subir_archivo" tabindex="-1" role="dialog" aria-labelledby="subir_archivo" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		  <h5 class="modal-title" id="exampleModalLabel"> <i class="glyphicon glyphicon-cloud"></i> <i class="glyphicon glyphicon-upload"></i> Subir Archivo <div id="upload_proceso"></div></h5>
        
      </div>
      <div class="modal-body"><!--class="dropzone"-->
		  
		      <form method="post"  action="sube_documentos_ajax.php" id="form_constitutiva" enctype="multipart/form-data">
    
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
				  <input type="submit">
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
		  <i class="glyphicon glyphicon-arrow-up"></i> Compartidos Conmigo </strong>
		
		
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
			var parametros = {"action":"ajax",'query':querys, 'usuario':<?php echo $user['id'];?>};
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
			//maxFilesize: 64, // MB
                maxFiles: 1,
		paramName: "file",
			addRemoveLinks: true,
		
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
	
	
	
	
	
	
	
	
				
						
					
					
					

	
	
	
	$(document).ready(function() {
    var percent = 0;
 
    timerId = setInterval(function() {
        //increment progress bar
        percent += 5;
        $('.progress-bar').css('width', percent+'%');
        $('.progress-bar').attr('aria-valuenow', percent);
        $('.progress-bar').text(percent+'%');
 
        //complete
        if (percent == 100) {
            clearInterval(timerId);
            $('.information').show();
        }
 
    }, 1000);
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
