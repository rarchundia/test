<?php
  $page_title = 'Contactos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
?>
<?php
$recent_sales = todo_contactos((int)$_GET['id']);
$accion = acciones((int)$_GET['id']);

/*if(!$recent_sales){
  $session->msg("d","Id de Contacto Desconocido.");
  redirect('pipedrive.php');
}*/
?>
<?php
 if(isset($_POST['finaliza'])){
    
	 
	 if(empty($errors)){
       $p_empresa = remove_junk($db->escape($_POST['empresa_acta']));
       $query   = "UPDATE contacto SET";
       $query  .=" ganado_perdido ='3'";
       $query  .=" WHERE id ='{$p_empresa}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"En Espera de Validacion de los Documentos ");
                 redirect('detalle_contacto.php?id='.$p_empresa, false);
               } else {
                 $session->msg('d',' Lo Siento, Faltan Documentos Por Subir.');
                 redirect('detalle_contacto.php?id='.$p_empresa, false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('detalle_contacto.php?id='.$p_empresa, false);
   }

 }

?>
<?php
 if(isset($_POST['ganado'])){
    
	 
	 if(empty($errors)){
       $p_id_contacto = remove_junk($db->escape($_POST['id_contacto']));
       $date    = make_date();
       $query   = "UPDATE contacto SET";
       $query  .=" ganado_perdido ='1', gana_per_fecha='{$date}'";
       $query  .=" WHERE id ='{$p_id_contacto}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Se Ha Actualizado el Estatus a Ganado. ");
                 redirect('detalle_contacto.php?id='.$p_id_contacto, false);
               } else {
                 $session->msg('d',' Lo Siento, Atualización Del  Estatus Falló.');
                 redirect('detalle_contacto.php?id='.$p_id_contacto, false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('detalle_contacto.php?id='.$p_id_contacto, false);
   }

 }

?>
<?php
 if(isset($_POST['perdido'])){
    
	 
	 if(empty($errors)){
       $p_id_contacto = remove_junk($db->escape($_POST['id_contacto']));
       $date    = make_date();
       $query   = "UPDATE contacto SET";
       $query  .=" ganado_perdido ='2', gana_per_fecha='{$date}'";
       $query  .=" WHERE id ='{$p_id_contacto}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Se Ha Actualizado el Estatus a Perdido. ");
                 redirect('detalle_contacto.php?id='.$p_id_contacto, false);
               } else {
                 $session->msg('d',' Lo Siento, Atualización Del  Estatus Falló.');
                 redirect('detalle_contacto.php?id='.$p_id_contacto, false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('detalle_contacto.php?id='.$p_id_contacto, false);
   }

 }

?>


<style>


body{
  color: #333;
}

header h1{
  text-align: center;
  font-weight: bold;
  margin-top: 0;
}
  
 header p{
   text-align: center;
   margin-bottom: 0;
 }

.hexa{
  border: 0px;
  float: left;
  text-align:center;
  height: 35px;
  width: 60px;
  font-size: 22px;
  background: #f0f0f0;
  color: #3c3c3c;
  position: relative;
  margin-top: 15px;
}

.hexa:before{
  content: ""; 
  position: absolute; 
  left: 0; 
  width: 0; 
  height: 0;
  border-bottom: 15px solid #f0f0f0;
  border-left: 30px solid transparent;
  border-right: 30px solid transparent;
  top: -15px;
}

.hexa:after{
  content: ""; 
  position: absolute; 
  left: 0; 
  width: 0; 
  height: 0;
  border-left: 30px solid transparent;
  border-right: 30px solid transparent;
  border-top: 15px solid #f0f0f0;
  bottom: -15px;
}

.timeline {
  position: relative;
  padding: 0;
  width: 100%;
  margin-top: 20px;
  list-style-type: none;
}

.timeline:before {
  position: absolute;
  left: 30%;
  top: 0;
  content: ' ';
  display: block;
  width: 2px;
  height: 100%;
  margin-left: -1px;
  background: rgb(213,213,213);
  background: -moz-linear-gradient(top, rgba(213,213,213,0) 0%, rgb(213,213,213) 8%, rgb(213,213,213) 92%, rgba(213,213,213,0) 100%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(30,87,153,1)), color-stop(100%,rgba(125,185,232,1)));
  background: -webkit-linear-gradient(top, rgba(213,213,213,0) 0%, rgb(213,213,213) 8%, rgb(213,213,213) 92%, rgba(213,213,213,0) 100%);
  background: -o-linear-gradient(top, rgba(213,213,213,0) 0%, rgb(213,213,213) 8%, rgb(213,213,213) 92%, rgba(213,213,213,0) 100%);
  background: -ms-linear-gradient(top, rgba(213,213,213,0) 0%, rgb(213,213,213) 8%, rgb(213,213,213) 92%, rgba(213,213,213,0) 100%);
  background: linear-gradient(to bottom, rgba(213,213,213,0) 0%, rgb(213,213,213) 8%, rgb(213,213,213) 92%, rgba(213,213,213,0) 100%);
  z-index: 5;
}

