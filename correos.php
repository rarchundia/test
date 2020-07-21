<?php
  $page_title = 'Correos Estadistica';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);
//$json_data=include('json_correos.php');
//echo $json_data;exit;
?>

<?php 
if(isset($_POST['fecha2']) && isset($_POST['fecha1'])){
 
if($_POST['fecha1']!="Undefi"){
 
	$p_fecha1= remove_junk($db->escape($_POST['fecha1']));
    $p_fecha2 = remove_junk($db->escape($_POST['fecha2']));
    
	

	
	
echo '<script>$("#mensajes").html("<h2>Fecha del Día '.$p_fecha1.' al Día '.$p_fecha2.'.<br>  </h2>")</script>';
	
}else{
	
	$session->msg('d',' Falta Seleccionar la Primera Fecha ');
       redirect('correos.php', false);
	
}
   

   

 }
 
 

?>


<style>

 #chartdiv {
  width: 100%;
 
 height: 100%;
	// margin-left: 15px;
  
}

</style>

<?php include_once('layouts/header.php');

?>
 <div class="row">
   <div class="col-md-12"> 
	   <?php echo display_msg($msg); ?>
	 </div>
  <div class="col-md-12">
     <div class="panel panel-default">
       <div class="panel-heading">
        
          <span class="glyphicon glyphicon-signal"></span>
          Estadisticas Correos 
       </div>
       <div class="panel-body">
		   <?php 
		   $fecha_correo = fechas_de_correos();
		
			 // $correos_general = contador_correos_general();
?>	
			 
		<center><h2>Gráfica Global de Correos Enviados</h2></center>
		   
          <br>
		  
		   		<form action="correos.php" method="post">
	 
	
		      
		   
		   <div class="col-sm-2 pull-left">
			   <center>Fecha Inicio</center>
            <select name="fecha1" id="fecha1" class="form-control ">
				<?php foreach ($fecha_correo as  $fecha): ?>
         	   
		   <option><?php echo remove_junk(first_character($fecha['fecha']));?></option>
				<?php endforeach; ?>
				
		   </select>
		   </div>
		   
		   <div class="col-sm-2 pull-left">
            <center>Fecha Fin</center>
			   <select name="fecha2" id="fecha2" class="form-control " disabled><!--onchange="this.form.submit()"-->
				<?php foreach ($fecha_correo as  $fecha): ?>
         	   
		   <option><?php echo remove_junk(first_character($fecha['fecha']));?></option>
				<?php endforeach; ?>
				
		   </select>
		   </div>
		   </form>
		   
		   
		   
		   <div class="col-sm-3 pull-right">
		<center>Fecha por Día</center>
            <select id="selector_id" class="form-control ">
				<?php foreach ($fecha_correo as  $fecha): ?>
         	   
		   <option><?php echo remove_junk(first_character($fecha['fecha']));?></option>
				<?php endforeach; ?>
				
		   </select>
		   </div>
		     <div class="col-sm-12">
				  <div id="mensajes"></div>
				
              <div id="chartdiv" >
				  </div> 
				 </div> 
          
		
		    
		   
		   	 
		  
		
				
	
		   
		   
       </div>
     </div>
  </div>
  

 </div>

<script src="js/core.js"></script>
    <script src="js/charts.js"></script>
    <script src="js/animated.js"></script>
 <script src="js/es_ES.js"></script>


