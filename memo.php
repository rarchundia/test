<?php
  $page_title = 'Memo';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
$usuarios_envia=users_activos();
$envia_notificacion=envia_notificacion_memo();
$envia_notificacioncc=envia_notificacion_memocc();
$date    = make_date();
?>


<?php 

if(isset($_POST['memo'])){
 

 $p_asunto= remove_junk($db->escape($_POST['asunto']));
  $p_quien_genera = remove_junk($db->escape($_POST['quien_genera']));
	$p_contenido = remove_junk($db->escape($_POST['contenido']));
 
 
    if(empty($errors)){
     
	 
     
     $query  = "INSERT INTO memo (";
     $query .=" asunto, contenido, fecha, id_quien_genera";
     $query .=") VALUES (";
     $query .="'{$p_asunto}','{$p_contenido}','{$date}','{$p_quien_genera}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
		 
       $consulta_id_memo=id_memo($p_quien_genera);
	 
		 
		// $sql="INSERT INTO `memo_compartido`(`id`, `id_memo`, `id_quien_lo_ve`, `fecha_enviado`, `fecha_visto`, `veces_descargado`) VALUES (";
		 foreach ($_POST["usuarios"] as $usuarios_mandar):
		  $sql="INSERT INTO memo_compartido(id_memo, id_quien_lo_ve ) VALUES ('{$consulta_id_memo["id"]}','{$usuarios_mandar}')";
		  
		 
		 $db->query($sql);
		 endforeach; 
		 
		 foreach ($_POST["usuarios_copia"] as $usuarios_mandar):
		  $sql="INSERT INTO memo_copia(id_memo, id_quien_lo_ve ) VALUES ('{$consulta_id_memo["id"]}','{$usuarios_mandar}')";
		  
		 
		 $db->query($sql);
		 endforeach; 
			  
		$session->msg('s',"Memo Guardado ");
     echo '<meta http-equiv="Refresh" content="0; url=memo.php">';	 
		 //  redirect('memo.php', false);
   
	 
	 }
	    else {
       $session->msg('d',' Lo siento, Falló al Guardar el Memo.');
       redirect('memo.php', false);
	   }

   } else{
     $session->msg("d", $errors);
     redirect('memo.php',false);
   }

 }
 
 

?>

<style>
	body{background-color: white;
	}

	#nuevo{background: white;}
	#creados{background: white;}
	#memos_ver{background: white;}
</style>
<?php include_once('layouts/header.php');
$mis_memos=mis_memos_creados($user['id']);
?>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
 
     <div class="panel panel-default">
       <div class="panel-heading">
        
          <span class="glyphicon glyphicon-list-alt"></span>
          Memos 
       </div>
       <div class="panel-body">
		   
		   <!--<div class="container">-->
			     <div class="col-md-12">
					 
  <div class="col-md-2">
	  
  <ul class="nav nav-pills nav-stacked">
    <li class="active"><a data-toggle="pill" href="#nuevo">Crear Nuevo</a></li>
    <li><a data-toggle="pill" href="#creados">Creados</a></li>
    <li><a data-toggle="pill" href="#memos_ver">Memos para Ver</a></li>
   
  </ul>
			   </div>
			   
 
				   
				   
				   
				   <div class="tab-content">
    <div id="nuevo" class="tab-pane fade in active">
  <div class="col-md-6">
	   
	   <center> <h3>Generar Nuevo Memo</h3></center>
		
		<form method="post" action="memo.php" class="clearfix">
                    <div class="form-group">
                <div class="row">
                   <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-pencil"></i>
                  </span>
                  <input type="text" class="form-control" name="asunto" placeholder="Asunto (Titulo)" autofocus  onkeyup="mayus(this);">
               </div></div>
               <input type="hidden" class="form-control" name="quien_genera" value="<?php echo $user['id']?>">
               </div></div>
              				 
				 
				 <div class="form-group">
                <div class="row">
		   
                <div class="col-md-12">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-pencil"></i>
                  
                  </span>
					<textarea name="contenido" class="form-control" placeholder="Escribe todo el contenido " onkeyup="mayus(this);" rows="15"></textarea>
               
               </div></div></div></div></div>
               
          
 
   
     
		   
		
		
			
				   
			<div class="col-md-2">
			
			<h3>Para: </h3>
				<input type="button" id="BtnSeleccionar" class="btn btn-info btn-block" value="Seleccionar todos">
 <div id="checkbox_usuarios">
				<?php foreach ($usuarios_envia as $users):?>
				
				 <div class="checkbox">
  <label><input type="checkbox" name="usuarios[]" value="<?php echo   $users['id'];?>"><?php echo   $users['name'];?></label>
