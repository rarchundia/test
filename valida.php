<?php
  $page_title = 'Lista de Validación';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(6);
  $all_groups = valida();

?>


<?php 
if(isset($_POST['descarta'])){
    
	 
	 if(empty($errors)){
		 $p_empresa = remove_junk($db->escape($_POST['id_edit']));
	 
		 $query   = "UPDATE contacto SET";
       $query  .=" ganado_perdido ='2'";
       $query  .=" WHERE id ='{$p_empresa}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Descartado Correctamente ");
               echo '<meta http-equiv="Refresh" content="0; url=valida.php">';
				    } else {
                 $session->msg('d',' Lo Siento, Fallo al Descartar.');
                 echo '<meta http-equiv="Refresh" content="0; url=valida.php">';
				  }

   } else{
       $session->msg("d", $errors);
  echo '<meta http-equiv="Refresh" content="0; url=valida.php">';
				  }

 }








?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-ok"></span>
        <span> Clientes por Validar</span>
     </strong>
		<a href="valida_historico.php" class="btn btn-info pull-right btn-sm">Ir a  Historico</a>
      <div class="pull-right col-md-4">
			<input class="form-control" id="myInput" type="text" placeholder="Buscar ...">
		
    
		</div>
		
		</div>
     <div class="panel-body">
      <table class="table table-striped table-hover table-responsive">
        <thead>
          <tr>
            <th class="text-center" style="width: 30px;">#</th>
            <th class="text-center">Nombre</th>
			  <th class="text-center">Empresa</th>
			  <th class="text-center">Teléfono</th>
              <th class="text-center">Asesor Ventas</th>
            <th class="text-center">Detalles</th>
            <th class="text-center">Ver Archivos</th>
			  <th class="text-center">Descartar</th>
			  
          </tr>
        </thead>
        <tbody id="myTable">
        <?php foreach($all_groups as $a_group): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_group['contacto']))?></td>
             <td class="text-center">
             <?php echo remove_junk(ucwords($a_group['empresa']))?>
           </td>
			  <td class="text-center">
             <?php echo remove_junk(ucwords($a_group['telefono']))?>
           </td>
			
           <td class="text-center">
           <?php echo remove_junk(ucwords($a_group['name']))?>
           </td>
           <td >
                 <div class="modal fade" id="<?php echo remove_junk($a_group['id']);?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"> <strong>Documentos</strong></h4>
      </div><div class="modal-body">
		<h4>
			<?php
			
			if($a_group['acta_constitutiva']==1){
				
				echo "Acta Constitutiva   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$a_group['fecha_acta']."  </sup><br><br>";
				
				
				
			}elseif($a_group['acta_constitutiva']==2){
				
				echo "Acta Constitutiva   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$a_group['fecha_acta']."</sup><br> <br>";
				
					
				
			}elseif($a_group['acta_constitutiva']==3){
				
				echo "Acta Constitutiva   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span><br> <br>";
				
			}elseif($a_group['acta_constitutiva']==0){
				
				echo "Acta Constitutiva   <span class='label label-warning'>No Se ha Subido Documento</span><br> <br>";
				
			}
			
			
			
			
			if($a_group['sit_fiscar']==1){
					
				echo "Situación Fiscal   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$a_group['fecha_fiscal']."</sup>  <br><br>";
				
				
				
			}elseif($a_group['sit_fiscar']==2){
				
				echo "Situación Fiscal   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$a_group['fecha_fiscal']."</sup> <br><br>";
				
				
			}elseif($a_group['sit_fiscar']==3){
				
				echo " Situación Fiscal   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($a_group['sit_fiscar']==0){
				
				echo " Situación Fiscal   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
			
			/*if($a_group['tarifario']==1){
				
				echo "Tarifario<sup>PDF</sup>  <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$a_group['fecha_tarifario']." </sup> <br><br>";
				
			}elseif($a_group['tarifario']==2){
				
				echo "Tarifario<sup>PDF</sup>   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$a_group['fecha_tarifario']."</sup> <br><br>";
				
			}elseif($a_group['tarifario']==3){
				
				echo " Tarifario<sup>PDF</sup>   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($a_group['tarifario']==0){
				
				echo " Tarifario<sup>PDF</sup>   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}*/
			
			
			
			
			if($a_group['tarifario_excel']==1){
				
				echo "Tarifario<sup>Excel</sup>   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$a_group['fecha_tarifario_excel']." </sup> <br><br>";
				
			}elseif($a_group['tarifario_excel']==2){
				
				echo "Tarifario<sup>Excel</sup>   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$a_group['fecha_tarifario_excel']."</sup><br><br>";
				
			}elseif($a_group['tarifario_excel']==3){
				
				echo " Tarifario<sup>Excel</sup>   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($a_group['tarifario_excel']==0){
				
				echo " Tarifario<sup>Excel</sup>   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
			
				/*if($a_group['cumplimiento']==1){
				
				echo "Opinión de Cumplimiento   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$a_group['fecha_cumplimiento']." </sup> <br><br>";
				
			}elseif($a_group['cumplimiento']==2){
				
				echo " Opinión de Cumplimiento  <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$a_group['fecha_cumplimiento']."</sup> <br><br>";
				
			}elseif($a_group['cumplimiento']==3){
				
				echo "Opinión de Cumplimiento   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($a_group['cumplimiento']==0){
				
				echo "Opinión de Cumplimiento   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}*/
			
			
			
			
			if($a_group['identificacion']==1){
				
				echo "Identificación   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$a_group['fecha_identificacion']."</sup> <br><br>";
				
			}elseif($a_group['identificacion']==2){
				
				echo "Identificación   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$a_group['fecha_identificacion']."</sup><br><br>";
				
			}elseif($a_group['identificacion']==3){
				
				echo "Identificación   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($a_group['identificacion']==0){
				
				echo "Identificación   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
			
			if($a_group['comp_domicilio']==1){
				
				echo "Comprobante Domicilio   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$a_group['fecha_comprobante']."</sup> <br><br>";
				
			}elseif($a_group['comp_domicilio']==2){
				
				echo "Comprobante Domicilio   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$a_group['fecha_comprobante']."</sup><br><br>";
				
			}elseif($a_group['comp_domicilio']==3){
				
				echo "Comprobante Domicilio   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($a_group['comp_domicilio']==0){
				
				echo "Comprobante Domicilio   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
			if($a_group['estado_cuenta']==1){
				
				echo "Estado de Cuenta   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$a_group['fecha_cuenta']."</sup><br><br>";
				
			}elseif($a_group['estado_cuenta']==2){
				
				echo "Estado de Cuenta   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$a_group['fecha_cuenta']."</sup><br><br>";
				
			}elseif($a_group['estado_cuenta']==3){
				
				echo "Estado de Cuenta   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($a_group['estado_cuenta']==0){
				
				echo "Estado de Cuenta   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
			
			
			/*if($a_group['preanalisis']==1){
				
				echo "Preanalisis <sup>PDF</sup>   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$a_group['fecha_preanalisis']."</sup><br><br>";
				
			}elseif($a_group['preanalisis']==2){
				
				echo "Preanalisis <sup>PDF</sup>   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$a_group['fecha_preanalisis']."</sup><br><br>";
				
			}elseif($a_group['preanalisis']==3){
				
				echo "Preanalisis <sup>PDF</sup>   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($a_group['preanalisis']==0){
				
				echo "Preanalisis <sup>PDF</sup>   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			if($a_group['preanalisis_excel']==1){
				
				echo "Preanalisis <sup>Excel</sup>   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$a_group['fecha_preanalisis_excel']." </sup><br><br>";
				
			}elseif($a_group['preanalisis_excel']==2){
				
				echo "Preanalisis <sup>Excel</sup>   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$a_group['fecha_preanalisis_excel']."</sup><br><br>";
				
			}elseif($a_group['preanalisis_excel']==3){
				
				echo "Preanalisis <sup>Excel</sup>   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($a_group['preanalisis_excel']==0){
				
				echo "Preanalisis <sup>Excel</sup>   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}*/
			
			
			
			
			
			if($a_group['presta_serv']==1){
				
				echo "Convenio   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$a_group['fecha_presta_serv']." </sup><br><br>";
				
			}elseif($a_group['presta_serv']==2){
				
				echo "Convenio   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$a_group['fecha_presta_serv']."</sup><br><br>";
				
			}elseif($a_group['presta_serv']==3){
				
				echo "Convenio   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($a_group['presta_serv']==0){
				
				echo "Convenio   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
			
			
				if($a_group['alta_envi']==1){
				
				echo "Alta Envipaq <sup>PDF</sup>  <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$a_group['fecha_alta_envi']." </sup><br><br>";
				
			}elseif($a_group['alta_envi']==2){
				
				echo "Alta Envipaq <sup>PDF</sup>  <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$a_group['fecha_alta_envi']."</sup><br><br>";
				
			}elseif($a_group['alta_envi']==3){
				
				echo "Alta Envipaq <sup>PDF</sup>  <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($a_group['alta_envi']==0){
				
				echo "Alta Envipaq <sup>PDF</sup>   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			if($a_group['alta_envi_excel']==1){
				
				echo "Alta Envipaq <sup>Excel</sup>  <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$a_group['fecha_alta_envi_excel']."</sup> <br><br>";
				
			}elseif($a_group['alta_envi_excel']==2){
				
				echo "Alta Envipaq <sup>Excel</sup>  <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$a_group['fecha_alta_envi_excel']."</sup><br><br>";
				
			}elseif($a_group['alta_envi_excel']==3){
				
				echo "Alta Envipaq  <sup>Excel</sup> <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($a_group['alta_envi_excel']==0){
				
				echo "Alta Envipaq <sup>Excel</sup>  <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
				if($a_group['propuesta']==1){
				
				echo "Propuesta Comercial   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>". $a_group['fecha_propuesta']."</sup> <br><br>";
				
			}elseif($a_group['propuesta']==2){
				
				echo "Propuesta Comercial   <span class='label label-success'>Archivo Validado</span> Cargado<sup>". $a_group['fecha_propuesta']."</sup><br><br>";
				
			}elseif($a_group['propuesta']==3){
				
				echo "Propuesta Comercial   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($a_group['propuesta']==0){
				
				echo "Propuesta Comercial   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
			if($a_group['user_biis']==1){
				
				echo "Solicitud de Usuario   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>". $a_group['fecha_biis']."</sup> <br><br>";
				
			}elseif($a_group['user_biis']==2){
				
				echo "Solicitud de Usuario   <span class='label label-success'>Archivo Validado</span> Cargado<sup>". $a_group['fecha_biis']."</sup><br><br>";
				
			}elseif($a_group['user_biis']==3){
				
				echo "Solicitud de Usuario   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($a_group['user_biis']==0){
				
				echo "Solicitud de Usuario   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
			
			
			/*identificacion=1 or c.comp_domicilio=1 or c.estado_cuenta=1 or c.preanalisis=1 or c.presta_serv=1 or c.alta_envi=1 or c.propuesta=1
			  ){}
			*/
			
			
			
			?></h4></div>
      <div class="modal-footer">
        <button type="button" class="btn btn btn-danger" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div></div>
			   
			   
			   
			   
			   
			   
			   
			   
			    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?php echo remove_junk($a_group['id']);?>"><i class='glyphicon glyphicon-plus' style="font-size:20px;color:red;"></i> Expandir</button> 
           </td>
			  <td class="text-center">
			  <a href="detalle_documento.php?id=<?php echo (int)$a_group['id']; ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-file"></span> Ver Archivos</a>
				  
				  
				  
			  </td>
			  <td class="text-center">
				 <form method="post" action="valida.php">
					<input type="hidden" name="id_edit" value="<?php echo $a_group['id'];  ?>">
				
				<button type="submit" name="descarta" class="btn btn-danger" title="Descartar" data-toggle="tooltip"><i class="glyphicon glyphicon-remove" ></i></button>
					
					</form>
				  
				  
			  </td>
          </tr>
			
			<?php
			 if($a_group['sit_fiscar']==2 && $a_group['identificacion']==2 && $a_group['comp_domicilio']==2 && $a_group['estado_cuenta']==2
				&& $a_group['presta_serv']==2 && $a_group['alta_envi']==2 && $a_group['alta_envi_excel']==2 && $a_group['propuesta']==2 && $a_group['tarifario_excel']==2)//;c.sit_fiscar = 2 AND c.cumplimiento = 2 AND c.identificacion = 2 AND c.comp_domicilio = 2 AND c.estado_cuenta = 2 AND c.tarifario = 2 AND c.preanalisis = 2 AND c.preanalisis_excel = 2 AND c.presta_serv = 2 AND c.alta_envi = 2 AND c.alta_envi_excel = 2 AND c.propuesta = 2 AND c.tarifario_excel = 2)
	  {
		  
		    $query   = "UPDATE contacto SET";
       $query  .=" ganado_perdido ='4'";
       $query  .=" WHERE id ='{$a_group['id']}'";
       $result = $db->query($query);
		if($result && $db->affected_rows() === 1){
          //       $session->msg('s',"En Espera de Validacion de los Documentos ");
            echo '<meta http-equiv="Refresh" content="0; url=valida.php">';
	           } 
		  
		  //redirect('detalle_contacto.php?id='.$_GET['id'], false);
          }else{}
			?>
			
			
        <?php endforeach;?>
       </tbody>
     </table>
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
