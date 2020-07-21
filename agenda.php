<?php
date_default_timezone_set('America/Mexico_City');
require_once('includes/load.php');
// incluimos el archivo de funciones
include 'funciones.php';

// incluimos el archivo de configuracion
include 'config.php';

// Verificamos si se ha enviado el campo con name from
if(!empty($_FILES)){
	    //database configuration
    /*$dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'agenda';
    
    $dbHost = 'localhost';
    $dbUsername = 'envipaq_inven';
    $dbPassword = '3nvip4q2018';
    $dbName = 'envipaq_recoleccion';*/
	
	
	
	$dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'agenda';
	
	
	
	
    //connect with the database
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    if($mysqli->connect_errno){
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    
    $targetDir = "uploads/envipaq/";
    $fileName = $_FILES['file']['name'];
    $targetFile = $targetDir.$fileName;
    
    if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
        //insert file information into db table
        $conn->query("INSERT INTO agenda (archivo, fecha_carga) VALUES('".$fileName."','".date("d-m-Y H:i:s")."')");
    }
	
}

if (isset($_POST['from'])) 
{

	/*$archivo = $_POST['archivo'];
	
	$dir_subida = 'uploads/envipaq/';
$fichero_subido = $dir_subida . basename($_FILES['archivo']['name']);
	$nombre_archivo=basename($_FILES['archivo']['name']);
	move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido);*/
	/*
	$targetDir = "uploads/envipaq/";
    $fileName = $_FILES['archivo']['name'];
    $targetFile = $targetDir.$fileName;
    */
    
	
	
	
        // Recibimos el fecha de inicio y la fecha final desde el form
$Datein                    =date('d/m/Y H:i:s', time());//return strftime("%Y-%m-%d %H:%M:%S", time());
$Datefi                    =date('d/m/Y H:i:s', time());
        $inicio =  _formatear($Datein);//
        // y la formateamos con la funcion _formatear

      $final  =_formatear($Datefi);

        // Recibimos el fecha de inicio y la fecha final desde el form
       $orderDate                      =date('d/m/Y H:i:s', time());// date('d/m/Y H:i:s', strtotime($_POST['from']));
        $inicio_normal =$orderDate;

        // y la formateamos con la funcion _formatear
        $orderDate2                      = date('d/m/Y H:i:s', time()); //date('d/m/Y H:i:s', strtotime($_POST['to']));
        $final_normal  =$orderDate2;

        // Recibimos los demas datos desde el form
        $titulo = evaluar($_POST['title']);

        // y con la funcion evaluar
        $body   = evaluar($_POST['event']);

        // reemplazamos los caracteres no permitidos
        $clase  = evaluar($_POST['class']);
        $date    = make_date();
        // insertamos el evento
       move_uploaded_file($_FILES['file']['tmp_name'],$targetFile);
        //insert file information into db table
     //   $conn->query("INSERT INTO agenda (archivo, fecha_carga) VALUES('".$fileName."','".date("d-m-Y H:i:s")."')");
     
		   $query="INSERT INTO agenda VALUES('','$titulo','$body','','$clase','$inicio','$final','$inicio_normal','$final_normal','$fileName','')";

        // Ejecutamos nuestra sentencia sql
         $conexion->query($query)or die('<script type="text/javascript">alert("Horario No Disponible ")</script>');
         
         header("Location:$base_url");         
  
	   
        // Obtenemos el ultimo id insetado
        $im=$conexion->query("SELECT MAX(id) AS id FROM agenda");
        $row = $im->fetch_row();  
        $id = trim($row[0]);

        // para generar el link del evento
        $link = "$base_url"."descripcion_evento.php?id=$id";

        // y actualizamos su link
        $query="UPDATE agenda SET url = '$link' WHERE id = $id";

        // Ejecutamos nuestra sentencia sql
        $conexion->query($query); 

        // redireccionamos a nuestro calendario
        header("Location:$base_url"); 
    
}
include_once('layouts/header.php');
 ?>

<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8">
        <title>Calendario</title>
	
	<script src="drop/dropzone.js"></script>
<link rel="stylesheet" href="drop/dropzone.css">
	        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=$base_url?>css/calendar.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <script type="text/javascript" src="<?=$base_url?>js/es-ES.js"></script>
        <script src="<?=$base_url?>js/jquery.min.js"></script>
        <script src="<?=$base_url?>js/moment.js"></script>
        <script src="<?=$base_url?>js/bootstrap.min.js"></script>
        <script src="<?=$base_url?>js/bootstrap-datetimepicker.js"></script>
        <link rel="stylesheet" href="<?=$base_url?>css/bootstrap-datetimepicker.min.css" />
	

    
    </head>
<style>
	#idsubir{
		
		
		
		

	}
	</style>

<?php include_once('layouts/header.php');
 ?>
