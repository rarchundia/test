<?php
  $page_title = 'Cotización Detalle';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(10);

	


if(isset($_POST['agrega_entrada'])){
 


  //$razonsocial_des = remove_junk($db->escape($_POST['razonsocial_des']));
 
   if(empty($errors)){
     $p_id_cot = remove_junk($db->escape($_POST['id_cot']));
	$p_detalles = remove_junk($db->escape($_POST['detalles']));
	$p_id_user = remove_junk($db->escape($_POST['id_user']));
	  
     $date    = make_date();
     $query  = "INSERT INTO logistica_cot_detalles (";
     $query .="  detalles, id_user, id_cot, fecha";
     $query .=") VALUES (";
     $query .="'{$p_detalles}','{$p_id_user}','{$p_id_cot}','{$date}' ";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
//con->set_charset('utf8mb4');
	   if($db->query($query)){
       
	  $session->msg('s',"Entrada Agregada");
      echo '<meta http-equiv="Refresh" content="0; url=logistica_cot_detalles.php?id='.$p_id_cot.'">';
		 // redirect('entrega.php', false);
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Agregar La Entreda,  Intenta Nuevamente.');
      echo '<meta http-equiv="Refresh" content="0; url=logistica_cot_detalles.php?id='.$p_id_cot.'">';

			//redirect('entrega.php', false);
	   }

   } else{
     $session->msg("d", $errors);
   
      echo '<meta http-equiv="Refresh" content="0; url=logistica_cot.php?id='.$p_id_cot.'">';
   //redirect('entrega.php',false);
   }

 }





if(isset($_POST['agrega_acepta'])){

if(empty($errors)){
    
	 $p_id_cot = remove_junk($db->escape($_POST['id_cot']));
		$p_id_user = remove_junk($db->escape($_POST['id_user']));
	
    $p_adu_compra = remove_junk($db->escape($_POST['adu_compra']));
    $p_adu_venta = remove_junk($db->escape($_POST['adu_venta']));
	$p_adu_proveedor = remove_junk($db->escape($_POST['adu_proveedor']));
	
    	$p_bod_compra = remove_junk($db->escape($_POST['bod_compra']));
    $p_bod_venta = remove_junk($db->escape($_POST['bod_venta']));
	$p_bod_proveedor = remove_junk($db->escape($_POST['bod_proveedor']));
	
    	$p_tra_compra = remove_junk($db->escape($_POST['tra_compra']));
    $p_tra_venta = remove_junk($db->escape($_POST['tra_venta']));
	$p_tra_proveedor = remove_junk($db->escape($_POST['tra_proveedor']));
    
    	$p_ae_compra = remove_junk($db->escape($_POST['ae_compra']));
    $p_ae_venta = remove_junk($db->escape($_POST['ae_venta']));
	$p_ae_proveedor = remove_junk($db->escape($_POST['ae_proveedor']));
    
    	$p_ma_compra = remove_junk($db->escape($_POST['ma_compra']));
    $p_ma_venta = remove_junk($db->escape($_POST['ma_venta']));
	$p_ma_proveedor = remove_junk($db->escape($_POST['ma_proveedor']));
    
    	$p_te_compra = remove_junk($db->escape($_POST['te_compra']));
    $p_te_venta = remove_junk($db->escape($_POST['te_venta']));
	$p_te_proveedor = remove_junk($db->escape($_POST['te_proveedor']));
    
    
    $date    = make_date();
	
	$query  = " UPDATE logistica_cot SET estatus=1, fecha_fin='{$date}', adu_compra='{$p_adu_compra}'
    ,adu_venta='{$p_adu_venta}',adu_proveedor='{$p_adu_proveedor}',bod_compra='{$p_bod_compra}' ,bod_venta='{$p_bod_venta}',bod_proveedor='{$p_bod_proveedor}' ,tra_compra='{$p_tra_compra}' ,tra_venta='{$p_tra_venta}' ,tra_proveedor='{$p_tra_proveedor}'  ,ae_compra='{$p_ae_compra}'
     ,ae_venta='{$p_ae_venta}'  ,ae_proveedor='{$p_ae_proveedor}' ,ma_compra='{$p_ma_compra}' ,ma_venta='{$p_ma_venta}' ,ma_proveedor='{$p_ma_proveedor}' ,te_compra='{$p_te_compra}',te_venta='{$p_te_venta}',te_proveedor='{$p_te_proveedor}' WHERE id='{$p_id_cot}'";
	
	 $result = $db->query($query);
          if($result && $db->affected_rows() === 1){
			  
			 $query  = "INSERT INTO logistica_cot_detalles (";
     $query .="  detalles, id_user, id_cot, fecha";
     $query .=") VALUES (";
     $query .="'CLIENTE ACEPTA COTIZACION','{$p_id_user}','{$p_id_cot}','{$date}' ";
     $query .=")";
			  			  
			  $db->query($query);
			  
			  $session->msg('s',"Cotización  Agregada Correctamente ");
            echo '<meta http-equiv="Refresh" content="0; url=logistica_cot_detalles.php?id='.$p_id_cot.'">';
	  //redirect('incidencias.php', false);
          } else {
            $session->msg('d',' Fallo al Agregar la Cotización Intentalo Nuevamente');
           echo '<meta http-equiv="Refresh" content="0; url=logistica_cot_detalles.php?id='.$p_id_cot.'">';
		  //redirect('incidencias.php', false);
          }
}
	else{
     $session->msg("d", $errors);
    // redirect('aclaraciones.php',false);
	 echo '<meta http-equiv="Refresh" content="0; url=logistica_cot_detalles.php?id='.$p_id_cot.'">';
	  }
	
	
	
}






