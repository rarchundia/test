<?php
  $page_title = 'Lista de Usuarios';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_categories = find_all('responsable');
  $empresa = find_all('categories');
   $busca_empresa = buscaempresa();
$cat;
?>
<?php
 if(isset($_POST['agregar_usuario'])){
      
   $req_field = array( 'ape_pat', 'ape_mat', 'product-categorie');
   
   
 
   validate_fields($req_fields);
   if(empty($errors)){
     $p_nombre= remove_junk($db->escape($_POST['nombre']));
	 $p_paterno = remove_junk($db->escape($_POST['ape_pat']));
     $p_materno   = remove_junk($db->escape($_POST['ape_mat']));
     $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
   
   
     $query  = "INSERT INTO responsable (";
     $query .=" nombre,ape_pat,ape_mat,id_empresa";
     $query .=") VALUES (";
     $query .=" '{$p_nombre}', '{$p_paterno}', '{$p_materno}', '{$p_cat}'";
     $query .=");";
	  
	 
	//   $query ="INSERT INTO media (file_name, file_type, id_empresa) VALUES ('','','{$p_cat}')";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_serie}'";
     if($db->query($query)){
       $session->msg('s',"Usuario Agregado Exitosamente. ");
       redirect('add_usuario.php', false);
     } else {
       $session->msg('d',' Lo siento, Falló al Agregar el Usuario Intenta Otra Vez.');
       redirect('add_usuario.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_usuario.php',false);
   }
   
   
   
 }
?>
<?php include_once('layouts/header.php'); ?>

  <div class="row">
     <div class="col-md-12">
     
             
         </div>
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar Usuario</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="add_usuario.php">
            <div class="form-group">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre(s)" required autofocus onkeyup="mayus(this);">
            </div>
            
            
            <div class="form-group">
                <input type="text" class="form-control" name="ape_pat" placeholder="Apellido Paterno" required  onkeyup="mayus(this);">
            </div>
            
            <div class="form-group">
                <input type="text" class="form-control" name="ape_mat" placeholder="Apellido Materno" required  onkeyup="mayus(this);">
            </div>
            
                
                  <div class="col-md-6">
                    <select class="form-control" name="product-categorie" required>
                      <option value="">Pertenece a:</option>
                    <?php  foreach ($empresa as $emp): ?>
                      <option value="<?php echo (int)$emp['id'] ?>">
                        <?php echo $emp['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
            
            <button type="submit" name="agregar_usuario" class="btn btn-primary">Agregar Usuario</button>
        </form>
        
        
        
        
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de Usuarios Dados de Alta</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Usuario</th>
                    <th class="text-center">Empresa</th>
                    <th class="text-center" style="width: 100px;">Editar / Eliminar</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_categories as $cat):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($cat['nombre']));  //imprime nombre
					 echo " ";
					 echo remove_junk(ucfirst($cat['ape_pat'])); //imprime apellido pat
					 echo " ";
					 echo remove_junk(ucfirst($cat['ape_mat'])); //imprime apellido mat ?></td>
                    
                    
                    <td><?php 
					foreach ($busca_empresa as $busca):
					
					if($cat['id_empresa'] == $busca['id']){ 
                    
					 echo remove_junk($busca['name']);} 
					 endforeach;
                    ?>
                    
                    </td>
                    
                    
                    
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_usuario.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="eliminar_user.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
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
  <?php include_once('layouts/footer.php'); ?>