<div class="row">
     <div class="col-md-13">
     
             
         </div>
  </div>

    <div class="col-md-13">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-calendar"></span>
          
          <span>Agenda          
           </span>
       </strong>
      </div>
        <div class="panel-body">
			
        <!--<div class="container">-->

                <div class="row">
                        <div class="page-header"><h2></h2></div>
                                <div class="pull-left form-inline"><br>
                                        <div class="btn-group">
                                            <button class="btn btn-primary" data-calendar-nav="prev"><< Anterior</button>
                                            <button class="btn" data-calendar-nav="today">Hoy</button>
                                            <button class="btn btn-primary" data-calendar-nav="next">Siguiente >></button>
                                        </div>
                                        <div class="btn-group">
                                            <button class="btn btn-warning" data-calendar-view="year">Año</button>
                                            <button class="btn btn-warning active" data-calendar-view="month">Mes</button>
                                            <button class="btn btn-warning" data-calendar-view="week">Semana</button>
                                            <button class="btn btn-warning" data-calendar-view="day">Dia</button>
                                        </div>

                                </div>
                                    <div class="pull-right form-inline"><br>
                                        <button class="btn btn-info" data-toggle='modal' data-target='#add_evento'>Añadir Evento</button>
                                    </div>

                </div><hr>

                <div class="row">
                        <div id="calendar"></div> <!-- Aqui se mostrara nuestro calendario -->
                        <br><br>
                </div>

                <!--ventana modal para el calendario-->
                <div class="modal fade" id="events-modal">
                    <div class="modal-dialog">
                            <div class="modal-content">
                                    <div class="modal-body" style="height: 400px">
                                        <p>One fine body&hellip;</p>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
        </div>

    <script src="<?=$base_url?>js/underscore-min.js"></script>
    <script src="<?=$base_url?>js/calendar.js"></script>
		
    <script type="text/javascript">
        (function($){
                //creamos la fecha actual
                var date = new Date();
                var yyyy = date.getFullYear().toString();
                var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
                var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

                //establecemos los valores del calendario
                var options = {

                    // definimos que los agenda se mostraran en ventana modal
                        modal: '#events-modal', 

                        // dentro de un iframe
                        modal_type:'iframe',    

                        //obtenemos los agenda de la base de datos
                        events_source: '<?=$base_url?>obtener_eventos.php', 

                        // mostramos el calendario en el mes
                        view: 'month',             

                        // y dia actual
                        day: yyyy+"-"+mm+"-"+dd,   


                        // definimos el idioma por defecto
                        language: 'es-ES', 

                        //Template de nuestro calendario
                        tmpl_path: '<?=$base_url?>tmpls/', 
                        tmpl_cache: false,


                        // Hora de inicio
                        time_start: '09:00', 

                        // y Hora final de cada dia
                        time_end: '18:00',   

                        // intervalo de tiempo entre las hora, en este caso son 30 minutos
                        time_split: '20',    

                        // Definimos un ancho del 100% a nuestro calendario
                        width: '100%', 

                        onAfterEventsLoad: function(events)
                        {
                                if(!events)
                                {
                                        return;
                                }
                                var list = $('#eventlist');
                                list.html('');

                                $.each(events, function(key, val)
                                {
                                        $(document.createElement('li'))
                                                .html('<a href="' + val.url + '">' + val.title + '</a>')
                                                .appendTo(list);
                                });
                        },
                        onAfterViewLoad: function(view)
                        {
                                $('.page-header h2').text(this.getTitle());
                                $('.btn-group button').removeClass('active');
                                $('button[data-calendar-view="' + view + '"]').addClass('active');
                        },
                        classes: {
                                months: {
                                        general: 'label'
                                }
                        }
                };


                // id del div donde se mostrara el calendario
                var calendar = $('#calendar').calendar(options); 

                $('.btn-group button[data-calendar-nav]').each(function()
                {
                        var $this = $(this);
                        $this.click(function()
                        {
                                calendar.navigate($this.data('calendar-nav'));
                        });
                });

                $('.btn-group button[data-calendar-view]').each(function()
                {
                        var $this = $(this);
                        $this.click(function()
                        {
                                calendar.view($this.data('calendar-view'));
                        });
                });

                $('#first_day').change(function()
                {
                        var value = $(this).val();
                        value = value.length ? parseInt(value) : null;
                        calendar.setOptions({first_day: value});
                        calendar.view();
                });
        }(jQuery));
    </script>

<div class="modal fade" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel" align="right">Agregar Nuevo Evento</h4>
      </div>
      <div class="modal-body">
       <!--/* <form action="" method="post">*/-->
                 <!--   <label for="from">Inicio</label>
                    <div class='input-group date' id='from'>
                        <input type='text' id="from" name="from" class="form-control"  />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </div>

                    <br>

                    <label for="to">Final</label>
                    <div class='input-group date' id='to'>
                        <input type='text' name="to" id="to" class="form-control" />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </div>-->

                   
<form action="agenda.php" class="dropzone" method="post" enctype="multipart/form-data">

						
                    <!--<label for="tipo">Tipo de Evento</label>
                    <select class="form-control" name="class" id="tipo" style="">
                        <option value="event-info">Informacion</option>
                        <option value="event-success">Exito</option>
                        <option value="event-important">Importantante</option>
                        <option value="event-warning">Advertencia</option>
                        <option value="event-special">Especial</option>
                    </select>
-->
                    <input type="hidden" name="class" value="event-important" >


                    <label for="title">Título</label>
                    <input type="text" required autocomplete="off" autofocus name="title" class="form-control" id="title" placeholder="Introduce un título">

                    <br>


                    <label for="body">Descripción</label>
                    <textarea id="body" name="event" class="form-control" rows="3"></textarea>
	
<br><label for="tipo">Arrastra el Archivo o Da Click Abajo</label><br>
	<div class="fallback">
   <input name="archivo" type="file" >
 </div>
    <script type="text/javascript">
       /* $(function () {
            $('#from').datetimepicker({
                language: 'es',
                minDate: new Date()
            });
            $('#to').datetimepicker({
                language: 'es',
                minDate: new Date()
            });

        });*/
    </script>
      </div>
			  

      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
          <button type="submit" name="from" class="btn btn-success"><i class="fa fa-check"></i> Agregar</button>
        </form>
    </div>
  </div>
</div>
</div>
	  
	  </div></div>
    </div>
	<?php include_once('layouts/footer.php'); ?>
</body>
</html>
