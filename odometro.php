<?php
  $page_title = 'Odometro';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(4);
 
?>
<?php 
include_once('layouts/header.php');
//$norte_odometro = recoleccion_diaria_odometro();
$p842YAE="842YAE";
$p640XCK="640XCK";
$pJ46AHW="J46AHW";
$p592XLA="592XLA";
$p662YXR="662YXR";
$pNRT2223="NRT2223";
$pNRT2010="NRT2010";
	
	
	$norte=5;
$sur=6;
$oriente=7;
$poniente=8;

$norte_odometro = odometro_total_hoy($p842YAE);
$sur_odometro = odometro_total_hoy($p640XCK);
$oriente_odometro = odometro_total_hoy($pJ46AHW);
$poniente_odometro = odometro_total_hoy($p592XLA);
$especial_odometro = odometro_total_hoy($p662YXR);
$TOTAL_pNRT2223 = odometro_total_hoy($pNRT2223);
$TOTAL_pNRT2010 = odometro_total_hoy($pNRT2010);


$todometro_norte=odometro_ultimo($p842YAE);
$todometro_sur=odometro_ultimo($p640XCK);
$todometro_oriente=odometro_ultimo($pJ46AHW);
$todometro_poniente=odometro_ultimo($p592XLA);
$todometro_especial=odometro_ultimo($p662YXR);
$todometro_NRT2223=odometro_ultimo($NRT2223);
$todometro_NRT2010=odometro_ultimo($NRT2010);


$suma_norte=suma_combustible($p842YAE);
$suma_sur=suma_combustible($p640XCK);
$suma_oriente=suma_combustible($pJ46AHW);
$suma_poniente=suma_combustible($p592XLA);
$suma_especial=suma_combustible($p662YXR);
$suma_NRT2223=suma_combustible($NRT2223);
$suma_NRT2010=suma_combustible($NRT2010);
//foreach ($norte_odometro as $norte_echo):
   

 $ultima_fecha_odometro=find_ultima_fecha_odometro('odometro');
 ?>
<?php 

if(isset($_POST['add_odometro'])){
  $date    = make_date(); 
  $p_placas= $_POST['placas'];
    $p_odometro= $_POST['odometro'];
	$p_fecha_form= $_POST['fecha_odometro'];
	
	$fecha_hora=date("H:i:s", strtotime($date));
	
	//date_format($date,'H:i:s');
	
  $p_fecha= $p_fecha_form." ".$fecha_hora;

  
	  
	
     $query  = "INSERT INTO odometro (";
     $query .=" placas, odometro, fecha";
     $query .=") VALUES (";
     $query .="'{$p_placas}','{$p_odometro}','{$p_fecha}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
	 
			   
     if($db->query($query)){
	  $session->msg('s',"Odometro Agregado Exitosamente  . ");
	//redirect('ingresa_odometro.php', false);
	  echo '<meta http-equiv="Refresh" content="0; url=odometro.php">';	 
	 }
	    else {
       $session->msg('d',' Lo siento, Falló al Agregar el Odometro.');
      //redirect('ingresa_odometro.php', false);
	   echo '<meta http-equiv="Refresh" content="0; url=odometro.php">';
		}

  

 }
 
 

?>
<?php 

