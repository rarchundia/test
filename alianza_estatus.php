<?php
  $page_title = 'Alianza Estatus';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  
?>

<?php
 
	  
if(isset($_POST['agregar_estatus'])){
    
	$p_estatus=$_POST['estatus'];
	$id_reco=$_POST['id_reco'];
	
	$notas_alianza=$_POST['notas_alianza'];
	$id_ruta=$_POST['id_user'];
	
   if(empty($errors)){
         
	 $query1  = "INSERT INTO paqueteria (";
     $query1 .=" id_recolecta, id_ruta, notas) VALUES ('{$id_reco}','{$id_ruta}','{$notas_alianza}')"; 
	 
	 $query  = "UPDATE recolecta SET estatus='{$p_estatus}'";
     $query  .=" WHERE id ='{$id_reco}'";
     
	   $result = $db->query($query);
	  
	   $result1 = $db->query($query1);
	   
               if($result && $db->affected_rows() === 1){
	   
                 $session->msg('s',"Se ha Actualizado el Estatus. ");
                 //redirect('alianza_estatus.php', false);
               } else {
                 $session->msg('d',' Lo Siento, Actualización Falló Intenta Otra Vez.');
                 //redirect('alianza_estatus.php', false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('alianza_estatus.php', false);
   }

 }//fin laptop
 
 
 

?>



<?php 
include_once('layouts/header.php');
$id=$user['id'];
 $products = consulta_operador_alianza($id);
 ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Marcar Como Recolectada</strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered"> 
            <thead>
              <tr>
                <th class="text-center" style="width: 30px;">#</th>
                <th class="text-center">EMPRESA</th>
                <th class="text-center">DIRECCION</th>
                <th class="text-center" style="width: 10%;">MARCAR ESTATUS</th>
                
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td><span title="<?php echo remove_junk($product['notas']); ?>" data-toggle="tooltip"> <?php echo remove_junk($product['id_empresa']); ?></span></td>
                <td>
                
                           
                
                
                Contacto <strong><?php  echo $product['nombre'];?></strong> Telefono:  <strong><?php  echo $product['telefono'];?></strong><br> Correo: <strong style="text-transform:lowercase"><?php  echo $product['correo'];?></strong><br />
  
 Calle: <strong><?php echo $product['direccion'];?></strong> Numero: <strong><?php echo $product['numero'];?></strong>  Colonia: <strong><?php  echo $product['colonia'];?></strong>  Delegación: <strong><?php  echo $product['delegacion'];?></strong><br>  Codigo Postal: <strong><?php  echo $product['cp'];?></strong> <br />
 Medidas del Paquete más Grande: Alto <strong><?php echo remove_junk($product['alto']); ?> </strong>x Ancho <strong><?php echo remove_junk($product['ancho']); ?></strong> x Largo <strong><?php echo remove_junk($product['largo']); ?>"</strong>  Total a recoger: <strong><?php echo remove_junk($product['totalp']); ?></strong>
               <h2> <br> Folio de recolección: <strong><?php echo remove_junk($product['alianza']); ?>"</strong></h2>
                 </td>  <!--fin direccion-->
                
                <td class="text-center">
                
                <br />
                <form method="post" action="alianza_estatus.php" class="clearfix">
 <input name="estatus" type="hidden" value="1"/> 
 <input type="hidden" name="id_reco" value="<?php echo $product['id_reco'];?>">
                   <input type="text" name="notas_alianza" placeholder="Notas" style="width: 100%;">
                   <input type="hidden" name="id_user" value="<?php echo $id;?>">
                    
 <button type="submit" name="agregar_estatus" class="btn btn-success btn-block" title="Agregar Notas y Marcar Como Recolectada" data-toggle="tooltip">Recolectada</button>
 </form>
 
 
 <br>
                <form method="post" action="alianza_estatus.php" class="clearfix">

 <input type="hidden" name="id_reco" value="<?php echo $product['id_reco'];?>">
                   <input type="text" name="notas_alianza" placeholder="Notas" style="width: 100%;">
                   <input type="hidden" name="id_user" value="<?php echo $id;?>">
                    
 <button type="submit" name="agregar_estatus" class="btn btn-success btn-block" title="Agregar Notas Solamente sin Marcar Como Recolectada" data-toggle="tooltip">Solo Notas</button>
 </form>
 

                </td>
                
              
               
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