.timeline li {
  padding: 1em 0;
}

.timeline .hexa{
  width: 16px;
  height: 10px;
  position: absolute;
  background: #00c4f3;
  z-index: 5;
  left: 0;
  right: 0;
  margin-left:auto;
  margin-right:auto;
  top: -30px;
  margin-top: 0;
}

.timeline .hexa:before {
  border-bottom: 4px solid #00c4f3;
  border-left-width: 8px;
  border-right-width: 8px;
  top: -4px;
}

.timeline .hexa:after {
  border-left-width: 8px;
  border-right-width: 8px;
  border-top: 4px solid #00c4f3;
  bottom: -4px;
}

.direction-l,
.direction-r {
  float: none;
  width: 100%;
  text-align: center;
	left: -20%;
}

.flag-wrapper {
  text-align: center;
  position: relative;
}

.flag {
  position: relative;
  display: inline;
  background: rgb(255,255,255);
  font-weight: 600;
  z-index: 15;
  padding: 6px 10px;
  text-align: left;
  border-radius: 5px;
}

.direction-l .flag:after,
.direction-r .flag:after {
  content: "";
  position: absolute;
  left: 30%;
  top: -15px;
  height: 0;
  width: 0;
  margin-left: -8px;
  border: solid transparent;
  border-bottom-color: rgb(255,255,255);
  border-width: 8px;
  pointer-events: none;
}

.direction-l .flag {
  -webkit-box-shadow: -1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
  -moz-box-shadow: -1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
  box-shadow: -1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
}

.direction-r .flag {
  -webkit-box-shadow: 1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
  -moz-box-shadow: 1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
  box-shadow: 1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
}

.time-wrapper {
  display: block;
  position: relative;
  margin: 4px 0 0 0;
  z-index: 14;
  line-height: 1em;
  vertical-align: middle;
  color: #fff;
}

.direction-l .time-wrapper {
  float: none;
}

.direction-r .time-wrapper {
  float: none;
}

.time {
  background:#FF1456;

  display: inline-block;
  padding: 8px;
}

.desc {
  position: relative;
  margin: 1em 0 0 0;
  padding: 1em;
  background: rgb(254,254,254);
  -webkit-box-shadow: 0 0 1px rgba(0,0,0,0.20);
  -moz-box-shadow: 0 0 1px rgba(0,0,0,0.20);
  box-shadow: 0 0 1px rgba(0,0,0,0.20);
  z-index: 15;
}

.direction-l .desc,
.direction-r .desc {
  position: relative;
  margin: 1em 1em 0 1em;
  padding: 1em;
  z-index: 15;
}

@media(min-width: 768px){
  .timeline {
    width: 660px;
    margin: 0 auto;
    margin-top: 20px;
  }

  .timeline li:after {
    content: "";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden;
  }
  
  .timeline .hexa {
    left: -28px;
    right: auto;
    top: 8px;
  }

  .timeline .direction-l .hexa {
    left: auto;
    right: -28px;
  }

  .direction-l {
    position: relative;
    width: 310px;
    float: left;
    text-align: right;
  }

  .direction-r {
    position: relative;
    width: 310px;
    float: right;
    text-align: left;
  }

  .flag-wrapper {
    display: inline-block;
  }
  
  .flag {
    font-size: 18px;
  }

  .direction-l .flag:after {
    left: auto;
    right: -16px;
    top: 50%;
    margin-top: -8px;
    border: solid transparent;
    border-left-color: rgb(254,254,254);
    border-width: 8px;
  }

  .direction-r .flag:after {
    top: 50%;
    margin-top: -8px;
    border: solid transparent;
    border-right-color: rgb(254,254,254);
    border-width: 8px;
    left: -8px;
  }

  .time-wrapper {
    display: inline;
    vertical-align: middle;
    margin: 0;
  }

  .direction-l .time-wrapper {
    float: left;
  }

  .direction-r .time-wrapper {
    float: right;
  }

  .time {
    padding: 5px 10px;
  }

  .direction-r .desc {
    margin: 1em 0 0 0.75em;
  }
}

