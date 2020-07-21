<?php
  $page_title = 'Archivos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(10);

$id_carpeta=$_GET['id'];
  ?>
<?php
 
if(isset($_POST['eliminar_archivo'])) {
    if(empty($errors)){
            
       $id_archivo =$_POST['id_archivo'];
            $sql = "UPDATE file SET estatus ='1' WHERE id='{$id_archivo}'";
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Archivo Eliminado ");
          echo '<meta http-equiv="Refresh" content="0; url=carpetas.php?id='.$id_carpeta.'">';
				  //redirect('edit_user.php?id='.(int)$e_user['id'], false);
          } else {
            $session->msg('d',' Lo siento no se Pudo Eliminar el Archivo.');
            echo '<meta http-equiv="Refresh" content="0; url=carpetas.php?id='.$id_carpeta.'">';
		}
    } else {
      $session->msg("d", $errors);
         echo '<meta http-equiv="Refresh" content="0; url=carpetas.php?id='.$id_carpeta.'">';
		//redirect('edit_user.php?id='.(int)$e_user['id'],false);
    }
  }



?>
<?php include_once('layouts/header.php'); ?>
  <?php echo display_msg($msg); ?>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
         <a href="archivos.php" class="btn-sm" title="Regresar" data-toggle="tooltip"><span class="glyphicon glyphicon-chevron-left"></span><span class="glyphicon glyphicon-chevron-left"></span></a>
			<span class="glyphicon glyphicon-file"></span>
          <span>Archivos  <div class="col-md-5 pull-right">
						<input type="text" style="border-color: rgb(255, 144, 0);
    box-shadow: 0 1px 1px rgba(229, 103, 23, 0.075)inset, 0 0 8px rgba(255,144,0,0.6);" class="form-control" autofocus placeholder="Busca por Nombre o Descripcción "  id="q" onkeyup="load(1);" />
        </div></span>
       </strong>
      </div>
      
        <div class="col-md-12">
			
			
			<div id="loader"></div><!-- Carga de datos ajax aqui -->
			<div id="resultados"></div><!-- Carga de datos ajax aqui -->
			<div class='outer_div'>
			  <!--id="muestra"                este es para abrir el toogle fade in fade out-->
			  
			  </div><!-- Carga de datos ajax aqui -->
				<!--			fin de mostrar archivos-->
			
         
  

      </div>

    </div>
  </div>


<script>
	
	$(function() {
			load(1);
		});
		function load(page){
			var querys=$("#q").val();
			var parametros = {"action":"ajax",'query':querys, 'usuario':<?php echo $user['id'];?>, 'carpeta':<?php echo $id_carpeta;?>};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'listar_archivos.php',
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
		
		
		
		
</script>

<?php include_once('layouts/footer.php'); ?>
