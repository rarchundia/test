<?php
  $page_title = 'Tickets';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);

	


if(isset($_POST['genera_ticket'])){
 


  //$razonsocial_des = remove_junk($db->escape($_POST['razonsocial_des']));
 
   if(empty($errors)){
     $p_nombre = remove_junk($db->escape($_POST['nombre']));
	$p_empresa = remove_junk($db->escape($_POST['empresa']));
	$p_id_user = remove_junk($db->escape($_POST['id_user']));
	   $p_correo = remove_junk($db->escape($_POST['correo']));
	   $p_guia = remove_junk($db->escape($_POST['guia']));
	   $p_motivo = remove_junk($db->escape($_POST['motivo']));
	   $p_paquetera = remove_junk($db->escape($_POST['paquetera']));
	   $p_fecha_documentacion = remove_junk($db->escape($_POST['fecha_documentacion']));
	  
     $date    = make_date();
     $query  = "INSERT INTO ticket (";
     $query .="  empresa, quien_reporta, correo, fecha_inicio, motivo, n_deguia, id_quien_genera, fecha_docu, paqueteria ";
     $query .=") VALUES (";
$query .="'{$p_empresa}','{$p_nombre}','{$p_correo}','{$date}','{$p_motivo}','{$p_guia}','{$p_id_user}','{$p_fecha_documentacion}','{$p_paquetera}' ";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
       
	  $session->msg('s',"Proyecto Generado Correctamente ");
      echo '<meta http-equiv="Refresh" content="0; url=tickets.php">';
		 // redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Generar el  Proyecto Intenta Nuevamente.');
      echo '<meta http-equiv="Refresh" content="0; url=tickets.php">';
			//redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
    echo '<meta http-equiv="Refresh" content="0; url=tickets.php">';
	   //redirect('entrega.php',false);
   }

 }


if(isset($_POST['tarea_btn'])){
 


  //$razonsocial_des = remove_junk($db->escape($_POST['razonsocial_des']));
 
   if(empty($errors)){
     $p_tarea = remove_junk($db->escape($_POST['tarea']));
	$p_descripcion = remove_junk($db->escape($_POST['descripcion']));
	$p_prioridad = remove_junk($db->escape($_POST['prioridad']));
	   $p_id_user = remove_junk($db->escape($_POST['id_user']));
	    $p_id_proyecto= remove_junk($db->escape($_POST['id_proyecto']));
     $date    = make_date();
     $query  = "INSERT INTO tareas_p (";
     $query .="  nombre, descripcion, fecha_inicio, id_proyecto, prioridad,  id_usuario";
     $query .=") VALUES (";
     $query .="'{$p_tarea}','{$p_descripcion}','{$date}','{$p_id_proyecto}','{$p_prioridad}','{$p_id_user}' ";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
       
	  $session->msg('s',"Tarea Agregada Correctamente ");
      echo '<meta http-equiv="Refresh" content="0; url=tareas.php">';
		 // redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Agregar la Tarea Intenta Nuevamente.');
      echo '<meta http-equiv="Refresh" content="0; url=tareas.php">';
			//redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
    echo '<meta http-equiv="Refresh" content="0; url=tareas.php">';
	   //redirect('entrega.php',false);
   }

 }

if(isset($_POST['prioridad'])){

if(empty($errors)){
    
	 $p_id_ticket = remove_junk($db->escape($_POST['id_ticket']));
	 $p_prioridad = remove_junk($db->escape($_POST['prioridad']));
	
	
	
	$query  = " UPDATE ticket SET prioridad ='{$p_prioridad}' WHERE id='{$p_id_ticket}'";
	
	 $result = $db->query($query);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Se ha Cambiado la Prioridad del Ticket ");
            echo '<meta http-equiv="Refresh" content="0; url=tickets.php">';
			  //redirect('incidencias.php', false);
          } else {
            $session->msg('d',' Fallo al Cambiar la Prioridad');
            echo '<meta http-equiv="Refresh" content="0; url=tickets.php">';
			  //redirect('incidencias.php', false);
          }
}
	else{
     $session->msg("d", $errors);
    // redirect('aclaraciones.php',false);
		echo '<meta http-equiv="Refresh" content="0; url=tickets.php">';
   }
	
	
	
}


