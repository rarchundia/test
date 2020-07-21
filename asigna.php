<?php
  $page_title = 'Recolección por Día';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  //$year  = date('Y');
 //$month = date('m');
 $recoleccion = recoleccion_diaria();
 $operadores = find_all('users');
?>
<?php
 
	  
if(isset($_POST['agregar_operador'])){
    $req_fields = array('asiga_operador');
   validate_fields($req_fields);
 $id = $_POST['id'];
  $incrementa=$_POST['asigna'];
   if(empty($errors)){
     $operador = remove_junk($db->escape($_POST['asiga_operador']));

     
	   $query   = "UPDATE recolecta SET id_operador='{$operador}', asignado='{$incrementa}'";
       $query  .=" WHERE id ='{$id}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Asignado Correctamente. ");
                 redirect('asigna.php', false);
               } else {
                 $session->msg('d',' Lo Siento, La Asignación Falló.');
                 redirect('asigna.php?id='.$product['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('home.php', false);
   }

 }//fin laptop
 
 
 

?>
<?php include_once('layouts/header.php');

$id_user=$user['id'];
  

 ?>

  <div class="row">
     <div class="col-md-12">
     
             
         </div>
  </div>

    <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          
          <span>Recolecciones          
            <!--Para <?php //echo date("d/m/Y"); $id_user;?>--></span>
       </strong>
      </div>
        <div class="panel-body">
         
              <?php foreach ($recoleccion as $recolecta):?>
			
     
<button <?php
		
		
		if($recolecta['paqueteria']==1){
		
		?>
		 class="accordion_stylo"
			
			
	<?php	}else{
	
	?>
			
			class="accordion"
			
			
	<?php	} ; ?>
		
		
		
		
		
		
		
		
		
		
		
		># <?php echo  $recolecta['id'];?>.-  Solicitud de: <strong><?php  echo $recolecta['id_empresa'];?></strong> Paquetes a Recolectar: <strong><?php  echo $recolecta['totalp'];?> Paquetes</strong> Fecha de Solicitud: <strong>
     <?php echo $recolecta['fechasolicitud'];?><?php
      if($recolecta['paqueteria']==1){
      echo "  Envipaq ";
	  }
		if($recolecta['paqueteria']==2){
      echo "  Fedex ";
	  }
		if($recolecta['paqueteria']==3){
      echo "  Estafeta ";
	  }
		if($recolecta['paqueteria']==4){
      echo "  Redpack ";
	  }
		if($recolecta['paqueteria']==5){
      echo "  PaqueteExpres ";
	  }if($recolecta['paqueteria']==0){
			
	echo "  El Usuario No Selecciono Ninguna Paqueteria ";
	  			
			
		}
		?>
      </strong> </button>

	<div <?php
		
		
		if($recolecta['paqueteria']==1){
		
		?>
		 class="accordeon_stylo"
			
			
	<?php	}else{
	
	?>
			
		 class="acordeon"

			
			
	<?php	} ; ?>
  
   
    
  ><p><h3>Contacto <strong><?php  echo $recolecta['nombre'];?></strong> Telefono:  <strong><?php  echo $recolecta['telefono'];?></strong> Correo: <strong style="text-transform:lowercase"><?php  echo $recolecta['correo'];?></strong><br /><br />
  
 Calle: <strong><?php echo $recolecta['direccion'];?></strong>  Colonia: <strong><?php  echo $recolecta['colonia'];?></strong>  Delegación: <strong><?php  echo $recolecta['delegacion'];?></strong>  Codigo Postal Origen: <strong><?php  echo $recolecta['cp'];?></strong>
  
  Codigo Postal Destino: <strong><?php echo $recolecta['cp_des'];?><br /><br /></strong>
  
  A recolectar: <strong><?php  echo $recolecta['totalp'];?></strong> Paquetes Medida del más Grande: Alto <strong><?php  echo $recolecta['alto'];?></strong> Ancho <strong><?php  echo $recolecta['ancho'];?></strong> Largo <strong><?php  echo $recolecta['largo']; 
  if($recolecta['medida']==1){
	  echo " CM ";
	  }else{ 
	  echo " Metros ";
	  }?>
      </strong> Con Peso: <strong><?php echo $recolecta['peso'];?> Kg  </strong>Notas: <strong><?php echo $recolecta['notas'];?><br>
      
      <?php
      if($recolecta['paqueteria']==1){
      echo "El usuario selecciono Envipaq";
	  }
		if($recolecta['paqueteria']==2){
      echo "El usuario selecciono Fedex";
	  }
		if($recolecta['paqueteria']==3){
      echo "El usuario selecciono Estafeta";
	  }
		if($recolecta['paqueteria']==4){
      echo "El usuario selecciono Redpack";
	  }
		if($recolecta['paqueteria']==5){
      echo "El usuario selecciono Paquete Expres";
	  }if($recolecta['paqueteria']==0){
			
	echo "El Usuario No Selecciono Ninguna Paqueteria";
	  		
			
		}
		?>
      </strong><br><br>
      
     
     <div class="col-md-6">
     <div class="col-md-8">
                <div class="input-group"><form method="post" action="asigna.php">
            
  <select class="form-control" name="asiga_operador" required>
                      <option value="">Asignar a:</option>
                      
                    <option value="4">ALIANZA</option>
                    <option value="5">NORTE</option>
                    <option value="6">SUR</option>
                    <option value="7">ORIENTE</option>
                    <option value="8">PONIENTE</option>
	                <option value="14">ESPECIAL</option>
                    </select>
                    
                    <input type="hidden" name="id" value="<?php echo $recolecta['id'];?>">
                    <input type="hidden" name="asigna" value="1"></div></div>
                    <button type="submit" name="agregar_operador" class="btn btn-success" >Asigna a Operador</button>
        </form>
 </h3></p><br><br></div>

              
              
                
              <?php endforeach; ?>
              <script>
	var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
				  
				  
				  
				  
				  
				  var acc = document.getElementsByClassName("accordion_stylo");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  //fin acordeon accordion_stylo
</script>
            
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