if(isset($_POST['no_acepta'])){

if(empty($errors)){
    
	 $p_id_cot = remove_junk($db->escape($_POST['id_cot']));
		$p_id_user = remove_junk($db->escape($_POST['id_user']));
	$p_notas = remove_junk($db->escape($_POST['no_acepta']));
    
	
    $date    = make_date();
	
	$query  = " UPDATE logistica_cot SET estatus=2, fecha_fin='{$date}' WHERE id='{$p_id_cot}'";
	
	 $result = $db->query($query);
          if($result && $db->affected_rows() === 1){
			  
			 $query  = "INSERT INTO logistica_cot_detalles (";
     $query .="  detalles, id_user, id_cot, fecha";
     $query .=") VALUES (";
     $query .="'{$p_notas} ','{$p_id_user}','{$p_id_cot}','{$date}' ";
     $query .=")";
			  			  
			  $db->query($query);
			  
			  $session->msg('s',"Estatus  Agregado Correctamente ");
            echo '<meta http-equiv="Refresh" content="0; url=logistica_cot_detalles.php?id='.$p_id_cot.'">';
	  //redirect('incidencias.php', false);
          } else {
            $session->msg('d',' Fallo al Agregar el  Estatus de la Cotización Intentalo Nuevamente');
           echo '<meta http-equiv="Refresh" content="0; url=logistica_cot_detalles.php?id='.$p_id_cot.'">';
		  //redirect('incidencias.php', false);
          }
}
	else{
     $session->msg("d", $errors);
    // redirect('aclaraciones.php',false);
	 echo '<meta http-equiv="Refresh" content="0; url=logistica_cot_detalles.php?id='.$p_id_cot.'">';
	  }
	
	
	
}





?>



<?php include_once('layouts/header.php');
//$proyecto = t_proyectos($user['id']);	

?>
<script src="drop/dropzone.js"></script>
<link rel="stylesheet" href="drop/dropzone.css">
<style>

	.tab-pane{
		color:black;
		background-color: white;
		
	}
	ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 20px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
	
	
	
	
</style>


<?php 
//    $detalles = ticket_detalle($user['id']);
//	  foreach ($sin_resolver as  $sin_r): ?>	



 <div class="row">
     <div class="col-md-13">
       <?php echo display_msg($msg);
		  $id=$_GET["id"];
		// $guia=$_GET["guia"];
		 $folio=cotizacion($id);
		 ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
       
        <div class="panel-body">
			
		
  <div class="col-md-12">
	  
	  <div class="row">
    <div class="col-md-2 mb-3">
		
        <ul class="list-group ">
			
	  <?php $tickets_poruser=contador_mis_cotizaciones("logistica_cot",  $user['id']);?>
			<a href="logistica_cot.php"  class="list-group-item" style="text-decoration:none; color: black;">Mis Cotizaciones
 <span class="badge  alert-danger"><?php  echo $tickets_poruser["contador_cotizacion"];?></span>
	  </a>
			
		<a href="logistica_cot.php"  class="list-group-item" style="text-decoration:none; color: black;"><i class="glyphicon glyphicon-arrow-left"></i> Regresar
 
	  </a>	
