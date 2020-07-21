<?php
ob_start();
$usuario = "root";
	$password = "";
	$servidor = "localhost";
	$basededatos = "recoleccion";
	/*
	$usuario = "root";
	$password = "";
	$servidor = "localhost";
	$basededatos = "recoleccion";
	
	$usuario = "envipaq_inven";
	$password = "3nvip4q2018";
	$servidor = "localhost";
	$basededatos = "envipaq_recoleccion";
	*/

	$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
	
	$db = mysqli_select_db( $conexion, $basededatos ) or die ( "No se Puede establecer conexion con la base de datos" );
	
	



$id=$_GET['id'];
	
 $sql   = " SELECT id,remitente, direccion, colonia, cp, nombre_destinatario, direccion_des, colonia_des, cp_des, telefono_des, correo, fecha, producto ";
 $sql  .= " FROM entrega";
 $sql  .= " WHERE id ='{$id}' LIMIT 1 ";
  
   
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	

	



	while ($columna = mysqli_fetch_array( $resultado ))
	{


 
?>


<strong><br><br>
<table width="237mm" border="0">
  <tbody>
    <tr>
     
     <!--inicio qr-->
		<td width="65mm" align="right" valign="top" style="padding-left: 20px;" >
		
				<br><qrcode value="Numero de Guia: <?php echo $columna['id']; ?> Remitente: <?php echo $columna['remitente']; ?> Origen: <?php echo $columna['direccion'];  ?> Colonia: <?php echo $columna['colonia'];  ?> CP: <?php echo $columna['direccion'];  ?> Destino: <?php echo $columna['direccion_des'];  ?> Colonia: <?php echo $columna['colonia'];  ?> CP: <?php echo $columna['cp_des'];  ?> Nombre: <?php echo $columna['nombre_destinatario'];  ?> Telefono: <?php echo $columna['telefono_des'];  ?>"
					ec="H" style="width: 40mm; background-color: white; color: black;padding-left:15px;" ></qrcode>
			<span style="text-align: right"></span>
			
	</td><!--codigo qr fin-->
		<td width="60mm" align="right" valign="top" style="table-layout: fixed;">
			 
	  <p></p><p></p><img src="libs/images/logos/envipaq.gif" width="160" alt="" style="float:left;" hspace="5" vspace="5" / > </td>
		

      
		
		<td rowspan="16"><blockquote> <img src="libs/images/lineas.png" width="35" height="700" alt=""/></blockquote> </td>
    
		<th rowspan="16" width="100mm" style="font-size: 10px;"><!--comienzo de contrato-->
		
		CONTRATO DE PRESTACION DE SERVICIOS DE MENSAJERIA O PAQUETERIA<br>que celebran, por su parte, ENVIPAQ S.A DE C.V., constituida conforme a la ley<br> mexicana del 8 de septiembre de 1979, en escritura 31,464, ante el notario <br>28 del D.F., a quien en lo sucesivo se le denominara “ENVIPAQ” y por otra parte <br>“EL REMITENTE” cuyos datos figuran en el adverso de esta GUIA.<br><br>
		Las partes dan su conformidad a la modalidad del servicio contratado, e <br>instituciones señaladas en el anverso de esta GUIA, el cual se sujeta a las<br> siguientes clausulas. <br><br>
		  
		CLAUSULAS.<br><br>
PRIMERA. - ENVIPAQ se obliga para con EL REMITENTE a entregar el ENVIO<br> en el domicilio del destinatario en los términos e instrucciones descritos en<br> el anverso de esta GUIA.<br><br>

		  
		  SEGUNDA. - ENVIPAQ se obliga a entregar puntualmente el envió siempre y<br> cuando a las líneas transportistas hayan cumplido con sus horarios oficiales.<br> El plazo se contará a partir de la recepción y documentación del ENVIO, por lo <br>que deben considerarse los plazos de entrega de ENVIPAQ publicados en su <br>lista de precios, la cual estará a la vista del público.<br><br>
		  
		  TERCERA. -  REMITENTE se obligará para con ENVIPAQ:<br>
<blockquote>a)	A pagar la tarifa y los impuestos del servicio;<br>
b)	A responder de la veracidad de lo declarado en el anverso de esta GUIA,<br> manifestando bajo protesta de decir la verdad que posee legalmente el ENVIO<br> y que cuenta con la facultad para celebrar este contrato;<br>

	c)	A sacar en paz y a salvo ENVIPAQ, así como a su personal, representantes<br> y transportistas de cualquier reclamación de simple recibo los daños y <br>perjuicios en los que haya incurrido;<br>
	
