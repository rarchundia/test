<?php
  $page_title = 'Incidencias Estatus';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(6);
  
?>
<?php 
include_once('layouts/header.php');
 $products = incidencias();
 


if(isset($_POST['nota_adicional'])){

if(empty($errors)){
     $p_adicional_nota = remove_junk($db->escape($_POST['adicional_nota']));
	
	 $p_id_nota = remove_junk($db->escape($_POST['id_nota']));
	$p_user_name=remove_junk($db->escape($_POST['user_name']));
	 $p_nota_server = remove_junk($db->escape($_POST['nota_server']));
	
	$date    = make_date();
	$nota_concatenada=$p_nota_server." <p> (".$date."  ".$p_user_name.") ". $p_adicional_nota."</p>";
	
	$query  = " UPDATE excel SET incidencia ='{$nota_concatenada}' WHERE id='{$p_id_nota}'";
	
	 $result = $db->query($query);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Nota Agregada ");
            echo '<meta http-equiv="Refresh" content="0; url=incidencias.php">';
			  //redirect('incidencias.php', false);
          } else {
            $session->msg('d',' Lo Siento No Se Pudo Agregar la Nota.');
            echo '<meta http-equiv="Refresh" content="0; url=incidencias.php">';
			  //redirect('incidencias.php', false);
          }
}
	else{
     $session->msg("d", $errors);
    // redirect('aclaraciones.php',false);
		echo '<meta http-equiv="Refresh" content="0; url=incidencias.php">';
   }
	
	
	
}


if(isset($_POST['estatus'])){

if(empty($errors)){
     $p_id_nota = remove_junk($db->escape($_POST['id_nota']));
	$date    = make_date();
	
	$query  = " UPDATE excel SET fecha_solucion ='{$date}', estatus ='1' WHERE id='{$p_id_nota}'";
	
	 $result = $db->query($query);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Estatus Actualizado Con Exito!!! ");
            echo '<meta http-equiv="Refresh" content="0; url=incidencias.php">';
			  //redirect('incidencias.php', false);
          } else {
            $session->msg('d',' Lo Siento No Se Pudo Cambiar el Estatus Intentalo Otra vez :(');
            echo '<meta http-equiv="Refresh" content="0; url=incidencias.php">';
			  //redirect('incidencias.php', false);
          }
}
	else{
     $session->msg("d", $errors);
    // redirect('aclaraciones.php',false);
		echo '<meta http-equiv="Refresh" content="0; url=incidencias.php">';
   }
	
	
	
}








/*if(isset($_POST['programa'])){
	
	$req_fields = array( 'empresa');
   validate_fields($req_fields);
	 
    if(empty($errors)){
     $p_empresa = remove_junk($db->escape($_POST['empresa']));
	 $p_persona_reporta = remove_junk($db->escape($_POST['persona_reporta']));
	 $p_direccion = remove_junk($db->escape($_POST['direccion']));
	 $p_municipio = remove_junk($db->escape($_POST['municipio']));
	 $p_cp = remove_junk($db->escape($_POST['cp']));
	 $p_telefono = remove_junk($db->escape($_POST['telefono']));
	 $p_correo = remove_junk($db->escape($_POST['correo']));
	 $p_guia = remove_junk($db->escape($_POST['guia']));
	 $p_reporte = remove_junk($db->escape($_POST['reporte']));
	 $p_quien_ingresa = remove_junk($db->escape($_POST['quien_ingresa']));
	 
				
     $date    = make_date();
     $query  = "INSERT INTO incidencias (";
     $query .="  `empresa`, `persona_reporta`, `direccion`, `municipio`, `cp`, `telefono`, `correo`, `guia`, `fecha_reporte`, `reporte`, `atn`";
     $query .=") VALUES (";
     $query .="'{$p_empresa}','{$p_persona_reporta}','{$p_direccion}','{$p_municipio}','{$p_cp}','{$p_telefono}','{$p_correo}','{$p_guia}','{$date}','{$p_reporte}','{$p_quien_ingresa}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
       
	  $session->msg('s',"Folio Generado Exitosamente");
       //redirect('incidencias.php', false);
		 echo '<meta http-equiv="Refresh" content="0; url=incidencias.php">';
   }
	    else {
       $session->msg('d',' Lo siento, Falló al Generar Folio.');
      // redirect('incidencias.php', false);
			echo '<meta http-equiv="Refresh" content="0; url=incidencias.php">';
	   }

   } else{
     $session->msg("d", $errors);
    // redirect('aclaraciones.php',false);
		echo '<meta http-equiv="Refresh" content="0; url=incidencias.php">';
   }

 }

*/
?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
		
		<!-- <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-search"></i>
                  </span>
        
                  <input type="text" class="form-control" name="busqueda_recoleccion" id="busqueda_recoleccion"  placeholder="Busca por # de Folio" autocomplete="off" onKeyUp="buscar_recoleccion();" align="left" />
		
						 </div></div>
		
		<div class="col-md-6">
		<form class="clearfix" method="post" action="rango_recoleccion.php">
            <div class="form-group">
                <div class="input-group">
                  <input type="text" class="datepicker form-control" name="fecha"  autocomplete="off" placeholder="Primera Fecha Entrega" required title="Selecciona un Rango de Fechas de Recoleccion Para Generar el reporte" data-toggle="tooltip">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
                  
                     <input type="text" class="datepicker form-control" name="fecha2"  autocomplete="off" placeholder="Segunda Fecha Entrega" required>
										</div>
