<?php
  $page_title = 'Pipedrive';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(7);

	



?>
<script>






</script>

<?php 
if(isset($_POST['cita'])){
 

 
    $p_id_contacto= remove_junk($db->escape($_POST['id_contacto']));
    $p_id_user = remove_junk($db->escape($_POST['id_user']));
    $p_fecha = remove_junk($db->escape($_POST['fecha']));
	$p_notas = remove_junk($db->escape($_POST['notas']));
	$p_tiempo = remove_junk($db->escape($_POST['tiempo']));
	$p_tipo = remove_junk($db->escape($_POST['tipo']));
	
	$date    = make_date();

	
	
	//INSERT INTO excel (razon_social, guia, fecha_envio, servicio, incidencia, asesor, activo)  VALUES 
     $query  = "INSERT INTO citas (";
     $query .=" id_contacto, fecha_hora, id_vendedor, fecha_alta, notas, tiempo, tipo";
     $query .=") VALUES (";
     $query .="'{$p_id_contacto}','{$p_fecha}','{$p_id_user}','{$date}','{$p_notas}','{$p_tiempo}','{$p_tipo}'";
     $query .=")";
	   
	   if($db->query($query)){
       
	  $session->msg('s',"Cita Agregada Correctamente   ");
       echo '<meta http-equiv="Refresh" content="0; url=pipedrive.php">';
		   //redirect('pipedrive.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Agregar la Cita, Intenta Otra Vez :(');
        echo '<meta http-equiv="Refresh" content="0; url=pipedrive.php">';
			//redirect('pipedrive.php', false);
	   }

   

 }
?>
<?php 
if(isset($_POST['cliente'])){
 

 
    $p_contacto= remove_junk($db->escape($_POST['contacto']));
    $p_telefono = remove_junk($db->escape($_POST['telefono']));
    $p_domicilio = remove_junk($db->escape($_POST['domicilio']));
	$p_delegacion = remove_junk($db->escape($_POST['delegacion']));
	$p_cp = remove_junk($db->escape($_POST['cp']));
	$p_id_user = remove_junk($db->escape($_POST['id_user']));
	$p_empresa = remove_junk($db->escape($_POST['empresa']));
	$date    = make_date();

	
	
	//INSERT INTO excel (razon_social, guia, fecha_envio, servicio, incidencia, asesor, activo)  VALUES 
     $query  = "INSERT INTO contacto (";
     $query .=" contacto, telefono, domicilio, cp, delegacion, id_vendedor, fecha, empresa";
     $query .=") VALUES (";
     $query .="'{$p_contacto}','{$p_telefono}','{$p_domicilio}','{$p_cp}','{$p_delegacion}','{$p_id_user}','{$date}','{$p_empresa}'";
     $query .=")";
	   
	   if($db->query($query)){
       
	  $session->msg('s',"Contacto Agregado Correctamente!!! :-)   ");
      echo '<meta http-equiv="Refresh" content="0; url=pipedrive.php">';
		   //redirect('pipedrive.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Ingresar el Contacto Intenta Otra Vez :(');
      echo '<meta http-equiv="Refresh" content="0; url=pipedrive.php">';
			//redirect('pipedrive.php', false);
	   }

   

 }
?>

<style>
.ti_tx,
.mi_tx,
.mer_tx {
	width: 100%;
	text-align: center;
	margin: 10px 0;
}

.time,
.mins,
.meridian {
	width: 60px;
	float: left;
	margin: 0 10px;
	font-size: 20px;
	color: #2d2e2e;
	font-family: arial;
	font-weight: 700;
}

.prev,
.next {
	cursor: pointer;
	padding: 18px;
	width: 28%;
	border: 1px solid #ccc;
	margin: auto;
	background:  url("libs/images/arrow.png")no-repeat;
	border-radius: 5px;
}

.prev:hover,
.next:hover {
	background-color: #ccc;
}

.next {
	background-position: 50% 150%;
}

.prev {
	background-position: 50% -50%;
}

.time_pick {
	position: relative;
}

