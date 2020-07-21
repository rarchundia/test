<?php
  $page_title = 'Editar Usuario';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
$resultado_eventos = agenda();
?>

<?php include_once('layouts/header.php'); ?>

<link href='calendario/css/bootstrap.min.css' rel='stylesheet'>
		<link href='calendario/css/fullcalendar.min.css' rel='stylesheet' />
		<link href='calendario/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
		
		<script src='calendario/js/moment.min.js'></script>
		<script src='calendario/js/fullcalendar.min.js'></script>
		<script src='calendario/locale/es-es.js'></script>
		<script>
			$(document).ready(function() {
				$('#calendar').fullCalendar({
					header: {
						left: 'month,agendaWeek,agendaDay',
						center: 'title',
						right: 'prev,next today'
					},
					defaultDate: Date(),
					navLinks: true, // can click day/week names to navigate views
					editable: true,
					eventLimit: true, // allow "more" link when too many events
					eventClick: function(event) {
						
						$('#visualizar #id').html("<a href='home.php?id="+event.id+"'>test</a>");
						$('#visualizar #title').text(event.title);
						$('#visualizar #start').text(event.start.format('YYYY-MM-DD HH:mm'));
						$('#visualizar #end').text(event.end.format('YYYY-MM-DD HH:mm'));
                        $('#visualizar #enlace').html("<a href='home.php'>test</a>");
                       
						$('#visualizar').modal('show');
						return false;

					},
					
					selectable: true,
					selectHelper: true,
					select: function(start, end){
						$('#cadastrar #start').val(moment(start).format('YYYY-MM-DD'));
						$('#cadastrar #end').val(moment(end).format('YYYY-MM-DD'));
                        $('#cadastrar #tiempo_start').val(moment(start).format('09:00'));
						$('#cadastrar #tiempo_end').val(moment(end).format('22:00'));
						
						$('#cadastrar').modal('show');						
					},
					events: [
						<?php foreach ($resultado_eventos as  $registros_eventos): ?>
								{
								//id: '<?php echo $registros_eventos['id']; ?>',
								title: '<?php echo $registros_eventos['titulo']; ?>',
								start: '<?php echo $registros_eventos['inicio']; ?>',
								end: '<?php echo $registros_eventos['fin']; ?>',
								color: '<?php echo $registros_eventos['color']; ?>',
                                enlace:'<?php echo $registros_eventos['enlace']; ?>',
								}, 
                        <?php endforeach; ?>
					]
				});
			});
			
			/*//Mascara para o campo data e hora
			function DataHora(evento, objeto){
				var keypress=(window.event)?event.keyCode:evento.which;
				campo = eval (objeto);
				if (campo.value == '00/00/0000 00:00:00'){
					campo.value=""
				}
			 
				caracteres = '0123456789';
				separacao1 = '/';
				separacao2 = ' ';
				separacao3 = ':';
				conjunto1 = 2;
				conjunto2 = 5;
				conjunto3 = 10;
				conjunto4 = 13;
				conjunto5 = 16;
				if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (19)){
					if (campo.value.length == conjunto1 )
					campo.value = campo.value + separacao1;
					else if (campo.value.length == conjunto2)
					campo.value = campo.value + separacao1;
					else if (campo.value.length == conjunto3)
					campo.value = campo.value + separacao2;
					else if (campo.value.length == conjunto4)
					campo.value = campo.value + separacao3;
					else if (campo.value.length == conjunto5)
					campo.value = campo.value + separacao3;
				}else{
					event.returnValue = false;
				}
			}
            */
            
                           
                           

                      
                    </script>
<style>
   #calendar {
	width: 100%;
     color: red;
}
    
</style>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-12">
     <div class="panel panel-default">
       <div class="panel-heading">
        
          <span class="glyphicon glyphicon-calendar"></span>
           calendario
       </div>
       <div class="panel-body">
		   
			<div id='calendar'></div>
		</div>

		<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center">Datos del Evento</h4>
					</div>
					<div class="modal-body">
						<dl class="dl-horizontal">
							<dt>ID de Evento</dt>
							<dd id="id"></dd>
                           
							<dt>Titulo de Evento</dt>
							<dd id="title"></dd>
							<dt>Inicio de Evento</dt>
							<dd id="start"></dd>
							<dt>Fin de Evento</dt>
							<dd id="end"></dd>
                            <dt>enlace</dt>
							<dd id="enlace"></dd>
						</dl>
					</div>
                    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
                    
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center">Registrar Evento</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" method="POST" action="proceso.php">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Titulo</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="titulo" placeholder="Titulo do Evento">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Color</label>
								<div class="col-sm-10">
									<select name="color" class="form-control" id="color">
										<option value="">Selecione</option>			
										<option style="color:#FFD700;" value="#FFD700">Amarillo</option>
										<option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
										<option style="color:#FF4500;" value="#FF4500">Naranja</option>
										<option style="color:#8B4513;" value="#8B4513">Marron</option>	
										<option style="color:#1C1C1C;" value="#1C1C1C">Negro</option>
										<option style="color:#436EEE;" value="#436EEE">Azul Real</option>
										<option style="color:#A020F0;" value="#A020F0">Purpura</option>
										<option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>										
										<option style="color:#228B22;" value="#228B22">Verde</option>
										<option style="color:#8B0000;" value="#8B0000">Rojo</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Data Inicial</label>
								<div class="col-sm-5 ">
									<input type="text" class="form-control fecha" name="inicio" id="start" autocomplete="off" >
                                    </div>
                                    <div class="col-sm-5 ">
                                    <input type="text" class="form-control tiempo" name="tiempo_inicio" id="tiempo_start" >
								</div>
							</div>
							
                          
                                 
                                 
                            
                            <div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Data Final</label>
								<div class="col-sm-5 ">
									<input type="text" class="form-control fecha" name="fin" id="end" autocomplete="off" >
                                   </div>
                                    <div class="col-sm-5 ">
                                    <input type="text" class="form-control tiempo" name="tiempo_fin" id="tiempo_end" >
                                    
								</div>
							</div>
                            
                            
                            
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-success pull-right">Registrar</button>
								
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerar</button>
                                    </div>
							</div>
						</form>
					</div>
				</div>
			</div>





<!--Fin elementos contenedor-->
</div>
</div>
  </div>
</div>
<script>
    $('.fecha').datepicker({
    format: "yyyy-mm-dd",
    clearBtn: true,
    language: "es",
    /*daysOfWeekDisabled: "0,6",
    daysOfWeekHighlighted: "0,6",
   */ 
        autoclose: true,
    todayHighlight: true,
    //datesDisabled: ['2019-09-21'],
    toggleActive: true,
    startDate: "today",
	
});
    
    
 $('.tiempo').clockpicker({

placement: 'bottom', // clock popover placement

align: 'left',       // popover arrow align

donetext: 'Ingresar',     // done button text

autoclose: true,    // auto close when minute is selected

vibrate: true,        // vibrate the device when dragging clock hand
	default: 'now'

});         
                    </script>



<?php include_once('layouts/footer.php'); ?>