if(isset($_POST['saldo'])){//para saldo UPDATE odometro SET saldo ='{$p_saldo_tarjeta}' WHERE placas='{$p_placas}'  version anterior
 
  $p_placas= $_POST['placas'];
    $p_saldo_tarjeta= $_POST['saldo_tarjeta'];
	$p_fecha_carga= $_POST['fecha'];
	  $date    = make_date();
	  $query="UPDATE odometro AS o CROSS JOIN( SELECT MAX(id) as max_id FROM odometro WHERE placas='{$p_placas}') AS resul SET o.importe_total= '{$p_saldo_tarjeta}', o.fecha_carga = '{$p_fecha_carga}' WHERE o.id=resul.max_id";
			   
     if($db->query($query)){
	  $session->msg('s',"Saldo Agregado Exitosamente  . ");
	//redirect('ingresa_odometro.php', false);
	  echo '<meta http-equiv="Refresh" content="0; url=odometro.php">';	 
	 }
	    else {
       $session->msg('d',' Lo siento, Falló al Agregar el Saldo a la Tarjeta.');
      //redirect('ingresa_odometro.php', false);
	   echo '<meta http-equiv="Refresh" content="0; url=odometro.php">';
		}

  
//UPDATE odometro AS o CROSS JOIN( SELECT MAX(id) as max_id FROM odometro) AS resul SET o.importe_total= '{$p_saldo_tarjeta}', o.fecha_carga = '{$date}' WHERE o.placas='{$p_placas}' AND o.id=resul.max_id
	//	  UPDATE odometro AS o CROSS JOIN( SELECT MAX(id) as max_id FROM odometro) AS resul SET o.saldo = '{$p_saldo_tarjeta}', o.fecha_saldo = '{$date}' WHERE o.placas='{$p_placas}' AND o.id=resul.max_id
 }
 
 

?>



<?php 

if(isset($_POST['combustible'])){
 
  $p_placas= $_POST['placas'];
    $p_importe= $_POST['importe'];
   $p_fecha= $_POST['fecha'];
	$p_saldo= $_POST['saldo'];
	$p_id= $_POST['id'];

 
	
	  
	
     $query  = "INSERT INTO odometro (";
     $query .=" placas, fecha_carga, importe_total";
     $query .=") VALUES (";
     $query .="'{$p_placas}','{$p_fecha}','{$p_importe}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
	 
			   
     if($db->query($query)){
		 
		(double)$p_saldototal=(double)$p_saldo-(double)$p_importe;
		 $query="UPDATE odometro SET saldo ='{$p_saldototal}' WHERE placas='{$p_placas}'";
		 if($db->query($query)){
		 
	  $session->msg('s',"Importe Cargado Correctamente. ");
	//redirect('ingresa_odometro.php', false);
	  echo '<meta http-equiv="Refresh" content="0; url=odometro.php">';	 
	 }
	 }
	    else {
       $session->msg('d',' Lo siento, Falló al Agregar el Importe.');
      //redirect('ingresa_odometro.php', false);
	   echo '<meta http-equiv="Refresh" content="0; url=odometro.php">';
		}

  

 }
 
 

?>
   


<?php include_once('layouts/header.php'); ?>
  
       <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
     
		
		
		<div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Odometro
	<span class="pull-right">

	<strong><h5><i class="glyphicon glyphicon-time"> Última Fecha Registrada</i> <?php 
		
						$fecha_rango2=strftime("%d %B del %Y", strtotime($ultima_fecha_odometro['ultima_fecha_ingreso'])) ;
					echo $fecha_rango2; 
		
		
		?>
	</h5></strong>
				</span>   
       </strong>
        </div>
		  
		  
		  
        <div class="panel-body">
       

<form method="post" action="odometro.php" class="clearfix">
	
	<div class="col-md-6">
                    <select class="form-control"  name="placas" required autofocus>
                      <option>PLACAS</option>
                      <option value="842YAE">842YAE</option>
                      <option value="640XCK">640XCK</option>
                      <option value="J46AHW">J46AHW</option>
                      <option value="592XLA">592XLA</option>
                      <option value="662YXR">662YXR</option>
					  <option value="NRT2223">NRT2223</option>
					  <option value="NRT2010">NRT2010</option>
                    
                    </select>
	</div>