if(isset($_POST['agregar_entrada'])){
 


  //$razonsocial_des = remove_junk($db->escape($_POST['razonsocial_des']));
 
   if(empty($errors)){
     $p_id_ticket = remove_junk($db->escape($_POST['id_ticket']));
	$p_detalles = remove_junk($db->escape($_POST['detalles']));
	$p_id_user = remove_junk($db->escape($_POST['id_user']));
	   
     $date    = make_date();
     $query  = "INSERT INTO ticket_detalles (";
     $query .="  detalles, id_user, id_ticket, fecha_entrada";
     $query .=") VALUES (";
     $query .="'{$p_detalles}','{$p_id_user}','{$p_id_ticket}','{$date}' ";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
       
	  $session->msg('s',"Entrada Agregada");
      echo '<meta http-equiv="Refresh" content="0; url=ticket_detalle.php?id='.$p_id_ticket.'">';
		 // redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Generar el  Proyecto Intenta Nuevamente.');
      echo '<meta http-equiv="Refresh" content="0; url=ticket_detalle.php?id='.$p_id_ticket.'">';
			//redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
   echo '<meta http-equiv="Refresh" content="0; url=ticket_detalle.php?id='.$p_id_ticket.'">';
	   //redirect('entrega.php',false);
   }

 }


?>



<?php include_once('layouts/header.php');
//$proyecto = t_proyectos($user['id']);	

?>
<style>

	.tab-pane{
		color:black;
		background-color: white;
		
	}
	ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 20px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}

        #chartdiv {
  width: 100%;
  max-height: 600px;
  height: 100vh;
  
}
  #chartdiv1 {
  width: 100%;
  max-height: 600px;
  height: 100vh;
  
} 
    
  
</style>





 <div class="row">
     <div class="col-md-13">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
       
        <div class="panel-body">
			
			<!-- /.principio container -->
	 <div class="col-md-10">
  <h2><i class="glyphicon glyphicon-bookmark"></i> Tickets <button type="button" class="btn btn-default " data-toggle="modal" data-target="#nuevo_ticket"><i class="glyphicon glyphicon-plus"></i> Nuevo</button></h2>
			</div>
			<div class="col-md-2">
			<a href="tickets_excel.php" class="btn btn-info "><i class="glyphicon glyphicon-open"></i> Sube layout</a>
				 </div>
			 <!-- Modal nuevo ticket-->
<div id="nuevo_ticket" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal agrega proyecto-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <center><h4 class="modal-title">Ticket Nuevo</h4></center>
      </div>
      <div class="modal-body">
        
		  
		  <form action="tickets.php" method="post">
			  <div class="form-group ">
      <label for="inputState">Motivo</label>
      <select id="motivo" name="motivo" class="form-control">
        <option selected>Selecciona...</option>
        <option value="RETRASO">RETRASO</option>
		  <option value="ROBO">ROBO</option>
		  <option value="PERDIDA">PERDIDA</option>
		  <option value="SEGURO">SEGURO</option>
		  <option value="DATOS_INCOMPLETOS">DATOS INCOMPLETOS</option>
		  <option value="RECHAZADO">RECHAZADO</option>
		  <option value="OCURRE">OCURRE</option>
		   <option value="CANCELADO">CANCELADO</option>
		   <option value="DEVOLUCION">DEVOLUCION</option>
		  <option value="SIN_MOVIMIENTO">ENVIO SIN MOVIMIENTO</option>
		  <option value="ACLARACION_FACTURA">ACLARACION DE FACTURA</option>
		  <option value="SIN_CONFI_ENTREGA">SIN CONFIRMACION DE ENTREGA</option>
		  
		  		  <option value="OTROS">OTROS</option>
      </select>
    </div>
			  
  <div class="form-group">
    <label for="nombre">Nombre <sub>de Quien reporta</sub></label>
    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de Quien reporta" onkeyup="mayus(this);" required>
  </div>
  <div class="form-group">
  <label for="empresa">Empresa <sub>Razón Social</sub></label>
  <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Empresa Razón Social" onkeyup="mayus(this);" required>
	  </div>
			  
		 <div class="form-group ">
  <label for="correo">E-Mail</sub></label>
  <input type="email" class="form-control" id="correo" name="correo" placeholder="E-Mail" onkeyup="mayus(this);">
	
			  </div>
		   <div class="form-group ">
  <label for="guia"># de Guia</sub></label>
  <input type="text" class="form-control" id="guia" name="guia" placeholder="# de Guia" onkeyup="mayus(this);" required title="Si son Varias Puedes Separarlas por coma ( , )" data-toggle="tooltip">
	
			  </div>
			 <div class="col-md-6"> 
			 <div class="form-group ">
  <label for="fecha_documentacion">Fecha que se Dcumento</sub></label>
  <input type="text" class="form-control" id="fecha_documentacion" name="fecha_documentacion" placeholder="Fecha que se Dcumento el Paquete" autocomplete="off">
	
			  </div></div>
	  <div class="col-md-6"> 
			  <div class="form-group ">
      <label for="inputState">Paquetera</label>
      <select id="paquetera" name="paquetera" class="form-control">
        <option selected>Selecciona...</option>
        <option value="redpack">Redpack</option>
		  <option value="paquetexpress">Paquetexpress</option>
		  <option value="fedex">Fedex</option>
		  <option value="flecha_amarilla">Flecha Amarilla</option>
		  <option value="estafeta">Estafeta</option>
		   <option value="dhl">DHL</option>
		  <option value="castores">Castores</option>
		   <option value="liat">Liat</option>
		   <option value="fletes_tauro">Fletes Tauro</option>
      </select>
    </div>
	  
	  </div>
		  
		  
			  
			  <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo    $user['id'];?>"  >
			  
			  <div class="form-group">
  <center><button type="submit" class="btn btn-info " name="genera_ticket">Generar Ticket <i class="glyphicon glyphicon-bookmark"></i></button></center>
  </div>
