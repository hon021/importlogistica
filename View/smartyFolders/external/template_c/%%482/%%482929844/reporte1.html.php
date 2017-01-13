<?php /* Smarty version 2.6.1, created on 2014-08-14 08:12:44
         compiled from reporte1.html */ ?>
<div>

	<legend><?php echo $this->_tpl_vars['Titulo']; ?>
</legend>

	<div class="parteForm" id="formReporte">

	    <div>
	        <p>Fecha Inicio</p>
			<div class="input-control text size2" id="calendarInicio">
				<input type="text" id="dateInicio">
				<button class="btn-date" type="button"></button>
			</div>
			<br>
			<p>Fecha Final</p>
			<div class="input-control text size2" id="calendarFin">
				<input type="text" id="dateFin">
				<button class="btn-date" type="button"></button>
			</div>
	    </div>

	     <button class="button" id="btnReportPdf1" type="button">Generar PDF!</button>
	     <button class="button" id="btnReportExcel1" type="button">Generar Excel!</button>
	     	 
    </div>

    <!-- Parte Lista Roles-->
    <div class="parteList listview" id="Lista-reporte">
   
    </div>
    