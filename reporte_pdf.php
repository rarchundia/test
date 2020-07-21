<?php
  $page_title = 'Genera PDF';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(4);
  
?>
<?php 
include_once('layouts/header.php');
 $products = reporte_pdf();
 ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
		
		 <!--<div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-search"></i>
                  </span>
        
                  <input type="text" class="form-control" name="busqueda_recoleccion" id="busqueda_recoleccion" value="" placeholder="Busca por Nombre Quien Solicita, Empresa, Telefono, Correo" autocomplete="off" onKeyUp="buscar_recoleccion();" align="left" />
		
						 </div></div>
		
		<div class="col-md-6">
		<form class="clearfix" method="post" action="rango_recoleccion.php">
            <div class="form-group">
                <div class="input-group">
                  <input type="text" class="datepicker form-control" name="fecha"  autocomplete="off" placeholder="Primera Fecha Entrega" required title="Selecciona un Rango de Fechas de Recoleccion Para Generar el reporte" data-toggle="tooltip">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
                  
                     <input type="text" class="datepicker form-control" name="fecha2"  autocomplete="off" placeholder="Segunda Fecha Entrega" required>
										</div>
<button type="submit" name="fecha_entrega" class="btn btn-primary btn-block">Generar Reporte</button>
            </div>
          </form>
		
		</div>
		-->
		
		
		
		
		
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Genera PDF de Entregas <?php 
	
	//$fecha_rango1=strftime("%d %B del %Y", strtotime(date("d/m/Y"))) ;
	//echo $fecha_rango1;
	echo date("d/m/Y");?></strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered"> 
            <thead>
              <tr>
                <th class="text-center">Folio Guia</th>
                <th class="text-center">REMITENTE</th>
                <th class="text-center">DESTINO</th>
                <!--<th class="text-center">RUTA</th>-->
                <th class="text-center">Genera PDF</th>
                
              </tr>
            </thead>
            <tbody>
				<div id="resultadoBusqueda" style="background-color:rosybrown"></div>
				
              <?php foreach ($products as $product):?>
              <tr>
				  <td class="text-center"><strong><br><br><br><?php echo remove_junk($product['id']);?> </strong></td>
                <td class="text-center">
					Remitente <strong><?php echo remove_junk($product['remitente']);?> </strong><br>
					Razón Social <strong><?php echo remove_junk($product['razon_social']);?> </strong><br><br>
					Direccion <strong><?php echo remove_junk($product['direccion']);?> </strong>
					Colonia <strong><?php echo remove_junk($product['colonia']);?> </strong>
					CP <strong><?php echo remove_junk($product['cp']);?> </strong>
					Telefóno <strong><?php echo remove_junk($product['telefono']);?> </strong>
					</td>
                
				  
				  
				  <td class="text-center">
					  
					Destinatario <strong><?php echo remove_junk($product['nombre_destinatario']);?> </strong><br>
					Razón Social <strong><?php echo remove_junk($product['razonsocial_des']);?> </strong><br><br>
					Direccion <strong><?php echo remove_junk($product['direccion_des']);?> </strong>
					Colonia <strong><?php echo remove_junk($product['colonia_des']);?> </strong>
					CP <strong><?php echo remove_junk($product['cp_des']);?> </strong>
					Telefóno <strong><?php echo remove_junk($product['telefono_des']);?> </strong>
					
					  
					</td>
              
                <!--<td class="text-center">
              
              
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
        echo "<br><br> Norte ";
        break;
    case 6:
        echo " <br><br>Sur ";
        break;
    case 7:
        echo "<br><br> Oriente ";
        break;
    case 8:
        echo "<br><br> Poniente ";
        break;
        
    default:
        echo "<br><br> Aun No Esta Asignado a Ninguna Ruta ";
    }
						
					
					
					
					?>
              </td>-->
				  <td>
					  
					  <br>
			  		<a href="pdf_entrega.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Generar PDF Entrega" data-toggle="tooltip">
                     <img src="libs/images/pdf.png" width="55" height="55" >
                    </a>
			  		
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