d)	A pagar contra entrega del ENVIO los gastos y costos por almacenaje y/o<br> devolución del ENVIO a su lugar de origen, motivado por errores no<br> imputables a ENVIPAQ.<br>
</blockquote>
		
		  
		  CUARTA. - EL EMITENTE reconoce y acepta:<br>

		<blockquote>  a)	El servicio será presentado siempre y cuando EL REMITENTE haya <br>insertado inequívocamente los datos de la guía.<br>

		  b)	ENVIPAQ elegirá el transporte.<br>

		  c)	Si el contenido no concuerda con lo declarado o es de aquellos <br>comprendidos en la cláusula décima, ENVIPAQ queda automáticamente<br> liberada de sus obligaciones y avisara a EL REMITENTE sobre el lugar y las<br> condiciones del ENVIO para que este asuma sus responsabilidades.<br>

		  d)	ENVIPAQ tiene derecho mas no la obligación de inspeccionar EL ENVIO por<br> lo que podrá exigir al REMITENTE su apertura y reconocimiento, si este<br> rehusare, ENVIPAQ quedará libre de cualquier responsabilidad.<br>

		  e)	ENVIPAQ tendrá el derecho de retener el ENVIO cuando el REMITENTE le<br> adeude cargos por el servicio contratado, sin prejuicio de que este deduzca<br> las acciones que le correspondan.<br>

		  </blockquote>
		  
		
		  
	  </th> <!--fin de contrato-->
    </tr>
    <tr>
      <td align="right">Origen: </td>
      <td>Dirección: <?php echo $columna['direccion']; ?><br> Colonia: <?php echo $columna['colonia']; ?><br>
		
		CP: <?php echo $columna['cp']; ?> 
		</td>
		<br><br>
		
		
      
     
     
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
     
    </tr>
    <tr>
      <td align="right">Destino: </td>
      <td>Dirección: <?php echo $columna['direccion_des']; ?><br> Colonia: <?php echo $columna['colonia_des']; ?><br>
		
		CP: <?php echo $columna['cp_des']; ?> Teléfono: <?php echo $columna['telefono_des']; ?>
		</td>
     
    </tr>
    <tr>
      <td align="right">Contacto: </td>
      <td><strong><?php echo $columna['nombre_destinatario']; ?></strong></td>
     
    </tr>
    <tr>
		<td><blockquote>Tipo de Servicio: <?php 
			
			switch ($columna['producto']) 
    {
    case 1:
        echo "Día Siguiente";
			break;
    case 2:
        echo "Dos Dias";
        break;
					
    case 3:
        echo "Terrestre";
        break;
					
					
    case 4:
        echo "Internacional";
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
					
			default:
        echo "Terrestre";		
			}
					
			
			
			?><br><br><br><br><br>
			<img src="libs/images/checkbox.gif" >1. Intento<img src="libs/images/checkbox.gif" >2. Intento<img src="libs/images/checkbox.gif" >3. Intento<img src="libs/images/checkbox.gif" >Otra</blockquote></td>
		<td align="right" ><h3>CDMX</h3>____________________________________</td>
    </tr>
    <tr>
     
     <td colspan="2" align="center" valign="top"><blockquote><barcode dimension="1D" type="C39" value="<?php echo $columna['id'];  ?>" style="width: 120mm; color: black; 
    "></barcode></blockquote></td>
     </tr>
   
    
  </tbody>
