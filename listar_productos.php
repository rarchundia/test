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
	define('DB_USER','root');
	define('DB_PASS','');
	define('DB_NAME','recoleccion');
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
	$tables=" contacto ";
	$campos=" * ";
	if($vendedor==9){
		
		$sWhere=" (contacto LIKE '%".$query."%' OR empresa LIKE '%".$query."%') ORDER BY id DESC ";
	}else{
		
	$sWhere=" id_vendedor=".$vendedor." AND (contacto LIKE '%".$query."%' OR empresa LIKE '%".$query."%') ORDER BY id DESC ";
		
		
	}
	
		
		
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
						<th class='text-center'>id</th>
						<th>Contacto </th>
						<th>Empresa </th>
						<th class='text-center'>Direccion</th>
						<th class="text-center">Agregar Acción</th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$product_id=$row['id'];
							$contacto=$row['contacto'];
							$empresa=$row['empresa'];
							$domicilio=$row['domicilio'];				
							$finales++;
						?>	
						<tr >
							<td class='text-center'>
								
								
								<a href="edit_contacto.php?id=<?php echo $product_id; ?>"> <label class=" glyphicon glyphicon-pencil" title="Editar Contacto" data-toggle="tooltip" ></label></a></td>
								
								
								
								
								
						
								   <td class="text-center"><a href="detalle_contacto.php?id=<?php echo $product_id; ?>" title="Ver Historial de Acciones" data-toggle="tooltip"><?php echo $contacto;?></a></td>
							
							
							<td >
								
								 <a onclick="window.open('https://www.google.com/search?q=<?php echo    $empresa;?>', 'Google Envipaq', 'width=900, height=600'); return false" title="Buscalo en Google" data-toggle="tooltip"><span class="glyphicon glyphicon-search"></span><?php echo    $empresa;?>
									
									
									
									</a>
								
								
								<!--<a href="https://www.google.com/search?q=<?php echo $empresa; ?>" target="_blank" title="Buscalo en Google" data-toggle="tooltip"><span class="glyphicon glyphicon-search"></span><?php echo $empresa; ?></a>
								
								-->
								
								
								</td>
							<td>
							
								<a onclick="window.open('https://maps.google.com/?q=<?php echo    $domicilio;?>', 'Maps Envipaq', 'width=900, height=600'); return false" title="Buscalo en el  Mapa" data-toggle="tooltip">
								   
								   
								
			   
				<span class="glyphicon glyphicon-map-marker"></span>Ubicalo en el Mapa</a>
								
								<!--<a href="https://maps.google.com/?q=<?php echo $domicilio; ?>" target="_blank" title="Buscalo en el Mapa" data-toggle="tooltip">
			   
				<span class="glyphicon glyphicon-map-marker"></span>Ubicalo en el Mapa</a>
								-->
								
							</td>
							
							<td class='text-center' >
								<a href="acciones.php?id=<?php echo $product_id; ?>" >
									
									<label class=" glyphicon glyphicon-plus-sign"  title="Agregar Acción" data-toggle="tooltip" style="font-size:20px;"></label></a>
								
			   
			   </td>
						
							
							


							
							
							
							
							
							
							<!-- <td>
								<a href="#"  data-target="#editProductModal" class="edit" data-toggle="modal" data-code='<?php echo $prod_code;?>' data-name="<?php echo $prod_name?>" data-category="<?php echo $prod_ctry?>" data-stock="<?php echo $prod_qty?>" data-price="<?php echo $price;?>" data-id="<?php echo $product_id; ?>"><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i></a>
								<a href="#deleteProductModal" class="delete" data-toggle="modal" data-id="<?php echo $product_id;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
                    		</td>-->
						</tr>
						<?php }?>
						<tr>
							<td colspan='6'> 
								<?php 
									//$inicios=$offset+1;
									//$finales+=$inicios -1;
									//echo "Mostrando $inicios al $finales de $numrows registros";
									//echo paginate( $page, $total_pages, $adjacents);
								?>
							</td>
						</tr>
				</tbody>			
			</table>
		


</div>	

	
	
	<?php	
	}	
}
?>          
		  
