<?php
  $page_title = 'Editar producto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
 $empresa = find_all('categories');
$product = find_by_id('responsable',(int)$_GET['id']);
$all_categories = find_all('categories');
$all_photo = find_all('media');
if(!$product){
  $session->msg("d","Usuario  No Encontrado.");
  redirect('add_usuario.php');
}
?>
<?php
 if(isset($_POST['product'])){
   $req_field = array('nombre', 'ape_pat', 'ape_mat', 'product-categorie');
    validate_fields($req_fields);

   if(empty($errors)){
      $p_nombre= remove_junk($db->escape($_POST['nombre']));
	 $p_paterno = remove_junk($db->escape($_POST['ape_pat']));
     $p_materno   = remove_junk($db->escape($_POST['ape_mat']));
      $p_cat   = (int)$_POST['product-categorie'];
       
       $query   = "UPDATE responsable SET";
       $query  .=" nombre ='{$p_nombre}', ape_pat ='{$p_paterno}',";
       $query  .=" ape_mat ='{$p_materno}', id_empresa ='{$p_cat}'";
       $query  .=" WHERE id ='{$product['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Producto ha sido actualizado. ");
                 redirect('add_usuario.php', false);
               } else {
                 $session->msg('d',' Lo siento, Actualización Falló.');
                 redirect('edit_usuario.php?id='.$product['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_usuario.php?id='.$product['id'], false);
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
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Editar
             <?php echo remove_junk(ucfirst($product['nombre'])); echo " ";
			 echo remove_junk(ucfirst($product['ape_pat']));?></span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="edit_usuario.php?id=<?php echo (int)$product['id'] ?>">
               <div class="form-group">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre(s)" value="<?php echo remove_junk(ucfirst($product['nombre']));?>" required onkeyup="mayus(this);">
            </div>
            
            
            <div class="form-group">
                <input type="text" class="form-control" name="ape_pat" placeholder="Apellido Paterno" value="<?php echo remove_junk(ucfirst($product['ape_pat']));?>"required onkeyup="mayus(this);">
            </div>
            
            <div class="form-group">
                <input type="text" class="form-control" name="ape_mat" placeholder="Apellido Materno" value="<?php echo remove_junk(ucfirst($product['ape_mat']));?>"required onkeyup="mayus(this);">
            </div>
            
                
                  <div class="col-md-6">
                    <select class="form-control" name="product-categorie" required>
                      <option value="">Pertenece a:</option>
                    <?php  foreach ($empresa as $emp): ?>
                      <option value="<?php echo (int)$emp['id'] ?>">
                        <?php echo $emp['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
              <button type="submit" name="product" class="btn btn-danger">Actualizar</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
