<?php

$contador=contador_documentos("contacto");
$bloqueados=contador_bloqueados("clientes");


?>



<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Envipaq <span class="caret"></span></a>
          <ul class="dropdown-menu">
			  <li><a href="directorio.php"><i class="glyphicon glyphicon-phone-alt"></i> Extensiones Envipaq</a></li>
            <li><a href="organigrama.php"><i class="glyphicon glyphicon-object-align-vertical"></i> Organigrama Envipaq</a></li>
            <li><a href="guia.php"><i class="glyphicon glyphicon-file"></i> Guia Envipaq</a></li>
			 <li><a href="guia_reporte.php"><i class="glyphicon glyphicon-duplicate"></i> Guia Facturar</a></li>
			  <li><a href="valida.php"><i class="glyphicon glyphicon-paperclip"></i><span> Valida Documento<sup style="color: white; width: 100px;
     height: 100px;
     -moz-border-radius: 50%;
     -webkit-border-radius: 50%;
     border-radius: 50%;
     background: red; font-size: 15px;" ><?php  echo $contador["contador_documentos"];?></sup></span></a></li>
			  
          </ul>
        </li>






<!--<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Incidencias <span class="caret"></span></a>
          <ul class="dropdown-menu">
			 <li><a href="excel.php"><i class="glyphicon glyphicon-open-file"></i>  Importa Excel</a></li>
			  <li><a href="incidencias.php"><i class="glyphicon glyphicon-edit"></i>  Incidencias Estatus</a></li>
            <li><a href="incidencias_historico.php"><i class="glyphicon glyphicon-header"></i> Historico</a></li>
            
          </ul>
        </li>-->

<li><a href="bloqueadosc.php">Bloqueados<sup style="color: white; width: 100px;
     height: 100px;
     -moz-border-radius: 50%;
     -webkit-border-radius: 50%;
     border-radius: 50%;
     background: red; font-size: 15px;" ><?php  echo $bloqueados["contador_bloqueados"];?></sup></a></li>

         
         


 <li><a href="archivos.php" ><i class="glyphicon glyphicon-cloud"></i> Nube</a></li>
<li><a href="correos.php" ><i class="glyphicon glyphicon-envelope"></i> Correos</a></li>
<li><a href="memo.php" ><i class="glyphicon glyphicon-file"></i> Memo</a></li>