</div> 
				<?php endforeach; ?> 
			
				</div>	</div>
				   
				   
				   
				   <div class="col-md-2">
			
			<h3>Con Copia a:</h3>
				<input type="button" id="BtnSeleccionarr" class="btn btn-info btn-block" value="Seleccionar todos">
 <div id="checkbox_usuarioss">
				<?php foreach ($usuarios_envia as $users):?>
				
				 <div class="checkbox">
  <label><input type="checkbox" name="usuarios_copia[]" value="<?php echo   $users['id'];?>"><?php echo   $users['name'];?></label>
</div> 
				<?php endforeach; ?> 
			
				</div>	</div>
				   
				   
				   
				   
	     <button type="submit" name="memo" class="btn btn-danger btn-block"> Generar<button>
				</form>
    </div>  
    
		
				   
				   <div id="creados" class="tab-pane fade">
     <center> <h3>Mis memos Creados</h3></center>
       <?php 
			 
			
			   ?>
		
		
		<table class="table table-striped table-hover table-responsive table-fixed "> <!--table-bordered-->
            <thead>
              <tr>
				  <th class="text-center">Abrir</th>
                 <th class="text-center">Resumen</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Usuarios Enviados</th>
				  
				 
              </tr>
            </thead>
            <tbody id="myTable">
				
				
              <?php  foreach ($mis_memos as $memos):?>
              <tr>
				  <td class="text-center">
					  
					  <br><a   onclick="window.open('pdf_memo.php?id=<?php echo ($memos['id']);?>', 'Memo', 'width=700, height=600'); return false" title="Ver PDF" data-toggle="tooltip">
					  
			 <?php echo remove_junk($memos['asunto']);?> Abrir</a> </td>
				
				  
				<td class="text-center"><strong><br><strong><?php echo remove_junk($memos['resumen']);?>...</strong></td>

								<td class="text-center"><strong><strong><?php echo ($memos['fecha']);?></strong></td>

								<td class="text-center">
									
      <?php 
									$compartidos=mis_memos_enviados($memos['id']);
									
									foreach ($compartidos as $aquien_comparti):
									
									?>
									
									
									<div class="card" style="width: 14rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">
		
		<img src="uploads/users/<?php echo $aquien_comparti['imagen'];?>"  style="width:80px" ><br>
		<?php echo ($aquien_comparti['name']);?><br>
		<?php if($aquien_comparti['fecha_visto']==0 ){
											?>
								<img src="libs/images/no_visto.png" width="25px" data-toggle="tooltip" title="Enviado">
		
		<?php	}else{

	?>
		<img src="libs/images/visto.png" width="25px" data-toggle="tooltip" title="Visto" >
		
		<?php
}
									
									?>
	  </li>

  </ul>
</div>
				<?php 	endforeach; ?>						
									
									</td>

								
</tr>

			<?php 	endforeach; ?>
			</tbody>
		</table>		
					
					
	   </div>
    <div id="memos_ver" class="tab-pane fade">
      <center><h3>Memos para Visualizar</h3></center>
    		<?php 
		$memos_que_me_han_enviado=memos_por_usuario($user['id']);  
    
		
		?>
		
		
		<table class="table table-striped table-hover table-responsive table-fixed "> <!--table-bordered-->
            <thead>
              <tr>
				  <th class="text-center">Abrir</th>
                  <th class="text-center">Asunto</th>
				  <th class="text-center">Resumen</th>
                <th class="text-center">Fecha  de Envio</th>
				  <th class="text-center">Visto</th>
               
				  
				 
              </tr>
            </thead>
            <tbody id="myTable">
		<?php  foreach ($memos_que_me_han_enviado as $memos):?>
              <tr>
				  <td class="text-center">
	
					  <br><a   onclick="window.open('pdf_memo.php?id=<?php echo ($memos['id_de_memo']);?>&user=<?php echo ($user['id']);?>', 'Memo', 'width=700, height=600'); return false" title="Ver PDF" data-toggle="tooltip">
					  
			 <?php echo count_id();?> Abrir</a> </td>
				<td class="text-center"><br><strong><br><strong><?php echo remove_junk($memos['asunto']);?></strong></td>
				<td class="text-center"><strong><strong><?php echo remove_junk($memos['resumen']);?>...</strong></td>

								<td class="text-center"><strong><br><strong><?php echo ($memos['fecha_enviado']);?></strong></td>

								
				
								<td class="text-center">
				  
				  
				  <?php if($memos['fecha_visto']==0 ){
											?>
								<img src="libs/images/no_visto.png" width="25px" data-toggle="tooltip" title="Pendiente">
		
		<?php	}else{

	?>
		<img src="libs/images/visto.png" width="25px" data-toggle="tooltip" title="Visto" >
		
		<?php
}
									
									?>
				  
				  
				  </td>	
					
								
</tr>

			<?php 	endforeach; ?>
			</tbody>
		</table>				
									
		
		</div>
    
  </div>
