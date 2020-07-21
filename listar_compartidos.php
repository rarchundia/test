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
if($action == 'ajax1'){
	$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['querys'], ENT_QUOTES)));
	$vendedor = mysqli_real_escape_string($con,(strip_tags($_REQUEST['usuario'], ENT_QUOTES)));
	//$carpeta = mysqli_real_escape_string($con,(strip_tags($_REQUEST['carpeta'], ENT_QUOTES)));
	//$id_user_sistema = mysqli_real_escape_string($con,(strip_tags($_REQUEST['id_usuario'], ENT_QUOTES)));
//$vendedor=$_REQUEST['usuario'];
	$tables=" file f RIGHT JOIN permision p ON p.file_id = f.id AND p.user_id=".$vendedor."  RIGHT JOIN users u ON u.id =p.dueno ";
	$campos=" f.id, f.filename, f.description, f.is_public, f.is_folder, f.user_id, f.created_at, p.file_id, p.user_id, u.name ";
	$sWhere=" p.p_id=1 AND f.estatus=0 AND (f.filename LIKE '%".$query."%' OR f.description LIKE '%".$query."%') ";	
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
			<div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-file"></span>
          <span>Archivos Compartidos Conmigo  </span>
			</div>
				
			<table class="table table-striped table-hover table-responsive">
				 <thead>
                                    <tr>
                                        <th>Archivo</th>
                                        <th>Descripción</th>
										<th>Tamaño</th>
										<th>Dueño</th>
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
							$dueno=$row['name'];
							$finales++;
						?>	
						<tr>
									<td>
										<i class="glyphicon glyphicon-file"> </i>
										
										 <?php echo substr($archivo, 19);?>
										
										</td>
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
							        <td><?php echo $dueno;?></td>
							<td><?php echo $subido;?></td>
							
									<td style="width:150px;">
										
										
										<!--<a href="agrega_permisos.php?id=<?php echo $product_id;?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-globe"></i> Compartir</a>-->
										
														
										<!--<a download="<?php echo substr($archivo, 19);?>" href="contador.php?id_user=<?php echo $vendedor;?>&id=<?php echo $product_id;?>" class="btn btn-default"><i class="glyphicon glyphicon-download"></i> Descargar</a>-->
										
										
										
										
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
		
		
		echo "<center><h3>SIN ARCHIVOS COMPARTIDOS</h3></center>";
		
	}
}
?>          
		  
