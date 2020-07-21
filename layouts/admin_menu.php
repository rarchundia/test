<?php 
$bloqueados=contador_bloqueados("clientes");
$contador=contador_documentos("contacto");


?>

<!-- menus ejemplo nuevo
<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Page 1-1</a></li>
            <li><a href="#">Page 1-2</a></li>
            <li><a href="#">Page 1-3</a></li>
          </ul>
        </li>
        
		  <li><a href="#">Page 2</a></li>-->



<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Envipaq <span class="caret"></span></a>
          <ul class="dropdown-menu">
			  <li><a href="directorio.php"><i class="glyphicon glyphicon-phone-alt"></i> Extensiones Envipaq</a></li>
            <li><a href="organigrama.php"><i class="glyphicon glyphicon-object-align-vertical"></i> Organigrama Envipaq</a></li>
            <li><a href="guia.php"><i class="glyphicon glyphicon-file"></i> Guia Envipaq</a></li>
			  <li><a href="tickets.php"><i class="glyphicon glyphicon-bookmark"></i> Tickets</a></li>
			  <li><a href="guia_reporte.php"><i class="glyphicon glyphicon-duplicate"></i> Guia Facturar</a></li>
			   <li><a href="memo.php"><i class="glyphicon glyphicon-file"></i> Memo</a></li>
			  <li><a href="valida.php"><i class="glyphicon glyphicon-paperclip"></i><span> Valida Documento<sup style="color: white; width: 100px;
     height: 100px;
     -moz-border-radius: 50%;
     -webkit-border-radius: 50%;
     border-radius: 50%;
     background: red; font-size: 15px;" ><?php  echo $contador["contador_documentos"];?></sup></span></a></li>
			  
          </ul>
        </li>


<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Usuarios <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="add_user.php"><i class="glyphicon glyphicon-user"></i> Agregar Usuario</a></li>
            <li><a href="users.php"><i class="glyphicon glyphicon-user"></i> Administrar Usuarios</a></li>
            <li><a href="group.php"><i class="glyphicon glyphicon-user"></i> Administrar Grupos</a></li>
          </ul>
        </li>

<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Bloqueados<sup style="color: white; width: 100px;
     height: 100px;
     -moz-border-radius: 50%;
     -webkit-border-radius: 50%;
     border-radius: 50%;
     background: red; font-size: 15px;" ><?php  echo $bloqueados["contador_bloqueados"];?></sup><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="bloqueados.php"><i class="glyphicon glyphicon-ban-circle"></i> Bloqueados</a></li>
            <li><a href="bloqueadosc.php"><i class="glyphicon glyphicon-ban-circle"></i> Bloqueados Calidad</a></li>
            
          </ul>
        </li>

<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Odometro <span class="caret"></span></a>
          <ul class="dropdown-menu">
			  <li><a href="odometro.php"><i class="glyphicon glyphicon-dashboard"></i> Odometro</a></li>
            <li><a href="odometrofecha.php"><i class="glyphicon glyphicon-road"></i> Odometro por Fecha</a></li>
            
          </ul>
        </li>

<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Pipedrive <span class="caret"></span></a>
          <ul class="dropdown-menu">
			  <li><a href="pipedrive.php"><i class="glyphicon glyphicon-folder-open"></i>  Pipedrive</a></li>
            <li><a href="master_pipedrive.php"><i class="glyphicon glyphicon-signal"></i> Gráficas</a></li>
            <li><a href="calendario.php"><i class="glyphicon glyphicon-calendar"></i> Calendario</a></li>
         <li><a href="logistica_cot.php" ><i class="glyphicon glyphicon-usd"></i> Cotizaciones</a>
    </ul>
        </li>


 <li><a href="archivos.php" ><i class="glyphicon glyphicon-cloud"></i> Nube</a></li>
<li><a href="correos.php" ><i class="glyphicon glyphicon-envelope"></i> Correos</a></li>
</li>

<!--<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Incidencias <span class="caret"></span></a>
          <ul class="dropdown-menu">
			 <li><a href="excel.php"><i class="glyphicon glyphicon-open-file"></i>  Importa Excel</a></li>
			  <li><a href="incidencias.php"><i class="glyphicon glyphicon-edit"></i>  Incidencias Estatus</a></li>
            <li><a href="incidencias_historico.php"><i class="glyphicon glyphicon-header"></i> Historico</a></li>
            
          </ul>
        </li>
-->


