<?php /* Smarty version 2.6.1, created on 2014-08-11 14:15:40
         compiled from envio.html */ ?>
<div>
	<legend><?php echo $this->_tpl_vars['Titulo']; ?>
</legend>

	<div class="parteForm" id="formEnvio">

        
		<div class="input-control select">
			<select id = "cmbMercancia_Envio"  onchange="OnLoseFocus_Envio(this.value)">
					<?php if (count($_from = (array)$this->_tpl_vars['array_NombreMercancia'])):
    foreach ($_from as $this->_tpl_vars['dataid'] => $this->_tpl_vars['data']):
?>
					<?php if ($this->_tpl_vars['dataid'] == 0): ?>    
						<option value="0" selected="selected">No Comprobante Mercancia</option>	
					<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['arrayIdMercancia'][$this->_tpl_vars['dataid']]; ?>
"><?php echo $this->_tpl_vars['data']; ?>
</option>
					<?php endif; ?>
				<?php endforeach; unset($_from); endif; ?>
			</select>
		</div>
		
		<!--  
		<div class="input-control select">
			<select id = "cmbContenedor_Envio">
				<?php if (count($_from = (array)$this->_tpl_vars['array_DescripcionCont'])):
    foreach ($_from as $this->_tpl_vars['dataid'] => $this->_tpl_vars['data']):
?>
					<?php if ($this->_tpl_vars['dataid'] == 0): ?>    
						<option value="0">Nro Contenedor</option>
					<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['array_IdCont'][$this->_tpl_vars['dataid']]; ?>
"><?php echo $this->_tpl_vars['data']; ?>
</option>
					<?php endif; ?>
				<?php endforeach; unset($_from); endif; ?>
			</select>
		</div>
		-->
		
		
		<div class="input-control select">
			<select id = "cmbContenedor_Envio">
			    <option value="0">Nro Contenedor</option>
				<?php if (count($_from = (array)$this->_tpl_vars['array_DescripcionCont'])):
    foreach ($_from as $this->_tpl_vars['dataid'] => $this->_tpl_vars['data']):
?>
					<option value="<?php echo $this->_tpl_vars['array_IdCont'][$this->_tpl_vars['dataid']]; ?>
"><?php echo $this->_tpl_vars['data']; ?>
</option>	
				<?php endforeach; unset($_from); endif; ?>
			</select>
		</div>
		
		
		
		<p>Fecha Envio (Año-Mes-Día)</p>
		<div class="input-control text size2" id="calendarFechaEnvio">
			<input type="text" id="dateEnvio">
			<button class="btn-date" type="button"></button>
		</div>
		
		<br>
		
		<div class="input-control text size3" data-role="input-control">
	        <input type="text" id="txtNro_Cajas_Envios" placeholder="Nro Cajas">
	        <button class="btn-clear" tabindex="-1"></button>
	    </div>	
	    
        <br>
         
	    <button class="button" id="btnNewEnvio"  type="button">Nuevo!</button>
	    <button class="button" id="btnSaveEnvio" type="button">Registrar!</button>
	    <button class="button" id="btnUpdEnvio"  type="button">Actualizar!</button>
	    <button class="button" id="btnDelEnvio"  type="button">Inactivar!</button> 	 
    </div>
    
     <!-- Parte Lista Envio-->
    <div class="parteList listview" id="Lista-envio">
   
    </div>
    
</div>
