<?php
  $page_title = 'Bloqueados';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(6);

$ultima_fecha=find_ultima_fecha('clientes');	



?>
<?php 

if(isset($_POST['add_cliente'])){
 
  $p_cliente= $_POST['cliente'];
    
     $query  = "INSERT INTO clientes (";
     $query .=" nombre";
     $query .=") VALUES (";
     $query .="'{$p_cliente}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE nombre='{$p_cliente}'";
	 
		if($db->query($query)){
		 
	  $session->msg('s',"Cliente Agregado Correctamente. ");
	//redirect('ingresa_odometro.php', false);
	  echo '<meta http-equiv="Refresh" content="0; url=bloqueadosc.php">';	 
	 
	 }
	    else {
       $session->msg('d',' Lo siento, Falló al Agregar el Cliente.');
      //redirect('ingresa_odometro.php', false);
	   echo '<meta http-equiv="Refresh" content="0; url=bloqueadosc.php">';
		}

  

 }
 
 

?>
<?php 

if(isset($_POST['bloqueo_notas'])){
 
  $p_id_bloqueo= $_POST['id_bloqueo'];
	 $p_notas= $_POST['notas'];
    $fecha    = make_date();
     $query  = "UPDATE clientes SET estatus=1, notas='{$p_notas}', fecha_actualizacion='{$fecha}' WHERE id='{$p_id_bloqueo}'";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
	 
			   
    	 if($db->query($query)){
		 
	  $session->msg('s',"Se ha Bloqueado  al Cliente. ");
	//redirect('ingresa_odometro.php', false);
	  echo '<meta http-equiv="Refresh" content="0; url=bloqueadosc.php">';	 
	
	 }
	    else {
       $session->msg('d',' Lo siento, Falló al Agregar Bloqueo al Cliente.');
      //redirect('ingresa_odometro.php', false);
	   echo '<meta http-equiv="Refresh" content="0; url=bloqueadosc.php">';
		}

  

 }
 
 

?>

<?php 

if(isset($_POST['desbloqueo'])){
 
  $p_id_bloqueo= $_POST['id_bloqueo'];
	$fecha    = make_date();
    
     $query  = "UPDATE clientes SET estatus=0, fecha_actualizacion='{$fecha}' WHERE id='{$p_id_bloqueo}'";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
	 
			   
    	 if($db->query($query)){
		 
	  $session->msg('s',"Se ha Desbloqueado  al Cliente. ");
	//redirect('ingresa_odometro.php', false);
	  echo '<meta http-equiv="Refresh" content="0; url=bloqueadosc.php">';	 
	
	 }
	    else {
       $session->msg('d',' Lo siento, Falló al Desbloquear al Cliente.');
      //redirect('ingresa_odometro.php', false);
	   echo '<meta http-equiv="Refresh" content="0; url=bloqueadosc.php">';
		}

  

 }
 
 

?>

<style>

	

	#bloqueados{
		background-color: crimson;
		color: white;
	}
</style>

<?php include_once('layouts/header.php');

$recent_products = clientes_envi_bloq();
$recent_sales = clientes_envi();
?>


 <div class="row">
     <div class="col-md-13">
       <?php echo display_msg($msg); ?>
     </div>
	 
	 
	 
    <div class="col-md-13">
		
		
      <div class="panel panel-default">
        <div class="panel-heading clearfix">

			
			
			
			
			
			<div class="col-md-12"> <!--principio-->
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
<strong>Agregar Cliente
	
       </strong>
        </div>
		  
		  
		  
        <div class="panel-body">
       

<form method="post" action="bloqueadosc.php" class="clearfix">
	
