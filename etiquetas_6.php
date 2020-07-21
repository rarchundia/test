<?php
ob_start();

    $usuario = "root";
	$password = "";
	$servidor = "localhost";
	$basededatos = "importex1";
	
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
//$veces=$_GET["guias"];
//$veces=($veces-1);
//$i=1;
 $sql   = " SELECT * ";
 $sql  .= " FROM export_report";
 $sql  .= " WHERE id ='{$id}' LIMIT 1 ";
  
   
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	


/*while ($i<= $veces )
	{*/
	while ($columna = mysqli_fetch_array( $resultado ))
	{
   //for ($i = 1; $i <=$veces; $i++) {
        
   $awb=$columna['awb'];
$swb_mod = str_replace("-MEX-", " - ", $awb);
?>

<body style=" margin: 20px;">
   
    
<table width="100%" border="0">
  <tbody>
    <tr>
    <?php for ($i = 1; $i <= 6; $i++) {
    if($i==3)echo "<tr>";
  ?>
        <td>
          
          
          <table width="100%" border="1">
        <tbody>
          <tr>
            <td colspan="2" style="border-left: 0px; border-right: 0px; border-bottom: 0px; border-top: 0px;"><img src="able.png" width="50px" height="50px" alt=""/>
            </td>
          </tr>
          <tr>
            <td style="border-right: 0px; border-bottom: 0px;">Air Waybill No. </td>
            <td style="border-left: 0px; border-bottom: 0px;">&nbsp;</td>
          </tr>
          <tr>
              <td colspan="2" style="text-align:center; border-top: 0px;"><h2><?php echo $swb_mod; ?></h2></td>
            </tr>
          <tr>
            <td style="border-right: : 0px; border-bottom: 0px;">Destination</td>
            <td style="border-left: 0px; border-bottom: 0px;">Total No. of Pieces </td>
          </tr>
          <tr>
            <td style="text-align:center; border-right: : 0px; border-top: 0px;"><h2><?php echo $columna['a_to']; ?></h2></td>
              <td style="text-align:center; border-left: 0px; border-top: 0px;"><h2><?php echo $columna['pieces']; ?></h2></td>
          </tr>
          <tr>
            <td style="border-right: 0px; border-bottom: 0px;">Airline</td>
            <td style="border-left: 0px; border-bottom: 0px;">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"  style="text-align:center; border-left: 0px; border-top: 0px;"><h2><?php echo $columna['pieces']; ?></h2></td>
            </tr>
          
        </tbody>
      </table>       
         
          
          </td>
         <?php if($i==3)echo "</tr>";
}
  ?>
        
     
      
    </tr>
     
  </tbody>
</table>


    
</body>
     <?php 
	
								//   }//fin de for

$nombre_id=$columna['id'];
//	$salida_empresa=$columna['direccion_des'];
//		$salida_cp=$columna['cp_des'];
	
	//$i++;
	}
//}
   $content = ob_get_clean();
  require_once('html2pdf/html2pdf.class.php');
  try
  {
      $html2pdf = new HTML2PDF('p', 'letter', 'es', true, 'UTF-8', array(13, 13, 10, 10));
	  $html2pdf->pdf->SetAuthor('hades981');
      $html2pdf->pdf->SetDisplayMode('fullwidth');
      $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
      $html2pdf->Output($nombre_id.'.pdf');
	 
  }
  catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  }
	
   mysqli_close( $conexion );
  ?>
