<?php
  $page_title = 'Editar Usuario';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<style>

#chartdiv {
  width: 100%;
  max-height: 600px;
  height: 80%;
}

</style>
<?php include_once('layouts/header.php'); ?>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-12">
     <div class="panel panel-default">
       <div class="panel-heading">
        
          <span class="glyphicon glyphicon-user"></span>
          Actualiza cuenta 
       </div>
       <div class="panel-body">
		   <div id="chartdiv"></div>
				
	
		   
		   
       </div>
     </div>
  </div>
  

 </div>


  <script src="js/core.js"></script>
    <script src="js/charts.js"></script>
    <script src="js/animated.js"></script>
 <script src="js/es_ES.js"></script>
    
<script>

    am4core.useTheme(am4themes_animated);

var chart = am4core.create("chartdiv", am4charts.PieChart3D);


chart.legend = new am4charts.Legend();

chart.data = [{
    "country": "Lithuania",
    "litres": 501.9
}, {
    "country": "Czech Republic",
    "litres": 301.9
}, {
    "country": "Ireland",
    "litres": 201.1
}, {
    "country": "Germany",
    "litres": 165.8
}, {
    "country": "Australia",
    "litres": 139.9
}, {
    "country": "Austria",
    "litres": 128.3
}, {
    "country": "UK",
    "litres": 99
}, {
    "country": "Belgium",
    "litres": 60
}, {
    "pais": "The Netherlands",
    "litres": 50
}];

chart.innerRadius = am4core.percent(40);

var series = chart.series.push(new am4charts.PieSeries3D());
series.dataFields.value = "litres";
series.dataFields.category = "pais";
    
    
</script>
  



<?php include_once('layouts/footer.php'); ?>
