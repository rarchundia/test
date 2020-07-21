<?php
  $page_title = 'Admin Página de Inicio';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(9);
?>
<?php
 $todos_lostiempos   = count_by_id('recolecta');
 $recolecciones_hoy= count_by_id_fecha('recolecta');
 $por_recolectar     = count_by_id_por_recolectar('recolecta');
 $sehan_recolectado     = count_by_id_recolectado('recolecta');
 $por_mes           = count_by_id_recolectado_mes('recolecta');
 $no_se_recolecto_enel_mes= count_by_id_recolectado_mes_falta('recolecta');




$fedex=count_by_id_fedex('paqueteria');
$estafeta=count_by_id_estafeta('paqueteria');
$redpack=count_by_id_redpack('paqueteria');
$express=count_by_id_expres('paqueteria');
$especial=count_by_id_especial('paqueteria');
$envipaq=count_by_id_envipaq('paqueteria');


$norte=5;
$sur=6;
$oriente=7;
$poniente=8;

$cam1="842YAE";
$cam2="640XCK";
$cam3="J46AHW";
$cam4="592XLA";
$cam5="662YXR";





$unidad1=odometro_ultimo($cam1);
$unidad2=odometro_ultimo($cam2);
$unidad3=odometro_ultimo($cam3);
$unidad4=odometro_ultimo($cam4);
$unidad5=odometro_ultimo($cam5);


$todometro_norte=odometro_total_hoy($norte);
$todometro_sur=odometro_total_hoy($sur);
$todometro_oriente=odometro_total_hoy($oriente);
$todometro_poniente=odometro_total_hoy($poniente);



/*$c_personaltotal = count_by_id('responsable');
 $por_empresatotal=count_by_empresa('responsable');
 $c_marca           = count_by_id('marca');
 $por_empresapc= count_by_empresapc();
 $por_empresaall= count_by_empresaall();
  $por_empresalap= count_by_empresalap();	 
 $por_empresasca= count_by_empresasca();	  
	  */
	  
	  
	 // $total=$c_imp_esca['total']+$c_allinone['total']+$c_laptop['total']+$c_pc['total'];

	  
 
 
?>
<?php include_once('layouts/header.php'); ?>
 
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(odometro);

      function odometro() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['640XCK',<?php echo (int)$unidad2['ultimo']; ?>],        
          ['J46AHW',<?php echo (int)$unidad3['ultimo']; ?>],
		  ['662YXR',<?php echo (int)$unidad5['ultimo']; ?>],
		  ['592XLA',<?php echo (int)$unidad4['ultimo']; ?>]
		]);

        var options = {
          width: 800, height: 250,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5,
			
        };

        var chart = new google.visualization.Gauge(document.getElementById('odometro'));

        chart.draw(data, options);
	
		  
		  
		  
      }  
	   
	     
	   
	   
	  </script>

<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg);?>
     
   </div>
</div>
  <div class="row">
   
	 <div id="odometro" style="width: 400px; height: 120px;"></div>
    <!-- <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $todos_lostiempos['total']; ?> </h2>
          <p class="text-muted">Total de Recolecciones Desde el Principio</p>
        </div>
       </div>
    </div>
    
    
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"><?php  echo $recolecciones_hoy['total']; ?>  </h2>
          <p class="text-muted">Total de Recolecciones Hoy</p>
        </div>
       </div>
    </div>
    
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-yellow">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $por_recolectar['total']; ?> </h2>
          <p class="text-muted">Por Recolectar</p>
        </div>
       </div>
    </div>
    
    
    
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $sehan_recolectado['total']; ?> </h2>
          <p class="text-muted">Se Han Recolectado</p>
        </div>
       </div>
    </div>
    
    
    
    
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $por_mes['total']; ?> </h2>
          <p class="text-muted">Se Han Recolectado en el Mes</p>
        </div>
       </div>
    </div>
    
    
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $no_se_recolecto_enel_mes['total']; ?> </h2>
          <p class="text-muted">Hay Pendiente de Recoleccion en el Mes</p>
        </div>
       </div>
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
    
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $todometro_norte['total_odometro']; ?> </h2>
          <p class="text-muted">Norte <small>Odometro Hoy</small></p>
        </div>
       </div>
    </div>
    
    
    
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $todometro_sur['total_odometro']; ?> </h2>
          <p class="text-muted">Sur <small>Odometro Hoy</small></p>
        </div>
       </div>
    </div>
    
    
    
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $todometro_poniente['total_odometro']; ?> </h2>
          <p class="text-muted">Poniente <small>Odometro Hoy</small></p>
        </div>
       </div>
    </div>
    
    
    
    
    
    
    
    
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $todometro_oriente['total_odometro']; ?> </h2>
          <p class="text-muted">Oriente <small>Odometro Hoy</small></p>
        </div>
       </div>
    </div>
    

	  
	  
	  
	  

	  
	  <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $unidad1['ultimo']; ?> </h2>
          <p class="text-muted">Odometro Placas 842YAE</p>
        </div>
       </div>
    </div>
	  
	  -->
	  
	    
	 
	  <!-- 
	   <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $unidad2['ultimo']; ?> </h2>
          <p class="text-muted">Odometro Placas 640XCK</p>
        </div>
       </div>
    </div>
	  
	    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $unidad3['ultimo']; ?> </h2>
          <p class="text-muted">Odometro Placas J46AHW</p>
        </div>
       </div>
    </div>
	  
	    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $unidad4['ultimo']; ?> </h2>
          <p class="text-muted">Odometro Placas 592XLA</p>
        </div>
       </div>
    </div>
	  
	  
	    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $unidad5['ultimo']; ?> </h2>
          <p class="text-muted">Odometro Placas 662YXR</p>
        </div>
       </div>
    </div>
	  
	  -->
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	<!-- 
	  <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"><?php  echo $fedex['total']; ?>  </h2>
          <p class="text-muted">Recolecciones Fedex <small>(Mes)</small></p>
        </div>
       </div>
    </div>
	  
	  
	  
	     <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"><?php  echo $estafeta['total']; ?>  </h2>
          <p class="text-muted">Recolecciones Estafeta <small>(Mes)</small></p>
        </div>
       </div>
    </div>
	  
	  
	  
	     <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"><?php  echo $redpack['total']; ?>  </h2>
          <p class="text-muted">Recolecciones Redpack <small>(Mes)</small></p>
        </div>
       </div>
    </div>
	  
	  
	     <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"><?php  echo $express['total']; ?>  </h2>
          <p class="text-muted">Recolecciones Paquetexpres <small>(Mes)</small></p>
        </div>
       </div>
    </div>
	  
	  
	  
	     <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"><?php  echo $especial['total']; ?>  </h2>
          <p class="text-muted">Recoleccio Especial <small>(Mes)</small></p>
        </div>
       </div>
    </div>
	  
	  
	      <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"><?php  echo $envipaq['total']; ?>  </h2>
          <p class="text-muted">Recolecciones Envipaq <small>(Mes)</small></p>
        </div>
       </div>
    </div>
	  -->
	  
	  
	  
	  
	  
<?php include_once('layouts/footer.php'); ?>