<button type="submit" name="fecha_entrega" class="btn btn-primary btn-block">Generar Reporte</button>
            </div>
          </form>
		
		</div>-->
		
		
		
		
		
		
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong><label title="Solo se ve el  estatus de hasta 5 dias" data-toggle="tooltip">Estatus de Incidencias.</label> <?php 
	
	//$fecha_rango1=strftime("%d %B del %Y", strtotime(date("d/m/Y"))) ;
	//echo $fecha_rango1;
	//echo date("d/m/Y");?></strong>
       <div class="pull-right col-md-4">
			<input class="form-control" id="myInput" type="text" placeholder="Buscar ...">
			</div>
		  
		  </div>
        <div class="panel-body">
        
			
			<div style="overflow:scroll;
     height:700px;
     width:100%;">
			  
			  <table class="table table-striped table-hover table-responsive"> 
            <thead>
              <tr>
                <th class="text-center"># DE GUIA</th>
                <th class="text-center">RAZÓN SOCIAL<sub>(Empresa)</sub></th>
				<th class="text-center">SERVICIO / PAQUETERIA</th>
				  <th class="text-center">FECHA DE ENVIO</th>
                <th class="text-center">INCIDENCIA</th>
                <th class="text-center">AGREGAR NOTAS</th>
				<th class="text-center">MARCAR ESTATUS</th>
                
                
              </tr>
            </thead>
             <tbody id="myTable">
				<div id="resultadoBusqueda" style="background-color:rosybrown"></div>
				
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><h4><strong><?php echo remove_junk($product['guia']);?></strong>   </h4>
				  
				  </td>
                <td><strong><span><center><?php echo remove_junk($product['razon_social']); ?></center>
					
				
					
			  </strong></td>
		  <td class="text-center">
			  <strong><br><br>
			 <?php echo remove_junk($product['servicio']);?> / <?php echo remove_junk($product['paqueteria']);?>
			  </strong></td>
		   <td class="text-center">
			  <strong><br><br>
			 <?php echo remove_junk($product['fecha_envio']);?>
			  </strong></td>
		  
                <td>
                <div class="modal fade" id="<?php echo remove_junk($product['id']);?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Descripcion de Incidencias Guia: <strong> <?php echo remove_junk($product['guia']);?> </strong><br>Tipo de Servicio: <strong><?php echo remove_junk($product['servicio']);?></strong></h4>
      </div><div class="modal-body">
		<h3><?php echo remove_junk($product['fecha_envio']); ?>-->
 <?php echo remove_junk($product['incidencia']); ?></h3></div>
      <div class="modal-footer">
        <button type="button" class="btn btn btn-danger" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div></div>

                           <br><br>
       
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?php echo remove_junk($product['id']);?>"><i class='glyphicon glyphicon-plus' style="font-size:20px;color:red;"></i> Expandir</button> 
                
                      </td>  
                
                <td class="text-center">
                <form method="post" action="incidencias.php" class="clearfix">
					
					<input type="hidden" id="id_nota" name="id_nota" value="<?php echo remove_junk($product['id']);?>">
					<input  type="hidden" id="nota_server" name="nota_server" value=" <?php echo remove_junk($product['incidencia']);?> ">	
					<input type="hidden" id="user_name" name="user_name" value="<?php echo remove_junk(ucfirst($user['name'])); ?>">
					<div class="md-form">
 
  <textarea id="adicional_nota" name="adicional_nota" class="md-textarea form-control" rows="3"  style="background-color:whitesmoke;"></textarea>

					 <button type="submit" name="nota_adicional" class="btn btn-danger btn-block">Agrega Una Nota Adicional</button>
    
     </form>
    
</div>				
					
                </td>
                
				  
				  </td>
		
		<td class="text-center">
		
		<form method="post" action="incidencias.php" class="clearfix">
				<input type="hidden" id="id_nota" name="id_nota" value="<?php echo remove_junk($product['id']);?>">
			 <br><br><button type="submit" name="estatus" class="btn btn-success btn-block" title="<-- Aca Puedes Agregar Una Nota" data-toggle="tooltip">Resuelto</button>
			</form>
		</td>
		
               
                  </div>
                </td>
              </tr> 
             <?php endforeach; ?>
            </tbody>
          </table>
</div>
        </div>
      </div>
    </div>
  </div>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

  <?php include_once('layouts/footer.php'); ?>
