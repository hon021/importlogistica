<?php /* Smarty version 2.6.1, created on 2014-10-30 10:54:14
         compiled from reporteContenedor2.html */ ?>
<div>

	<legend><?php echo $this->_tpl_vars['Titulo']; ?>
</legend>

	<div class="parteForm" id="formReporte5">

	    <div>
	    
	        <div class="input-control text size3" data-role="input-control">
	        	<input type="text" id="txtCodContRp5" placeholder="Contenedor">
		        <button class="btn-clear" tabindex="-1"></button>
	        </div>
	    
	        <p>Fecha Inicio</p>
			<div class="input-control text size2" id="calendarInicioRp5">
				<input type="text" id="dateInicioRp5">
				<button class="btn-date" type="button"></button>
			</div>
			<br>
			<p>Fecha Final</p>
			<div class="input-control text size2" id="calendarFinRp5">
				<input type="text" id="dateFinRp5">
				<button class="btn-date" type="button"></button>
			</div>
	    </div>

	     <button class="button" id="btnReportPdf5" type="button">Generar PDF!</button>
	     <button class="button" id="btnReportExcel5" type="button">Generar Excel!</button>
	     	 
    </div>

    <!-- Parte Lista Roles-->
    <div class="parteList listview" id="Lista-reporte">
   
    </div>
    