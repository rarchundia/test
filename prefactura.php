

	
	
	
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
		
	echo	$columna['fecha_factura'];?></strong>
		
	<br><br><br>	N<span class="grande">°  </span> Servicio <strong><?php echo $columna['id']; ?></strong>
		
		
		<br><br><br>Cliente: <strong><?php echo $columna['razon_social']; ?></strong>
		
		</td>
    </tr>
    <tr>
      <td id="domicilio" class="logo">Rumania #507<br>Portales Norte Del. Benito Juárez<br>
	facturacion<span id="arroba">@</span>envipaq.com.mx Tel. (55)5955 9595</td>
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
      <td class="td" align="right">$ <?php echo $columna['precio']; ?>.<sup>00</sup></td>
    </tr>
	  
	    
	    
	  
	  
	  
	  
   <tr class="tr">
      <td class="td">&nbsp;</td>
      
      
      <td  class="td" align="right">Total</td>
      <td class="fondo td" align="center">$ 
		  <?php echo $columna['precio']; ?><sup>.00</sup>
		  
		  
		  </td>
		
    </tr>
	 
  </tbody>
</table>

















