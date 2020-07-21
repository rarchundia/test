<?php 
$bloqueados=contador_bloqueados("clientes");

$usuario_id=$user['id'];
?>






<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Envipaq <span class="caret"></span></a>
          <ul class="dropdown-menu">
			  <li><a href="directorio.php"><i class="glyphicon glyphicon-phone-alt"></i> Extensiones Envipaq</a></li>
            <li><a href="organigrama.php"><i class="glyphicon glyphicon-object-align-vertical"></i> Organigrama Envipaq</a></li>
            
			  
          </ul>
        </li>


<li><a href="guia.php"><i class="glyphicon glyphicon-file"></i> Guia Envipaq</a></li>
<li><a href="tickets.php"><i class="glyphicon glyphicon-bookmark"></i>Tickets</a></li>

<?php
			
			if($usuario_id=="59" OR $usuario_id=="22"){ ?>
	
<li><a href="guia_historico.php"><i class="glyphicon glyphicon-folder-open"></i>  Historico de guias</a></li>

			<?php
}
			
			?>
<!--<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Incidencias <span class="caret"></span></a>
          <ul class="dropdown-menu">
			 <li><a href="excel.php"><i class="glyphicon glyphicon-open-file"></i>  Importa Excel</a></li>
			  <li><a href="incidencias.php"><i class="glyphicon glyphicon-edit"></i>  Incidencias Estatus</a></li>
            <li><a href="incidencias_historico.php"><i class="glyphicon glyphicon-header"></i> Historico</a></li>
            
          </ul>
        </li>-->

<li><a href="bloqueados.php">Bloqueados<sup style="color: white; width: 100px;
     height: 100px;
     -moz-border-radius: 50%;
     -webkit-border-radius: 50%;
     border-radius: 50%;
     background: red; font-size: 15px;" ><?php  echo $bloqueados["contador_bloqueados"];?></sup></a></li>

<li><a href="pipedrive.php"><i class="glyphicon glyphicon-folder-open"></i>  Pipedrive</a></li>
           
         


 <li><a href="archivos.php" ><i class="glyphicon glyphicon-cloud"></i> Nube</a></li>
<li><a href="memo1.php" ><i class="glyphicon glyphicon-file"></i> Memo</a></li>





<!--<ul>
  <li>
    <a href="admin.php">
      <i class="glyphicon glyphicon-home"></i>
      <span>Panel de Control</span>
    </a>
  </li>
		<li>
    <a href="directorio.php">
      <i class="glyphicon glyphicon-phone-alt"></i>
      <span>Extensiones Envipaq</span>
    </a>
  </li>
		<li>
    <a href="organigrama.php">
      <i class="glyphicon glyphicon-object-align-vertical"></i>
      <span>Organigrama Envipaq</span>
    </a>
  </li>
	
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-map-marker"></i>
      <span>Estatus</span>
    </a>
    <ul class="nav submenu">
      <li><a href="consulta.php">Estatus Recolecciones</a> </li>
      <li><a href="consulta_entrega.php">Estatus Entregas</a> </li>
   </ul>
  </li>
   
    <li>
    <a href="recoleccion.php" >
      <i class="glyphicon glyphicon-calendar"></i>
      <span>Programar Recolección</span>
    </a>
  </li>
	 <li>
    <a href="bloqueados.php" >
      <i class="glyphicon glyphicon-ban-circle"></i>
      <span>Bloqueados<sup style="color: white; width: 100px;
     height: 100px;
     -moz-border-radius: 50%;
     -webkit-border-radius: 50%;
     border-radius: 50%;
     background: red; font-size: 15px;" ><?php  echo $bloqueados["contador_bloqueados"];?></sup></span>
    </a>
  </li>
  <li>      
      <a href="guia.php" >
      <i class="glyphicon glyphicon-qrcode"></i>
      <span>Guias Envipaq</span>
    </a>
  </li>
  
	<li>
    <a href="archivos.php" >
      <i class="glyphicon glyphicon-cloud"></i>
      <span>Nube</span>
    </a>
  </li>
	
	<li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
      <span>Incidencias</span>
    </a>
    <ul class="nav submenu">
      <li><a href="incidencias.php">Incidencias Estatus</a> </li>
      <li><a href="excel.php">Importa Excel</a> </li>
		<li><a href="incidencias_historico.php">Historico</a> </li>
		
   </ul>
  </li>
  
</ul>-->