
  <?php
  require_once('../../../includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(3);
  ?><?php 

if(isset($_POST['agregar_paquetes'])){
 

 $p_envipaq= $_POST['envipaqpaq'];
  $p_estafeta= $_POST['estafetapaq'];
 $p_redpack = $_POST['redpackpaq'];
     $p_express= $_POST['expresspaq'];
	 $p_fedex = $_POST['fedexpaq'];
	 $p_notas  = $_POST['notas'];
	 $p_especial  = $_POST['especialpaq'];
	 $p_idrecolecta=$_POST['id_recolecta'];
	 $p_idruta=$_POST['id_ruta'];	
	$p_correo=$_POST['correo'];
	$p_id_recoleccion=$_POST['id_recolecion'];
	$p_quien_entrega=$_POST['quien_entrega'];
	$p_id_ruta=$_POST['id_ruta'];
	
	
	
	$total=(int)$p_envipaq + (int)$p_estafeta + (int)$p_redpack + (int)$p_express + (int)$p_fedex + (int)$p_especial;
	
	  
	 $sql="UPDATE recolecta SET estatus=1 WHERE id='{$p_id_recoleccion}'";
     $date    = make_date();
     $query  = "INSERT INTO paqueteria (";
     $query .=" envipaq, fedex, estafeta, redpack, express, especial, id_recolecta, id_ruta, notas, fecha,total, quien_entrega";
     $query .=") VALUES (";
     $query .="'{$p_envipaq}','{$p_fedex}','{$p_estafeta}','{$p_redpack}','{$p_express}','{$p_especial}','{$p_idrecolecta}','{$p_idruta}','{$p_notas}','{$date}','{$total}','{$p_quien_entrega}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
	 
			   
     if($db->query($query)){
   $resul=$db->query($sql);
	  //$session->msg('s',"Recolección Agregada Exitosamente  . ");
		
      // redirect('recoleccion.php', false);
   }
	    else {
       //$session->msg('d',' Lo siento, Falló al Agregar el Equipo Intenta Otra Vez.');
       //redirect('recoleccion.php', false);
	   }

  

 }
 
 

?>

<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Recoleccion Firma</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=yes">

  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  <link rel="stylesheet" href="css/signature-pad.css">

  <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-39365077-1']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script>
</head>
<body onselectstart="return false">
<center><h1>ENVIPAQ</h1></center>
  <div id="signature-pad" class="m-signature-pad">
    <div class="m-signature-pad--body">
      <canvas></canvas>
    </div>
    <div class="m-signature-pad--footer">
      <div class="description">Firma</div>
      <div class="left">
        <button type="button" class="button clear" data-action="clear">Limpiar</button>
      </div>
      <div class="right">
        <button type="button" class="button save" data-action="save-png"><a href="save_image.php?id=<?php echo $p_idrecolecta; ?>&t=<?php echo $total; ?>&correo=<?php echo $p_correo; ?>&id_ruta=<?php echo $p_id_ruta; ?>&entrega=<?php echo $p_quien_entrega; ?>">Guardar</a></button>
        
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="js/signature_pad.js"></script>
  <script src="js/app.js"></script>
</body>
</html>
