<?php /* Smarty version 2.6.1, created on 2014-07-24 13:51:26
         compiled from roles.html */ ?>
<div>

	<legend><?php echo $this->_tpl_vars['Titulo']; ?>
</legend>

	<div class="parteForm" id="formRoles">

	    <div class="input-control text" data-role="input-control">
	        <input type="text" id="txtNombre_Rol" placeholder="Nombre Rol">
	        <button class="btn-clear" tabindex="-1"></button>
	    </div>
	   
        <!--Check Modulos-->
        <div>
		    <div class="input-control checkbox" data-role="input-control">
		        <?php if (count($_from = (array)$this->_tpl_vars['array_NombreModulo'])):
    foreach ($_from as $this->_tpl_vars['dataid'] => $this->_tpl_vars['data']):
?>
		        	<?php if ($this->_tpl_vars['dataid'] > 0): ?> 
						<label class="inline-block"><input type="checkbox" id = "Module<?php echo $this->_tpl_vars['array_IdModulo'][$this->_tpl_vars['dataid']]; ?>
"  value="<?php echo $this->_tpl_vars['array_IdModulo'][$this->_tpl_vars['dataid']]; ?>
" name = "module"/>
						<span class="check"></span>
						<?php echo $this->_tpl_vars['data']; ?>

						</label>
			       <?php endif; ?>
			    <?php endforeach; unset($_from); endif; ?>
			</div>
		</div>
	    

	     <button class="button" id="btnNewRol"  type="button">Nuevo!</button>
	     <button class="button" id="btnSaveRol" type="button">Registrar!</button>
	     <button class="button" id="btnUpdRol"  type="button">Actualizar!</button>
	     <button class="button" id="btnDelRol"  type="button">Inactivar!</button> 	 
    </div>

    <!-- Parte Lista Roles-->
    <div class="parteList listview" id="Lista-roles">
   
    </div>
 </div>   