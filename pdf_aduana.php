<?php


ob_start();


/*$usuario = "root";
	$password = "";
	$servidor = "localhost";
	$basededatos = "recoleccion";
	*/
	$usuario = "envipaq_inven";
	$password = "3nvip4q2018";
	$servidor = "localhost";
	$basededatos = "envipaq_recoleccion";

	$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
	
	$db = mysqli_select_db( $conexion, $basededatos ) or die ( "No se Puede establecer conexion con la base de datos" );
	
	



$id=$_GET['id'];
	
 $sql   = " SELECT id,remitente, direccion, colonia, razon_social, detalles, carga, venta, comer_venta, arance_venta, cp, nombre_destinatario, direccion_des, colonia_des, cp_des, telefono_des, correo, fecha, producto ";
 $sql  .= " FROM entrega";
 $sql  .= " WHERE id ='{$id}' LIMIT 1 ";
  
   
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	

	



	while ($columna = mysqli_fetch_array( $resultado ))
	{


 
?>
<?php //echo  $columna['id']; ?>



	
	
	
<style>



	.logo{padding-left: 30px; padding-top: 30px;
	}
	#domicilio{padding-top: 20px;}
	#fecha{padding-top: 20px; padding-right: 20px;}
	#arroba{color: red;}
	.grande{font-size: 20px;}
	table {
   width: 100%;
}
th, td {
   width: 25%;
   text-align: left;
   vertical-align: top;
}
	.fondo{background-color:darkgray;
	}
	

	
	.tabla {    
    font-size: 12px;    margin: 45px;     width: 900px; text-align: left;    border-collapse: collapse; }

.th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: #b9c9fe;
    border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; }

.td {    padding: 8px;     background: #e8edff;     border-bottom: 1px solid #fff;
    color: #669;    border-top: 1px solid transparent; }

.tr:hover td { background: #d0dafd; color: #339; }
	
	.td1 {    padding: 8px;       border-bottom: 20px solid #fff;
    color: #669;    border-top: 1px solid transparent; }
	

	
	
	
	
</style>

<table width="100%" border="0" cellpadding="0" >
  <tbody>
    <tr>
      <td class="logo"><img src="libs/images/logos/envipaq.gif" width="160" alt="" style="float:left;" hspace="5" vspace="5" / > </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="70%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td  valign="top" class="td1" id="fecha">
		  <strong>FECHA EMISIÓN: <?php 
		
	echo	$columna['fecha'];?></strong>
		
	<br><br><br>	N<span class="grande">°  </span> Servicio <strong><?php echo $columna['id']; ?></strong>
		
		
		<br><br><br>Cliente: <strong><?php echo $columna['razon_social']; ?></strong>
		
		</td>
    </tr>
    <tr>
      <td id="domicilio" class="logo">Rumania #507<br>Portales Norte Del. Benito Juárez<br>
	facturacion<span id="arroba">@</span>envipaq.com.mx Tel. 5955 9595</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
  </tbody>
</table>






<br><br><br>

<table border="0" class="tabla logo" cellpadding="3" cellspacing="0" >
	   <thead>
              <tr class="tr">
                <th class="fondo th">CANTIDAD </th>
				   <th class="fondo th">DESCRIPCIÓN</th>
                <th class="fondo th" align="right">PRECIO</th>
              </tr>
            </thead>
  <tbody class="td">
    <!--<tr>
      <td class="fondo">Cantidad </td>
      <td class="fondo" width="600px">Descripción</td>
      <td></td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="fondo">Precio</td>
    </tr>-->
    <br><tr class="tr">
      <td class="fondo td">1</td>
      <td class="td"><?php echo $columna['carga']; ?> </td>
      <!--<td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>-->
      <td class="td" align="right">$ <?php echo $columna['venta']; ?>.<sup>00</sup></td>
    </tr>
	  
	    <tr class="tr">
      <td class="fondo td"><?php 
		
		if($columna['comer_venta']!=0){
			
		?>
			
		
		1<?php }?> </td>
      <td class="td"><?php 
		
		if($columna['comer_venta']!=0){
			
		?>
			
		
		Tarifa de Comercialización<?php }?> </td>
      
      <td class="td" align="right"><?php 
		
		if($columna['comer_venta']!=0){
		echo "$ ".$columna['comer_venta'];	
		?><sup>.00</sup>
			
		
		<?php }?> </td>
		
    </tr>
	    
	  
	  
	  
	  <tr>
      <td class="fondo td"><?php 
		
		if($columna['arance_venta']!=0){
			
		?>
			
		
		1<?php }?> </td>
      <td class="td"><?php 
		
		if($columna['arance_venta']!=0){
			
		?>
			
		
		Tarifa Arancelaria<?php }?> </td>
      
      <td class="td" align="right"><?php 
		
		if($columna['arance_venta']!=0){
		echo "$ ".$columna['arance_venta'];	
		?><sup>.00</sup>
			
		
		<?php }?></td>
		
    </tr>
   <tr class="tr">
      <td class="td">&nbsp;</td>
      
      
      <td  class="td" align="right">total</td>
      <td class="fondo td" align="center">$ 
		  <?php 
		
		
		$total=$columna['arance_venta']+$columna['comer_venta']+$columna['venta'];
		echo $total ?><sup>.00</sup>
		  
		  
		  </td>
		
    </tr>
	 
  </tbody>
</table>



















<?php 
$nombre_id=$columna['id'];
		$salida_cliente=$columna['razon_social'];}
   $content = ob_get_clean();
  require_once('html2pdf/html2pdf.class.php');
  try
  {
      $html2pdf = new HTML2PDF('P', 'letter', 'es', true, 'UTF-8', 3);
	  $html2pdf->pdf->SetAuthor('hades981');
      $html2pdf->pdf->SetDisplayMode('fullpage');
      $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
      $html2pdf->Output($salida_cliente.'_'.$nombre_id.'.pdf');
	   //$html2pdf->Output($salida_cliente.'_'.$nombre_id.'.pdf','D');  //para forzar descarga
  }
  catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  }
	
   mysqli_close( $conexion );
  ?>