</form>
		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div> 

  </div>

			</div><!-- fin Modal nuevo ticket-->
			<hr>
  <div class="col-md-12">
	  
	  <div class="row">
    <div class="col-md-2 mb-3">
		
        <ul class="list-group ">
			<?php $tickets_poruser=contador_tickets_poruser("ticket",  $user['id']);?>
	  
			<a href="#sin_resolver" data-toggle="tab" class="list-group-item" style="text-decoration:none; color: black;">Tickets sin resolver
 <span class="badge alert-danger"><?php  echo $tickets_poruser["contador_tickets"];?></span>
	  </a>
			<?php $tickets_todos=contador_tickets_todos("ticket");?>
			
			<a href="#todos_sin_resolver" data-toggle="tab" class="list-group-item" style="text-decoration:none; color: black;">Todos los tickets sin resolver
 <span class="badge alert-danger"><?php  echo $tickets_todos["contador_tickets"];?></span>
	  </a>
			
			<?php $tickets_resueltos=contador_tickets_resueltos("ticket",  $user['id']);?>
			<a href="#resueltos" data-toggle="tab" class="list-group-item" style="text-decoration:none; color: black;">Tickets resueltos
 <span class="badge alert-info"><?php  echo $tickets_resueltos["contador_tickets"];?></span>
	  </a>
			
			<?php $tickets_resueltos_todos=contador_tickets_resueltos_todos("ticket");?>
			
			<a href="#todos_resueltos" data-toggle="tab" class="list-group-item" style="text-decoration:none; color: black;">Todos los tickets  resueltos
 <span class="badge alert-info"><?php  echo $tickets_resueltos_todos["contador_tickets"];?></span>
	  </a>
 <a href="#graficas" data-toggle="tab" class="list-group-item" style="text-decoration:none; color: black;">Graficas
 <span class="badge alert-info"> <i class="glyphicon glyphicon-signal"></i>
	 
	 </span>
	  </a>
			
			
</ul>	   
		
		
		
		
    </div>
		  
		  
		  
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

    echo "Creado hace ".$str;
}
	
		  function vencido($df) {

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

    echo "Vencido hace ".$str;
}
	
		  
		  
		  
		  
		  ?>
    <!-- /.col-md-4 -->
        <div class="col-md-10">
      <div class="tab-content" id="myTabContent">
		
		
		  
		  
		  
  <div class="tab-pane fade  in active" id="sin_resolver" role="tabpanel"><!--sin_resolver-->
	 	
	  <?php 
	  
	  $sin_resolver = sin_resolver($user['id']);
	  foreach ($sin_resolver as  $sin_r): ?>	
	  
	   	
	  <div class="panel panel-default">
		 <a href="ticket_detalle.php" style="text-decoration:none;color:black;">
