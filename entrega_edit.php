
<?php
  $page_title = 'Pedimentos ';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
 page_require_level(7);
  

  ?>
<?php 

if(isset($_POST['estatus_cancela'])){

if(empty($errors)){
     $p_estatus = remove_junk($db->escape($_POST['estatus']));
	
	 $p_id_nota = remove_junk($db->escape($_POST['id_nota']));
	$p_user_name=remove_junk($db->escape($_POST['user_name']));
	 $p_nota_server = remove_junk($db->escape($_POST['nota_server']));
	
	$date    = make_date();
	$nota_concatenada=$p_nota_server." <p> (".$date."  ".$p_user_name.") Agrego Estatus Cancelada</p>";
	
	$query  = " UPDATE entrega SET estatus ='{$p_estatus}', detalles ='{$nota_concatenada}' WHERE id='{$p_id_nota}'";
	
	 $result = $db->query($query);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Cancelado Correctamente ");
            echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
			  //redirect('incidencias.php', false);
          } else {
            $session->msg('d',' Lo Siento Fallo Al Cancelar  Intenta Nuevamente.');
            echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
			  //redirect('incidencias.php', false);
          }
}
	else{
     $session->msg("d", $errors);
    // redirect('aclaraciones.php',false);
		echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
   }
	
	
	
}



if(isset($_POST['facturado'])){

if(empty($errors)){
     $p_estatus = remove_junk($db->escape($_POST['estatus']));
	
	 $p_id_nota = remove_junk($db->escape($_POST['id_nota']));
	$p_user_name=remove_junk($db->escape($_POST['user_name']));
	 $p_nota_server = remove_junk($db->escape($_POST['nota_server']));
	
	$date    = make_date();
	$nota_concatenada=$p_nota_server." <p> (".$date."  ".$p_user_name.") Agrego Estatus Facturado</p>";
	
	$query  = " UPDATE entrega SET estatus ='{$p_estatus}', detalles ='{$nota_concatenada}' WHERE id='{$p_id_nota}'";
	
	 $result = $db->query($query);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Se Cambio El Estatus Correctamente");
            echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
			  //redirect('incidencias.php', false);
          } else {
            $session->msg('d',' Lo Siento Fallo Al Cambiar El Estatus.');
            echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
			  //redirect('incidencias.php', false);
          }
}
	else{
     $session->msg("d", $errors);
    // redirect('aclaraciones.php',false);
		echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
   }
	
	
	
}


if(isset($_POST['nota_adicional'])){

if(empty($errors)){
     $p_adicional_nota = remove_junk($db->escape($_POST['adicional_nota']));
	
	 $p_id_nota = remove_junk($db->escape($_POST['id_nota']));
	$p_user_name=remove_junk($db->escape($_POST['user_name']));
	 $p_nota_server = remove_junk($db->escape($_POST['nota_server']));
	
	$date    = make_date();
	$nota_concatenada=$p_nota_server." <p> (".$date."  ".$p_user_name.") ". $p_adicional_nota."</p>";
	
	$query  = " UPDATE entrega SET detalles ='{$nota_concatenada}' WHERE id='{$p_id_nota}'";
	
	 $result = $db->query($query);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Nota Agregada ");
            echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
			  //redirect('incidencias.php', false);
          } else {
            $session->msg('d',' Lo Siento No Se Pudo Agregar la Nota.');
            echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
			  //redirect('incidencias.php', false);
          }
}
	else{
     $session->msg("d", $errors);
    // redirect('aclaraciones.php',false);
		echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
   }
	
	
	
}







if(isset($_POST['programa'])){
 

 $p_colonia= remove_junk($db->escape($_POST['colonia']));
  $razonsocial_des = remove_junk($db->escape($_POST['razonsocial_des']));
 $p_notas = remove_junk($db->escape($_POST['notas']));
 
   $req_fields = array( 'razon_social', 'remitente', 'direccion','cp','telefono','nombre_destinatario','direccion_des','colonia_des','cp_des','telefono_des');
   validate_fields($req_fields);
   if(empty($errors)){
     //$p_guia = remove_junk($db->escape($_POST['guia']));
	 $p_razon_social  = remove_junk($db->escape($_POST['razon_social']));
	 $p_remitente  = remove_junk($db->escape($_POST['remitente']));
	 $p_direccion  = remove_junk($db->escape($_POST['direccion']));
	 $p_cp  = remove_junk($db->escape($_POST['cp']));
	 $p_telefono  = remove_junk($db->escape($_POST['telefono']));
	   
	   $p_compra_flete  = remove_junk($db->escape($_POST['compra_flete']));
	   $p_venta_flete  = remove_junk($db->escape($_POST['venta_flete']));
	   $p_proveedor  = remove_junk($db->escape($_POST['proveedor']));
	   
	   
	 $p_nombre_destinatario  = remove_junk($db->escape($_POST['nombre_destinatario']));
	 $p_direccion_des  = remove_junk($db->escape($_POST['direccion_des']));
	 $p_colonia_des  = remove_junk($db->escape($_POST['colonia_des']));
	 $p_cp_des  = remove_junk($db->escape($_POST['cp_des']));
	 $p_telefono_des = remove_junk($db->escape($_POST['telefono_des']));
	 $p_correo  = remove_junk($db->escape($_POST['correo']));
	// $p_seguro  = remove_junk($db->escape($_POST['seguro']));
	 $p_producto  = remove_junk($db->escape($_POST['producto']));
	 $p_quien_genera= remove_junk($db->escape($_POST['quien_genera']));  
	 
	   
	 //  $detalles=$p_quien_genera+$p_notas;
	   
     $date    = make_date();
     $query  = "INSERT INTO entrega (";
     $query .="  `razon_social`, `remitente`, `direccion`, `colonia`, `cp`, `telefono`, `razonsocial_des`, `nombre_destinatario`, `direccion_des`, `colonia_des`, `cp_des`, `telefono_des`, `fecha`, `correo`, `producto`, `compra`, `venta`, `quien_genera`,`detalles`, `proveedor`";
     $query .=") VALUES (";
     $query .="'{$p_razon_social}','{$p_remitente}','{$p_direccion}','{$p_colonia}','{$p_cp}','{$p_telefono}','{$razonsocial_des}','{$p_nombre_destinatario}','{$p_direccion_des}','{$p_colonia_des}','{$p_cp_des}','{$p_telefono_des}','{$date}','{$p_correo}','{$p_producto}','{$p_compra_flete}','{$p_venta_flete}','{$p_quien_genera}','Generada por: {$p_quien_genera} Detalles: {$p_notas}', '{$p_proveedor}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
       
	  $session->msg('s',"Guia Envipaq Generada Correctamente ");
      echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
		 // redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Generar la Guia Intenta Nuevamente.');
      echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
			//redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
    echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
	   //redirect('entrega.php',false);
   }

 }
 
 



