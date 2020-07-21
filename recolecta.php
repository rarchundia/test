<!DOCTYPE html>
  <html lang="es"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <title>Recolecta</title>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<!--
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
    <link rel="shortcut icon" href="../libs/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../libs/images/favicon.ico" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<style type="text/css">

h1{
	
	position:relative;
	text-align:center;
	text-transform:capitalize;
	
	}


dispositivos móviles ----------- */
/* cambios css para modo vertical y horizontal */
@media only screen
  and (min-width: 320px) 
  and (max-width: 736px)
{
  /* inserta aquí tu código */
}
 
/* cambios css solo para modo vertical */
@media only screen
  and (min-width: 320px) 
  and (max-width: 736px) 
  and (orientation: portrait) 
{ 
  /* inserta aquí tu código */
}
 
/* cambios css solo para modo horizontal */
@media only screen
  and (min-width: 320px) 
  and (max-width: 736px) 
  and (orientation: landscape) 
{ 
  /* inserta aquí tu código */
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
s


.tam{
	font-size:36px;
	font-size-adjust:inherit;
	}
	
	input[type=text] {
    width: 130px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

/* When the input field gets focus, change its width to 100% */
input[type=number] {
    width: 100%;
}
	input[type=text] {
    width: 100%;
}

textarea {
    width: 100%;
	height:10%;
	
}
</style>
<script>

	


function envipaqfuc() {
  // Get the checkbox
  var checkBox = document.getElementById("envipaq");
  // Get the output text
  var text = document.getElementById("envipaqdiv");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
}













function estafetafuc(sel) {
    var checkBox = document.getElementById("estafeta");
  // Get the output text
  var text = document.getElementById("estafetadiv");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
}


  

function redpackfuc(sel) {
        var checkBox = document.getElementById("redpack");
  // Get the output text
  var text = document.getElementById("redpackdiv");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
}

function especialfuc(sel) {
        var checkBox = document.getElementById("especial");
  // Get the output text
  var text = document.getElementById("especialdiv");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
}

 

function paquetexpressfuc(sel) {
           var checkBox = document.getElementById("paquetexpress");
  // Get the output text
  var text = document.getElementById("paquetexpressdiv");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
}



 



function fedexfuc(sel) {
           var checkBox = document.getElementById("fedex");
  // Get the output text
  var text = document.getElementById("fedexdiv");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
}


 
</script>

<?php
    /*$usuario = "root";
	$password = "";
	$servidor = "localhost";
	$basededatos = "recoleccion";*/
	
	$usuario = "envipaq_inven";
	$password = "3nvip4q2018";
	$servidor = "localhost";
	$basededatos = "envipaq_recoleccion";
	
	$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
	
	$db = mysqli_select_db( $conexion, $basededatos ) or die ( "No se Puede establecer conexion con la base de datos" );
	
	$id=$_GET['id'];
	$correo=$_GET['correo'];
	$id_ruta=$_GET['id_ruta'];  
	
	
 $sql   = "SELECT * FROM recolecta WHERE id ='{$id}' LIMIT 1";
  
   
   $resultado =mysqli_query( $conexion, $sql) or die ( "Algo ha ido mal en la consulta a la base de datos"); 
	

	



	while ($columna = mysqli_fetch_array( $resultado ))
	{?>
   
        
        

	     
        <form name="paquetes_recolectados" method="post" action="uploads/products/signature.php">
        
             <input name="id_recolecta" type="hidden" value="<?php echo $columna['id']; ?>">
             <input name="id_ruta" type="hidden" value="<?php echo $columna['id_operador']; ?>">
   
    
      
           <h1>Recolección <?php echo $columna['id_empresa']; ?></h1><br><br>
           
           <table width="100%" border="0">
  <tr>
    <td style="width: 15%;">
    <label for="nombre" class="tam">ENVIPAQ</label><label class="switch">
  <input type="checkbox" name="envipaq" id="envipaq" onChange="envipaqfuc(this)">
  <span class="slider round"> </span>
</label>
   
   
  </td>


    <td><div id="envipaqdiv" style="display:none;">
                  
               <label for="nombre">Paquetes</label>
               <input type="number" name="envipaqpaq" id="envipaqpaq" placeholder="Cantidad de Paquetes Envipaq" />
               </div>
               
        </td>
  </tr>
</table>

           
           
           
       

<br><br>

<table width="100%" border="0">
  <tr>
    <td style="width: 15%;"><label for="nombre" class="tam">ESTAFETA</label><label class="switch">
  <input type="checkbox" name="estafeta" id="estafeta" onChange="estafetafuc(this)">
  <span class="slider round"> </span>
</label>

</td>
    <td><div id="estafetadiv"  style="display:none;">


               <label for="nombre">Paquetes</label>
               <input type="number" name="estafetapaq" id="estafetapaq" placeholder="Cantidad de Paquetes Estafeta" />
               

</div></td>
  </tr>
</table>

    
<br><br>
<table width="100%" border="0">
  <tr>
    <td style="width: 15%;"> <label for="nombre" class="tam">REDPACK</label><label class="switch">
  <input type="checkbox" name="redpack" id="redpack" onChange="redpackfuc(this)">
  <span class="slider round"> </span>
</label>



</td>
    <td><div id="redpackdiv"  style="display:none;">

<div data-role="fieldcontain">
               <label for="nombre">Paquetes</label>
               <input type="number" name="redpackpaq" id="redpackpaq" placeholder="Cantidad de Paquetes Redpack" />
               </div>

</div></td>
  </tr>
</table>

<br><br>
   
<table width="100%" border="0">
  <tr>
    <td style="width: 15%;"><label for="nombre" class="tam">P. EXPRESS</label><label class="switch">
  <input type="checkbox" name="paquetexpress" id="paquetexpress" onChange="paquetexpressfuc(this)">
  <span class="slider round"> </span>
</label>


 </td>
    <td><div id="paquetexpressdiv"  style="display:none;">


               <label for="nombre">Paquetes</label>
               <input type="number" name="expresspaq" id="expresspaq" placeholder="Cantidad de Paquetes PaqueteExpress" />
              
               
                </div></td>
  </tr>
</table>


     <br><br>
     
<table width="100%" border="0">
  <tr>
    <td style="width: 15%;">
    
    
    <label for="nombre" class="tam">FEDEX</label><label class="switch">
  <input type="checkbox" name="fedex" id="fedex" onChange="fedexfuc(this)">
  <span class="slider round"> </span>
</label>                 
              
              </td>
    <td><div id="fedexdiv"  style="display:none;">

<div data-role="fieldcontain">
               <label for="nombre">Paquetes</label>
               <input type="number" name="fedexpaq" id="fedexpaq" placeholder="Cantidad de Paquetes Fedex" />
               </div>
               
               </div></td>
  </tr>
</table>

 <br><br>
     
<table width="100%" border="0">
  <tr>
    <td style="width: 15%;">
    
    
    <label for="nombre" class="tam">ESPECIAL</label><label class="switch">
  <input type="checkbox" name="especial" id="especial" onChange="especialfuc(this)">
  <span class="slider round"> </span>
</label>                 
              
              </td>
    <td><div id="especialdiv"  style="display:none;">

<div data-role="fieldcontain">
               <label for="nombre">Paquetes</label>
               <input type="number" name="especialpaq" id="especialpaq" placeholder="Cantidad de Paquetes Recolección Especial" />
               </div>
               
               </div></td>
  </tr>
</table>


<input type="hidden" name="correo" value="<?php echo $correo; ?>">
<input type="hidden" name="id_recolecion" value="<?php echo $id; ?>">
<input type="hidden" name="id_ruta" value="<?php echo $id_ruta; ?>">

 <br><br>
 

              
     <table width="100%" border="0">
  <tr>
    <td style="width: 15%;">
             
               <label for="mensaje">NOTAS</label></td>
    <td>
               <textarea cols="30" rows="1" name="notas" id="notas" ></textarea>
               </div></td>
  </tr>
</table>
             
             
              <br><br>
             
             
               <table width="100%" border="0">
  <tr>
    <td style="width: 15%;">
             
               <label for="mensaje">PERSONA QUIEN ENTREGA</label></td>
    <td>
               <input type="text" name="quien_entrega" id="quien_entrega" placeholder="  Nombre de la Persona de Quien Entrega" />
               </div></td>
  </tr>
</table>
             
             
             
             
             
             
             
             
             
             
             
              
              <br><br>

              <button type="submit" name="agregar_paquetes" class="btn btn-success btn-block" style="height: 50px">Firma</button>
          
      
		</form>
    
	
<?php	
		}
	 mysqli_close( $conexion );	
		
		?>