<div class="form-group">
		
		<div class="col-md-6">
			<div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                <input type="text" class="form-control" name="odometro" placeholder="Odometro" required onkeyup="mayus(this);" title="Introduce El Odometro de la Camioneta" data-toggle="tooltip">
            </div>
	
	</div><br><br>
	<!--<div class="col-md-6">
                    <select class="form-control" name="operador" title="Este Campo  Es Opcional" data-toggle="tooltip">
                      <option value="null">OPERADOR</option>
                      <option value="Hector Espindola">Hector Espindola</option>
                      <option value="Alberto Blanco">Alberto Blanco</option>
                      <option value="Eduardo Ruiz">Eduardo Ruiz</option>
                      <option value="Ivan Blanco">Ivan Blanco</option>
                      <option value="Jorge Ruiz">Jorge Ruiz</option>
                      <option value="Gerardo Alonso">Gerardo Alonso</option>
		</select></div>
	-->
<div class="col-md-6">
                    
	
	
	
	
	<input type="text" class="form-control" autocomplete="off" name="fecha_odometro"  required placeholder="Ingresa Fecha de Odometro " id="fecha_odometro">
	
	
	</div>
	

	<div class="col-md-6">
	<button type="submit" name="add_odometro" class="btn btn-primary btn-block" >Ingresar Odometro</button>
	</div></div>
	
	</form>
        </div>
      </div> </div>
    <!--</div>-->



<div class="col-md-6">
		<div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>CARGA DE GASOLINA
	
       </strong>
        </div>
		  
		  
		  
        <div class="panel-body">
       

<form method="post" action="odometro.php" class="clearfix">
	
	<div class="col-md-6">
                    <select class="form-control"  name="placas" required autofocus>
                      <option>PLACAS</option>
                      
                      <option value="640XCK">640XCK</option>
                      <option value="J46AHW">J46AHW</option>
                      <option value="592XLA">592XLA</option>
                      <option value="662YXR">662YXR</option>
						<option value="842YAE">842YAE</option>
                    <option value="NRT2223">NRT2223</option>
					  <option value="NRT2010">NRT2010</option>
                    </select>
	</div>
<div class="form-group">
		
		<div class="col-md-6">
			<div class="input-group">
  <span class="input-group-addon">$</span>
                <input type="text" class="form-control" name="saldo_tarjeta" placeholder="Importe Total" required >
            </div>
	
	</div><br><br>
	<div class="col-md-6">
                    
	
	<input type="text" autocomplete="off" name="fecha" id="fecha" class="form-control" required placeholder="Ingresa Fecha de Carga">
	
	
	</div>
	

	

	<div class="col-md-6">
	<button type="submit" name="saldo" class="btn btn-primary btn-block"  >Enviar</button>
	</div></div>
	
	</form>
        </div>
      </div></div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
				
		
       

 
 
   <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Odometro Placas 640XCK
       
       <article align="right"><?php echo $todometro_sur['ultimo'];?> Km Total</article>
       </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover table-responsive"> 
            <thead>
              <tr>
                
                <th class="text-center">PLACAS</th>   
            <!--    <th class="text-center">FECHA DE ACTUALIZACION</th> -->  
                
                 <th class="text-center">CARGA COMBUSTIBLE<sub>(Fecha de Carga)</sub></th>
				   <th class="text-center">IMPORTE TOTAL<sub>(ultima carga)</sub></th>
				  
				  <th class="text-center">SALDO ACUMULADO<sub>(mes)</sub></th>
                <!--<th class="text-center">SALDO DISPONIBLE</th>-->
                
              </tr>
            </thead>
            <tbody>
              <?php //foreach ($norte_odometro as $norte_echo):?>
              <tr>
				 
                <td class="text-center">640XCK</td>
				<!--  <td class="text-center">
				  
				  <?php 
					
						$fecha_actualizada=strftime("%d %B del %Y", strtotime($sur_odometro['fecha'])) ;
					  echo $fecha_actualizada; ?></td>-->
					  
				  <td><center><?php 
					
						$fecha_rango2=strftime("%d %B del %Y", strtotime($sur_odometro['fecha_carga'])) ;
					echo $fecha_rango2; ?></center></td>
                <td><center>$ <?php echo $sur_odometro['importe_total']; ?>.<sup>00</sup></center></td>
               
				 <td><center>
					 
					 
					 $ <?php echo $suma_sur['sumatoria'];?>.<sup>00</sup>
					 
					 </center
					 </td>
				  
				  
				  <!--para actualizar saldo--><!-- <td><center>
				  
				  
				  
				  
				  
				  
				  <form method="post" action="odometro.php" class="clearfix">