.timepicker_wrap {
	padding: 10px;
	border-radius: 5px;
	z-index: 998;
	display: none;
	box-shadow: 2px 2px 5px 0 rgba(50,50,50,0.35);
	background: #f6f6f6;
	border: 1px solid #ccc;
	float: left;
	position: absolute;
	top: 27px;
	left: 0;
}

.arrow_top {
	position: absolute;
	top: -10px;
	left: 20px;
	background: url(../images/top_arr.png) no-repeat;
	width: 18px;
	height: 10px;
	z-index: 999;
}
input.timepicki-input {
	background: none repeat scroll 0 0 #FFFFFF;
    	border: 1px solid #CCCCCC;
    	border-radius: 5px 5px 5px 5px;
    	float: none;
    	margin: 0;
    	text-align: center;
    	width: 70%;
}
a.reset_time {
	float: left;
	margin-top: 5px;
	color: #000;
}
	
	
	#muestra,#cita{
		
	
		float: right;
		
	}

	.rojo{
		background-color: crimson;
		
	}
	.rojo_citas{
		background-image:url("libs/images/fondorojo.JPG");
		background-image: repeating-linear-gradient();
		
	}
	.textocitas{
		
		color: white;
	}
	
</style>

<?php include_once('layouts/header.php');
$usuario=$user['id'];
$recent_products = ultimas_citas($usuario);
$recent_sales = ultimos_contactos('15',$usuario);
?>
 <div class="row">
     <div class="col-md-13">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-13">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Panel
                   
	</strong>
        </div>
        <div class="panel-body">
			
			
			
			<div id="panel">
				
				 <div class="row">
				  
				
					<!--<div class="col-md-3" id="muestradiv">
					<label class="btn btn-success glyphicon glyphicon-plus-sign" id="muestra"> Generar Alta De Contacto</label>
					 
					 </div>-->
					<div class="col-md-6"><!--principio de contactos-->
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-user"></span>
            <span>Contactos Añadidos <label class=" glyphicon glyphicon-plus-sign" id="muestra" title="Agregar Contacto" data-toggle="tooltip" style="font-size:30px;"></label></span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover table-responsive">
       <thead>
       <h4>  <tr>
           <th class="text-center">Contacto</th>
           <th class="text-center">Empresa</th>
           <th class="text-center">Telefono</th>
           <th class="text-center">Agregar Acción</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach ($recent_sales as  $recent_sale): ?>
         <tr > 
           <td class="text-center"><a href="detalle_contacto.php?id=<?php echo (int)$recent_sale['id']; ?>"><?php echo remove_junk(first_character($recent_sale['contacto']));?></a></td>
           <td>
           
            <a href="detalle_contacto.php?id=<?php echo (int)$recent_sale['id']; ?>"> <?php echo remove_junk(first_character($recent_sale['empresa'])); ?></a>
          
           </td>
           <td><a href="detalle_contacto.php?id=<?php echo (int)$recent_sale['id']; ?>"><?php echo remove_junk(ucfirst($recent_sale['telefono'])); ?></a></td>
           <td class="text-center">
			   <label class=" glyphicon glyphicon-plus-sign" data-toggle="modal" data-target="#<?php echo remove_junk($recent_sale['id']);?>" title="Agendar Cita" data-toggle="tooltip" style="font-size:20px;"></label>
			   
			   <!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?php echo remove_junk($recent_sale['id']);?>"><i class='glyphicon glyphicon-plus' style="font-size:20px;color:red;"></i> Expandir</button> 
			 -->
			 </td> 
        </tr></h4>
<!--				principio de agregar cita-->
				  <div class="modal fullscreen-modal fade" id="<?php echo remove_junk($recent_sale['id']);?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
   
		<div class="modal-content">
      <div class="modal-header">
        
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"><strong><center>Agendar Cita <?php echo remove_junk($recent_sale['empresa']);?></center>
			 
			</strong></h4>
      </div><div class="modal-body">
		<h3>
			
		
		
		<form method="post" action="pipedrive.php">
  			<input type="hidden" class="form-control" name="id_user" value="<?php echo remove_junk(first_character($user['id'])); ?>">
			<input type="hidden" class="form-control" name="id_contacto" value="<?php echo remove_junk(first_character($recent_sale['id'])); ?>">
			
		<div class="col-md-5">	
  <div class="form-group">
   
		  <div class="input-group clockpicker">
   <input type="text" class="datepicker form-control" data-date-start-date="0d" language="es" autocomplete="off" name="fecha" id="fecha"  required placeholder="Ingresa Fecha de La Cita">
	  <span class="input-group-addon">