if(isset($_POST['aduana'])){
 


   if(empty($errors)){
     $p_origen = remove_junk($db->escape($_POST['origen']));
	 $p_destino  = remove_junk($db->escape($_POST['destino']));
	 $p_carga  = remove_junk($db->escape($_POST['carga']));
	 $p_puerto  = remove_junk($db->escape($_POST['puerto']));
	 $p_despacho  = remove_junk($db->escape($_POST['despacho']));
	 $p_compra  = remove_junk($db->escape($_POST['compra']));
	   $p_razon_social  = remove_junk($db->escape($_POST['empresa']));
	 $p_venta  = remove_junk($db->escape($_POST['venta']));
	 $p_quien_genera = remove_junk($db->escape($_POST['quien_genera']));
	 $p_contacto  = remove_junk($db->escape($_POST['contacto']));
	 $p_telefono  = remove_junk($db->escape($_POST['telefono']));
	   	 
	   $p_comer_compra  = remove_junk($db->escape($_POST['comer_compra']));
	 $p_comer_venta  = remove_junk($db->escape($_POST['comer_venta']));
	   	 $p_arance_compra  = remove_junk($db->escape($_POST['arance_compra']));
	 $p_arance_venta  = remove_junk($db->escape($_POST['arance_venta']));
	 /*$p_telefono_des = remove_junk($db->escape($_POST['telefono_des']));
	 $p_correo  = remove_junk($db->escape($_POST['correo']));
	 $p_seguro  = remove_junk($db->escape($_POST['seguro']));
	 $p_producto  = remove_junk($db->escape($_POST['producto']));
	 */  
	 
     $date    = make_date();
     $query  = "INSERT INTO entrega (";
     $query .="  `razon_social`,`remitente`, `direccion`, `telefono`, `direccion_des`,`fecha`,`producto`,`carga`,`puerto`,`despacho`,`compra`,`venta`,`quien_genera`,`detalles`,`comer_compra`,`comer_venta`,`arance_compra`,`arance_venta` ";
     $query .=") VALUES (";
     $query .="'{$p_razon_social}','{$p_contacto}','{$p_origen}','{$p_telefono}','{$p_destino}','{$date}','9','{$p_carga}','{$p_puerto}','{$p_despacho}','{$p_compra}','{$p_venta}','{$p_quien_genera}','Generada por: {$p_quien_genera}','{$p_comer_compra}','{$p_comer_venta}','{$p_arance_compra}','{$p_arance_venta}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
       
	  $session->msg('s',"Alta de Pedimento Realizado ");
      echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
		 //redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Generar Alta de Pedimento.');
       echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
			//redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
    echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
	   //redirect('entrega.php',false);
   }

 }
 








if(isset($_POST['cotizar'])){
 


   if(empty($errors)){
     $p_origen = remove_junk($db->escape($_POST['origen']));
	 $p_destino  = remove_junk($db->escape($_POST['destino']));
	 $p_carga  = remove_junk($db->escape($_POST['carga']));
	 $p_razon_social  = remove_junk($db->escape($_POST['empresa']));
	 $p_quien_genera = remove_junk($db->escape($_POST['quien_genera']));
	 $p_contacto  = remove_junk($db->escape($_POST['contacto']));
	 $p_telefono  = remove_junk($db->escape($_POST['telefono']));
	   	 $p_producto  = remove_junk($db->escape($_POST['producto']));	 
	   $p_notas  = remove_junk($db->escape($_POST['notas']));
	 $p_correo  = remove_junk($db->escape($_POST['correo']));
	   $p_venta  = remove_junk($db->escape($_POST['venta']));
	 $p_compra  = remove_junk($db->escape($_POST['compra']));
	   	 /*$p_telefono_des = remove_junk($db->escape($_POST['telefono_des']));
	 $p_correo  = remove_junk($db->escape($_POST['correo']));
	 $p_seguro  = remove_junk($db->escape($_POST['seguro']));
	 $p_producto  = remove_junk($db->escape($_POST['producto']));
	 */  
	 
     $date    = make_date();
     $query  = "INSERT INTO entrega (";
     $query .="  `razon_social`,`remitente`, `direccion`, `telefono`, `direccion_des`,`fecha`,`correo`,`producto`,`carga`,`compra`,`venta`,`quien_genera`,`detalles`";
     $query .=") VALUES (";
     $query .="'{$p_razon_social}','{$p_contacto}','{$p_origen}','{$p_telefono}','{$p_destino}','{$date}','{$p_correo}','{$p_producto}','{$p_carga}','{$p_compra}','{$p_venta}','{$p_quien_genera}','Generada por: {$p_quien_genera} Detalles: {$p_notas}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
       
	  $session->msg('s',"Alta de Pedimento Realizado ");
      echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
		 //redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Generar Alta de Pedimento.');
       echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
			//redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
   echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
	   //redirect('entrega.php',false);
   }

 }