<input type="hidden" name="id_importe" value="<?php echo $sur_odometro['id']; ?>">
					<input type="hidden" name="placas" value="640XCK">
						  <input type="text" class="form-control" name="importe" placeholder="Importe Total" required onkeyup="mayus(this);" title="Introduce El Importe Total de Carga" data-toggle="tooltip">
					  <input type="hidden" value="<?php echo $sur_odometro['saldo']; ?>" name="saldo">
					  
				  <input type="text" class="datepicker form-control" autocomplete="off" name="fecha"  required placeholder="Ingresa Fecha de Carga">
	<button type="submit" name="combustible" class="btn btn-primary btn-block"  > Ingresar Importe</button>
					  
				  </form>
				  
				  
				  <td><center>$ <?php echo $sur_odometro['saldo']; ?><sup>00</sup></center></td>
                -->
                  </div>
                
              </tr> 
             <?php //endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>






  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Odometro Placas J46AHW
       
       <article align="right"><?php echo $todometro_oriente['ultimo'];?> Km Total</article>
       </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover table-responsive"> 
            <thead>
              <tr>
                
                <th class="text-center">PLACAS</th>   
                <!--<th class="text-center">FECHA DE ACTUALIZACION</th>-->
                 <th class="text-center">CARGA COMBUSTIBLE<sub>(Fecha de Carga)</sub></th>
				   <th class="text-center">IMPORTE TOTAL<sub>(ultima carga)</sub></th>
				  
				  <th class="text-center">SALDO ACUMULADO<sub>(mes)</sub></th>
				  
				 <!-- <th class="text-center">CARGA DE GASOLINA</th>
                <th class="text-center">SALDO DISPONIBLE</th>-->
              </tr>
            </thead>
            <tbody>
              <?php //foreach ($norte_odometro as $norte_echo):?>
              <tr>
				 
                <td class="text-center">J46AHW</td>
				  
			<!--	  <td class="text-center">
				  
				  <?php 
					
						$fecha_actualizada=strftime("%d %B del %Y", strtotime($oriente_odometro['fecha'])) ;
					  echo $fecha_actualizada; ?></td>-->
                <td><center><?php 
					
						$fecha_rango2=strftime("%d %B del %Y", strtotime($oriente_odometro['fecha_carga'])) ;
					echo $fecha_rango2; ?></center></td>
                <td><center>$ <?php echo $oriente_odometro['importe_total']; ?>.<sup>00</sup></center></td>
             <td><center>
					 
					 
					 $ <?php echo $suma_oriente['sumatoria'];?>.<sup>00</sup>
					 
					 </center
					 </td>
				 
				 <!--para actualizar saldo--><!-- <td><center>
				  <form method="post" action="odometro.php" class="clearfix">
