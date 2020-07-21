
<?php
  $page_title = 'Incidencias Estatus';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
include_once('layouts/header.php');




$accion = find_by_id('contacto',(int)$_GET['id']);
  if(!$accion){
    $session->msg("d","Contacto Desconocido.");
    echo '<meta http-equiv="Refresh" content="0; url=pipedrive.php">';
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
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
   
		<div class="modal-content">
      <div class="modal-header">
        
		<a href="pipedrive.php">  <button type="button" class="close"  aria-label="Close"><span aria-hidden="true">&times;</span></button></a>
        <h4 class="modal-title" id="exampleModalLabel"><strong><center>Agendar Cita <?php echo $accion["empresa"]; ?></center>
			 
			</strong></h4>
      </div><div class="modal-body">
		<h3>
			
		
		
		<form method="post" action="pipedrive.php">
  			<input type="hidden" class="form-control" name="id_user" value="<?php echo $user['id']; ?>">
			<input type="hidden" class="form-control" name="id_contacto" value="<?php echo $accion["id"]; ?>">
			
		<div class="col-md-5">	
  <div class="form-group">
   
		  <div class="input-group clockpicker">
   <input type="text" class="form-control"   autocomplete="off" name="fecha" id="fecha"  required placeholder="Ingresa Fecha de La Cita">
	  <span class="input-group-addon">

<span class="glyphicon glyphicon-time"> Fecha </span>

</span>
			</div></div></div>
			
		
			
			
			<div class="col-md-6">
				<div class="form-group">
				<div class="input-group clockpicker">

<input type="text" class="form-control tiempo" id="tiempo" autocomplete="off" name="tiempo" required placeholder="Horario">


				
						
<span class="input-group-addon">

<span class="glyphicon glyphicon-time"> Hora </span>

</span>

</div></div></div>
<br><br>
	 <div class="form-group">
              <label for="level">Acción a Ejecutar</label>
                <select class="form-control" name="tipo" required>
                   <option value="">Selecciona una Opción</option>
					<option value="1">Reunión</option>
					<option value="2">LLamada</option>
					<option value="3">Correo</option>
					
                </select>
            </div>		
			
			
			
	<div class="col-md-12">			
  <div class="form-group"><br>
    <label for="exampleFormControlTextarea1">Notas</label>
    <textarea class="form-control" name="notas" rows="3" onkeyup="mayus(this);"></textarea>
  </div></div>
			<button type="submit" name="cita" class="btn btn-success btn-block"><i class="glyphicon glyphicon-send"></i>     Agregar Acción      </button>
</form>
		
		
		
		
		</h3></div>
		
			
			
		  
      <div class="modal-footer">
       <a href="pipedrive.php"> <button type="button" class="btn btn btn-danger" >Cerrar</button>
        </a>
      </div>
    </div>
		
  </div></div>


<script>

$('.tiempo').clockpicker({

placement: 'bottom', // clock popover placement

align: 'left',       // popover arrow align

donetext: 'Ingresar',     // done button text

autoclose: true,    // auto close when minute is selected

vibrate: true,        // vibrate the device when dragging clock hand
	default: 'now'

});


  $('#fecha').datepicker({
    format: "yyyy-mm-dd",
    clearBtn: true,
    language: "es",
	  startDate: "today",
    daysOfWeekDisabled: "0,6",
    daysOfWeekHighlighted: "0,6",
    autoclose: true,
    todayHighlight: true,
    datesDisabled: ['2019-09-21'],
    toggleActive: true
  
	
});
  
  
  
  

  

</script>
<!--fin agregar cita-->

<?php include_once('layouts/footer.php'); ?>
