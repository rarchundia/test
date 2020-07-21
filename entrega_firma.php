<?php
  $page_title = 'Entrega Firma';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
  
?>
<?php 

if(isset($_POST['entrega'])){
 

 $p_id_entrega= $_POST['id_entrega'];
 $p_correo= $_POST['correo'];
 $p_id_ruta= $_POST['id_ruta'];
 $p_estatus =1;
	  
	 $date    = make_date();
	 $sql="UPDATE entrega SET estatus='{$p_estatus}', fecha_entrega='{$date}' WHERE id='{$p_id_entrega}'";
     		   
     if($db->query($sql)){
     //$session->msg('s',"Recolección Agregada Exitosamente  . ");
		
      // redirect('recoleccion.php', false);
   }
	    else {
       //$session->msg('d',' Lo siento, Falló al Agregar el Equipo Intenta Otra Vez.');
       //redirect('recoleccion.php', false);
	   }

  

 }
 
 

?>

<?php 
//include_once('layouts/header.php');

 ?>
<meta name="viewport" content="initial-scale=1, width=device-width">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />



  <div class="row">
    
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">

	
	
	
	
	<form action="../uploads/products/signature.php" method="post">
					
						<input name="quien_recibe" type="text" placeholder="    Quien Recibe el Paquete " style="width: 100%; height: 40px" onkeyup="mayus(this);" value="" required>
		<br><br>
						<input name="id_entrega" type="hidden" value="<?php echo $p_id_entrega; ?>">
						<input name="correo" type="hidden" value="<?php echo $p_correo; ?>">
						<input name="id_ruta" type="hidden" value="<?php echo $p_id_ruta; ?>">
						
						<button type="submit" name="entrega" class="btn btn-success btn-block" >Firma</button>
						
					</form>
	
	
	
	
	
        </div>
        
</div></div>
  <?php include_once('layouts/footer.php'); ?>