</ul>	
		
		</div>	
	  <div class="col-md-10">
	
		  
		 
			  	  <div class="col-md-12">
                      
                        <div class="col-md-4">
  <label for="comment"> # de Cotización <strong><?php echo $id;?></strong></strong>
                      </div>
        
	    <?php 
	 foreach ($folio as $folios):
	  
	  if($folios["estatus"]==1){
		  echo "<center><h2 style='color: red;'><br><br>Ya se Agrego la Cotización que Acepto el Cliente</center></h2><br><br>";
	  }
      
      elseif($folios["estatus"]==2){
          
          echo "<center><h2 style='color: red;'><br><br>No Se Acepto Ninguna Cotización</center></h2><br><br>";
      }else{
		  
		  
	  ?>
                      
	 <div class="col-md-8">
                            <a class="btn btn-success pull-right" data-toggle="collapse" href="#acepta" role="button" aria-expanded="false" aria-controls="acepta">
    Acepta  <i class="glyphicon glyphicon-thumbs-up"></i>
  </a>
                            <a class="btn btn-danger pull-right" data-toggle="collapse" href="#no_acepta" role="button" aria-expanded="false" aria-controls="acepta">
    No Acepta  <i class="glyphicon glyphicon-thumbs-down"></i>
  </a>
                      </div>
                      
                      
                      <div class="collapse" id="no_acepta">
  <div class="card card-body">  <br>  <br>
  
      <form action="logistica_cot_detalles.php" method="post">
			<div class="form-group ">		  
			
                <input type="text" name="no_acepta" class="form-control" placeholder="Agrega Alguna Nota de porque no Acepto  Ninguna Propuesta">
			
		<button type="submit" class="btn btn-info pull-right" name="no_acepta_cot">Modificar Estatus</button>
			<input type="hidden" name="id_cot" value="<?php echo $id;?>">
				<input type="hidden" name="id_user" value="<?php echo $user['id'];?>">
          </div>
	  </form>
      
      
      
  </div>  </div>
      
       <div class="collapse" id="acepta">
  <div class="card card-body">
      
	  <form action="logistica_cot_detalles.php" method="post">
			<div class="form-group ">
                
                <?php
                
                if($folios["aduana"]==1){
                    
                    echo '<br><h2>Aduana</h2>
                    		<div class="col-md-4"><input type="text" name="adu_compra" class="form-control" placeholder="Tarifa de Compra Aduana"></div>
			<div class="col-md-4"><input type="text" name="adu_venta" class="form-control" placeholder="Tarifa de Venta Aduana"></div>
                
			<div class="col-md-4"><input type="text" name="adu_proveedor" class="form-control" placeholder="Proveedor Aduana" onkeyup="mayus(this);"></div><br>
    
    ';
                }
          if($folios["tramite"]==1){
                    
                    echo '<br><h2>Tramite</h2>
                    		<div class="col-md-4"><input type="text" name="tra_compra" class="form-control" placeholder="Tarifa de Compra Tramite"></div>
			<div class="col-md-4"><input type="text" name="tra_venta" class="form-control" placeholder="Tarifa de Venta Tramite"></div>
                
			<div class="col-md-4"><input type="text" name="tra_proveedor" class="form-control" placeholder="Proveedor Tramite" onkeyup="mayus(this);"></div><br>
    
    ';
                }
          if($folios["bodega"]==1){
                    
                    echo '<br><h2>Bodega</h2>
                    	<div class="col-md-4">	<input type="text" class="form-control" name="bod_compra" placeholder="Tarifa de Compra Bodega"></div>
			<div class="col-md-4"><input type="text" name="bod_venta" class="form-control" placeholder="Tarifa de Venta Bodega"></div>
                
			<div class="col-md-4"><input type="text" name="bod_proveedor" class="form-control" placeholder="Proveedor Bodega" onkeyup="mayus(this);"></div><br>
    
    ';
                }
          if($folios["aereo"]==1){
                    
                    echo '<br><h2>Flete Aereo</h2>
                    	<div class="col-md-4">		<input type="text" class="form-control" name="ae_compra" placeholder="Tarifa de Compra Aereo"></div>
			<div class="col-md-4">	<input type="text" name="ae_venta" class="form-control" placeholder="Tarifa de Venta Aereo"></div>
                
			<div class="col-md-4">	<input type="text" name="ae_proveedor" class="form-control" placeholder="Proveedor Aereo" onkeyup="mayus(this);"></div><br>
    
    ';
                }
          if($folios["maritimo"]==1){
                    
                    echo '<br><h2>Flete Maritimo</h2>
                    	<div class="col-md-4">	<input type="text" class="form-control" name="ma_compra" placeholder="Tarifa de Compra Maritimo"></div>
			<div class="col-md-4"><input type="text" name="ma_venta" class="form-control" placeholder="Tarifa de Venta Maritimo"></div>
                
			<div class="col-md-4"><input type="text" name="ma_proveedor" class="form-control" placeholder="Proveedor Maritimo" onkeyup="mayus(this);"></div><br>
    
    ';
                }
          
          if($folios["terrestre"]==1){
                    
                    echo '<br><h2>Flete Terrestre</h2>
                    		<div class="col-md-4"><input type="text" class="form-control" name="te_compra" placeholder="Tarifa de Compra Terrestre"></div>
			<div class="col-md-4"><input type="text" name="te_venta" class="form-control" placeholder="Tarifa de Venta Terrestre"></div>
                
			<div class="col-md-4"><input type="text" name="te_proveedor" class="form-control" placeholder="Proveedor Terrestre" onkeyup="mayus(this);"></div><br>
    
    ';
                }
                ?>
	            
                
			<br><br>
		<button type="submit" class="btn btn-info pull-right" name="agrega_acepta">Agrega Tarifas</button>
			<input type="hidden" name="id_cot" value="<?php echo $id;?>">
				<input type="hidden" name="id_user" value="<?php echo $user['id'];?>">
          </div>
	  </form>	
  
                    </div>
     
           
           </label>
			  </div>
          
          </div>	
			  
			
		  <div class="col-md-12"><br><br>
			  <form action="logistica_cot_detalles.php" method="post">
				   <div class="form-group">
			 
			
				  <p class="lead emoji-picker-container">
  <textarea class="form-control" rows="5" id="comment" name="detalles" data-emojiable="true" data-emoji-input="unicode"  onkeyup="mayus(this);"></textarea>
					   </p>

		
		<input type="hidden" name="id_user" value="<?php echo $user['id'];?>">
		<input type="hidden" name="id_cot" value="<?php echo $id;?>">
		<button type="submit" class="btn btn-info pull-right" name="agrega_entrada">Agrega Entrada</button>
		</div>
				  </form>   </div><br><br>
	
		  
		  <!--comentarios-->
	  <?php 
	  }
	   endforeach;
                      
                       $final_tarifas=detalles_final_tarifa($id);
             foreach ($final_tarifas as  $tarifas):
		  if($tarifas["estatus"]==1){
              ?>
          
          <div class="col-md-10">
	  <!-- Left-aligned -->
<div class="media">
  <div class="media-left">
   
	   <img src="uploads/users/<?php echo $tarifas['image'];?>"  style="width:100px" >
	  
	  
  </div>
  <div class="media-body">
    <h4 class="media-heading" style="color: maroon;" ><?php echo $tarifas['name'];?> <small><i style="color: red;"><?php echo $tarifas['fecha_fin'];?></i></small></h4>
    <p><?php 
         if($tarifas['aduana']==1){
             
             $resul=(int)$tarifas['adu_venta']-(int)$tarifas['adu_compra'];
              echo '
              <br><h2 style="color: maroon;">Aduana</h2>
                    	<div class="col-md-3">Tarifa de Compra<br>
                        '.$tarifas['adu_compra'].'</div>
                        
			<div class="col-md-3">Tarifa de Venta <br>
            '.$tarifas['adu_venta'].'</div>
                
			<div class="col-md-3">	Proveedor<br>
            '.$tarifas['adu_proveedor'].'</div>
            
            <div class="col-md-3">	Profit<br>
            '.$resul.'</div><br>
            ';   
                 
             }
              
              if($tarifas['bodega']==1){
             
             $resul=(int)$tarifas['bod_venta']-(int)$tarifas['bod_compra'];
              echo '
              <br><h2 style="color: maroon;">Bodega</h2>
                    	<div class="col-md-3">Tarifa de Compra<br>
                        '.$tarifas['bod_compra'].'</div>
                        
			<div class="col-md-3">Tarifa de Venta <br>
            '.$tarifas['bod_venta'].'</div>
                
			<div class="col-md-3">	Proveedor<br>
            '.$tarifas['bod_proveedor'].'</div>
            
            <div class="col-md-3">	Profit<br>
            '.$resul.'</div><br>
            ';   
                 
             }
              
              
              
               if($tarifas['tramite']==1){
             
             $resul=(int)$tarifas['tra_venta']-(int)$tarifas['tra_compra'];
              echo '
              <br><h2 style="color: maroon;">Tramite</h2>
                    	<div class="col-md-3">Tarifa de Compra<br>
                        '.$tarifas['tra_compra'].'</div>
                        
			<div class="col-md-3">Tarifa de Venta <br>
            '.$tarifas['tra_venta'].'</div>
                
			<div class="col-md-3">	Proveedor<br>
            '.$tarifas['tra_proveedor'].'</div>
            
            <div class="col-md-3">	Profit<br>
            '.$resul.'</div><br>
            ';   
                 
             }
              
              
                  if($tarifas['aereo']==1){
             
             $resul=(int)$tarifas['ae_venta']-(int)$tarifas['ae_compra'];
              echo '
              <br><h2 style="color: maroon;">Flete Aereo</h2>
                    	<div class="col-md-3">Tarifa de Compra<br>
                        '.$tarifas['ae_compra'].'</div>
                        
			<div class="col-md-3">Tarifa de Venta <br>
            '.$tarifas['ae_venta'].'</div>
                
			<div class="col-md-3">	Proveedor<br>
            '.$tarifas['ae_proveedor'].'</div>
            
            <div class="col-md-3">	Profit<br>
            '.$resul.'</div><br>
            ';   
                 
             }
              
              
              if($tarifas['maritimo']==1){
             
             $resul=(int)$tarifas['ma_venta']-(int)$tarifas['ma_compra'];
              echo '
              <br><h2 style="color: maroon;">Flete Maritimo</h2>
                    	<div class="col-md-3">Tarifa de Compra<br>
                        '.$tarifas['ma_compra'].'</div>
                        
			<div class="col-md-3">Tarifa de Venta <br>
            '.$tarifas['ma_venta'].'</div>
                
			<div class="col-md-3">	Proveedor<br>
            '.$tarifas['ma_proveedor'].'</div>
            
            <div class="col-md-3">	Profit<br>
            '.$resul.'</div><br>
            ';   
                 
             }
              
              
              if($tarifas['terrestre']==1){
             
             $resul=(int)$tarifas['te_venta']-(int)$tarifas['te_compra'];
              echo '
              <br><h2 style="color: maroon;">Flete Terrestre</h2>
                    	<div class="col-md-3">Tarifa de Compra<br>
                        '.$tarifas['te_compra'].'</div>
                        
			<div class="col-md-3">Tarifa de Venta <br>
            '.$tarifas['te_venta'].'</div>
                
			<div class="col-md-3">	Proveedor<br>
            '.$tarifas['te_proveedor'].'</div>
            
            <div class="col-md-3">	Profit<br>
            '.$resul.'</div><br>
            ';   
                 
             }
              
              
              
              
              
              
             
            ?>
        </p>
  </div>
    <hr>
</div>
			  </div>
          
          <?php
          }
              endforeach;
                      
	  $detalles = cot_detalles($id);
	  
	  foreach ($detalles as  $deta):
		 if (is_null($deta['name'])){
		  	  echo " <div class='col-md-10'><br><br><h2>No hay Detalles Agregados</h2></div>";
			  
		  }else{
		  
         
		  ?>
 
		  <div class="col-md-10">
	  <!-- Left-aligned -->
<div class="media">
  <div class="media-left">
   
	   <img src="uploads/users/<?php echo $deta['image'];?>"  style="width:100px" >
	  
	  
  </div>
  <div class="media-body">
    <h4 class="media-heading" style="color: maroon;"><?php echo $deta['name'];?> <small><i style="color: red;"><?php echo $deta['fecha'];?></i></small> 
        <?php 
        
        if($deta['archivo']==0){
        ?>
        <i class="glyphicon glyphicon-paperclip pull-right" data-toggle="modal" data-target="#<?php echo $deta['id'];?>"></i>
        <?php }else{
           chmod("archivos_cot/".$deta['archivo'], 0777 );
        ?>
        
            <a href="archivos_cot/<?php echo $deta['archivo'];?>" download="<?php echo $deta['archivo'];?>" class="pull-right" data-toggle="tooltip" title="Descarga Archivo"><i class="glyphicon glyphicon-file"></i></a>
      
                <?php
        }
        
        
        ?>
        </h4>
    <p><?php echo $deta['detalles'];?>
             
            </p>
  </div>
    <hr>
</div>
              <!-- inicio de modal-->
             
              <div id="<?php echo $deta['id'];?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> <i class="glyphicon glyphicon-file"></i>  Carga Archivo </h4>
      </div>
      <div class="modal-body">
        <!--class="dropzone"-->
		  
          <div id="upload_proceso"></div>
          
		    <form method="post"  class="dropzone" action="sube_documentos_ajax.php" id="<?php echo $deta['id'];?>" enctype="multipart/form-data">
    
       <div class="fallback">
		  <input type="file" name="archivo_contitutiva" id="archivo_contitutiva"/>
		   </div>
                 
				 
				  <input type="hidden" name="id_cotizacion_detalle" id="id_cotizacion_detalle" value="<?php echo $deta['id'];?>">
                
                
     	</form>
          
          
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>      <!-- fin  de modal-->
              
			  </div>

	  
		
	   <!-- fin de comentarios-->
	 <?php 
		  }
		  endforeach;?> 
	  
	 </div> 
			
		</div></div>
		  
		  </div></div></div></div>
			
			
			
			<script>