if(isset($_POST['almacen'])){
 


   if(empty($errors)){
     $p_contacto = remove_junk($db->escape($_POST['contacto']));
	 $p_telefono  = remove_junk($db->escape($_POST['telefono']));
	 $p_razon_social  = remove_junk($db->escape($_POST['razon_social']));
	 $p_palet  = remove_junk($db->escape($_POST['palet']));
	 $p_compra  = remove_junk($db->escape($_POST['compra']));
	 $p_venta  = remove_junk($db->escape($_POST['venta']));
	   $p_servicios1  = remove_junk($db->escape($_POST['servicios1']));
	   $p_servicios2  = remove_junk($db->escape($_POST['servicios2']));
	   $p_servicios3  = remove_junk($db->escape($_POST['servicios3']));
	 $p_almacen  = remove_junk($db->escape($_POST['tipo_almacen']));
	 $p_quien_genera = remove_junk($db->escape($_POST['quien_genera']));
	   $p_comer_compra  = remove_junk($db->escape($_POST['comer_compra']));
	 $p_comer_venta  = remove_junk($db->escape($_POST['comer_venta']));
	   	 $p_arance_compra  = remove_junk($db->escape($_POST['embalado_compra']));
	 $p_arance_venta  = remove_junk($db->escape($_POST['embalado_venta']));
	   $p_uva_compra  = remove_junk($db->escape($_POST['uva_compra']));
	   $p_uva_venta  = remove_junk($db->escape($_POST['uva_venta']));
	    $p_carga  = remove_junk($db->escape($_POST['carga']));
	   
	   $todos_los_servicios=$p_servicios1+$p_servicios2+$p_servicios3;
	   /*
	   
	   1 etiquetado
	   2 embalado
	   3 etiquetado + embalado
	   7 uva
	   8 etiquetado + uva
	   9 embalado + uva
	   10 etiquetado + embalado + uva
	   
	   
	   //almacen  1=servicargo    2 envipaq
	   
	   */
     $date    = make_date();
     $query  = "INSERT INTO entrega (";
     $query .="  `razon_social`,`remitente`, `telefono`, `fecha`,`producto`,`carga`,`compra`,`venta`,`quien_genera`,`detalles`,`comer_compra`,`comer_venta`,`arance_compra`,`arance_venta`,`servicios`,`almacen`,`palet`,`uva_compra`,`uva_venta` ";
     $query .=") VALUES (";
     $query .="'{$p_razon_social}','{$p_contacto}','{$p_telefono}','{$date}','11','{$p_carga}','{$p_compra}','{$p_venta}','{$p_quien_genera}','Generada por: {$p_quien_genera}','{$p_comer_compra}','{$p_comer_venta}','{$p_arance_compra}','{$p_arance_venta}','{$todos_los_servicios}','{$p_almacen}','{$p_palet}','{$p_uva_compra}','{$p_uva_venta}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
       
	  $session->msg('s',"Alta de Pedimento Realizado ");
      echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
		 //redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Generar Alta de Pedimento.');
       echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
			//redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
     echo '<meta http-equiv="Refresh" content="0; url=entrega_edit.php">';
	   
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
	
	
	
	
	
	
	
	
	
.checkbox label:after, 
.radio label:after {
    content: '';
    display: table;
    clear: both;
}

.checkbox .cr,
.radio .cr {
    position: relative;
    display: inline-block;
    border: 1px solid #a9a9a9;
    border-radius: .25em;
    width: 1.3em;
    height: 1.3em;
    float: left;
    margin-right: .5em;
}

.radio .cr {
    border-radius: 50%;
}

.checkbox .cr .cr-icon,
.radio .cr .cr-icon {
    position: absolute;
    font-size: .8em;
    line-height: 0;
    top: 50%;
    left: 20%;
}

.radio .cr .cr-icon {
    margin-left: 0.04em;
}

.checkbox label input[type="checkbox"],
.radio label input[type="radio"] {
    display: none;
}

.checkbox label input[type="checkbox"] + .cr > .cr-icon,
.radio label input[type="radio"] + .cr > .cr-icon {
    transform: scale(3) rotateZ(-20deg);
    opacity: 0;
    transition: all .3s ease-in;
}

.checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
.radio label input[type="radio"]:checked + .cr > .cr-icon {
    transform: scale(1) rotateZ(0deg);
    opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
    opacity: .5;
}
</style>



<?php include_once('layouts/header.php'); 
$usuario=$user['name'];
$medida= find_all('medida');
$products =reporte_pdf();

?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-13">
      <div class="panel panel-default">
   <!--     <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-sort-by-alphabet"></span>
            <span>Programar Entrega</span> <div align="right"><a href="reporte_pdf.php" class="btn btn-danger" title="Genera Guias Electronicas" data-toggle="tooltip">  PDF  </a></div>
            </strong>
        </div>-->
        <div class="panel-body" >
         <!--<div class="col-md-12"></div>-->
        
        
      
                <div class="tab">
					<button class="tablinks active" id="historico_btn" onclick="openCity(event, 'historico')">Historico Por Facturar</button>
   <button class="tablinks" onclick="openCity(event, 'cotizar')">Cotización</button>
	<button class="tablinks" onclick="openCity(event, 'envipaq')">Guía Envipaq <sub>(Flete)</sub></button>
  <button class="tablinks" onclick="openCity(event, 'aduana')">Aduana</button>
  <button class="tablinks" onclick="openCity(event, 'almacen')">Almacén</button>

</div>
<div id="historico" class="tabcontent" style="display: block;">
	
  
      
          <table class="table table-striped table-hover table-responsive"> <!--table-bordered-->
            <thead>
              <tr>
                <th class="text-center">Folio Guia</th>
				   <th class="text-center">SERVICIO</th>
				  <th class="text-center">SOLICITADA POR:</th>
                <th class="text-center">ORIGEN</th>
                <th class="text-center">DESTINO</th>
				  <th class="text-center">DETALLES</th>
                <!--<th class="text-center">RUTA</th>-->
                <th class="text-center">Genera PDF</th>
				  <th class="text-center">TOTAL A FACTURAR</th>
                <th class="text-center">OPCIONES</th>
              </tr>
            </thead>
            <tbody>
				<div id="resultadoBusqueda" style="background-color:rosybrown"></div>
				
              <?php foreach ($products as $product):?>
              <tr>
				  <td class="text-center"><strong><br><br><?php echo remove_junk($product['id']);?> </strong></td>
				  <td class="text-center"><strong><br><br> <?php
              
											
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
					  
					  
					  </strong></td> <!--fin de tipode  servicios-->
				  <td>
				  
				  <?php echo remove_junk($product['quien_genera']);?>
				  </td>
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
					Razón Social <strong><?php echo remove_junk($product['razon_social']);?> </strong><br><br>
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
					Razón Social <strong><?php echo remove_junk($product['razonsocial_des']);?> </strong><br><br>
					Direccion <strong><?php echo remove_junk($product['direccion_des']);?> </strong>
					Colonia <strong><?php echo remove_junk($product['colonia_des']);?> </strong>
					CP <strong><?php echo remove_junk($product['cp_des']);?> </strong>
					Telefóno <strong><?php echo remove_junk($product['telefono_des']);?> </strong>
					
					  <?php    }?>
					</td>
              
                <!--<td class="text-center">
              
          
              </td>-->
				  
				  <td>  <div class="modal fade" id="<?php echo remove_junk($product['id']);?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
		<h3><?php echo remove_junk($product['fecha']); ?>-->
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
       
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?php echo remove_junk($product['id']);?>"><i class='glyphicon glyphicon-plus' style="font-size:20px;color:red;" title="Click Para Ver Los Detalles" data-toggle="tooltip"></i> Expandir</button> </td>
				  
				


<td>
					 <?php switch ($product['producto']) 
        {
		case 1:
		case 2:
		case 3:
		case 4:
		case 5:
		case 6:
		case 7:
		case 8:
		case 10:
       
        ?> 
					  <br>
			  		<a href="pdf_entrega.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Generar PDF Guia Envipaq" data-toggle="tooltip">
                     <img src="libs/images/pdf.png" width="55" height="55" >
                    </a>
			  	<?php

 break;
		case 9:
		
?>	
					  <br>
			<a href="pdf_aduana.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Generar PDF Aduana" data-toggle="tooltip">
                     <img src="libs/images/pdf.png" width="55" height="55" >
                    </a>
<?php break;

	case 11:
		
		
		?>
					  		  <br>
			<a href="pdf_almacen.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Generar PDF Almacén" data-toggle="tooltip">
                     <img src="libs/images/pdf.png" width="55" height="55" >
                    </a>
					  
					  

<?php
		break;
case 21:
		case 22:
		case 23:
		case 24:
		case 25:
		case 26:
		case 27:
		case 28:
		
		case 30:

?>
<!--<br>
			<a href="edit_guia_envipaq.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Continuar" data-toggle="tooltip">
                     Continuar</a>-->

<?php  break;


case 29:
		
		
					  
					  ?>
					 <!-- <br>
			<a href="edit_aduana.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Continuar" data-toggle="tooltip">
                      Continuar</a>-->
					  <?php
		
		break;
		case 31:
		
		
		?>

					 <!--<br>
			<a href="edit_almacen.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Continuar" data-toggle="tooltip">
                     Continuar</a> --> 
					  
					  <?php
break;
}
					  
					  ?>	
					  
					  
				  </td>



               
                 <td>   <!--PRINCIPIO TOTAL FACTURAR TEST -->
				  
				<?php 
					 
					switch ($product['producto']) 
        {
		case 1:
		case 2:
		case 3:
		case 4:
		case 5:
		case 6:
		case 7:
		case 8:
		case 9:
		case 10:
		case 11:			 
					 ?>
				  
				  1.- Servicio $<strong><?php echo (int)$product['venta'];?>.<sup>00</sup></strong>
					<?php 
							
							if($product['comer_venta']!=0 and $product['producto']==9 ){
								
								
							echo "<br>2.- Comercialización $<strong>". $product['comer_venta'].".<sup>00</sup></strong>";	
							}
							
							if($product['comer_venta']!=0 and $product['producto']==11 ){
							
							echo "<br>2.- Etiquetado $<strong>". $product['comer_venta'].".<sup>00</sup></strong>";	
							}
							
							
							if($product['arance_venta']!=0 and $product['producto']==9){
								
								
							echo "<br>3.- Clasificación Arancelaria $<strong>". $product['arance_venta'].".<sup>00</sup></strong>";	
							}
							
							if($product['arance_venta']!=0 and $product['producto']==11){
								
								
							echo "<br>3.- Embalado $<strong>". $product['arance_venta'].".<sup>00</sup></strong>";	
							}
							
							
							if($product['uva_venta']!=0){
								
								
							echo "<br>2.- UVA $<strong>". $product['uva_venta'].".<sup>00</sup></strong>";	
							}
					
							$total_facturar=$product['uva_venta']+$product['arance_venta']+$product['comer_venta']+$product['venta'];
					 echo "<strong><br>Total ".$total_facturar.".<sup>00</sup></strong>";
					 ?>
					 
					 
					 
					 
				  </td> <!--FIN TOTAL FACTURAR --><td> <!--PRINCIPIO OPCIONES-->
					 	
					 <?php 
					}//FIN DE SWITCH TOTAL FACTURAR 
					switch ($product['producto']) 
        {
		case 1:
		case 2:
		case 3:
		case 4:
		case 5:
		case 6:
		case 7:
		case 8:
		case 9:
		case 10:
		case 11:			 
					 ?>
					 <form method="post" action="entrega_edit.php" class="clearfix">
					
					<input type="hidden" id="id_nota" name="id_nota" value="<?php echo remove_junk($product['id']);?>">
					<input  type="hidden" id="nota_server" name="nota_server" value=" <?php echo remove_junk($product['detalles']);?> ">	
					<input type="hidden" id="user_name" name="user_name" value="<?php echo remove_junk(ucfirst($user['name'])); ?>">
					
 
 <input type="hidden" id="estatus" name="estatus" value="50"><br>
					<CENTER> <button type="submit" name="facturado" class="btn btn-default" style="background-color:aquamarine; " title="Marcar Estatus de Facturado" data-toggle="tooltip"><i  class="glyphicon glyphicon-ok" style="font-size:18px; "></i></button>
    </CENTER>
     </form>
					 
					 
					 
					 
					 <form method="post" action="entrega.php" class="clearfix">
					
					<input type="hidden" id="id_nota" name="id_nota" value="<?php echo remove_junk($product['id']);?>">
					<input  type="hidden" id="nota_server" name="nota_server" value=" <?php echo remove_junk($product['detalles']);?> ">	
					<input type="hidden" id="user_name" name="user_name" value="<?php echo remove_junk(ucfirst($user['name'])); ?>">
					
 
 <input type="hidden" id="estatus" name="estatus" value="99"><br>
					<CENTER> <button type="submit" name="estatus_cancela" class="btn btn-default" style="background-color:aliceblue; " title="Cancelar" data-toggle="tooltip"><i  class="glyphicon glyphicon-trash" style="font-size:18px; "></i></button>
    </CENTER>
     </form>
					<?php }// FIN SWITCH OPCIONES
					 
					 
					 ?> 
                </td>
              </tr> 
             <?php endforeach; ?>
            </tbody>
          </table>
       
      </div>
    </div>
  
		
<div id="envipaq" class="tabcontent">
  <form method="post" action="entrega.php" class="clearfix">
               
           
          
             <div id="panel">
             <div class="row">
             
              
             
                  <div class="col-md-12">
					  <div class="col-md-12">
						  
						 <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="compra_flete" id="compra_flete"  placeholder="Tarifa de Compra" >
               
               </div></div>
					  
					  <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="venta_flete" id="venta_flete"  placeholder="Tarifa de Venta" onchange="calcula_flete();" >
               
               </div></div>
					    <div class="col-md-3">
                  
                  <span id="resul_flete" ></span>
               </div>
						  <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-briefcase"></i>
                  
                  </span><input type="text" class="form-control" name="proveedor" id="venta_flete"  placeholder="Proveedor" >
               
               </div></div>
					  </div><br><br><br>
					  <div class="col">
               <center><h2>REMITENTE</h2></center>
                    <!--<div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-sort-by-order"></i>
                  </span>
                  <input type="text" class="form-control" name="guia" placeholder="# De Guia " required>
               </div></div>-->
                 
                   <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-lock"></i>
                  </span>
                  <input type="text" class="form-control" name="razon_social" placeholder="Razón Social (ó Nombre del Cliente)" required  autofocus onkeyup="mayus(this);">
               </div></div>
               
               
                <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="remitente" placeholder="Nombre del Remitente"  onkeyup="mayus(this);">
               </div></div>
               
               <input type="hidden" value="<?php echo $user['name']?>" name="quien_genera">
                 <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-home"></i>
                  </span>
                  <input type="text" class="form-control" name="direccion" placeholder="Dirección" onkeyup="mayus(this);">
               </div></div>
               
               
                <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-home"></i>
                  </span>
                  <input type="text" class="form-control" name="colonia" placeholder=" Colonia " onkeyup="mayus(this);">
               </div></div>
               
               
               <br><br><br><br>
                <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-globe"></i>
                  </span>
                  <input type="number" class="form-control" name="cp" placeholder="Codigo Postal" maxlength="5" required >
               </div></div>
               
           
              <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-earphone"></i>
                  
                  </span><input type="number" class="form-control" name="telefono"  placeholder="Telefono" required>
               
               </div></div>
                 
                  
      
       <div class="col-md-12">           
						  </div><div class="col"><br><br><br>
   <p> <center><h2>DESTINATARIO</h2></center>
    </p>
   
     
   
   
    
                 
                   <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-lock"></i>
                  </span>
                  <input type="text" class="form-control" name="razonsocial_des" placeholder="Razón Social Destinatario (Nombre de la Empresa)" onkeyup="mayus(this);">
               </div></div>
               
               
                <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="nombre_destinatario" placeholder=" Nombre Del Destinatario "   onkeyup="mayus(this);">
               </div></div>
               
               
                 <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-home"></i>
                  </span>
                  <input type="text" class="form-control" name="direccion_des" placeholder="Dirección Destinatario " required onkeyup="mayus(this);">
               </div></div>
                  <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-home"></i>
                  </span>
                  <input type="text" class="form-control" name="colonia_des" placeholder=" Colonia Destinatario " onkeyup="mayus(this);" >
               </div></div>
               
               <br><br><br><br>
                <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-globe"></i>
                  </span>
                  <input type="number" class="form-control" name="cp_des" placeholder="Codigo Postal Destinatario " maxlength="5" onkeyup="mayus(this);" required>
               </div></div>
               
               
              <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-earphone"></i>
                  
                  </span><input type="number" class="form-control" name="telefono_des"  placeholder="Telefono Destinatario " onkeyup="mayus(this);" required>
               
               </div></div>
		   <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-envelope"></i>
                  </span>
                  <input type="text" class="form-control" name="correo" placeholder="E-mail" onkeyup="mayus(this);" title="Poner el correo de quien va a recibir las notificaciones del estado de la entrega" data-toggle="tooltip">
               </div></div>
		   <br><br>
                <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-list-alt"></i>
                  
                  </span>
					
					<textarea  class="form-control" name="notas"  placeholder=" Notas Adicionales " onkeyup="mayus(this);" rows="3"></textarea>
               </div></div>
               
						  </div>
               
               
               <!-- <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                
					  <h3>Seguro de Envio </h3> 
            Si <input type="checkbox" name="si" id="seguro">
               <div id="valor" style="display: none">
               	
               	
               	<div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="text" class="form-control" name="seguro"  placeholder=" Valor Declarado" onkeyup="mayus(this);">
               </span>
               </div></div>
               
               </div>-->
               <br><br><br><br>
                
					<center><div class="col-md-12">
						
						 <h3>Producto</h3> 
					  <p>
						  <label>
						    <input type="radio" name="producto" value="1" id="producto_3">
						    Día Siguiente</label>
						
						  <label>
						    <input type="radio" name="producto" value="2" id="producto_3">
						    2 Días</label>
						
						  <label>
						    <input type="radio" name="producto" value="3" id="producto_3" checked>
						    Terrestre</label>
						
						  <label>
						    <input type="radio" name="producto" value="4" id="producto_3">
						    Internacional</label>
						  <label>
						    <input type="radio" name="producto" value="5" id="producto_3">
						    Nacional</label>
						 <label>
						    <input type="radio" name="producto" value="6" id="producto_3">
						    LTL</label>
						  <label>
						    <input type="radio" name="producto" value="7" id="producto_3">
						    Aereo</label>
						  <label>
						    <input type="radio" name="producto" value="8" id="producto_3">
						    Maritimo</label>
						  <label>
						    <input type="radio" name="producto" value="10" id="otro_btn" >
						    Otro</label>
						 <label>
				          <div id="otro" style="display: none;" >
							 <input type="text" class="form-control" name="otro"  placeholder="Especifica que otro" onkeyup="mayus(this);">
							 </div>         
                  </label>
							 
							 
					  </p>
                    </div>
                
                </center>
                
                
            <button type="submit" name="programa" class="btn btn-danger btn-block">Programar Entrega</button>
 
    
    
    
    
    
    
    					    </div>
      </div>   
        </div>
      </div>   
        
   
     </form>
</div><!--fin guia envipaq-->


<div id="aduana" class="tabcontent">
	<form method="post" action="entrega.php" class="clearfix">
               
           
          
             <div id="panel">
             <div class="row">
             
              
             
                  <div class="col-md-12">
               <center><h2>Aduana</h2></center>
                    <!--<div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-sort-by-order"></i>
                  </span>
                  <input type="text" class="form-control" name="guia" placeholder="# De Guia " required>
               </div></div>-->
                 <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="empresa" placeholder="Razón Social (Empresa)" onkeyup="mayus(this);" required >
               </div></div>
					  <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="contacto" placeholder="Persona de Contacto" onkeyup="mayus(this);" >
               </div></div>
					  
               
              <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-earphone"></i>
                  
                  </span><input type="number" class="form-control" name="telefono"  placeholder="Teléfono" required>
               
               </div></div>
					  <br><br><br>
                   <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-globe"></i>
                  </span>
                  <input type="text" class="form-control" name="origen" placeholder="Origen" required   onkeyup="mayus(this);">
               </div></div>
               
               
                <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-globe"></i>
                  </span>
                  <input type="text" class="form-control" name="destino" placeholder="Destino"  required onkeyup="mayus(this);">
               </div></div>
               <br><br><br>
                 <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="compra" id="compra"  placeholder="Tarifa de Compra" >
               
               </div></div>
					  
					  <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="venta" id="venta"  placeholder="Tarifa de Venta" onchange="calcula();" >
               
               </div></div>
					  
					<div class="col-md-4">
                  
                  <span id="resul" ></span>
               </div>
					  
					   <br><br><br>
                 <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-compressed"></i>
                  </span>
                  <input type="text" class="form-control" name="carga" placeholder="Carga (Que Contiene)" onkeyup="mayus(this);">
               </div></div>
               
               <br><br><br>
                <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-road"></i>
                  </span>
                  <input type="text" class="form-control" name="puerto" placeholder=" Puerto Despacho " onkeyup="mayus(this);">
               </div></div>
					  
               <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-briefcase"></i>
                  </span>
                  <input type="text" class="form-control" name="despacho" placeholder=" Despacho Aduanal " onkeyup="mayus(this);">
               </div></div>
               
             
                
					  <input type="hidden" value="<?php echo $user['name']?>" name="quien_genera">
					  
					  
					
		<br><br><br>
					  
				<div class="col-md-6">
                <div class="input-group">	
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
				
					
					
					 <div class="checkbox">
          <label>
            <input type="checkbox" id="comer_btn" value="">
            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
            Comercializadora
          </label>
						  <label>
            <input type="checkbox" id="arancelaria_btn" value="">
            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
            Clasificación Arancelaria.
          </label>
        </div>
			<div id="comercializadora" style="display: none;">
				<br><br>
				<h2><center><strong>Comercializadora</strong></center></h2>
				 
				
		<div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="comer_compra" id="comer_compra"  placeholder="Compra" >
               
               </div></div>
				
                 <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="comer_venta" id="comer_venta"  placeholder="Venta" onchange="comer_calcula();" >
               
               </div></div>
					  
					  
					  
					<div class="col-md-4">
                  
                  <span id="comer_resul" ></span>
               </div>
					
					
					
					
					
					</div>		
			<div id="arancelaria" style="display: none;">
				
				<br><br><br>
					<h2><center><strong>Clasificación Arancelaria</strong></center></h2>
				 
				
		<div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="arance_compra" id="arance_compra"  placeholder="Compra" >
               
               </div></div>
				
                 <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="arance_venta" id="arance_venta"  placeholder="Venta" onchange="arance_calcula();" >
               
               </div></div>
					  
					  
					  
					<div class="col-md-4">
                  
                  <span id="arance_resul" ></span>
               </div>
				
				<br><br><br><br>
				</div>		
					
					
			
					
			<!--	<input type="checkbox" id="comer_btn" class="cb-value" />
					<label for="switch"> Comercializadora</label>
					  <div id="comercializadora" style="display: none;">test</div>
					
<input id="arancelaria_btn" type="checkbox"/><label for="switch">Clasificación Arancelaria.</label> 	  
					<div id="arancelaria" style="display: none;">otro test</div>-->
					</div></div>		  
		 <button type="submit" name="aduana" class="btn btn-danger btn-block">Generar Pedimento</button>
					  </form>
		</div></div></div>
 </div><!--fin aduana-->
			
	  
	  <div id="almacen" class="tabcontent"><!--principio  almacen-->
  <form method="post" action="entrega.php" class="clearfix">
               
           
          
             <div id="panel">
             <div class="row">
             
              
             
                  <div class="col-md-12">
               <center><h2>Almacén</h2></center>
                    <!--<div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-sort-by-order"></i>
                  </span>
                  <input type="text" class="form-control" name="guia" placeholder="# De Guia " required>
               </div></div>-->
                   <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="contacto" placeholder="Persona de Contacto"  >
               </div></div>
               
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-earphone"></i>
                  
                  </span><input type="number" class="form-control" name="telefono"  placeholder="Teléfono" required>
               
               </div></div>
					  <br><br><br>
                   <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-globe"></i>
                  </span>
                  <input type="text" class="form-control" name="razon_social" placeholder="Razón Social (Cliente)" required   onkeyup="mayus(this);">
               </div></div>
               
               
                <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-sort-by-order"></i>
                  </span>
                  <input type="number" class="form-control" name="palet" placeholder="# de Palet´s"  onkeyup="mayus(this);">
               </div></div>
               <br><br><br>
					  
					
               
               
               		  
					  
                 <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="compra" id="compra_al"  placeholder="Tarifa de Compra" >
               
               </div></div>
					  
					  <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="venta" id="venta_al"  placeholder="Tarifa de Venta" onchange="calcula_al();" >
               
               </div></div>
					  
					<div class="col-md-4">
                  
                  <span id="resul_al" ></span>
               </div>
					  <br><br><br>
					  <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-compressed"></i>
                  </span>
                  <input type="text" class="form-control" name="carga" placeholder="Carga (Que Contiene)" onkeyup="mayus(this);">
               </div></div>
					  
					  
					   <br><br><br>
                 <div class="col-md-6">
                    <select class="form-control" name="tipo_almacen">
                      <option>Almacen</option>
                   
                      <option value="1">Servicargo</option>
                      <option value="2">Envipaq</option>
                    </select>
                  </div>
					  
					  <div class="col-md-6">
                			 <div class="checkbox">
          <label>
            <input type="checkbox" id="servicios1" name="servicios1" value="1">
            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
            Etiquetado
          </label>
						  <label>
            <input type="checkbox" id="servicios2" name="servicios2" value="2">
            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
            Embalado
          </label>
								 		  <label>
            <input type="checkbox" id="servicios3" name="servicios3" value="7">
            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
            UVA
          </label>
								 
        </div></div>
				
                     
              
					  <input type="hidden" value="<?php echo $user['name']?>" name="quien_genera">
					  
					
					  
					  
					  
					  
					  
					  
				<div id="etiquetado" style="display: none;">
				<br><br>
				<h2><center><strong>Etiquetado</strong></center></h2>
				 
				
		<div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="etiquetado_compra" id="etiquetado_compra"  placeholder="Compra" >
               
               </div></div>
				
                 <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="comer_venta" id="etiquetado_venta"  placeholder="Venta" onchange="etiquetado_calcula();" >
               
               </div></div>
					  
					  
					  
					<div class="col-md-4">
                  
                  <span id="etiquetado_resul" ></span>
               </div>
					
					
					
					
					
					</div>		
			<div id="embalado" style="display: none;">
				
				<br><br><br>
					<h2><center><strong>Embalado</strong></center></h2>
				 
				
		<div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="embalado_compra" id="embalado_compra"  placeholder="Compra" >
               
               </div></div>
				
                 <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="embalado_venta" id="embalado_venta"  placeholder="Venta" onchange="embalado_calcula();" >
               
               </div></div>
					  
					  
					  
					<div class="col-md-4">
                  
                  <span id="embalado_resul" ></span>
               </div></div>
					  
					  
					  
					  
					  
					  
				
				
			<div id="uva" style="display: none;">
				
				<br><br><br>
					<h2><center><strong>UVA</strong></center></h2>
				 
				
		<div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="uva_compra" id="uva_compra"  placeholder="Compra" >
               
               </div></div>
				
                 <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="uva_venta" id="uva_venta"  placeholder="Venta" onchange="uva_calcula();" >
               
               </div></div>
					  
					  
					  
					<div class="col-md-4">
                  
                  <span id="uva_resul" ></span>
               </div></div>
					  
					  
					  
					  
				
				
				
				
					  
					
		<br><br><br>
		 <button type="submit" name="almacen" class="btn btn-danger btn-block">Generar Pedimento</button>
					  </form>
		</div>
	  
	  
	  
	
	  
	  
	  </div></div><!--fin almacen-->
	  
	  
	  
	  
 </div> <div id="cotizar" class="tabcontent"><!--principio cotizar-->
	  
	<form method="post" action="entrega.php" class="clearfix">
               
           
          
             <div id="panel">
             <div class="row">
             
              
             
                  <div class="col-md-12">
               <center><h2>Registrar Cotización</h2></center>
                    <!--<div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-sort-by-order"></i>
                  </span>
                  <input type="text" class="form-control" name="guia" placeholder="# De Guia " required>
               </div></div>-->
                 <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="empresa" placeholder="Razón Social (Empresa)" required  >
               </div></div>
					  <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="contacto" placeholder="Persona de Contacto"  >
               </div></div>
					  
                 <br><br><br>
                   
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-earphone"></i>
                  
                  </span><input type="number" class="form-control" name="telefono"  placeholder="Teléfono" required>
               
               </div></div>
					  <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-envelope"></i>
                  
                  </span><input type="text" class="form-control" name="correo"  placeholder="E-mail" >
               
               </div></div>
					  
					  <br><br><br>
                   <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-globe"></i>
                  </span>
                  <input type="text" class="form-control" name="origen" placeholder="Origen (Dirección)" required   onkeyup="mayus(this);">
               </div></div>
               
               
                <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-globe"></i>
                  </span>
                  <input type="text" class="form-control" name="destino" placeholder="Destino (Dirección)"  required onkeyup="mayus(this);">
               </div></div>
               
					  
					   <br><br><br>
					  <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="compra" id="compra_coti"  placeholder="Tarifa de Compra" >
               
               </div></div>
					  
					  <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="venta" id="venta_coti"  placeholder="Tarifa de Venta" onchange="calcula_coti();" >
               
               </div></div>
					  
					<div class="col-md-4">
                  
                  <span id="resul_coti" ></span>
               </div>
					  
					  <br><br><br>
                 <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-compressed"></i>
                  </span>
                  <input type="text" class="form-control" name="carga" placeholder="Carga (Que Contiene)" onkeyup="mayus(this);">
               </div></div>
               
         <br><br><br>
                 <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-list"></i>
                  </span>
                 
					<textarea class="form-control rounded-1" rows="3" name="notas" placeholder="Notas" onkeyup="mayus(this);"></textarea>
               </div></div>
               
             
                <div class="col-md-12">
						
						 <h3>Producto</h3> 
					  <p>
						  <label>
						    <input type="radio" name="producto" value="21" id="producto_3">
						    Día Siguiente</label>
						
						  <label>
						    <input type="radio" name="producto" value="22" id="producto_3">
						    2 Días</label>
						
						  <label>
						    <input type="radio" name="producto" value="23" id="producto_3">
						    Terrestre</label>
						
						  <label>
						    <input type="radio" name="producto" value="24" id="producto_3">
						    Internacional</label>
						  <label>
						    <input type="radio" name="producto" value="25" id="producto_3">
						    Nacional</label>
						 <label>
						    <input type="radio" name="producto" value="26" id="producto_3">
						    LTL</label>
						  <label>
						    <input type="radio" name="producto" value="27" id="producto_3">
						    Aereo</label>
						  <label>
						    <input type="radio" name="producto" value="28" id="producto_3">
						    Maritimo</label>
						  <label>
						    <input type="radio" name="producto" value="29" id="producto_3">
						    Aduana</label>
						  <label>
						    <input type="radio" name="producto" value="30" id="otro_btn" required >
						    Otro</label>
						  <label>
						    <input type="radio" name="producto" value="31" id="producto_3">
						    Almacén</label>
						 <label>
				          <div id="otro" style="display: none;" >
							 <input type="text" class="form-control" name="otro"  placeholder="Especifica que otro" onkeyup="mayus(this);">
							 </div>         
                  </label>
							 
							 
					  </p>
                    </div>
					  <input type="hidden" value="<?php echo $user['name']?>" name="quien_genera">
					  	</div></div>	<br><br>
		 <button type="submit" name="cotizar" class="btn btn-danger btn-block">Registrar  Pedimento</button>
					  
		</div></form>	
		</div><!--fin cotizar-->

		
      
     

        
           
         
                    
          
    
    
            
         
      
    
    <script>
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
		
	 function comer_calcula(){

 

        var a = Number (document.getElementById('comer_venta').value );

        var b = Number (document.getElementById('comer_compra').value );

 

        var c = a - b;

 var resul= Math.sign(c);

			if(resul==1){
document.getElementById('comer_resul').innerHTML ="Ganacia $"+c;
        //document.getElementById('resul').html().value = c;

        }else{
				
				 document.getElementById('comer_resul').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
				
			}

        //alert(document.getElementById('maxima').options[document.getElementById('maxima').selectedIndex].text);

    }	
		
		
			
	 function uva_calcula(){

 

        var a = Number (document.getElementById('uva_venta').value );

        var b = Number (document.getElementById('uva_compra').value );

 

        var c = a - b;

 var resul= Math.sign(c);

			if(resul==1){
document.getElementById('uva_resul').innerHTML ="Ganacia $"+c;
        //document.getElementById('resul').html().value = c;

        }else{
				
				 document.getElementById('uva_resul').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
				
			}

        //alert(document.getElementById('maxima').options[document.getElementById('maxima').selectedIndex].text);

    }
		
		
		
		
		
		function etiquetado_calcula(){

 

        var a = Number (document.getElementById('etiquetado_venta').value );

        var b = Number (document.getElementById('etiquetado_compra').value );

 

        var c = a - b;

 var resul= Math.sign(c);

			if(resul==1){
document.getElementById('etiquetado_resul').innerHTML ="Ganacia $"+c;
        //document.getElementById('resul').html().value = c;

        }else{
				
				 document.getElementById('etiquetado_resul').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
				
			}}

		
		
		
		
	function embalado_calcula(){

 

        var a = Number (document.getElementById('embalado_venta').value );

        var b = Number (document.getElementById('embalado_compra').value );

 

        var c = a - b;

 var resul= Math.sign(c);

			if(resul==1){
document.getElementById('embalado_resul').innerHTML ="Ganacia $"+c;
        //document.getElementById('resul').html().value = c;

        }else{
				
				 document.getElementById('embalado_resul').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
				
			}}
		
		
		
		
		
		
		
		
		
		
		
		
		
 
 function calcula(){

 

        var a = Number (document.getElementById('venta').value );

        var b = Number (document.getElementById('compra').value );

 

        var c = a - b;

 var resul= Math.sign(c);

			if(resul==1){
document.getElementById('resul').innerHTML ="Ganacia $"+c;
        //document.getElementById('resul').html().value = c;

        }else{
				
				 document.getElementById('resul').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
				
			}

        //alert(document.getElementById('maxima').options[document.getElementById('maxima').selectedIndex].text); arance_compra

    } function arance_calcula(){

 

        var a = Number (document.getElementById('arance_venta').value );

        var b = Number (document.getElementById('arance_compra').value );

 

        var c = a - b;

 var resul= Math.sign(c);

			if(resul==1){
			  
document.getElementById('arance_resul').innerHTML ="Ganacia $"+c;
        //document.getElementById('resul').html().value = c;
			}else{
				
				 document.getElementById('arance_resul').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
				
			}
        

        //alert(document.getElementById('maxima').options[document.getElementById('maxima').selectedIndex].text); arance_compra calcula_flete

    }
	
		function calcula_al(){

 

        var a = Number (document.getElementById('venta_al').value );

        var b = Number (document.getElementById('compra_al').value );

 

        var c = a - b;

var resul= Math.sign(c);

			if(resul==1){
			   
			   document.getElementById('resul_al').innerHTML ="Ganacia $"+c;
        //docum
			   }else{
			   document.getElementById('resul_al').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
        //document.getElementById('resul').html().value = c;
			   }
        

        //alert(document.getElementById('maxima').options[document.getElementById('maxima').selectedIndex].text);

    }
		
	function calcula_flete(){

 

        var a = Number (document.getElementById('venta_flete').value );

        var b = Number (document.getElementById('compra_flete').value );

 

        var c = a - b;

var resul= Math.sign(c);

			if(resul==1){
			   
			   document.getElementById('resul_flete').innerHTML ="Ganacia $"+c;
        //docum
			   }else{
			   document.getElementById('resul_flete').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
        //document.getElementById('resul').html().value = c;
			   }
        

        //alert(document.getElementById('maxima').options[document.getElementById('maxima').selectedIndex].text);

    }
	
		
		
		function calcula_coti(){

 

        var a = Number (document.getElementById('venta_coti').value );

        var b = Number (document.getElementById('compra_coti').value );

 

        var c = a - b;

var resul= Math.sign(c);

			if(resul==1){
			   
			   document.getElementById('resul_coti').innerHTML ="Ganacia $"+c;
        //docum
			   }else{
			   document.getElementById('resul_coti').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
        //document.getElementById('resul').html().value = c;
			   }
        

        //alert(document.getElementById('maxima').options[document.getElementById('maxima').selectedIndex].text);

    }
		
		
		
		
		
		$(document).ready(function() {
				$("#otro_btn").on( "click", function() {
			$('#otro').css("display:block;")
				});
			
			
			$("#producto_3").on( "click", function() {
			$('#otro').css("display:none;")
		});
		
	});
		
		$(document).ready(function() {
				$("#pdf_btn").focus(function(event) {
					$("#pdf").load('desarrollo.php');
				});
			});
		
		
</script>


<?php include_once('layouts/footer.php'); 
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  ?>
