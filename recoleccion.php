<?php
  $page_title = 'Recolección';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
 // page_require_level(4);
  $medida= find_all('medida');
  ?>
<?php 
if(isset($_POST['add_equipo'])){
 

 $p_medida= remove_junk($db->escape($_POST['medida']));
  $p_paqueteria = remove_junk($db->escape($_POST['paqueteria']));
 $p_notas = remove_junk($db->escape($_POST['notas']));
	$p_quien_programa = remove_junk($db->escape($_POST['quien_programa']));
	
  $p_cp_des = remove_junk($db->escape($_POST['cp_des']));
   $req_fields = array('direccion','colonia','cp','paquetes','alto','ancho','largo','nombre','empresa','telefono','fecha','correo');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_direccion = remove_junk($db->escape($_POST['direccion']));
	 
	 $p_colonia  = remove_junk($db->escape($_POST['colonia']));
	 $p_cp  = remove_junk($db->escape($_POST['cp']));
	 $p_paquetes  = remove_junk($db->escape($_POST['paquetes']));
	 $p_alto  = remove_junk($db->escape($_POST['alto']));
	 $p_ancho  = remove_junk($db->escape($_POST['ancho']));
	 $p_largo  = remove_junk($db->escape($_POST['largo']));
	 $p_nombre  = remove_junk($db->escape($_POST['nombre']));
	 $p_correo  = remove_junk($db->escape($_POST['correo']));
	 $p_empresa  = remove_junk($db->escape($_POST['empresa']));
	 $p_peso= remove_junk($db->escape($_POST['peso']));
	 $p_telefono  = remove_junk($db->escape($_POST['telefono']));
	 $p_delegacion= remove_junk($db->escape($_POST['delegacion']));
	 $p_fecha  = remove_junk($db->escape($_POST['fecha']));
	
	
	 
	 
     $date    = make_date();
     $query  = "INSERT INTO recolecta (";
     $query .=" direccion, colonia, delegacion, cp, totalp, alto, ancho, largo, peso, nombre, id_empresa, fechaprogramar, fechasolicitud, notas, medida, telefono,correo,cp_des, paqueteria, quien_programa";
     $query .=") VALUES (";
     $query .="'{$p_direccion}','{$p_colonia}','{$p_delegacion}','{$p_cp}','{$p_paquetes}','{$p_alto}','{$p_ancho}','{$p_largo}','{$p_peso}','{$p_nombre}','{$p_empresa}','{$p_fecha}','{$date}','{$p_notas}','{$p_medida}','{$p_telefono}','{$p_correo}','{$p_cp_des}','{$p_paqueteria}','{$p_quien_programa}'";
     $query .=")";
	   
	   if($db->query($query)){
       
	  $session->msg('s',"Recolección Agregada Exitosamente!!! :-)   ");
       redirect('recoleccion.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Ingresar La Recolección Intenta Otra Vez :(');
       redirect('recoleccion.php', false);
	   }

   } else{
     $session->msg("d", $errors);
     redirect('recoleccion.php',false);
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
            <span class="glyphicon glyphicon-th"></span>
            <span>Programar Recolección</span>
            </strong>
        </div>
        <div class="panel-body" >
         <!--<div class="col-md-12"></div>-->
        
        
      
                  
                  
               
        
        
        
        
           
         
                    
          <form method="post" action="recoleccion.php" class="clearfix">
               
           
          
             <div id="panel">
             <div class="row">
             
               <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input type="text" class="form-control" name="nombre" autofocus placeholder="Nombre de la Persona que Entrega Paquete" required  onkeyup="mayus(this);">
               </div></div>
                
				 <input type="hidden" class="form-control" name="quien_programa" value="<?php echo $user['name']?>">
               
                <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-envelope"></i>
                  </span>
                  <input type="email" class="form-control" name="correo" placeholder="Correo Electronico" required  onkeyup="mayus(this);">
               </div></div>
               
               
                 <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-earphone"></i>
                  </span>
                  <input type="text" class="form-control" name="telefono" placeholder="Teléfono Contacto" required>
               </div></div>
               <br><br><br><br>
                <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-globe"></i>
                  </span>
                  <input type="text" class="form-control" name="empresa" placeholder="Nombre de la Empresa" required  onkeyup="mayus(this);">
               </div></div>
               
               <br><br>
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-road"></i>
                  
                  </span><input type="text" class="form-control" name="direccion"  placeholder="Dirección Donde se Recolecta" required  onkeyup="mayus(this);">
               
               </div></div>
                  
                  
               
                   
              <!-- <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-sort-by-order"></i>
                  </span>
                  <input type="text" class="form-control" name="numero" placeholder="Número" onkeyup="mayus(this);">
               </div></div>
               -->
               
               
                  <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-flag"></i>
                  </span>
                  <input type="text" class="form-control" name="colonia" placeholder="Colonia" required onkeyup="mayus(this);">
               </div></div>
               
				 <div class="col-md-12">
                  <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-flag"></i>
                  </span>
                  <input type="text" class="form-control" name="delegacion" placeholder="Delegación o Municipio"  onkeyup="mayus(this);">
               </div></div></div>
               
               
                 <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-map-marker"></i>
                  </span>
                  <input type="number" class="form-control" name="cp" maxlength="5" placeholder="Codigo Postal Origen" required onkeyup="mayus(this);">
               </div></div>
                  
                  
               <div class="col-md-6">
                 <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-map-marker"></i>
                  </span>
                  <input type="number" class="form-control" maxlength="5" name="cp_des" placeholder="Codigo Postal Destino" required onkeyup="mayus(this);">
               </div></div></div>
               
                   
           </div>  <br>             
    <!--<button id="muestra" class="btn btn-success">Continuar</button>
    -->
    
    <label class="btn btn-success btn-block" id="muestra">Continuar</label>
   
    
    
    
     </div> <!--fin panel-->
     
   
    <div id="form2" style="display:none">
    
  
                 <div class="col-md-3">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-sort-by-order"></i>
                     </span>
                     <input type="number" class="form-control" name="alto" placeholder="Alto"  title="Si Son Varios Paquetes Pon las Medidas del más Grande" data-toggle="tooltip">
                  </div>
                 </div>
                 <div class="col-md-3">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-remove"></i>
                     </span>
                     <input type="number"class="form-control" name="ancho" placeholder="Ancho">
                     </div>
                 </div>
                  <div class="col-md-3">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-remove"></i>
                      </span>
                     <input type="number" class="form-control" name="largo" placeholder="Largo">
                     </div>
                  </div>
               
                  
                  <div class="col-md-3">
                  <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-resize-horizontal"></i>
                      </span>
                    
                                      <select class="form-control" name="medida" >
                      <option value="1">Centimetros</option>
                      <option value="2">Metros</option>
                    
                    </select>
                  </div></div>
               
                   <br><br>
                
                
                <div class="col-md-6">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-sort-by-order"></i>
                     </span>
                     <input type="number" class="form-control" name="paquetes" placeholder="Total de Paquetes a Recoger" >
                  </div>
                 </div>
                 
                 
               <br><br><br>
                  <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-grain"></i>
                  </span>
                  <input type="number" class="form-control" name="peso" placeholder="Peso"  title="Peso Aproximado de Todos los Paquetes" data-toggle="tooltip">
               </div></div>
               
               
               
                <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-calendar"></i>
                  </span>
                  
                  <input type="text" class="datepicker form-control" name="fecha" autocomplete="off" required placeholder="Fecha de Recolección">
               </div></div>
                  
                  
               
                
               
               
                  <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-pushpin"></i>
                  </span>
                  <input type="text" class="form-control" name="notas" placeholder="Notas Adicionales" onkeyup="mayus(this);">
               </div></div><br /><br /><br /><br />
<div class="col-md-2">
          <label class="btn btn-success" id="regresa">&lt;- Regresar</label></div>
	<div class="col-md-10">
                <button type="submit" name="add_equipo" class="btn btn-danger btn-block">Programar Recolección</button>
    
    </div>
    
    
    
    

    
    </div> <!--fin form2-->
     </form>
    
    
              
         
        </div>
      </div>
    
    
 

<?php include_once('layouts/footer.php'); ?>
