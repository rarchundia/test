<?php
  $page_title = 'Ruta';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
  
?>

<?php 

if(isset($_POST['add_odometro'])){
 
  $p_placas= $_POST['placas'];
    $p_odometro= $_POST['odometro'];
  $p_recoleccion_odometro= $_POST['id_recoleccion'];
  $p_ruta_odometro= $_POST['id_ruta'];
  $p_operador= $_POST['operador'];
	
	  
	 $date    = make_date();
     $query  = "INSERT INTO odometro (";
     $query .=" placas, id_ruta, id_recoleccion, odometro, fecha, operador";
     $query .=") VALUES (";
     $query .="'{$p_placas}','{$p_ruta_odometro}','{$p_recoleccion_odometro}','{$p_odometro}','{$date}','{$p_operador}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
	 
			   
     if($db->query($query)){
	  $session->msg('s',"Recolección Agregada Exitosamente  . ");
		 
		 $sql="DELETE FROM `media` WHERE `id_recoleccion`=0 AND `id_entrega`=0";
		$media_borra=$db->query($sql);
		 // redirect('operador.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Agregar el Odometro.');
       //redirect('recoleccion.php', false);
	   }

  

 }
 
 

?>
<?php 

if(isset($_POST['odometro_entrega'])){
 
  $p_placas= $_POST['placas'];
    $p_odometro= $_POST['odometro'];
  $p_recoleccion_odometro= $_POST['id_entrega'];
  $p_ruta_odometro= $_POST['id_ruta'];
  $p_operador= $_POST['operador'];
	
	  
	 $date    = make_date();
     $query  = "INSERT INTO odometro (";
     $query .=" placas, id_ruta, odometro, fecha, operador,id_entrega";
     $query .=") VALUES (";
     $query .="'{$p_placas}','{$p_ruta_odometro}','{$p_odometro}','{$date}','{$p_operador}','{$p_recoleccion_odometro}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
	 
			   
     if($db->query($query)){
	  $session->msg('s',"Entrega Guardada Exitosamente  . ");
		 
		 $sql="DELETE FROM `media` WHERE `id_recoleccion`=0 AND `id_entrega`=0";
		$media_borra=$db->query($sql);
		 // redirect('operador.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Agregar el Odometro.');
       //redirect('recoleccion.php', false);
	   }

  

 }
 
 

?>



<?php 
include_once('layouts/header.php');
$id=$user['id'];
 $products = operador($id);
$entrega = operador_entrega($id);
$entrega_muestra=operador_entrega_muestra($id);
$comp=comprueba();

 ?>
<!--  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Ruta para hoy <?php echo date("d/m/Y");?></strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered"> 
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center"> EMPRESA</th>
                <th class="text-center">DIRECCION</th>
                <th class="text-center" style="width: 10%;"> PAQUETES A RECOLECTAR</th>
                <th class="text-center" style="width: 10%;"> ESTADO</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo $product['id_reco'];?></td>
                <td><span title="<?php echo remove_junk($product['notas']); ?>" data-toggle="tooltip"> <?php echo remove_junk($product['id_empresa']); ?></span></td>
                <td class="text-center">
                
                
                Contacto <strong><?php  echo $product['nombre'];?></strong> Telefono:  <strong><?php  echo $product['telefono'];?></strong><br> Correo: <strong style="text-transform:lowercase"><?php  echo $product['correo'];?></strong><br />
  
 Calle: <strong><?php echo $product['direccion'];?></strong> Numero: <strong><?php echo $product['numero'];?></strong>  Colonia: <strong><?php  echo $product['colonia'];?></strong>  Delegación: <strong><?php  echo $product['delegacion'];?></strong><br>  Codigo Postal: <strong><?php  echo $product['cp'];?></strong> Fecha de Recoleccion: <strong><?php  echo $product['fechaprogramar'];?></strong>
                 
                 </td>  <!--fin direccion
                
                <td class="text-center"><span title="Medidas del Paquete más Grande: Alto <?php echo remove_junk($product['alto']); ?> x Ancho <?php echo remove_junk($product['ancho']); ?> x Largo <?php echo remove_junk($product['largo']); ?>" data-toggle="tooltip"> <?php echo remove_junk($product['totalp']); ?></span>
                
                
                </td>
                
                <td class="text-center"> <a href="recolecta.php?id=<?php echo $product['id_reco'];?>&correo=<?php echo $product['correo'];?>&id_ruta=<?php echo $id;?>" class="btn btn-danger btn-block">
                     Recolecta
                    </a></td>
               
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  -->








