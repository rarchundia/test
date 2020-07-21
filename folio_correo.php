<?php
  $page_title = 'Folio';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(3);
  ?>

<?php
if(isset($_POST['envia_folio'])){
 

 
  $p_correo_test = remove_junk($db->escape($_POST['correo_test']));
	
	
   $req_fields = array('id_delfolio','correo_folio');
   validate_fields($req_fields);
   if(empty($errors)){
	   $p_folio= remove_junk($db->escape($_POST['id_delfolio']));
	   $p_correo = remove_junk($db->escape($_POST['correo_folio']));
	   
	   $date    = make_date();
	   
	   
	   
	   
     $query  = "UPDATE incidencias SET envio_correo='{$p_correo_test}', fecha_envio='{$date}' WHERE id_folio='{$p_folio}'";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){       

$destinatario = $p_correo; 
$asunto = "Folio de Incidencia"; 
$cuerpo = ' 
<!DOCTYPE html>
  <html lang="es">
    <head>
    <meta charset="UTF-8">

<title>Folio de Incidencia</title>
 </head>
<body> 
<img src="http://envipaq.com.mx/images/logo.jpg" height="180">
<center><h1>Folio de Incidencia</h1> </center>
<p> 
<b>Buen dia se levanto un reporte de incidencia con numero de Folio:<strong>ENV2019';
$cuerpo .= $p_folio;
$cuerpo .= ' </strong> ';
$cuerpo .=' <br><br> Estamos verificando su solicitud, en un momento mas nos pondremos en contacto con usted.<br><br> <p align="right"> Sin mas por el momento que tenga un excelente dia. </p>






</p> 

'; 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Aclaraciones Envipaq <aclaraciones@envipaq.com.mx>\r\n"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente 
//$headers .= "Reply-To: rarchundia@envipaq.com.mx\r\n"; 

//ruta del mensaje desde origen a destino 
$headers .= "Return-path: aclaraciones@envipaq.com.mx\r\n";


//direcciones que recibián copia 
//$headers .= "Cc: recolecciones@envipaq.com.mx\r\n"; 

//direcciones que recibirán copia oculta 
$headers .= "Bcc: rarchundia@envipaq.com.mx\r\n"; 


$envio= mail($destinatario,$asunto,$cuerpo,$headers);
if($envio){
	
	echo '<meta http-equiv="Refresh" content="1; url=incidencias.php">
	
	
	<center><h1><strong><br><br><br><img src="http://envipaq.com.mx/images/logo.jpg" height="220"><br><br>Folio Enviado Correctamente</strong></h2></center>
	
	';
	

	}else{
		
    echo '<meta http-equiv="Refresh" content="3; url=incidencias.php">
	
	<center><h1><strong><br><br><br><img src="http://envipaq.com.mx/images/logo.jpg" height="220"><br><br>Fallo al Enviar el Folio Intenta Otra Vez</strong></h2></center>';
}
	 }
	    

 }}

 

?>
