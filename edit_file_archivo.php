<?php
  $page_title = 'Editar Archivo';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
?>
<?php
  $e_user = find_by_id('file',(int)$_GET['id']);
  $groups  = find_all('user_groups');
  if(!$e_user){
    $session->msg("d","El Usuario No Se Encuentra En El Sistema.");
   echo '<meta http-equiv="Refresh" content="0; url=users.php">'; //redirect('users.php');
  }
?>

<?php
//Update User basic info
  if(isset($_POST['update'])) {
    if(empty($errors)){
             $id = (int)$e_user['id'];
         //  $name = remove_junk($db->escape($_POST['name']));
       $descripcion = remove_junk($db->escape($_POST['descripcion']));
            $sql = "UPDATE file SET description ='{$descripcion}' WHERE id='{$db->escape($id)}'";
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Actualizado con Exito ");
           echo '<meta http-equiv="Refresh" content="0; url=archivos.php">';
			  //redirect('edit_user.php?id='.(int)$e_user['id'], false);
          } else {
            $session->msg('d',' Lo siento no se actualizarón los datos.');
           echo '<meta http-equiv="Refresh" content="0; url=archivos.php">';			  //redirect('edit_user.php?id='.(int)$e_user['id'], false);
          }
    } else {
      $session->msg("d", $errors);
           echo '<meta http-equiv="Refresh" content="0; url=archivos.php">';
		//redirect('edit_user.php?id='.(int)$e_user['id'],false);
    }
  }
?>
<?php
// Update user password
if(isset($_POST['update-pass'])) {
 
	
	$req_fields = array('password');
  validate_fields($req_fields);
  if(empty($errors)){
           $id = (int)$e_user['id'];
     $password = remove_junk($db->escape($_POST['password']));
     $h_pass   = sha1($password);
          $sql = "UPDATE users SET password='{$h_pass}' WHERE id='{$db->escape($id)}'";
       $result = $db->query($sql);
        if($result && $db->affected_rows() === 1){
          $session->msg('s',"Se ha actualizado la contraseña del usuario. ");
          echo '<meta http-equiv="Refresh" content="0; url=edit_user.php?id='.(int)$e_user['id'].'">';
			//redirect('edit_user.php?id='.(int)$e_user['id'], false);
        } else {
          $session->msg('d','No se pudo actualizar la contraseña de usuario..');
          echo '<meta http-equiv="Refresh" content="0; url=edit_user.php?id='.(int)$e_user['id'].'">';
			//redirect('edit_user.php?id='.(int)$e_user['id'], false);
        }
  } else {
    $session->msg("d", $errors);
    redirect('edit_user.php?id='.(int)$e_user['id'],false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-6">
     <div class="panel panel-default">
       <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-pencil"></span>
          Actualiza <?php $file_name=$e_user['filename']; echo substr($file_name, 19); ?>
        </strong>
       </div>
       <div class="panel-body">
          <form method="post" action="edit_file_archivo.php?id=<?php echo (int)$e_user['id'];?>" class="clearfix">
           <!-- <div class="form-group">
                  <label for="name" class="control-label">Nombre</label>
                  <input type="name" class="form-control" onkeyup="mayus(this);" name="name" value="<?php echo remove_junk(ucwords($e_user['filename'])); ?>">
            </div>-->
            <div class="form-group">
                  <label for="username" class="control-label">Descripción</label>
                  <input type="text" class="form-control" name="descripcion"  onkeyup="mayus(this);" value="<?php echo remove_junk(ucwords($e_user['description'])); ?>">
            </div>
            <div class="form-group clearfix">
                    <button type="submit" name="update" class="btn btn-info pull-right">Actualizar</button>
            </div>
        </form>
       </div>
     </div>
  </div>
  <!-- Change password form -->
  
 </div>
<?php include_once('layouts/footer.php'); ?>
