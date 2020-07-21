<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');


///base de datos
require_once('includes/load.php');
$id=$_GET["id"];
//$id_user=$_GET["user"];
$date    = make_date();

$nombre_para=selecciona_nombre_user($id);//extrae el nombre del usuario(s) para quien esta dirigido el memo
foreach ($nombre_para as  $para):
$para_user=$para["nombre"];
endforeach;

$nombre_para=selecciona_nombre_usercc($id);//extrae el nombre del usuario (s) para quien estan en copia del memo
foreach ($nombre_para as  $para):
$cc=$para["nombre"];
endforeach;


//actualiza que ya lo vio el usuario en base de datos
$memo_update_envio="UPDATE memo_compartido SET fecha_visto='{$date}' WHERE id_memo='{$id}' ";
//$memo_update_envio="UPDATE memo_compartido SET fecha_visto='{$date}' WHERE id_memo='{$id}' AND id_quien_lo_ve='{$id_user}'";

$result = $db->query($memo_update_envio);
			   if($result && $db->affected_rows() === 1){
			
					 
			   }


$id_memo=consulta_memo($id);

foreach ($id_memo as  $id_m):


$asunto=ucfirst(mb_convert_case($id_m['asunto'], MB_CASE_LOWER, "UTF-8"));
$quien_genera=ucwords(mb_convert_case($id_m['name'], MB_CASE_LOWER, "UTF-8"));
$puesto=$id_m['puesto'];
$contenido=ucfirst(mb_convert_case($id_m['contenido'], MB_CASE_LOWER, "UTF-8"));

$fecha_ano=date( "Y", strtotime( $id_m['fecha'] ) ); 
$fecha_dia=date( "d", strtotime( $id_m['fecha'] ) ); 
$fecha_mes=date( "n", strtotime( $id_m['fecha'] ) ); 


$bMeses = array("void","Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$bDias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");

//$dias = $bDias[$fecha["wday"]]; //para dia en español
$meses = $bMeses[$fecha_mes];   //para mes  en español









endforeach;

if(isset($db)) { $db->db_disconnect(); } 

//fin base de datos

// genera header y footer personalizado
class MYPDF extends TCPDF {

	//  Header
public function Header() {
        // Logo
      $this->Image('libs/images/logos/envipaq_sin_logistics.jpg', 25, 10, 45, '', 'JPG', 'http://envipaq.com.mx/', '', true, 500, '', false, false, 0, false, false, false);
	 $this->Image('libs/images/logos/iconos_envipaq.jpg', 130, 20, 60, '', 'JPG', 'http://envipaq.com.mx/', '', true, 500, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        //$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
	

	//  footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
			// direccion envipaq
		$this->MultiCell(120, 3, "Rumania No. 507 Col. Portales Sur, \nCP 03300 Benito Juárez, Ciudad de México \nwww.envipaq.com.mx", 0, 'C', 0, 0, 50, '', true);
		
		// numero de pagina
		//$this->Cell(0, 1, 'Página  '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
	}
}


// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('hades981');
$pdf->SetAuthor('hades981');

// remove default header/footer
$pdf->setPrintHeader(true);
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


$pdf->AddPage('P', 'A4');  //L para horizontal  P para vertical

// new style
$style = array(
	'border' => false,
	'padding' => 0,
	'fgcolor' => array(128,0,0),
	'bgcolor' => false
);





// set color for background
$pdf->SetFillColor(255, 255, 255);



//fecha
$pdf->MultiCell(130, 10, "Ciudad de México, a ".$fecha_dia. " de ". $meses." de ".$fecha_ano.".", 0, 'R', 1, 2, 60, 45, true);

//asunto
$pdf->MultiCell(130, 10, "Asunto: ".$asunto, 0, 'R', 1, 2, 60, 60, true);


//nombre usuario
$pdf->MultiCell(140, 10, $para_user , 0, 'L', 1, 2, 20, 75, true);
$pdf->MultiCell(140, 10, "PRESENTE. ", 0, 'L', 1, 2, 20, 80, true);


//contenido del mensaje
$pdf->MultiCell(170, 150, $contenido, 0, 'L', 1, 2, 20, 90, true);

//firma
$pdf->MultiCell(170, 10, "___________________________________________", 0, 'C', 1, 2, 20, 220, true);
$pdf->MultiCell(170, 10, $quien_genera, 0, 'C', 1, 2, 20, 225, true);
$pdf->MultiCell(170, 10, $puesto, 0, 'C', 1, 2, 20, 230, true);

//con copia a
$pdf->MultiCell(170, 10, "Ccp. ".$cc, 0, 'L', 1, 2, 20, 250, true);
$pdf->MultiCell(170, 10, "Archivo.", 0, 'L', 1, 2, 20, 260, true);



// set a background color
$style = array(
	'border' => false,
	'padding' => 0,
	'fgcolor' => array(128,0,0),
	'bgcolor' => array(255,255,255),
);





$pdf->SetFont('times', 'B', 16);
$style = array(
	'border' => false,
	'padding' => 0,
	'fgcolor' => array(128,0,0),
	'bgcolor' => array(255,255,255),
);






//$pdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C');  // para una sola lines 


//$pdf->Cell(140, 40, 'A4 test 1', 1, 1, 'C');
//$pdf->Text(70, 205, 'QRCODE H');	
	









// Left position
//$style['position'] = 'L';


$pdf->lastPage();

// ---------------------------------------------------------


//Close and output PDF document
$pdf->Output('Memo_'.$id.".pdf", 'I');

//============================================================+
// END OF FILE
//============================================================+
//if(isset($db)) { $db->db_disconnect(); }





?>

 