<input type="text" name="id_importe" value="<?php echo $oriente_odometro['id']; ?>">
					<input type="hidden" name="placas" value="J46AHW">
						  <input type="text" class="form-control" name="importe" placeholder="Importe Total" required onkeyup="mayus(this);" title="Introduce El Importe Total de Carga" data-toggle="tooltip">
					  <input type="hidden" value="<?php echo $oriente_odometro['saldo']; ?>" name="saldo">
					  
				  <input type="text" class="datepicker form-control" autocomplete="off" name="fecha"  required placeholder="Ingresa Fecha de Carga">
	<button type="submit" name="combustible" class="btn btn-primary btn-block"  >Ingresar Importe</button>
					  
				  </form>
				  </td>
                <td><center>$ <?php echo $oriente_odometro['saldo']; ?><sup>00</sup></center></td>
                -->
                  </div>
                
              </tr> 
             <?php //endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>






  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Odometro Placas 592XLA
       
       <article align="right"><?php echo $todometro_poniente['ultimo'];?> Km Total</article>
       </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover table-responsive"> 
            <thead>
              <tr>
                
                <th class="text-center">PLACAS</th>   
             <!--   <th class="text-center">FECHA DE ACTUALIZACION</th>-->
                 <th class="text-center">CARGA COMBUSTIBLE<sub>(Fecha de Carga)</sub></th>
				   <th class="text-center">IMPORTE TOTAL<sub>(ultima carga)</sub></th>
				  
				  <th class="text-center">SALDO ACUMULADO<sub>(mes)</sub></th>
				  
				 <!-- <th class="text-center">CARGA DE GASOLINA</th>
                <th class="text-center">SALDO DISPONIBLE</th>-->
              </tr>
            </thead>
            <tbody>
              <?php //foreach ($norte_odometro as $norte_echo):?>
              <tr>
				 
                <td class="text-center">592XLA</td>
				  
			<!--	  <td class="text-center">
				  
				  <?php 
					
						$fecha_actualizada=strftime("%d %B del %Y", strtotime($poniente_odometro['fecha'])) ;
					  echo $fecha_actualizada; ?></td>-->
                <td><center><?php 
					
						$fecha_rango2=strftime("%d %B del %Y", strtotime($poniente_odometro['fecha_carga'])) ;
					echo $fecha_rango2; ?></center></td>
                <td><center>$ <?php echo $poniente_odometro['importe_total']; ?>.<sup>00</sup></center></td>
               <td><center>
					 
					 
					 $ <?php echo $suma_poniente['sumatoria'];?>.<sup>00</sup>
					 
					 </center
					 </td>
				   
				   <!--para actualizar saldo--> <!--<td><center>
				  
				  <form method="post" action="odometro.php" class="clearfix">

					<input type="hidden" name="placas" value="592XLA">
						  <input type="text" class="form-control" name="importe" placeholder="Importe Total" required onkeyup="mayus(this);" title="Introduce El Importe Total de Carga" data-toggle="tooltip">
					  <input type="hidden" value="<?php echo $poniente_odometro['saldo']; ?>" name="saldo">
					  
				  <input type="text" class="datepicker form-control" autocomplete="off" name="fecha"  required placeholder="Ingresa Fecha de Carga">
	<button type="submit" name="combustible" class="btn btn-primary btn-block"  >Ingresar Importe</button>
					  
				  </form>
				  
				  </center></td>
                <td><center>$ <?php echo $poniente_odometro['saldo']; ?><sup>00</sup></center></td>-->
                
                  </div>
                
              </tr> 
             <?php //endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>







  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Odometro Placas 662YXR
       
       <article align="right"><?php echo $todometro_especial['ultimo'];?> Km Total</article>
       </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover table-responsive"> 
            <thead>
              <tr>
                
                <th class="text-center">PLACAS</th>   
               <!-- <th class="text-center">FECHA DE ACTUALIZACION</th>-->
                 <th class="text-center">CARGA COMBUSTIBLE<sub>(Fecha de Carga)</sub></th>
				   <th class="text-center">IMPORTE TOTAL<sub>(ultima carga)</sub></th>
				  
				  <th class="text-center">SALDO ACUMULADO<sub>(mes)</sub></th>
				  
				  <!--<th class="text-center">CARGA DE GASOLINA</th>
                <th class="text-center">SALDO DISPONIBLE</th>-->
              </tr>
            </thead>
            <tbody>
              <?php //foreach ($norte_odometro as $norte_echo):?>
              <tr>
				 
                <td class="text-center">662YXR</td>
				  
				 <!-- <td class="text-center">
				  
				  <?php 
					
						$fecha_actualizada=strftime("%d %B del %Y", strtotime($especial_odometro['fecha'])) ;
					  echo $fecha_actualizada; ?></td>-->
				  
                <td><center><?php 
					
						$fecha_rango2=strftime("%d %B del %Y", strtotime($especial_odometro['fecha_carga'])) ;
					echo $fecha_rango2; ?></center></td>
                <td><center>$ <?php echo $especial_odometro['importe_total']; ?>.<sup>00</sup></center></td>
               <td><center>
					 
					 
					 $ <?php echo $suma_especial['sumatoria'];?>.<sup>00</sup>
					 
					 </center
					 </td>
				   
				   <!--para actualizar saldo--> <!--<td><center>
				  
				  <form method="post" action="odometro.php" class="clearfix">

					<input type="hidden" name="placas" value="662YXR">
						  <input type="text" class="form-control" name="importe" placeholder="Importe Total" required onkeyup="mayus(this);" title="Introduce El Importe Total de Carga" data-toggle="tooltip">
					  <input type="hidden" value="<?php echo $especial_odometro['saldo']; ?>" name="saldo">
					  
				  <input type="text" class="datepicker form-control" autocomplete="off" name="fecha"  required placeholder="Ingresa Fecha de Carga">
	<button type="submit" name="combustible" class="btn btn-primary btn-block"  >Ingresar Importe</button>
					  
				  </form>
				  
				  </center></td>
                <td><center>$ <?php echo $especial_odometro['saldo']; ?><sup>00</sup></center></td>-->
                
                  </div>
                
              </tr> 
             <?php //endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
	  
	  </div>
	  
	  
	  
	  
	  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Odometro Placas NRT2223
       
       <article align="right"><?php echo $todometro_NRT2223['ultimo'];?> Km Total</article>
       </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover table-responsive"> 
            <thead>
              <tr>
                
                <th class="text-center">PLACAS</th>   
               <!-- <th class="text-center">FECHA DE ACTUALIZACION</th>-->
                 <th class="text-center">CARGA COMBUSTIBLE<sub>(Fecha de Carga)</sub></th>
				   <th class="text-center">IMPORTE TOTAL<sub>(ultima carga)</sub></th>
				  
				  <th class="text-center">SALDO ACUMULADO<sub>(mes)</sub></th>
				  
				  <!--<th class="text-center">CARGA DE GASOLINA</th>
                <th class="text-center">SALDO DISPONIBLE</th>-->
              </tr>
            </thead>
            <tbody>
              <?php //foreach ($norte_odometro as $norte_echo):?>
              <tr>
				 
                <td class="text-center">NRT2223</td>
				  
				 <!-- <td class="text-center">
				  
				  <?php 
					
						$fecha_actualizada=strftime("%d %B del %Y", strtotime($TOTAL_pNRT2223['fecha'])) ;
					  echo $fecha_actualizada; ?></td>-->
				  
                <td><center><?php 
					
						$fecha_rango2=strftime("%d %B del %Y", strtotime($TOTAL_pNRT2223['fecha_carga'])) ;
					echo $fecha_rango2; ?></center></td>
                <td><center>$ <?php echo $TOTAL_pNRT2223['importe_total']; ?>.<sup>00</sup></center></td>
               <td><center>
					 
					 
					 $ <?php echo $suma_NRT2223['sumatoria'];?>.<sup>00</sup>
					 
					 </center
					 </td>
				   
				   <!--para actualizar saldo--> <!--<td><center>
				  
				  <form method="post" action="odometro.php" class="clearfix">

					<input type="hidden" name="placas" value="662YXR">
						  <input type="text" class="form-control" name="importe" placeholder="Importe Total" required onkeyup="mayus(this);" title="Introduce El Importe Total de Carga" data-toggle="tooltip">
					  <input type="hidden" value="<?php echo $especial_odometro['saldo']; ?>" name="saldo">
					  
				  <input type="text" class="datepicker form-control" autocomplete="off" name="fecha"  required placeholder="Ingresa Fecha de Carga">
	<button type="submit" name="combustible" class="btn btn-primary btn-block"  >Ingresar Importe</button>
					  
				  </form>
				  
				  </center></td>
                <td><center>$ <?php echo $especial_odometro['saldo']; ?><sup>00</sup></center></td>-->
                
                  </div>
                
              </tr> 
             <?php //endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
   </div>

		  
		  
		    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Odometro Placas NRT2010
       
       <article align="right"><?php echo $todometro_NRT2223['ultimo'];?> Km Total</article>
       </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover table-responsive"> 
            <thead>
              <tr>
                
                <th class="text-center">PLACAS</th>   
               <!-- <th class="text-center">FECHA DE ACTUALIZACION</th>-->
                 <th class="text-center">CARGA COMBUSTIBLE<sub>(Fecha de Carga)</sub></th>
				   <th class="text-center">IMPORTE TOTAL<sub>(ultima carga)</sub></th>
				  
				  <th class="text-center">SALDO ACUMULADO<sub>(mes)</sub></th>
				  
				  <!--<th class="text-center">CARGA DE GASOLINA</th>
                <th class="text-center">SALDO DISPONIBLE</th>-->
              </tr>
            </thead>
            <tbody>
              <?php //foreach ($norte_odometro as $norte_echo):?>
              <tr>
				 
                <td class="text-center">NRT2010</td>
				  
				 <!-- <td class="text-center">
				  
				  <?php 
					
						$fecha_actualizada=strftime("%d %B del %Y", strtotime($TOTAL_pNRT2010['fecha'])) ;
					  echo $fecha_actualizada; ?></td>-->
				  
                <td><center><?php 
					
						$fecha_rango2=strftime("%d %B del %Y", strtotime($TOTAL_pNRT2010['fecha_carga'])) ;
					echo $fecha_rango2; ?></center></td>
                <td><center>$ <?php echo $TOTAL_pNRT2010['importe_total']; ?>.<sup>00</sup></center></td>
               <td><center>
					 
					 
					 $ <?php echo $suma_NRT2010['sumatoria'];?>.<sup>00</sup>
					 
					 </center
					 </td>
				   
				   <!--para actualizar saldo--> <!--<td><center>
				  
				  <form method="post" action="odometro.php" class="clearfix">

					<input type="hidden" name="placas" value="662YXR">
						  <input type="text" class="form-control" name="importe" placeholder="Importe Total" required onkeyup="mayus(this);" title="Introduce El Importe Total de Carga" data-toggle="tooltip">
					  <input type="hidden" value="<?php echo $especial_odometro['saldo']; ?>" name="saldo">
					  
				  <input type="text" class="datepicker form-control" autocomplete="off" name="fecha"  required placeholder="Ingresa Fecha de Carga">
	<button type="submit" name="combustible" class="btn btn-primary btn-block"  >Ingresar Importe</button>
					  
				  </form>
				  
				  </center></td>
                <td><center>$ <?php echo $especial_odometro['saldo']; ?><sup>00</sup></center></td>-->
                
                  </div>
                
              </tr> 
             <?php //endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
   </div>
		  
		  
		  
  <script>
  $('#fecha_odometro, #fecha').datepicker({
    format: "yyyy-mm-dd",
    clearBtn: true,
    language: "es",
    daysOfWeekDisabled: "0,6",
    daysOfWeekHighlighted: "0,6",
    autoclose: true,
    todayHighlight: true,
    datesDisabled: ['2019-09-21'],
    toggleActive: true
  
	
});
  
	  
	 
  
	  
	  
  
  
  
  </script>
  
  
  <?php include_once('layouts/footer.php'); ?>
