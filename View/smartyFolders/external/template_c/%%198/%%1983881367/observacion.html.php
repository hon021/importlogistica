<?php /* Smarty version 2.6.1, created on 2014-10-30 16:47:16
         compiled from observacion.html */ ?>
<div>
	<legend><?php echo $this->_tpl_vars['Titulo']; ?>
</legend>

	<div class="parteForm" id="formObservacion">

       <!--Selecccion de Mercancia -->
       <!--  
       <div class="input-control select">
			<select id = "cmbObservMercancia">
				<?php if (count($_from = (array)$this->_tpl_vars['array_NroComprobante'])):
    foreach ($_from as $this->_tpl_vars['dataid'] => $this->_tpl_vars['data']):
?>
					<?php if ($this->_tpl_vars['dataid'] == 0): ?>    
						<option value="0">Seleccione No Comprobante</option>
					<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['array_IdMercancia'][$this->_tpl_vars['dataid']]; ?>
"><?php echo $this->_tpl_vars['data']; ?>
</option>
					<?php endif; ?>
				<?php endforeach; unset($_from); endif; ?>
			</select>
		</div>
		 -->
		 
		<!--Selecccion de Envio --> 
       <div class="input-control select">
			<select id = "cmbObservEnvio">
				<?php if (count($_from = (array)$this->_tpl_vars['array_Descripcion'])):
    foreach ($_from as $this->_tpl_vars['dataid'] => $this->_tpl_vars['data']):
?>
					<?php if ($this->_tpl_vars['dataid'] == 0): ?>    
						<option value="0">Seleccione Fecha Envio</option>
					<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['array_IdEnvio'][$this->_tpl_vars['dataid']]; ?>
"><?php echo $this->_tpl_vars['data']; ?>
</option>
					<?php endif; ?>
				<?php endforeach; unset($_from); endif; ?>
			</select>
		</div>
		
		<!--Selecccion de Localizacion -->
       <div class="input-control select">
			<select id = "cmbObservLocali">
				<?php if (count($_from = (array)$this->_tpl_vars['array_NombreLocali'])):
    foreach ($_from as $this->_tpl_vars['dataid'] => $this->_tpl_vars['data']):
?>
					<?php if ($this->_tpl_vars['dataid'] == 0): ?>    
						<option value="0">Seleccione Localizacion</option>
					<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['array_IdLocali'][$this->_tpl_vars['dataid']]; ?>
"><?php echo $this->_tpl_vars['data']; ?>
</option>
					<?php endif; ?>
				<?php endforeach; unset($_from); endif; ?>
			</select>
		</div>
		

	    <p>Fecha Ingreso (Año-Mes-Día)</p>
		<div class="input-control text size2" id="calendarFechaObservacion">
			<input type="text" id="dateObservacion">
			<button class="btn-date" type="button"></button>
		</div>
		
		<br>
		
		<div class="input-control textarea">
	        <textarea id="txtObservacion" placeholder = "Observaciones"></textarea>
	    </div>
		
	    <button class="button" id="btnNewObservacion"  type="button">Nuevo!</button>
	    <button class="button" id="btnSaveObservacion" type="button">Registrar!</button>
	    <?php if ($this->_tpl_vars['IdRol'] != 3): ?>
		    <button class="button" id="btnUpdObservacion"  type="button">Actualizar!</button>
		    <button class="button" id="btnDelObservacion"  type="button">Inactivar!</button>
	    <?php endif; ?> 	 
    </div>
    
     <!-- Parte Lista Observacion-->
    <div class="parteList listview" id="Lista-observacion">
   
    </div>
    
</div>
