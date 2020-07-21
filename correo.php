<?php
  $page_title = 'Correo';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(3);
  ?>

<?php
if(isset($_POST['add_equipo'])){
 

 $p_medida= remove_junk($db->escape($_POST['medida']));
  $p_paqueteria = remove_junk($db->escape($_POST['paqueteria']));
 $p_notas = remove_junk($db->escape($_POST['notas']));
	
	
  $p_cp_des = remove_junk($db->escape($_POST['cp_des']));
   $req_fields = array('direccion','colonia','cp','paquetes','alto','ancho','largo','nombre','empresa','telefono','fecha','correo');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_direccion = remove_junk($db->escape($_POST['direccion']));
	 
	 $p_colonia  = remove_junk($db->escape($_POST['colonia']));
	 $p_cp  = remove_junk($db->escape($_POST['cp']));
	 $p_paquetes  = remove_junk($db->escape($_POST['paquetes']));
	 $p_alto  = remove_junk($db->escape($_POST['alto']));
	 $p_ancho  = remove_junk($db->escape($_POST['ancho']));
	 $p_largo  = remove_junk($db->escape($_POST['largo']));
	 $p_nombre  = remove_junk($db->escape($_POST['nombre']));
	 $p_correo  = remove_junk($db->escape($_POST['correo']));
	 $p_empresa  = remove_junk($db->escape($_POST['empresa']));
	 $p_peso= remove_junk($db->escape($_POST['peso']));
	 $p_telefono  = remove_junk($db->escape($_POST['telefono']));
	 $p_delegacion= remove_junk($db->escape($_POST['delegacion']));
	 $p_fecha  = remove_junk($db->escape($_POST['fecha']));
	
	
	 
	 
     $date    = make_date();
     $query  = "INSERT INTO recolecta (";
     $query .=" direccion, colonia, delegacion, cp, totalp, alto, ancho, largo, peso, nombre, id_empresa, fechaprogramar, fechasolicitud, notas, medida, telefono,correo,cp_des, paqueteria";
     $query .=") VALUES (";
     $query .="'{$p_direccion}','{$p_colonia}','{$p_delegacion}','{$p_cp}','{$p_paquetes}','{$p_alto}','{$p_ancho}','{$p_largo}','{$p_peso}','{$p_nombre}','{$p_empresa}','{$p_fecha}','{$date}','{$p_notas}','{$p_medida}','{$p_telefono}','{$p_correo}','{$p_cp_des}','{$p_paqueteria}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){       

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
<img src="http://envipaq.com.mx/images/logo.jpg" height="180">
<center><h1>Envipaq Recoleccion</h1> </center>
<p> 
<b>Buen dia hemos recibido su solicitud de recoleccion ';
$cuerpo .= $p_nombre;
$cuerpo .= ' en la calle ';
$cuerpo .= $p_direccion;
$cuerpo .=' en la colonia ';
$cuerpo .= $p_colonia;
$cuerpo .=' de la delegacion ' ;
$cuerpo .=	 $p_delegacion;
$cuerpo .=' por un total de: ';
$cuerpo .=$p_paquetes;
$cuerpo .=' paquetes <br><br> Estamos verificando su solicitud, en un momento mas nos pondremos en contacto con usted.<br><br> <p align="right"> Sin mas por el momento que tenga un excelente dia. </p>






</p> 

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


$envio= mail($destinatario,$asunto,$cuerpo,$headers);
if($envio){
	
	echo '<meta http-equiv="Refresh" content="2; url=../index.php">
	
	
	<center><h1><strong><br><br><br><img src="http://envipaq.com.mx/images/logo.jpg" height="220"><br><br>Solicitud Ingresada Correctamente</strong></h2></center>
	
	';
	
	}else{
		
    echo '<meta http-equiv="Refresh" content="3; url=../index.php">
	
	<center><h1><strong><br><br><br><img src="http://envipaq.com.mx/images/logo.jpg" height="220"><br><br>Fallo al Ingresar la Solicitud Intenta Otra Vez</strong></h2></center>';
}
	 }
	    

 }}

 

?>
