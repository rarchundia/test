<?php $user = current_user(); 

/*include('database_connection.php');

$query = "
 SELECT * FROM task_list 
 WHERE user_id = '".$_SESSION["user_id"]."' 
 ORDER BY task_list_id DESC
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();*/

?>
<!DOCTYPE html>
  <html lang="es"><head>
    <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shink-to-fit=no">
    <title><?php if (!empty($page_title))
           echo remove_junk($page_title);
            elseif(!empty($user))
           echo ucfirst($user['name']);
            else echo "SCI";?>
    </title>
	
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
	  
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.css" />
    <link rel="shortcut icon" href="../libs/images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="../lib/bootstrap.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
--><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.js"></script>
	    
<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>

	<link rel="icon" type="image/png" href="logo_sobre.png"/>

<style>
.pace {
  -webkit-pointer-events: none;
  pointer-events: none;

  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
}

.pace-inactive {
  display: none;
}

.pace .pace-progress {
  background: #ff0000;
  position: fixed;
  z-index: 2000;
  top: 0;
  right: 100%;
  width: 100%;
  height: 2px;
}

	
	
	
	
	
	
	
	
	
	
.accordion {
    background-color:#4894B0;
    color: #FFF;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

.accordion:hover {
    background-color:#03647C; 
}


	
	.active{
    background-color:#0B84F5; 
}

	
.acordeon {
    padding: 0 18px;
    display: none;
    background-color: white;
    overflow: hidden;
}

	

	
	
	
	.accordion_stylo {
    background-color:#F1070B;
    color: #FFF;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}
	
	.accordion_stylo:hover {
    background-color:#0A0000; 
}

    .accordeon_stylo{
    padding: 0 18px;
    display: none;
    background-color: white;
    overflow: hidden;
}
	
	#btn_siguiente{
		
		float: right;
		
	}
	
	
/*.sidebar {
    position: fixed;
    height: 100%;
    width: 0;
    top: ;
    left: 0;
    z-index: 1;
    
    overflow-x: hidden;
    transition: 0.4s;
    padding: 1rem 0;
    box-sizing:border-box;
}
*/
/*.boton-cerrar {
	color: white;
    font-size: 2rem;
   right: 0;
    padding: 40;
    line-height: 4.5rem;
    margin: 0;
   
    text-align:right;
	position: inherit; 
    top:20; 
    right:0;
    
}

.boton-cerrar:hover {
	color: red;
    font-size: 2rem;
   right: 0;
    padding: 40;
    line-height: 4.5rem;
    margin: 0;
   
    text-align:right;
position:static;
    top:20; 
    right:0;
}



.panel-default {
    transition: margin-left .4s;
    padding: 1rem;
}



#abrir {
    
}
#cerrar {
   display: none;
}
	*/
/* width */


	::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
::-webkit-scrollbar-thumb {
  background: red; 
  border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
  background: #b30000; 
}
	
	
	
	
	
	
/*.form-popup {
  display: none;
  position: fixed;
	bottom: 10px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

Add styles to the form container 
.form-container {
  max-width: 300px;
  padding: 0px;
  background-color:antiquewhite;

}*/

</style>


      
   
    <script type="text/javascript">
		
		

		
		
		
		

		$(document).ready(function(){ 
		$("#excel").click(function() {
 
$("#excel_button").prop('disabled',false);

});
			
		});//fin oculta	
		
		
		
		
		
		
$(document).ready(function(){ 
   $('#muestra').on('click',function(){
      $('#panel').toggle('slow');
	  $('#form2').toggle('slow');
	   $('#panel_input').toggle('slow');
	  $('#form2_input').toggle('slow');
	 });
	 
	 $('#regresa').on('click',function(){
      $('#panel').toggle('slow');
	  $('#form2').toggle('slow');
	  $('#panel_input').toggle('slow');
	  $('#form2_input').toggle('slow');
	});

	
 $('#seguro').on('click',function(){
      $('#valor').toggle('slow');
	  	});

	$('#comer_btn').on('click',function(){
      $('#comercializadora').toggle('slow');
	  	});
	
	$('#arancelaria_btn').on('click',function(){
      $('#arancelaria').toggle('slow');
	  	});
	
	
	$('#servicios1').on('click',function(){
      $('#etiquetado').toggle('slow');
	  	});
	
	
	$('#servicios2').on('click',function(){
      $('#embalado').toggle('slow');
	  	});
	
	$('#servicios3').on('click',function(){
      $('#uva').toggle('slow');
	  	});
				  
	
	$('#ver_contactos').on('click',function(){
      $('#contactos').toggle('slow');
	  	});
	
	$('.multiguia').on('click',function(){
      $('.idmultiguia').toggle('slow');
	  $('.nomultiguia').toggle('slow');
	});
	
	
});//fin oculta
  
   function mayus(e) {
    e.value = e.value.toUpperCase();
} //FIN UPPERCASE 
 

function muestra(e) {
	$('#panel').toggle('slow');
	 $('#form2').toggle('slow');
    }
    
		
	
		
		function buscar_entrega() {
    var textoBusqueda = $("input#busqueda_entrega").val();
	
 
     if (textoBusqueda != "") {	
	 
        $.post("resultado_entrega.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
			
         }); 
     } else { 
        $("#resultadoBusqueda").html('');
        };
}; //fin buscar entrega
		
		
	
		function buscar_recoleccion() {
    var textoBusqueda = $("input#busqueda_recoleccion").val();
	
 
     if (textoBusqueda != "") {	
	 
        $.post("resultado_recoleccion.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
			
         }); 
     } else { 
        $("#resultadoBusqueda").html('');
        };
}; //fin buscar recoleccion
		
		
		$(document).ready(function(){//recibe la seleccion de la empresa  para la lista
		$('#empresa').val('');
		recargarLista();

		$('#empresa').change(function(){
			recargarLista();
		});
	})
		 
 function recargarLista(){//muestra el personal de la empresa
		$.ajax({
			type:"POST",
			url:"comprobar.php",
			data:"empresa=" + $('#empresa').val(),
			success:function(r){
				$('#personal').html(r);
			}
		});
	}
		
	  </script>
    
    
  
  </head>
  <body>
	 
  <?php  if ($session->isUserLoggedIn(true)): ?>

	  <header id="header">
     
		
		
		<nav class="navbar navbar-default navbar-fixed-top"><!--navbar-fixed-top-->
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#" onclick="openForm()"><span title="h4d3s981" data-toggle="tooltip"> <img src="uploads/nuevo_logo.png"  width="190"></span></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
       <!-- <li><a href="#">Home</a></li>
       
		  <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Page 1-1</a></li>
            <li><a href="#">Page 1-2</a></li>
            <li><a href="#">Page 1-3</a></li>
          </ul>
        </li>
        
		  <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>-->
		  
		   <?php if($user['user_level'] === '1'): ?>
      <!-- admin menu -->
      <?php include_once('admin_menu.php');?>
		
		   <?php elseif($user['user_level'] === '2'): ?>
        <!-- coordinador  -->
      <?php include_once('special_menu.php');?>
 	  
		  
		  
		  <?php elseif($user['user_level'] === '3'): ?>
        <!-- menu usuario -->
      <?php include_once('user_menu.php');?>
        
		  
		  <?php elseif($user['user_level'] === '4'): ?>
       <!-- atencion a clientes -->
      <?php include_once('atn_menu.php');?>
	
		  
		  
		  
		  <?php elseif($user['user_level'] === '5'): ?>
       <!-- facturacion -->
      <?php include_once('facturacion_menu.php');?>
		  
		  
		  
		  
		  <?php elseif($user['user_level'] === '6'): ?>
		 
       <!-- calidad -->
      <?php include_once('calidad_menu.php');?>
      
		  
		  
		  
		  
		  <?php elseif($user['user_level'] === '7'): ?>

		<!-- ventas -->
      <?php include_once('ventas_g.php');?>
		
		  
		  
		  
		  <?php elseif($user['user_level'] === '8'): ?>
       <!-- logistica -->
      <?php include_once('logistica.php');?>
	
		  
		  
		  
		  
		  <?php elseif($user['user_level'] === '9'): ?>
       <!-- logistica -->
      <?php include_once('ventas_menu.php');?>
		  
		  
		 
		  
		   <?php endif;?>  
      </ul>
      
		<ul class="nav navbar-nav navbar-right">
		 		
			<li class="dropdown navbar-right">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			 <img src="uploads/users/<?php echo $user['image'];?>" alt="image" class="img-circle img-inline" height="45px">
              <?php echo remove_junk(ucfirst($user['name'])); ?> <span class="caret"></span>
			</a>
				  
          <ul class="dropdown-menu">
            <li><a href="edit_account.php"><i class="glyphicon glyphicon-picture"></i> Cambiar Foto de Perfil</a></li>
            <li><a href="change_password.php"><i class="glyphicon glyphicon-cog"></i> Configuración</a></li>
            <li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Salir </a></li>
          </ul>
        </li>
			
		</ul>
		
    </div>
  </div>
</nav>
		
		

		
		
    </header>
	    <div class="page">
	
  <div class="container-fluid">

	  
	  
		
    
	  
<?php endif;?>


	  