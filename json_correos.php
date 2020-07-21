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

//if(isset($_POST['fecha'])){
$fecha=$_POST["fecha"];
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
/*}//fin de fecha
else{
	echo " falla "; 
}*/


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