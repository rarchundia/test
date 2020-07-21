<?php
  $page_title = 'Agregar usuarios';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $groups = find_all('user_groups');
?>
<?php
  if(isset($_POST['add_user'])){

   $req_fields = array('full-name','username','password','correo','level' );
   validate_fields($req_fields);

   if(empty($errors)){
           $name   = remove_junk($db->escape($_POST['full-name']));
       $username   = remove_junk($db->escape($_POST['username']));
       $password1   = remove_junk($db->escape($_POST['password']));
	    $correo   = remove_junk($db->escape($_POST['correo']));
	   
       $user_level = (int)$db->escape($_POST['level']);
       $password = sha1($password1);
        $query = "INSERT INTO users (";
        $query .="name,username,password,user_level,status,email";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$username}', '{$password}', '{$user_level}','1', '{$correo}'";
        $query .=")";
        if($db->query($query)){
          //sucess
			
			
			$destinatario = $correo; 
$asunto = "Notificacion"; 
$cuerpo = ' 
<!DOCTYPE html>
  <html lang="es">
    <head>
    <meta charset="UTF-8">

<title>Notificacion de Cuenta Creada</title>
 </head>
<body> 
<center><img src="http://envipaq.com.mx/images/logo.jpg" height="170">
<h1>Envipaq Notificaciones</h1> </center>
<p> 
<b>Buen dia, nos complace informarte que se ha creado una cuenta en el sistema control interno de Envipaq puedes ingresar en la siguiente liga con los datos abajo proporcionados <a href="http://sci.envipaq.com.mx/login" >Ingresar</a> </p> </b><br>
user: '.$username.'<br>pass: '.$password1.'<br>
<img src="http://sci.envipaq.com.mx/login/uploads/medio_ambiente.jpg"  width="100%">

';







 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Notificaciones Envipaq <notificaciones@envipaq.com.mx>\r\n"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente 
//$headers .= "Reply-To: rarchundia@envipaq.com.mx\r\n"; 

//ruta del mensaje desde origen a destino 
$headers .= "Return-path: rarchundia@envipaq.com.mx\r\n";


//direcciones que recibián copia 
//$headers .= "Cc: rarchundia@envipaq.com.mx\r\n"; 

//direcciones que recibirán copia oculta 
$headers .= "Bcc: rarchundia@envipaq.com.mx\r\n"; 


$envio= mail($destinatario,$asunto,$cuerpo,$headers);
			
			
			
          $session->msg('s'," Cuenta de Usuario Creada");
			
          redirect('add_user.php', false);
        } else {
          //failed
          $session->msg('d',' No se Pudo Crear la Cuenta.');
          redirect('add_user.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_user.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
  <?php echo display_msg($msg); ?>
  <div class="row">
    <div class="panel panel-default">
		
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-user"></span>
          <span>Agregar usuario</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <form method="post" action="add_user.php">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="full-name" id="full-name" placeholder="Nombre completo" required autofocus onkeyup="mayus(this);" title="Introduce Nombre Completo" data-toggle="tooltip">
            </div>
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" class="form-control" name="username" placeholder="Nombre de Usuario" required title="Usuario para Ingresar al Sistema" data-toggle="tooltip">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name ="password" id="password" required  placeholder="Contraseña">
            </div>
			  <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" class="form-control" name ="correo" id="correo"  required placeholder="E-Mail">
            </div>
            <div class="form-group">
              <label for="level">Rol de usuario</label>
                <select class="form-control" name="level">
                  <?php foreach ($groups as $group ):?>
                   <option value="<?php echo $group['group_level'];?>"><?php echo ucwords($group['group_name']);?></option>
                <?php endforeach;?>
                </select>
            </div>
            <div class="form-group clearfix">
              <button type="submit" name="add_user" class="btn btn-primary pull-right">Guardar</button>
            </div>
        </form>
        </div>

		  
		  
		  
		   <div class="col-md-6">
			
			   
			   
		<script>

function validaForm(){
  var errores = "";
  var respuesta = true;
 
  if( !$("input[name|='caracteres[]']").is(':checked') ){
    respuesta = false;
    errores += "Checbox: Debes seleccionar al menos una opcion \\n" ;
  }
  var numcaracteres = $("#numcaracteres").attr('value');
 
  if( numcaracteres == '' || ( numcaracteres < 6 || numcaracteres > 16 ) ){
    respuesta = false;
    errores += "Los caracteres para la contraseña deben estar entre 6 y 16";
  }
 
  return '{"valor": ' + respuesta + ', "mensaje": "' + errores + '"}';
}
</script>
</head>


<h2> <center>Generador de Contraseñas</center> </h2>
<form id="frmPasswords">
   Selecciona los caracteres que quieres utilizar <br/>
	<div class="form-check form-check-inline">
		
   <input type="checkbox" name="caracteres[]" value="mayusculas" /> A-Z<br/>
   </div>
		<div class="form-check form-check-inline">
		<input type="checkbox" name="caracteres[]" value="minusculas" /> a-z<br/>
   
		</div>	
			<div class="form-check form-check-inline">
				<input type="checkbox" name="caracteres[]" value="numeros" /> 0-9<br/>
  </div>
				<div class="form-check form-check-inline">
					
				<input type="checkbox" name="caracteres[]" value="c_especiales" /> ?!*-_.%$/<br/>
		
	</div>
	<br>
	<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Num de caracteres:</label>
	 <div class="col-sm-10">
  <input type="number" name="numcaracteres" placeholder="6"  id="numcaracteres" size="2" title="Min 6 Max 99 Caracteres" data-toggle="tooltip" />   <input type="button" name="btnGenerar" id="btnGenerar"  class="btn btn-primary" value="Generar" />
	 </div>
  </div>
	
		
  
</form><br><br>
		  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Contraseña:</label>
	 <div class="col-sm-10">

<input type="text" name="txtPassword" id="txtPassword" value=""/> <button id="copiar" class="btn btn-primary"> Asignar Pass</button>
 </div>
  </div>
	
<script type="text/javascript">
$(document).ready(function(){
  $("#btnGenerar").click(function(){
    respuesta = validaForm();
    respuesta = jQuery.parseJSON(respuesta);
    if( respuesta.valor == true ){
      $.ajax({
        url: "password.php",
        type: "POST",
        data: $("#frmPasswords").serialize(),
        dataType: "html",
        success: function(password) {
          $("#txtPassword").attr('value',password);
        }
      });
    }
    else
      alert(respuesta.mensaje);
  });
});
	
	
	
	
	$("#copiar").click(function () {
	var passs=$("#txtPassword").val();
		$("#password").val(passs);
		//saco el valor accediendo al class del input = nombre   
	});
	
	
	
</script>	   
			   
			   
			   
			   
			   
			   
		 </div>
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
      </div>

    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
