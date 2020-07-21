<?php
	
	
	/*
	
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','');
	define('DB_NAME','recoleccion');
	
	define('DB_HOST','localhost');
	define('DB_USER','envipaq_inven');
	define('DB_PASS','3nvip4q2018');
	define('DB_NAME','envipaq_recoleccion');
	
	
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
	$vendedor = mysqli_real_escape_string($con,(strip_tags($_REQUEST['usuario'], ENT_QUOTES)));
	//$id_user_sistema = mysqli_real_escape_string($con,(strip_tags($_REQUEST['id_usuario'], ENT_QUOTES)));
//$vendedor=$_REQUEST['usuario'];
	$tables=" file ";
	$campos=" * ";
	$sWhere=" user_id=".$vendedor." AND (filename LIKE '%".$query."%' OR description LIKE '%".$query."%') and folder_id is NULL ORDER BY filename asc ";
	
	
		
		
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
		<div class="table-responsive">
			<table class="table table-striped table-hover table-responsive">
				 <thead>
                                    <tr>
                                        <th>Carpeta</th>
                                        <th>Descripción</th>
                                        <th>Fecha de Carga</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead> 
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$product_id=$row['id'];
							$archivo=$row['filename'];
							$descripccion=$row['description'];
							$subido=$row['created_at'];				
							$finales++;
						?>	
						<tr>
									<td>
										<a href="carpetas.php?id=<?php echo $product_id;?>">
											<i class="glyphicon glyphicon-folder-open"> </i> 
										
										<?php echo $archivo;?></a>
							
							</td>
									<td><?php echo $descripccion;?></td>
									<td><?php echo $subido;?></td>
									<td style="width:225px;">
										
										                                        
										<a href="edit_file.php?id=<?php echo $product_id;?>" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
                                        
										<!--<a href="desarrollo.php?id=<?php echo $product_id; ?>&tkn=<?php echo $_SESSION["tkn"]?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</a></td>-->
			</tr>
						<?php }?>
						
				</tbody>			
			</table>
		


</div>	

	
	
	<?php	
	}	
	else{
		
		
		echo "<center><h3>SIN CARPETAS CREADAS</h3></center>";
		
	}
	
}
?>          
		  
