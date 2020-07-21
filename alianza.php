<?php
  $page_title = 'Alianza';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
  
?>
<?php 
include_once('layouts/header.php');
$id=$user['id'];
 $products = operador_alianza($id);
 ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Para Programar Hoy <?php echo date("d/m/Y");?></strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered"> 
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center"> EMPRESA</th>
                <th class="text-center">DIRECCION</th>
				
                <th class="text-center" style="width: 10%;"> CODIGO DE RECOLECCIÓN</th>
                
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td><span title="<?php echo remove_junk($product['notas']); ?>" data-toggle="tooltip"> <?php echo remove_junk($product['id_empresa']); ?></span></td>
                <td>
                
                           
                
                
                Contacto <strong><?php  echo $product['nombre'];?></strong> Telefono:  <strong><?php  echo $product['telefono'];?></strong><br> Correo: <strong style="text-transform:lowercase"><?php  echo $product['correo'];?></strong><br />
  
 Calle: <strong><?php echo $product['direccion'];?></strong> Numero: <strong><?php echo $product['numero'];?></strong>  Colonia: <strong><?php  echo $product['colonia'];?></strong>  Delegación: <strong><?php  echo $product['delegacion'];?></strong><br>  Codigo Postal: <strong><?php  echo $product['cp'];?></strong> <br />
 Medidas del Paquete más Grande: Alto <strong><?php echo remove_junk($product['alto']); ?> </strong>x Ancho <strong><?php echo remove_junk($product['ancho']); ?></strong> x Largo <strong><?php echo remove_junk($product['largo']); ?>"</strong>  Total a recoger: <strong><?php echo remove_junk($product['totalp']); ?></strong><br>
					Fecha de Solicitud de Recoleccion: <strong><?php $fecha_recoleccion=strftime("%d %B del %Y", strtotime($product['fechaprogramar'])) ;
					echo $fecha_recoleccion;?></strong>
                 
                 </td>  <!--fin direccion-->
				  
                <td class="text-center">
                
                <br />
                <form method="post" action="correo_alianza.php" class="clearfix">
 <input name="alianza" type="text" placeholder="Codigo de Recolección" onkeyup="mayus(this);" />
 <input name="id_recoleccion" type="hidden" value="<?php echo $product['id_reco']; ?>"/><br />
 <input name="correo" type="hidden" value="<?php echo $product['correo']; ?>"/>
 
 <button type="submit" name="alianza_correo" class="btn btn-success btn-block">Ingresa Codigo</button>
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
  <?php include_once('layouts/footer.php'); ?>
