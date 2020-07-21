<?php
  $page_title = 'Editar Guia';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(7);
?>
<?php
$product = find_by_id('entrega',(int)$_GET['id']);

if(!$product){
  $session->msg("d","Registro No Encontrado.");
  redirect('entrega.php');
}
?>
<?php


if(isset($_POST['almacen'])){
 


   if(empty($errors)){
	     $date    = make_date();
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
	  
	   $p_notas  = remove_junk($db->escape($_POST['notas']));
	    $p_notas1  = remove_junk($db->escape($_POST['notas1']));
	    
	 $p_notas2=$p_notas. $date." (".$p_quien_genera.") ". $p_notas1." ";
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
     
     $query  = "UPDATE entrega SET";
     $query .="  razon_social='{$p_razon_social}',remitente='{$p_contacto}', telefono='{$p_telefono}', producto=11, carga='{$p_carga}', compra='{$p_compra}', venta='{$p_venta}', detalles='{$p_notas2}', comer_compra='{$p_comer_compra}',comer_venta='{$p_comer_venta}', arance_compra='{$p_arance_compra}', arance_venta='{$p_arance_venta}', servicios='{$todos_los_servicios}', almacen='{$p_almacen}', palet='{$p_palet}', uva_compra='{$p_uva_compra}',uva_venta='{$p_uva_venta}' WHERE id ='{$product['id']}'";
     if($db->query($query)){
       
	  $session->msg('s',"Alta de Pedimento Realizado ");
      echo '<meta http-equiv="Refresh" content="0; url=entrega.php">';
		 //redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Generar Alta de Pedimento.');
        redirect('edit_almacen.php?id='.$product['id'], false);
			//redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
     echo '<meta http-equiv="Refresh" content="0; url=entrega.php">';
	   
	   //redirect('entrega.php',false);
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
     $query  = "UPDATE entrega SET";
     $query .="  razon_social='{$p_razon_social}', remitente='{$p_remitente}', direccion='{$p_direccion}', colonia='{$p_colonia}', cp='{$p_cp}', telefono='{$p_telefono}', razonsocial_des='{$razonsocial_des}', nombre_destinatario='{$p_nombre_destinatario}', direccion_des='{$p_direccion_des}', colonia_des='{$p_colonia_des}', cp_des='{$p_cp_des}', telefono_des='{$p_telefono_des}', fecha='{$date}', correo='{$p_correo}', producto='{$p_producto}', compra='{$p_compra_flete}', venta='{$p_venta_flete}', quien_genera='{$p_quien_genera}',detalles='Editada por: {$p_quien_genera} Detalles: {$p_notas}', proveedor='{$p_proveedor}' WHERE id ='{$product['id']}'";
     if($db->query($query)){
       
	  $session->msg('s',"Guia Envipaq Generada Correctamente ");
      echo '<meta http-equiv="Refresh" content="0; url=entrega.php">';
		 // redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Generar la Guia Intenta Nuevamente.');
      echo '<meta http-equiv="Refresh" content="0; url=entrega.php">';
			//redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
    echo '<meta http-equiv="Refresh" content="0; url=entrega.php">';
	   //redirect('entrega.php',false);
   }

 }



?>

<style>


checkbox label:after, 
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



<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Cotización de Guia.</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
			 
			 <div class="checkbox">
          <label>
            <input type="checkbox" id="muestra" value="">
            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
            Cliente Acepta la Propuesta.
          </label>
			 </div>	 
				 
				 
			<div id="panel">
           <form method="post" action="edit_guia_envipaq.php?id=<?php echo (int)$product['id'] ?>">
			   
           
          
             <div id="panel">
             <div class="row">
             
              
             
                  <div class="col-md-12">
               <center><h2>Actualizar Cotización</h2></center>
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
                  <input type="text" class="form-control" name="empresa" placeholder="Razón Social (Empresa)" value="<?php echo remove_junk($product['razon_social']);?>"required  >
               </div></div>
					  <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="contacto" value="<?php echo remove_junk($product['remitente']);?>" placeholder="Persona de Contacto"  >
               </div></div>
					  
                 <br><br><br>
                   
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-earphone"></i>
                  
                  </span><input type="number" class="form-control" name="telefono"  placeholder="Teléfono" value="<?php echo remove_junk($product['telefono']);?>" required>
               
               </div></div>
					  <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-envelope"></i>
                  
                  </span><input type="text" class="form-control" name="correo"  value="<?php echo remove_junk($product['correo']);?>"  placeholder="E-mail" >
               
               </div></div>
					  
					  <br><br><br>
                   <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-globe"></i>
                  </span>
                  <input type="text" class="form-control" name="origen" placeholder="Origen" required value="<?php echo remove_junk($product['direccion']);?>"   onkeyup="mayus(this);">
               </div></div>
               
               
                <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-globe"></i>
                  </span>
                  <input type="text" class="form-control" name="destino" placeholder="Destino" value="<?php echo remove_junk($product['direccion_des']);?>"  required onkeyup="mayus(this);">
               </div></div>
               
					  
					   <br><br><br>
					  <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="compra" id="compra" value="<?php echo remove_junk($product['compra']);?>" placeholder="Tarifa de Compra" >
               
               </div></div>
					  
					  <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="venta" id="venta" value="<?php echo remove_junk($product['venta']);?>" placeholder="Tarifa de Venta" onchange="calcula();" >
               
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
                  <input type="text" class="form-control" name="carga" placeholder="Carga (Que Contiene)" value="<?php echo remove_junk($product['carga']);?>" onkeyup="mayus(this);">
               </div></div>
               
         <br><br><br>
                 <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                  Notas Anteriores -> 
                  <?php echo remove_junk($product['detalles']);?></span>
                 <input type="hidden" readonly="readonly" name="notas"  value="<?php echo remove_junk($product['detalles']);?>"/>
					
					
               </div></div>	  
				
				<div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-list"></i>
                  </span>
               
					
					<textarea class="form-control rounded-1" rows="3" name="notas1" placeholder="Notas" onkeyup="mayus(this);"></textarea>
               </div></div>
               
             
               
					  <input type="hidden" value="<?php echo $user['name']?>" name="quien_genera">
					  <input type="hidden" class="form-control" name="id_servicio" value="<?php echo remove_junk($product['id']);?>">
					  	</div></div>	<br><br>
		 <button type="submit" name="cotizar" class="btn btn-danger btn-block">Actualizar  Pedimento</button>
					  
		</div></form>
			   
			   
			   
			   
			   
			   
			   
				
			   </div> <!--fin del primer panel -->  
			   
			 
             
<div id="form2" style="display:none">
            
	 <form method="post" action="edit_guia_envipaq.php?id=<?php echo (int)$product['id'] ?>">
		 
		 <br><br>
		 
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
                  <input type="text" class="form-control" name="razon_social" placeholder="Razón Social (ó Nombre del Cliente)" value="<?php echo remove_junk($product['razon_social']);?>" required  autofocus onkeyup="mayus(this);">
               </div></div>
               
               
                <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="remitente" value="<?php echo remove_junk($product['remitente']);?>" placeholder="Nombre del Remitente"  onkeyup="mayus(this);">
               </div></div>
               
               <input type="hidden" value="<?php echo $user['name']?>" name="quien_genera">
                 <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-home"></i>
                  </span>
                  <input type="text" class="form-control" name="direccion" placeholder="Dirección" value="<?php echo remove_junk($product['direccion']);?>" onkeyup="mayus(this);">
               </div></div>
               
               
                <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-home"></i>
                  </span>
                  <input type="text" class="form-control" name="colonia" placeholder=" Colonia " value="<?php echo remove_junk($product['colonia']);?>" onkeyup="mayus(this);">
               </div></div>
               
               
               <br><br><br><br>
                <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-globe"></i>
                  </span>
                  <input type="number" class="form-control" name="cp" placeholder="Codigo Postal" value="<?php echo remove_junk($product['cp']);?>" maxlength="5" required >
               </div></div>
               
           
              <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-earphone"></i>
                  
                  </span><input type="number" class="form-control" name="telefono"  value="<?php echo remove_junk($product['telefono']);?>" placeholder="Telefono" required>
               
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
                  <input type="text" class="form-control" name="razonsocial_des" value="<?php echo remove_junk($product['razonsocial_des']);?>" placeholder="Razón Social Destinatario (Nombre de la Empresa)" onkeyup="mayus(this);">
               </div></div>
               
               
                <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="nombre_destinatario" value="<?php echo remove_junk($product['nombre_destinatario']);?>" placeholder=" Nombre Del Destinatario "   onkeyup="mayus(this);">
               </div></div>
               
               
                 <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-home"></i>
                  </span>
                  <input type="text" class="form-control" name="direccion_des" placeholder="Dirección Destinatario " value="<?php echo remove_junk($product['direccion_des']);?>" required onkeyup="mayus(this);">
               </div></div>
                  <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-home"></i>
                  </span>
                  <input type="text" class="form-control" name="colonia_des" value="<?php echo remove_junk($product['colonia_des']);?>" placeholder=" Colonia Destinatario " onkeyup="mayus(this);" >
               </div></div>
               
               <br><br><br><br>
                <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-globe"></i>
                  </span>
                  <input type="number" class="form-control" name="cp_des" value="<?php echo remove_junk($product['cp_des']);?>" placeholder="Codigo Postal Destinatario " maxlength="5" onkeyup="mayus(this);" required>
               </div></div>
               
               
              <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-earphone"></i>
                  
                  </span><input type="number" class="form-control" name="telefono_des" value="<?php echo remove_junk($product['telefono_des']);?>"  placeholder="Telefono Destinatario " onkeyup="mayus(this);" required>
               
               </div></div>
		   <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-envelope"></i>
                  </span>
                  <input type="text" class="form-control" name="correo" placeholder="E-mail" value="<?php echo remove_junk($product['correo']);?>" onkeyup="mayus(this);"><!-- title="Poner el correo de quien va a recibir las notificaciones del estado de la entrega" data-toggle="tooltip">-->
               </div></div>
		   <br><br>
                <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-list-alt"></i>
                  
                  </span>
					
					<textarea  class="form-control" name="notas"  placeholder=" Notas Adicionales " value="<?php echo remove_junk($product['detalles']);?>" onkeyup="mayus(this);" rows="3"></textarea>
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
						    <input type="radio" name="producto" value="1" id="producto_3" required>
						    Día Siguiente</label>
						
						  <label>
						    <input type="radio" name="producto" value="2" id="producto_3">
						    2 Días</label>
						
						  <label>
						    <input type="radio" name="producto" value="3" id="producto_3">
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
		 
		 
		 
		 
		 
		 
		 
		 
		 
	
	
	
	
					  </form>
		</div><!--fin segundo panel-->
	  
				 
          
         </div>   
			 
			 	 
					
					
					
					
					
			 </div>
        </div>
      </div>
  </div>
<script>
	  
	  
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
	
	
	
	
	
	  </script>


<?php include_once('../layouts/footer.php'); ?>