@media(min-width: 992px){
  .timeline {
    width: 800px;
    margin: 0 auto;
    margin-top: 20px;
  }

  .direction-l {
    position: relative;
    width: 380px;
    float: left;
    text-align: right;
  }

  .direction-r {
    position: relative;
    width: 380px;
    float: right;
    text-align: left;
  }
}

	
</style>
<?php include_once('layouts/header.php'); ?>
<div class="row">

			
			
			
							<div class="col-md-12"><!--principio de contactos-->
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-user"></span>
            <span>Detalle de Contacto<span class="pull-right">

	 <a href="pipedrive.php" class="btn btn-info pull-right">Regresar</a>
	</span> </span>
          </strong>
        </div>
        <div class="panel-body">
			<?php foreach ($recent_sales as  $recent_sale): ?>
	
			<div class="col-md-6" id="contacto_div">	
	<div class="card" style="width: 100%;">
		<li class="list-group-item text-center"><span class="glyphicon glyphicon-user" style="font-size:40px; color:gray;" ></span>
		<span class="pull-right">

	
	</span>
		
		</li>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">
		
		<span class="glyphicon glyphicon-user"></span> Contacto:  <?php echo remove_junk(first_character($recent_sale['contacto']));?>
		
		<a href="edit_contacto.php?id=<?php echo $recent_sale['id'] ?>"> <label class=" glyphicon glyphicon-pencil" title="Editar Contacto" data-toggle="tooltip" ></label></a>
	  </li>
	 
	  <li class="list-group-item"><span class="glyphicon glyphicon-briefcase
"></span> Empresa: <span class="glyphicon glyphicon-search"> </span> <a href="https://www.google.com/search?q=<?php echo $recent_sale['empresa']; ?>" target="_blank" title="Buscalo en Google" data-toggle="tooltip"><?php echo remove_junk(first_character($recent_sale['empresa'])); ?></a></li>
	  
	  <li class="list-group-item">
		  
		  <span class="glyphicon glyphicon-phone-alt
"></span> Teléfono:   <a href="tel:+52<?php echo remove_junk(ucfirst($recent_sale['telefono'])); ?>" title="Si lo Visualizas desde el Teléfono Puedes Marcarlo Directamente al Hacer Click" data-toggle="tooltip"><?php echo remove_junk(ucfirst($recent_sale['telefono'])); ?></a>
		  
		  <?php //echo remove_junk(first_character($recent_sale['telefono']));?></li>
	  
	  
	  
	  
    <li class="list-group-item"><span class="glyphicon glyphicon-map-marker
"></span> Dirección:  <a href="https://maps.google.com/?q=<?php echo remove_junk(ucfirst($recent_sale['domicilio'])); ?>" target="_blank" title="Buscalo en el Mapa" data-toggle="tooltip">
			   
				<?php echo remove_junk(ucfirst($recent_sale['domicilio'])); ?> CP: <?php echo remove_junk(ucfirst($recent_sale['cp'])); ?>  Del. <?php echo remove_junk(ucfirst($recent_sale['delegacion'])); ?></a></li>
    <li class="list-group-item"><span class="glyphicon glyphicon-envelope
"></span> Correo: <a href="mailto:<?php echo mb_strtolower($recent_sale['correo'],'UTF-8');?>" title="Da click Para Mandar Correo " data-toggle="tooltip"><?php echo mb_strtolower($recent_sale['correo'],'UTF-8');?></a></li>
	  <!--<li class="list-group-item">Vestibulum at eros<br><br><br></li>-->
	  
  </ul>
