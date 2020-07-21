<?php
  $page_title = 'Odometro Día Anterior';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(4);
  
?>
<?php 
include_once('layouts/header.php');
//$norte_odometro = recoleccion_diaria_odometro();
$norte=5;
$sur=6;
$oriente=7;
$poniente=8;

$norte_odometro = recoleccion_diaria_odometro_ayer($norte);
$sur_odometro = recoleccion_diaria_odometro_ayer($sur);
$oriente_odometro = recoleccion_diaria_odometro_ayer($oriente);
$poniente_odometro = recoleccion_diaria_odometro_ayer($poniente);


$todometro_norte=odometro_total($norte);
$todometro_sur=odometro_total($sur);
$todometro_oriente=odometro_total($oriente);
$todometro_poniente=odometro_total($poniente);

//foreach ($norte_odometro as $norte_echo):
              
 ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
   
     
      
        <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Odometro Ruta Norte del:  <?php echo date("d")-1;echo date("/m/Y"); ?>
       
       <article align="right"><?php echo $todometro_norte['total_odometro'];?> Km</article>
       </strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered"> 
            <thead>
              <tr>
                <th class="text-center" style="width: 30px;">#</th>
                <th class="text-center">EMPRESA</th>   
                <th class="text-center">DIRECCIÓN</th>
                 <th class="text-center">PLACAS / OPERADOR</th>
                 <th class="text-center">ODOMETRO</th>
                
              </tr>
            </thead>
            <tbody>
              <?php foreach ($norte_odometro as $norte_echo):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td><span title="<?php echo remove_junk($norte_echo['notas']); ?>" data-toggle="tooltip"> <?php echo remove_junk($norte_echo['id_empresa']); ?></span></td>
                <td>
                
                           
        
                
                Contacto <strong><?php  echo $norte_echo['nombre'];?></strong> Telefono:  <strong><?php  echo $norte_echo['telefono'];?></strong><br> Correo: <strong style="text-transform:lowercase"><?php  echo $norte_echo['correo'];?></strong><br />
  
 Calle: <strong><?php echo $norte_echo['direccion'];?></strong> Numero: <strong><?php echo $norte_echo['numero'];?></strong>  Colonia: <strong><?php  echo $norte_echo['colonia'];?></strong>  Delegación: <strong><?php  echo $norte_echo['delegacion'];?></strong> Codigo Postal: <strong><?php  echo $norte_echo['cp'];?></strong> <br />
 Medidas del Paquete más Grande: Alto <strong><?php echo remove_junk($norte_echo['alto']); ?> </strong>x Ancho <strong><?php echo remove_junk($norte_echo['ancho']); ?></strong> x Largo <strong><?php echo remove_junk($norte_echo['largo']);
					
					if($norte_echo['medida']==1){
	  echo " CM ";
	  }else{ 
	  echo " Metros ";
	  }
					
					
					?>"</strong>  Total a recoger: <strong><?php echo remove_junk($norte_echo['totalp']); ?></strong><!--fin direccion-->
			 
                                      </td>  
                <td><?php echo remove_junk($norte_echo['placas']); ?> / <?php echo remove_junk($norte_echo['operador']); ?></td>
                <td><?php echo remove_junk($norte_echo['odometro']); ?></td>
                
               
                  </div>
                </td>
              </tr> 
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
 
 
 
 
 
 
 
 
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Odometro Ruta Sur del:  <?php echo date("d")-1;echo date("/m/Y");?><article align="right"><?php echo $todometro_sur['total_odometro'];?> Km</article>
       </strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered"> 
            <thead>
              <tr>
                <th class="text-center" style="width: 30px;">#</th>
                <th class="text-center">EMPRESA</th>   
                <th class="text-center">DIRECCIÓN</th>
                 <th class="text-center">PLACAS / OPERADOR</th>
                 <th class="text-center">ODOMETRO</th>
                
              </tr>
            </thead>
            <tbody>
              <?php foreach ($sur_odometro as $sur_echo):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td><span title="<?php echo remove_junk($sur_echo['notas']); ?>" data-toggle="tooltip"> <?php echo remove_junk($sur_echo['id_empresa']); ?></span></td>
                <td>
                
                           
        
                
                Contacto <strong><?php  echo $sur_echo['nombre'];?></strong> Telefono:  <strong><?php  echo $sur_echo['telefono'];?></strong><br> Correo: <strong style="text-transform:lowercase"><?php  echo $sur_echo['correo'];?></strong><br />
  
 Calle: <strong><?php echo $sur_echo['direccion'];?></strong> Numero: <strong><?php echo $sur_echo['numero'];?></strong>  Colonia: <strong><?php  echo $sur_echo['colonia'];?></strong>  Delegación: <strong><?php  echo $sur_echo['delegacion'];?></strong> Codigo Postal: <strong><?php  echo $sur_echo['cp'];?></strong> <br />
 Medidas del Paquete más Grande: Alto <strong><?php echo remove_junk($sur_echo['alto']); ?> </strong>x Ancho <strong><?php echo remove_junk($sur_echo['ancho']); ?></strong> x Largo <strong><?php echo remove_junk($sur_echo['largo']);
					
					if($sur_echo['medida']==1){
	  echo " CM ";
	  }else{ 
	  echo " Metros ";
	  }
					
					
					?>"</strong>  Total a recoger: <strong><?php echo remove_junk($sur_echo['totalp']); ?></strong><!--fin direccion-->
			 
                                      </td>  
               <td><?php echo remove_junk($sur_echo['placas']); ?> / <?php echo remove_junk($norte_echo['operador']); ?></td>
               <td><?php echo remove_junk($sur_echo['odometro']); ?></td>
                
               
                  </div>
                </td>
              </tr> 
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  
  
  
  
  
  
  
  
  
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Odometro Ruta Oriente del:  <?php echo date("d")-1;echo date("/m/Y");?>
       <article align="right"><?php echo $todometro_oriente['total_odometro'];?></article>
        Km</strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered"> 
            <thead>
              <tr>
                <th class="text-center" style="width: 30px;">#</th>
                <th class="text-center">EMPRESA</th>   
                <th class="text-center">DIRECCIÓN</th>
                 <th class="text-center">PLACAS / OPERADOR</th>
                 <th class="text-center">ODOMETRO</th>
                
              </tr>
            </thead>
            <tbody>
              <?php foreach ($oriente_odometro as $oriente_echo):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td><span title="<?php echo remove_junk($oriente_echo['notas']); ?>" data-toggle="tooltip"> <?php echo remove_junk($oriente_echo['id_empresa']); ?></span></td>
                <td>
                
                           
        
                
                Contacto <strong><?php  echo $oriente_echo['nombre'];?></strong> Telefono:  <strong><?php  echo $oriente_echo['telefono'];?></strong><br> Correo: <strong style="text-transform:lowercase"><?php  echo $oriente_echo['correo'];?></strong><br />
  
 Calle: <strong><?php echo $oriente_echo['direccion'];?></strong> Numero: <strong><?php echo $oriente_echo['numero'];?></strong>  Colonia: <strong><?php  echo $oriente_echo['colonia'];?></strong>  Delegación: <strong><?php  echo $oriente_echo['delegacion'];?></strong> Codigo Postal: <strong><?php  echo $oriente_echo['cp'];?></strong> <br />
 Medidas del Paquete más Grande: Alto <strong><?php echo remove_junk($oriente_echo['alto']); ?> </strong>x Ancho <strong><?php echo remove_junk($oriente_echo['ancho']); ?></strong> x Largo <strong><?php echo remove_junk($oriente_echo['largo']);
					
					if($oriente_echo['medida']==1){
	  echo " CM ";
	  }else{ 
	  echo " Metros ";
	  }
					
					
					?>"</strong>  Total a recoger: <strong><?php echo remove_junk($oriente_echo['totalp']); ?></strong><!--fin direccion-->
			 
                                      </td>  
               <td><?php echo remove_junk($oriente_echo['placas']); ?> / <?php echo remove_junk($norte_echo['operador']); ?></td>
               <td><?php echo remove_junk($oriente_echo['odometro']); ?></td>
                
               
                  </div>
                </td>
              </tr> 
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  
  
  
  
  
  
  
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Odometro Ruta Poniente del:  <?php echo date("d")-1;echo date("/m/Y");?>
        <article align="right"><?php echo $todometro_poniente['total_odometro'];?></article>
        Km</strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered"> 
            <thead>
              <tr>
                <th class="text-center" style="width: 30px;">#</th>
                <th class="text-center">EMPRESA</th>   
                <th class="text-center">DIRECCIÓN</th>
                 <th class="text-center">PLACAS / OPERADOR</th>
                 <th class="text-center">ODOMETRO</th>
                
              </tr>
            </thead>
            <tbody>
              <?php foreach ($poniente_odometro as $poriente_echo):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td><span title="<?php echo remove_junk($poriente_echo['notas']); ?>" data-toggle="tooltip"> <?php echo remove_junk($poriente_echo['id_empresa']); ?></span></td>
                <td>
                
                           
        
                
                Contacto <strong><?php  echo $poriente_echo['nombre'];?></strong> Telefono:  <strong><?php  echo $poriente_echo['telefono'];?></strong><br> Correo: <strong style="text-transform:lowercase"><?php  echo $poriente_echo['correo'];?></strong><br />
  
 Calle: <strong><?php echo $poriente_echo['direccion'];?></strong> Numero: <strong><?php echo $poriente_echo['numero'];?></strong>  Colonia: <strong><?php  echo $poriente_echo['colonia'];?></strong>  Delegación: <strong><?php  echo $poriente_echo['delegacion'];?></strong> Codigo Postal: <strong><?php  echo $poriente_echo['cp'];?></strong> <br />
 Medidas del Paquete más Grande: Alto <strong><?php echo remove_junk($poriente_echo['alto']); ?> </strong>x Ancho <strong><?php echo remove_junk($poriente_echo['ancho']); ?></strong> x Largo <strong><?php echo remove_junk($poriente_echo['largo']);
					
					if($poriente_echo['medida']==1){
	  echo " CM ";
	  }else{ 
	  echo " Metros ";
	  }
					
					
					?>"</strong>  Total a recoger: <strong><?php echo remove_junk($poriente_echo['totalp']); ?></strong><!--fin direccion-->
			 
                                      </td>  
               <td><?php echo remove_junk($poriente_echo['placas']); ?> / <?php echo remove_junk($norte_echo['operador']); ?></td>
               <td><?php echo remove_junk($poriente_echo['odometro']); ?></td>
                
               
                  </div>
                </td>
              </tr> 
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  
  
  
  
  
  
  
  
  
  
  
  
  <?php include_once('layouts/footer.php'); ?>
