<?php
  $page_title = 'Editar Contacto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
?>
<?php
$product = find_by_id('contacto',(int)$_GET['id']);

if(!$product){
  $session->msg("d","Registro No Encontrado.");
  redirect('pipedrive.php');
}
?>
<?php

if(isset($_POST['cliente'])){
 

 
    $p_contacto= remove_junk($db->escape($_POST['contacto']));
    $p_telefono = remove_junk($db->escape($_POST['telefono']));
    $p_domicilio = remove_junk($db->escape($_POST['domicilio']));
	$p_delegacion = remove_junk($db->escape($_POST['delegacion']));
	$p_email = remove_junk($db->escape($_POST['email']));
	$p_cp = remove_junk($db->escape($_POST['cp']));
	$p_id_user = remove_junk($db->escape($_POST['id_user']));
	$p_empresa = remove_junk($db->escape($_POST['empresa']));
	$date    = make_date();

	
	
	//INSERT INTO excel (razon_social, guia, fecha_envio, servicio, incidencia, asesor, activo)  VALUES 
     $query  = "UPDATE contacto SET contacto='{$p_contacto}', telefono='{$p_telefono}', domicilio='{$p_domicilio}', cp='{$p_cp}', delegacion='{$p_delegacion}', id_vendedor='{$p_id_user}', fecha='{$date}', empresa='{$p_empresa}', correo='{$p_email}' WHERE id ='{$product['id']}' ";
	   
	   if($db->query($query)){
       
	  $session->msg('s',"Contacto Modificado Correctamente!!! :-)   ");
      echo '<meta http-equiv="Refresh" content="0; url=pipedrive.php">';
		   //redirect('pipedrive.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Modificar el Contacto Intenta Otra Vez :(');
      echo '<meta http-equiv="Refresh" content="0; url=pipedrive.php">';
			//redirect('pipedrive.php', false);
	   }

   

 }


