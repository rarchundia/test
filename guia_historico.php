<?php
  $page_title = 'Guias Envipaq';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
$catalogo = catalogo();
$operador = operador_catalogo();
?>


<?php include_once('layouts/header.php');
$usuario=$user['name'];
$medida= find_all('medida');
$products =guia_historico();






if(isset($_POST['precio_btn'])){

if(empty($errors)){
     $p_id = remove_junk($db->escape($_POST['id']));
	 $p_precio = remove_junk($db->escape($_POST['precio']));
	 $date    = make_date();
	
	$query  = " UPDATE entrega SET estatus ='50', precio ='{$p_precio}', fecha_factura='{$date}' WHERE id='{$p_id}'";
	
	 $result = $db->query($query);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Se Cargo Precio Correctamente");
            echo '<meta http-equiv="Refresh" content="0; url=guia_reporte.php">';
			  //redirect('incidencias.php', false);
          } else {
            $session->msg('d',' Lo Siento Fallo Al Agregar Precio.');
            echo '<meta http-equiv="Refresh" content="0; url=guia_reporte.php">';
			  //redirect('incidencias.php', false);
          }
}
	else{
     $session->msg("d", $errors);
    // redirect('aclaraciones.php',false);
		echo '<meta http-equiv="Refresh" content="0; url=guia_reporte.php">';
   }
	
	
	
}




?>

