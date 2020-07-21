<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');


///base de datos
require_once('includes/load.php');
$id=$_GET["id"];
$id_pdf=guia_pdf($id);

foreach ($id_pdf as  $id_p):

$qr="Numero de Guia: ".$id_p['id']. " Remitente: ". $id_p['remitente']." Origen: ". $id_p['direccion']." Colonia: ".$id_p['colonia']." CP: ". $id_p['direccion']." Destino: ". $id_p['direccion_des'] ." Colonia: ". $id_p['colonia_des']." CP: ".$id_p['cp_des']." Nombre: ". $id_p['nombre_destinatario']." Teléfono: ". $id_p['telefono_des']; 

$origen=$id_p['direccion']." Col. ".$id_p['colonia']." \n CP: ".$id_p['cp'];

$destino=$id_p['direccion_des']." Col. ".$id_p['colonia_des']." \n CP: ".$id_p['cp_des'];

$contacto=$id_p['nombre_destinatario']."\n Teléfono.  ".$id_p['telefono_des'];

$fecha_creacion=$id_p['fecha'];
endforeach;

if(isset($db)) { $db->db_disconnect(); } 

//fin base de datos

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Página  '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
	}
}


// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('hades981');
$pdf->SetAuthor('hades981');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(10, PDF_MARGIN_TOP, 10);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/spa.php')) {
	require_once(dirname(__FILE__).'/lang/spa.php');
	$pdf->setLanguageArray($l);
}

 
// define barcode style
$style = array(
	'position' => '',
	'align' => 'C',
	'stretch' => false,
	'fitwidth' => true,
	'cellfitalign' => '',
	'border' => true,
	'hpadding' => 'auto',
	'vpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => 8,
	'stretchtext' => 4
);
// ---------------------------------------------------------








$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');




// set font
$pdf->SetFont('times', 'B', 12);


$pdf->AddPage('L', 'A4');

// new style
$style = array(
	'border' => false,
	'padding' => 0,
	'fgcolor' => array(128,0,0),
	'bgcolor' => false
);



// QRCODE,H : QR-CODE Best error correction
$pdf->write2DBarcode($qr, 'QRCODE,H', 20, 20, 40, 40, $style, 'N');

$pdf->Image('libs/images/logos/envipaq.JPG', 100, 20, 43, 49, 'JPG', 'http://envipaq.com.mx/', '', true, 160, '', false, false, 0, false, false, false);

// set color for background
$pdf->SetFillColor(255, 255, 255);
///origen 
$pdf->MultiCell(30, 10, "Origen:", 0, 'R', 1, 2, 20, 70, true);
$pdf->MultiCell(95, 30, $origen, 0, 'L', 1, 2, 50, 70, true);

///destino
$pdf->MultiCell(30, 10, "Destino:", 0, 'R', 1, 2, 20,100, true);
$pdf->MultiCell(95, 30, $destino, 0, 'L', 1, 2, 50, 100, true);

///contacto
$pdf->MultiCell(30, 10, "Contacto:", 0, 'R', 1, 2, 20,130, true);
$pdf->MultiCell(95, 15, $contacto, 0, 'L', 1, 2, 50, 130, true);


///intentos de entrega
$pdf->Image('libs/images/checkbox1.jpg', 20, 145, 25, 10, 'JPG', '', '', true, 200, '', false, false, 0, false, false, false);
$pdf->Image('libs/images/checkbox2.jpg', 20, 155, 27, 10, 'JPG', '', '', true, 200, '', false, false, 0, false, false, false);
$pdf->Image('libs/images/checkbox3.jpg', 50, 145, 25, 10, 'JPG', '', '', true, 200, '', false, false, 0, false, false, false);
$pdf->Image('libs/images/checkbox4.jpg', 50, 155, 13, 10, 'JPG', '', '', true, 200, '', false, false, 0, false, false, false);
$pdf->MultiCell(95, 20, "CDMX \n\n ________________________________ \n ".$fecha_creacion, 0, 'R', 1, 2, 50, 145, true);

$pdf->Ln(1);
// set a background color
$style = array(
	'border' => false,
	'padding' => 0,
	'fgcolor' => array(128,0,0),
	'bgcolor' => array(255,255,255),
);


// CODE 128 AUTO
$pdf->write1DBarcode($id, 'C128', 20, '', '', 10, 1.4, $style, 'C');

$pdf->Ln(2);