<div class="form-group">
		
		<div class="col-md-9">
			<div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control" name="cliente" id="cliente" placeholder="Nombre de Cliente (Razon Social)" onkeyup="mayus(this);">
            </div>
	
	</div>
	<div class="col-md-3">
	<button type="submit" name="add_cliente" id="add_cliente" class="btn btn-primary btn-block" >Ingresar Cliente</button>
	</div></div>
	
	</form>
        </div>
      </div> 
			<span class="pull-left">

	<strong><h5><i class="glyphicon glyphicon-time">  Última Actualización</i> <?php echo $ultima_fecha["ultima_fecha"];?>
	</h5></strong>
				</span>
			<span class="pull-right">
				<!--<input class="form-control" id="myInput" type="text" placeholder="Buscar..." autofocus></span>
			-->
			</div>
    <!--</div>-->
	 
			
			
			
			
			
			
			
			
			
			
			
			
			
			
        </div>
        <div class="panel-body">
			
			
			
			<div id="panel">
				
				 <div class="row" id="myDIV">
				  
				
					<!--<div class="col-md-3" id="muestradiv">
					<label class="btn btn-success glyphicon glyphicon-plus-sign" id="muestra"> Generar Alta De Contacto</label>
					 
					 </div>-->
					<div class="col-md-5"><!--principio de formulario bloqueados-->
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
                      <center><span class="glyphicon glyphicon-folder-open" style="font-size:35px; color:gray;" ></span>
            <span><br> Cartera </span></center>
			  
          </strong>
        </div>
        <div class="panel-body">
       
        <?php foreach ($recent_sales as  $recent_sale): ?>
       
<h4 >
	
	
	 		   
	<?php echo $recent_sale['nombre'];?> <label class=" glyphicon glyphicon-ban-circle pull-right" data-toggle="modal" data-target="#<?php echo remove_junk($recent_sale['id']);?>" title="Bloquear"  style="font-size:20px;"></label>
	

				  <div class="modal fullscreen-modal fade" id="<?php echo remove_junk($recent_sale['id']);?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
   
		<div class="modal-content">
      <div class="modal-header">
        
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"><strong><center>Bloquear <?php echo remove_junk($recent_sale['nombre']);?></center>
			 
			</strong></h4>
      </div><div class="modal-body">
		<h3>
			
		
		
		<form method="post" action="bloqueadosc.php">
  			
			
	<div class="col-md-12">			
  <div class="form-group"><br>
	  <input type="hidden" value="<?php echo $recent_sale['id'];?>" name="id_bloqueo">
    <label for="exampleFormControlTextarea1">Notas <sub>(Opcionales)</sub></label>
    <textarea class="form-control" name="notas" rows="3"></textarea>
  </div></div>
			
			<button type="submit" name="bloqueo_notas" class="btn btn-success btn-block"><i class="glyphicon glyphicon-send"></i>     Bloquear      </button>
</form>
		
		
		
		
		</h3></div>
		
			
			
		  
      <div class="modal-footer">
        <button type="button" class="btn btn btn-danger" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div></div><!--bloquedos formulario fin-->
	<hr></h4>
	
       <?php endforeach; ?>
       </tbody>
     </table>
    </div>
   </div>
  </div><!--fin de contactos-->
				
				
			
			<div class="col-md-7"><!--principio de citas-->
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <center><span class="glyphicon glyphicon-remove" style="font-size:35px; color:red;" ></span>
            <span><br> Bloqueados </span></center>
        </strong>
      </div>
      <div class="panel-body" id="bloqueados">

        <div class="list-group">
			
      <?php foreach ($recent_products as  $recent_product): ?>
          
		<div class="col-md-6"><h4 title="Motivo: <?php echo remove_junk(first_character($recent_product['notas']));?>" data-toggle="tooltip"><?php echo    $recent_product['nombre'];?>
			</div>
			<form method="post" action="bloqueadosc.php">
				 <input type="hidden" value="<?php echo $recent_product['id'];?>" name="id_bloqueo">
								
				<button type="submit" name="desbloqueo" class="btn btn-warning pull-right"  title="Desbloquear" data-toggle="tooltip" ><i class="glyphicon glyphicon-minus-sign" ></i></button>
				</form>
			
			<br><br><hr></h4><br>
			
      <?php endforeach; ?>
    </div>
  </div>
 </div>
</div>
 </div>
  
				
				
				
				
				
				
				</div></div>
	 
	  <script>
	 
	 $(document).ready(function() {
     $('#add_cliente').prop('disabled', true);
     $('#cliente').keyup(function() {
        if($(this).val() != '') {
           $('#add_cliente').prop('disabled', false);
        }
     });
 });
		 
	/*$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myDIV *").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});	 */
	 </script>
	
<?php include_once('layouts/footer.php'); ?>
