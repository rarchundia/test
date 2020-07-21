<?php $user = current_user(); ?>
<!DOCTYPE html>
  <html lang="es"><head>
    <meta charset="UTF-8">
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
    <link rel="icon" href="../libs/images/favicon.ico" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
--><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.js"></script>
	  

	  

<style>
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
	 });
	 
	 $('#regresa').on('click',function(){
      $('#panel').toggle('slow');
	  $('#form2').toggle('slow');
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
      <div class="logo pull-left"><span title="h4d3s981" data-toggle="tooltip"> <img src="uploads/logoenvipaq.png" height="60" width="190"></span></div>
      <div class="header-content">
      <div class="header-date pull-left">
<strong title="Fecha Actual" data-toggle="tooltip"><?php echo date("d/m/Y  g:i a");?></strong>
      </div>
		  
		
		  
      <div class="pull-right clearfix">
        <ul class="info-menu list-inline list-unstyled">
          <li class="profile">
            <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
            <span><?php echo remove_junk(ucfirst($user['name'])); ?> <i class="caret"></i></span>
            </a>
            <ul class="dropdown-menu">
             
             <li>
                 <a href="change_password.php" title="Editar Cuenta" data-toggle="tooltip">
                     <i class="glyphicon glyphicon-cog"></i>
                     Configuración
                 </a>
             </li>
             <li class="last">
                 <a href="logout.php">
                     <i class="glyphicon glyphicon-off"></i>
                     Salir
                 </a>
             </li>
           </ul>
          </li>
        </ul>
      </div>
     </div>
    </header>
    <div class="sidebar">
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
       <!-- atencion a clientes -->
      <?php include_once('facturacion_menu.php');?>
		<?php elseif($user['user_level'] === '6'): ?>
       <!-- atencion a clientes -->
      <?php include_once('calidad_menu.php');?>
      <?php elseif($user['user_level'] === '7'): ?>
       <!-- atencion a clientes -->
      <?php include_once('ventas_menu.php');?>
		
      <?php endif;?>

   </div>
<?php endif;?>

<div class="page">
  <div class="container-fluid">
