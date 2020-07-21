
<?php
  $page_title = 'Acciones';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
include_once('layouts/header.php');



$correo = correo();
$accion = find_by_id('file',(int)$_GET['id']);
  if(!$accion){
    $session->msg("d","Archivo Desconocido.");
    echo '<meta http-equiv="Refresh" content="0; url=archivos.php">';
	  //redirect('pipedrive.php');
  }

 $usuario=$user['id']; 
?>
  <script>
      $(document).ready(function()
      {
         $("#acciones").modal("show");
      });
    </script>
<label class=" glyphicon glyphicon-plus-sign pull-right"  data-toggle="modal" data-target="#acciones" title="Agregar Contacto" style="font-size:30px;"></label>


		






<!--				principio de agregar cita-->
							
				<div class="modal fullscreen-modal fade" id="acciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog modal-dialog-centered" role="document">
   
		<div class="modal-content">
      <div class="modal-header">
        
		<a href="archivos.php">  <button type="button" class="close"  aria-label="Close"><span aria-hidden="true">&times;</span></button></a>
        <h4 class="modal-title" id="exampleModalLabel"><strong><center>Agregar Permisos  <?php echo substr($accion["filename"], 19); ?></center>
			 
			</strong></h4>
      </div><div class="modal-body">
		<h3>
			
		
		
		<form method="post" action="archivos.php" role="form"><!-- form start -->
          	<input type="hidden" class="form-control" name="id_user" value="<?php echo $user['id']; ?>">
			<input type="hidden" class="form-control" name="id_archivo" value="<?php echo $accion["id"]; ?>">
			
		                    <div class="box-body">
                                
                                <div class="form-group">
                                    <select class="form-control" required name="correo" id="correo">
                                      <option value="" selected="selected">---Seleciona Una Correo Para Compartir el  Archivo---</option>
                                      	<?php foreach($correo as $corre_o ):?>
                                     <option value="<?php echo $corre_o['id'];?>"><?php echo $corre_o['email'];?></option> 
										<?php endforeach; ?>
                                    </select>
                                    
                                   	
										
										
                                    
								
									
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                 <button type="submit" name="permisos" class="btn btn-primary pull-right">Otorgar Permisos</button><br>
                            </div>
                        </form>
</form>
		
		
		
		
		</h3></div>
		
			
			
		  
      <div class="modal-footer">
       
        </a>
      </div>
    </div>
		
  </div></div>



<!--fin agregar cita-->

<?php include_once('layouts/footer.php'); ?>
