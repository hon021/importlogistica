<?php /* Smarty version 2.6.1, created on 2014-08-28 13:57:10
         compiled from mercancia.html */ ?>
<div>
	<legend><?php echo $this->_tpl_vars['Label_Tittle']; ?>
</legend>

	<div class="parteForm" id="formMercancia">

		
			<div class="input-control select">
				<select id = "cmbCliente">
					<?php if (count($_from = (array)$this->_tpl_vars['array_NombreCliente'])):
    foreach ($_from as $this->_tpl_vars['dataid'] => $this->_tpl_vars['data']):
?>
						<?php if ($this->_tpl_vars['dataid'] == 0): ?>    
							<option value="0">Seleccione el Cliente</option>
						<?php else: ?>
							<option value="<?php echo $this->_tpl_vars['array_IdCost'][$this->_tpl_vars['dataid']]; ?>
"><?php echo $this->_tpl_vars['data']; ?>
</option>
						<?php endif; ?>
					<?php endforeach; unset($_from); endif; ?>
				</select>
			</div>
			<div id="ContainerMercancia">
			
			<div class="input-control text size3" data-role="input-control">
		        <input type="text" id="txtComprobante" placeholder="Nro. Comprobante" maxlength="20">
		        <button class="btn-clear" tabindex="-1"></button>
		    </div>
		    <div class="input-control text size3" data-role="input-control">
		        <input type="text" id="txtTotalCajas" placeholder="Nro. Total Cajas" maxlength="11">
		        <button class="btn-clear" tabindex="-1"></button>
		    </div>
		    <div class="input-control text size3" data-role="input-control">
		        <input type="text" id="txtCubicaje" placeholder="Cubicaje" maxlength="10">
		        <button class="btn-clear" tabindex="-1"></button>
		    </div>
		    <div class="input-control text size3" data-role="input-control">
		        <input type="text" id="txtNotasMercancia" placeholder="Observaciones" maxlength="254">
		        <button class="btn-clear" tabindex="-1"></button>
		    </div>
		    
		    <p>Fecha Ingreso(Año-Mes-Día)</p>
			<div class="input-control text size2" id="calendarFechaMercancia">
				<input type="text" id="dateMercancia">
				<button class="btn-date" type="button"></button>
			</div>
		    
		</div>
		<br>		 

	    <button class="button" id="btnNewMercancia"  type="button">Nuevo!</button>
	    <button class="button" id="btnSaveMercancia" type="button">Registrar!</button>
	    <?php if ($this->_tpl_vars['IdRol'] != 3): ?> 
		    <button class="button" id="btnUpdMercancia"  type="button">Actualizar!</button>
		    <button class="button" id="btnDelMercancia"  type="button">Inactivar!</button>
	    <?php endif; ?> 	 
    </div>
    
     <!-- Parte Lista Mercancia-->
    <div class="parteList listview" id="Lista-mercancia">
   
    </div>
    
</div>
