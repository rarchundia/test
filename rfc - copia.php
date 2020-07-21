<?php
  $page_title = 'RFC';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(5);
?>
<?php
$id_varible= $_GET['id'];

/*if(!$recent_sales){
  $session->msg("d","Id de Contacto Desconocido.");
  redirect('pipedrive.php');
}*/
?>

<?php include_once('layouts/header.php'); ?>
<style>
	
	
	.dropzone a.dz-remove,
.dropzone-previews a.dz-remove {
  background-image: -webkit-linear-gradient(top, #fafafa, #eee);
  background-image: -moz-linear-gradient(top, #fafafa, #eee);
  background-image: -o-linear-gradient(top, #fafafa, #eee);
  background-image: -ms-linear-gradient(top, #fafafa, #eee);
  background-image: linear-gradient(to bottom, #fafafa, #eee);
  -webkit-border-radius: 2px;
  border-radius: 2px;
  border: 1px solid #eee;
  text-decoration: none;
  display: block;
  padding: 4px 5px;
  text-align: center;
  color:black;
  margin-top: 26px;
}
.dropzone a.dz-remove:hover,
.dropzone-previews a.dz-remove:hover {
  color: #666;
}

</style>
<script src="drop/dropzone.js"></script>
<div id="resp"></div>
<link rel="stylesheet" href="drop/dropzone.css">

<div class="row">

			
			
			
							<div class="col-md-12"><!--principio de contactos-->
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-user"></span>
            <span>RFC </span>
          </strong>
        </div>
        <div class="panel-body">
			
		 
   <form method="post"  class="dropzone" action="sube_documentos_ajax.php" id="form_constitutiva" enctype="multipart/form-data">
    
       <div class="fallback">
		  <input type="file" name="archivo_contitutiva" id="archivo_contitutiva"/>
		   </div>
     <input type="hidden" name="empresa1" id="empresa1" value="<?php echo $id_varible; ?>" >
	   <!-- <input type="text" name="empresa1" id="empresa1" value="<?php echo $id_varible; ?>" >
	  --><br><br><br>
	  	</form>
			
			<a href="situacion_fiscal.php?id=<?php echo (int)$id_varible; ?>" class="btn btn-primary" id="btn_siguiente">Siguiente &raquo;</a>
			
				
		
			
			
			
			
			
			
			
			 </div>
   </div>
  </div>  	
			
		




			 















</div> <!--fin de row-->
		
			
			<script>
				function getValues() {
    var formData = new FormData();
    // these image appends are getting dropzones instances
    formData.append("empresa1", jQuery('#empresa1').val()); // attach dropzone image element
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
    dictDefaultMessage: "Arrastra El Archivo Aqui o Da Click.",
			maxFilesize: 10, // MB
                maxFiles: 1,
			addRemoveLinks: true,
			
			
		
                  
			
			
		/*	sending: function(file, xhr, formData) {
   formData.append("empresa1", jQuery('#empresa1').val());  //name and value
   formData.append("insurance_expirationdate", ins_Date); //name and value
$("form").find("input").each(function(){

        formData.append($(this).attr("empresa1"), $(this).val());
	 });
},*/
		
			
			
			
		init: function() { 
     $.ajax({
      url: sube_documentos_ajax.php,
     method: 'POST',
     data: getValues(),
		 processData: false, // required for FormData with jQuery
        contentType: false, 
     // dataType: 'json',
      success: function(response){
		  done("cargado");
      }
    });
  }

			
	  
										 
										 
			
			  
			
			
			/*
					
				
		  formData.append('empresa1', jQuery('#empresa1').val()),
	       $("form").find("input").each(function(){

        formData.append($(this).attr("empresa1"), $(this).val());
		

    });
    */
    //params: {'param_1':'xyz','para_2':'aaa'}
});		
				
				
				
				
/*				$(function(){
  Dropzone.options.form_constitutiva = {
    maxFilesize: 5,
    addRemoveLinks: true,
    dictResponseError: 'Server not Configured',
    acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
    init:function(){
      var self = this;
      // config
      self.options.addRemoveLinks = true;
      self.options.dictRemoveFile = "Delete";
      //New file added
      self.on("addedfile", function (file) {
        console.log('new file added ', file);
      });
      // Send file starts
      self.on("sending", function (file) {
        console.log('upload started', file);
        $('.meter').show();
      });
      
      // File upload Progress
      self.on("totaluploadprogress", function (progress) {
        console.log("progress ", progress);
        $('.roller').width(progress + '%');
      });

      self.on("queuecomplete", function (progress) {
        $('.meter').delay(999).slideUp(999);
      });
      
      // On removing file
      self.on("removedfile", function (file) {
        console.log(file);
      });
    }
  };
})
	*/			
/*myDropzone.on('sendingmultiple', function(data, xhr, formData) {

   formData.append('empresa1', jQuery('#empresa1').val());
	acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",

       $("form").find("input").each(function(){

        formData.append($(this).attr("empresa1"), $(this).val());
		

    });

	
    }

});*/

			
			
			
			
					
			/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$(document).on('ready',function(){

      $('#btn-ingresar').click(function(){
        var url = "sube_documentos_ajax.php";                                      

        $.ajax({                        
           type: "POST",                 
           url: url,                    
           data: $("#formulario").serialize(),
			beforeSend: function () {
                        $("#resp").html("Procesando, espere por favor...");
                },
           success: function(data)            
           {
             $('#resp').html(data);           
           }
         });
      });
    });
    */
			
			
		</script>	
			
	
			
<?php include_once('layouts/footer.php'); ?>