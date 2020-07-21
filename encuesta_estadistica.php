<?php
  $page_title = 'Encuesta Estadística';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
//   page_require_level(1);
?>

<?php include_once('layouts/header.php'); ?>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-12">
     <div class="panel panel-default">
       <div class="panel-heading">
        
          <span class="glyphicon glyphicon-signal"></span>
         Estadística de Encuesta
       </div>
       <div class="panel-body">
		   
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}

</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

 // Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);

// Add data
chart.data = [{
  "year": "DANIEL RANGEL",
  "MALO": 0,
  "REGULAR": 0,
  "BUENO": 8,
  "EXCELENTE": 12
},{
  "year": "ELENA ORTIZ",
  "MALO": 0,
  "REGULAR": 1,
  "BUENO": 15,
  "EXCELENTE": 28
},{
  "year": "YADIRA DIAZLEAL",
  "MALO": 0,
  "REGULAR": 0,
  "BUENO": 7,
  "EXCELENTE": 13
},{
  "year": "DAVID PIMENTEL",
  "MALO": 1,
  "REGULAR": 6,
  "BUENO": 9,
  "EXCELENTE": 11
}
			 ];

// Create axes
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.numberFormatter.numberFormat = "#";
categoryAxis.renderer.inversed = true;
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.cellStartLocation = 0.1;
categoryAxis.renderer.cellEndLocation = 0.9;

var  valueAxis = chart.xAxes.push(new am4charts.ValueAxis()); 
valueAxis.renderer.opposite = true;

// Create series
function createSeries(field, name) {
  var series = chart.series.push(new am4charts.ColumnSeries());
  series.dataFields.valueX = field;
  series.dataFields.categoryY = "year";
  series.name = name;
  series.columns.template.tooltipText = "{name}: [bold]{valueX}[/]";
  series.columns.template.height = am4core.percent(100);
  series.sequencedInterpolation = true;

  var valueLabel = series.bullets.push(new am4charts.LabelBullet());
  valueLabel.label.text = "{valueX}";
  valueLabel.label.horizontalCenter = "left";
  valueLabel.label.dx = 10;
  valueLabel.label.hideOversized = false;
  valueLabel.label.truncate = false;

  var categoryLabel = series.bullets.push(new am4charts.LabelBullet());
  categoryLabel.label.text = "{name}";
  categoryLabel.label.horizontalCenter = "right";
  categoryLabel.label.dx = -10;
  categoryLabel.label.fill = am4core.color("#fff");
  categoryLabel.label.hideOversized = false;
  categoryLabel.label.truncate = false;
}

createSeries("MALO", "MALO");
createSeries("REGULAR", "REGULAR");
createSeries("BUENO", "BUENO");
createSeries("EXCELENTE", "EXCELENTE");

}); // end am4core.ready()
</script>

<!-- HTML -->
<div id="chartdiv"></div>				
	
		   
		   
       </div>
     </div>
  </div>
  

 </div>


<?php
$id=$_GET["id"];

$nombre_para=selecciona_nombre_user($id);//extrae el nombre del usuario para quien esta dirigido el memo
foreach ($nombre_para as  $para):
//$item=  array($para["name"]);
$para_user=implode(", ",array($para["name"].", "));
echo $para_user;
endforeach;

?>
<?php include_once('layouts/footer.php'); ?>
