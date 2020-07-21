
<?php 
$bloqueados=contador_bloqueados("clientes");


?>


<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Envipaq <span class="caret"></span></a>
          <ul class="dropdown-menu">
			  <li><a href="directorio.php"><i class="glyphicon glyphicon-phone-alt"></i> Extensiones Envipaq</a></li>
            <li><a href="organigrama.php"><i class="glyphicon glyphicon-object-align-vertical"></i> Organigrama Envipaq</a></li>
            <li><a href="guia.php"><i class="glyphicon glyphicon-file"></i> Guia Envipaq</a></li>
			  
          </ul>
        </li>







<li><a href="bloqueados.php">Bloqueados<sup style="color: white; width: 100px;
     height: 100px;
     -moz-border-radius: 50%;
     -webkit-border-radius: 50%;
     border-radius: 50%;
     background: red; font-size: 15px;" ><?php  echo $bloqueados["contador_bloqueados"];?></sup></a></li>

<!--<li><a href="pipedrive.php"><i class="glyphicon glyphicon-folder-open"></i>  Pipedrive</a></li> -->  
<!--<li><a href="calendario_v.php"><i class="glyphicon glyphicon-calendar"></i>Calendario test</a></li>-->
 <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Pipedrive <span class="caret"></span></a>
          <ul class="dropdown-menu">
			  <li><a href="pipedrive.php"><i class="glyphicon glyphicon-folder-open"></i>  Pipedrive</a></li>
            <li><a href="calendario_v.php"><i class="glyphicon glyphicon-calendar"></i>Calendario</a></li>
             <li><a href="logistica_cot.php" ><i class="glyphicon glyphicon-usd"></i> Cotizaciones</a>
          </ul>
        </li>       
         


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
      <a href="guia.php" >
      <i class="glyphicon glyphicon-calendar"></i>
      <span>Pedimentos</span>
    </a>
  </li>
  
	<li>
    <a href="pipedrive.php" >
		
      <i class="glyphicon glyphicon-folder-open"></i>
      <span>Pipedrive</span>
    </a>
  </li>
	
	<li>
    <a href="bloqueados.php">
		<i class="glyphicon glyphicon-ban-circle"></i>
		Clientes Bloqueados<sup style="color: white; width: 100px;
     height: 100px;
     -moz-border-radius: 50%;
     -webkit-border-radius: 50%;
     border-radius: 50%;
     background: red; font-size: 15px;" ><?php  echo $bloqueados["contador_bloqueados"];?></sup>
		</a>
	</li>
    
 <li>
    <a href="archivos.php" >
      <i class="glyphicon glyphicon-cloud"></i>
      <span>Nube</span>
    </a>
  </li>
	
	<li>
    <a href="manual_ventas.php" >
      <i class="glyphicon glyphicon-book"></i>
      <span>Manual Sistema</span>
    </a>
  </li>
	
	
   </ul>
  </li>
  
</ul>-->