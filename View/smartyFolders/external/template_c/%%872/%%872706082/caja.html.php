<?php /* Smarty version 2.6.1, created on 2014-08-11 00:03:49
         compiled from caja.html */ ?>
<div>
	<legend><?php echo $this->_tpl_vars['Titulo']; ?>
</legend>

	<div class="parteForm" id="formCaja">

		<div class="input-control select">
			<select id = "cmbMercancia"  onchange="OnLoseFocus(this.value)">
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
		
		<div class="input-control select">
			<select id = "cmbEstadoCaja">
				<?php if (count($_from = (array)$this->_tpl_vars['arrayDescripcionEstadoCaja'])):
    foreach ($_from as $this->_tpl_vars['dataid'] => $this->_tpl_vars['data']):
?>
					<?php if ($this->_tpl_vars['dataid'] == 0): ?>    
						<option value="0" selected="selected">Seleccione el Estado Caja</option>	
					<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['arrayIdEstadoCaja'][$this->_tpl_vars['dataid']]; ?>
"><?php echo $this->_tpl_vars['data']; ?>
</option>
					<?php endif; ?>
				<?php endforeach; unset($_from); endif; ?>
			</select>
		</div>
		
		
		<div class="input-control text size3" data-role="input-control">
	        <input type="text" id="txtCodigoBarra" placeholder="Codigo de Barras">
	        <button class="btn-clear" tabindex="-1"></button>
	    </div>	
	    
        <br>
         
	    <button class="button" id="btnNewCaja"  type="button">Nuevo!</button>
	    <button class="button" id="btnSaveCaja" type="button">Registrar!</button>
	    <button class="button" id="btnUpdCaja"  type="button">Actualizar!</button>
	    <button class="button" id="btnDelCaja"  type="button">Inactivar!</button> 	 
    </div>
    
     <!-- Parte Lista Mercancia-->
    <div class="parteList listview" id="Lista-caja">
   
    </div>
    
</div>
