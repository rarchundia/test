<?php

/*
	$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recoleccion";
    
	
	$servername = "localhost";
$username = "envipaq_inven";
$password = "3nvip4q2018";
$dbname = "envipaq_recoleccion";



	
	*/

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recoleccion";




// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/*
$fecha1=$_POST["fecha1"];
$fecha2=$_POST["fecha2"];

$fecha1=$_GET["fecha1"];
$fecha2=$_GET["fecha2"];
*/

$fecha1=$_POST["fecha1"];
$fecha2=$_POST["fecha2"];

//$fecha1=$fecha1."*";
//$fecha2=$fecha2."*";
// sql to create table


$sql = " SELECT de, enviado_hora, COUNT(*) TOTAL FROM `correos` WHERE LEFT(enviado_hora, 6) BETWEEN '$fecha1' AND '$fecha2' AND de LIKE '%@envipaq.com.mx%' GROUP BY de ORDER BY TOTAL ASC";

//$sql = " SELECT de, COUNT(*) TOTAL FROM `correos` WHERE ( LEFT(enviado_hora,6)= ( SELECT DISTINCT(LEFT(enviado_hora,6)) AS fecha1 FROM correos WHERE enviado_hora LIKE '%$fecha1%' ) OR LEFT(enviado_hora,6)= ( SELECT DISTINCT(LEFT(enviado_hora,6)) AS fecha2 FROM correos WHERE enviado_hora LIKE '%$fecha2%' ) ) AND de LIKE '%@envipaq.com.mx%' GROUP BY de ORDER BY TOTAL ASC";
//$sql = "SELECT de, COUNT(*) TOTAL FROM correos WHERE de LIKE '%@envipaq.com.mx%' AND enviado_hora like '%$fecha%' GROUP BY de ORDER BY TOTAL ASC ";
//echo $sql;

$result=$conn->query($sql);

if($result->num_rows>0){
	$final_array=array();
while($row=$result->fetch_assoc()){
	
	$arr=array(
		'total'=>$row['TOTAL'],
		'de'=>$row['de'],	
		
	);
	$final_array[]=$arr;
}
	echo json_encode($final_array);
}else{
	echo "Hubo un Error";
}


/*if(isset($_POST['fecha2'])){
$fecha1=$_POST["fecha1"];
$fecha2=$_POST["fecha2"];
// sql to create table
$sql = " SELECT de, COUNT(*) TOTAL FROM correos WHERE de LIKE '%@envipaq.com.mx%' AND enviado_hora like '%$fecha%' GROUP BY de ORDER BY TOTAL ASC ";

$result=$conn->query($sql);

if($result->num_rows>0){
	$final_array=array();
while($row=$result->fetch_assoc()){
	
	$arr=array(
		'total'=>$row['TOTAL'],
		'de'=>$row['de'],	
		
	);
	$final_array[]=$arr;
}
	echo json_encode($final_array);
}else{
	echo "Hubo un Error";
}
}//fin de fecha
else{
	echo " falto seleccionar una fecha "; 
}
*/



$conn->close();
?>








<?php
?>