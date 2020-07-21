<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $categorie = find_by_id('responsable',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","ID del Usuario es Desconocido.");
    redirect('add_usuario.php');
  }
?>
<?php
  $delete_id = delete_by_id('responsable',(int)$categorie['id']);
  if($delete_id){
      $session->msg("s","Usuario Eliminado");
      redirect('add_usuario.php');
  } else {
      $session->msg("d","La Eliminación Falló");
      redirect('add_usuario.php');
  }
?>
