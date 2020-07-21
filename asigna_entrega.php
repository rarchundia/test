<?php
  $page_title = 'Recolección por Día';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  //$year  = date('Y');
 //$month = date('m');
 $recoleccion = asigna_entrega();
 $operadores = find_all('users');
?>
<?php
 
	  
if(isset($_POST['agregar_operador'])){
    $req_fields = array('asiga_operador');
   validate_fields($req_fields);
 $id = $_POST['id'];
  $incrementa=$_POST['asigna'];
	     $operador = remove_junk($db->escape($_POST['asiga_operador']));
   if(empty($errors)){

     
	   $query   = "UPDATE entrega SET id_operador='{$operador}', asignado='{$incrementa}'";
       $query  .=" WHERE id ='{$id}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Asignado Correctamente. ");
                 redirect('asigna_entrega.php', false);
               } else {
                 $session->msg('d',' Lo Siento, La Asignación Falló.');
                 redirect('asigna_entrega.php?id='.$product['id'], false);
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
          
          <span>Entregas          
            <!--Para <?php //echo date("d/m/Y"); $id_user;?>--></span>
       </strong>
      </div>
        <div class="panel-body">
         
              <?php foreach ($recoleccion as $recolecta):?>
			
     
<button class="accordion"># <?php echo  $recolecta['id'];?>.-   Entrega.  <strong>Folio: <?php  echo $recolecta['guia'];?></strong>    Remitente:   <strong><?php  echo $recolecta['remitente'];?></strong>    Razon Social<strong>
     <?php echo $recolecta['razon_social'];?>
      </strong> </button>

	<div class="acordeon"><p><h2><center>Remitente</center></h2>
		<h3>
		 Remitente:   <strong><?php  echo $recolecta['remitente'];?></strong> 
	Razon Social:   <strong><?php  echo $recolecta['razon_social'];?> </strong>
			<br>Direccion:   <strong><?php  echo $recolecta['direccion'];?> </strong>
		Colonia:   <strong><?php  echo $recolecta['colonia'];?> </strong>
		Codigo Postal:   <strong><?php  echo $recolecta['cp'];?> </strong>
		Telefono:   <strong><?php  echo $recolecta['telefono'];?> </strong>
	
		</h3>
	<br>	
      <h2><center>Destinatario</center></h2><br>
			<h3>Nombre destinatario:   <strong><?php  echo $recolecta['nombre_destinatario'];?></strong> 
	Razon Social:   <strong><?php  echo $recolecta['razonsocial_des'];?> </strong>
		<br>Direccion:   <strong><?php  echo $recolecta['direccion_des'];?> </strong>
		Colonia:   <strong><?php  echo $recolecta['colonia_des'];?> </strong>
		Codigo Postal:   <strong><?php  echo $recolecta['cp_des'];?> </strong>
			Telefono:   <strong><?php  echo $recolecta['telefono_des'];?> </strong>
			<br><br><br>
     <div class="col-md-6">
     <div class="col-md-6">
                <div class="input-group"><form method="post" action="asigna_entrega.php">
            
  <select class="form-control" name="asiga_operador" required>
                      <option value="">Asignar a:</option>
                      
                    
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
				  
				  
				  
				
				  
				  
				  
				  
				  
				  
				  
				  //fin acordeon accordion_stylo
</script>
            
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
