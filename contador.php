<?php
  $page_title = 'Contador';
  require_once('includes/load.php');
 
?>
<?php 




	
$id=$_POST["id"];
//$count=$_GET["count"]+1;
$id_user=$_POST["id_user_log"];
$date    = make_date();

$query  = "INSERT INTO descargas ( ";
$query .=" id_user, id_archivo, fecha_descarga";
     $query .=") VALUES (";
     $query .="'{$id_user}','{$id}','{$date}'";
     $query .=")";
	 


	
//if(
	$db->query($query)//){
       
	/* $acciones = descarga($id);
		
	foreach ($acciones as  $accion): 	
		
	
	$nombre=$accion['filename'];
	$nombreArchivo = basename($nombre);
	$url = "archivos_fact/".$nombre;
	
	if (is_file($url))
{
		
		
	//header('Content-Type: application/force-download');
   header('Content-Disposition: attachment; filename='.$nombre);
   //header('Content-Transfer-Encoding: binary');
   //header('Content-Length: '.filesize($url));

   readfile($url);
	}else{
		
   exit();
	}
	
	endforeach;
	
        } else {
          //failed
          $session->msg('d',' No se pudo Crear Descargar.');
             echo '<meta http-equiv="Refresh" content="0; url=detalle_documento.php?id='.(int)$id.'">';
		}*/
   















/*$accion = find_by_id('file',(int)$id);


	$url = "archivos_fact/".$accion['filename'];*/
?>


