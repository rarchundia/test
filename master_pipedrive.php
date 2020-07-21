<?php
 $page_title = 'Master Pipedrive';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(8);

?>
<?php
// Checkin What level user has permission to view this page

//pull out all user form database
 $all_users = find_all_user();
$tabla_vendedor=find_all_vendedor();
$dados_de_alta=dados_de_alta();
$ganados=ganados();
$perdidos=perdidos();

$llamadas=llamadas();
$correos=correos();
$reunion=reunion();

$c_ganados= c_ganados_todos();
$c_ganadosp= c_ganados_todos_perdido();
?>

<?php include_once('layouts/header.php'); ?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
					
	google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(ganados);
      function ganados() {
        var data = google.visualization.arrayToDataTable([
          ['Perdidos',  'Ganado'],
			<?php  foreach ($ganados as $ganado): ?>
         ['Ganados',     <?php echo $ganado["ganado"]; ?>],
			<?php endforeach; ?>
			<?php  foreach ($perdidos as $vendedor): ?>
          ['Perdidos',  <?php echo $vendedor["perdido"]; ?>],
			<?php endforeach; ?>
			
		     
        ]);

        var options = {
          title: 'Ganados / Perdidos (Mes)',
          pieHole: 0.5,
			fontSize:25,
        };

        var chart = new google.visualization.PieChart(document.getElementById('dona'));
        chart.draw(data, options);
      };
	
	
	
	
	
	
	
	
	
	
	
	google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(citas_acci);
      function citas_acci() {
        var data = google.visualization.arrayToDataTable([
     		    ['LLamadas',  'Correos'],    
			<?php  foreach ($llamadas as $llamada): ?>
          ['Llamadas',<?php echo $llamada["llamadas"]; ?>],
			<?php endforeach; ?>
			<?php  foreach ($correos as $correo): ?>
         ['Correos',<?php echo $correo["correos"]; ?>],
			<?php endforeach; ?>
			<?php  foreach ($reunion as $reuniones): ?>
         ['Reunion',<?php echo $reuniones["reunion"]; ?>]
			<?php endforeach; ?>
        ]);

        var options = {
          title: 'Llamadas, Correos, Reuniones (Mes)',
          pieHole: 0.5,
			fontSize:25,
        };

        var chart = new google.visualization.PieChart(document.getElementById('citas_acciones'));
        chart.draw(data, options);
      };
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(dados_de_alta);

      function dados_de_alta() {
        var data = google.visualization.arrayToDataTable([
          ['Fecha', 'Usuarios'],
			<?php  foreach ($dados_de_alta as $vendedor): ?>
          ['<?php switch($vendedor["fecha"]){ case 1: echo "Enero"; break; case 2:  echo "Febrero";  break;  case 3:  echo "Marzo";  break; case 4:  echo "Abril";   break;  case 5: echo "Mayo"; break; case 6: echo "Junio"; break; case 7:  echo "Julio"; break;  case 8: echo "Agosto";  break; case 9: echo "Septiembre";  break; case 10: echo "Octubre"; break; case 11: echo "Noviembre"; break; case 12: echo "Diciembre"; break; }?>', '<?php echo $vendedor["contacto"] ?>'],
          <?php endforeach; ?>
        ]);

        var options = {
          chart: {
            title: 'Contactos  Agregados (Mes)',
              fontSize:50,
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('dados_de_alta'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
	
	
	
	google.charts.load('current', {'packages':['timeline']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'id');
	  data.addColumn('string', 'Name');
	 data.addColumn('date', 'Start');
      data.addColumn('date', 'End');

      data.addRows([
       <?php  foreach ($c_ganados as $gan): ?>
		 <?php (int)$anio=date("Y",strtotime($gan['fecha']));	(int)$mes=date("m",strtotime($gan['fecha']));(int)$dia=date("d",strtotime($gan['fecha'])); ?>
		  <?php (int)$anio_fin=date("Y",strtotime($gan['gana_per_fecha']));	(int)$mes_fin=date("m",strtotime($gan['gana_per_fecha']));(int)$dia_fin=date("d",strtotime($gan['gana_per_fecha']));  ?>
		 ['<?php echo $gan['contacto'] ?>','<?php echo $gan['contacto'] ?> - <?php echo $gan['empresa'] ?>',     new Date('<?php echo $anio; ?>', '<?php echo ($mes-1); ?>', '<?php echo $dia; ?>'), new Date('<?php echo $anio_fin; ?>', '<?php echo ($mes_fin-1); ?>', '<?php echo $dia_fin; ?>')],
         <?php endforeach; ?>
      ]);

      var options = {
        height: 900,
        timeline: {
          groupByRowLabel: true
        }
      };

      var chart = new google.visualization.Timeline(document.getElementById('tiempo'));

      chart.draw(data, options);
    }

	
	
	google.charts.load('current', {'packages':['timeline']});
    google.charts.setOnLoadCallback(drawChartperdidos);

    function drawChartperdidos() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'id');
	  data.addColumn('string', 'Name');
	 data.addColumn('date', 'Start');
      data.addColumn('date', 'End');

      data.addRows([
       <?php  foreach ($c_ganadosp as $gan): ?>
		 <?php (int)$anio=date("Y",strtotime($gan['fecha']));	(int)$mes=date("m",strtotime($gan['fecha']));(int)$dia=date("d",strtotime($gan['fecha'])); ?>
		  <?php (int)$anio_fin=date("Y",strtotime($gan['gana_per_fecha']));	(int)$mes_fin=date("m",strtotime($gan['gana_per_fecha']));(int)$dia_fin=date("d",strtotime($gan['gana_per_fecha']));  ?>
		 ['<?php echo $gan['contacto'] ?>','<?php echo $gan['contacto'] ?> - <?php echo $gan['empresa'] ?>',     new Date('<?php echo $anio; ?>', '<?php echo ($mes-1); ?>', '<?php echo $dia; ?>'), new Date('<?php echo $anio_fin; ?>', '<?php echo ($mes_fin-1); ?>', '<?php echo $dia_fin; ?>')],
         <?php endforeach; ?>
      ]);

      var options = {
        height: 900,
        timeline: {
          groupByRowLabel: true
        }
      };

      var chart = new google.visualization.Timeline(document.getElementById('tiempo_perdido'));

      chart.draw(data, options);
    }
	
	

	
</script>


<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-signal"></span>
          <span>Reportes</span>
       </strong>
		  
		  <span class="pull-right">
				<div class="col-md-12">
                    <form method="GET" action="get_vendedores.php">
  		
		
	                    
							
							<select class="form-control" name="id" id="id" value="" onchange="this.form.submit()">
                      <option value="">Selecciona Vendedor</option>
                    <?php  foreach ($tabla_vendedor as $vendedor): ?>
                      <option value="<?php echo (int)$vendedor['id'] ?>" >
                        <?php echo $vendedor['name'] ?></option>
                       <?php endforeach; ?>
                    </select>
					</form>
                  </div>
			</span>
		  
		  
		  
         </div>
     <div class="panel-body">
	
		
		 
		 	<div id="display">
			<div class="row" id="heading" style="display:none;">

      
       
</div>
            
<br>		
<div class="row" id="no_records">
	
		<div id="dados_de_alta" style="width: 100%; height: 200px;"></div>	 
	<br><br><br>
		 
		 <h2><center>Ganados Periodo de Tiempo</center>
	  

	  
	  </h2><br>
		  <div id="tiempo" style="width: 100%; height: 200px;">
	  </div>
	
	<br><br><br>
		 
		 <h2><center>Perdidos Periodo de Tiempo</center>
	  

	  
	  </h2><br><br><br><br><br><br>
		  <div id="tiempo_perdido" style="width: 100%; height: 200px;">
	  </div>
	
	<br><br><br>
	
<div id="dona" style="width: 100%; height: 900px;"></div>
	
	
	<div id="citas_acciones" style="width: 100%; height: 900px;"></div>
            
<div class="col-sm-12"></div>
				
				
		</div>		
					
			
		</div>
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
     </div>
    </div>
  
  




				
				
		
	
    
	<script type="text/javascript">
			
			


	// code to get all records from table via select box
	$("#vendedor").change(function() {    
		var id = $(this).find(":selected").val();
		var dataString ="id="+id;    
		//alert(dataString);
		function cargar(){
          
			$.ajax({   
                type: "POST",
                url: 'get_vendedores.php',
                data:dataString,
                success: function(datos){  
					if(datos) {
						$("#heading").show();		  
					$("#no_records").hide();
                  	$('#heading').load('get_vendedores.php')
					} else {
					$("#heading").hide();
					$("#no_records").show();
				}   	
					
                }
            });
        }
		
		
	}) ;




	

   

		
		
		

</script>		

				
				
				
				
				
				
				</div></div>
<?php include_once('layouts/footer.php'); ?>
