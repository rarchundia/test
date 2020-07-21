<?php $usuario = "root";
	$password = "";
	$servidor = "localhost";
	$basededatos = "inventario";
	
	$conexion = mysqli_connect( $servidor, $usuario, "" ) or die ("No se ha podido conectar al servidor de Base de datos");
	
	$db = mysqli_select_db( $conexion, $basededatos ) or die ( "No se Puede establecer conexion con la base de datos" );
	?>