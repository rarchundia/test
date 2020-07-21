<?php
  $page_title = 'Documento Detalle ';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
 page_require_level(10);
  
$id=$_GET['id'];
  ?>

<style>
	
	.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color:skyblue;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
	
	
	
	
	
	
	
	
	
.checkbox label:after, 
.radio label:after {
    content: '';
    display: table;
    clear: both;
}

.checkbox .cr,
.radio .cr {
    position: relative;
    display: inline-block;
    border: 1px solid #a9a9a9;
    border-radius: .25em;
    width: 1.3em;
    height: 1.3em;
    float: left;
    margin-right: .5em;
}

.radio .cr {
    border-radius: 50%;
}

.checkbox .cr .cr-icon,
.radio .cr .cr-icon {
    position: absolute;
    font-size: .8em;
    line-height: 0;
    top: 50%;
    left: 20%;
}

.radio .cr .cr-icon {
    margin-left: 0.04em;
}

.checkbox label input[type="checkbox"],
.radio label input[type="radio"] {
    display: none;
}

.checkbox label input[type="checkbox"] + .cr > .cr-icon,
.radio label input[type="radio"] + .cr > .cr-icon {
    transform: scale(3) rotateZ(-20deg);
    opacity: 0;
    transition: all .3s ease-in;
}

.checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
.radio label input[type="radio"]:checked + .cr > .cr-icon {
    transform: scale(1) rotateZ(0deg);
    opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
    opacity: .5;
}
	.derecha{
		
			float: right;
		text-align: right;
		display: inline;
		
	}
	
</style>



<?php include_once('layouts/header.php'); 
//$usuario=$user['name'];
//$medida= find_all('medida');
$products =contactos_pdf($id);

?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-12">
      <div class="panel panel-default">
   <!--     <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-sort-by-alphabet"></span>
            <span>Programar Entrega</span> <div align="right"><a href="reporte_pdf.php" class="btn btn-danger" title="Genera Guias Electronicas" data-toggle="tooltip">  PDF  </a></div>
            </strong>
        </div>-->
        <div class="panel-body" >
         <!--<div class="col-md-12"></div>-->
        <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#resumen"> Resumen de Archivos</button> 
			<br><br>
	<!--		
  <button type="submit" id="muestra" class="btn btn-default btn-block">Resumen</button>
			 <div id="form2" style="display:none">
				 
				 <table class="table table-striped table-hover table-responsive">
       
		   
			<tbody>
    	
<?php foreach ($products as  $product): ?>    
				
	  <tr>
      <td>Alta Envipaq</td>
      <td><?php 
		  if($product['alta_envi']==0){
		  echo "Sin Documento";
		  }else if($product['alta_envi']==1){
           echo "Documento Sin Validar";
		  }else if($product['alta_envi']==2){
			  echo "Documento Validado";
		  }else if($product['alta_envi']==3){
				  echo "Documento Rechazado en Espera de Nuevo";
		  }
		  ?></td>
      <td>Estado de Cuenta</td>
      <td><?php 
		  if($product['estado_cuenta']==0){
		  echo "Sin Documento";
		  }else if($product['estado_cuenta']==1){
           echo "Documento Sin Validar";
		  }else if($product['estado_cuenta']==2){
			  echo "Documento Validado";
		  }else if($product['estado_cuenta']==3){
				  echo "Documento Rechazado en Espera de Nuevo";
		  }
		  ?></td>
    </tr>
    <tr>
      <td>Acta Constitutiva</td>
      <td><?php 
		  if($product['acta_constitutiva']==0){
		  echo "Sin Documento";
		  }else if($product['acta_constitutiva']==1){
           echo "Documento Sin Validar";
		  }else if($product['acta_constitutiva']==2){
			  echo "Documento Validado";
		  }else if($product['acta_constitutiva']==3){
				  echo "Documento Rechazado en Espera de Nuevo";
		  }
		  ?></td>
      <td>Pre-Analisis</td>
      <td><?php 
		 /* if($product['preanalisis']==0){
		  echo "Sin Documento";
		  }else if($product['preanalisis']==1){
           echo "Documento Sin Validar";
		  }else if($product['preanalisis']==2){
			  echo "Documento Validado";
		  }else if($product['preanalisis']==3){
				  echo "Documento Rechazado en Espera de Nuevo";
		  }*/
		  ?></td>
    </tr>
	  <tr>
      <td>Situación Fiscal</td>
      <td><?php 
		  if($product['sit_fiscar']==0){
		  echo "Sin Documento";
		  }else if($product['sit_fiscar']==1){
           echo "Documento Sin Validar";
		  }else if($product['sit_fiscar']==2){
			  echo "Documento Validado";
		  }else if($product['sit_fiscar']==3){
				  echo "Documento Rechazado en Espera de Nuevo";
		  }
		  ?></td>
      <td>Convenio</td>
      <td><?php 
		  if($product['presta_serv']==0){
		  echo "Sin Documento";
		  }else if($product['presta_serv']==1){
           echo "Documento Sin Validar";
		  }else if($product['presta_serv']==2){
			  echo "Documento Validado";
		  }else if($product['presta_serv']==3){
				  echo "Documento Rechazado en Espera de Nuevo";
		  }
		  ?></td>
    </tr>
	  <tr>
      <td>Identificacion Oficial</td>
      <td><?php 
		  if($product['identificacion']==0){
		  echo "Sin Documento";
		  }else if($product['identificacion']==1){
           echo "Documento Sin Validar";
		  }else if($product['identificacion']==2){
			  echo "Documento Validado";
		  }else if($product['identificacion']==3){
				  echo "Documento Rechazado en Espera de Nuevo";
		  }
		  ?>
		  </td>
      <td>Propuesta Firmada</td>
      <td><?php 
		  if($product['propuesta']==0){
		  echo "Sin Documento";
		  }else if($product['propuesta']==1){
           echo "Documento Sin Validar";
		  }else if($product['propuesta']==2){
			  echo "Documento Validado";
		  }else if($product['propuesta']==3){
				  echo "Documento Rechazado en Espera de Nuevo";
		  }
		  ?>
		  </td>
    </tr>
	  <tr>
      <td>Comprobante Domicilio</td>
      <td><?php 
		  if($product['comp_domicilio']==0){
		  echo "Sin Documento";
		  }else if($product['comp_domicilio']==1){
           echo "Documento Sin Validar";
		  }else if($product['comp_domicilio']==2){
			  echo "Documento Validado";
		  }else if($product['comp_domicilio']==3){
				  echo "Documento Rechazado en Espera de Nuevo";
		  }
		  ?>
		  </td>
      <td>Opinion de Cumplimiento</td>
      <td><?php 
		  /*if($product['cumplimiento']==0){
		  echo "Sin Documento";
		  }else if($product['cumplimiento']==1){
           echo "Documento Sin Validar";
		  }else if($product['cumplimiento']==2){
			  echo "Documento Validado";
		  }else if($product['cumplimiento']==3){
				  echo "Documento Rechazado en Espera de Nuevo";
		  }*/
		  ?>
		  </td>
    </tr>
				
  </tbody>
