<?php
  $page_title = 'Cotización';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);

	

if(isset($_POST['genera_cotizacion'])){
 foreach ($_POST["servicio"] as  $sin_r): 
	  $p_servicio=$p_servicio."-".$sin_r;
    endforeach;


  //$razonsocial_des = remove_junk($db->escape($_POST['razonsocial_des']));
 
   if(empty($errors)){
       
       $p_aduana = remove_junk($db->escape($_POST['aduana']));
       $p_bodega = remove_junk($db->escape($_POST['bodega']));
       $p_tramite = remove_junk($db->escape($_POST['tramite']));
       
       $p_maritimo = remove_junk($db->escape($_POST['maritimo']));
       $p_aereo = remove_junk($db->escape($_POST['aereo']));
       $p_terrestre = remove_junk($db->escape($_POST['terrestre']));
       
       
    $p_empresa = remove_junk($db->escape($_POST['empresa']));
	
       $p_cliente = remove_junk($db->escape($_POST['cliente']));
	$p_id_user = remove_junk($db->escape($_POST['id_user']));
	   $p_correo = remove_junk($db->escape($_POST['correo']));
	   $p_tel = remove_junk($db->escape($_POST['tel']));
	   $p_tipo_mercancia = remove_junk($db->escape($_POST['tipo_mercancia']));
	   $p_valor_mercancia = remove_junk($db->escape($_POST['valor_mercancia']));
	   $p_fraccion_arancelaria = remove_junk($db->escape($_POST['fraccion_arancelaria']));
	  
     $date    = make_date();
     $query  = "INSERT INTO logistica_cot (";
     $query .=" cliente, tel, correo, servicio, empresa, tipo_mercancia, valor_mercancia, fraccion_arancelaria, id_user, fecha_creacion, aduana, bodega, tramite,aereo, maritimo, terrestre ";
     $query .=") VALUES (";
$query .="'{$p_cliente}','{$p_tel}','{$p_correo}','{$p_servicio}','{$p_empresa}','{$p_tipo_mercancia}','{$p_valor_mercancia}','{$p_fraccion_arancelaria}','{$p_id_user}','{$date}','{$p_aduana}','{$p_bodega}','{$p_tramite}','{$p_aereo}','{$p_maritimo}','{$p_terrestre}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
       
	  $session->msg('s',"Cotización Agregada Correctamente ");
      echo '<meta http-equiv="Refresh" content="0; url=logistica_cot.php">';
		 // redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Agregar la Cotización.');
      echo '<meta http-equiv="Refresh" content="0; url=logistica_cot.php">';
			//redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
    echo '<meta http-equiv="Refresh" content="0; url=logistica_cot.php">';
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
    
    
	
    

    
    
  
/*Checkboxes styles*/
input[type="checkbox"] { display: none; }

input[type="checkbox"] + label {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 20px;
   
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
}

input[type="checkbox"] + label:last-child { margin-bottom: 0; }

input[type="checkbox"] + label:before {
  content: '';
  display: block;
  width: 20px;
  height: 20px;
  border: 1px solid red;
  position: absolute;
  left: 0;
  top: 0;
  opacity: .6;
  -webkit-transition: all .12s, border-color .08s;
  transition: all .12s, border-color .08s;
}

input[type="checkbox"]:checked + label:before {
  width: 10px;
  top: -5px;
  left: 5px;
  border-radius: 0;
  opacity: 1;
  border-top-color: transparent;
  border-left-color: transparent;
  -webkit-transform: rotate(45deg);
  transform: rotate(45deg);
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
	
  <h2><i class="glyphicon glyphicon-globe"></i> Cotización <button type="button" class="btn btn-default " data-toggle="modal" data-target="#nuevo_ticket"><i class="glyphicon glyphicon-plus"></i> Nueva</button></h2>
			 <!-- Modal nuevo ticket-->
<div id="nuevo_ticket" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal agrega proyecto-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <center><h4 class="modal-title">Nueva Cotización</h4></center>
      </div>
      <div class="modal-body">
        
		  
		  <form action="logistica_cot.php" method="post">
			  
      
               <div class="form-group">
    <label for="nombre">Empresa </label>
    <input type="text" class="form-control"  name="empresa" placeholder="Empresa a quien se cotiza" onkeyup="mayus(this);" required>
  </div> 
                  
                  <div class="form-group">
    <label for="nombre">Nombre </label>
    <input type="text" class="form-control"  name="cliente" placeholder="Nombre del cliente" onkeyup="mayus(this);" required>
  </div> 
                  
    
                  
                  
                    <div class="col-md-6">
                 <div class="form-group">
    <label for="nombre">Correo </label>
    <input type="email" class="form-control"  name="correo" placeholder="Correo cliente" onkeyup="mayus(this);" >
  </div>  
                        
                        </div>
                  
                  
                   <div class="col-md-6">
                <div class="form-group">
    <label for="nombre">Teléfono </label>
    <input type="tel" class="form-control"  name="tel" placeholder="Teléfono" onkeyup="mayus(this);" >
  </div>  
                  
                  </div>
                  
                  
                  <div class="form-group ">
      <label for="inputState">Servicio</label><br>
                  
                  <div class="col-md-6">
                  <div class="boxes">
  <input type="checkbox" name="aduana" id="box-1" value="1">
  <label for="box-1">Aduana</label>

  <input type="checkbox" name="bodega" value="1" id="box-2">
  <label for="box-2">Bodega </label>

  <input type="checkbox" name="tramite" value="1" id="box-3">
  <label for="box-3">Tramite</label>
</div>
                  
                  </div>
                  
                  
                  <div class="col-md-6">
                  <div class="boxes">
  <input type="checkbox" name="aereo" id="box-4" value="1">
  <label for="box-4">Flete Aereo</label>

  <input type="checkbox" name="terrestre" id="box-5"  value="1">
  <label for="box-5">Flete Terrestre </label>

  <input type="checkbox" name="maritimo" id="box-6" value="1">
  <label for="box-6">Flete Maritimo</label>
</div>
                  
                  </div> 
                  
                  
                  
                  
                  
          
              </div>
              
              
			  
  

                <div class="form-group">
    <label for="nombre">Tipo de Mercancia </label>
    <input type="text" class="form-control"  name="tipo_mercancia" placeholder="Tipo  de Mercancia" onkeyup="mayus(this);" >
  </div>  
                   
                  
			  
		 <div class="col-md-6">
                <div class="form-group">
    <label for="nombre">Valor de la Mercancia </label>
    <input type="text" class="form-control"  name="valor_mercancia" placeholder="Valor que Tiene la Mercancia" onkeyup="mayus(this);" >
  </div>  
                  
                  </div>
              <div class="col-md-6">
                <div class="form-group">
    <label for="nombre">Fracción Arancelaria </label>
    <input type="text" class="form-control"  name="fraccion_arancelaria" placeholder="Fraccion Arancelaria" onkeyup="mayus(this);" >
  </div>  
                  
                  </div>
              
		   
			 
	  
		  
		  
			  
			  <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo    $user['id'];?>"  >
			  
			  <div class="form-group">
  <center><button type="submit" class="btn btn-info " name="genera_cotizacion">Agrega Cotización <i class="glyphicon glyphicon-plus"></i></button></center>
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
			<?php $tickets_poruser=contador_mis_cotizaciones("logistica_cot",  $user['id']);?>
	  		<a href="#sin_resolver" data-toggle="tab" class="list-group-item" style="text-decoration:none; color: black;">Mis Cotizaciones
 <span class="badge alert-info"><?php  echo $tickets_poruser["contador_cotizacion"];?></span>
	  </a>
			<?php $tickets_resueltos=contador_cotizaciones_mias_aceptadas("logistica_cot",  $user['id']);?>
			<a href="#resueltos" data-toggle="tab" class="list-group-item" style="text-decoration:none; color: black;">Mis Cotizaciones <br>Aceptadas
 <span class="badge alert-success"><?php  echo $tickets_resueltos["contador_aceptdas"];?></span>
	  </a>
            
            	<?php $mias_noaceptadas_contador=contador_cotizaciones_mias_no_aceptadas("logistica_cot",  $user['id']);?>
			<a href="#mias_no_aceptadas" data-toggle="tab" class="list-group-item" style="text-decoration:none; color: black;">Mis Cotizaciones <br>No Aceptadas
 <span class="badge alert-danger"><?php  echo $mias_noaceptadas_contador["contador_no_aceptdas"];?></span>
	  </a>
            
            
            <?php $tickets_todos=contador_log_cotiza_todos("logistica_cot");?>
			<a href="#todos_sin_resolver" data-toggle="tab" class="list-group-item" style="text-decoration:none; color: black;">Todas las Cotizaciones<br>Activas
 <span class="badge alert-success"><?php  echo $tickets_todos["contador_cotizaciones"];?></span>
	  </a>
			
			
			
			<?php $tickets_resueltos_todos=contador_aceptadas_todas("logistica_cot");?>
			
			<a href="#todos_resueltos" data-toggle="tab" class="list-group-item" style="text-decoration:none; color: black;">Todas las Cotizaciones<br>Aceptdas
 <span class="badge alert-info"><?php  echo $tickets_resueltos_todos["contador_aceptadas_todas"];?></span>
	  </a>
            
            	<?php $cot_no_aceptadas_todas=contador_no_aceptadas_todas("logistica_cot");?>
 <a href="#no_aceptadass" data-toggle="tab" class="list-group-item" style="text-decoration:none; color: black;">No Aceptadas
 <span class="badge alert-danger"> <?php  echo $cot_no_aceptadas_todas["contador_no_aceptadas_todas"];?></span>
	 
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
		
		
		  
		  
	 
	  
	  
            
	   <div class="tab-pane fade  in active" id="sin_resolver" role="tabpanel" ><!--sin_resolver-->
	 	<?php 
           $log_agregados = logistica_cot_agregados($user['id']);
	  foreach ($log_agregados as  $sin_r): ?>	  
 
	  	<a href="logistica_cot_detalles.php?id=<?php echo    $sin_r['id']?>" style="text-decoration:none;color:black;" title="Ver Detalles" data-toggle="tooltip">
           
           
	   	
	  <div class="panel panel-default">
		 
	<div class="panel-body">
	 
		 <h4> # de Cotización <?php echo $sin_r['id'];?></h4>
		  <br>
          <h3><sub>Empresa:</sub> <?php echo   wordwrap( $sin_r['empresa'], 25, "<br>" ,FALSE);?><span class="pull-right"><?php echo   wordwrap( $sin_r['cliente'], 25, "<br>" ,FALSE);?></span></h3>
	<h4><br><span class="pull-right"><?php echo    $sin_r['correo'];?><br><?php echo    $sin_r['tel'];?></span></h4>
          <h4>
          Detalles<br>
         
        
              Servicios Requeridos:  
<?php 
              if($sin_r['aduana']==1){ 
                  echo " Aduana ";
              }if($sin_r['bodega']==1){echo " Bodega ";
                }if($sin_r['tramite']==1){
                  echo " Tramites ";
              }if($sin_r['aereo']==1){
                  echo " Aereo ";
                  
              }if($sin_r['maritimo']==1){
                  echo " Maritimo ";}
              if($sin_r['terrestre']==1){
                  echo " Terrestre ";
              }
             
              ?>
              <br>
          Tipo de Mercancia: <?php echo    $sin_r['tipo_mercancia'];?><br>
              Valor de Mercancia: $<?php echo    $sin_r['valor_mercancia'];?>
          
           </h4>
          
    <span class="pull-right col-md-4">
        <?php
			$fecha_creacion=$sin_r['fecha_creacion'];
			$fechamomento= date("Y-m-d H:i");
		
		  $fecha_creacion_formato = date("Y-m-d H:i", strtotime($fecha_creacion));
          //$fecha_creacion_formato_hora = date("H:i", strtotime($fecha_creacion));
		  
	
	$date1 = new DateTime($fecha_creacion_formato);
$date2 = new DateTime($fechamomento);
$diff = $date1->diff($date2);
echo get_format($diff);
				?></span>
          		
			 
			 <br><br>
			 	 
  </div> 
	  </div>   </a>
	  
	  <?php endforeach;?>
       	</div>  <!--  fin sin_resolver-->
		  
          
  <div class="tab-pane fade" id="todos_sin_resolver" role="tabpanel">
  
	 <?php 
           $log_agregados = logistica_cot_todos();
	  foreach ($log_agregados as  $sin_r): ?>	  
 
	  	<a href="logistica_cot_detalles.php?id=<?php echo    $sin_r['id']?>" style="text-decoration:none;color:black;" title="Ver Detalles" data-toggle="tooltip">
           
           
	   	
	  <div class="panel panel-default">
		 
	<div class="panel-body">
	 
		 <h4> # de Cotización <?php echo $sin_r['id'];?></h4>
		  <br>
          <h3><sub>Empresa:</sub> <?php echo   wordwrap( $sin_r['empresa'], 25, "<br>" ,FALSE);?><span class="pull-right"><?php echo   wordwrap( $sin_r['cliente'], 25, "<br>" ,FALSE);?></span></h3>
	<h4><br><span class="pull-right"><?php echo    $sin_r['correo'];?><br><?php echo    $sin_r['tel'];?></span></h4>
          <h4>
          Detalles<br>
         
        
              Servicios Requeridos: <?php 
              if($sin_r['aduana']==1){ 
                  echo " Aduana ";
              }if($sin_r['bodega']==1){echo " Bodega ";
                }if($sin_r['tramite']==1){
                  echo " Tramites ";
              }if($sin_r['aereo']==1){
                  echo " Aereo ";
                  
              }if($sin_r['maritimo']==1){
                  echo " Maritimo ";}
              if($sin_r['terrestre']==1){
                  echo " Terrestre ";
              }
             
              ?><br>
          Tipo de Mercancia: <?php echo    $sin_r['tipo_mercancia'];?><br>
              Valor de Mercancia: $<?php echo    $sin_r['valor_mercancia'];?>
          
           </h4>
          
    <span class="pull-right col-md-4">
        <?php
			$fecha_creacion=$sin_r['fecha_creacion'];
			$fechamomento= date("Y-m-d H:i");
		
		  $fecha_creacion_formato = date("Y-m-d H:i", strtotime($fecha_creacion));
          //$fecha_creacion_formato_hora = date("H:i", strtotime($fecha_creacion));
		  
	
	$date1 = new DateTime($fecha_creacion_formato);
$date2 = new DateTime($fechamomento);
$diff = $date1->diff($date2);
echo get_format($diff);
				?></span>
          		
			 <br>
			 
			 	<center>Atendido por: <?php echo    $sin_r['name'];?></center> 
  </div> 
	  </div>   </a>
	  
	  <?php endforeach;?>
	  
	  </div>
	
 <div class="tab-pane fade" id="resueltos" role="tabpanel" >
   	<?php 
           $log_agregados = logistica_cot_aceptadas($user['id']);
	  foreach ($log_agregados as  $sin_r): ?>	  
 
	  	<a href="logistica_cot_detalles.php?id=<?php echo    $sin_r['id']?>" style="text-decoration:none;color:black;" title="Ver Detalles" data-toggle="tooltip">
           
           
	   	
	  <div class="panel panel-default">
		 
	<div class="panel-body">
	 
		 <h4> # de Cotización <?php echo $sin_r['id'];?></h4>
		  <br>
          <h3><sub>Empresa:</sub> <?php echo   wordwrap( $sin_r['empresa'], 25, "<br>" ,FALSE);?><span class="pull-right"><?php echo   wordwrap( $sin_r['cliente'], 25, "<br>" ,FALSE);?></span></h3>
	<h4><br><span class="pull-right"><?php echo    $sin_r['correo'];?><br><?php echo    $sin_r['tel'];?></span></h4>
          <h4>
          Detalles<br>
         
        
              Servicios Requeridos:  <?php 
              if($sin_r['aduana']==1){ 
                  echo " Aduana ";
              }if($sin_r['bodega']==1){echo " Bodega ";
                }if($sin_r['tramite']==1){
                  echo " Tramites ";
              }if($sin_r['aereo']==1){
                  echo " Aereo ";
                  
              }if($sin_r['maritimo']==1){
                  echo " Maritimo ";}
              if($sin_r['terrestre']==1){
                  echo " Terrestre ";
              }
             
              ?><br>
          Tipo de Mercancia: <?php echo    $sin_r['tipo_mercancia'];?><br>
              Valor de Mercancia: $<?php echo    $sin_r['valor_mercancia'];?>
          
           </h4>
          
    <span class="pull-right col-md-4">
        <?php
			$fecha_creacion=$sin_r['fecha_creacion'];
			$fechamomento= date("Y-m-d H:i");
		
		  $fecha_creacion_formato = date("Y-m-d H:i", strtotime($fecha_creacion));
          //$fecha_creacion_formato_hora = date("H:i", strtotime($fecha_creacion));
		  
	
	$date1 = new DateTime($fecha_creacion_formato);
$date2 = new DateTime($fechamomento);
$diff = $date1->diff($date2);
echo get_format($diff);
				?></span>
          		
			 
			 <br><br>
			 	 
  </div> 
	  </div>   </a>
	  
	  <?php endforeach;?>
	  
	  </div>
		  <div class="tab-pane fade" id="todos_resueltos" role="tabpanel">
   
	<?php 
           $log_agregados = resueltos_todos_cotizacion();
	  foreach ($log_agregados as  $sin_r): ?>	  
 
	  	<a href="logistica_cot_detalles.php?id=<?php echo    $sin_r['id']?>" style="text-decoration:none;color:black;" title="Ver Detalles" data-toggle="tooltip">
           
           
	   	
	  <div class="panel panel-default">
		 
	<div class="panel-body">
	 
		 <h4> # de Cotización <?php echo $sin_r['id'];?></h4>
		  <br>
          <h3><sub>Empresa:</sub> <?php echo   wordwrap( $sin_r['empresa'], 25, "<br>" ,FALSE);?><span class="pull-right"><?php echo   wordwrap( $sin_r['cliente'], 25, "<br>" ,FALSE);?></span></h3>
	<h4><br><span class="pull-right"><?php echo    $sin_r['correo'];?><br><?php echo    $sin_r['tel'];?></span></h4>
          <h4>
          Detalles<br>
         
        
              Servicios Requeridos:  <?php 
              if($sin_r['aduana']==1){ 
                  echo " Aduana ";
              }if($sin_r['bodega']==1){echo " Bodega ";
                }if($sin_r['tramite']==1){
                  echo " Tramites ";
              }if($sin_r['aereo']==1){
                  echo " Aereo ";
                  
              }if($sin_r['maritimo']==1){
                  echo " Maritimo ";}
              if($sin_r['terrestre']==1){
                  echo " Terrestre ";
              }
             
              ?><br>
          Tipo de Mercancia: <?php echo    $sin_r['tipo_mercancia'];?><br>
              Valor de Mercancia: $<?php echo    $sin_r['valor_mercancia'];?>
          
           </h4>
          
    <span class="pull-right col-md-4">
        <?php
			$fecha_creacion=$sin_r['fecha_creacion'];
			$fechamomento= date("Y-m-d H:i");
		
		  $fecha_creacion_formato = date("Y-m-d H:i", strtotime($fecha_creacion));
          //$fecha_creacion_formato_hora = date("H:i", strtotime($fecha_creacion));
		  
	
	$date1 = new DateTime($fecha_creacion_formato);
$date2 = new DateTime($fechamomento);
$diff = $date1->diff($date2);
echo get_format($diff);
				?></span>
          		
			 <br>
			 
			 	<center>Atendido por: <?php echo    $sin_r['name'];?></center> 
  </div> 
	  </div>   </a>
	
	  <?php endforeach;?>
			  
			  
			  
			  
	  </div>
	
          
           <div class="tab-pane fade"   id="no_aceptadass" role="tabpanel"><!--principio de no aceptadas-->
	 	 
	
	<?php 
           $log_agregados = no_aceptados_todos_cotizacion();
	  foreach ($log_agregados as  $sin_r): ?>	  
 
	  	<a href="logistica_cot_detalles.php?id=<?php echo    $sin_r['id']?>" style="text-decoration:none;color:black;" title="Ver Detalles" data-toggle="tooltip">
           
           
	   	
	  <div class="panel panel-default">
		 
	<div class="panel-body">
	 
		 <h4> # de Cotización <?php echo $sin_r['id'];?></h4>
		  <br>
          <h3><sub>Empresa:</sub> <?php echo   wordwrap( $sin_r['empresa'], 25, "<br>" ,FALSE);?><span class="pull-right"><?php echo   wordwrap( $sin_r['cliente'], 25, "<br>" ,FALSE);?></span></h3>
	<h4><br><span class="pull-right"><?php echo    $sin_r['correo'];?><br><?php echo    $sin_r['tel'];?></span></h4>
          <h4>
          Detalles<br>
         
        
              Servicios Requeridos:  <?php 
              if($sin_r['aduana']==1){ 
                  echo " Aduana ";
              }if($sin_r['bodega']==1){echo " Bodega ";
                }if($sin_r['tramite']==1){
                  echo " Tramites ";
              }if($sin_r['aereo']==1){
                  echo " Aereo ";
                  
              }if($sin_r['maritimo']==1){
                  echo " Maritimo ";}
              if($sin_r['terrestre']==1){
                  echo " Terrestre ";
              }
             
              ?><br>
          Tipo de Mercancia: <?php echo    $sin_r['tipo_mercancia'];?><br>
              Valor de Mercancia: $<?php echo    $sin_r['valor_mercancia'];?>
          
           </h4>
          
    <span class="pull-right col-md-4">
        <?php
			$fecha_creacion=$sin_r['fecha_creacion'];
			$fechamomento= date("Y-m-d H:i");
		
		  $fecha_creacion_formato = date("Y-m-d H:i", strtotime($fecha_creacion));
          //$fecha_creacion_formato_hora = date("H:i", strtotime($fecha_creacion));
		  
	
	$date1 = new DateTime($fecha_creacion_formato);
$date2 = new DateTime($fechamomento);
$diff = $date1->diff($date2);
echo get_format($diff);
				?></span>
          		
			 <br>
			 
			 	<center>Atendido por: <?php echo    $sin_r['name'];?></center> 
  </div> 
	  </div>   </a>
	
	  <?php endforeach;?>

		  </div> <!--fin de no aceptadas-->
          
          
          
          
		  
		  
		
		  
           
            
            
            <div class="tab-pane fade"   id="mias_no_aceptadas" role="tabpanel"><!--principio de no aceptadas mias-->
	 
 	<?php 
           $log_agregados = mias_no_aceptdas($user['id']);
	  foreach ($log_agregados as  $sin_r): ?>	  
 
	  	<a href="logistica_cot_detalles.php?id=<?php echo    $sin_r['id']?>" style="text-decoration:none;color:black;" title="Ver Detalles" data-toggle="tooltip">
           
           
	   	
	  <div class="panel panel-default">
		 
	<div class="panel-body">
	 
		 <h4> # de Cotización <?php echo $sin_r['id'];?></h4>
		  <br>
          <h3><sub>Empresa:</sub> <?php echo   wordwrap( $sin_r['empresa'], 25, "<br>" ,FALSE);?><span class="pull-right"><?php echo   wordwrap( $sin_r['cliente'], 25, "<br>" ,FALSE);?></span></h3>
	<h4><br><span class="pull-right"><?php echo    $sin_r['correo'];?><br><?php echo    $sin_r['tel'];?></span></h4>
          <h4>
          Detalles<br>
         
        
              Servicios Requeridos:  
<?php 
              if($sin_r['aduana']==1){ 
                  echo " Aduana ";
              }if($sin_r['bodega']==1){echo " Bodega ";
                }if($sin_r['tramite']==1){
                  echo " Tramites ";
              }if($sin_r['aereo']==1){
                  echo " Aereo ";
                  
              }if($sin_r['maritimo']==1){
                  echo " Maritimo ";}
              if($sin_r['terrestre']==1){
                  echo " Terrestre ";
              }
             
              ?>
              <br>
          Tipo de Mercancia: <?php echo    $sin_r['tipo_mercancia'];?><br>
              Valor de Mercancia: $<?php echo    $sin_r['valor_mercancia'];?>
          
           </h4>
          
    <span class="pull-right col-md-4">
        <?php
			$fecha_creacion=$sin_r['fecha_creacion'];
			$fechamomento= date("Y-m-d H:i");
		
		  $fecha_creacion_formato = date("Y-m-d H:i", strtotime($fecha_creacion));
          //$fecha_creacion_formato_hora = date("H:i", strtotime($fecha_creacion));
		  
	
	$date1 = new DateTime($fecha_creacion_formato);
$date2 = new DateTime($fechamomento);
$diff = $date1->diff($date2);
echo get_format($diff);
				?></span>
          		
			 
			 <br><br>
			 	 
  </div> 
	  </div>   </a>
	  
	  <?php endforeach;?>
		  </div> <!--fin deno aceptads mias-->
          
        
            <div class="tab-pane fade"   id="graficas" role="tabpanel"><!--principio de graficas-->
	<h2 class="pull-right">Gráfica</h2></center>
          <br>  
            
              <div id="chartdiv1" ></div>   
	  <br>   <br> <hr><hr>
              
              <center><h2>Gráfica Global</h2></center>
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
    "casos": "Cotizaciones Aceptadas",
    "valor": <?php  echo $tickets_resueltos_todos["contador_aceptadas_todas"];?>,
}, {
    "casos": "Cotizaciones Rechazadas",
    "valor": <?php  echo $cot_no_aceptadas_todas["contador_no_aceptadas_todas"];?>,
}
          ];

chart1.data = [{
    "casos1": "Cotizaciones Aceptadas Mias ",
    "valor1": <?php  echo $tickets_resueltos["contador_aceptdas"];?>,
}, {
    "casos1": "Cotizaciones Rechazadas Mias ",
    "valor1": <?php  echo $mias_noaceptadas_contador["contador_no_aceptdas"];?>,
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