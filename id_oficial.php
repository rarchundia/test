<?php
  $page_title = 'Identificacion Oficial';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
?>
<?php
$id_varible= $_GET['id'];

/*if(!$recent_sales){
  $session->msg("d","Id de Contacto Desconocido.");
  redirect('pipedrive.php');
}*/
?>

<?php include_once('layouts/header.php'); ?>
<script src="drop/dropzone.js"></script>
<link rel="stylesheet" href="drop/dropzone.css">

<div class="row">

			
			
			
							<div class="col-md-12"><!--principio de contactos-->
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-file"></span>
            <span>Identificación Oficial</span>
          </strong>
        </div>
        <div class="panel-body">
			<div id="upload_proceso"></div>
		 
   <form method="post"  class="dropzone" action="sube_documentos_ajax.php" id="form_constitutiva" enctype="multipart/form-data">
    <input type="hidden" name="correo" id="correo" value="<?php echo $user["email"]?>">
       <div class="fallback">
		  <input type="file" name="archivo_contitutiva" id="archivo_contitutiva"/>
		   </div>
     <input type="hidden" name="empresa4" id="empresa4" value="<?php echo $id_varible; ?>" >
	<!-- <input type="text" name="empresa4" id="empresa4" value="<?php echo $id_varible; ?>" >
	-->  <br><br><br>
			</form>
			
		<?php $url=$_SERVER['HTTP_REFERER']; 
					$pos = strpos($url, "detalle_contacto.php");
	
			if($pos!==false){
			?>
			<a href="detalle_contacto.php?id=<?php echo (int)$id_varible; ?>" class="btn btn-primary" id="btn_siguiente">Regresar</a>
			
			
			<?php
			}else{
							?>
			<a href="comp_domicilio.php?id=<?php echo (int)$id_varible; ?>" class="btn btn-primary" id="btn_siguiente">Siguiente</a>
			
			<?php 
			}
			
			?>
			
			
			
				
		
			
			
			
			
			
			
			
			 </div>
   </div>
  </div>  	
			
		




			 















</div> <!--fin de row-->
		
			<script>
				function getValues() {
    var formData = new FormData();
    // these image appends are getting dropzones instances
    formData.append("empresa4", jQuery('#empresa4').val()); // attach dropzone image element
						formData.append("correo", jQuery('#correo').val());
    /*formData.append('image_2', $('#barfoo')[0].dropzone.getAcceptedFiles()[0]);
    formData.append("id", $("#id").val()); // regular text form attachment
    formData.append("_method", 'PUT'); // required to spoof a PUT request for a FormData object (not needed for POST request)
*/
    return formData;
}
				
		$("#form_constitutiva").dropzone({
    url: "sube_documentos_ajax.php",
			acceptedFiles: ".pdf",
			dictInvalidFileType: "Solo Se Aceptan Archivos PDF",
    dictDefaultMessage: "Arrastra El Archivo Aqui o Da Click.<br>-Documento Identificación Oficial-",
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
			
		</script>	
			
	
			
<?php include_once('layouts/footer.php'); ?>