if(isset($_POST['cliente_detalle'])){
 

 
    $p_contacto= remove_junk($db->escape($_POST['contacto']));
    $p_telefono = remove_junk($db->escape($_POST['telefono']));
    $p_domicilio = remove_junk($db->escape($_POST['domicilio']));
	$p_delegacion = remove_junk($db->escape($_POST['delegacion']));
	$p_email = remove_junk($db->escape($_POST['email']));
	$p_cp = remove_junk($db->escape($_POST['cp']));
	$p_id_user = remove_junk($db->escape($_POST['id_user']));
	$p_empresa = remove_junk($db->escape($_POST['empresa']));
	$date    = make_date();

	
	
	//INSERT INTO excel (razon_social, guia, fecha_envio, servicio, incidencia, asesor, activo)  VALUES 
     $query  = "UPDATE contacto SET contacto='{$p_contacto}', telefono='{$p_telefono}', domicilio='{$p_domicilio}', cp='{$p_cp}', delegacion='{$p_delegacion}', id_vendedor='{$p_id_user}', fecha='{$date}', empresa='{$p_empresa}', correo='{$p_email}' WHERE id ='{$product['id']}' ";
	   
	   if($db->query($query)){
       
	  $session->msg('s',"Contacto Modificado Correctamente!!! :-)   ");
      echo '<meta http-equiv="Refresh" content="0; url=detalle_contacto.php?id='.(int)$product['id'].'">';
	  
		   //redirect('pipedrive.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Modificar el Contacto Intenta Otra Vez :(');
      echo '<meta http-equiv="Refresh" content="0; url=detalle_contacto.php?id='.(int)$product['id'].'">';
	  		//redirect('pipedrive.php', false);
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
            <span class="glyphicon glyphicon-user"></span>
            <span>Editar Contacto <?php echo remove_junk($product['contacto']);?></span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
		
			 
			 <form method="post" action="edit_contacto.php?id=<?php echo (int)$product['id'] ?>">
			
				 
				 
				 <?php $url=$_SERVER['HTTP_REFERER']; 
					$pos = strpos($url, "detalle_contacto.php");
	
			if($pos!==false){
			?>
			<p>
				<a href="detalle_contacto.php?id=<?php echo $product["id"]; ?>" class="btn btn-default" >&lt;- Regresar</a>
			
			</p>
			<?php
			}else{
							?>
			<p> <a href="pipedrive.php" class="btn btn-default">&lt;- Regresar  </a></p>
			
			
			<?php 
			}
			
			?>
				 
				 
				 
				 
				 
				 
				 
				 
			 
					
					  <div class="form-group">
                  <div class="col-md-6">
                     <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"> Contacto</i>
                  </span>
						 
                  <input type="text" class="form-control" name="contacto" placeholder="Contacto" required onkeyup="mayus(this);" value="<?php echo remove_junk($product['contacto']);?>">
               </div>
					  </div> </div>
                  
                  
                   <div class="form-group">
					   <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-earphone"> Teléfono</i>
                  </span>
                  <input type="text" class="form-control" name="telefono" placeholder="Teléfono" required onkeyup="mayus(this);" value="<?php echo remove_junk($product['telefono']);?>">
               </div>
               </div> </div>
			
			  <div class="form-group">
			        <div class="col-md-12">
                     <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-map-marker"> Domicilio</i>
                  </span>
                  <input type="text" class="form-control" name="domicilio" placeholder="Domicilio" required onkeyup="mayus(this);" value="<?php echo remove_junk($product['domicilio']);?>">
               </div>
					  </div> </div><br><br><br><br>
						 <div class="form-group">
			        <div class="col-md-6">
                     <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon">@ Correo</i>
                  </span>
                  <input type="email" class="form-control" name="email" placeholder="Correo Electronico" required onkeyup="mayus(this);" value="<?php echo remove_junk($product['correo']);?>">
               </div>
					  </div> </div>
                 <div class="form-group">
					   <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-lock"> Nombre de la Empresa</i>
                  </span>
                  <input type="text" class="form-control" name="empresa" placeholder="Nombre de la Empresa" required onkeyup="mayus(this);" value="<?php echo remove_junk($product['empresa']);?>">
               </div>
               </div> </div>
               
                   <div class="form-group">
					    <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-map-marker"> Delegación</i>
                  </span>
                  <input type="text" class="form-control" name="delegacion" placeholder="Delegación o Municipio"  onkeyup="mayus(this);" value="<?php echo remove_junk($product['delegacion']);?>">
               </div> </div>
               </div>
		  
				
				  <div class="form-group">
			          <div class="col-md-6">
                     <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-map-marker"> Codigo Postal</i>
                  </span>
                  <input type="text" class="form-control" name="cp" placeholder="CP" onkeyup="mayus(this);" pattern="[0-9]{4,6}" value="<?php echo remove_junk($product['cp']);?>">
               </div>
					  </div> </div> 
                  
                 
				
				<input type="hidden" class="form-control" name="id_user" value="<?php echo remove_junk(first_character($user['id'])); ?>">
				<br><br><br><br>
				
				<div class="col-md-12">
			 <?php $url=$_SERVER['HTTP_REFERER']; 
					$pos = strpos($url, "detalle_contacto.php");
	
			if($pos!==false){
			?>
			<button type="submit" name="cliente_detalle" class="btn btn-success btn-block"><i class="glyphicon glyphicon-floppy-disk"></i>     Guardar  </button>
					</div>
				
					 </form>
			<?php
			}else{
							?>
			<button type="submit" name="cliente" class="btn btn-success btn-block"><i class="glyphicon glyphicon-floppy-disk"></i>     Guardar  </button>
			 </div>
				
					 </form>
			
			
			<?php 
			}
			
			?>
					
					
					
					
				  
			 
			 
			 
			 
			 
			 
			
					
					
					
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
