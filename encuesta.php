<?php
  $page_title = 'Editar Usuario';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
 $id=$_GET["id"];
?>

<?php

$date    = make_date();

if(isset($_POST['respuestas'])){
 
$p_id_cliente= $_POST['id_cliente'];
$p_1= $_POST['1'];
$p_2= $_POST['2'];
$p_3= $_POST['3'];
$p_4= $_POST['4'];
$p_5= $_POST['5'];
$p_6= $_POST['6'];
$p_7= $_POST['7'];

	
	
	 $query  ="INSERT INTO respuestas (";
     $query .=" id_cliente, p1, p2, p3, p4, p5, p6, p7";
     $query .=") VALUES (";
     $query .="'{$p_id_cliente}','{$p_1}','{$p_2}','{$p_3}','{$p_4}','{$p_5}','{$p_6}','{$p_7}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
	 
		if($db->query($query)){
			$encuesta_update="UPDATE correos_clientes SET fecha_respuesta='{$date}'  WHERE id='{$p_id_cliente}'";
		 $result = $db->query($encuesta_update);
			   if($result && $db->affected_rows() === 1){
			
					echo '<meta http-equiv="Refresh" content="0; url=encuesta1.html">';	 
			   }
			
				 
	 }
	    else {
      
			echo '<script language="javascript">alert("Hubo un error al guardar por intenta nuevamente");</script>';
			
	  echo '<meta http-equiv="Refresh" content="0; url=encuesta.php?id='.(int)$p_id_cliente.'">';
		
		}

  

 }




?>
<!DOCTYPE html>
  <html lang="es"><head>
    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (!empty($page_title))
           echo remove_junk($page_title);
            elseif(!empty($user))
           echo ucfirst($user['name']);
            else echo "SCI";?>
    </title>
	
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
	 <link rel="icon" type="image/png" href="logo_sobre.png"/>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.css" />
      
     
      
      
    <link rel="shortcut icon" href="../libs/images/favicon.ico" type="image/x-icon">

 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>-->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>
     
      
      
<script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.js"></script>

	
	  
<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

	  <link href="emoji/emoji-picker/lib/css/emoji.css" rel="stylesheet">
<script src="emoji/emoji-picker/lib/js/config.js"></script>
<script src="emoji/emoji-picker/lib/js/util.js"></script>
<script src="emoji/emoji-picker/lib/js/jquery.emojiarea.js"></script>
<script src="emoji/emoji-picker/lib/js/emoji-picker.js"></script>  

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
       #logo {
  float:right;
}
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
  <body>
	 
 


 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-12">
     <div class="panel panel-default">
      
       <div class="panel-body">
		   
				
	
		<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
		
		 <img src="libs/images/logos/iconos_envipaq.png" alt="Envipaq" width="180px" >
		
		
		
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
	  
	  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <!--<li class="active"><a href="#">Home</a></li>
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li>-->
    </ul>
	  </div>
  </div>