<script type="text/javascript">
	
	$(document).ready(function(e){
		
				
		
	$("#fecha1").change(function() {
      if($("#fecha1").val() !="Undefi"){
        $('#fecha2').prop('disabled', false);
      }else{
        $('#fecha1').prop('disabled', 'disabled');
       }
    });	
		
	$('#selector_id').on('change',function(){
		ajax_function($(this).val());
	
	});
		
		
				
		$('#fecha2').on('change',function(){
			if(($("#fecha1").val()!="Undefi" && $("#fecha1").val())>$("#fecha2").val()){
				alert ("La segunda fecha es Menor");
				$("#fecha2").val("Undefi");
			}
			/*if($("#fecha1").val()==$("#fecha2").val()){
				alert ("La Primera y la La segunda fecha Son Iguales \n Te voy a dar el Resultado pero para eso esta la funcion depor Día");
				$("#fecha2").val("Undefi");
			}*/
		ajax_function1($("#fecha1").val(),$("#fecha2").val() );
	//ajax_function1($("#fecha2").val());
	
	});
		
		
		
	
		
		
});

	
	function ajax_function(fecha){
		url='json_correos.php';
		$.ajax({
		url:url,
			type:"POST",
			async:true,
			dataType:"JSON",
			data:{fecha:fecha},
			beforeSend: function(){},
			success:function(data , textStatus, jqXHR){
			$("#mensajes").html("<center><h2>Fecha del Día "+fecha+"<br>  </h2><center>");
				show_graph(data);
				
		},
			error:function(jqHXR, textStatus, errorThrown){
			},
				
		});
	}
	
	
	function ajax_function1(fecha1, fecha2){
		if(fecha1!="Undefi"){
			
			
		
		
	//	alert (fecha1);
	//alert (fecha2);
		
		url='json_correos_range.php';
		$.ajax({
		url:url,
			type:"POST",
			async:true,
			dataType:"JSON",
			data:{fecha1:fecha1, fecha2:fecha2},
			beforeSend: function(){},
			success:function(data , textStatus, jqXHR){
			$("#fecha2").val("Undefi");
				 $('#fecha2').prop('disabled', true);
				$("#mensajes").html("<center><h2>Fecha del Día "+fecha1+" al Día "+fecha2+"<br>  </h2><center>");
				show_graph(data);
				
		},
			error:function(jqHXR, textStatus, errorThrown){
			},
				
				
				
		});
		}else{
			
			alert(' Falta Seleccionar la Primera Fecha ');
       $("#fecha2").val("Undefi");
			}
	}

	
	
	
	
	//ajax_function('Apr 20, 2020, 12:55:12 PM');
	
	function show_graph(json_data){
		
		
	
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

/**
 * Chart design taken from Samsung health app
 */

var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.paddingRight = 40;

chart.data =json_data;
	

	
	
	
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "de";
categoryAxis.renderer.grid.template.strokeOpacity = 0;
categoryAxis.renderer.minGridDistance = 10;
categoryAxis.renderer.labels.template.dx = -40;
categoryAxis.renderer.minWidth = 120;
categoryAxis.renderer.tooltip.dx = -40;
	
	
	

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.inside = true;
valueAxis.renderer.labels.template.fillOpacity = 0.3;
valueAxis.renderer.grid.template.strokeOpacity = 0;
valueAxis.min = 0;
valueAxis.cursorTooltipEnabled = false;
valueAxis.renderer.baseGrid.strokeOpacity = 0;
valueAxis.renderer.labels.template.dy = 20;
	
	
	

var series = chart.series.push(new am4charts.ColumnSeries);
series.dataFields.valueX = "total";
series.dataFields.categoryY = "de";
series.tooltip.pointerOrientation = "vertical";
//series.tooltip.dy = - 30;
//series.columnsContainer.zIndex = 100;
//series.tooltipText = "{valueX.value}";
	
series.tooltip.label.interactionsEnabled = true;
series.tooltip.keepTargetHover = true;

series.columns.template.tooltipHTML = '<br><b>{valueX.value} Correos Enviados<br> {de}</b><br><a href="detalles_correos.php?correo={de}" style="color: white;"><center>Detalles</center></a>';	
	
	

var columnTemplate = series.columns.template;
columnTemplate.height = am4core.percent(45);
columnTemplate.maxHeight = 30;
columnTemplate.maxHeight = 30;
columnTemplate.column.cornerRadius(60, 10, 60, 10);
columnTemplate.strokeOpacity = 0;
	
series.heatRules.push({ target: columnTemplate, property: "fill", dataField: "valueX", min: am4core.color("#FB7A5E"), max: am4core.color("#E12901") });
series.mainContainer.mask = undefined;

/*var cursor = new am4charts.XYCursor();
chart.cursor = cursor;
cursor.lineX.disabled = true;
cursor.lineY.disabled = true;
cursor.behavior = "none";*/

var bullet = columnTemplate.createChild(am4charts.CircleBullet);
bullet.circle.radius = 10;
bullet.valign = "middle";
bullet.align = "left";
bullet.isMeasured = true;
bullet.interactionsEnabled = false;
bullet.horizontalCenter = "right";
bullet.interactionsEnabled = false;

var hoverState = bullet.states.create("hover");
var outlineCircle = bullet.createChild(am4core.Circle);
outlineCircle.adapter.add("radius", function (radius, target) {
    var circleBullet = target.parent;
    return circleBullet.circle.pixelRadius + 10;
})

/*var image = bullet.createChild(am4core.Image);
image.width = 60;
image.height = 60;
image.horizontalCenter = "middle";
image.verticalCenter = "middle";
image.propertyFields.href = "href";

image.adapter.add("mask", function (mask, target) {
    var circleBullet = target.parent;
    return circleBullet.circle;
})*/

	///descargar formatos
	chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";
		chart.exporting.menu.verticalAlign = "top";
		chart.exporting.filePrefix = "Estadisticas_correos";
	
		chart.exporting.menu.items = 		
		[
  {
    "label": "...",
    "menu": [
      {
        "label": "Imagen",
        "menu": [
          { "type": "jpg", "label": "JPG" },
          { "type": "pdf", "label": "PDF" }
        ]
      }, {
        "label": "Datos",
        "menu": [
          { "type": "csv", "label": "CSV" },
          { "type": "xlsx", "label": "XLSX" },
          { "type": "pdfdata", "label": "PDF" }
        ]
      }, {
        "label": "Imprime", "type": "print"
      }
    ]
  }
];
	
	
	
	//fin de descargar
	
var previousBullet;
chart.cursor.events.on("cursorpositionchanged", function (event) {
    var dataItem = series.tooltipDataItem;

    if (dataItem.column) {
        var bullet = dataItem.column.children.getIndex(1);

        if (previousBullet && previousBullet != bullet) {
            previousBullet.isHover = false;
        }

        if (previousBullet != bullet) {

            var hs = bullet.states.getKey("hover");
            hs.properties.dx = dataItem.column.pixelWidth;
            bullet.isHover = true;

            previousBullet = bullet;
        }
    }
})

}); // end am4core.ready()
	
		
		
		
	}
	
	
	
	
	
	
	
	
 /*am4core.useTheme(am4themes_animated);

	
var chart = am4core.create("chartdiv", am4charts.PieChart3D);
 


chart.exporting.menu = new am4core.ExportMenu();
	
	chart.exporting.menu.items = [{
  "label": "Descargar",
  "menu": [
    { "type": "png", "label": "PNG" },
    { "type": "json", "label": "JSON" },
    { "label": "Print", "type": "print" },
    { "label": "PDF", "type": "PDF" }
  ]
}];
	//chart.dataSource.url = "json_correos.php";
//chart.dataSource.parser = new am4core.JSONParser();
	
	//chart.exporting.menu.items[0].icon = "uploads/download.png";
	
	
chart.data =<?php //echo $json_data; ?>

	
			  
			  
			  
    
chart.innerRadius = am4core.percent(30);

var series = chart.series.push(new am4charts.PieSeries3D());
series.dataFields.value = "total";
series.dataFields.category = "de";
   
   
     
    
  
	  
	 
  
	  
	  
  
  
  */
	
	
	
  </script>	