<div class="panel-body" <?php 
		 
		 if( $sin_r['prioridad']==4){
			 ?> 
		 
		 style="background: #EC7063; color: white;"
		 <?php
		 
		 }else if( $sin_r['prioridad']==3){
		 ?>	  
		 
		 style="background: #F9E79F"
		 <?php
		  }else if( $sin_r['prioridad']==2){
		  ?>
		 
		 style="background: #AED6F1"
		 <?php
		  }
		 ?>
	></a>
	<div class="col-md-2 pull-right " >
		 
		
		
		<form action="tickets.php" method="post">
	<div class="form-group ">
      <label for="inputState">Prioridad</label>
      <select id="prioridad" name="prioridad" class="form-control" onchange="this.form.submit()">
        <option selected>Selecciona...</option>
        <option value="1">BAJA</option>
		  <option value="2" style="background:#AED6F1; ">MEDIA</option>
		  <option value="3" style="background:#F9E79F; ">ALTA</option>
		  <option value="4" style="background:#EC7063; color: white;">URGENTE</option>
      </select>
    </div>
	<input type="hidden" value="<?php echo    $sin_r['id'];?>" name="id_ticket"> 
		    
	</form>
	</div>
	  <a href="ticket_detalle.php?id=<?php echo    $sin_r['id']?>&guia=<?php echo    $sin_r['n_deguia']?>&guia=<?php echo    $sin_r['n_deguia']?>" style="text-decoration:none;color:black;" title="Ver Detalles" data-toggle="tooltip">
		 <h4> # de ticket ENV<?php echo $sin_r['id'];?></h4>
		  <br>
	<h3><?php echo   wordwrap( $sin_r['empresa'], 25, "<br>" ,FALSE);?><span class="pull-right"><?php echo   wordwrap( $sin_r['quien_reporta'], 25, "<br>" ,FALSE);?></span></h3>
	<h4>Motivo: <?php echo    $sin_r['motivo'];?> de la Guia: <?php echo   wordwrap( $sin_r['n_deguia'], 22, "<br>" ,FALSE); ?> de <?php
		if(	$sin_r['paqueteria']=='0'){
		echo" Sin Paquetera Asignada";
		}else{
			
		echo    $sin_r['paqueteria'];		
		}
		
	?>  <span class="pull-right"><?php echo    $sin_r['correo'];?></span></h4>
    <span class="pull-left col-md-4"><?php
			$fecha_creacion=$sin_r['fecha_inicio'];
			$fechamomento= date("Y-m-d H:i");
		
		  $fecha_creacion_formato = date("Y-m-d H:i", strtotime($fecha_creacion));
          //$fecha_creacion_formato_hora = date("H:i", strtotime($fecha_creacion));
		  
	
	$date1 = new DateTime($fecha_creacion_formato);
$date2 = new DateTime($fechamomento);
$diff = $date1->diff($date2);
echo get_format($diff);
				?></span>
			
			 </a>
			 
			 	 
  </div></div>
	  
	  
	  <?php endforeach;?>
		  </div><!--fin sin_resolver-->
		  
  <div class="tab-pane fade" id="todos_sin_resolver" role="tabpanel">
  
	  <?php 
	  
	  $sin_resolver = sin_resolver_todos();
	  foreach ($sin_resolver as  $sin_r): ?>	
	  
	<a href="ticket_detalle.php?id=<?php echo    $sin_r['id']?>&guia=<?php echo    $sin_r['n_deguia']?>" style="text-decoration:none;color:black;" title="Ver Detalles" data-toggle="tooltip">
		<div class="panel panel-default"  <?php 
		 
		 if( $sin_r['prioridad']==4){
			 ?> 
		 
		 style="background: #EC7063; color: white;"
		 <?php
		 
		 }else if( $sin_r['prioridad']==3){
		 ?>	  
		 
		 style="background: #F9E79F"
		 <?php
		  }else if( $sin_r['prioridad']==2){
		  ?>
		 
		 style="background: #AED6F1"
		 <?php
		  }
		 ?>
	>
<div class="panel-body">
	<h4> # de ticket ENV<?php echo $sin_r['id'];?></h4>
	<h3><?php echo   wordwrap( $sin_r['empresa'], 25, "<br>" ,FALSE);?><span class="pull-right"><?php echo    wordwrap($sin_r['quien_reporta'], 25, "<br>" ,FALSE);?></span></h3>
	<h4>Motivo: <?php echo    $sin_r['motivo'];?> de la Guia: <?php echo   wordwrap( $sin_r['n_deguia'], 22, "<br>" ,FALSE); ?> de <?php if(	$sin_r['paqueteria']=='0'){
		echo" Sin Paquetera Asignada";
		}else{
			
		echo    $sin_r['paqueteria'];		
		}?>  <span class="pull-right"><?php echo    $sin_r['correo'];?></span></h4>
	<span class="pull-left col-md-4"><?php
			$fecha_creacion=$sin_r['fecha_inicio'];
			$fechamomento= date("Y-m-d H:i:s");
		
		  $fecha_creacion_formato = date("Y-m-d H:i:s", strtotime($fecha_creacion));
		  
	
	$date1 = new DateTime($fecha_creacion_formato);
