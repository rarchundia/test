<?php
  $page_title = 'Odometro';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(4);
  
?>
<?php
 
	  
if(isset($_POST['odometrofecha'])){
    
//$id = $_POST['id'];
  $operador=$_POST['asiga_operador'];
	
  $fecha=$_POST['fecha'];
     } else{
       $session->msg("d", $errors);
       redirect('odometrofecha.php', false);
   }
	?>   
<?php 
include_once('layouts/header.php');
//$norte_odometro = recoleccion_diaria_odometro();
$norte_odometro = odometro_fecha($operador,$fecha);


$todometro_norte=odometro_total_fecha($operador,$fecha);

//foreach ($norte_odometro as $norte_echo):
              
 ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
   
     
      
        <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Odometro Placas <?php 
	
	echo $operador;
/*
	if($operador==5){
		
		echo "Norte";
	}
	
	
	if($operador==6){
		
		echo "Sur";
	}
	
	if($operador==7){
		
		echo "Oriente";
	}
	
	if($operador==8){
		
		echo "Poniente";
	}
	*/
	 ?> del:  <?php 
	$fecha_rango2=strftime("%d %B del %Y", strtotime($fecha)) ;
	
	echo $fecha_rango2; ?>
       
       
       </strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered"> 
            <thead>
              <tr>
                <th class="text-center" style="width: 30px;">#</th>
                <th class="text-center">PLACAS</th>   
                <th class="text-center">ODOMETRO</th>
				  
                
              </tr>
            </thead>
            <tbody>
              <?php foreach ($norte_odometro as $norte_echo):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-center"><?php echo remove_junk($norte_echo['placas']); ?></td>
                <td class="text-center">
                <?php echo remove_junk($norte_echo['odometro']); ?> Km</td>
              </tr> 
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
 
 
 
 
 
 
 
    </div>
  
  
  
  
  
  
  
  
  
  
  
  
  <?php include_once('layouts/footer.php'); ?>
