<?php
  $page_title = 'Estatus Entregas';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(4);
  $id=$_GET['id'];
?>
<?php 
include_once('layouts/header.php');
 $products = entregas_reporte_busqueda($id);
 ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
		
		<div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-search"></i>
                  </span>
        
                  <input type="text" class="form-control" name="busqueda_entrega" id="busqueda_entrega" value="" placeholder="Busca por Folio de Guia, Remitente, Destinatario, Quien Recibio" autocomplete="off" onKeyUp="buscar_entrega();" align="left" />
		
						 </div></div>
		
		<div class="col-md-6">
		<form class="clearfix" method="post" action="rango_entrega.php">
            <div class="form-group">
                <div class="input-group">
                  <input type="text" class="datepicker form-control" name="fecha"  autocomplete="off" placeholder="Primera Fecha Entrega" required title="Selecciona un Rango de Fechas de Entrega Para Generar el reporte" data-toggle="tooltip">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
                  
                     <input type="text" class="datepicker form-control" name="fecha2"  autocomplete="off" placeholder="Segunda Fecha Entrega" required>
										</div>
<button type="submit" name="fecha_entrega" class="btn btn-primary btn-block">Generar Reporte</button>
            </div>
          </form>
		
		</div>
		
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Resultado de Busqueda Entregas</strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered"> 
            <thead>
              <tr>
                <th class="text-center"># FOLIO</th>
                <th class="text-center">DIRECCION ORIGEN </th>
                <th class="text-center">DIRECCION DESTINO</th>
                <th class="text-center">RUTA</th>
                <th class="text-center">DETALLE</th>
				  <th class="text-center">ESTATUS</th>
                 
                
              </tr>
            </thead>
			 
            <tbody>
				 <div id="resultadoBusqueda" style="background-color:skyblue"></div>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><br><br><strong><?php echo remove_junk($product['id']);
					
					
					if($product['seguro']!=0){
						echo "<br><br> Valor declarado  por: $";
						echo $product['seguro'];
						
						
						
					}?></strong></td>
                <td>
                
                           
        
                
                Contacto <strong><?php  echo $product['remitente'];?></strong> Telefono:  <strong><?php  echo $product['telefono'];?></strong><br>
					Razon Social:  <strong><?php  echo $product['razon_social'];?></strong><br> <br />
  
 Calle: <strong><?php echo $product['direccion'];?></strong> Colonia: <strong><?php  echo $product['colonia'];?></strong>  Codigo Postal: <strong><?php  echo $product['cp'];?></strong> <br />
                      </td>  
                
                <td class="text-center">
					 Contacto <strong><?php  echo $product['nombre_destinatario'];?></strong> Telefono:  <strong><?php  echo $product['telefono_des'];?></strong><br>Correo: <strong style="text-transform:lowercase"><?php  echo $product['correo'];?></strong>
					Razon Social:  <strong><?php  echo $product['razonsocial_des'];?></strong><br> <br />
  
 Calle: <strong><?php echo $product['direccion_des'];?></strong> Colonia: <strong><?php  echo $product['colonia_des'];?></strong>  Codigo Postal: <strong><?php  echo $product['cp_des'];?></strong> <br />
					
					
               
                </td>
                <td class="text-center">
              
              <br><br>
              <?php
               switch ($product['id_operador']) 
    {
    case 5:
        echo "Norte";
        break;
    case 6:
        echo "Sur";
        break;
    case 7:
        echo "Oriente";
        break;
    case 8:
        echo "Poniente";
        break;
        
    default:
        echo "Aun No Esta Asignado a Ninguna Ruta";
    }
					
					
					
					?>
              </td>
				  <td>
			  		<?php 
					  
					  if($product['primera']!=0){
						  
					  
					  ?>Intento Primera Entrega.<br>
					  Fecha de Visita <?php $fecha_entrega1=strftime("%d %B del %Y", strtotime($product['primera_fecha'])) ;
					
					  
					  echo $fecha_entrega1; 
						   ?> <br>
					  Notas: <?php echo $product['notas_entrega']; ?> 
					 
					  <br>
					  <?php 
					  }
			  		
					  ?>
					  
					  <?php 
					  
					  if($product['segunda']!=0){
						  
					  
					  ?><br>
					  
					  Intento Segunda Entrega.<br>
					  Fecha de Visita <?php $fecha_entrega2=strftime("%d %B del %Y", strtotime($product['segunda_fecha'])) ;
					
					  
					  echo $fecha_entrega2;  ?> <br>
					  Notas: <?php echo $product['notas_entrega2']; ?> 
					 
					  
					  <?php 
					  }
			  		
					  ?>
					  <br>
					  <?php 
					  
					  if($product['tercera']!=0){
						  
					  
					  ?><br>
					  
					  Intento Tercera Entrega.<br>
					  Fecha de Visita <?php 
						  
						  $fecha_entrega3=strftime("%d %B del %Y", strtotime($product['tercera_fecha'])) ;
					
					  
					  echo $fecha_entrega3; ?> <br>
					  Notas: <?php echo $product['notas_entrega3']; ?> 
					 
					  <br>
					  <?php 
					  }else{
						  
						  echo " <br>Sin Notas del Operador";
					  }
			  		
					  ?>
					  
					  
					 
					  
					  
					  
					  
					 
				  </td>
               
                  </div>
                </td><td>
			
			
			<?php 
			
			if($product['estatus']!=0){
				?>
				<center><h2>Entregado</h2></center><br><br>Recibio:  
				<?php echo $product['recibido'];?><br>
			<img src="../uploads/products/<?php echo $product['file_name']; ?>" height="120">
			
		
			<?php	
			}else{
				echo "<br>Aun no se ha Entregado";
				
			}
			?>
			</td>
			
              </tr> 
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