$date2 = new DateTime($fechamomento);
$diff = $date1->diff($date2);
echo get_format($diff);
		?></span><span class="pull-left col-md-3">Atendiendo por: <?php echo    $sin_r['name'];?></span>
			<span class="pull-right col-md-3"><?php
				
				if( $sin_r['prioridad']==4){
					
				$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha_creacion ) ) ;
				$nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );
						$date1 = new DateTime($nuevafecha);
$date2 = new DateTime($fechamomento);
$diff = $date1->diff($date2);
echo vencido($diff);
					
				}if( $sin_r['prioridad']==3){
					
				$nuevafecha = strtotime ( '+2 day' , strtotime ( $fecha_creacion ) ) ;
				$nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );
						$date1 = new DateTime($nuevafecha);
$date2 = new DateTime($fechamomento);
$diff = $date1->diff($date2);
echo vencido($diff);
					
				}if( $sin_r['prioridad']==2){
					
				$nuevafecha = strtotime ( '+3 day' , strtotime ( $fecha_creacion ) ) ;
				$nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );
						$date1 = new DateTime($nuevafecha);
$date2 = new DateTime($fechamomento);
$diff = $date1->diff($date2);
echo vencido($diff);
					
				}if( $sin_r['prioridad']==1){
					$nuevafecha = strtotime ( '+4 day' , strtotime ( $fecha_creacion ) ) ;
				$nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );
					
					$nuevafecha_actual = strtotime ( '+4 day' , strtotime ( $fechamomento ) ) ;
				$nuevafecha_actual = date ( 'Y-m-d H:i:s' , $nuevafecha_actual );
			//	while($sin_r['fecha_inicio']<$nuevafecha_actual){
				//	if($sin_r['fecha_inicio']<$nuevafecha_actual){
				
						//$date1 = new DateTime($nuevafecha);
/*$date2 = new DateTime($fechamomento);
					
					
$diff = $date1->diff($date2);
echo vencido($diff);*/
				//echo "en tiempo";
				//	}else{
						
					$date1 = new DateTime($nuevafecha);
$date2 = new DateTime($fechamomento);
					
					
$diff = $date1->diff($date2);
echo vencido($diff);	
				//	}
			//	}
					
				}
				
				
				/*$nuevafecha = strtotime ( '+2 day' , strtotime ( $fechamomento ) ) ;
				$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
				echo $nuevafecha;
				
				if($fecha_creacion_formato<($fechamomento+24)){
					
					echo "test";
				}else
				{
					
					echo $fechamomento;
				}*/?></span>
			</div>
   
  </div>
	  </a>
	  
	  <?php endforeach;?>
	  
	  </div>
	
 <div class="tab-pane fade" id="resueltos" role="tabpanel" >
   
	  
	  <?php 
	  
	  $sin_resolver = resueltos_user($user['id']);
	  foreach ($sin_resolver as  $sin_r): ?>	
	  
  
	<a href="ticket_detalle.php?id=<?php echo    $sin_r['id']?>&guia=<?php echo    $sin_r['n_deguia']?>" style="text-decoration:none;color:black;" title="Ver Detalles" data-toggle="tooltip"> 
		<div class="panel panel-default">
<div class="panel-body">
	<h4> # de ticket ENV<?php echo $sin_r['id'];?></h4>
	<h3><?php echo    wordwrap($sin_r['empresa'], 25, "<br>" ,FALSE);?><span class="pull-right"><?php echo    wordwrap($sin_r['quien_reporta'], 25, "<br>" ,FALSE);?></span></h3>
	<h4>Motivo: <?php echo    $sin_r['motivo'];?> de la Guia: <?php  echo   wordwrap( $sin_r['n_deguia'], 22, "<br>" ,FALSE); ?> de <?php if(	$sin_r['paqueteria']=='0'){
		echo" Sin Paquetera Asignada";
		}else{
			
		echo    $sin_r['paqueteria'];		
		}?>  <span class="pull-right"><?php echo    $sin_r['correo'];?></span></h4>
	<?php
	
	echo $sin_r['fecha_cierre'];
	
	?>
    
  </div>
	  </div></a>
	  
	  <?php endforeach;?>
	  
	  
	  </div>
		  <div class="tab-pane fade" id="todos_resueltos" role="tabpanel">
   
			  
	  <?php 
	  
	  $sin_resolver = resueltos_todos();
	  foreach ($sin_resolver as  $sin_r): ?>	
	  
	 <a href="ticket_detalle.php?id=<?php echo    $sin_r['id']?>&guia=<?php echo    $sin_r['n_deguia']?>" style="text-decoration:none;color:black;" title="Ver Detalles" data-toggle="tooltip"> 
		 <div class="panel panel-default">