</table>
</div>
        -->
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<div class="modal fade" id="resumen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"><center> <strong>Resumen de Documentos</strong></center></h4>
      </div><div class="modal-body">
		<h4>
			<?php
			
				if($product['acta_constitutiva']==1){
				
				echo "Acta Constitutiva   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$product['fecha_acta']."  </sup><br><br>";
				
				
				
			}elseif($product['acta_constitutiva']==2){
				
				echo "Acta Constitutiva   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$product['fecha_acta']."</sup><br> <br>";
				
					
				
			}elseif($product['acta_constitutiva']==3){
				
				echo "Acta Constitutiva   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span><br> <br>";
				
			}elseif($product['acta_constitutiva']==0){
				
				echo "Acta Constitutiva   <span class='label label-warning'>No Se ha Subido Documento</span><br> <br>";
				
			}
			
			
			
			
			if($product['sit_fiscar']==1){
					
				echo "Situación Fiscal   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$product['fecha_fiscal']."</sup>  <br><br>";
				
				
				
			}elseif($product['sit_fiscar']==2){
				
				echo "Situación Fiscal   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$product['fecha_fiscal']."</sup> <br><br>";
				
				
			}elseif($product['sit_fiscar']==3){
				
				echo " Situación Fiscal   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($product['sit_fiscar']==0){
				
				echo " Situación Fiscal   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
			
			/*if($product['tarifario']==1){
				
				echo "Tarifario<sup>PDF</sup>  <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$product['fecha_tarifario']." </sup> <br><br>";
				
			}elseif($product['tarifario']==2){
				
				echo "Tarifario<sup>PDF</sup>   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$product['fecha_tarifario']."</sup> <br><br>";
				
			}elseif($product['tarifario']==3){
				
				echo " Tarifario<sup>PDF</sup>   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($product['tarifario']==0){
				
				echo " Tarifario<sup>PDF</sup>   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}*/
			
			
			
			
			if($product['tarifario_excel']==1){
				
				echo "Tarifario<sup>Excel</sup>   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$product['fecha_tarifario_excel']." </sup> <br><br>";
				
			}elseif($product['tarifario_excel']==2){
				
				echo "Tarifario<sup>Excel</sup>   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$product['fecha_tarifario_excel']."</sup><br><br>";
				
			}elseif($product['tarifario_excel']==3){
				
				echo " Tarifario<sup>Excel</sup>   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($product['tarifario_excel']==0){
				
				echo " Tarifario<sup>Excel</sup>   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
			
				/*if($product['cumplimiento']==1){
				
				echo "Opinión de Cumplimiento   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$product['fecha_cumplimiento']." </sup> <br><br>";
				
			}elseif($product['cumplimiento']==2){
				
				echo " Opinión de Cumplimiento  <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$product['fecha_cumplimiento']."</sup> <br><br>";
				
			}elseif($product['cumplimiento']==3){
				
				echo "Opinión de Cumplimiento   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($product['cumplimiento']==0){
				
				echo "Opinión de Cumplimiento   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			*/
			
			
			
			if($product['identificacion']==1){
				
				echo "Identificación   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$product['fecha_identificacion']."</sup> <br><br>";
				
			}elseif($product['identificacion']==2){
				
				echo "Identificación   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$product['fecha_identificacion']."</sup><br><br>";
				
			}elseif($product['identificacion']==3){
				
				echo "Identificación   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($product['identificacion']==0){
				
				echo "Identificación   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
			
			if($product['comp_domicilio']==1){
				
				echo "Comprobante Domicilio   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$product['fecha_comprobante']."</sup> <br><br>";
				
			}elseif($product['comp_domicilio']==2){
				
				echo "Comprobante Domicilio   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$product['fecha_comprobante']."</sup><br><br>";
				
			}elseif($product['comp_domicilio']==3){
				
				echo "Comprobante Domicilio   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($product['comp_domicilio']==0){
				
				echo "Comprobante Domicilio   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
			if($product['estado_cuenta']==1){
				
				echo "Estado de Cuenta   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$product['fecha_cuenta']."</sup><br><br>";
				
			}elseif($product['estado_cuenta']==2){
				
				echo "Estado de Cuenta   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$product['fecha_cuenta']."</sup><br><br>";
				
			}elseif($product['estado_cuenta']==3){
				
				echo "Estado de Cuenta   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($product['estado_cuenta']==0){
				
				echo "Estado de Cuenta   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
			
			
			/*if($product['preanalisis']==1){
				
				echo "Preanalisis <sup>PDF</sup>   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$product['fecha_preanalisis']."</sup><br><br>";
				
			}elseif($product['preanalisis']==2){
				
				echo "Preanalisis <sup>PDF</sup>   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$product['fecha_preanalisis']."</sup><br><br>";
				
			}elseif($product['preanalisis']==3){
				
				echo "Preanalisis <sup>PDF</sup>   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($product['preanalisis']==0){
				
				echo "Preanalisis <sup>PDF</sup>   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			if($product['preanalisis_excel']==1){
				
				echo "Preanalisis <sup>Excel</sup>   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$product['fecha_preanalisis_excel']." </sup><br><br>";
				
			}elseif($product['preanalisis_excel']==2){
				
				echo "Preanalisis <sup>Excel</sup>   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$product['fecha_preanalisis_excel']."</sup><br><br>";
				
			}elseif($product['preanalisis_excel']==3){
				
				echo "Preanalisis <sup>Excel</sup>   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($product['preanalisis_excel']==0){
				
				echo "Preanalisis <sup>Excel</sup>   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			*/
			
			
			
			
			if($product['presta_serv']==1){
				
				echo "Convenio   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$product['fecha_presta_serv']." </sup><br><br>";
				
			}elseif($product['presta_serv']==2){
				
				echo "Convenio   <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$product['fecha_presta_serv']."</sup><br><br>";
				
			}elseif($product['presta_serv']==3){
				
				echo "Convenio   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($product['presta_serv']==0){
				
				echo "Convenio   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
			
			
				if($product['alta_envi']==1){
				
				echo "Alta Envipaq <sup>PDF</sup>  <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$product['fecha_alta_envi']." </sup><br><br>";
				
			}elseif($product['alta_envi']==2){
				
				echo "Alta Envipaq <sup>PDF</sup>  <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$product['fecha_alta_envi']."</sup><br><br>";
				
			}elseif($product['alta_envi']==3){
				
				echo "Alta Envipaq <sup>PDF</sup>  <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($product['alta_envi']==0){
				
				echo "Alta Envipaq <sup>PDF</sup>   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			if($product['alta_envi_excel']==1){
				
				echo "Alta Envipaq <sup>Excel</sup>  <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>".$product['fecha_alta_envi_excel']."</sup> <br><br>";
				
			}elseif($product['alta_envi_excel']==2){
				
				echo "Alta Envipaq <sup>Excel</sup>  <span class='label label-success'>Archivo Validado</span> Cargado<sup>".$product['fecha_alta_envi_excel']."</sup><br><br>";
				
			}elseif($product['alta_envi_excel']==3){
				
				echo "Alta Envipaq  <sup>Excel</sup> <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($product['alta_envi_excel']==0){
				
				echo "Alta Envipaq <sup>Excel</sup>  <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
				if($product['propuesta']==1){
				
				echo "Propuesta Comercial   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>". $product['fecha_propuesta']."</sup> <br><br>";
				
			}elseif($product['propuesta']==2){
				
				echo "Propuesta Comercial   <span class='label label-success'>Archivo Validado</span> Cargado<sup>". $product['fecha_propuesta']."</sup><br><br>";
				
			}elseif($product['propuesta']==3){
				
				echo "Propuesta Comercial   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($product['propuesta']==0){
				
				echo "Propuesta Comercial   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
				if($product['user_biis']==1){
				
				echo "Solicitud de Usuario   <span class='label label-info'>Pendiente de Validar</span> Cargado<sup>". $product['fecha_biis']."</sup> <br><br>";
				
			}elseif($product['user_biis']==2){
				
				echo "Solicitud de Usuario   <span class='label label-success'>Archivo Validado</span> Cargado<sup>". $product['fecha_biis']."</sup><br><br>";
				
			}elseif($product['user_biis']==3){
				
				echo "Solicitud de Usuario   <span class='label label-danger'>Archivo Rechazado en Espera de Nuevo</span> <br><br>";
				
			}elseif($product['user_biis']==0){
				
				echo "Solicitud de Usuario   <span class='label label-warning'>No Se ha Subido Documento</span> <br><br>";
				
			}
			
			
			/*identificacion=1 or c.comp_domicilio=1 or c.estado_cuenta=1 or c.preanalisis=1 or c.presta_serv=1 or c.alta_envi=1 or c.propuesta=1
			  ){}
			*/
			
			
			
			?></h4></div>
      <div class="modal-footer">
        <button type="button" class="btn btn btn-default" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div></div>
			
			
			
			
			
			
			
			
			
			
			
			
      <br>
                <div class="tab">
				
		<button class="tablinks active" onclick="openCity(event, 'alta')">Alta Envipaq<sup>PDF</sup></button>
					
   <button class="tablinks" onclick="openCity(event, 'alta_excel')">Alta Envipaq<sup>Excel</sup></button>
	<button class="tablinks" onclick="openCity(event, 'acta')">Acta Constitutiva </button>
 
					<button class="tablinks" onclick="openCity(event, 'fiscal')">Situación Fiscal</button>
  <button class="tablinks" onclick="openCity(event, 'oficial')">Identificación Oficial</button>
					 <button class="tablinks" onclick="openCity(event, 'domicilio')">Comprobante de Domicilio</button>
					
					 <button class="tablinks" onclick="openCity(event, 'cuenta')">Estado de Cuenta</button>
				
					<!--<button class="tablinks" onclick="openCity(event, 'pre-analisis')">Pre-Analisis<sup>PDF</sup></button>
					<button class="tablinks" onclick="openCity(event, 'pre-analisis_excel')">Pre-Analisis<sup>Excel</sup></button>
					--><button class="tablinks" onclick="openCity(event, 'prestacion')">Convenio</button>
					
					<button class="tablinks" onclick="openCity(event, 'propuesta')">Propuesta Comercial</button>
					<!--<button class="tablinks" onclick="openCity(event, 'cumplimiento')">Opinión de Cumplimiento</button>
			        <button class="tablinks" onclick="openCity(event, 'tarifario')">Tarifario<sup>PDF</sup></button>
			        --><button class="tablinks" onclick="openCity(event, 'tarifario_excel')">Tarifario<sup>Excel</sup></button>
					<button class="tablinks" onclick="openCity(event, 'biis')">Solicitud de Usuario</button>
					
</div>

			<?php //echo (int)$product['id']; ?>
				
			<div id="alta" class="tabcontent" style="display: block;">
			<?php
				if($product['alta_envi']==0){
					
					echo "<div class='alert alert-info' role='alert'><h3><center>NO HAY DOCUMENTO </center></h3></div>";
				}elseif($product['alta_envi']==1){
					chmod("archivos/".$product['ruta_alta_envi'], 0777 );
					
				?>
				
				
				
			<embed src="archivos/<?php echo $product['ruta_alta_envi']; ?>" type="application/pdf" width="100%" height="100%">	<?php
					
				}elseif($product['alta_envi']==2){
				echo "<div class='alert alert-success' role='alert'><h3><center>Documento Ya Validado </center></h3></div>";
				chmod("archivos/".$product['ruta_alta_envi'], 0777 );
				?>
				
			<embed src="archivos/<?php echo $product['ruta_alta_envi']; ?>" type="application/pdf" width="100%" height="100%">	
	
			<?php }elseif($product['alta_envi']==3){
				echo "<div class='alert alert-warning' role='alert'><h3><center>El Documento Fue Descartado no se ha Subido Uno Nuevo </center></h3></div>";
				?>
				
		
			<?php } ?>
				
				
				
								
				
			
			
			</div><!--fin div alta-->
			
	
		  
		  
		  
		  <div id="alta_excel" class="tabcontent">
			<?php
				if($product['alta_envi_excel']==0){
					
					echo "<div class='alert alert-info' role='alert'><h3><center>NO HAY DOCUMENTO </center></h3></div>";
				}elseif($product['alta_envi_excel']==1){
					chmod("archivos/".$product['ruta_alta_envi_excel'], 0777 );
					
				?>
				
			   <a href="archivos/<?php echo $product['ruta_alta_envi_excel'];?>"  download="alta_<?php echo $product['ruta_alta_envi_excel'];?>" data-toggle="tooltip" title="Descargar Archivo" style="display: inline;" ><img src="uploads/download.png"></a>
			  
			<iframe src="http://docs.google.com/gview?url=http://sci.envipaq.com.mx/login/archivos/<?php echo $product['ruta_alta_envi_excel']; ?>&embedded=true" style="width:100%; height:100%;" frameborder="0"></iframe>	
			  
			  <!--<embed src="archivos/<?php echo $product['ruta_alta_envi']; ?>" type="application/pdf" width="100%" height="100%">-->	<?php
					
				}elseif($product['alta_envi_excel']==2){
				echo "<div class='alert alert-success' role='alert'><h3><center>Documento Ya Validado </center></h3></div>";
				chmod("archivos/".$product['ruta_alta_envi_excel'], 0777 );
				?>
			  <a href="archivos/<?php echo $product['ruta_alta_envi_excel'];?>"  download="alta_<?php echo $product['ruta_alta_envi_excel'];?>" data-toggle="tooltip" title="Descargar Archivo" style="display: inline;" ><img src="uploads/download.png"></a>
			  
				<iframe src="http://docs.google.com/gview?url=http://sci.envipaq.com.mx/login/archivos/<?php echo $product['ruta_alta_envi_excel']; ?>&embedded=true" style="width:100%; height:100%;" frameborder="0"></iframe>	
			<!--<embed src="archivos/<?php echo $product['ruta_alta_envi']; ?>" type="application/pdf" width="100%" height="100%">	-->
	
			<?php }elseif($product['alta_envi_excel']==3){
				echo "<div class='alert alert-warning' role='alert'><h3><center>El Documento Fue Descartado no se ha Subido Uno Nuevo </center></h3></div>";
				?>
				
		
			<?php } ?>
				
				
				
								
				
			
			
			</div><!--fin div alta-->
		  
		  
		  
		  
  
  <div id="acta" class="tabcontent">  
	  
	  	<?php
				if($product['acta_constitutiva']==0){
					
					echo "<div class='alert alert-info' role='alert'><h3><center>NO HAY DOCUMENTO </center></h3></div>";
				}elseif($product['acta_constitutiva']==1){
					chmod("archivos/".$product['ruta_acta'], 0777 );
					
				?>
				
			<embed src="archivos/<?php echo $product['ruta_acta']; ?>" type="application/pdf" width="100%" height="100%">	<?php
					
				}elseif($product['acta_constitutiva']==2){
				echo "<div class='alert alert-success' role='alert'><h3><center>Documento Ya Validado </center></h3></div>";
				chmod("archivos/".$product['ruta_acta'], 0777 );
				?>
				
			<embed src="archivos/<?php echo $product['ruta_acta']; ?>" type="application/pdf" width="100%" height="100%">	
	
			<?php }elseif($product['acta_constitutiva']==3){
				echo "<div class='alert alert-warning' role='alert'><h3><center>El Documento Fue Descartado no se ha Subido Uno Nuevo </center></h3></div>";
				?>
			
			<?php } ?>
			   
			</div><!--fin div acta-->
		  
			
			<div id="fiscal" class="tabcontent">
				
				
				<?php
				if($product['sit_fiscar']==0){
					
					echo "<div class='alert alert-info' role='alert'><h3><center>NO HAY DOCUMENTO </center></h3></div>";
				}elseif($product['sit_fiscar']==1){
					chmod("archivos/".$product['ruta_fiscal'], 0777 );
					
				?>
				
			<embed src="archivos/<?php echo $product['ruta_fiscal']; ?>" type="application/pdf" width="100%" height="100%">	<?php
					
				}elseif($product['sit_fiscar']==2){
				echo "<div class='alert alert-success' role='alert'><h3><center>Documento Ya Validado </center></h3></div>";
				chmod("archivos/".$product['ruta_fiscal'], 0777 );
				?>
				
			<embed src="archivos/<?php echo $product['ruta_fiscal']; ?>" type="application/pdf" width="100%" height="100%">	
	
			<?php }elseif($product['sit_fiscar']==3){
				echo "<div class='alert alert-warning' role='alert'><h3><center>El Documento Fue Descartado no se ha Subido Uno Nuevo </center></h3></div>";
				?>
				
		
			<?php } ?>
				
			</div><!--fin div fiscal-->   
                    
          
    <div id="oficial" class="tabcontent">
		
				<?php
				if($product['identificacion']==0){
					
					echo "<div class='alert alert-info' role='alert'><h3><center>NO HAY DOCUMENTO </center></h3></div>";
				}elseif($product['identificacion']==1){
					chmod("archivos/".$product['ruta_identificacion'], 0777 );
					
				?>
				
			<embed src="archivos/<?php echo $product['ruta_identificacion']; ?>" type="application/pdf" width="100%" height="100%">	<?php
					
				}elseif($product['identificacion']==2){
				echo "<div class='alert alert-success' role='alert'><h3><center>Documento Ya Validado </center></h3></div>";
				chmod("archivos/".$product['ruta_identificacion'], 0777 );
				?>
				
			<embed src="archivos/<?php echo $product['ruta_identificacion']; ?>" type="application/pdf" width="100%" height="100%">	
	
			<?php }elseif($product['identificacion']==3){
				echo "<div class='alert alert-warning' role='alert'><h3><center>El Documento Fue Descartado no se ha Subido Uno Nuevo </center></h3></div>";
				?>
				
		
			<?php } ?>
		
			</div><!--fin div oficial-->
    	
			
			
			
			<div id="domicilio" class="tabcontent">
			
				<?php
				if($product['comp_domicilio']==0){
					
					echo "<div class='alert alert-info' role='alert'><h3><center>NO HAY DOCUMENTO </center></h3></div>";
				}elseif($product['comp_domicilio']==1){
					chmod("archivos/".$product['ruta_comprobante'], 0777 );
					
				?>
				
			<embed src="archivos/<?php echo $product['ruta_comprobante']; ?>" type="application/pdf" width="100%" height="100%">	<?php
					
				}elseif($product['comp_domicilio']==2){
				echo "<div class='alert alert-success' role='alert'><h3><center>Documento Ya Validado </center></h3></div>";
				chmod("archivos/".$product['ruta_comprobante'], 0777 );
				?>
				
			<embed src="archivos/<?php echo $product['ruta_comprobante']; ?>" type="application/pdf" width="100%" height="100%">	
	
			<?php }elseif($product['comp_domicilio']==3){
				echo "<div class='alert alert-warning' role='alert'><h3><center>El Documento Fue Descartado no se ha Subido Uno Nuevo </center></h3></div>";
				?>
				
		
			<?php } ?>
				
				
				
				
				
				
								
			</div><!--fin div domicilio-->
         
      <div id="cuenta" class="tabcontent">
		
		  
		  
		  	<?php
				if($product['estado_cuenta']==0){
					
					echo "<div class='alert alert-info' role='alert'><h3><center>NO HAY DOCUMENTO </center></h3></div>";
				}elseif($product['estado_cuenta']==1){
					chmod("archivos/".$product['ruta_cuenta'], 0777 );
					
				?>
				
			<embed src="archivos/<?php echo $product['ruta_cuenta']; ?>" type="application/pdf" width="100%" height="100%">	<?php
					
				}elseif($product['estado_cuenta']==2){
				echo "<div class='alert alert-success' role='alert'><h3><center>Documento Ya Validado </center></h3></div>";
				chmod("archivos/".$product['ruta_cuenta'], 0777 );
				?>
				
			<embed src="archivos/<?php echo $product['ruta_cuenta']; ?>" type="application/pdf" width="100%" height="100%">	
	
			<?php }elseif($product['estado_cuenta']==3){
				echo "<div class='alert alert-warning' role='alert'><h3><center>El Documento Fue Descartado no se ha Subido Uno Nuevo </center></h3></div>";
				?>
				
		
			<?php } ?>
		 			
			
			</div><!--fin div cuenta-->
			
			
			
			<div id="pre-analisis" class="tabcontent">
				
				
		  
		  	<?php
				if($product['preanalisis']==0){
					
					echo "<div class='alert alert-info' role='alert'><h3><center>NO HAY DOCUMENTO </center></h3></div>";
				}elseif($product['preanalisis']==1){
					chmod("archivos/".$product['ruta_preanalisis'], 0777 );
					
				?>
				
			<embed src="archivos/<?php echo $product['ruta_preanalisis']; ?>" type="application/pdf" width="100%" height="100%">	<?php
					
				}elseif($product['preanalisis']==2){
				echo "<div class='alert alert-success' role='alert'><h3><center>Documento Ya Validado </center></h3></div>";
				chmod("archivos/".$product['ruta_preanalisis'], 0777 );
				?>
				
			<embed src="archivos/<?php echo $product['ruta_cuenta']; ?>" type="application/pdf" width="100%" height="100%">	
	
			<?php }elseif($product['preanalisis']==3){
				echo "<div class='alert alert-warning' role='alert'><h3><center>El Documento Fue Descartado no se ha Subido Uno Nuevo </center></h3></div>";
				?>
				
		
			<?php } ?>
				
				
				
			</div><!--fin div pre-analisis pdf-->
		  
		  
		  
		  
		  
		  
		  
		  
				<div id="pre-analisis_excel" class="tabcontent">
				
				
		  
		  	<?php
				if($product['preanalisis_excel']==0){
					
					echo "<div class='alert alert-info' role='alert'><h3><center>NO HAY DOCUMENTO </center></h3></div>";
				}elseif($product['preanalisis_excel']==1){
					chmod("archivos/".$product['ruta_preanalisis_excel'], 0777 );
					
				?>
				
					<a href="archivos/<?php echo $product['ruta_preanalisis_excel'];?>"  download="alta_<?php echo $product['ruta_preanalisis_excel'];?>" data-toggle="tooltip" title="Descargar Archivo" style="display: inline;" ><img src="uploads/download.png"></a>
					
				<iframe src="http://docs.google.com/gview?url=http://sci.envipaq.com.mx/login/archivos/<?php echo $product['ruta_preanalisis_excel']; ?>&embedded=true" style="width:100%; height:100%;" frameborder="0"></iframe>	
					
			<!--<embed src="archivos/<?php echo $product['ruta_preanalisis']; ?>" type="application/pdf" width="100%" height="100%">-->	<?php
					
				}elseif($product['preanalisis_excel']==2){
				echo "<div class='alert alert-success' role='alert'><h3><center>Documento Ya Validado </center></h3></div>";
				chmod("archivos/".$product['ruta_preanalisis_excel'], 0777 );
				?>
					<a href="archivos/<?php echo $product['ruta_preanalisis_excel'];?>"  download="alta_<?php echo $product['ruta_preanalisis_excel'];?>" data-toggle="tooltip" title="Descargar Archivo" style="display: inline;" ><img src="uploads/download.png"></a>
					
				<iframe src="http://docs.google.com/gview?url=http://sci.envipaq.com.mx/login/archivos/<?php echo $product['ruta_preanalisis_excel']; ?>&embedded=true" style="width:100%; height:100%;" frameborder="0"></iframe>	
					
					
					
			<!--<embed src="archivos/<?php echo $product['ruta_cuenta']; ?>" type="application/pdf" width="100%" height="100%">	-->
	
			<?php }elseif($product['preanalisis_excel']==3){
				echo "<div class='alert alert-warning' role='alert'><h3><center>El Documento Fue Descartado no se ha Subido Uno Nuevo </center></h3></div>";
				?>
				
		
			<?php } ?>
				
				
				
			</div><!--fin div pre-analisis excel-->
		  
		  
		  
		  
		  
		  
			
		<div id="prestacion" class="tabcontent">
			
			
			
			
		  	<?php
				if($product['presta_serv']==0){
					
					echo "<div class='alert alert-info' role='alert'><h3><center>NO HAY DOCUMENTO </center></h3></div>";
				}elseif($product['presta_serv']==1){
					chmod("archivos/".$product['ruta_presta_serv'], 0777 );
					
				?>
				
			<embed src="archivos/<?php echo $product['ruta_presta_serv']; ?>" type="application/pdf" width="100%" height="100%">	<?php
					
				}elseif($product['presta_serv']==2){
				echo "<div class='alert alert-success' role='alert'><h3><center>Documento Ya Validado </center></h3></div>";
				chmod("archivos/".$product['ruta_presta_serv'], 0777 );
				?>
				
			<embed src="archivos/<?php echo $product['ruta_presta_serv']; ?>" type="application/pdf" width="100%" height="100%">	
	
			<?php }elseif($product['presta_serv']==3){
				echo "<div class='alert alert-warning' role='alert'><h3><center>El Documento Fue Descartado no se ha Subido Uno Nuevo </center></h3></div>";
				?>
				
		
			<?php } ?>
			
			
			
						
			</div><!--fin div prestacion-->
			
			
			
			<div id="propuesta" class="tabcontent">
				
				
				
				
		  	<?php
				if($product['propuesta']==0){
					
					echo "<div class='alert alert-info' role='alert'><h3><center>NO HAY DOCUMENTO </center></h3></div>";
				}elseif($product['propuesta']==1){
					chmod("archivos/".$product['ruta_propuesta'], 0777 );
					
				?>
				
			<embed src="archivos/<?php echo $product['ruta_propuesta']; ?>" type="application/pdf" width="100%" height="100%">	<?php
					
				}elseif($product['propuesta']==2){
				echo "<div class='alert alert-success' role='alert'><h3><center>Documento Ya Validado </center></h3></div>";
				chmod("archivos/".$product['ruta_propuesta'], 0777 );
				?>
				
			<embed src="archivos/<?php echo $product['ruta_propuesta']; ?>" type="application/pdf" width="100%" height="100%">	
	
			<?php }elseif($product['propuesta']==3){
				echo "<div class='alert alert-warning' role='alert'><h3><center>El Documento Fue Descartado no se ha Subido Uno Nuevo </center></h3></div>";
				?>
				
		
			<?php } ?>
			
						
			</div><!--fin div propuesta-->
			
			
			
			<div id="cumplimiento" class="tabcontent">
				
					
				
				
		  	<?php
				if($product['cumplimiento']==0){
					
					echo "<div class='alert alert-info' role='alert'><h3><center>NO HAY DOCUMENTO </center></h3></div>";
				}elseif($product['cumplimiento']==1){
					chmod("archivos/".$product['ruta_cumplimiento'], 0777 );
					
				?>
				
			<embed src="archivos/<?php echo $product['ruta_cumplimiento']; ?>" type="application/pdf" width="100%" height="100%">	<?php
					
				}elseif($product['cumplimiento']==2){
				echo "<div class='alert alert-success' role='alert'><h3><center>Documento Ya Validado </center></h3></div>";
				chmod("archivos/".$product['ruta_cumplimiento'], 0777 );
				?>
				
			<embed src="archivos/<?php echo $product['ruta_cumplimiento']; ?>" type="application/pdf" width="100%" height="100%">	
	
			<?php }elseif($product['cumplimiento']==3){
				echo "<div class='alert alert-warning' role='alert'><h3><center>El Documento Fue Descartado no se ha Subido Uno Nuevo </center></h3></div>";
				?>
				
		
			<?php } ?>
				
				
				
				
			</div><!--fin de cumplimiento-->
		  
		  
		  
		  <div id="tarifario" class="tabcontent">
				
					
				
				
		  	<?php
				if($product['tarifario']==0){
					
					echo "<div class='alert alert-info' role='alert'><h3><center>NO HAY DOCUMENTO </center></h3></div>";
				}elseif($product['tarifario']==1){
					chmod("archivos/".$product['ruta_tarifario'], 0777 );
					
				?>
				
			<embed src="archivos/<?php echo $product['ruta_tarifario']; ?>" type="application/pdf" width="100%" height="100%">	<?php
					
				}elseif($product['tarifario']==2){
				echo "<div class='alert alert-success' role='alert'><h3><center>Documento Ya Validado </center></h3></div>";
				chmod("archivos/".$product['ruta_tarifario'], 0777 );
				?>
				
			<embed src="archivos/<?php echo $product['ruta_tarifario']; ?>" type="application/pdf" width="100%" height="100%">	
	
			<?php }elseif($product['tarifario']==3){
				echo "<div class='alert alert-warning' role='alert'><h3><center>El Documento Fue Descartado no se ha Subido Uno Nuevo </center></h3></div>";
				?>
				
		
			<?php } ?>
				
				
				
				
			</div><!--fin de cumplimiento-->
		  
		  <div id="tarifario_excel" class="tabcontent">
				
				
		  
		  	<?php
				if($product['tarifario_excel']==0){
					
					echo "<div class='alert alert-info' role='alert'><h3><center>NO HAY DOCUMENTO </center></h3></div>";
				}elseif($product['tarifario_excel']==1){
					chmod("archivos/".$product['ruta_tarifario_excel'], 0777 );
					
				?>
				
			  
			  <a href="archivos/<?php echo $product['ruta_tarifario_excel'];?>"  download="alta_<?php echo $product['ruta_tarifario_excel'];?>" data-toggle="tooltip" title="Descargar Archivo" style="display: inline;" ><img src="uploads/download.png"></a>
			  
			  
				<iframe src="http://docs.google.com/gview?url=http://sci.envipaq.com.mx/login/archivos/<?php echo $product['ruta_tarifario_excel']; ?>&embedded=true" style="width:100%; height:100%;" frameborder="0"></iframe>	
					
			<!--<embed src="archivos/<?php echo $product['ruta_preanalisis']; ?>" type="application/pdf" width="100%" height="100%">-->	<?php
					
				}elseif($product['tarifario_excel']==2){
				echo "<div class='alert alert-success' role='alert'><h3><center>Documento Ya Validado </center></h3></div>";
				chmod("archivos/".$product['ruta_tarifario_excel'], 0777 );
				?>
			  
			  <a href="archivos/<?php echo $product['ruta_tarifario_excel'];?>"  download="alta_<?php echo $product['ruta_tarifario_excel'];?>" data-toggle="tooltip" title="Descargar Archivo" style="display: inline;" ><img src="uploads/download.png"></a>
			  
				<iframe src="http://docs.google.com/gview?url=http://sci.envipaq.com.mx/login/archivos/<?php echo $product['ruta_tarifario_excel']; ?>&embedded=true" style="width:100%; height:100%;" frameborder="0"></iframe>	
					
					
					
			<!--<embed src="archivos/<?php echo $product['ruta_cuenta']; ?>" type="application/pdf" width="100%" height="100%">	-->
	
			<?php }elseif($product['tarifario_excel']==3){
				echo "<div class='alert alert-warning' role='alert'><h3><center>El Documento Fue Descartado no se ha Subido Uno Nuevo </center></h3></div>";
				?>
				
		
			<?php } ?>
				
				
				
			</div><!--fin div pre-analisis excel-->
		  
		  	  <div id="biis" class="tabcontent">
				
					
				
				
		  	<?php
				if($product['user_biis']==0){
					
					echo "<div class='alert alert-info' role='alert'><h3><center>NO HAY DOCUMENTO </center></h3></div>";
				}elseif($product['user_biis']==1){
					chmod("archivos/".$product['ruta_biis'], 0777 );
					
				?>
				<div align="right" style="display:inline;">
					
					<form method="post" action="detalle_documento.php?id=<?php echo $id;?>">
					<input type="hidden" name="id_edit" value="<?php echo $id;  ?>">
				
				<button type="submit" name="biis" class="btn btn-success" title="Aceptar" data-toggle="tooltip"><i class="glyphicon glyphicon-ok" ></i></button>
					
					</form>
					
					<form method="post" action="detalle_documento.php?id=<?php echo $id;?>">
					<input type="hidden" name="id_edit" value="<?php echo $id;  ?>">
				
					<input type="text" name="notas" class="notas" placeholder="Agrega Notas de Rechazo" >
					<button type="submit" name="biisx" class="btn btn-danger" title="Rechazar" data-toggle="tooltip"><i class="glyphicon glyphicon-remove" ></i></button>
					</form>
			</div>
			<embed src="archivos/<?php echo $product['ruta_biis']; ?>" type="application/pdf" width="100%" height="100%">	<?php
					
				}elseif($product['user_biis']==2){
				echo "<div class='alert alert-success' role='alert'><h3><center>Documento Ya Validado </center></h3></div>";
				chmod("archivos/".$product['ruta_biis'], 0777 );
				?>
				
			<embed src="archivos/<?php echo $product['ruta_biis']; ?>" type="application/pdf" width="100%" height="100%">	
	
			<?php }elseif($product['user_biis']==3){
				echo "<div class='alert alert-warning' role='alert'><h3><center>El Documento Fue Descartado no se ha Subido Uno Nuevo </center></h3></div>";
				?>
				
		
			<?php } ?>
				
				
				
				
			</div><!--fin de biis-->
			
			  <?php endforeach; ?>
    <script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
		
	 function comer_calcula(){

 

        var a = Number (document.getElementById('comer_venta').value );

        var b = Number (document.getElementById('comer_compra').value );

 

        var c = a - b;

 var resul= Math.sign(c);

			if(resul==1){
document.getElementById('comer_resul').innerHTML ="Ganacia $"+c;
        //document.getElementById('resul').html().value = c;

        }else{
				
				 document.getElementById('comer_resul').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
				
			}

        //alert(document.getElementById('maxima').options[document.getElementById('maxima').selectedIndex].text);

    }	
		
		
			
	 function uva_calcula(){

 

        var a = Number (document.getElementById('uva_venta').value );

        var b = Number (document.getElementById('uva_compra').value );

 

        var c = a - b;

 var resul= Math.sign(c);

			if(resul==1){
document.getElementById('uva_resul').innerHTML ="Ganacia $"+c;
        //document.getElementById('resul').html().value = c;

        }else{
				
				 document.getElementById('uva_resul').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
				
			}

        //alert(document.getElementById('maxima').options[document.getElementById('maxima').selectedIndex].text);

    }
		
		
		
		
		
		function etiquetado_calcula(){

 

        var a = Number (document.getElementById('etiquetado_venta').value );

        var b = Number (document.getElementById('etiquetado_compra').value );

 

        var c = a - b;

 var resul= Math.sign(c);

			if(resul==1){
document.getElementById('etiquetado_resul').innerHTML ="Ganacia $"+c;
        //document.getElementById('resul').html().value = c;

        }else{
				
				 document.getElementById('etiquetado_resul').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
				
			}}

		
		
		
		
	function embalado_calcula(){

 

        var a = Number (document.getElementById('embalado_venta').value );

        var b = Number (document.getElementById('embalado_compra').value );

 

        var c = a - b;

 var resul= Math.sign(c);

			if(resul==1){
document.getElementById('embalado_resul').innerHTML ="Ganacia $"+c;
        //document.getElementById('resul').html().value = c;

        }else{
				
				 document.getElementById('embalado_resul').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
				
			}}
		
		
		
		
		
		
		
		
		
		
		
		
		
 
 function calcula(){

 

        var a = Number (document.getElementById('venta').value );

        var b = Number (document.getElementById('compra').value );

 

        var c = a - b;

 var resul= Math.sign(c);

			if(resul==1){
document.getElementById('resul').innerHTML ="Ganacia $"+c;
        //document.getElementById('resul').html().value = c;

        }else{
				
				 document.getElementById('resul').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
				
			}

        //alert(document.getElementById('maxima').options[document.getElementById('maxima').selectedIndex].text); arance_compra

    } function arance_calcula(){

 

        var a = Number (document.getElementById('arance_venta').value );

        var b = Number (document.getElementById('arance_compra').value );

 

        var c = a - b;

 var resul= Math.sign(c);

			if(resul==1){
			  
document.getElementById('arance_resul').innerHTML ="Ganacia $"+c;
        //document.getElementById('resul').html().value = c;
			}else{
				
				 document.getElementById('arance_resul').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
				
			}
        

        //alert(document.getElementById('maxima').options[document.getElementById('maxima').selectedIndex].text); arance_compra calcula_flete

    }
	
		function calcula_al(){

 

        var a = Number (document.getElementById('venta_al').value );

        var b = Number (document.getElementById('compra_al').value );

 

        var c = a - b;

var resul= Math.sign(c);

			if(resul==1){
			   
			   document.getElementById('resul_al').innerHTML ="Ganacia $"+c;
        //docum
			   }else{
			   document.getElementById('resul_al').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
        //document.getElementById('resul').html().value = c;
			   }
        

        //alert(document.getElementById('maxima').options[document.getElementById('maxima').selectedIndex].text);

    }
		
	function calcula_flete(){

 

        var a = Number (document.getElementById('venta_flete').value );

        var b = Number (document.getElementById('compra_flete').value );

 

        var c = a - b;

var resul= Math.sign(c);

			if(resul==1){
			   
			   document.getElementById('resul_flete').innerHTML ="Ganacia $"+c;
        //docum
			   }else{
			   document.getElementById('resul_flete').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
        //document.getElementById('resul').html().value = c;
			   }
        

        //alert(document.getElementById('maxima').options[document.getElementById('maxima').selectedIndex].text);

    }
	
		
		
		function calcula_coti(){

 

        var a = Number (document.getElementById('venta_coti').value );

        var b = Number (document.getElementById('compra_coti').value );

 

        var c = a - b;

var resul= Math.sign(c);

			if(resul==1){
			   
			   document.getElementById('resul_coti').innerHTML ="Ganacia $"+c;
        //docum
			   }else{
			   document.getElementById('resul_coti').innerHTML ="<h4><span style='background-color: crimson; color: white;'>Hay Perdida $"+c+"</span></h4>";
        //document.getElementById('resul').html().value = c;
			   }
        

        //alert(document.getElementById('maxima').options[document.getElementById('maxima').selectedIndex].text);

    }
		
		
		
		
		
		$(document).ready(function() {
				$("#otro_btn").on( "click", function() {
			$('#otro').css("display:block;")
				});
			
			
			$("#producto_3").on( "click", function() {
			$('#otro').css("display:none;")
		});
		
	});
		
		$(document).ready(function() {
				$("#pdf_btn").focus(function(event) {
					$("#pdf").load('desarrollo.php');
				});
			});
		

	 
	 $(document).ready(function() {
     $('.btn-danger').prop('disabled', true);
     $('#notas').keyup(function() {
        if($(this).val() != '') {
           $('.btn-danger').prop('disabled', false);
        }
     });
 });
		 
		 
	
	
			
			
			
</script>


<?php include_once('layouts/footer.php'); ?>
