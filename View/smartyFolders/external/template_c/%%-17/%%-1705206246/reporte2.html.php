<?php /* Smarty version 2.6.1, created on 2014-08-14 08:13:20
         compiled from reporte2.html */ ?>
<div>

	<legend><?php echo $this->_tpl_vars['Titulo']; ?>
</legend>

	<div class="parteForm" id="formReporte2">

	    <div>
	    
	        <div class="input-control text size3" data-role="input-control">
		        <input type="text" id="txtNoComprobanteRp2" placeholder="No Comprobante">
		        <button class="btn-clear" tabindex="-1"></button>
	        </div>
	    
	        <p>Fecha Inicio</p>
			<div class="input-control text size2" id="calendarInicioRp2">
				<input type="text" id="dateInicioRp2">
				<button class="btn-date" type="button"></button>
			</div>
			<br>
			<p>Fecha Final</p>
			<div class="input-control text size2" id="calendarFinRp2">
				<input type="text" id="dateFinRp2">
				<button class="btn-date" type="button"></button>
			</div>
	    </div>

	     <button class="button" id="btnReportPdf2" type="button">Generar PDF!</button>
	     <button class="button" id="btnReportExcel2" type="button">Generar Excel!</button>
	     	 
    </div>

    <!-- Parte Lista Roles-->
    <div class="parteList listview" id="Lista-reporte">
   
    </div>
    