<span class="glyphicon glyphicon-time"> Fecha </span>

</span>
			</div></div></div>
			
		
			
			
			<div class="col-md-6">
				<div class="form-group">
				<div class="input-group clockpicker">

<input type="text" class="form-control tiempo" id="tiempo" autocomplete="off" name="tiempo" required placeholder="Horario">


					<!--<input  type="text" class="timepicker form-control" autocomplete="off" required name="tiempo" id="tiempo" placeholder="Ingresa la Hora">-->
				
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
					<option value="4">Tarea</option>
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
        <button type="button" class="btn btn btn-danger" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div></div>
<!--fin agregar cita-->
		   
		   
		   
       <?php endforeach; ?>
       </tbody>
     </table>
    </div>
   </div>
  </div><!--fin de contactos-->
				
				<div class="col-md-5"><!--principio de citas-->
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-calendar"></span>
          <span id="variable_tabla">Proximas Citas<!--<label class=" glyphicon glyphicon-plus-sign" id="cita" data-toggle="modal" data-target="#agregar_cita"  style="font-size:30px;"></label>--></span>
        </strong>
      </div>
      <div class="panel-body">

        <div class="list-group">
			
      <?php 
			function get_format($df) {

    $str = '';
    $str .= ($df->invert == 1) ? ' - ' : '';
    if ($df->y > 0) {
        // years
        $str .= ($df->y > 1) ? $df->y . ' Años ' : $df->y . ' Año ';
    } if ($df->m > 0) {
        // month
        $str .= ($df->m > 1) ? $df->m . ' Meses ' : $df->m . ' Mes ';
    } if ($df->d > 0) {
        // days
        $str .= ($df->d > 1) ? $df->d . ' Dias ' : $df->d . ' Día ';
    } if ($df->h > 0) {
        // hours
        $str .= ($df->h > 1) ? $df->h . ' Horas ' : $df->h . ' Hora ';
    } if ($df->i > 0) {
        // minutes
        $str .= ($df->i > 1) ? $df->i . ' Minutos ' : $df->i . ' Minuto ';
    } if ($df->s > 0) {
        // seconds
        $str .= ($df->s > 1) ? $df->s . ' Segundos ' : $df->s . ' Segundo ';
    }

    echo $str;
}
			
			
			
			
			foreach ($recent_products as  $recent_product): 
			
			
			
			$fechamomento= date("Y-m-d H:i");
			$tiempomomento=$recent_product['fecha_hora']." ".$recent_product['tiempo'];
			
			if($tiempomomento<$fechamomento){
		
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
			?>
<script>
	
document.getElementById("variable_tabla").innerHTML = "Hay Citas por Validar";
</script>
				<h4><a class="list-group-item clearfix rojo_citas" href="notas_reunion.php?id=<?php echo    (int)$recent_product['id_cita'];?>" title="Agregar Notas de la Reunión con <?php echo remove_junk(first_character($recent_product['empresa']));?>" data-toggle="tooltip" data-placement="right" >
                <h4 class="list-group-item-heading"><font color="white">
                <?php echo remove_junk(first_character($recent_product['contacto']));?>
                  <span class="label label-success  pull-right">Telefono: 
                 <?php echo (int)$recent_product['telefono']; ?>
                  </span></font>
                </h4>
                <span class="list-group-item-text pull-right"><font color="white">
               <strong >Fecha y Hora: <?php echo remove_junk(first_character($recent_product['fecha_hora'])); ?> <?php echo remove_junk(first_character($recent_product['tiempo'])); ?></strong>
              </span></font>
      </a></h4>
					
										<?php 
			
					}else{
				
				
			
				
			
			?>
          
			
			
		<h4><a class="list-group-item clearfix" href="agenda_citas.php?id=<?php echo    (int)$recent_product['id_cita'];?>" title="Ver Detalles <?php echo remove_junk(first_character($recent_product['empresa']));?>" data-toggle="tooltip" data-placement="right" >
                <h4 class="list-group-item-heading">
                <?php echo remove_junk(first_character($recent_product['contacto']));?>
                  <span class="label label-success  pull-right">Telefono: 
                 <?php echo (int)$recent_product['telefono']; ?>
                  </span>
                </h4>
                <span class="list-group-item-text pull-right">
               <strong >Fecha y Hora: <?php
				
				echo $recent_product['fecha_hora']; ?> <?php echo remove_junk(first_character($recent_product['tiempo'])); ?><br>
					
					<?php
				   
				$date1 = new DateTime($fechamomento);
$date2 = new DateTime($tiempomomento);
$diff = $date1->diff($date2);
echo get_format($diff)." Para la Reunión.";
				   
				   ?>
					</strong>
              </span>
      </a></h4>
			
			
			
      <?php } endforeach; ?>
    </div>
  </div>
 </div>
