
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
	$carpeta = mysqli_real_escape_string($con,(strip_tags($_REQUEST['carpeta'], ENT_QUOTES)));
	//$id_user_sistema = mysqli_real_escape_string($con,(strip_tags($_REQUEST['id_usuario'], ENT_QUOTES)));
//$vendedor=$_REQUEST['usuario'];
	$tables=" file ";
	$campos=" * ";
	$sWhere=" user_id=".$vendedor." AND folder_id=".$carpeta. " AND estatus=0 AND (filename LIKE '%".$query."%' OR description LIKE '%".$query."%') order by created_at desc  ";
	
	
	
	
	?>
		<script>
	     
    function inserta_descarga(){

        $.ajax({                        
           type: "POST",                 
           url: "contador.php",                     
           data: $("#formulario").serialize(), 
           success: function(data)             
           {
             $('#resp').html(data);               
           }
       });   
}
			
			
			
			
</script>
	<?php	
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
                                        <th>Archivo</th>
                                        <th>Descripción</th>
										<th>Tamaño</th>
                                        <th>Cargado  el:</th>
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
							$es_folder=$row['is_folder'];	
							$finales++;
						?>	
						<tr>
									<td><i class="glyphicon glyphicon-file"> </i> <?php echo substr($archivo, 19);?></td>
									<td><?php echo $descripccion;?></td>
									<td><?php 
							
							$url = "archivos_fact/".$archivo;
							chmod($url, 0777 );
                                          //  if(file_exists($url)){
                                                $fsize = filesize($url);
                                                if($archivo!=""){
                                                    if(!$es_folder){
                                                        if($fsize>(1000*1000*1000)){
                                                            echo ($fsize/(1000*1000*1000))." Gb";
                                                        }
                                                        else if($fsize>(1000*1000)){
                                                            echo ($fsize/(1000*1000))." Mb";
                                                        }
                                                        else if($fsize>1000){
                                                            echo ($fsize/1000)." Kb";
                                                        }
                                                        else if($fsize>0){
                                                            echo $fsize." B";
                                                        }
                                                    }
                                                }
                                           // }
							
							
							?></td>
							        <td><?php echo $subido;?></td>
									<td style="width:225px;">
										
										
										<a href="agrega_permisos.php?id=<?php echo $product_id;?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-globe"></i> Compartir</a>
										
														
										
                                        
										<a href="edit_file_archivo.php?id=<?php echo $product_id;?>" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
                                        
										<form role="form" action="carpetas.php?id=<?php echo $carpeta; ?>" method="post">
											<input type="hidden" name="id_archivo" value="<?php echo $product_id;?>"/>
										
									<button type="submit" name="eliminar_archivo" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
											
											</form>
										<form method="post" id="formulario">	
										<input type="hidden" name="id" value="<?php echo $product_id;?>">
											<input type="hidden" name="id_user_log" value="<?php echo $vendedor;?>">
												   
												   <a download="<?php echo substr($archivo, 19);?>" href="<?php echo $url;?>" class="btn btn-xs btn-default" data-toggle="tooltip" title="Descargar Archivo" onClick="inserta_descarga();" ><i class="glyphicon glyphicon-download" ></i> Descargar</a>
											
											
										</form>
										
										 
                    
										
											
											</td>
			</tr>
						<?php }?>
						
				</tbody>			
			</table>
		


</div>	

	
	
	<?php	
	}	else{
		
		
		echo "<center><h3>SIN ARCHIVOS EN LA CARPETA</h3></center>";
		
	}
}
?>          
	
<script>
	
	


	
	
	
	
	
	

function load(page){
			var querys=$("#q").val();
			var parametros = {"action":"ajax",'query':querys, 'usuario':<?php echo $user['id'];?>};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'listar_carpetas.php',
				data: parametros,
				 beforeSend: function(objeto){
				$("#loader").html("Cargando...");
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$("#loader").html("");
				}
			})
		}
		
		
		
</script>
