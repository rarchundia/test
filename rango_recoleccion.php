<?php
  $page_title = 'Estatus Por Fecha';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(4);
  
?>
<?php
 
	  
if(isset($_POST['fecha_entrega'])){
    
  $fecha=$_POST['fecha'];
	$fecha2=$_POST['fecha2'];
     } else{
       $session->msg("d", $errors);
       redirect('consulta.php', false);
   }
	?>   

<?php 
include_once('layouts/header.php');
 $products = recoleccion_diaria_reporte_rango($fecha,$fecha2);
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
		<form class="clearfix" method="post" action="rango_recoleccion.php">
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
<strong>Resultado de Busqueda</strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered"> 
            <thead>
              <tr>
                <th class="text-center" style="width: 30px;">#</th>
                <th class="text-center">EMPRESA</th>
                <th class="text-center">DIRECCION</th>
                <th class="text-center">RUTA</th>
                <th class="text-center">ESTATUS</th>
                 <th class="text-center">DETALLE</th>
                
              </tr>
            </thead>
            <tbody>
				<div id="resultadoBusqueda" style="background-color:rosybrown"></div>
				
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo remove_junk($product['id']);?></td>
                <td><span title="<?php echo remove_junk($product['notas']); ?>" data-toggle="tooltip"> <?php echo remove_junk($product['id_empresa']); ?></span></td>
                <td>
                
                           
        
                
                Contacto <strong><?php  echo $product['nombre'];?></strong> Telefono:  <strong><?php  echo $product['telefono'];?></strong><br> Correo: <strong style="text-transform:lowercase"><?php  echo $product['correo'];?></strong><br />
  
 Calle: <strong><?php echo $product['direccion'];?></strong> Numero: <strong><?php echo $product['numero'];?></strong>  Colonia: <strong><?php  echo $product['colonia'];?></strong>  Delegación: <strong><?php  echo $product['delegacion'];?></strong> Codigo Postal: <strong><?php  echo $product['cp'];?></strong> <br />
 Medidas del Paquete más Grande: Alto <strong><?php echo remove_junk($product['alto']); ?> </strong>x Ancho <strong><?php echo remove_junk($product['ancho']); ?></strong> x Largo <strong><?php echo remove_junk($product['largo']);
					
					if($product['medida']==1){
	  echo " CM ";
	  }else{ 
	  echo " Metros ";
	  }
					
					
					?>"</strong>  Total a recoger: <strong><?php echo remove_junk($product['totalp']); ?></strong> <br> Fecha Programada de Recoleccion: <strong><?php 
					
					
					
					$fecha_rango2=strftime("%d %B del %Y", strtotime($product['fechaprogramar'])) ;
					echo $fecha_rango2;?></strong><!--fin direccion-->
			 
                
                      </td>  
                
                <td class="text-center">
               <?php  
                switch ($product['id_operador']) 
    {
    case 4:
        echo "Alianza";
			/*if($product['alianza']=='NULL'){
			}else{
		
		echo "<br>Codigo de Recoleccion es: "; echo $product['alianza'];
        
	}*/
			break;
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
                <td class="text-center">
              
              
              <?php
              
					if($product['estatus']==0){
						
						echo "Aun sin Recolectar";
						
						
					}else{
						
						echo "<h3>Recolectado</h3>";
						
						if($product['alianza']!='NULL'){
							
						}else{
							echo "<br>Fecha y Hora<br>";
						$fecha=strftime("%d %B del %Y a las %I:%M %P", strtotime($product['fecha_queserecolecto'])) ;
						echo $fecha;
							
						}
						
					}
					
					
					?>
              </td>
				  <td>
			  		
			  		<?php 
					  
					  if($product['alianza']!='NULL'){
						  
						  echo "Codigo programado de recolección es: <h3>";
					      echo $product['alianza'];
						  echo "</h3>";
							  
							  if($product['estatus']=='0'){
							  
							  echo "<h4>Sin Información de Recoleccion.</h4>";
						  }else{
						  echo "<h4>Se ha Realizado la Recolección</h4>";
			}
					  }else{

					  
					  
					  ?>
			  		
			  		<?php if($product['total_recolectado']=='0'){
						  echo "No se Recolecto ningun paquete<br>";
					  }else{
						  ?>
				  		Se recolectarón  <strong><?php echo remove_junk($product['total_recolectado']); ?></strong>  Paquetes <br>
                  
					  <?php           if($product['envipaq']==0){
	  }else{ 
	  echo "Envipaq: ";echo $product['envipaq']; echo " paquetes ";
	  }
					 
					  if($product['fedex']==0){//if que verifica los paquetes fedex
	
}else{
	echo "Fedex: ";echo $product['fedex']; echo " paquetes ";
}
 
					  
					  if($product['estafeta']==0){//if que verifica los paquetes fedex
	
}else{
	echo "Estafeta: ";echo $product['estafeta']; echo " paquetes ";
}
					  
					  if($product['redpack']==0){//if que verifica los paquetes fedex
	
}else{
	echo "Redpack: ";echo $product['redpack']; echo " paquetes ";
}
					  
					  if($product['express']==0){//if que verifica los paquetes fedex
	
}else{
	echo "Paquete Expres: ";echo $product['express']; echo " paquetes ";
}
			
					  
					  
					  if($product['especial']==0){//if que verifica los paquetes fedex
	
}else{
	echo "Recoleccion Especial: ";echo $product['especial']; echo " paquetes ";
}
					  
					  }	}  ?>    
					  
					 <br> Notas del Operador:<?php echo $product['notas_recoleccion']; ?> <br>
					  Entrego <strong><?php echo remove_junk($product['quien_entrega']); ?></strong>
					  
					  
					  
					  
					  
					  <img src="uploads/products/<?php echo $product['file_name']; ?>" height="120"> <!--onmouseover="this.height=500;" onmouseout="this.height=110;" >-->
					  
				  </td>
               
                  </div>
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
