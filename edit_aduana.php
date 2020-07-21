<?php
  $page_title = 'Editar Aduana';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
?>
<?php
$product = find_by_id('entrega',(int)$_GET['id']);

if(!$product){
  $session->msg("d","Registro No Encontrado.");
  redirect('entrega.php');
}
?>
<?php


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
     $query  = "UPDATE entrega SET razon_social='{$p_razon_social}', remitente='{$p_contacto}', direccion='{$p_origen}', telefono='{$p_telefono}', direccion_des='{$p_destino}', producto='9', carga='{$p_carga}', puerto='{$p_puerto}', despacho='{$p_despacho}', compra='{$p_compra}', venta='{$p_venta}', comer_compra='{$p_comer_compra}', comer_venta='{$p_comer_venta}', arance_compra='{$p_arance_compra}', arance_venta='{$p_arance_venta}' WHERE id ='{$product['id']}'";
    
	    if($db->query($query)){
       
	  $session->msg('s',"Alta de Pedimento Realizado ");
       redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Generar Alta de Pedimento.');
       redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
     redirect('entrega.php',false);
   }

 }
 



 if(isset($_POST['cotizar'])){
 


   if(empty($errors)){
	   
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
	 $p_correo  = remove_junk($db->escape($_POST['correo']));
	   $p_venta  = remove_junk($db->escape($_POST['venta']));
	 $p_compra  = remove_junk($db->escape($_POST['compra']));
	  $p_notas2=$p_notas. $date." (".$p_quien_genera.") ". $p_notas1." ";
	   
	   
	   	 /*$p_telefono_des = remove_junk($db->escape($_POST['telefono_des']));
	 $p_correo  = remove_junk($db->escape($_POST['correo']));
	 $p_seguro  = remove_junk($db->escape($_POST['seguro']));
	 $p_producto  = remove_junk($db->escape($_POST['producto']));
	 */  
	 
     $date    = make_date();
     $query  = "UPDATE entrega SET";
     $query .="  razon_social ='{$p_razon_social}',remitente='{$p_contacto}', direccion='{$p_origen}', telefono='{$p_telefono}', direccion_des='{$p_destino}',correo='{$p_correo}', carga='{$p_carga}',compra='{$p_compra}',venta='{$p_venta}',detalles='{$p_notas}' WHERE id ='{$product['id']}'";
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
       redirect('edit_aduana.php?id='.$product['id'], false);
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
            <span>Cotización de Aduana.</span>
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
           <form method="post" action="edit_aduana.php?id=<?php echo (int)$product['id'] ?>">
			   
           
          
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
                   <i class="glyphicon glyphicon-th-list"></i>
                  </span>
                 
					<textarea class="form-control rounded-1" rows="3" name="notas" placeholder="Notas" onkeyup="mayus(this);"></textarea>
               </div></div>
               
             
               
					  <input type="hidden" value="<?php echo $user['name']?>" name="quien_genera">
					  <input type="hidden" class="form-control" name="id_servicio" value="<?php echo remove_junk($product['id']);?>">
					  	</div></div>	<br><br>
		 <button type="submit" name="cotizar" class="btn btn-danger btn-block">Actualizar  Pedimento</button>
					  
		</div></form>
			   
			   
			   
			   
			   
			   
			   
				
			   </div> <!--fin del primer panel -->  
			   
			 
             
<div id="form2" style="display:none">
             <form method="post" action="edit_aduana.php?id=<?php echo (int)$product['id'] ?>" class="clearfix">
               
            <input type="hidden" class="form-control" name="product-title" value="<?php echo remove_junk($product['id']);?>">
          
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
                  <input type="text" class="form-control" name="empresa" placeholder="Razón Social (Empresa)"  value="<?php echo remove_junk($product['razon_social']);?>"required onkeyup="mayus(this);" >
               </div></div>
					  <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="contacto" value="<?php echo remove_junk($product['remitente']);?>" placeholder="Persona de Contacto" onkeyup="mayus(this);" >
               </div></div>
					  
               
              <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-earphone"></i>
                  
                  </span><input type="number" class="form-control" name="telefono"  placeholder="Teléfono" value="<?php echo remove_junk($product['telefono']);?>" required onkeyup="mayus(this);" >
               
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
                  
                  </span><input type="number" class="form-control" onkeyup="mayus(this);" name="compra" id="compra_coti" value="<?php echo remove_junk($product['compra']);?>" placeholder="Tarifa de Compra" >
               
               </div></div>
					  
					  <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-usd"></i>
                  
                  </span><input type="number" class="form-control" name="venta" id="venta_coti" value="<?php echo remove_junk($product['venta']);?>" placeholder="Tarifa de Venta" onchange="calcula_coti();" >
               
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
                  <input type="text" class="form-control" name="carga" placeholder="Carga (Que Contiene)" value="<?php echo remove_junk($product['carga']);?>" onkeyup="mayus(this);">
               </div></div>
               
               <br><br><br>
                <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-road"></i>
                  </span>
                  <input type="text" class="form-control" name="puerto" placeholder=" Puerto Despacho "  value="<?php echo remove_junk($product['puerto']);?>" onkeyup="mayus(this);">
               </div></div>
					  
               <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-briefcase"></i>
                  </span>
                  <input type="text" class="form-control" name="despacho" placeholder=" Despacho Aduanal " value="<?php echo remove_junk($product['despacho']);?>" onkeyup="mayus(this);">
               </div></div>
               
             
                
					  <input type="hidden" value="<?php echo $user['name']?>" name="quien_genera">
					  
					  
					
		<br><br><br>
					  
				<div class="col-md-12">
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
              
               </div>
              </div>
              
				 
				 
				 
				 
          
         </div>   <!--fin de primer formulario-->
			 
			 	 
					
					
					
					
					
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
	
	  </script>
<?php include_once('../layouts/footer.php'); ?>