<?php 

//foreach ($comp as $compruebame):
//if($compruebame['estatus']==2 && $compruebame['id_operador']==$user['id']){

?>		
 


<div class="col-md-13">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>  Entregas </strong>
        </div>
        <div class="panel-body">
          <?php foreach ($entrega as $entre):
				if($entre['estatus']==2 && $entre['id_operador']==$user['id']){
					
					if($entre['en_ruta']==0){
		  
		    $query   = "UPDATE entrega SET";
       $query  .=" en_ruta ='{$date}'";
       $query  .=" WHERE id ='{$entre['id_entrega']}'";
       $result = $db->query($query);
		/*if($result && $db->affected_rows() === 1){
          //       $session->msg('s',"En Espera de Validacion de los Documentos ");
            echo '<meta http-equiv="Refresh" content="0; url=operador.php">';
	           } */
		  
		  //redirect('detalle_contacto.php?id='.$_GET['id'], false);
          }else{}
					
					
				?>
			
			
			<div class="card" style="width: 100%">
  <div class="card-body">
    <h5 class="card-title"># de guia <strong><?php echo $entre['id_entrega'];?></strong><br>
		Razon Social: <strong><?php echo remove_junk($entre['nombre']); ?></strong></h5>
    
    <p class="card-text"></p>
    
  </div>
</div>
		<div class="card" style="width: 100%">
  <div class="card-body">
    <h5 class="card-title"><br><strong>Origen</strong></h5>
    
    <p class="card-text">Remitente: <strong><?php echo remove_junk($entre['remitente']); ?></strong>
				  <br>
					Direccion: <strong><?php echo remove_junk($entre['direccion']); ?></strong> Col. <strong><?php echo remove_junk($entre['colonia']); ?></strong> Cp: <strong><?php echo remove_junk($entre['cp']); ?></strong>
<!--Telefono: <strong><?php echo remove_junk($entre['telefono']); ?>--></p>
	  <p class="card-text"><br>
	  <strong>Destino:</strong> <strong><?php echo remove_junk($entre['nombre_destinatario']); ?></strong>
				  <br>
					Direccion: <strong><?php echo remove_junk($entre['direccion_des']); ?></strong> Col. <strong><?php echo remove_junk($entre['colonia_des']); ?></strong> Cp: <strong><?php echo remove_junk($entre['cp_des']); ?></strong>
Telefono: <strong><?php echo remove_junk($entre['telefono_des']); ?></strong>	
	  </p>
	  
	  <p class="card-text">
					<?php
					
					if($entre['primera']==0){
					
				echo '<strong><br>Intento Primera Entrega</strong>';	
					?>
					
					
					<form action="Primera.php" method="post">
					
						
							<div class="form-group">
    
   <input name="id_entrega" type="hidden" class="form-control" value="<?php echo $entre['id_entrega']; ?>">
						<input name="correo" class="form-control" type="hidden" value="<?php echo $entre['correo']; ?>">
						<input name="notas" class="form-control" type="text" placeholder="  Agregar Notas Primera Entrega"><br>
  </div>
						
						
						
						
						<button type="submit" name="primera" class="btn btn-success btn-block btn-lg" >Primera</button>
						
					</form>
				  
				  <?php }//fin primera entrega
					
					
					
					?>
					
					
					
					
					<?php
					
					if($entre['primera']!=0 && $entre['segunda']==0){
					
				echo '<strong><br>Intento Segunda Entrega</strong><br><br>';	
					?>
					
					
					<form action="segunda.php" method="post">
					
						<div class="form-group">
						<input name="id_entrega" type="hidden" value="<?php echo $entre['id_entrega']; ?>">
						<input name="correo" type="hidden" value="<?php echo $entre['correo']; ?>">
						<input name="notas" type="text" class="form-control" placeholder="  Agregar Notas Segundo Intento de Entrega"><br>
						</div>
						<button type="submit" name="segunda" class="btn btn-success btn-block btn-lg" >Segunda</button>
						
					</form>
				  
				  <?php }//fin primera entrega
					
					
					
					?>
					
					<?php
					
					if($entre['primera']!=0 && $entre['segunda']!=0 && $entre['tercera']==0){
					
				echo '<strong><br>Intento Tercera Entrega</strong><br><br>';	
					?>
					
					
					<form action="tercera.php" method="post">
					
						<div class="form-group">
						<input name="id_entrega" type="hidden" value="<?php echo $entre['id_entrega']; ?>">
						<input name="correo" type="hidden" value="<?php echo $entre['correo']; ?>">
						<input name="notas" type="text" class="form-control" placeholder="  Agregar Notas Tercer Intento de Entrega"><br>
						</div>
						<button type="submit" name="tercera" class="btn btn-success btn-block btn-lg" >Tercera</button>
						
					</form>
				  
				  <?php }//fin primera entrega
					
					
					
					?>
					
					<?php
					
					if($entre['primera']!=0 && $entre['segunda']!=0 && $entre['tercera']!=0){
					
				echo '<strong><br>Se Agotaron los Intentos de Entrega</strong><br><br>';}	
					?>
					
					
					
	  </p>
			
			
			
			
			<p class="card-text">
			 <!--<form action="entrega_firma.php" method="post">-->
					
					
				 
						<!--<input name="id_entrega" type="text" value="<?php echo $entre['id_entrega']; ?>">
						<input name="correo" type="text" value="<?php echo $entre['correo']; ?>">
						<input name="id_ruta" type="text" value="<?php echo $id; ?>">-->
						 
						<br><br><br><br>
				 <h2><center>Marcar como Entregado</center></h2>
						<button name="entrega" class="btn btn-danger btn-block btn-lg" data-toggle="modal" data-target="#<?php echo $entre['id_entrega']; ?>">Entregado</button>
						
					<!--</form>-->
			
			<!-- Modal -->
<div id="<?php echo $entre['id_entrega']; ?>" class="modal fade modal-lg" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nombre para la Firma</h4>
      </div>
      <div class="modal-body">
      
		  
		  <form action="../uploads/products/signature.php" method="post">
					 <label for="email">Nombre de Quien Recibe</label>
						<input name="quien_recibe" type="text" placeholder="    Quien Recibe el Paquete " style="width: 100%; height: 40px" onkeyup="mayus(this);" value="" required>
		<br><br>
						<input name="id_entrega" type="hidden" value="<?php echo $entre['id_entrega']; ?>">
						<input name="correo" type="hidden" value="<?php echo $entre['correo']; ?>">
						<input name="id_ruta" type="hidden" value="<?php echo $id; ?>">
						
						<button type="submit" name="entrega" class="btn btn-success btn-block" >Firma</button>
						
					</form>
		  
		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
			
			</p>
			
			
			
  </div>
</div>	
			
			
			
			
			

			
	<hr style="border-color:red; ">		
			
			
        </div>
<?php }
				endforeach; ?>
      </div>
    </div>


<?php 
//						}//fin if

//endforeach;
?>



  <?php include_once('layouts/footer.php'); ?>