<script>
	function ajax_function2(fecha1, fecha2){
		url='json_correos_range.php';
		$.ajax({
		url:url,
			type:"POST",
			async:true,
			dataType:"JSON",
			data:{fecha1:fecha1, fecha2:fecha2},
			beforeSend: function(){},
			success:function(data , textStatus, jqXHR){
			$("#mensajes").html("<center><h2>Fecha del Día "+fecha1+" al Día "+fecha2+"<br>  </h2><center>");
				show_graph1(data);
				
		},
			error:function(jqHXR, textStatus, errorThrown){
			},
				
				
				
		});
		
	}
	
	ajax_function2("Apr 15", "Jul 19");
	
	function show_graph1(json_data){
	am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.PieChart);

// Add data
chart.data =json_data;


chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";
		chart.exporting.menu.verticalAlign = "top";
		chart.exporting.filePrefix = "Estadisticas_correos";
		
		chart.exporting.menu.items = 		
		[
  {
   "label": "...",
    "menu": [
      {
        "label": "Imagen",
        "menu": [
          { "type": "jpg", "label": "JPG" },
          { "type": "pdf", "label": "PDF" }
        ]
      }, {
        "label": "Datos",
        "menu": [
          { "type": "csv", "label": "CSV" },
          { "type": "xlsx", "label": "XLSX" },
          { "type": "pdfdata", "label": "PDF" }
        ]
      }, {
        "label": "Imprime", "type": "print"
      }
    ]
  }
];
		
// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "total";
pieSeries.dataFields.category = "de";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
	
	}

</script>



			


<?php include_once('layouts/footer.php'); ?>