</table></strong>


<br><br><strong>
<table width="237mm" border="0">
  <tbody>
    <tr>
     
     <!--inicio qr-->
		<td width="65mm" align="right" valign="top" style="padding-left: 20px;" >
		
				<br><qrcode value="Numero de Guia: <?php echo $columna['id']; ?> Remitente: <?php echo $columna['remitente']; ?> Origen: <?php echo $columna['direccion'];  ?> Colonia: <?php echo $columna['colonia'];  ?> CP: <?php echo $columna['direccion'];  ?> Destino: <?php echo $columna['direccion_des'];  ?> Colonia: <?php echo $columna['colonia'];  ?> CP: <?php echo $columna['cp_des'];  ?> Nombre: <?php echo $columna['nombre_destinatario'];  ?> Telefono: <?php echo $columna['telefono_des'];  ?>"
					ec="H" style="width: 40mm; background-color: white; color: black;padding-left:15px;" ></qrcode>
			<span style="text-align: right"></span>
			
	</td><!--codigo qr fin-->
		<td width="60mm" align="right" valign="top" style="table-layout: fixed;">
			 
	  <p></p><p></p><img src="libs/images/logos/envipaq.gif" width="160" alt="" style="float:left;" hspace="5" vspace="5" / > </td>
		

      
		
		<td rowspan="16"><blockquote> <img src="libs/images/lineas.png" width="35" height="700" alt=""/></blockquote> </td>
    
		<th rowspan="16" width="100mm" style="font-size: 10px;"><!--comienzo de contrato-->
		
		CONTRATO DE PRESTACION DE SERVICIOS DE MENSAJERIA O PAQUETERIA<br>que celebran, por su parte, ENVIPAQ S.A DE C.V., constituida conforme a la ley<br> mexicana del 8 de septiembre de 1979, en escritura 31,464, ante el notario <br>28 del D.F., a quien en lo sucesivo se le denominara “ENVIPAQ” y por otra parte <br>“EL REMITENTE” cuyos datos figuran en el adverso de esta GUIA.<br><br>
		Las partes dan su conformidad a la modalidad del servicio contratado, e <br>instituciones señaladas en el anverso de esta GUIA, el cual se sujeta a las<br> siguientes clausulas. <br><br>
		  
		CLAUSULAS.<br><br>
PRIMERA. - ENVIPAQ se obliga para con EL REMITENTE a entregar el ENVIO<br> en el domicilio del destinatario en los términos e instrucciones descritos en<br> el anverso de esta GUIA.<br><br>

		  
		  SEGUNDA. - ENVIPAQ se obliga a entregar puntualmente el envió siempre y<br> cuando a las líneas transportistas hayan cumplido con sus horarios oficiales.<br> El plazo se contará a partir de la recepción y documentación del ENVIO, por lo <br>que deben considerarse los plazos de entrega de ENVIPAQ publicados en su <br>lista de precios, la cual estará a la vista del público.<br><br>
		  
		  TERCERA. -  REMITENTE se obligará para con ENVIPAQ:<br>
<blockquote>a)	A pagar la tarifa y los impuestos del servicio;<br>
b)	A responder de la veracidad de lo declarado en el anverso de esta GUIA,<br> manifestando bajo protesta de decir la verdad que posee legalmente el ENVIO<br> y que cuenta con la facultad para celebrar este contrato;<br>

	c)	A sacar en paz y a salvo ENVIPAQ, así como a su personal, representantes<br> y transportistas de cualquier reclamación de simple recibo los daños y <br>perjuicios en los que haya incurrido;<br>
	