</div></div></div>
		   
			   

			   
			   <?php 
			  foreach ($envia_notificacion as $notificacion):
			   $id_memo=$notificacion['id_memo'];
		  
			
			   $destinatario = $notificacion["email"]; 
			   $tipo="Nuevo Memo";
$asunto = "Avisos Envipaq"; 
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
                <td style="padding: 40px; text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;"><h3> Tienes un  '.$tipo.' para revisar ingresa a sci o da click en Ver Memo</h3><br>
                <br>
                
                
                <table cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
                    <tr>
                    <td style="border-radius: 3px; background: #F93A3D; text-align: center;" class="button-td"><a href="http://sci.envipaq.com.mx/login/memo1.php" style="background: #F93A3D; border: 15px solid #F93A3D; padding: 0 10px;color: #ffffff; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a"> 
                      <!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;<![endif]-->Ver Memo<!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;<![endif]--> 
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
$headers .= "Reply-To: rarchundia@envipaq.com.mx\r\n"; 

//ruta del mensaje desde origen a destino 
$headers .= "Return-path: rarchundia@envipaq.com.mx\r\n";


//direcciones que recibián copia 
//$headers .= "Cc: rarchundia@envipaq.com.mx\r\n"; 

//direcciones que recibirán copia oculta 
$headers .= "Bcc: rarchundia@envipaq.com.mx\r\n"; 


$envio= mail($destinatario,$asunto,$cuerpo,$headers);
				
	 $memo_update_envio="UPDATE memo_compartido SET fecha_enviado='{$date}', enviado_notf='1' WHERE id='{$id_memo}'";
		 $result = $db->query($memo_update_envio);
			   if($result && $db->affected_rows() === 1){
			
					 	 
			   }
		   
		  
				 endforeach; 
		   
		   
		   
		   
		    foreach ($envia_notificacioncc as $notificacion):
			   $id_memo=$notificacion['id_memo'];
		  
			
			   $destinatario = $notificacion["email"]; 
			   $tipo="Nuevo Memo";
$asunto = "Avisos Envipaq"; 
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
                <td style="padding: 40px; text-align: center; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;"><h3> Tienes un  '.$tipo.' para revisar ingresa a sci o da click en Ver Memo</h3><br>
                <br>
                
                
                <table cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
                    <tr>
                    <td style="border-radius: 3px; background: #F93A3D; text-align: center;" class="button-td"><a href="http://sci.envipaq.com.mx/login/memo1.php" style="background: #F93A3D; border: 15px solid #F93A3D; padding: 0 10px;color: #ffffff; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a"> 
                      <!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;<![endif]-->Ver Memo<!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;<![endif]--> 
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
$headers .= "Reply-To: rarchundia@envipaq.com.mx\r\n"; 

//ruta del mensaje desde origen a destino 
$headers .= "Return-path: rarchundia@envipaq.com.mx\r\n";


//direcciones que recibián copia 
//$headers .= "Cc: rarchundia@envipaq.com.mx\r\n"; 

//direcciones que recibirán copia oculta 
$headers .= "Bcc: rarchundia@envipaq.com.mx\r\n"; 


$envio= mail($destinatario,$asunto,$cuerpo,$headers);
				
	 $memo_update_envio="UPDATE memo_copia SET fecha_enviado='{$date}', enviado_notf='1' WHERE id='{$id_memo}'";
		 $result = $db->query($memo_update_envio);
			   if($result && $db->affected_rows() === 1){
			
					 	 
			   }
		   
		  
				 endforeach; 
		   
		   
		   
			
			   
			   ?>
			   <script>
			   
			   
			   
			   $(document).ready(function() {
	
  $('#BtnSeleccionar').click(function() {
	
    if ( selected = true) {
      $('#checkbox_usuarios input[type=checkbox]').prop("checked", true);}
		/*$('#BtnSeleccionar').val('Deseleccionar');
    } if ( selected = true) {
      $('#checkbox_usuarios input[type=checkbox]').prop("checked", false);
      $('#BtnSeleccionar').val('Seleccionar todos');
	
    }*/
  // selected = !selected;
  }
							);
				 //selected = true;
				   $('#BtnSeleccionarr').click(function() {
					  
    if ( selected = true) {
      $('#checkbox_usuarioss input[type=checkbox]').prop("checked", true);}
     /* $('#BtnSeleccionarr').val('Deseleccionar');
    }   if ( selected = true) {
      $('#checkbox_usuarioss input[type=checkbox]').prop("checked", false);
      $('#BtnSeleccionarr').val('Seleccionar todos');
		
    }
   */
  }
	//selected = !selected;
									  );
				   
				  
});
				   
				   
				   
			   
			   </script>
<?php include_once('layouts/footer.php'); ?>