</div>
 </div>
  <div class="row">

  </div><!--fin de citas-->
				
			
					 
					 
					 
					  </div> <!--fin de panel -->
					 <div id="form2" style="display:none">
						<p> <label class="btn btn-default" id="regresa">&lt;- Regresar</label></p>
					 <form action="pipedrive.php" method="post">
					  <div class="form-group">
                  <div class="col-md-6">
                     <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="contacto" placeholder="Contacto" required onkeyup="mayus(this);">
               </div>
					  </div> </div>
                  
                  
                   <div class="form-group">
					   <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-earphone"></i>
                  </span>
                  <input type="text" class="form-control" name="telefono" placeholder="Teléfono" required onkeyup="mayus(this);">
               </div>
               </div> </div>
			
			  <div class="form-group">
			        <div class="col-md-12">
                     <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-map-marker"></i>
                  </span>
                  <input type="text" class="form-control" name="domicilio" placeholder="Domicilio" required onkeyup="mayus(this);">
               </div>
					  </div> </div>
						 <div class="form-group">
			        <div class="col-md-6">
                     <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon">@</i>
                  </span>
                  <input type="email" class="form-control" name="email" placeholder="Correo Electronico" required onkeyup="mayus(this);">
               </div>
					  </div> </div>
                 <div class="form-group">
					   <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-lock"></i>
                  </span>
                  <input type="text" class="form-control" name="empresa" placeholder="Nombre de la Empresa" required onkeyup="mayus(this);">
               </div>
               </div> </div>
               
                   <div class="form-group">
					    <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-map-marker"></i>
                  </span>
                  <input type="text" class="form-control" name="delegacion" placeholder="Delegación o Municipio"  onkeyup="mayus(this);">
               </div> </div>
               </div>
		  
				
				  <div class="form-group">
			          <div class="col-md-6">
                     <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-map-marker"></i>
                  </span>
                  <input type="text" class="form-control" name="cp" placeholder="CP" onkeyup="mayus(this);" pattern="[0-9]{4,6}">
               </div>
					  </div> </div> 
                  
                 
				
				<input type="hidden" class="form-control" name="id_user" value="<?php echo remove_junk(first_character($user['id'])); ?>">
				<br><br><br><br>
				
				<div class="col-md-12">
			  <button type="submit" name="cliente" class="btn btn-success btn-block"><i class="glyphicon glyphicon-plus-sign"></i>     Agregar Alta      </button>
				  </div>
				
					 </form></div> <!--fin de alta deuser-->
				

                           
				
				
				
				<script type="text/javascript">
					
			
					
					
$('.tiempo').clockpicker({

placement: 'bottom', // clock popover placement

align: 'left',       // popover arrow align

donetext: 'Ingresar',     // done button text

autoclose: true,    // auto close when minute is selected

vibrate: true,        // vibrate the device when dragging clock hand
	default: 'now'

});

</script>

				
				
				
				
				
				
				</div></div>
<?php include_once('layouts/footer.php'); ?>
