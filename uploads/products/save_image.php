<?php
/*$usuario = "root";
	$password = "";
	$servidor = "localhost";
	$basededatos = "recoleccion";*/

$usuario = "envipaq_inven";
	$password = "3nvip4q2018";
	$servidor = "localhost";
	$basededatos = "envipaq_recoleccion";
	
	//$data_uri = "data:image/png;base64,iVBORw0K...";

date_default_timezone_set('America/Mexico_City');
$data_uri = $_POST['image'];
$id_recoleccion=$_GET['id'];
$total=$_GET['t'];
$p_correo=$_GET['correo'];
$id_ruta=$_GET['id_ruta'];
$quienentrega=$_GET['entrega'];


$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
	
	$db = mysqli_select_db( $conexion, $basededatos ) or die ( "No se Puede establecer conexion con la base de datos" );
	 // Checkin What level user has permission to view this page

$encoded_image = explode(",", $data_uri)[1];
$decoded_image = base64_decode($encoded_image);
$date=date('d-m-Y, h.i');
file_put_contents($date.".png", $decoded_image);
	
$sql  = "INSERT INTO media (file_name, file_type, fecha,id_recoleccion) VALUES ('{$date}.png', 'image/png','{$date}','{$id_recoleccion}')";
 
  $resultado =mysqli_query( $conexion, $sql) or die ("Algo ha ido mal en guardar la firma"); 






$destinatario = $p_correo; //principio de correo
$asunto = "Paquetes Recolectados"; 
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
<b>Le infomamos que se han recolectado un total de: ';
$cuerpo .= $total;
$cuerpo .= ' paquetes entregados por: ';
$cuerpo .= $quienentrega;


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
$headers .= "Cc: suministros@envipaq.com.mx\r\n"; 

//direcciones que recibirán copia oculta 
//$headers .= "Bcc: rarchundia@envipaq.com.mx\r\n"; 


$envio= mail($destinatario,$asunto,$cuerpo,$headers);  //fin de correo

if($envio){	
	$muestra ='<meta name="viewport" content="initial-scale=1, width=device-width">
	<center><h1><strong><br><img src="http://www.envipaq.mx/comando/images/logo.jpg" height="120"><br><br>Ingresada Correctamente</strong></h2>
	
	<br><br>
	
	<form method="post" action="../../operador.php" class="clearfix">
	
	<select name="placas" required>
                      <option>CAMIONETA</option>
                      <option value="842YAE">842YAE</option>
                      <option value="640XCK">640XCK</option>
                      <option value="J46AHW">J46AHW</option>
                      <option value="592XLA">592XLA</option>
                      <option value="662YXR">662YXR</option>
                    
                    </select>

<select name="operador" required>
                      <option>OPERADOR</option>
                      <option value="Antonio Zamudio">Antonio Zamudio</option>
                      <option value="Alberto Blanco">Alberto Blanco</option>
                      <option value="Eduardo Ruiz">Eduardo Ruiz</option>
                      <option value="Ivan Blanco">Ivan Blanco</option>
                      <option value="Jorge Ruiz">Jorge Ruiz</option>
                      
                    </select>
<br><br>
	<input type="number" name="odometro" placeholder="Odometro" required>
	<br><input type="hidden" name="id_recoleccion" value="';
	
	$muestra.=$id_recoleccion;
	$muestra.='" >
	<input type="hidden" name="id_ruta" value="';
	$muestra.=$id_ruta;
	$muestra.='" >
	
	
 	
	
	
	<br><br>
	<button type="submit" name="add_odometro" >Ingresar Odometro</button>
	
	</center>
	
	</form>
	';
	echo $muestra;
	}else{
		
    echo '<meta http-equiv="Refresh" content="2; url=../index.php">
	
	<center><h1><strong><br><br><br><img src="http://www.envipaq.mx/comando/images/logo.jpg" height="120"><br><br>Fallo al Mandar Email</strong></h2></center>';
}

?>