</nav>
		   
		   
		   <br> <br> <br>
	<div class="pull-right col-md-3">
		<img src="https://envipaq.com.mx/test/media/logo.png" alt="Envipaq" id="logo" width="200px" >
    
	</div> 
		   
		 <div class="pull-right col-md-6">  
		   
		   <center><h1 style="font-family: Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', 'serif'">Preguntas Encuesta Envipaq 2020.</h1></center>
			 
			
		   </div> 
			 
			 
			 <table bgcolor="#e0e0e0" cellpadding="0" cellspacing="0" border="0" height="100%" width="100%" style="border-collapse:collapse;">
      <tr>
        <td><center style="width: 100%;">
            
            
           
            <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="600" class="email-container">
            
           
            <tr>
                <td style="padding: 40px; text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;"><h4>
					
					
					
					<form class="form-horizontal" action="encuesta.php" method="post">
  <div class="form-group">
   
	  <label>1.- ¿Cómo considera el servicio que le brinda su ejecutivo de atención a clientes?</label>
	  <label class="radio-inline"><input type="radio" name="1" value="pesimo">Pésimo</label>
      <label class="radio-inline"><input type="radio" name="1" value="malo">Malo</label>
      <label class="radio-inline"><input type="radio" name="1" value="regular">Regular</label>
      <label class="radio-inline"><input type="radio" name="1" value="bueno">Bueno</label>
      <label class="radio-inline"><input type="radio" name="1" value="excelente">Excelente</label>
	  
  </div><br>
						
						
						  <div class="form-group">
   
	  <label> 2.- ¿Cómo considera el seguimiento que da a sus solicitudes?</label>
	  <label class="radio-inline"><input type="radio" name="2" value="pesimo">Pésimo</label>
      <label class="radio-inline"><input type="radio" name="2" value="malo">Malo</label>
      <label class="radio-inline"><input type="radio" name="2" value="regular">Regular</label>
      <label class="radio-inline"><input type="radio" name="2" value="bueno">Bueno</label>
      <label class="radio-inline"><input type="radio" name="2" value="excelente">Excelente</label>
	  
  </div><br>
		
						
						 <div class="form-group">
   
	  <label>3.- ¿Su ejecutivo es claro al explicar y/o exponer el tema por correo electrónico?</label>
	  <label class="radio-inline"><input type="radio" name="3" value="pesimo">Pésimo</label>
      <label class="radio-inline"><input type="radio" name="3" value="malo">Malo</label>
      <label class="radio-inline"><input type="radio" name="3" value="regular">Regular</label>
      <label class="radio-inline"><input type="radio" name="3" value="bueno">Bueno</label>
      <label class="radio-inline"><input type="radio" name="3" value="excelente">Excelente</label>
	  
  </div><br>		
						
						
						<div class="form-group">
   
	  <label>4.- ¿Su ejecutivo es claro al explicar y/o exponer el tema por llamada telefónica?</label>
	  <label class="radio-inline"><input type="radio" name="4" value="pesimo">Pésimo</label>
      <label class="radio-inline"><input type="radio" name="4" value="malo">Malo</label>
      <label class="radio-inline"><input type="radio" name="4" value="regular">Regular</label>
      <label class="radio-inline"><input type="radio" name="4" value="bueno">Bueno</label>
      <label class="radio-inline"><input type="radio" name="4" value="excelente">Excelente</label>
	  
  </div><br>
						
											<div class="form-group">
   
	  <label>5.- ¿Su ejecutivo se dirige a usted con educación y respeto?</label>
	  <label class="radio-inline"><input type="radio" name="5" value="siempre">Siempre</label>
      <label class="radio-inline"><input type="radio" name="5" value="aveces">Algunas  Veces</label>
      <label class="radio-inline"><input type="radio" name="5" value="nunca">Nunca</label>
	  
  </div><br>
						
						
						
						<div class="form-group">
   
	  <label>6.- ¿Le ha brindado solución a sus solicitudes y/o problemas con la paquetería?</label>
	  <label class="radio-inline"><input type="radio" name="6" value="siempre">Siempre</label>
      <label class="radio-inline"><input type="radio" name="6" value="aveces">Algunas  Veces</label>
      <label class="radio-inline"><input type="radio" name="6" value="nunca">Nunca</label>
	  
  </div><br>
						
						
						
						
									<div class="form-group">
   
	  <label>7.- Por último, desea agregar comentarios o una breve descripción de áreas de oportunidad para mejora en el servicio de atención a clientes que le brinda su ejecutivo.</label>
	  <div class="form-group">
  
  <textarea class="form-control" rows="5" name="7" placeholder="Escribe tus comentarios (es opcional)"></textarea>
</div>
	  <input type="hidden" name="id_cliente" value="<?php echo $id;?>"
  </div><br>
						
						
						
					
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
     <center><button type="submit" name="respuestas"  style="background: #F93A3D; border: 15px solid #F93A3D; padding: 0 10px;color: #ffffff; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">Enviar Respuestas</button></center> 
    </div>
  </div>
		
</form>
					
					
					
					
					
					
					</h4><br>
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
                        <td valign="middle" style="text-align: center; padding: 40px; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #ffffff;">  Envipaq Logistics SA de CV. <br> Rumania 507, col portales Norte<br>Del. Benito Ju&aacute;rez, CDMX.</td>
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
            
                <span class="mobile-link--footer">Ahorra papel antes de imprimir, piensa en tu responsabilidad con el medio ambiente.</span> <br>
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
	 
	 
	 
			 
       </div>
		 
		   
		   
		   
		   
		   
		 
		   
		   
		   
		   
		 
		 </div>
     </div>
  </div>
  

 </div>
  <!--  <script src="libs/js/jquery.min.js"></script>-->
  <script src="libs/js/bootstrap.min.js"></script>
  <script src="libs/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="libs/js/functions.js"></script>
	

	
    


  </body>
</html>

<?php if(isset($db)) { $db->db_disconnect(); } ?>
