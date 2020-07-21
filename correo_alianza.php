<?php
  $page_title = 'Correo Alianza';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(3);
  ?>


<?php
if(isset($_POST['alianza_correo'])){
 
  $alianza= remove_junk($db->escape($_POST['alianza']));
  $id_recoleccion=$_POST['id_recoleccion'];
  $p_correo=$_POST['correo'];
   
    
  if(empty($errors)){
        $sql = "UPDATE recolecta SET alianza='{$alianza}'";
       $sql .= " WHERE id='{$id_recoleccion}'";
     $result = $db->query($sql);
    
		 
$destinatario = $p_correo; 
$asunto = "Solicitud de Recoleccion"; 
$cuerpo = ' 
<!DOCTYPE html>
  <html lang="es">
    <head>
    <meta charset="UTF-8">

<title>Informe de Recoleccion</title>
 </head>
<body> 
<img src="http://www.envipaq.mx/comando/images/logo.jpg" height="120">
<center><h1>Envipaq Recoleccion</h1> </center>
<p> 
<b>Buen dia se ha programado su recoleccion con folio: ';
$cuerpo .= $alianza;
$cuerpo .=' le recordamos que es en un horario abierto.
'; 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Recolecciones Envipaq <recolecciones@envipaq.com.mx>\r\n"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente 
//$headers .= "Reply-To: rarchundia@envipaq.com.mx\r\n"; 

//ruta del mensaje desde origen a destino 
$headers .= "Return-path: recolecciones@envipaq.com.mx\r\n";


//direcciones que recibián copia 
$headers .= "Cc: recolecciones@envipaq.com.mx\r\n"; 

//direcciones que recibirán copia oculta 
//$headers .= "Bcc: rarchundia@envipaq.com.mx\r\n"; 


mail($destinatario,$asunto,$cuerpo,$headers);
 if($envio){
	
	echo '<meta http-equiv="Refresh" content="2; url=alianza.php">
	
	
	<center><h1><strong><br><br><br><img src="http://www.envipaq.mx/comando/images/logo.jpg" height="120"><br><br>Fallo al Ingresar el Folio Intenta Otra Vez</strong></h2></center>
	
	';
	
	}else{
		
    echo '<meta http-equiv="Refresh" content="2; url=alianza.php">
	<center><h1><strong><br><br><br><img src="http://www.envipaq.mx/comando/images/logo.jpg" height="120"><br><br>Folio Ingresado Correctamente</strong></h2></center>
	';
}

 }
  
  
  }

?>