<div class="panel-body">
	<h4> # de ticket ENV<?php echo $sin_r['id'];?></h4>
	<h3><?php echo    wordwrap($sin_r['empresa'], 25, "<br>" ,FALSE);?><span class="pull-right"><?php echo    wordwrap($sin_r['quien_reporta'], 25, "<br>" ,FALSE);?></span></h3>
	<h4>Motivo: <?php echo    $sin_r['motivo'];?> de la Guia: <?php echo   wordwrap( $sin_r['n_deguia'], 22, "<br>" ,FALSE); ?> de <?php if(	$sin_r['paqueteria']=='0'){
		echo" Sin Paquetera Asignada";
		}else{
			
		echo    $sin_r['paqueteria'];		
		}?>  <span class="pull-right"><?php echo    $sin_r['correo'];?></span></h4>
	<?php
	
	echo $sin_r['fecha_cierre'];
	
	?><center>Atendido por: <?php echo    $sin_r['name'];?></center>
    
  </div>
		 </div></a>
	  
	  <?php endforeach;?>
			  
			  
			  
			  
	  </div>
	
		  
		  
		  <div class="tab-pane fade"   id="graficas" role="tabpanel"><!--principio de graficas-->
	 	 
	<h2 class="pull-right">Gráfica</h2></center>
          <br>  
            
              <div id="chartdiv1" ></div>   
	  <br>   <br> <hr><hr>
              
              <center><h2>Gráfica Global Tickets</h2></center>
          <br>  
            
              <div id="chartdiv" ></div>   
          
        
          
 
		  </div> <!--fin de graficas-->
		  
		  
		  
</div>
    </div>
    <!-- /.col-md-8 -->
  </div>
			
			
			</div>  
  
  
  

<!-- /.container -->
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			 </div></div></div></div>
<script src="js/core.js"></script>
    <script src="js/charts.js"></script>
    <script src="js/animated.js"></script>
 <script src="js/es_ES.js"></script>
<script>

    am4core.useTheme(am4themes_animated);

var chart = am4core.create("chartdiv", am4charts.PieChart3D);
var chart1 = am4core.create("chartdiv1", am4charts.PieChart3D);
 

chart.legend = new am4charts.Legend();
    chart1.legend = new am4charts.Legend();

chart.data = [{
    "casos": "Tickets Resueltos",
    "valor": <?php  echo $tickets_resueltos_todos["contador_tickets"];?>,
}, {
    "casos": "Tickets No Resueltos",
    "valor": <?php  echo $tickets_todos["contador_tickets"];?>,
}
          ];

chart1.data = [{
    "casos1": "Mis Tickets Resueltos ",
    "valor1": <?php  echo $tickets_resueltos["contador_tickets"];?>,
}, {
    "casos1": "Mis Tickets No Resueltos ",
    "valor1": <?php  echo $tickets_poruser["contador_tickets"];?>,
}
          ];
    
chart.innerRadius = am4core.percent(30);
    chart1.innerRadius = am4core.percent(30);

var series = chart.series.push(new am4charts.PieSeries3D());
series.dataFields.value = "valor";
series.dataFields.category = "casos";
   
   
    var series = chart1.series.push(new am4charts.PieSeries3D());
series.dataFields.value = "valor1";
series.dataFields.category = "casos1";
 
    
  $('#fecha_documentacion').datepicker({
    format: "yyyy-mm-dd",
    clearBtn: true,
    language: "es",
	 // daysOfWeekDisabled: "0,6",
    //daysOfWeekHighlighted: "0,6",
    autoclose: true,
    todayHighlight: true,
   // datesDisabled: ['2019-09-21'],
	  //startDate:"0",
   endDate:"0",
	  	  toggleActive: true
  
	
});
  
	  
	 
  
	  
	  
  
  
  
  </script>		
			
			
			<?php include_once('layouts/footer.php'); ?>