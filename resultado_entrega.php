<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
       <link rel="stylesheet" href="libs/css/main.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<?php


$usuario = "envipaq_inven";
	$password = "3nvip4q2018";
	$servidor = "localhost";
	$basededatos = "envipaq_recoleccion";
	 
$connection = mysqli_connect($servidor,$usuario,$password,$basededatos); 


if($connection === false) { 
 echo 'Ha habido un error <br>'.mysqli_connect_error(); 
}




$consultaBusqueda = $_POST['valorBusqueda']; //Variable de búsqueda


$mensaje = "";


	$sql   = "SELECT r.id, r.guia, r.razon_social, r.remitente, r.direccion, r.colonia, r.cp, r.telefono, r.razonsocial_des, r.nombre_destinatario, r.direccion_des, r.colonia_des, r.cp_des, r.telefono_des, r.id_operador, r.fecha, r.correo, r.seguro, r.estatus, r.fecha_entrega, r.recibido
  , r.asignado, r.primera, r.primera_fecha, r.segunda, r.segunda_fecha, r.tercera, r.tercera_fecha, r.producto, r.notas_entrega,  m.file_name, m.file_type, m.fecha, m.id_entrega
  FROM entrega r 
    LEFT JOIN media m ON m.id_entrega=r.id 	";
   $sql  .= " WHERE r.guia LIKE '%$consultaBusqueda%' OR r.remitente LIKE '%$consultaBusqueda%' OR r.nombre_destinatario LIKE '%$consultaBusqueda%' OR r.recibido LIKE '%$consultaBusqueda%'";
	
	$consulta = mysqli_query($connection,$sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 

		while($resultados = mysqli_fetch_array($consulta)) {
			$id= $resultados['id'];
		
		
		//$id = $resultados['id'];
		$remitente = $resultados['remitente'];
		$destinatario = $resultados['nombre_destinatario'];
		$quien_recibio = $resultados['recibido'];
			
			//Output
			$mensaje .= '
			
		<div	class="alert alert-primary">
			<strong># de Guia:</strong> ' . $id . '
			<strong>Remitente:</strong> ' . $remitente. '
			<strong>Destinatario:</strong> ' . $destinatario . '
			<strong>Quien Recibio:</strong> ' . $quien_recibio . '  
					 
					 <a href="busqueda_entrega.php?id='.(int)$id.'" title="Ver Los Detalles de la Entrega " >
                     <span class="glyphicon glyphicon-search"></span>Visualiza Datos Completos</a>
			</div>

			';		};
			
			
			echo $mensaje;

?>
<script src="libs/js/jquery.min.js"></script>
  <script src="libs/js/bootstrap.min.js"></script>
  <script src="libs/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="libs/js/functions.js"></script>
 
