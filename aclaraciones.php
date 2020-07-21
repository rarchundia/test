<?php
  $page_title = 'Incidencias';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
 page_require_level(5);
  $medida= find_all('medida');
  ?>
<?php 

if(isset($_POST['programa'])){
 

 $p_colonia= remove_junk($db->escape($_POST['colonia']));
  $razonsocial_des = remove_junk($db->escape($_POST['razonsocial_des']));
 $p_notas = remove_junk($db->escape($_POST['notas']));
 
   $req_fields = array( 'razon_social', 'remitente', 'direccion','cp','telefono','nombre_destinatario','direccion_des','colonia_des','cp_des','telefono_des');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_guia = remove_junk($db->escape($_POST['guia']));
	 $p_razon_social  = remove_junk($db->escape($_POST['razon_social']));
	 $p_remitente  = remove_junk($db->escape($_POST['remitente']));
	 $p_direccion  = remove_junk($db->escape($_POST['direccion']));
	 $p_cp  = remove_junk($db->escape($_POST['cp']));
	 $p_telefono  = remove_junk($db->escape($_POST['telefono']));
	   
	 $p_nombre_destinatario  = remove_junk($db->escape($_POST['nombre_destinatario']));
	 $p_direccion_des  = remove_junk($db->escape($_POST['direccion_des']));
	 $p_colonia_des  = remove_junk($db->escape($_POST['colonia_des']));
	 $p_cp_des  = remove_junk($db->escape($_POST['cp_des']));
	 $p_telefono_des = remove_junk($db->escape($_POST['telefono_des']));
	 $p_correo  = remove_junk($db->escape($_POST['correo']));
	 $p_seguro  = remove_junk($db->escape($_POST['seguro']));
	 $p_producto  = remove_junk($db->escape($_POST['producto']));
	   
	 
     $date    = make_date();
     $query  = "INSERT INTO entrega (";
     $query .="  `id_folio`, `empresa`, `persona_reporta`, `direccion`, `municipio`, `cp`, `telefono`, `correo`, `guia`, `fecha_reporte`, `fecha_solucion`, `reporte`, `atn`";
     $query .=") VALUES (";
     $query .="'{$p_guia}','{$p_razon_social}','{$p_remitente}','{$p_direccion}','{$p_colonia}','{$p_cp}','{$p_telefono}','{$razonsocial_des}','{$p_nombre_destinatario}','{$p_direccion_des}','{$p_colonia_des}','{$p_cp_des}','{$p_telefono_des}','{$date}','{$p_correo}','{$p_seguro}','{$p_producto}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
       
	  $session->msg('s',"Entrega Programada ");
       redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Programarla.');
       redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
     redirect('entrega.php',false);
   }

 }
 
 

?>



<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-tag"></span>
            <span>Ingresar Reporte</span> 
            </strong>
        </div>
        <div class="panel-body" >
         <!--<div class="col-md-12"></div>-->
        
        
      
                  
                  
               
        
        
        
        
           
         
                    
          <form method="post" action="incidencias.php" class="clearfix">
               
           
          
             <div id="panel">
             <div class="row">
             <div class="col-md-12">
              
                    
                     <div class="form-group">
                <div class="row">
                   <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-lock"></i>
                  </span>
                  <input type="text" class="form-control" name="empresa" placeholder="  Cliente ( Envipaq )" required autofocus  onkeyup="mayus(this);">
               </div></div>
               <input type="hidden" class="form-control" name="quien_ingresa" value="<?php echo $user['name']?>">
               
              				 
                <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="persona_reporta" placeholder="  Nombre de Quien Reporta  ( Juan Perez )" required  onkeyup="mayus(this);">
               </div></div></div></div>
               
               <div class="form-group">
                <div class="row">
                 <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-home"></i>
                  </span>
                  <input type="text" class="form-control" name="direccion" placeholder="  Dirección Completa ( Rumania 507 Portales Norte )" required onkeyup="mayus(this);">
               </div></div>
               
               
                <div class="col-md-8">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-home"></i>
                  </span>
                  <input type="text" class="form-control" name="municipio" placeholder=" Delegación o Municipio ( Benito Juarez )" onkeyup="mayus(this);">
               </div></div> 
               
              
            
                <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-globe"></i>
                  </span>
                  <input type="number" class="form-control" name="cp" placeholder=" Codigo Postal (03300)" maxlength="5" >
               </div></div>
               </div></div>
           <div class="form-group">
                <div class="row">
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-earphone"></i>
                  
                  </span><input type="number" class="form-control" name="telefono"  placeholder="Teléfono ( 5955 9595)" required>
               
               </div></div>
                   <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-envelope"></i>
                  </span>
                  <input type="text" class="form-control" name="correo" placeholder="E-mail  ( envipaq@envipaq.com.mx)"   onkeyup="mayus(this);" title="Poner el correo de quien va a recibir las notificaciones del estado de la entrega" data-toggle="tooltip">
               </div></div>
				 
				 
				 
				   <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-envelope"></i>
                  </span>
                  <input type="text" class="form-control" name="guia" placeholder="  # de Guia " onkeyup="mayus(this);" title="Numero de guia en caso que el reporte lo requiera" data-toggle="tooltip">
               </div></div>
				 </div></div>
				 
				 
				 <div class="form-group">
                <div class="row">
		   
                <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-list-alt"></i>
                  
                  </span>
					<textarea name="reporte" class="form-control" placeholder=" Escribe Reporte " onkeyup="mayus(this);" rows="5"></textarea>
               
               </div></div></div></div>
               
               
               
               
              
                
                
            <button type="submit" name="programa" class="btn btn-danger btn-block">Genera Folio<button>
 
    
    
    
    
    
    
    
   
     </form>
    
    
              
         
        </div>
      </div>  </div>
    
    
 

<?php include_once('layouts/footer.php'); ?>
