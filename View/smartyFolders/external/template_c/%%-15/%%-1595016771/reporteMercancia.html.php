<?php /* Smarty version 2.6.1, created on 2014-09-15 08:00:04
         compiled from reporteMercancia.html */ ?>
<div>

	<legend><?php echo $this->_tpl_vars['Titulo']; ?>
</legend>

	<div class="parteForm" id="formReporte3">

	    <div>
	    
	        <div class="input-control text size3" data-role="input-control">
		        <input type="text" id="txtDNIRp3" placeholder="DNI">
		        <button class="btn-clear" tabindex="-1"></button>
	        </div>
	    
	        <p>Fecha Inicio</p>
			<div class="input-control text size2" id="calendarInicioRp3">
				<input type="text" id="dateInicioRp3">
				<button class="btn-date" type="button"></button>
			</div>
			<br>
			<p>Fecha Final</p>
			<div class="input-control text size2" id="calendarFinRp3">
				<input type="text" id="dateFinRp3">
				<button class="btn-date" type="button"></button>
			</div>
	    </div>

	     <button class="button" id="btnReportPdf3" type="button">Generar PDF!</button>
	     <button class="button" id="btnReportExcel3" type="button">Generar Excel!</button>
	     	 
    </div>

    <!-- Parte Lista Roles-->
    <div class="parteList listview" id="Lista-reporte">
   
    </div>
    