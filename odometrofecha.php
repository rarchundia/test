<?php
$page_title = 'Odometro por Fecha';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(4);
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">

      </div>
      <div class="panel-body">
          <form class="clearfix" method="post" action="odometro_fecha.php">
            <div class="form-group">
              <label class="form-label">Selecciona Fecha y Ruta</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="fecha" id="fecha"  autocomplete="off" placeholder="Selecciona Fecha" required>
                  <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
                  
                     
                       <select class="form-control" name="asiga_operador" required>
                      <option value="">PLACAS</option>
                      
                    <option value="592XLA">592XLA</option>
                    <option value="J46AHW">J46AHW</option>
                    <option value="662YXR">662YXR</option>
                    <option value="640XCK">640XCK</option>
						    <option value="NRT2223">NRT2223</option>
					  <option value="NRT2010">NRT2010</option>
                    </select>
</div>
            </div>
            <div class="form-group">
                 <button type="submit" name="odometrofecha" class="btn btn-primary btn-block">Generar Reporte</button>
            </div>
          </form>
		  
		  
		  
		  
		  <br><br><br>
		  <form class="clearfix" method="post" action="rango_fecha.php">
            <div class="form-group">
              <label class="form-label">Selecciona Rango de Fecha y Ruta</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="fecha" id="fecha"  autocomplete="off" placeholder="Selecciona Primera Fecha" required>
                  <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
                  
                     <input type="text" class="form-control" name="fecha2" id="fecha2"  autocomplete="off" placeholder="Selecciona Segunda Fecha" required>
					
					
					</div>
					
                       <select class="form-control" name="asiga_operador" required>
                       <option value="">PLACAS</option>
                      
                    <option value="592XLA">592XLA</option>
                    <option value="J46AHW">J46AHW</option>
                    <option value="662YXR">662YXR</option>
                    <option value="640XCK">640XCK</option>
						    <option value="NRT2223">NRT2223</option>
					  <option value="NRT2010">NRT2010</option>
                    </select>

            </div><br>
            <div class="form-group">
                 <button type="submit" name="odometrofecha" class="btn btn-primary btn-block">Generar Reporte</button>
            </div>
          </form>
      </div>

    </div>
  </div>

</div>

<script>
  $('#fecha2, #fecha').datepicker({
    format: "yyyy-mm-dd",
    clearBtn: true,
    language: "es",
    daysOfWeekDisabled: "0,6",
    daysOfWeekHighlighted: "0,6",
    autoclose: true,
    todayHighlight: true,
    datesDisabled: ['2019-09-21'],
    toggleActive: true
  
	
});
  
	  
	 
  
	  
	  
  
  
  
  </script>


<?php include_once('layouts/footer.php'); ?>
