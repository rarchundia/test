<?php
  $page_title = 'Detalle de la Cita';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
?>
<?php
$recent_sales = citas_id((int)$_GET['id']);

if(!$recent_sales){
  $session->msg("d","Id de Cita Desconocido.");
  redirect('pipedrive.php');
}
?>
<?php
 if(isset($_POST['product'])){
    $req_fields = array('product-title','product-categorie','product-quantity','buying-price', 'saleing-price' );
    validate_fields($req_fields);

   if(empty($errors)){
       $p_name  = remove_junk($db->escape($_POST['product-title']));
       $p_cat   = (int)$_POST['product-categorie'];
       $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
       $p_buy   = remove_junk($db->escape($_POST['buying-price']));
       $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
       if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
         $media_id = '0';
       } else {
         $media_id = remove_junk($db->escape($_POST['product-photo']));
       }
       $query   = "UPDATE products SET";
       $query  .=" name ='{$p_name}', quantity ='{$p_qty}',";
       $query  .=" buy_price ='{$p_buy}', sale_price ='{$p_sale}', categorie_id ='{$p_cat}',media_id='{$media_id}'";
       $query  .=" WHERE id ='{$product['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Producto ha sido actualizado. ");
                 redirect('product.php', false);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('edit_product.php?id='.$product['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_product.php?id='.$product['id'], false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">

			
			
			
							<div class="col-md-12"><!--principio de contactos-->
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-user"></span>
            <span>Detalle  de Cita<span class="pull-right">

	 <a href="pipedrive.php" class="btn btn-info pull-right">Regresar</a>
	</span> </span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover table-responsive">
       <thead>
         <tr>
           <th class="text-center">Contacto-Teléfono</th>
           <th class="text-center">Empresa</th>
           <th class="text-center">Domicilio</th>
           <th class="text-center">Fecha y Hora</th>
			 <th class="text-center">Notas</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach ($recent_sales as  $recent_sale): ?>
         <tr > 
           <td class="text-center">
			   <?php echo remove_junk(first_character($recent_sale['contacto']));?>
			 Teléfono: <?php echo remove_junk(first_character($recent_sale['telefono']));?>
			 
			 </td>
           <td>
           
            <?php echo remove_junk(first_character($recent_sale['empresa'])); ?>
          
           </td>
           <td><?php echo remove_junk(ucfirst($recent_sale['domicilio'])); ?></td>
           <td class="text-center">
			<?php echo remove_junk(ucfirst($recent_sale['fecha_hora'])).' Hora: '.$recent_sale['tiempo']; ?></td>
              
			 </td> 
		   <td class="text-center">
			<?php echo remove_junk(ucfirst($recent_sale['notas'])) ?></td>
              
			 </td> 
		
			</tr>
			
			
			
			
			    <?php endforeach; ?>
       </tbody>
     </table>
    </div>
   </div>
  </div><!--fin de contactos-->
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		
<?php include_once('layouts/footer.php'); ?>
