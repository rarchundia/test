<?php
  $page_title = 'odometro';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
  
?>

<?php 

if(isset($_POST['add_odometro'])){
 
  $p_placas= $_POST['placas'];
    $p_odometro= $_POST['odometro'];
  

  $p_operador= $_POST['operador'];
	
	  
	 $date    = make_date();
     $query  = "INSERT INTO odometro (";
     $query .=" placas, odometro, fecha, operador";
     $query .=") VALUES (";
     $query .="'{$p_placas}','{$p_odometro}','{$date}','{$p_operador}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
	 
			   
     if($db->query($query)){
	  $session->msg('s',"Odometro Agregado Exitosamente  . ");
	redirect('ingresa_odometro.php', false);
	  	 
	 }
	    else {
       $session->msg('d',' Lo siento, Falló al Agregar el Odometro.');
      redirect('ingresa_odometro.php', false);
	   }

  

 }
 
 

?>



<?php include_once('layouts/header.php'); ?>
 <div class="row">
     <div class="col-md-13">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-13">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Odometro 
                   
	</strong>
        </div>
        <div class="panel-body">
			
			
			
			<div id="panel">













<form method="post" action="ingresa_odometro.php" class="clearfix">
	
	<div class="col-md-6">
                    <select class="form-control"  name="placas" required autofocus>
                      <option>CAMIONETA</option>
                      <option value="842YAE">842YAE</option>
                      <option value="640XCK">640XCK</option>
                      <option value="J46AHW">J46AHW</option>
                      <option value="592XLA">592XLA</option>
                      <option value="662YXR">662YXR</option>
                    
                    </select>
	</div>
<div class="form-group">
		<div class="col-md-2"> <i class="glyphicon glyphicon-road"></i><label for="name">  Odometro</label></div>
		<div class="col-md-4">
                <input type="text" class="form-control" name="odometro" placeholder="Odometro" required onkeyup="mayus(this);" title="Introduce El Odometro de la Camioneta" data-toggle="tooltip">
            </div></div><br><br>
	<div class="col-md-6">
                    <select class="form-control" name="operador" title="Este Campo  Es Opcional" data-toggle="tooltip">
                      <option value="null">OPERADOR</option>
                      <option value="Antonio Zamudio">Antonio Zamudio</option>
                      <option value="Alberto Blanco">Alberto Blanco</option>
                      <option value="Eduardo Ruiz">Eduardo Ruiz</option>
                      <option value="Ivan Blanco">Ivan Blanco</option>
                      <option value="Jorge Ruiz">Jorge Ruiz</option>
                      
		</select></div>
	

	

	
	<button type="submit" name="add_odometro" class="btn btn-primary" >Ingresar Odometro</button>
	</div>
	
	</form>
			</div></div>
<?php include_once('layouts/footer.php'); ?>