d)	A pagar contra entrega del ENVIO los gastos y costos por almacenaje y/o<br> devolución del ENVIO a su lugar de origen, motivado por errores no<br> imputables a ENVIPAQ.<br>
</blockquote>
		
		  
		  CUARTA. - EL EMITENTE reconoce y acepta:<br>

		<blockquote>  a)	El servicio será presentado siempre y cuando EL REMITENTE haya <br>insertado inequívocamente los datos de la guía.<br>

		  b)	ENVIPAQ elegirá el transporte.<br>

		  c)	Si el contenido no concuerda con lo declarado o es de aquellos <br>comprendidos en la cláusula décima, ENVIPAQ queda automáticamente<br> liberada de sus obligaciones y avisara a EL REMITENTE sobre el lugar y las<br> condiciones del ENVIO para que este asuma sus responsabilidades.<br>

		  d)	ENVIPAQ tiene derecho mas no la obligación de inspeccionar EL ENVIO por<br> lo que podrá exigir al REMITENTE su apertura y reconocimiento, si este<br> rehusare, ENVIPAQ quedará libre de cualquier responsabilidad.<br>

		  e)	ENVIPAQ tendrá el derecho de retener el ENVIO cuando el REMITENTE le<br> adeude cargos por el servicio contratado, sin prejuicio de que este deduzca<br> las acciones que le correspondan.<br>

		  </blockquote>
		  
		
		  
	  </th> <!--fin de contrato-->
    </tr>
    <tr>
      <td align="right">Origen: </td>
      <td>Dirección: <?php echo $columna['direccion']; ?><br> Colonia: <?php echo $columna['colonia']; ?><br>
		
		CP: <?php echo $columna['cp']; ?> 
		</td>
		<br><br>
		
		
      
     
     
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
     
    </tr>
    <tr>
      <td align="right">Destino: </td>
      <td>Dirección: <?php echo $columna['direccion_des']; ?><br> Colonia: <?php echo $columna['colonia_des']; ?><br>
		
		CP: <?php echo $columna['cp_des']; ?> Teléfono: <?php echo $columna['telefono_des']; ?>
		</td>
     
    </tr>
    <tr>
      <td align="right">Contacto: </td>
      <td><strong><?php echo $columna['nombre_destinatario']; ?></strong></td>
     
    </tr>
    <tr>
		<td><blockquote>Tipo de Servicio: <?php 
			
			switch ($columna['producto']) 
    {
    case 1:
        echo "Día Siguiente";
			break;
    case 2:
        echo "Dos Dias";
        break;
					
    case 3:
        echo "Terrestre";
        break;
					
					
    case 4:
        echo "Internacional";
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
					
			default:
        echo "Terrestre";		
			}
					
			
			
			?><br><br><br><br><br>
			<img src="libs/images/checkbox.gif" >1. Intento<img src="libs/images/checkbox.gif" >2. Intento<img src="libs/images/checkbox.gif" >3. Intento<img src="libs/images/checkbox.gif" >Otra</blockquote></td>
		<td align="right" ><h3>CDMX</h3>____________________________________<br><?php echo $columna['fecha'];  ?></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="top"><blockquote><barcode dimension="1D" type="C39" value="<?php echo $columna['id'];  ?>" style="width: 120mm; color: black; 
    "></barcode></blockquote></td>
     
    </tr>
   
    
  </tbody>
</table></strong>


                



     <?php 
$nombre_id=$columna['id'];
		$salida_direc=$columna['direccion_des'];
		$salida_cp=$columna['cp_des'];
	}
   $content = ob_get_clean();
  require_once('html2pdf/html2pdf.class.php');
  try
  {
      $html2pdf = new HTML2PDF('L', 'letter', 'es', true, 'UTF-8', 3);
	  $html2pdf->pdf->SetAuthor('hades981');
      $html2pdf->pdf->SetDisplayMode('fullpage');
      $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
      $html2pdf->Output($salida_direc.'_'.$salida_cp.'_'.$nombre_id.'.pdf');
  }
  catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  }
	
   mysqli_close( $conexion );
  ?>
