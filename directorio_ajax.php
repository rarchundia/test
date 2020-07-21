<?php
	
	
	/*
	
	define('DB_HOST','localhost');
	define('DB_USER','envipaq_inven');
	define('DB_PASS','3nvip4q2018');
	define('DB_NAME','envipaq_recoleccion');
	
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','');
	define('DB_NAME','recoleccion');
	
	
	
	*/
	
define('DB_HOST','localhost');
	define('DB_USER','envipaq_inven');
	define('DB_PASS','3nvip4q2018');
	define('DB_NAME','envipaq_recoleccion');
	
	

	# conectare la base de datos
    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }


$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	//$vendedor = mysqli_real_escape_string($con,(strip_tags($_REQUEST['usuario'], ENT_QUOTES)));
	//$id_user_sistema = mysqli_real_escape_string($con,(strip_tags($_REQUEST['id_usuario'], ENT_QUOTES)));
//$vendedor=$_REQUEST['usuario'];
	$tables=" directorio ";
	$campos=" * ";
	$sWhere=" (nombre LIKE '%".$query."%' OR extencion LIKE '%".$query."%') ORDER BY extencion ASC ";
	
	
		
		
	//include 'pagination.php'; //include pagination file
	//pagination variables
	//$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	//$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	//$adjacents  = 4; //gap between pages after number of adjacents
	//$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM $tables WHERE $sWhere ");
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($con);}
	//$total_pages = ceil($numrows/$per_page);
	//main query to fetch the data
	$query = mysqli_query($con,"SELECT $campos FROM  $tables WHERE $sWhere ");
	//loop through fetched data
	


		
	
	if ($numrows>0){
		
	?>

<table class="table table-striped table-hover table-responsive">
        <thead>
          <tr>
            
            <th class="text-center">Nombre </th>
            <th class="text-center">Extensión</th>
            <th class="text-center">Correo</th>
            <!--<th class="text-center">Cumpleaños</th>-->
			</tr>
        </thead>
        <tbody>
			<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$product_id=$row['id'];
							$nombre=$row['nombre'];
							$extencion=$row['extencion'];
							$email=$row['email'];				
							$finales++;
						?>	
			
			<tr>
           
           <td class="text-center"><?php echo $nombre;?></td>
           <td class="text-center"><?php echo $extencion;?></td>
           <td class="text-center"><a href="mailto:<?php echo mb_strtolower($email,'UTF-8');?>" title="Da Click para Abrir Outlook" data-toggle="tooltip"><?php echo mb_strtolower($email,'UTF-8');?></a></td>
		<!--<td class="text-center">cumpleaños</td>
        -->   </tr>
       <?php }?>
       </tbody>
     </table>


<?php	
	}	
}
?>    