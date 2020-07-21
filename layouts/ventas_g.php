<?php 
$bloqueados=contador_bloqueados("clientes");


?>

<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Envipaq <span class="caret"></span></a>
          <ul class="dropdown-menu">
			  <li><a href="directorio.php"><i class="glyphicon glyphicon-phone-alt"></i> Extensiones Envipaq</a></li>
            <li><a href="organigrama.php"><i class="glyphicon glyphicon-object-align-vertical"></i> Organigrama Envipaq</a></li>
            <li><a href="guia.php"><i class="glyphicon glyphicon-file"></i> Guia Envipaq</a></li>
			  <li><a href="valida_historico.php"><i class="glyphicon glyphicon-file"></i> Documentación</a></li>
          </ul>
        </li>








<li><a href="bloqueados.php">Bloqueados<sup style="color: white; width: 100px;
     height: 100px;
     -moz-border-radius: 50%;
     -webkit-border-radius: 50%;
     border-radius: 50%;
     background: red; font-size: 15px;" ><?php  echo $bloqueados["contador_bloqueados"];?></sup></a></li>

<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Pipedrive <span class="caret"></span></a>
          <ul class="dropdown-menu">
			  <li><a href="pipedrive.php"><i class="glyphicon glyphicon-folder-open"></i>  Pipedrive</a></li>
            <li><a href="master_pipedrive.php"><i class="glyphicon glyphicon-signal"></i> Gráficas</a></li>
            <li><a href="calendario.php"><i class="glyphicon glyphicon-calendar"></i> Calendario</a></li>
          </ul>
        </li>        


 <li><a href="archivos.php" ><i class="glyphicon glyphicon-cloud"></i> Nube</a></li>
<li><a href="tickets.php" ><i class="glyphicon glyphicon-tag"></i> Tickets</a></li>
<li><a href="memo.php" ><i class="glyphicon glyphicon-file"></i> Memo</a></li>