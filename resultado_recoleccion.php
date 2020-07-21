<?php

$usuario = "envipaq_inven";
	$password = "3nvip4q2018";
	$servidor = "localhost";
	$basededatos = "envipaq_recoleccion";
	 
/*$usuario = "root";
	$password = "";
	$servidor = "localhost";
	$basededatos = "recoleccion";*/
$connection = mysqli_connect($servidor,$usuario,$password,$basededatos); 


if($connection === false) { 
 echo 'Ha habido un error <br>'.mysqli_connect_error(); 
}




$consultaBusqueda = $_POST['valorBusqueda']; //Variable de búsqueda


$mensaje = "";


	$sql   = "SELECT r.id, r.direccion, r.numero, r.colonia, r.delegacion, r.cp, r.totalp, r.alto, r.ancho, r.largo, r.peso, r.nombre, r.id_empresa, r.fechaprogramar, r.fechasolicitud, r.notas, r.medida, r.id_operador, r.telefono, r.correo, r.alianza, r.cp_des, r.asignado, r.estatus, r.paqueteria, p.id_recolecta, p.quien_entrega, p.envipaq, p.fedex, p.estafeta, p.redpack, p.express, p.especial, p.notas AS notas_recoleccion, p.fecha AS fecha_queserecolecto, p.total AS total_recolectado, m.file_name, m.file_type, m.fecha, m.id_recoleccion
  FROM recolecta r 
  LEFT JOIN paqueteria p ON p.id_recolecta=r.id
  LEFT JOIN media m ON m.id_recoleccion=r.id	";

$sql  .= " WHERE r.nombre LIKE '%$consultaBusqueda%' OR r.id_empresa LIKE '%$consultaBusqueda%' OR r.telefono LIKE '%$consultaBusqueda%' OR r.correo LIKE '%$consultaBusqueda%'";
	
	$consulta = mysqli_query($connection,$sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 

		while($resultados = mysqli_fetch_array($consulta)) {
			$id= $resultados['id'];
		
		
		$nombre = $resultados['nombre'];
		$empresa = $resultados['id_empresa'];
		$telefono = $resultados['telefono'];
		$correo = $resultados['correo'];
	    $fecha = $resultados['fechasolicitud'];
			
			//Output
			$mensaje .= '
			
			<p><h4>
			<strong>Nombre:</strong> ' . $nombre . '
			<strong>Empresa:</strong> ' . $empresa. '
			<strong>Telefono:</strong> ' . $telefono . '
			<strong>Correo:</strong> ' . $correo . '  
			<strong>Fecha Solicitud:</strong> ' . $fecha . '		 
					 <a href="busqueda_recoleccion.php?id='.(int)$id.'" title="Ver Los Detalles de la Recoleccion " >
                     <span class="glyphicon glyphicon-search"></span>Visualiza Datos Completos</a></h4>
			
			';		};
			
			
			echo $mensaje;
?>