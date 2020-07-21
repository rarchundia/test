<?php 

/*
$usuario = "root";
	$password = "";
	$servidor = "localhost";
	$basededatos = "recoleccion";
	
	
$usuario = "envipaq_inven";
	$password = "3nvip4q2018";
	$servidor = "localhost";
	$basededatos = "envipaq_recoleccion";


*/
require_once('includes/load.php');
include_once('layouts/header.php');



$usuario = "root";
	$password = "";
	$servidor = "localhost";
	$basededatos = "recoleccion";

	$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
	
	$db = mysqli_select_db( $conexion, $basededatos ) or die ( "No se Puede establecer conexion con la base de datos" );
	



?>



<?php   
///funcion de envio de correo

function envia_correo_deplantilla($tipo_documento)
{
   
	$tipo=$tipo_documento;
	$destinatario = "dtapia@envipaq.com.mx ";//dtapia@envipaq.com.mx
$asunto = "Carga de archivo"; 
$cuerpo = ' 
<!doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Alertas Envipaq</title>
   

    <style type="text/css">
html,  body {
	margin: 0 !important;
	padding: 0 !important;
	height: 100% !important;
	width: 100% !important;
}
* {
	-ms-text-size-adjust: 100%;
	-webkit-text-size-adjust: 100%;
}
.ExternalClass {
	width: 100%;
}
div[style*="margin: 16px 0"] {
	margin: 0 !important;
}
table,  td {
	mso-table-lspace: 0pt !important;
	mso-table-rspace: 0pt !important;
}
table {
	border-spacing: 0 !important;
	border-collapse: collapse !important;
	table-layout: fixed !important;
	margin: 0 auto !important;
}
table table table {
	table-layout: auto;
}
img {
	-ms-interpolation-mode: bicubic;
}
.yshortcuts a {
	border-bottom: none !important;
}
a[x-apple-data-detectors] {
	color: inherit !important;
}
</style>

    <style type="text/css">
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td:hover,
        .button-a:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

    
        @media screen and (max-width: 600px) {

            .email-container {
                width: 100% !important;
            }

            
            .fluid,
            .fluid-centered {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
           
            .fluid-centered {
                margin-left: auto !important;
                margin-right: auto !important;
            }

           
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
        
            .stack-column-center {
                text-align: center !important;
            }
        
           
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }
                
        }

    </style>
    </head>
    <body bgcolor="#e0e0e0" width="100%" style="margin: 0;" yahoo="yahoo">
    <table bgcolor="#e0e0e0" cellpadding="0" cellspacing="0" border="0" height="100%" width="100%" style="border-collapse:collapse;">
      <tr>
        <td><center style="width: 100%;">
            
            <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;"> '.$tipo.' </div>
            <table align="center" width="600" class="email-container">
            <tr>
                <td style="padding: 20px 0; text-align: right"><img src="http://sci.envipaq.com.mx/login/libs/images/logos/iconos_envipaq.png" width="200" height="50" alt="alt_text" border="0"></td>
              </tr>
          </table>
            <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="600" class="email-container">
            
            <tr>
                <td class="full-width-image" style="text-align:center;"><img src="http://envipaq.com.mx/images/logo.jpg" width="300" alt="alt_text" border="0" align="center" style="width: 40%; max-width: 170px; height: auto;"></td>
              </tr>
            <tr>
                <td style="padding: 40px; text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;"><h3> Aviso de Carga de Archivo '.$tipo.' </h3><br>
                <br>
                
                
                <table cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
                    <tr>
                    <td style="border-radius: 3px; background: #F93A3D; text-align: center;" class="button-td"><a href="http://sci.envipaq.com.mx/login/valida.php" style="background: #F93A3D; border: 15px solid #F93A3D; padding: 0 10px;color: #ffffff; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a"> 
                      <!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;<![endif]-->Ver Archivos<!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;<![endif]--> 
                      </a></td>
                  </tr>
                  </table>
                
              </td>
              </tr>
            <tr>
                <td bgcolor="#222222" valign="middle" style="text-align: center; background-position: center center !important; background-size: cover !important;"><!--[if gte mso 9]>
                    <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:175px; background-position: center center !important;">
                    <v:fill type="tile" src="assets/Responsive/Image_600x230.png" color="#222222" />
                    <v:textbox inset="0,0,0,0">
                    <![endif]-->
                
                <div>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td valign="middle" style="text-align: center; padding: 40px; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #ffffff;"> Ahorra papel antes de imprimir, piensa en tu responsabilidad con el medio ambiente.</td>
                      </tr>
                  </table>
                  </div>
                
                <!--[if gte mso 9]>
                    </v:textbox>
                    </v:rect>
                    <![endif]--></td>
              </tr>
            <tr>
                <td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; mso-height-rule: exactly; line-height:18px; text-align: center; color: #000000;"><webversion style="color:#cccccc; text-decoration:underline; font-weight: bold;"></webversion>
                <br>
                <br>
                Envipaq Logistics SA de CV. <br>
                <span class="mobile-link--footer">Rumania 507, col portales Norte<br>Del. Benito Ju&aacute;rez, CDMX</span> <br>
                <br>
                </td>
              </tr>
                  </table></td>
              </tr>
              
          </table>
             <table align="center" width="600" class="email-container">
            
          </table>
             
          </center></td>
      </tr>
    </table>
</body>
</html>
'; 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Avisos Envipaq <avisos@envipaq.com.mx>\r\n"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente 
//$headers .= "Reply-To: rarchundia@envipaq.com.mx\r\n"; 

//ruta del mensaje desde origen a destino 
$headers .= "Return-path: rarchundia@envipaq.com.mx\r\n";


//direcciones que recibián copia 
//$headers .= "Cc: ".$correo."\r\n";  

//direcciones que recibirán copia oculta 
$headers .= "Bcc: rarchundia@envipaq.com.mx\r\n"; 


$envio= mail($destinatario,$asunto,$cuerpo,$headers);
	
	
}
	


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function envia_correo_usuario($tipo_documento,$correo)
{
   
	$tipo=$tipo_documento;
	$destinatario = $correo;//dtapia@envipaq.com.mx
$asunto = "Carga de archivo"; 
$cuerpo = ' 
<!doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Alertas Envipaq</title>
   

    <style type="text/css">
html,  body {
	margin: 0 !important;
	padding: 0 !important;
	height: 100% !important;
	width: 100% !important;
}
* {
	-ms-text-size-adjust: 100%;
	-webkit-text-size-adjust: 100%;
}
.ExternalClass {
	width: 100%;
}
div[style*="margin: 16px 0"] {
	margin: 0 !important;
}
table,  td {
	mso-table-lspace: 0pt !important;
	mso-table-rspace: 0pt !important;
}
table {
	border-spacing: 0 !important;
	border-collapse: collapse !important;
	table-layout: fixed !important;
	margin: 0 auto !important;
}
table table table {
	table-layout: auto;
}
img {
	-ms-interpolation-mode: bicubic;
}
.yshortcuts a {
	border-bottom: none !important;
}
a[x-apple-data-detectors] {
	color: inherit !important;
}
</style>

    <style type="text/css">
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td:hover,
        .button-a:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

    
        @media screen and (max-width: 600px) {

            .email-container {
                width: 100% !important;
            }

            
            .fluid,
            .fluid-centered {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
           
            .fluid-centered {
                margin-left: auto !important;
                margin-right: auto !important;
            }

           
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
        
            .stack-column-center {
                text-align: center !important;
            }
        
           
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }
                
        }

    </style>
    </head>
    <body bgcolor="#e0e0e0" width="100%" style="margin: 0;" yahoo="yahoo">
    <table bgcolor="#e0e0e0" cellpadding="0" cellspacing="0" border="0" height="100%" width="100%" style="border-collapse:collapse;">
      <tr>
        <td><center style="width: 100%;">
            
            <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;"> '.$tipo.' </div>
            <table align="center" width="600" class="email-container">
            <tr>
                <td style="padding: 20px 0; text-align: right"><img src="http://sci.envipaq.com.mx/login/libs/images/logos/iconos_envipaq.png" width="200" height="50" alt="alt_text" border="0"></td>
              </tr>
          </table>
            <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="600" class="email-container">
            
            <tr>
                <td class="full-width-image" style="text-align:center;"><img src="http://envipaq.com.mx/images/logo.jpg" width="300" alt="alt_text" border="0" align="center" style="width: 40%; max-width: 170px; height: auto;"></td>
              </tr>
            <tr>
                <td style="padding: 40px; text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;"><h3> Aviso de Carga de Archivo '.$tipo.' </h3><br>
                <br>
                
                
                
                
              </td>
              </tr>
            <tr>
                <td bgcolor="#222222" valign="middle" style="text-align: center; background-position: center center !important; background-size: cover !important;"><!--[if gte mso 9]>
                    <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:175px; background-position: center center !important;">
                    <v:fill type="tile" src="assets/Responsive/Image_600x230.png" color="#222222" />
                    <v:textbox inset="0,0,0,0">
                    <![endif]-->
                
                <div>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td valign="middle" style="text-align: center; padding: 40px; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #ffffff;"> Ahorra papel antes de imprimir, piensa en tu responsabilidad con el medio ambiente.</td>
                      </tr>
                  </table>
                  </div>
                
                <!--[if gte mso 9]>
                    </v:textbox>
                    </v:rect>
                    <![endif]--></td>
              </tr>
            <tr>
                <td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; mso-height-rule: exactly; line-height:18px; text-align: center; color: #000000;"><webversion style="color:#cccccc; text-decoration:underline; font-weight: bold;"></webversion>
                <br>
                <br>
                Envipaq Logistics SA de CV. <br>
                <span class="mobile-link--footer">Rumania 507, col portales Norte<br>Del. Benito Ju&aacute;rez, CDMX</span> <br>
                <br>
                </td>
              </tr>
                  </table></td>
              </tr>
              
          </table>
             <table align="center" width="600" class="email-container">
            
          </table>
             
          </center></td>
      </tr>
    </table>
</body>
</html>
'; 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Avisos Envipaq <avisos@envipaq.com.mx>\r\n"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente 
//$headers .= "Reply-To: rarchundia@envipaq.com.mx\r\n"; 

//ruta del mensaje desde origen a destino 
$headers .= "Return-path: rarchundia@envipaq.com.mx\r\n";


//direcciones que recibián copia 
//$headers .= "Cc: ".$correo."\r\n";  

//direcciones que recibirán copia oculta 
$headers .= "Bcc: rarchundia@envipaq.com.mx\r\n"; 


$envio= mail($destinatario,$asunto,$cuerpo,$headers);
	
	
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//fin de envio de correos


///if(isset($_POST["empresa"])){///acta costitutiva
/*$empresa=$_POST["empresa"];
	
	if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	
$uploaddir = "archivos/{$empresa}";
$uploadfile = $uploaddir . basename($_FILES['file']['name']);


if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
	$date    = make_date();
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, acta_constitutiva=1, fecha_acta='{$date}', ruta_acta='{$uploadfile}' WHERE id='{$empresa}'";
   
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	
    
} else{
	
	$sql   = " UPDATE contacto SET ganado_perdido=3 WHERE id='{$empresa}'";
   
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	
	
}*/
//}//fin acta



if(isset($_POST["empresa1"] )){  //rfc
$empresa=$_POST["empresa1"];
	$correo=$_POST["correo"];
	
	
	
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/$date    = make_date();
	
$uploaddir = "archivos";
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$uploadfile"."$date".".pdf";
	//move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir);
					   

//rename("archivos/$uploadfile","archivos/$nombre_actual");
	rename($_FILES['file']['tmp_name'],"archivos/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, rfc=1, fecha_rfc='{$date}', ruta_rfc='{$nombre_actual}' WHERE id='{$empresa}'";
   
  
	$tipo_documento=" RFC ";

	envia_correo_deplantilla($tipo_documento);
	envia_correo_usuario($tipo_documento,$correo);
	$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	
    
//} 
}//rfc


if(isset($_POST["empresa2"] )){  //situacion fiscal
$empresa=$_POST["empresa2"];
	$correo=$_POST["correo"];
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/$date    = make_date();
	
$uploaddir = "archivos";
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$uploadfile"."$date".".pdf";

rename($_FILES['file']['tmp_name'],"archivos/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, sit_fiscar=1, fecha_fiscal='{$date}', ruta_fiscal='{$nombre_actual}' WHERE id='{$empresa}'";
   
  
$tipo_documento=" Situacion Fiscal ";
envia_correo_deplantilla($tipo_documento);
	envia_correo_usuario($tipo_documento,$correo);
	
	
	
	
	
	$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	
    
//} 
}

if(isset($_POST["empresa3"] )){  //opinion de cumplimientol
$empresa=$_POST["empresa3"];
	$correo=$_POST["correo"];
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/$date    = make_date();
	
$uploaddir = "archivos";
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$uploadfile"."$date".".pdf";

rename($_FILES['file']['tmp_name'],"archivos/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, cumplimiento=1, fecha_cumplimiento='{$date}', ruta_cumplimiento='{$nombre_actual}' WHERE id='{$empresa}'";
   
  $tipo_documento=" Opinion de Cumplimiento ";
	envia_correo_deplantilla($tipo_documento);
	envia_correo_usuario($tipo_documento,$correo);
	
	$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	
    
//} 
}//opinion de cumplimientol


/*if(isset($_POST["empresa3"] )){  //opinion de cumplimientol
$empresa=$_POST["empresa3"];
	
	if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	
$uploaddir = "archivos/{$empresa}";
$uploadfile = $uploaddir . basename($_FILES['file']['name']);


if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
	$date    = make_date();
	
 $sql   = " UPDATE contacto SET cumplimiento=1, fecha_cumplimiento='{$date}', ruta_cumplimiento='{$uploadfile}' WHERE id='{$empresa}'";
   
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	
    
} 
}//fin opinion de cumplimiento
*/

if(isset($_POST["empresa4"] )){  //identificacion oficial
$empresa=$_POST["empresa4"];
$correo=$_POST["correo"];	
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/$date    = make_date();
	
$uploaddir = "archivos";
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$uploadfile"."$date".".pdf";

rename($_FILES['file']['tmp_name'],"archivos/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, identificacion=1, fecha_identificacion='{$date}', ruta_identificacion='{$nombre_actual}' WHERE id='{$empresa}'";
   
 $tipo_documento=" Identificacion Oficial ";
	envia_correo_deplantilla($tipo_documento);
	envia_correo_usuario($tipo_documento,$correo);
	$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	
    
//} 
}//identificacion oficial/*
/*if(isset($_POST["empresa4"] )){  //identificacion oficial
$empresa=$_POST["empresa4"];
	
	if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	
$uploaddir = "archivos/{$empresa}";
$uploadfile = $uploaddir . basename($_FILES['file']['name']);


if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
	$date    = make_date();
	
 $sql   = " UPDATE contacto SET identificacion=1, fecha_identificacion='{$date}', ruta_identificacion='{$uploadfile}' WHERE id='{$empresa}'";
   
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	
    
} 
}//fin id oficial*/


if(isset($_POST["empresa5"] )){  //compro domicilio
$empresa=$_POST["empresa5"];
	$correo=$_POST["correo"];
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/$date    = make_date();
	
$uploaddir = "archivos";
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$uploadfile"."$date".".pdf";

rename($_FILES['file']['tmp_name'],"archivos/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, comp_domicilio=1, fecha_comprobante='{$date}', ruta_comprobante='{$nombre_actual}' WHERE id='{$empresa}'";
 
	$tipo_documento=" Comprobante de Domicilio ";
	envia_correo_deplantilla($tipo_documento);
	envia_correo_usuario($tipo_documento,$correo);
	
	
	$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	
    
//} 
}//compro domicilio


/*if(isset($_POST["empresa5"] )){  //compro domicilio
$empresa=$_POST["empresa5"];
	
	if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	
$uploaddir = "archivos/{$empresa}";
$uploadfile = $uploaddir . basename($_FILES['file']['name']);


if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
	$date    = make_date();
	
 $sql   = " UPDATE contacto SET comp_domicilio=1, fecha_comprobante='{$date}', ruta_comprobante='{$uploadfile}' WHERE id='{$empresa}'";
   
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	
    
} 
}*///comp de domicilio


    
	
	
	if(isset($_POST["empresa6"] )){  //estado de cuenta
$empresa=$_POST["empresa6"];
	$correo=$_POST["correo"];
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/$date    = make_date();
	
$uploaddir = "archivos";
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$uploadfile"."$date".".pdf";

rename($_FILES['file']['tmp_name'],"archivos/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, estado_cuenta=1, fecha_cuenta='{$date}', ruta_cuenta='{$nombre_actual}' WHERE id='{$empresa}'";
    
 $tipo_documento=" Estado de Cuenta ";
	envia_correo_deplantilla($tipo_documento);
	envia_correo_usuario($tipo_documento,$correo);	
		
		$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	
	}
		
		
	if(isset($_POST["empresa7"] )){  //alta de envipaq
$empresa=$_POST["empresa7"];
	$correo=$_POST["correo"];
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/$date    = make_date();
	
$uploaddir = "archivos";
		
		if($_FILES['file']['type']=='application/pdf'){
			
			
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$uploadfile"."$date".".pdf";

rename($_FILES['file']['tmp_name'],"archivos/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, alta_envi=1, fecha_alta_envi='{$date}', ruta_alta_envi='{$nombre_actual}' WHERE id='{$empresa}'";
    
  $tipo_documento=" Alta Envipaq ";
	envia_correo_deplantilla($tipo_documento);
	envia_correo_usuario($tipo_documento,$correo);		
			$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
		}///fin archivo pdf
		
	else{
		
	$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$date"."$uploadfile";

rename($_FILES['file']['tmp_name'],"archivos/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, alta_envi_excel=1, fecha_alta_envi_excel='{$date}', ruta_alta_envi_excel='{$nombre_actual}' WHERE id='{$empresa}'";
    
$tipo_documento=" Alta Envipaq Excel ";
	envia_correo_deplantilla($tipo_documento);
	envia_correo_usuario($tipo_documento,$correo);	
		$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
		
		
	}
		
	}
		
		
		
		
		if(isset($_POST["empresa8"] )){  //preanalisis
$empresa=$_POST["empresa8"];
	$correo=$_POST["correo"];
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/$date    = make_date();
	
$uploaddir = "archivos";
	
			if($_FILES['file']['type']=='application/pdf'){
			
			
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$uploadfile"."$date".".pdf";

rename($_FILES['file']['tmp_name'],"archivos/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, preanalisis=1, fecha_preanalisis='{$date}', ruta_preanalisis='{$nombre_actual}' WHERE id='{$empresa}'";
    
  $tipo_documento=" Pre-Analisis ";
	envia_correo_deplantilla($tipo_documento);
	envia_correo_usuario($tipo_documento,$correo);			
				$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
		
}///fin de if pdf
	
			
			
			
			else{//preanalisis excel
			
			
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$date"."$uploadfile";

rename($_FILES['file']['tmp_name'],"archivos/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, preanalisis_excel=1, fecha_preanalisis_excel='{$date}', ruta_preanalisis_excel='{$nombre_actual}' WHERE id='{$empresa}'";
    
 $tipo_documento=" Pre-Analisis Excel ";
	envia_correo_deplantilla($tipo_documento);
	envia_correo_usuario($tipo_documento,$correo);			
				
				$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
		
}///fin de if pdf
			
			
			
			
			
			
			
			
		
//} 
}


if(isset($_POST["empresa9"] )){  //prestacion de servicios
$empresa=$_POST["empresa9"];
$correo=$_POST["correo"];	
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/$date    = make_date();
	
$uploaddir = "archivos";
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$uploadfile"."$date".".pdf";

rename($_FILES['file']['tmp_name'],"archivos/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, presta_serv=1, fecha_presta_serv='{$date}', ruta_presta_serv='{$nombre_actual}' WHERE id='{$empresa}'";
    
  $tipo_documento=" Prestacion de Servicios ";
	envia_correo_deplantilla($tipo_documento);
	envia_correo_usuario($tipo_documento,$correo);
	$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
		
		
		
//} 
}




if(isset($_POST["empresa10"] )){  //Propuesta envipaq
$empresa=$_POST["empresa10"];
	$correo=$_POST["correo"];
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/$date    = make_date();
	
$uploaddir = "archivos";
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$uploadfile"."$date".".pdf";

rename($_FILES['file']['tmp_name'],"archivos/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, propuesta=1, fecha_propuesta='{$date}', ruta_propuesta='{$nombre_actual}' WHERE id='{$empresa}'";
    
 $tipo_documento=" Propuesta Envipaq ";
	envia_correo_deplantilla($tipo_documento);
	envia_correo_usuario($tipo_documento,$correo);
	
	$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
		
		
		
//} 
}





if(isset($_POST["empresa11"] )){  //acta constitutiva
$empresa=$_POST["empresa11"];
$correo=$_POST["correo"];	
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/$date    = make_date();
	
$uploaddir = "archivos";
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$uploadfile"."$date".".pdf";

rename($_FILES['file']['tmp_name'],"archivos/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, acta_constitutiva=1, fecha_acta='{$date}', ruta_acta='{$nombre_actual}' WHERE id='{$empresa}'";
    
  $tipo_documento=" Acta Constitutiva ";
	envia_correo_deplantilla($tipo_documento);
	envia_correo_usuario($tipo_documento,$correo);
	
	$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
		
		
		
//} 
}


if(isset($_POST["empresa12"] )){  //tarifario
$empresa=$_POST["empresa12"];
	$correo=$_POST["correo"];
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/$date    = make_date();
	
$uploaddir = "archivos";
	
	if($_FILES['file']['type']=='application/pdf'){
		
		
		
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$uploadfile"."$date".".pdf";

rename($_FILES['file']['tmp_name'],"archivos/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, tarifario=1, fecha_tarifario='{$date}', ruta_tarifario='{$nombre_actual}' WHERE id='{$empresa}'";
    
  $tipo_documento=" Tarifario PDF ";
	envia_correo_deplantilla($tipo_documento);
	envia_correo_usuario($tipo_documento,$correo);	
		
		$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	}///fin de if pdf
	
			
			
			
			else{//tarifario excel
			
			
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$date"."$uploadfile";

rename($_FILES['file']['tmp_name'],"archivos/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, tarifario_excel=1, fecha_tarifario_excel='{$date}', ruta_tarifario_excel='{$nombre_actual}' WHERE id='{$empresa}'";
    
 $tipo_documento=" Tarifario Excel ";
	envia_correo_deplantilla($tipo_documento);
	envia_correo_usuario($tipo_documento,$correo);			
				
				$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
		
}///fin de if pdf
			
	
		
		
//} 
}////tarifario

///////////////////biis

if(isset($_POST["empresa14"] )){  //archivos de usuario de biis
$empresa=$_POST["empresa14"];
	$correo=$_POST["correo"];
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/$date    = make_date();
	
$uploaddir = "archivos";
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$uploadfile"."$date".".pdf";

rename($_FILES['file']['tmp_name'],"archivos/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE contacto SET ganado_perdido=3, user_biis=1, fecha_biis='{$date}', ruta_biis='{$nombre_actual}' WHERE id='{$empresa}'";
    
 $tipo_documento=" Usuario de Biis ";
	envia_correo_deplantilla($tipo_documento);
	envia_correo_usuario($tipo_documento,$correo);
	
	$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
		
		
		
//} 
}


//////////////////////////////////////










///////////////////princicpio para subir correos

if(isset($_POST["de"] )){  //estado de cuenta

	$de = $_POST['de'];
    $para = $_POST['para'];
	$enviado_hora = $_POST['enviado_hora'];
   
	$sql = "INSERT INTO correos (de, para, enviado_hora) VALUES ( '{$de}', '{$para}', '{$enviado_hora}' )";
   	
	$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
		
		
		
//} 
}


////////////////////////////////////// fin de subir correos



///////////////////cotizacion

if(isset($_POST["id_cotizacion_detalle"] )){  //estado de cuenta
$empresa=$_POST["id_cotizacion_detalle"];
	
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/$date    = make_date();
	
$uploaddir = "archivos_cot";
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$date"."$uploadfile";

rename($_FILES['file']['tmp_name'],"archivos_cot/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE logistica_cot_detalles SET archivo='{$nombre_actual}', fecha_carga='{$date}' WHERE id='{$empresa}'";
    
 
	
	$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
		
		
		
//} 
}


//////////////////////////////////////fin de cotizacion





///////////////////evidencia tickets

if(isset($_POST["ticket_evidencia1"] )){  //tickets evidencia
$empresa=$_POST["ticket_evidencia1"];
	
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/
	$date    = make_date();
	
$uploaddir = "ticket_evidencia";
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$date"."$uploadfile";

rename($_FILES['file']['tmp_name'],"ticket_evidencia/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " UPDATE ticket_detalles SET archivo='{$nombre_actual}', fecha_carga='{$date}' WHERE id='{$empresa}'";
    
 
	
	$resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
		
		
		
//} 
}


//////////////////////////////////////fin de evidencia tickets







/////////////////////////////////////////////////////////////////////////sube archivos


if($_POST["folder_id"]!=0){  //sube archivos facturacion

	$id_user=$_POST["id_user"];
	$folder=$_POST["folder_id"];
	$descripcion=$_POST["descripcion"];
	$alphabeth ="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";
	$code = "";
	for($i=0;$i<12;$i++){
	    $code .= $alphabeth[rand(0,strlen($alphabeth)-1)];
	}

	$code= $code;
	
	
	/*if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	*/$date    = make_date();
	
$uploaddir = "archivos_fact";
	
		
		
		
$uploadfile = $_FILES['file']['name'];
$nombre_actual= "$date"."$uploadfile";

rename($_FILES['file']['tmp_name'],"archivos_fact/$nombre_actual");
	//$uploaddir . basename($_FILES['file']['name']);


//if (
	//move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.$uploadfile);//) {
	
 $sql   = " INSERT INTO file (code, filename, description, is_public, user_id, is_folder, folder_id, created_at) VALUES 
 ('{$code}', '{$nombre_actual}', '{$descripcion}', '0', '{$id_user}', '0', '{$folder}', '{$date}')";
	//(\"$code\",\"$filename\",\"$description\", $is_public, $user_id, 0, $folder_id, NOW());";

 
 
 //UPDATE contacto SET tarifario=1, fecha_tarifario='{$date}', ruta_tarifario='{$nombre_actual}' WHERE id='{$empresa}'";
    
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	
			
	
		
		
//} 
}////sube archivos facturacion
else{
	
	echo "Archivo no Cargado";
	return;
}








//estado de cuenta
/*if(isset($_POST["empresa6"] )){  //estado de cuenta
$empresa=$_POST["empresa6"];
	
	if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
	
$uploaddir = "archivos/{$empresa}";
$uploadfile = $uploaddir . basename($_FILES['file']['name']);


if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
	$date    = make_date();
	
 $sql   = " UPDATE contacto SET estado_cuenta=1, fecha_cuenta='{$date}', ruta_cuenta='{$uploadfile}' WHERE id='{$empresa}'";
   
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	
    
} 
}*///estado de cuenta






/*$ds          = DIRECTORY_SEPARATOR;  //1
if(isset($_POST["empresa"])){
$empresa=$_POST["empresa"];
 



 if (!empty($_FILES)) {
	 if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
 
	 }
      $storeFolder = "archivos/{$empresa}/";   //2
   $tempFile = $_FILES['file']['tmp_name'];          //3             

      

    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4

     

    $targetFile =  $targetPath. $_FILES['file']['name'];  //5

 
echo $targetFile;
    move_uploaded_file($tempFile,$targetFile); //
  $date    = make_date();
	
 $sql   = " UPDATE contacto SET acta_constitutiva=1, fecha_acta='{$date}', ruta_acta='{$targetFile}' WHERE id='{$empresa}'";
   
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
 }



     


	
}*/

/*

$upload_folder ="archivos/3/";

 

$nombre_archivoImage = $_FILES["archivo_contitutiva"]["name"];

 

 

$tipo_archivoImage = $_FILES["archivo_contitutiva"]["type"];

 

$tamano_archivoImage = $_FILES["archivo_contitutiva"]["size"];

 

$tmp_archivoImage = $_FILES["archivo_contitutiva"]["tmp_name"];

 

$nom=$_POST['empresa'];
 

$archivador = $upload_folder . "/" . $nombre_archivoImage;

 

move_uploaded_file($tmp_archivoImage, $archivador);


//$respuesta=$nom.' '.$nombre_archivoImage;

//echo $respuesta; 
*/
?>

 

	








<?php









/*$usuario = "envipaq_inven";
	$password = "3nvip4q2018";
	$servidor = "localhost";
	$basededatos = "envipaq_recoleccion";

require_once('includes/load.php');
include_once('layouts/header.php');


$usuario = "root";
	$password = "";
	$servidor = "localhost";
	$basededatos = "recoleccion";
	$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
	
	$db = mysqli_select_db( $conexion, $basededatos ) or die ( "No se Puede establecer conexion con la base de datos" );
	
?>


<?php   ///acta costitutiva
  /*
$archivo = (isset($_FILES['archivo_const']));

//if(isset($_POST['constitutiva'])){

$empresa=isset($_POST['empresa']);

   if ($archivo) {
	  if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
	  }
      $ruta_destino_archivo = "archivos/{$empresa}/{$archivo['name']}";
      $archivo_ok = move_uploaded_file($archivo['tmp_name'], $ruta_destino_archivo);
   }

echo "archivos/{$empresa}/{$archivo['name']}". " Guardado con Exito!!";
	

		

	$date    = make_date();

	
 $sql   = " UPDATE contacto SET acta_constitutiva=1, fecha_acta='{$date}', ruta_acta='archivos/{$empresa}/{$archivo['name']}' WHERE id='{$empresa}'";
   
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 

	?>


	<?php //rfc
   if(isset($_POST['btn_rfc'])){
$archivo_rfc = (isset($_FILES['rfc'])) ? $_FILES['rfc'] : null;
$empresa1=$_POST['empresar'];

   if ($archivo_rfc) {
	  if (!file_exists("archivos/{$empresa1}")) {
		  mkdir("archivos/{$empresa1}", 0777, true);
	  }
      $ruta_destino_archivo = "archivos/{$empresa1}/{$archivo_rfc['name']}";
      $archivo_ok = move_uploaded_file($archivo_rfc['tmp_name'], $ruta_destino_archivo);
   }

echo "archivos/{$empresa1}/{$archivo_rfc['name']}". " Guardado con Exito!!";
	
	




	$date    = make_date();
	
 $sql   = " UPDATE contacto SET rfc=1, fecha_rfc='{$date}', ruta_acta='archivos/{$empresa1}/{$archivo_rfc['name']}' WHERE id='{$empresa1}'";
   
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	}
	?>









<?php
//}
/*$usuario = "envipaq_inven";
	$password = "3nvip4q2018";
	$servidor = "localhost";
	$basededatos = "envipaq_recoleccion";
	


	$usuario = "root";
	$password = "";
	$servidor = "localhost";
	$basededatos = "recoleccion";
	$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
	
	$db = mysqli_select_db( $conexion, $basededatos ) or die ( "No se Puede establecer conexion con la base de datos" );
	
	


$date    = make_date();
	
 $sql   = " SELECT id,remitente, direccion, colonia, cp, nombre_destinatario, direccion_des, colonia_des, cp_des, telefono_des, correo, fecha, producto ";
 $sql  .= " FROM entrega";
 $sql  .= " WHERE id ='{$id}' LIMIT 1 ";
  
   
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
*/	


/*$usuario = $_POST['usuario'];
    $contra  = $_POST['contrasena'];

    echo "tu usuario es: ".$usuario."</br>"; 
    echo "contraseña es: ".$contra;

*/?>

<?php /*  ///acta costitutiva
 if(isset($_POST['constitutiva'])){ 
	 $empresa  = $_POST['empresa'];
	 
$archivo = (isset($_FILES['archivo'])) ? $_FILES['archivo'] : null;
if ($archivo) {
   $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
   $extension = strtolower($extension);
   $extension_correcta = ($extension == 'pdf');
   if ($extension_correcta) {
     if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
	  }
	   
	   $ruta_destino_archivo = "archivos/{$empresa}/{$archivo['name']}";
      $archivo_ok = move_uploaded_file($archivo['tmp_name'], $ruta_destino_archivo);
   }
	$date    = make_date();
	
 $sql   = " UPDATE contacto SET acta_constitutiva=1, fecha_acta='{$date}', ruta_acta='archivos/{$empresa}/{$archivo['name']}' WHERE id='{$empresa}'";
   
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	
}
 }


	
*/	?>


<?php   ///rfc
 /*if(isset($_POST['rfc'])){ 
	 $empresa  = $_POST['empresa'];
	 
$archivo = (isset($_FILES['archivo'])) ? $_FILES['archivo'] : null;
if ($archivo) {
   $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
   $extension = strtolower($extension);
   $extension_correcta = ($extension == 'pdf');
   if ($extension_correcta) {
     if (!file_exists("archivos/{$empresa}")) {
		  mkdir("archivos/{$empresa}", 0777, true);
	  }
	   
	   $ruta_destino_archivo = "archivos/{$empresa}/{$archivo['name']}";
      $archivo_ok = move_uploaded_file($archivo['tmp_name'], $ruta_destino_archivo);
   }
	$date    = make_date();
	
 $sql   = " UPDATE contacto SET rfc=1, fecha_rfc='{$date}', ruta_rfc='archivos/{$empresa}/{$archivo['name']}' WHERE id='{$empresa}'";
   
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	
}
 }
*/

	
	?>

