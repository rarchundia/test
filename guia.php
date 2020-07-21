<?php
  $page_title = 'Guia Envipaq';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
$catalogo = catalogo();
$operador = operador_catalogo();
?>
<?php

/*if(!$recent_sales){
  $session->msg("d","Id de Contacto Desconocido.");
  redirect('pipedrive.php');
}*/
if(isset($_POST['entregado'])){
 

 $p_id_entrega= $_POST['id_delaguia'];
  $p_id_operador= $_POST['id_operador'];
 $p_quien_recibe = $_POST['quien_recibe'];
	$p_fecha_documentacion = $_POST['fecha_documentacion'];
	 $p_compara = $_POST['estatus'];
	if($p_compara==55){
		$p_estatus=55;
		}else{
		
		$p_estatus=1;
	}
		
	$date    = make_date();
	$sql="UPDATE entrega SET id_operador='{$p_id_operador}', estatus='{$p_estatus}', fecha_entrega='{$p_fecha_documentacion}', recibido='{$p_quien_recibe}', asignado='1' WHERE id='{$p_id_entrega}'";
    
	
	if($db->query($sql)){
	  //$session->msg('s',"Recolección Agregada Exitosamente  . ");
		
      // redirect('recoleccion.php', false);
   }
	    else {
       //$session->msg('d',' Lo siento, Falló al Agregar el Equipo Intenta Otra Vez.');
       //redirect('recoleccion.php', false);
	   }

  

 }





if(isset($_POST['estatus_cancela'])){

if(empty($errors)){
    
	 $p_id_nota = remove_junk($db->escape($_POST['id_nota']));
	
	
	$date    = make_date();
	
	
	$query  = " UPDATE entrega SET estatus ='99', fecha_cancelacion ='{$date}' WHERE id='{$p_id_nota}'";
	
	 $result = $db->query($query);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Cancelado Correctamente ");
            echo '<meta http-equiv="Refresh" content="0; url=guia.php">';
			  //redirect('incidencias.php', false);
          } else {
            $session->msg('d',' Lo Siento Fallo Al Cancelar  Intenta Nuevamente.');
            echo '<meta http-equiv="Refresh" content="0; url=guia.php">';
			  //redirect('incidencias.php', false);
          }
}
	else{
     $session->msg("d", $errors);
    // redirect('aclaraciones.php',false);
		echo '<meta http-equiv="Refresh" content="0; url=guia.php">';
   }
	
	
	
}