<link href="css/tableexport.min.css" rel="stylesheet">
<div class="row">
 <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
			
			
			
							<div class="col-md-12"><!--principio de contactos-->
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-level-up"></span>
            <span>Guias Envipaq </span>
			  <a href="guia_reporte.php" class="btn btn-info pull-right btn-sm"> Regresar</a>
          </strong>
			<div class="pull-right col-md-4">
			<input class="form-control" id="myInput" type="text" placeholder="Buscar ...">
		
    
		</div>
        </div>
        <div class="panel-body">
			
						
			
			<div class="table-responsive">
			
          <table class="table table-striped table-hover table-responsive table-fixed "> <!--table-bordered-->
            <thead>
              <tr>
                <th class="text-center">FOLIO GUIA</th>
			    <th class="text-center">RAZÓN SOCIAL</th>
				  <th class="text-center">QUIEN GENERA</th>
				  <th class="text-center">FECHA CREACIÓN</th>
                <th class="text-center">ORIGEN</th>
               <th class="text-center">DESTINO</th>
				  <th class="text-center">CARGA / REFERENCIA</th>
                <!--<th class="text-center">RUTA</th>-->
                
				  <th class="text-center">ESTATUS</th>
				  <!--<th class="text-center">COSTO</th>-->
				  <th class="text-center">GENERAR</th>
				 
              </tr>
            </thead>
            <tbody id="myTable">
				
				
              <?php foreach ($products as $product):?>
              <tr>
				  <td class="text-center"><strong><br><br><a   onclick="window.open('estatus_guia.php?id=<?php echo remove_junk($product['id']);?>', 'Guia Envipaq', 'width=700, height=600'); return false" title="Ver Rastreo" data-toggle="tooltip"><?php echo remove_junk($product['id']);?></a> </strong></td>
				
				<td class="text-center"><strong><br><br><strong><?php echo remove_junk($product['nombre']);?> </strong></td><!--RAZON SOCIAL-->
					
				  <td class="text-center">
					  <strong><br><br><strong><?php echo remove_junk($product['quien_genera']);?> </strong>
						  
						 </td>
				  
				  <td class="text-center"> <strong><br><br><strong><?php echo remove_junk($product['fecha']);?> </strong>
					
					  </td>
				  <!-- <td class="text-center"><strong><br><br> <?php
              
											
						 switch ($product['producto']) 
    {
								 case 1:
        echo "Dia Siguiente ";
        break;
								 case 2:
        echo " 2 Dias ";
        break;
								 case 3:
        echo " Terrestre ";
        break;
								 
    case 4:
        echo " Internacional ";
        break;
    case 5:
        echo "Nacional ";
        break;
    case 6:
        echo " LTL ";
        break;
    case 7:
        echo " Aereo ";
        break;
    case 8:
        echo " Maritimo ";
        break;
	 case 9:
        echo " Aduana ";
	    break;
     case 10:
        echo " Otro ";
	    break;

							case 11:
        echo " Almacén ";
	    break;
    case 21:
        echo " Cotización Día Siguiente ";
	    break;
case 22:
        echo " Cotización 2 Dias ";
	    break;
								 case 23:
        echo " Cotización Terrestre ";
	    break;
case 24:
        echo " Cotización Internacional";
	    break;
case 25:
        echo " Cotización Nacional ";
	    break;
case 26:
        echo " Cotización LTL ";
	    break;
case 27:
        echo " Cotización Aereo ";
	    break;
case 28:
        echo " Cotización Maritimo ";
	    break;
case 29:
        echo " Cotización Aduana ";
	    break;

	case 30:
        echo " Cotización Otro";
	    break;
							 case 31:
        echo " Cotización Almacén ";
	    break;

								 
								 
								 
    default:
        echo " No Tiene Cargado  Ningún Servicio ";
    }
						
					
					
					
					?>
					  
					  
					  </strong></td> fin de tipode  servicios-->
				  
                <td class="text-center align-middle" >
					
        <?php if($product['producto']==9  or $product['producto']==29){?>
					Razón Social: <strong><?php echo remove_junk($product['razon_social']);?> </strong><br>
                Origen <strong><?php echo remove_junk($product['direccion']);?> </strong><br>
					Carga: <strong><?php echo remove_junk($product['carga']);?> </strong><br><br>
					
					<?php if($product['producto']==29){
	
					?>
					
					
					
					
				  <?php 
}else{
	?>
	Puerto: <strong><?php echo remove_junk($product['puerto']);?> </strong>
			Despacho: <strong><?php echo remove_junk($product['despacho']);?> </strong><br>
	<?php	 } 
												  }
					else if( $product['producto']==11){
						?>
					Remitente <strong><?php echo remove_junk($product['remitente']);?> </strong><br>
				    Telefóno <strong><?php echo remove_junk($product['telefono']);?> </strong><br>
					Razón Social <strong><?php echo remove_junk($product['razon_social']);?> </strong><br><br>
					# de Palet's <strong><?php echo remove_junk($product['palet']);?> </strong><br>	
					Carga: <strong><?php echo remove_junk($product['carga']);?> </strong><br>
					Almacen:<strong><?php if($product['almacen']==1){
							
						echo "Servicargo";	
						}else {
					echo "Envipaq";	}?> </strong><br>
					
					Tipo de Servicio requerido <strong><?php 
						/*1 etiquetado
	   2 embalado
	   3 etiquetado + embalado
	   7 uva
	   8 etiquetado + uva
	   9 embalado + uva
	   10 etiquetado + embalado + uva  */
	   
						
						
							
							switch ($product['servicios']) 
        {
								 case 1:
        echo "Etiquetado Precio de Venta: $".$product['comer_venta'];									
        break;
									case 2:
        echo "Embalado Precio de Venta: $".$product['arance_venta'];									
        break;
									case 3:
									$resul_servicios=$product['comer_venta']+$product['arance_venta'];
        echo "Etiquetado + Embalado Precio de Venta: $".$resul_servicios;									
        break;
									
									
									
									
									case 7:
        echo "Uva Precio de Venta: $".$product['uva_venta'];									
        break;
									
									case 8:
									$resul_servicios=$product['comer_venta']+$product['uva_venta'];
        echo "Etiquetado + Uva Precio de Venta: $".$resul_servicios;									
        break;
									case 9:
									$resul_servicios=$product['arance_venta']+$product['uva_venta'];
        echo "Embalado + Uva Precio de Venta: $".$resul_servicios;										
        break;
								case 10:
									$resul_servicios=$product['arance_venta']+$product['uva_venta']+$product['comer_venta'];
        echo "Etiquetado + Emabalado + Uva Precio de Venta: $".$resul_servicios;									
        break;
						default:
        echo " No Requiere Servicios Adicionales. :( ";	
									
						}?>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
				 </strong><br>
						
					<?php 
					
					}else {?>
					Remitente <strong><?php echo remove_junk($product['remitente']);?> </strong><br>
					
					Direccion <strong><?php echo remove_junk($product['direccion']);?> </strong>
					Colonia <strong><?php echo remove_junk($product['colonia']);?> </strong>
					CP <strong><?php echo remove_junk($product['cp']);?> </strong>
					Telefóno <strong><?php echo remove_junk($product['telefono']);?> </strong>
					
				  <?php }?>
				  </td><td>
					  <?php if($product['producto']==9 or $product['producto']==29){?>
					  
					  
					Destino: <strong><?php echo remove_junk($product['direccion_des']);?> </strong><br>
					Contacto: <strong><?php echo remove_junk($product['remitente']);?> </strong><br>
					Telefono: <strong><?php echo remove_junk($product['telefono']);?> </strong><br>
					  
					  
					  
					<?php    }
					  
					  
					  else if( $product['producto']==11){
					  
					  }	  else {?>
					Destinatario <strong><?php echo remove_junk($product['nombre_destinatario']);?> </strong><br>
					Direccion <strong><?php echo remove_junk($product['direccion_des']);?> </strong>
					Colonia <strong><?php echo remove_junk($product['colonia_des']);?> </strong>
					CP <strong><?php echo remove_junk($product['cp_des']);?> </strong>
					Telefóno <strong><?php echo remove_junk($product['telefono_des']);?> </strong>
					
		
		  <?php    }?>
      	 
					
					
					
					</td>
              
                <!--<td class="text-center">
              
          
              </td>-->
				  
				<!--  <td>  <div class="modal fade" id="<?php echo remove_junk($product['id']);?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Guia: <strong> <?php echo remove_junk($product['id']);?> </strong>
			 
		  
			<br>Tipo de Servicio: <strong><?php switch ($product['producto']) 
        {
								 case 1:
        echo "Dia Siguiente ";

        break;
								 case 2:
        echo " 2 Dias ";
        break;
								 case 3:
        echo " Terrestre ";
        break;
								 
    case 4:
        echo " Internacional ";
        break;
    case 5:
        echo "Nacional ";
        break;
    case 6:
        echo " LTL ";
        break;
    case 7:
        echo " Aereo ";
        break;
    case 8:
        echo " Maritimo ";
        break;
	 case 9:
        echo " Aduana ";
	    break;
     case 10:
        echo " Otro ";
	    break;

							case 11:
        echo " Almacén ";
	    break;
    case 21:
        echo " Cotización Día Siguiente ";
	    break;
case 22:
        echo " Cotización 2 Dias ";
	    break;
								 case 23:
        echo " Cotización Terrestre ";
	    break;
case 24:
        echo " Cotización Internacional";
	    break;
case 25:
        echo " Cotización Nacional ";
	    break;
case 26:
        echo " Cotización LTL ";
	    break;
case 27:
        echo " Cotización Aereo ";
	    break;
case 28:
        echo " Cotización Maritimo ";
	    break;
case 29:
        echo " Cotización Aduana ";
	    break;

	case 30:
        echo " Cotización Otro";
	    break;
							 case 31:
        echo " Cotización Almacén ";
	    break;

								 
								 
								 
    default:
        echo " No Tiene Cargado  Ningún Servicio ";
    }
			?></strong></h4>
		  <?php //if($product['producto']==9){
		  
		  if($product['compra']!=0){?>
					
		  Valor Compra $<strong><?php echo remove_junk($product['compra']);?><sup>.00</sup> </strong><?php //if($product['producto']==9){
		  
								  }?>
					Valor Venta $<strong><?php echo remove_junk($product['venta']);
					$ganancia=$product['venta']-$product['compra'];
					
					?><sup>.00</sup> </strong>
					Ganacia $<strong><?php echo $ganancia;?><sup>.00</sup> </strong>
		  
		   <?php //}?>
		  
		  
      </div><div class="modal-body">
		<h3><?php echo remove_junk($product['fecha']); ?>
 <?php echo remove_junk($product['detalles']); ?></h3></div>
      
		<hr><br>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		<div class="modal-footer">
	
		<form method="post" action="entrega.php" class="clearfix">
					
					<input type="hidden" id="id_nota" name="id_nota" value="<?php echo remove_junk($product['id']);?>">
					<input  type="hidden" id="nota_server" name="nota_server" value=" <?php echo remove_junk($product['detalles']);?> ">	
					<input type="hidden" id="user_name" name="user_name" value="<?php echo remove_junk(ucfirst($user['name'])); ?>">
					
 
  <textarea id="adicional_nota" name="adicional_nota" class="md-textarea form-control" rows="3"  style="background-color:aliceblue; " placeholder="Aqui Puedes Agregar Una Nota Adicional"></textarea>

					<CENTER> <button type="submit" name="nota_adicional" class="btn btn-default" style="background-color:aliceblue; ">Agrega Una Nota</button>
    </CENTER>
     </form>
			
			<button type="button" class="btn btn btn-danger" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div></div>

                           <br>
       
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?php echo remove_junk($product['id']);?>"><i class='glyphicon glyphicon-plus' style="font-size:20px;color:red;" title="Click Para Ver Los Detalles" data-toggle="tooltip"></i> Expandir</button>
								 </td>-->
					  
					 <td>
				  
				<strong> Carga:</strong> <?php echo remove_junk($product['carga']); ?> / <br>
						 <strong>Referencias: </strong><?php echo remove_junk($product['detalles']); ?>
						 
				  </td>
				  
				  
                <td class="text-center">
					 
					 <?php 
					 if($product['estatus']==1){
						  
						 echo "<br><i class='glyphicon glyphicon-ok' style='color: green;' title='Entregada' data-toggle='tooltip'></i>";
					  }
					 
					 if($product['estatus']==50){
						  
						  echo "<br><i class='glyphicon glyphicon-ok-circle' style='color: green;' title='Entregada y Facturada' data-toggle='tooltip'></i>";
					  }
					if($product['estatus']==55){
						  
						  echo "<br><i class='glyphicon glyphicon-ban-circle' style='color: purple;' title='Recoleccion en Falso con Cobro' data-toggle='tooltip'></i>";
					  }
					
					 if($product['estatus']==2){
						  
						  echo "<br>Asignada a Reparto";
					  }
					 if($product['estatus']==99){
						  
						  echo "<br><i class='glyphicon glyphicon-remove-circle' style='color: red;' title='Guia Cancelada' data-toggle='tooltip'></i>";
					  }
					 if($product['estatus']==0){
						 echo "<br>Aun no se ha Asignado a Reparto";
					  }  
					 
					 
					 ?>
					 
				  </td>
				 <!--<td valign="middle">
				  <br>
				 $<?php echo remove_junk($product['precio']);?>
					  
				  </td>-->
				  <td class="align-middle" >
				  
					 
					 <button type="button" onclick="window.open('prefactura.php?id=<?php echo remove_junk($product['id']);?>&guias=3', 'Guia Envipaq PDF ', 'width=800, height=600'); return false"><img src="libs/images/pdf.png" width="43"  ></button>
				  
				  
				  </td>
				  
              </tr> 
             <?php endforeach; ?>
            </tbody>
          </table>
			
			
			
			
			
			
			
			</div>





			
			
		 </div>
   </div>
  </div>  </div> 	
			
		<script src="js/FileSaver.min.js"></script>
<script src="js/Blob.min.js"></script>
<script src="js/xls.core.min.js"></script>
<script src="js/dist/js/tableexport.js"></script>		
	<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
		
	 $("table").tableExport({
	formats: ["xlsx", "csv"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
	position: 'top',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: true,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "Guias_Envipaq_historico",    //Nombre del archivo 
});
	
		
</script>

			
<?php include_once('layouts/footer.php'); ?>
