<?php
  $page_title = 'Primera';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(3);
  ?>

<?php

	if(isset($_POST['primera'])){
    $req_fields = array('id_entrega');
		
		
   validate_fields($req_fields);
		
$p_id_entrega= remove_junk($db->escape($_POST['id_entrega']));
  $p_correo = remove_junk($db->escape($_POST['correo']));
 $p_primera = 1;
  $p_notas = remove_junk($db->escape($_POST['notas']));
   
		
	     if(empty($errors)){

      $date    = make_date();
	   $query   = "UPDATE entrega SET primera='{$p_primera}', primera_fecha='{$date}', notas_entrega='{$p_notas}'";
       $query  .=" WHERE id ='{$p_id_entrega}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
				   
$destinatario = $p_correo; 
$asunto = "Primer Intento de Entrega"; 
$cuerpo = ' 
<!DOCTYPE html>
  <html lang="es">
    <head>
    <meta charset="UTF-8">

<title>Informe de Entrega</title>
 </head>
<body> 
<img src="http://www.envipaq.mx/comando/images/logo.jpg" height="120">
<center><h1>Envipaq Entregas</h1> </center>
<p> 
<b>Buen dia hemos visitado su domicilio ';
				   $cuerpo .=$date;
$cuerpo .= ' pero no lo hemos localizado este es el primer intento de entrega de su paquete. <br><br>El dia de mañana lo intentaremos nuevamente';

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Entregas Envipaq <recolecciones@envipaq.com.mx>\r\n"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente 
//$headers .= "Reply-To: rarchundia@envipaq.com.mx\r\n"; 

//ruta del mensaje desde origen a destino 
$headers .= "Return-path: recolecciones@envipaq.com.mx\r\n";


//direcciones que recibián copia 
$headers .= "Cc: recolecciones@envipaq.com.mx\r\n"; 

//direcciones que recibirán copia oculta 
//$headers .= "Bcc: rarchundia@envipaq.com.mx\r\n"; 


$envio= mail($destinatario,$asunto,$cuerpo,$headers);
if($envio){
	
	echo '<meta http-equiv="Refresh" content="0; url=operador.php"> ';
				   
	}
				
   } else{
       $session->msg("d", $errors);
       redirect('operador.php', false);
   }

 }
	}//fin post      


	
	

?>