</div>
				</div>		
		<div class="col-md-5">		
	<div class="card" style="width: 38rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item" id="variable_tabla">Ganado-Perdido</li>
    
   
			
	
			
			
          
			   
			   
			   <?php if( $recent_sale['ganado_perdido']==0){ //si es cliente ganado?>
			   
			   
			   
			  <div class="col-md-5">	 <form action="detalle_contacto.php?id=<?php echo (int)$recent_sale['id'] ?>" method="post">
				  
				 
					<input  type="hidden" name="id_contacto" value="<?php echo (int)$recent_sale['id']; ?>">	
				  
				  <button type="submit" name="ganado" class="btn btn-success btn-block"><i class="glyphicon glyphicon-ok"></i>     Ganado     </button>
				  </form></div>
			   <div class="col-md-5">	
			   
			 <form action="detalle_contacto.php?id=<?php echo (int)$recent_sale['id'] ?>" method="post">
			<input  type="hidden" name="id_contacto" value="<?php echo (int)$recent_sale['id']; ?>">	
				 <button type="submit" name="perdido" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-remove"></i>     Perdido     </button>
				   </form> </div>
		 <?php } else if( $recent_sale['ganado_perdido']==1){  // si es cliente se marca como ganado?>
			        
			   <script>
document.getElementById("variable_tabla").innerHTML = "1.-  Cargar Documentos";
</script>
			   <style>
			   
				   #variable_tabla{
					   
					   background-color:darkcyan;
					   color: white;
					   
				   }
			   </style>
			   <a href="situacion_fiscal.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-success btn-block">
				  
				  
				  
			   Subir <i class="glyphicon glyphicon-upload"></i> </a>
		 <?php }  else if( $recent_sale['ganado_perdido']==2){ // si es cliente perdido
			   
			     ?>
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			    <script>
document.getElementById("variable_tabla").innerHTML = "Cliente Perdido  :(";
</script>
			   <style>
			   
				   #variable_tabla{
					   
					   background-color:red;
					   color: white;
					   
				   }
			   </style>
			   
			   <?php }  else if( $recent_sale['ganado_perdido']==3){// documentos subidos
			   
			?>
			<script>
document.getElementById("variable_tabla").innerHTML = "Validando Documentos <img src='libs/images/validacion.gif' height='30px' >";
</script>
			   <style>
			   
				   #ver_archivos{
					   
					   color: red;
					   text-align: right;
					   
				   }
			   </style>
			   
			   
	  </li>
			   
			   <li class="list-group-item" id="ver_archivos"><a href="detalle_documento_vista.php?id=<?php echo $_GET['id'];?>">Ver Archivos Cargados</a></li>
			   <?php
			   if($recent_sale['identificacion']==0){// if falta
						    ?>   
			 <li class="list-group-item">  
				 <a href="id_oficial.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-info">
		   Falta identificacion Oficial <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			   
			   <?php
			   if($recent_sale['identificacion']==3){// if falta
						    ?>   
			    <li class="list-group-item"> Motivo: <?php echo $recent_sale['identificacion_notas']; ?>
					<a href="id_oficial.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-warning" title="Se Rechazo" data-toggle="tooltip">
					Falta identificacion Oficial <i class="glyphicon glyphicon-remove"></i> </a></li>
			      	<?php   } ?>
			   
			   
			   
			   
			   <?php
		  if($recent_sale['sit_fiscar']==0){// if falta
						    ?>   
			
				<li class="list-group-item">
					<a href="situacion_fiscal.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-info">
					Falta Situacion Fiscal <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
		 <?php
		  if($recent_sale['sit_fiscar']==3){// if rechazado
						    ?>   
			<li class="list-group-item">Motivo: <?php echo $recent_sale['sit_fiscal_notas']; ?>
				<a href="situacion_fiscal.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-warning" title="Se Rechazo" data-toggle="tooltip">
					Falta Situacion Fiscal <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			
			   
			     <?php
		  /*if($recent_sale['cumplimiento']==0){// if falta
						    ?>   
			    <li class="list-group-item">
					<a href="op_cumplimiento.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-info">
		   Falta Opinión de Cumplimiento <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			
			 <?php
		  if($recent_sale['cumplimiento']==3){// if rechazado
						    ?>   
			    <li class="list-group-item">Motivo: <?php echo $recent_sale['cumplimiento_notas']; ?>
					<a href="op_cumplimiento.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-warning" title="Se Rechazo" data-toggle="tooltip">
		   Falta Opinión de Cumplimiento <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   }*/ ?>
			
			
			   
			   
			   <?php
		  if($recent_sale['comp_domicilio']==0){// if falta
						    ?>   
			   <li class="list-group-item">
				   <a href="comp_domicilio.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-info">
		   Falta Comprobante de Domicilio <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			   
			
			 <?php
		  if($recent_sale['comp_domicilio']==3){// if rechazado
						    ?>   
			<li class="list-group-item">Motivo :<?php echo $recent_sale['comp_domicilio_notas']; ?>
				<a href="comp_domicilio.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-warning" title="Se Rechazo" data-toggle="tooltip">
		   Falta Comprobante de Domicilio <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			
			
			   
			   
			   <?php
		  if($recent_sale['alta_envi']==0){// if falta pdf
						    ?>   
			    <li class="list-group-item">
					<a href="alta_envipaq.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-info">
		   Falta Alta envipaq PDF <i class="glyphicon glyphicon-upload"></i> </a>
			      	<?php   } ?>
			
			 <?php
		  if($recent_sale['alta_envi']==3){// if falta rechazado pdf
						    ?>   
			   <li class="list-group-item">Motivo: <?php echo $recent_sale['alta_envi_notas']; ?>
				   <a href="alta_envipaq.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-warning" title="Se Rechazo" data-toggle="tooltip">
		   Falta Alta envipaq PDF <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			
			
			   
			   
			   <?php
		  if($recent_sale['alta_envi_excel']==0){// if falta excel
						    ?>   
			  <li class="list-group-item">
				  <a href="alta_envipaq.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-info">
		   Falta Alta envipaq Excel <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			   
			   
			
			<?php
		  if($recent_sale['alta_envi_excel']==3){// if falta excel rechazado
						    ?>   
			  <li class="list-group-item">Motivo: <?php echo $recent_sale['alta_envi_excel_notas']; ?>
				  <a href="alta_envipaq.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-warning" title="Se Rechazo" data-toggle="tooltip">
		   Falta Alta envipaq Excel <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			
			
			   
			   
			    <?php
		 /* if($recent_sale['preanalisis']==0){// pdf
						    ?>   
			   <li class="list-group-item">
				   <a href="pre_analisis.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-info">
		   Falta Pre-Analisis PDF <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			
			
			<?php
		  if($recent_sale['preanalisis']==3){// pdf rechazado
						    ?>   
			   <li class="list-group-item">Motivo: <?php echo $recent_sale['preanalisis_notas']; ?>
				   <a href="pre_analisis.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-warning" title="Se Rechazo" data-toggle="tooltip">
		   Falta Pre-Analisis PDF <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } */?>
			
			
			
			   
			   <?php
		  /*if($recent_sale['preanalisis_excel']==0){//excel
						    ?>   
			 <li class="list-group-item">
				 <a href="pre_analisis.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-info">
		   Falta Pre-Analisis Excel <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			   
			
			<?php
		  if($recent_sale['preanalisis_excel']==3){//excel rechazado
						    ?>   
			   <li class="list-group-item"><?php echo $recent_sale['preanalisis_excel_notas']; ?>
				   <a href="pre_analisis.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-warning" title="Se Rechazo" data-toggle="tooltip">
		   Falta Pre-Analisis Excel <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } */?>
			
			
			   
			   
			    <?php
		  if($recent_sale['presta_serv']==0){//cumplimiento if falta
						    ?>   
			 <li class="list-group-item">
				 <a href="pre_servicios.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-info">
		   Falta Convenio <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			   
			
			 <?php
		  if($recent_sale['presta_serv']==3){//cumplimiento if falta rechazado
						    ?>   
			    <li class="list-group-item"><?php echo $recent_sale['presta_serv_notas']; ?>
					<a href="pre_servicios.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-warning" title="Se Rechazo" data-toggle="tooltip">
		   Falta Convenio <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			
			
			
		
		
		
		
		
		    <?php
		  if($recent_sale['estado_cuenta']==0){// if falta
						    ?>   
			   <li class="list-group-item">
				   <a href="edo_cuenta.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-info">
		   Falta Estado de Cuenta <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			   
			
			
			<?php
		  if($recent_sale['estado_cuenta']==3){// if falta rechazado
						    ?>   
			   <li class="list-group-item">Motivo: <?php echo $recent_sale['propuesta_notas']; ?>
				   <a href="edo_cuenta.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-warning" title="Se Rechazo" data-toggle="tooltip">
		   Falta Estado de Cuenta <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
			   
			   
			   
			    <?php
		  if($recent_sale['propuesta']==0){// if falta
						    ?>   
			   <li class="list-group-item">
				   <a href="propuesta.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-info">
		   Falta Propuesta Comercial <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			   
			
			
			<?php
		  if($recent_sale['propuesta']==3){// if falta rechazado
						    ?>   
			   <li class="list-group-item">Motivo: <?php echo $recent_sale['propuesta_notas']; ?>
				   <a href="propuesta.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-warning" title="Se Rechazo" data-toggle="tooltip">
		   Falta Propuesta Comercial <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			   
			   
			   
			   <?php
		  /*if($recent_sale['tarifario']==0){// if falta
						    ?>   
			   <li class="list-group-item">
				   <a href="tarifario.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-info">
		   Falta Tarifario<sup>PDF</sup> <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			   
			   
			
			  <?php
		  if($recent_sale['tarifario']==3){// if falta rechazado
						    ?>   
			   <li class="list-group-item"><?php echo $recent_sale['tarifario_notas']; ?>
				   <a href="tarifario.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-warning" title="Se Rechazo" data-toggle="tooltip">
		   Falta Tarifario<sup>PDF</sup> <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   }*/ ?>
			
			
	  
	  <?php
		  if($recent_sale['tarifario_excel']==0){// if falta excel
						    ?>   
			   <li class="list-group-item">
				   <a href="tarifario.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-info">
		   Falta Tarifario<sup>Excel</sup> <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			   
			   
			
			  <?php
		  if($recent_sale['tarifario_excel']==3){// if falta rechazado excel
						    ?>   
			   <li class="list-group-item"><?php echo $recent_sale['tarfario_excel_notas']; ?>
				   <a href="tarifario.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-warning" title="Se Rechazo" data-toggle="tooltip">
		   Falta Tarifario<sup>Excel</sup> <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
	  
	  
	  
		
		  <?php
		  if($recent_sale['user_biis']==0){// if falta excel
						    ?>   
			   <li class="list-group-item">
				   <a href="biis.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-info">
		   Falta Solicitud de Usuario Biis<sup>Opcional</sup> <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
			   
			   
			
			  <?php
		  if($recent_sale['user_biis']==3){// if falta rechazado excel
						    ?>   
			   <li class="list-group-item"><?php echo $recent_sale['biis_notas']; ?>
				   <a href="biis.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-warning" title="Se Rechazo" data-toggle="tooltip">
		   Falta Solicitud de Usuario Biis<sup>Opcional</sup>  <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   } ?>
		
		
	  
			
			   
			   
			   
			    <?php
		  if($recent_sale['acta_constitutiva']==0){// if falta
						    ?>   
			   <li class="list-group-item">
				   <a href="acta_const.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-info">
		   Falta Actaconstitutiva <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   }
			   
			   
			   
			   ?>
			
			
			      <?php
		  if($recent_sale['acta_constitutiva']==3){// if falta rechazado
						    ?>   
			  <li class="list-group-item">Motivo: <?php echo $recent_sale['acta_constitutiva_notas']; ?>
				  <a href="acta_const.php?id=<?php echo (int)$recent_sale['id']; ?>" class="btn btn-warning" title="Se Rechazo" data-toggle="tooltip">
					  Falta Actaconstitutiva <i class="glyphicon glyphicon-upload"></i> </a></li>
			      	<?php   }
			   
			    }//fin de ganado perdido ==3
	  
	  else if( $recent_sale['ganado_perdido']==4){// principio de documentacion validad
			   
			?>
		
		
			<script>
				$(document).ready(function() {
        //$("#variable_tabla").fadeOut();
		//$("#contacto_div").toggleClass('col-md-12').fade;//.className='col-md-12';
		//("col-md-12").fadeIn(1500);
	document.getElementById("contacto_div").className="col-md-7";
    
 
});
				
				
document.getElementById("variable_tabla").innerHTML = "Documentacion Completa y Valida ";
</script>
			   <style>
			   
				   #variable_tabla{
					   
					   background-color:green;
					   color: white;
					   
				   }
			   </style>
			   
			 <?php } //fin de documentacion validad
			   
		
		
	  
	  
	  /*if($recent_sale['sit_fiscar']==2 && $recent_sale['identificacion']==2 && $recent_sale['comp_domicilio']==2 && $recent_sale['estado_cuenta']==2 && $recent_sale['tarifario']==2 && $recent_sale['preanalisis']==2 && $recent_sale['preanalisis_excel']==2 && $recent_sale['presta_serv']==2 && $recent_sale['alta_envi']==2 && $recent_sale['alta_envi_excel']==2 && $recent_sale['propuesta']==2 && $recent_sale['tarifario_excel']==2)//;c.sit_fiscar = 2 AND c.cumplimiento = 2 AND c.identificacion = 2 AND c.comp_domicilio = 2 AND c.estado_cuenta = 2 AND c.tarifario = 2 AND c.preanalisis = 2 AND c.preanalisis_excel = 2 AND c.presta_serv = 2 AND c.alta_envi = 2 AND c.alta_envi_excel = 2 AND c.propuesta = 2 AND c.tarifario_excel = 2)
	  {
		  
		    $query   = "UPDATE contacto SET";
       $query  .=" ganado_perdido ='4'";
       $query  .=" WHERE id ='{$_GET['id']}'";
       $result = $db->query($query);
		if($result && $db->affected_rows() === 1){
          //       $session->msg('s',"En Espera de Validacion de los Documentos ");
            echo '<meta http-equiv="Refresh" content="0; url=detalle_contacto.php?id='.(int)$_GET['id'].'">';
	           } 
		  
		  //redirect('detalle_contacto.php?id='.$_GET['id'], false);
          }else{}
		  
		  */
		 ?>
		
		
		   
			   
			   
				</li>
  </ul>
</div>		
			</div>	
				
		  
			
			
			
			
			
			
			
			
			
			
			
		  
		  
		  
		 
		  <div class="col-md-12">
		  <br>
		<header>
    <h2><center>Historial de Acciones en Contacto <?php echo remove_junk(first_character($recent_sale['contacto'])); ?>
	<br><br>
		
		</center></h2>
</header>
	<?php endforeach; ?>				
<?php foreach ($accion as  $acciones):
			
			
			$fechamomento= date("Y-m-d H:i");
			$tiempomomento=$acciones['fecha_hora']." ".$acciones['tiempo'];
			
			//if($tiempomomento<$fechamomento && ($acciones['tipo']==2 OR $acciones['tipo']==3)){
				
			
		?> 

		  
			<ul class="timeline">
  <!-- Item 1 -->
  <li>
    <div class="direction-r">
      <div class="flag-wrapper">
        <span class="hexa"></span>
        <span class="flag"><?php 
			
			
			switch($acciones['tipo']){
					
				
				case 2:
				echo "Llamada";	
					break;
				
					case 3:
				echo "Correo";	
					break;
					case 4:
				echo "Tarea";	
					break;
				default: 
				echo "Ninguna Opción Seleccionada.";	
					break;
				
				
				
			}
			?>
		  </span>
        <span class="time-wrapper"><span class="time">Fecha: <?php echo remove_junk(first_character($acciones['fecha_hora'])); echo "  Hora: ".  remove_junk(first_character($acciones['tiempo'])); ?></span></span>
		 
      </div> 
		
		<div class="desc">
		 <?php echo remove_junk(first_character($acciones['notas'])); ?>
		<?php if($acciones['resumen']==NULL){
	
	
}else{
echo "<br><br> <strong>Resumen de  la Reunión:</strong> ".remove_junk(first_character($acciones['resumen'])); 	
	
} ?>
			
		
		</div>
    </div>
  </li>

  
</ul>
		
		
      		
			 
			<?php  endforeach; ?>
			
			<ul class="timeline">
  <!-- Item 1 -->
  <li>
    <div class="direction-r">
      <div class="flag-wrapper">
        <span class="hexa"></span>
        <span class="flag">Alta
		  </span>
        <span class="time-wrapper"><span class="time">Fecha: <?php echo $acciones['fecha']; ?></span></span>
      </div>
      <div class="desc">
		  Alta de Contacto
		
		</div>
    </div>
  </li>

  
</ul>
			  </div>
		  </div>
   </div>
  </div><!--fin de contactos-->
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		
<?php include_once('layouts/footer.php'); ?>