function getValues() {
    var formData = new FormData();
    // these image appends are getting dropzones instances
    formData.append("id_cotizacion_detalle", jQuery('#id_cotizacion_detalle').val()); // attach dropzone image element
   // formData.append("id_user", jQuery('#id_user').val());
 
    /*formData.append('image_2', $('#barfoo')[0].dropzone.getAcceptedFiles()[0]);
    formData.append("id", $("#id").val()); // regular text form attachment
    formData.append("_method", 'PUT'); // required to spoof a PUT request for a FormData object (not needed for POST request)
*/
    return formData;
}
				
		$("#<?php echo $deta['id'];?>").dropzone({
    url: "sube_documentos_ajax.php",
			//acceptedFiles: ".pdf",
			//dictInvalidFileType: "Solo Se Aceptan Archivos PDF",
    dictDefaultMessage: "Arrastra El Archivo Aqui o Da Click para Cargarlo",
			maxFilesize: 10, // MB
                maxFiles: 1,
			addRemoveLinks: true,
			uploadprogress:function(file, response){
                console.log('WE NEVER REACH THIS POINT.');
				$('#btn_siguiente').attr("disabled", true);
				$("#upload_proceso").html("<h2><center>Subiendo espera <img src='libs/images/ajax-loader.gif'></center></h2>").fadeIn;
                            },
			
	success: function(file, response){
                console.log('WE NEVER REACH THIS POINT.');
               $('#btn_siguiente').attr("disabled", false);
		
		$("#upload_proceso").html("<h2><center>Carga Completa</center></h2>").fadeIn;
   location.reload();
        // setTimeout(function() {   
		//$("#upload_proceso").html("<h2><center>Carga Completa</center></h2>").fadeOut(100);
	//},2500);
	},
    	init: function() { 
     $.ajax({
      url: sube_documentos_ajax.php,
     method: 'POST',
     data: getValues(),
		 processData: false, // required for FormData with jQuery
        contentType: false
	 });
  }		
});		


</script>
			
			<?php include_once('layouts/footer.php'); ?>