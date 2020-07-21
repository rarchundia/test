<?php
  $page_title = 'Editar Almacen';
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



 if(isset($_POST['cotizar'])){
 


   if(empty($errors)){
	   $date    = make_date();  
	   $p_id_servicio = remove_junk($db->escape($_POST['id_servicio']));
     $p_origen = remove_junk($db->escape($_POST['origen']));
	 $p_destino  = remove_junk($db->escape($_POST['destino']));
	 $p_carga  = remove_junk($db->escape($_POST['carga']));
	 $p_razon_social  = remove_junk($db->escape($_POST['empresa']));
	 $p_quien_genera = remove_junk($db->escape($_POST['quien_genera']));
	 $p_contacto  = remove_junk($db->escape($_POST['contacto']));
	 $p_telefono  = remove_junk($db->escape($_POST['telefono']));
	   	// $p_producto  = remove_junk($db->escape($_POST['producto']));	 
	   $p_notas  = remove_junk($db->escape($_POST['notas']));
	    $p_notas1  = remove_junk($db->escape($_POST['notas1']));
	 $p_correo  = remove_junk($db->escape($_POST['correo']));
	   $p_venta  = remove_junk($db->escape($_POST['venta']));
	 $p_compra  = remove_junk($db->escape($_POST['compra']));
	   	 /*$p_telefono_des = remove_junk($db->escape($_POST['telefono_des']));
	 $p_correo  = remove_junk($db->escape($_POST['correo']));
	 $p_seguro  = remove_junk($db->escape($_POST['seguro']));
	 $p_producto  = remove_junk($db->escape($_POST['producto']));
	 */  
	 $p_notas2=$p_notas. $date." (".$p_quien_genera.") ". $p_notas1." ";
   
     $query  = "UPDATE entrega SET";
     $query .="  razon_social ='{$p_razon_social}',remitente='{$p_contacto}', direccion='{$p_origen}', telefono='{$p_telefono}', direccion_des='{$p_destino}',correo='{$p_correo}', carga='{$p_carga}',compra='{$p_compra}',venta='{$p_venta}', detalles='{$p_notas2}' WHERE id ='{$product['id']}'";
     //$query .= WHERE id ='{$product['id']}'") VALUES (";
     /*$query .="'{$p_razon_social}','{$p_contacto}','{$p_origen}','{$p_telefono}','{$p_destino}','{$date}','{$p_correo}','{$p_producto}','{$p_carga}','{$p_compra}','{$p_venta}','{$p_quien_genera}','Generada por: {$p_quien_genera} Detalles: {$p_notas}'";
     $query .=")";*/
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
       
	  $session->msg('s',"Cotización Editada Con Exito ");
       redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Actualizar La Cotización.');
       redirect('edit_almacen.php?id='.$product['id'], false);
	   }

   } else{
     $session->msg("d", $errors);
     redirect('entrega.php',false);
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
            <span>Cotización de Almacen.</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
			 
			 <div class="checkbox">
          <label>
            <input type="checkbox" id="muestra" value="">
            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
            Cliente Acepta la Propuesta
          </label>
			 </div>	 
				 
				 
			<div id="panel">
           <form method="post" action="edit_almacen.php?id=<?php echo (int)$product['id'] ?>">
			   
           
          
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
         <form method="post" action="edit_almacen.php?id=<?php echo (int)$product['id'] ?>">
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
                  <input type="text" class="form-control" name="contacto" placeholder="Persona de Contacto" value="<?php echo remove_junk($product['remitente']);?>" onkeyup="mayus(this);" >
               </div></div>
               
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-earphone"></i>
                  
                  </span><input type="number" class="form-control" name="telefono"  placeholder="Teléfono"  value="<?php echo remove_junk($product['telefono']);?>"required>
               
               </div></div>
					  <br><br><br>
                   <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-globe"></i>
                  </span>
                  <input type="text" class="form-control" name="razon_social" placeholder="Razón Social (Cliente)" value="<?php echo remove_junk($product['razon_social']);?>" required   onkeyup="mayus(this);">
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
                  
                  </span><input type="number" class="form-control" name="compra" id="compra_al" value="<?php echo remove_junk($product['compra']);?>"  placeholder="Tarifa de Compra" >
               
               </div></div>
					  
					  <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="venta" id="venta_al" value="<?php echo remove_junk($product['venta']);?>" placeholder="Tarifa de Venta" onchange="calcula_al();" >
               
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
                  <input type="text" class="form-control" name="carga" placeholder="Carga (Que Contiene)" value="<?php echo remove_junk($product['carga']);?>" onkeyup="mayus(this);">
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
				
				
					  
					
		<br><br><br>
		 <button type="submit" name="almacen" class="btn btn-danger btn-block">Generar Pedimento</button>
					  </form>
		</div><!--fin segundo panel-->
	  
				 
          
         </div>   
			 
			 	 
					
					
					
					
					
			 </div>
        </div>
      </div>
  </div>
<script>
	  
	  
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

    }
	
	function arance_calcula(){

 

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
	
	
	  </script>


<?php include_once('../layouts/footer.php'); ?>
