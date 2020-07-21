<?php
  $page_title = 'Organigrama';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(10);


?>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');

        // For each orgchart box, provide the name, manager, and tooltip to show.
        data.addRows([
          [{'v':'Yassert Alfaro Zavaleta', 'f':'<h3>Yassert Alfaro Zavaleta</h3> <div style="color:gray; font-style:italic">Director</div>'},
           '', 'Director'],
          [{'v':'David Paredes', 'f':'<h4>David Paredes</h4><div style="color:gray; font-style:italic">Gerente Comercial</div>'},
           'Yassert Alfaro Zavaleta', 'Gerente Comercial'],
			[{'v':'Diana Tapia', 'f':'<h4>Diana Tapia</h4><div style="color:gray; font-style:italic">Gerente de Administración</div>'},
           'Yassert Alfaro Zavaleta', 'Gerente de Administración'],
			[{'v':'Andrés Martinez', 'f':'<h4>Andrés Martinez</h4><div style="color:gray; font-style:italic">Jefe de Operación</div>'},
           'Yassert Alfaro Zavaleta', 'Jefe de Operación'],
			
			[{'v':'Yeni Cortes', 'f':'<h4>Yeni Cortes</h4><div style="color:gray; font-style:italic">Gerente de Calidad</div>'},
           'Yassert Alfaro Zavaleta', 'Gerente de Calidad'],
			
			//[{'v':'Stephanie Isla Contreras', 'f':'<h4>Stephanie Isla Contreras</h4><div style="color:gray; font-style:italic">Ejecutivo Comercial</div>'}, 'Yassert Alfaro Zavaleta', 'Ejecutivo Comercial'],
            
			//[{'v':'Vania Martinez', 'f':'<h4>Vania Martinez</h4><div style="color:gray; font-style:italic">Ejecutivo Comercial</div>'},'Yassert Alfaro Zavaleta', 'Ejecutivo Comercial'],
			
			[{'v':'Sergio Avalos', 'f':'<h4>Sergio Avalos</h4><div style="color:gray; font-style:italic">Ejecutivo Comercial</div>'},
           'Yassert Alfaro Zavaleta', 'Ejecutivo Comercial'],
			
			[{'v':'Ivonne Casas', 'f':'<h4>Ivonne Casas</h4><div style="color:gray; font-style:italic">Ejecutivo Comercial</div>'},
           'David Paredes', 'Ejecutivo Comercial'],
			//[{'v':'Alejandro Adaya', 'f':'<h4>Alejandro Adaya</h4><div style="color:gray; font-style:italic">Ejecutivo Comercial</div>'},           'David Paredes', 'Ejecutivo Comercial'],
			//[{'v':'Adán Casasola', 'f':'<h4>Adán Casasola</h4><div style="color:gray; font-style:italic">Ejecutivo Comercial</div>'},           'David Paredes', 'Ejecutivo Comercial'],
			//[{'v':'Francisco Gómez', 'f':'<h4>Francisco Gómez</h4><div style="color:gray; font-style:italic">Ejecutivo Comercial</div>'},     'David Paredes', 'Ejecutivo Comercial'],
            //[{'v':'Enrique Cerón', 'f':'<h4>Enrique Cerón</h4><div style="color:gray; font-style:italic">Ejecutivo Comercial</div>'},          'David Paredes', 'Ejecutivo Comercial'],
			
			[{'v':'Leticia Garcia', 'f':'<h4>Leticia Garcia</h4><div style="color:gray; font-style:italic">Jefa de Atención a Clientes</div>'},
           'David Paredes', 'Jefa de Atención a Clientes'],
			[{'v':'Yadira Diazleal', 'f':'<h4>Yadira Diazleal</h4><div style="color:gray; font-style:italic">Atención a Clientes</div>'},
           'Leticia Garcia', 'Atención a Clientes'],
			[{'v':'David Pimentel', 'f':'<h4>David Pimentel</h4><div style="color:gray; font-style:italic">Atención a Clientes</div>'},
           'Leticia Garcia', 'Atención a Clientes'],
			[{'v':'Daniel Rangel', 'f':'<h4>Daniel Rangel</h4><div style="color:gray; font-style:italic">Atención a Clientes</div>'},
           'Leticia Garcia', 'Atención a Clientes'],
			[{'v':'Elena Ortiz', 'f':'<h4>Elena Ortiz</h4><div style="color:gray; font-style:italic">Key Account Manager</div>'},
           'Leticia Garcia', 'Key Account Manager'],
    
			[{'v':'Karla Castillo', 'f':'<h4>Karla Castillo</h4><div style="color:gray; font-style:italic">Recepción, Facturación</div>'},
           'Diana Tapia', 'Recepción, Facturación'],
		
			[{'v':'Juana Aguirre', 'f':'<h4>Juana Aguirre</h4><div style="color:gray; font-style:italic">Limpieza</div>'},
           'Diana Tapia', 'Limpieza'],
			[{'v':'Ricardo Archundia', 'f':'<h4>Ricardo Archundia</h4><div style="color:gray; font-style:italic">Sistemas</div>'},
           'Diana Tapia', 'Sistemas'],
			[{'v':'Ivan Blanco', 'f':'<h4>Ivan Blanco</h4><div style="color:gray; font-style:italic">Operador</div>'},
           'Andrés Martinez', 'Operador'],
			[{'v':'Alberto Blanco', 'f':'<h4>Alberto Blanco</h4><div style="color:gray; font-style:italic">Operador</div>'},
           'Andrés Martinez', 'Operador'],
			[{'v':'Eduardo Ruiz', 'f':'<h4>Eduardo Ruiz</h4><div style="color:gray; font-style:italic">Operador</div>'},
           'Andrés Martinez', 'Operador'],
			[{'v':'Jorge Ruiz', 'f':'<h4>Jorge Ruiz</h4><div style="color:gray; font-style:italic">Operador</div>'},
           'Andrés Martinez', 'Operador'],
			[{'v':'Antonio Zamudio', 'f':'<h4>Antonio Zamudio</h4><div style="color:gray; font-style:italic">Operador</div>'},
           'Andrés Martinez', 'Operador'],
			[{'v':'Gerardo Alonso', 'f':'<h4>Gerardo Alonso</h4><div style="color:gray; font-style:italic">Auxiliar</div>'},
           'Andrés Martinez', 'Auxiliar'],
			
        ]);
  
        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {'allowHtml':true,'allowCollapse':true,'size':'small'});
      }
   </script>
   <?php include_once('layouts/header.php');
 
?>
  <?php echo display_msg($msg); ?>


  <div class="row">
    <div class=" panel-heading">
		
		 
		<h1>Organigrama</h1>
       </strong>
	  <div id="chart_div"></div>
      </div>
      
       
          

	  
    
 <?php include_once('layouts/footer.php'); ?>