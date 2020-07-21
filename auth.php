<?php 

  include_once('includes/load.php');
  require_once ('mobile/Mobile_Detect.php');
  $detect = new Mobile_Detect();
  
	  
	   ?>
<?php
$req_fields = array('username','password' );
validate_fields($req_fields);
$username = remove_junk($_POST['username']);//recibe el username del formulario
$password = remove_junk($_POST['password']);//recibe el password del formulario

if(empty($errors)){
  $user_id = authenticate($username, $password);
  if($user_id){
    //crea la sesion con el id del usuario
     $session->login($user_id);
    //actualiza la ultima fecha de ingreso al portal
     updateLastLogIn($user_id);
	 
	 
	 
  if ($detect->isMobile()==false) { 
  $session->msg("s", "<a href=\"http://johnpapa.net\" target=\"_blank\">This is a hyperlink</a>");
     redirect('home.php',false);

  }
  else{
	
$session->msg("s", "Bienvenido!! Constantemente Se Agregan Nuevas Mejoras Y Modulos.");
     redirect('home.php',false);
    
	  }
	 
     
  } else {
    $session->msg("d", "<a href=\"http://johnpapa.net\" target=\"_blank\">This is a hyperlink</a>");
    echo '<meta http-equiv="Refresh" content="0; url=index.php">';
	
	  // redirect('index.php',false);
  }

} else {
   $session->msg("d", $errors);
   redirect('index.php',false);
}

?>