///dobles 
$pdf->MultiCell(5, 150, "|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n|\n", 0, 'J', 1, 2, 148, 20, true);
//$pdf->Image('images/image_demo.jpg',  1, 2, 148, 20, 'JPG', 'http://envipaq.com.mx/', '', true, 5, '', false, false, 1, false, false, false);


// set font
$pdf->SetFont('times', 'B', 8.5);
$html='CONTRATO DE PRESTACION DE SERVICIOS DE MENSAJERIA O PAQUETERIA que celebran, por su parte, ENVIPAQ S.A DE C.V., constituida conforme a la ley mexicana el 01 de octubre de 2010, en escritura 256,213, ante el notario 6  de la cdmx, a quien en lo sucesivo se le denominara “ENVIPAQ” y por otra parte “EL REMITENTE” cuyos datos figuran en el adverso de esta GUIA.
		Las partes dan su conformidad a la modalidad del servicio contratado, e instituciones señaladas en el anverso de esta GUIA, el cual se sujeta a las siguientes clausulas. <br><br>
		CLAUSULAS.

<br><br>
PRIMERA. - ENVIPAQ se obliga para con EL REMITENTE a entregar el ENVIO en el domicilio del destinatario en los términos e instrucciones descritos en el anverso de esta GUIA.
<br><br>
		  
		  SEGUNDA. - ENVIPAQ se obliga a entregar puntualmente el envió siempre y cuando a las líneas transportistas hayan cumplido con sus horarios oficiales. El plazo se contará a partir de la recepción y documentación del ENVIO, por lo que deben considerarse los plazos de entrega de ENVIPAQ publicados en su lista de precios, la cual estará a la vista del público.
	<br>	  <br>
		  TERCERA. -  REMITENTE se obligará para con ENVIPAQ:
<blockquote>a)	A pagar la tarifa y los impuestos del servicio;<br>
b)	A responder de la veracidad de lo declarado en el anverso de esta GUIA, manifestando bajo protesta de decir la verdad que posee legalmente el ENVIO y que cuenta con la facultad para celebrar este contrato;<br>

	c)	A sacar en paz y a salvo ENVIPAQ, así como a su personal, representantes y transportistas de cualquier reclamación de simple recibo los daños y perjuicios en los que haya incurrido;<br>
	
d)	A pagar contra entrega del ENVIO los gastos y costos por almacenaje y/o devolución del ENVIO a su lugar de origen, motivado por errores no imputables a ENVIPAQ.
</blockquote>
		
		  
		  CUARTA. - EL EMITENTE reconoce y acepta:

		<blockquote>  a)	El servicio será presentado siempre y cuando EL REMITENTE haya insertado inequívocamente los datos de la guía.<br>

		  b)	ENVIPAQ elegirá el transporte.<br>

		  c)	Si el contenido no concuerda con lo declarado o es de aquellos comprendidos en la cláusula décima, ENVIPAQ queda automáticamente liberada de sus obligaciones y avisara a EL REMITENTE sobre el lugar y las  condiciones del ENVIO para que este asuma sus responsabilidades.

		  d)	ENVIPAQ tiene derecho mas no la obligación de inspeccionar EL ENVIO por lo que podrá exigir al REMITENTE su apertura y reconocimiento, si este rehusare, ENVIPAQ quedará libre de cualquier responsabilidad.<br>
		  e)	ENVIPAQ tendrá el derecho de retener el ENVIO cuando el REMITENTE le adeude cargos por el servicio contratado, sin prejuicio de que este deduzca las acciones que le correspondan.
		  </blockquote>
		
';




///clausulas de la guia


//$pdf->writeHTMLCell	(135, 155, '', '', $html, 1, 'J', 1, 2, 151, 20, true);

$pdf->writeHTMLCell	(135, 157, 151, 20, $html,0, 1, 0, true, 'J', true);


//para html
//$pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'R', true);



$pdf->SetFont('times', 'B', 16);
$style = array(
	'border' => false,
	'padding' => 0,
	'fgcolor' => array(128,0,0),
	'bgcolor' => array(255,255,255),
);
///codigo de barras 128
$pdf->MultiCell(130, 5, $id, 0, 'C', 1, 2, 20, 175, true);

// Multicell test






//$pdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C');  // para una sola lines 


//$pdf->Cell(140, 40, 'A4 test 1', 1, 1, 'C');
//$pdf->Text(70, 205, 'QRCODE H');	
	









// Left position
//$style['position'] = 'L';


$pdf->lastPage();

// ---------------------------------------------------------


//Close and output PDF document
$pdf->Output('Env'.$id_p['id'].'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
//if(isset($db)) { $db->db_disconnect(); }
?>

 