if(isset($_POST['agregar_operador'])){
    $req_fields = array('asiga_operador');
   validate_fields($req_fields);
 $id = $_POST['id'];
  $asigna=$_POST['asigna'];
	$operador = remove_junk($db->escape($_POST['asiga_operador']));
   if(empty($errors)){

     
	   $query   = "UPDATE entrega SET id_operador='{$operador}', estatus=2, asignado='{$asigna}' WHERE id ='{$id}'";
	   $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Asignado Correctamente. ");
                 redirect('guia.php', false);
               } else {
                 $session->msg('d',' Lo Siento, la Asignación Falló ya se Encuentra Asignada a Este Usuario.');
                 redirect('guia.php', false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('guia.php', false);
   }

 }//fin asigna

if(isset($_POST['programa'])){
 


  //$razonsocial_des = remove_junk($db->escape($_POST['razonsocial_des']));
 
   if(empty($errors)){
     //$p_guia = remove_junk($db->escape($_POST['guia']));
	 $p_razon_social  = remove_junk($db->escape($_POST['razon_social']));
	 $p_remitente  = remove_junk($db->escape($_POST['remitente']));
	 $p_direccion  = remove_junk($db->escape($_POST['direccion']));
	 $p_colonia= remove_junk($db->escape($_POST['colonia']));
	 $p_cp  = remove_junk($db->escape($_POST['cp']));
	 $p_telefono  = remove_junk($db->escape($_POST['telefono']));
	   
	   
	   
	 $p_nombre_destinatario  = remove_junk($db->escape($_POST['nombre_destinatario']));
	 $p_direccion_des  = remove_junk($db->escape($_POST['direccion_des']));
	 $p_colonia_des  = remove_junk($db->escape($_POST['colonia_des']));
	 $p_cp_des  = remove_junk($db->escape($_POST['cp_des']));
	 $p_telefono_des = remove_junk($db->escape($_POST['telefono_des']));
	 
	 $p_carga  = remove_junk($db->escape($_POST['carga']));
	 $p_quien_genera= remove_junk($db->escape($_POST['quien_genera']));  
     $p_notas = remove_junk($db->escape($_POST['notas']));
 	 
	   
	 //  $detalles=$p_quien_genera+$p_notas;
	   
     $date    = make_date();
     $query  = "INSERT INTO entrega (";
     $query .="  `razon_social`, `remitente`, `direccion`, `colonia`, `cp`, `telefono`,  `nombre_destinatario`, `direccion_des`, `colonia_des`, `cp_des`, `telefono_des`, `fecha`,  `carga`, `quien_genera`,`detalles`";
     $query .=") VALUES (";
     $query .="'{$p_razon_social}','{$p_remitente}','{$p_direccion}','{$p_colonia}','{$p_cp}','{$p_telefono}','{$p_nombre_destinatario}','{$p_direccion_des}','{$p_colonia_des}','{$p_cp_des}','{$p_telefono_des}','{$date}','{$p_carga}','{$p_quien_genera}','{$p_notas}' ";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
       
	  $session->msg('s',"Guia Envipaq Generada Correctamente ");
      echo '<meta http-equiv="Refresh" content="0; url=guia.php">';
		 // redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Generar la Guia Intenta Nuevamente.');
      echo '<meta http-equiv="Refresh" content="0; url=guia.php">';
			//redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
    echo '<meta http-equiv="Refresh" content="0; url=guia.php">';
	   //redirect('entrega.php',false);
   }

 }


?>
<style>
	
	.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color:skyblue;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
	
	
	
	

</style>
<?php include_once('layouts/header.php');
$usuario=$user['name'];

$medida= find_all('medida');


$products =reporte_pdf_historico($usuario);
	

?>
<link href="css/tableexport.min.css" rel="stylesheet">

<div class="row">
 <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
			
			
			
							<div class="col-md-12"><!--principio de contactos-->
      <div class="panel panel-default">
        <div class="panel-heading">
     
			 <strong>
            <span class="glyphicon glyphicon-qrcode"></span>
            <span>Guia Envipaq </span>
          </strong>
		
			
        </div>
        <div class="panel-body">
			
		
			<div class="tab">
					<button class="tablinks active" id="historico_btn" onclick="openCity(event, 'historico')">Mi Historico</button>
   <button class="tablinks" onclick="openCity(event, 'guia')">Guia Envipaq</button>
			
				<div class="pull-right col-md-4">
			<input class="form-control" id="myInput" type="text" placeholder="Buscar ...">
			</div>
				
	</div>
<div id="historico" class="tabcontent" style="display: block;">
	
			
			
			
			<div class="table-responsive">
			
          <table class="table table-striped table-hover table-responsive table-fixed "> <!--table-bordered-->
            <thead>
              <tr>
                <th class="text-center">FOLIO GUIA</th>
			    <th class="text-center">RAZÓN SOCIAL</th>
                <th class="text-center">ORIGEN</th>
                <th class="text-center">DESTINO</th>
				  <th class="text-center">CARGA / REFERENCIA</th>
                <!--<th class="text-center">RUTA</th>-->
                <th class="text-center">GENERA PDF</th>
                <?php 
				
				if($user['user_level'] === '1' OR $user['user_level'] === '2' ){
				?> <th class="text-center">CERRAR</th>
				
				<?php }//fin if?>
				  <th class="text-center">CANCELAR</th>
				 
              </tr>
            </thead>
            <tbody id="myTable">
				
				
              <?php foreach ($products as $product):?>
              <tr>
				  <td class="text-center"><strong><br><br><a   onclick="window.open('estatus_guia.php?id=<?php echo remove_junk($product['id']);?>', 'Guia Envipaq', 'width=700, height=600'); return false" title="Ver Rastreo" data-toggle="tooltip"><?php echo remove_junk($product['id']);?></a> </strong></td>
				
				<td class="text-center"><strong><br><br><strong><?php echo remove_junk($product['nombre']);?> </strong></td><!--RAZON SOCIAL-->
				  <!-- <td class="text-center"><strong><br><br> <?php
              
											
						 switch ($product['producto']) 
    {
								 case 1:
        echo "Dia Siguiente ";
        break;
								 case 2:
        echo " 2 Dias ";
        break;
								 case 3:
        echo " Terrestre ";
        break;
								 
    case 4:
        echo " Internacional ";
        break;
    case 5:
        echo "Nacional ";
        break;
    case 6:
        echo " LTL ";
        break;
    case 7:
        echo " Aereo ";
        break;
    case 8:
        echo " Maritimo ";
        break;
	 case 9:
        echo " Aduana ";
	    break;
     case 10:
        echo " Otro ";
	    break;

							case 11:
        echo " Almacén ";
	    break;
    case 21:
        echo " Cotización Día Siguiente ";
	    break;
case 22:
        echo " Cotización 2 Dias ";
	    break;
								 case 23:
        echo " Cotización Terrestre ";
	    break;
case 24:
        echo " Cotización Internacional";
	    break;
case 25:
        echo " Cotización Nacional ";
	    break;
case 26:
        echo " Cotización LTL ";
	    break;
case 27:
        echo " Cotización Aereo ";
	    break;
case 28:
        echo " Cotización Maritimo ";
	    break;
case 29:
        echo " Cotización Aduana ";
	    break;

	case 30:
        echo " Cotización Otro";
	    break;
							 case 31:
        echo " Cotización Almacén ";
	    break;

								 
								 
								 
    default:
        echo " No Tiene Cargado  Ningún Servicio ";
    }
						
					
					
					
					?>
					  
					  
					  </strong></td> fin de tipode  servicios-->
				  
                <td class="text-center">
					
					<?php if($product['producto']==9  or $product['producto']==29){?>
					Razón Social: <strong><?php echo remove_junk($product['razon_social']);?> </strong><br>
                Origen <strong><?php echo remove_junk($product['direccion']);?> </strong><br>
					Carga: <strong><?php echo remove_junk($product['carga']);?> </strong><br><br>
					
					<?php if($product['producto']==29){
	
					?>
					
					
					
					
				  <?php 
}else{
	?>
	Puerto: <strong><?php echo remove_junk($product['puerto']);?> </strong>
			Despacho: <strong><?php echo remove_junk($product['despacho']);?> </strong><br>
	<?php	 } 
												  }
					else if( $product['producto']==11){
						?>
					Remitente <strong><?php echo remove_junk($product['remitente']);?> </strong><br>
				    Telefóno <strong><?php echo remove_junk($product['telefono']);?> </strong><br>
					Razón Social <strong><?php echo remove_junk($product['razon_social']);?> </strong><br><br>
					# de Palet's <strong><?php echo remove_junk($product['palet']);?> </strong><br>	
					Carga: <strong><?php echo remove_junk($product['carga']);?> </strong><br>
					Almacen:<strong><?php if($product['almacen']==1){
							
						echo "Servicargo";	
						}else {
					echo "Envipaq";	}?> </strong><br>
					
					Tipo de Servicio requerido <strong><?php 
						/*1 etiquetado
	   2 embalado
	   3 etiquetado + embalado
	   7 uva
	   8 etiquetado + uva
	   9 embalado + uva
	   10 etiquetado + embalado + uva  */
	   
						
						
							
							switch ($product['servicios']) 
        {
								 case 1:
        echo "Etiquetado Precio de Venta: $".$product['comer_venta'];									
        break;
									case 2:
        echo "Embalado Precio de Venta: $".$product['arance_venta'];									
        break;
									case 3:
									$resul_servicios=$product['comer_venta']+$product['arance_venta'];
        echo "Etiquetado + Embalado Precio de Venta: $".$resul_servicios;									
        break;
									
									
									
									
									case 7:
        echo "Uva Precio de Venta: $".$product['uva_venta'];									
        break;
									
									case 8:
									$resul_servicios=$product['comer_venta']+$product['uva_venta'];
        echo "Etiquetado + Uva Precio de Venta: $".$resul_servicios;									
        break;
									case 9:
									$resul_servicios=$product['arance_venta']+$product['uva_venta'];
        echo "Embalado + Uva Precio de Venta: $".$resul_servicios;										
        break;
								case 10:
									$resul_servicios=$product['arance_venta']+$product['uva_venta']+$product['comer_venta'];
        echo "Etiquetado + Emabalado + Uva Precio de Venta: $".$resul_servicios;									
        break;
						default:
        echo " No Requiere Servicios Adicionales. :( ";	
									
						}?>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
				 </strong><br>
						
					<?php 
					
					}else {?>
					Remitente <strong><?php echo remove_junk($product['remitente']);?> </strong><br>
					
					Direccion <strong><?php echo remove_junk($product['direccion']);?> </strong>
					Colonia <strong><?php echo remove_junk($product['colonia']);?> </strong>
					CP <strong><?php echo remove_junk($product['cp']);?> </strong>
					Telefóno <strong><?php echo remove_junk($product['telefono']);?> </strong>
					</td>
				  <?php }?>
				  
				  <td class="text-center">
					  <?php if($product['producto']==9 or $product['producto']==29){?>
					  
					  
					Destino: <strong><?php echo remove_junk($product['direccion_des']);?> </strong><br>
					Contacto: <strong><?php echo remove_junk($product['remitente']);?> </strong><br>
					Telefono: <strong><?php echo remove_junk($product['telefono']);?> </strong><br>
					  
					  
					  
					<?php    }
					  
					  
					  else if( $product['producto']==11){
					  
					  }	  else {?>
					Destinatario <strong><?php echo remove_junk($product['nombre_destinatario']);?> </strong><br>
					Direccion <strong><?php echo remove_junk($product['direccion_des']);?> </strong>
					Colonia <strong><?php echo remove_junk($product['colonia_des']);?> </strong>
					CP <strong><?php echo remove_junk($product['cp_des']);?> </strong>
					Telefóno <strong><?php echo remove_junk($product['telefono_des']);?> </strong>
					
					  <?php    }?>
					</td>
              
                <!--<td class="text-center">
              
          
              </td>-->
				  
				<!--  <td>  <div class="modal fade" id="<?php echo remove_junk($product['id']);?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Guia: <strong> <?php echo remove_junk($product['id']);?> </strong>
			 
		  
			<br>Tipo de Servicio: <strong><?php switch ($product['producto']) 
        {
								 case 1:
        echo "Dia Siguiente ";
        break;
								 case 2:
        echo " 2 Dias ";
        break;
								 case 3:
        echo " Terrestre ";
        break;
								 
    case 4:
        echo " Internacional ";
        break;
    case 5:
        echo "Nacional ";
        break;
    case 6:
        echo " LTL ";
        break;
    case 7:
        echo " Aereo ";
        break;
    case 8:
        echo " Maritimo ";
        break;
	 case 9:
        echo " Aduana ";
	    break;
     case 10:
        echo " Otro ";
	    break;

							case 11:
        echo " Almacén ";
	    break;
    case 21:
        echo " Cotización Día Siguiente ";
	    break;
case 22:
        echo " Cotización 2 Dias ";
	    break;
								 case 23:
        echo " Cotización Terrestre ";
	    break;
case 24:
        echo " Cotización Internacional";
	    break;
case 25:
        echo " Cotización Nacional ";
	    break;
case 26:
        echo " Cotización LTL ";
	    break;
case 27:
        echo " Cotización Aereo ";
	    break;
case 28:
        echo " Cotización Maritimo ";
	    break;
case 29:
        echo " Cotización Aduana ";
	    break;

	case 30:
        echo " Cotización Otro";
	    break;
							 case 31:
        echo " Cotización Almacén ";
	    break;

								 
								 
								 
    default:
        echo " No Tiene Cargado  Ningún Servicio ";
    }
			?></strong></h4>
		  <?php //if($product['producto']==9){
		  
		  if($product['compra']!=0){?>
					
		  Valor Compra $<strong><?php echo remove_junk($product['compra']);?><sup>.00</sup> </strong><?php //if($product['producto']==9){
		  
								  }?>
					Valor Venta $<strong><?php echo remove_junk($product['venta']);
					$ganancia=$product['venta']-$product['compra'];
					
					?><sup>.00</sup> </strong>
					Ganacia $<strong><?php echo $ganancia;?><sup>.00</sup> </strong>
		  
		   <?php //}?>
		  
		  
      </div><div class="modal-body">
		<h3><?php echo remove_junk($product['fecha']); ?>
 <?php echo remove_junk($product['detalles']); ?></h3></div>
      
		<hr><br>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		<div class="modal-footer">
	
		<form method="post" action="entrega.php" class="clearfix">
					
					<input type="hidden" id="id_nota" name="id_nota" value="<?php echo remove_junk($product['id']);?>">
					<input  type="hidden" id="nota_server" name="nota_server" value=" <?php echo remove_junk($product['detalles']);?> ">	
					<input type="hidden" id="user_name" name="user_name" value="<?php echo remove_junk(ucfirst($user['name'])); ?>">
					
 
  <textarea id="adicional_nota" name="adicional_nota" class="md-textarea form-control" rows="3"  style="background-color:aliceblue; " placeholder="Aqui Puedes Agregar Una Nota Adicional"></textarea>

					<CENTER> <button type="submit" name="nota_adicional" class="btn btn-default" style="background-color:aliceblue; ">Agrega Una Nota</button>
    </CENTER>
     </form>
			
			<button type="button" class="btn btn btn-danger" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div></div>

                           <br>
       
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?php echo remove_junk($product['id']);?>"><i class='glyphicon glyphicon-plus' style="font-size:20px;color:red;" title="Click Para Ver Los Detalles" data-toggle="tooltip"></i> Expandir</button>
								 </td>-->
					  
					 <td>
				  
				<strong> Carga:</strong> <?php echo remove_junk($product['carga']); ?> / <br>
						 <strong>Referencias: </strong><?php echo remove_junk($product['detalles']); ?>
						 
				  </td>
				  
				  <td align="center"><!--   principio de pdf-->
					  
					<!--<div class="form-group">
   <input type="checkbox" value="" class="multiguia" >
						<label for="direccion_des">Multiguia?</label>
           
  </div>
					<div class="idmultiguia" style="display: none;">	
						<form method="get" action="pdf_entrega.php">
	<div class="col-md-1">
		<div class="form-group">
    <input type="number" placeholder=" # Guias" style="width : 80px;" name="guias"  >
						
       <input type="text" name="id" value="<?php echo remove_junk($product['id']);?>"  >    
    
  </div>
  </div>	
				<br><br>
						<button type="submit"><img src="libs/images/pdf.png" width="55" height="55" ></button>
			
						</form>
					  </div>	 --> 
					
			
					  <div class="nomultiguia">
						<form method="post" action="pdf_guia.php">
							<input type="hidden" name="guias" value="4">
						  <!--<input type="hidden" name="id" value="<?php echo remove_junk($product['id']);?>"  >    -->
										  <br>
			  		
							<button type="button" onclick="window.open('pdf_guia.php?id=<?php echo remove_junk($product['id']);?>', 'Guia Envipaq PDF ', 'width=800, height=600'); return false"><img src="libs/images/pdf.png" width="43"  ></button>
							
							<!--<button type="button" onclick="window.open('pdf_guia.php?id=<?php echo remove_junk($product['id']);?>&guias=3', 'Guia Envipaq PDF ', 'width=800, height=600'); return false"><img src="libs/images/pdf.png" width="43"  ></button>-->
							
						  </form>
			  </div>
					  
					  
				  </td><!-- fin de pdf-->
               
				   <td class="text-center">
					  
					<?php if($product['estatus']==1 OR $product['estatus']==99 OR $product['estatus']==50 OR $product['estatus']==55){
					  
					  echo "<br><i class='glyphicon glyphicon-remove-circle' style='color: red;' title='No se Puede Cerrar' data-toggle='tooltip'></i> ";}else{
					  ?>
					  
					  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#<?php echo $product['id']?>">Cerrar</button>

<!-- Modal -->
<div id="<?php echo $product['id']?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cerrar Guia <?php echo $product['id']?></h4>
      </div>
      <div class="modal-body">
		  
		  
       <form action="guia.php" method="post">
			  <div class="form-group ">
      <label for="inputState">Operador</label>
      <select id="id_operador" name="id_operador" class="form-control">
        <option selected>Selecciona...</option>
        <?php foreach($operador as $opera): ?>
			 <option value="<?php echo remove_junk(ucwords($opera['id']))?>"><?php echo remove_junk(ucwords($opera['name']))?></option>
                      <?php endforeach;?>
                   
      </select>
    </div>
			  
  <div class="form-group">
    <label for="quien_recibe">Nombre <sub>de quien se le entrega el Paquete</sub></label>
   <input  class="form-control" name="quien_recibe" type="text" placeholder="Quien Recibe el Paquete " onkeyup="mayus(this);" required>
		   
		   </div>
  
			  
			 <div class="form-group ">
  <label for="fecha_documentacion">Fecha de Entrega</sub></label>
  <input type="text" class="form-control" id="fecha_documentacion" name="fecha_documentacion" placeholder="Fecha que se Dcumento el Paquete" autocomplete="off">
	
			  </div>
		  
		  <div class="form-group ">
      <label for="inputState">Recoleccion en Falso</label>
      <select id="estatus" name="estatus" class="form-control">
        <option selected>Selecciona...</option>
        
			 <option>Sin Cobro</option>
             <option value="55">Con Cobro</option>
                      
      </select>
    </div>
		  
		  
		  
			  <input type="hidden" name="id_delaguia" value="<?php echo $product['id']?>">
			  
			  
			  <div class="form-group">
  <center><button type="submit" class="btn btn-success " name="entregado">Marcar como Entregado <i class="glyphicon glyphicon-ok"></i></button></center>
				  </form>	  
				  
				  
				  
				  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
					  
				 <?php 
				}
				?>	  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
			<!--	   <?php 
				
				if($user['user_level'] === '1' OR $user['user_level'] === '2' ){
					if($product['estatus'] === '0' OR $product['estatus'] === '2'){
				?> 
					 
					  <form method="post" action="guia.php">
            <select class="form-control"  name="asiga_operador" required >
                      <option value="">Asignar a:</option>
                    <?php foreach($operador as $opera): ?>
			 <option value="<?php echo remove_junk(ucwords($opera['id']))?>"><?php echo remove_junk(ucwords($opera['name']))?></option>
                      <?php endforeach;?>
                    </select>
						  
						  
			
                    
                    <input type="hidden" name="id" value="<?php echo remove_junk($product['id']);?>">
                    <input type="hidden" name="asigna" value="1"></div></div>
				<?php 
				
				if($product['asignado']==0){
				?>
				 	 
				<button type="submit" name="agregar_operador" class="btn btn-success" > Asigna a Operador</button>
				 <?php 
				}else{
				?>
				<button type="submit" name="agregar_operador" class="btn btn-success" >	Re-asignar a:</button>
				 <?php 
				}
				?>
        </form>
				
				
				
					  
					 
				<?php }else{
						echo '<center><br><span class="glyphicon glyphicon-remove" title="No es Posible Modificar las Acciones" data-toggle="tooltip"></span><center>';
					}}//fin if?>-->
				  
				  </td><!--/*fin asigna*/-->
                   <td class="text-center">
					 
				<?php 
					 if($product['estatus']==1){
						  
						 echo "<br><i class='glyphicon glyphicon-ok' style='color: green;' title='Entregada' data-toggle='tooltip'></i>";
					  }
					 
					 if($product['estatus']==50){
						  
						  echo "<br><i class='glyphicon glyphicon-ok-circle' style='color: green;' title='Entregada y Facturada' data-toggle='tooltip'></i>";
					  }
					if($product['estatus']==55){
						  
						  echo "<br><i class='glyphicon glyphicon-ban-circle' style='color: purple;' title='Recoleccion en Falso con Cobro' data-toggle='tooltip'></i>";
					  }
					
					 if($product['estatus']==2){
						  
						  echo "<br>Asignada a Reparto";
					  }
					 if($product['estatus']==99){
						  
						  echo "<br><i class='glyphicon glyphicon-remove-circle' style='color: red;' title='Guia Cancelada' data-toggle='tooltip'></i>";
					  }
					 if($product['estatus']==0){
					 
					 ?>
					 	<form method="post" action="guia.php" class="clearfix">
					
					<input type="hidden" id="id_nota" name="id_nota" value="<?php echo remove_junk($product['id']);?>">
					
					<CENTER> <button type="submit" name="estatus_cancela" class="btn btn-default" style="background-color:aliceblue; " title="Cancelar" data-toggle="tooltip"><i  class="glyphicon glyphicon-trash" style="font-size:18px; "></i></button>
    </CENTER>
     </form>
					 <?php }?>
                </td>
              </tr> 
             <?php endforeach; ?>
            </tbody>
          </table>
			
			
			
			
			
			
			
			</div>	</div>
			
<div id="guia" class="tabcontent">
		<br>
		<form class="was-validated" action="guia.php" method="post">
			
			
			
			<div class="col-md-6"><!--principio de origen--> 
		<label class="pull-right">Origen </label><br>
	<div class="form-group">
		
    <label for="razon_social">Razón Social</label>
		
         <select class="form-control" id="razon_social"  name="razon_social" onchange="ShowSelected();" required>
                      <option value="">Selecciona</option>
                    <?php foreach($catalogo as $cata): ?>
			 <option value="<?php echo remove_junk(ucwords($cata['id']))?>"><?php echo remove_junk(ucwords($cata['nombre']))?></option>
                      <?php endforeach;?>
                    </select>
		
  </div>
				
  <div class="form-group">
    <label for="remitente">Remitente</label>
    <input type="text" class="form-control" name="remitente" placeholder="Remitente"  onkeyup="mayus(this);">
  </div>
  
				
				<div class="form-group">
    <label for="direccion">Dirección</label>
   <input type="text" class="form-control" name="direccion" required placeholder="Dirección" onkeyup="mayus(this);">
  </div>
				
  		<div class="form-group">
    <label for="colonia">Colonia</label>
   <input type="text" class="form-control" name="colonia" placeholder=" Colonia " onkeyup="mayus(this);">
  </div>
				<div class="col-md-6">
				<div class="form-group">
    <label for="cp">Codigo Postal</label>
   <input type="number" class="form-control" name="cp" placeholder="Código Postal" maxlength="5" required >
  </div> </div>
				
				<div class="col-md-6">
				<div class="form-group">
    <label for="telefono">Teléfono</label>
   <input type="tel" class="form-control" name="telefono"  placeholder="Telefono" required>
  </div> </div>
  
				
				
				
			</div> <!--fin de origen -->
			
			
			
			<div class="col-md-6"><!--principio destino-->
			
			<label class="pull-right">Destino</label><br>
  <div class="form-group">
    <label for="nombre_destinatario">Destinatario</label>
   <input type="text" class="form-control" name="nombre_destinatario" placeholder=" Destinatario "  required  onkeyup="mayus(this);">
  </div>
  
				
				<div class="form-group">
    <label for="direccion_des">Dirección Destino</label>
    <input type="text" class="form-control" name="direccion_des" placeholder="Dirección Destino " required onkeyup="mayus(this);">
  </div>
				
  		<div class="form-group">
    <label for="colonia_des">Colonia Destino</label>
   <input type="text" class="form-control" name="colonia_des" placeholder=" Colonia Destino " onkeyup="mayus(this);" >
  </div>
				<div class="col-md-6">
				<div class="form-group">
    <label for="cp_des">Codigo Postal Destino</label>
   <input type="number" class="form-control" name="cp_des" placeholder="Codigo Postal Destino " maxlength="5" required>
  </div> </div>
				
				<div class="col-md-6">
				<div class="form-group">
    <label for="telefono_des">Teléfono Destino</label>
   <input type="tel" class="form-control" name="telefono_des"  placeholder="Teléfono Destino "  >
  </div> </div>
			
			</div><!--fin destino-->
			
			<div class="col-md-6">
				<div class="form-group">
    <label for="carga">Que Contiene</label>
					
   <textarea  class="form-control" name="carga"  placeholder=" Carga que Contiene " onkeyup="mayus(this);" rows="3"></textarea>
  </div> </div>
			
			<div class="col-md-12">
				<div class="form-group">
    <label for="notas">Detalles</label>
					
   <textarea  class="form-control" name="notas"  placeholder=" Puedes Escribir más Detalles Opcionales " onkeyup="mayus(this);" rows="3"></textarea>
  </div> </div>
			
			
	<input type="hidden" value="<?php echo $user['name']?>" name="quien_genera">		
			
			
			
		<center>	<button type="reset" class="btn btn-warning">Limpiar</button> <button type="submit" name="programa" class="btn btn-info">Generar Guia</button>
			</center>
			
			
			
			</form>	
			
			
			
		
			
			
			
			
			
			
			 </div> <!--fin guia-->
			
			
			
			
			
		  </div>
   </div>
  </div> 
	<script src="js/FileSaver.min.js"></script>
<script src="js/Blob.min.js"></script>
<script src="js/xls.core.min.js"></script>
<script src="js/dist/js/tableexport.js"></script>	
	 <script>
		  
	$('#fecha_documentacion').datepicker({
    format: "yyyy-mm-dd",
    clearBtn: true,
    language: "es",
   // daysOfWeekDisabled: "0,6",
    //daysOfWeekHighlighted: "0,6",
    autoclose: true,
    todayHighlight: true,
   // datesDisabled: ['2019-09-21'],
    toggleActive: true
  
	
});
		 
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
		document.write 
		
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});		 
		 
	 $("table").tableExport({
	formats: ["xlsx", "csv"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
	position: 'top',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: true,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "Guias_Envipaq",    //Nombre del archivo 
		 ignoreCSS: ".tableexport-ignore",
});
		 
		 
		  
		 
		 
		
</script>



<?php include_once('layouts/footer.php'); ?>

