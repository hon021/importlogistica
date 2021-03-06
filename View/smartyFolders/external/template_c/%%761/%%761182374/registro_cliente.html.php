<?php /* Smarty version 2.6.1, created on 2014-08-23 21:47:34
         compiled from registro_cliente.html */ ?>
<div>

	<legend><?php echo $this->_tpl_vars['Titulo']; ?>
</legend>

	<div class="parteForm" id="formRegCliente">

 		<div class="input-control text" data-role="input-control">
	        <input type="text" id="txtDNI_Cliente" placeholder="DNI" maxlength="18">
	        <button class="btn-clear" tabindex="-1"></button>
	    </div>
	    <div class="input-control text" data-role="input-control">
	        <input type="text" id="txtNombre_Cliente" placeholder="Tus nombres" maxlength="80">
	        <button class="btn-clear" tabindex="-1"></button>
	    </div>
	    <div class="input-control text" data-role="input-control">
	        <input type="text" id="txtApellido_Cliente" placeholder="Tus Apellidos" maxlength="80">
	        <button class="btn-clear" tabindex="-1"></button>
	    </div>
	    <div class="input-control text" data-role="input-control">
	        <input type="tel" id="txtCel_Cliente" placeholder="Celular" maxlength="18">
	        <button class="btn-clear" tabindex="-1"></button>
	    </div>
	    <div class="input-control text" data-role="input-control">
	        <input type="tel" id="txtFijo_Cliente" placeholder="Fijo" maxlength="18">
	        <button class="btn-clear" tabindex="-1"></button>
	    </div>
	    <div class="input-control text" data-role="input-control">
	        <input type="email" id="txtEmail_Cliente" placeholder="E-mail" maxlength="80">
	        <button class="btn-clear" tabindex="-1"></button>
	    </div>
	     <div class="input-control text" data-role="input-control">
	        <input type="text" id="txtCiudad_Cliente" placeholder="Ciudad" maxlength="80">
	        <button class="btn-clear" tabindex="-1"></button>
	    </div>
	    <div>
            <div class="input-control radio inline-block" data-role="input-control">
                <label class="inline-block">
                    <input type="radio" id="rbMasculino" value="M" name="Sex"/>
                    <span class="check"></span>
                    Hombre
                </label>
                <label class="inline-block">
                    <input type="radio" id="rbFemenino" value="F" name="Sex"  />
                    <span class="check"></span>
                    Mujer
                </label>
            </div>
       </div>
       
       
        <div class="example">
		   <div class="input-control text" data-role="input-control">
		    	<input type="text" id="txtUsername_Cliente" placeholder="Nombre de Usuario"  maxlength="18"/>
		    	<button class="btn-clear" tabindex="-1"></button>
	       </div>
	       
	       <div class="input-control text" data-role="input-control">
	    		<input type="password" id="txtPassword_Cliente" name="password" placeholder="Clave"  maxlength="18" class="icon-locked" />	    		
	    		<button id="btnShowPassword" tabindex="-1" >Mostrar Clave</button>	    		
	       </div>
	       
	       <div class="input-control text" data-role="input-control">
	    		<input type="password" id="txtConfirma_Password_Cliente" placeholder="Confirmar Clave" maxlength="18" class="icon-locked"/>
	    		<button class="btn-clear" tabindex="-1"></button>
	       </div>
	       
	       <div class="input-control select">
			<select id = "cmbRol">
			   <?php if (count($_from = (array)$this->_tpl_vars['array_NombreRol'])):
    foreach ($_from as $this->_tpl_vars['dataid'] => $this->_tpl_vars['data']):
?>
			       <?php if ($this->_tpl_vars['dataid'] == 0): ?>    
				   	 <option value="0">Seleccione Rol</option>
				   <?php else: ?>
				     <option value="<?php echo $this->_tpl_vars['array_IdRol'][$this->_tpl_vars['dataid']]; ?>
"><?php echo $this->_tpl_vars['data']; ?>
</option>
				   <?php endif; ?>
			   <?php endforeach; unset($_from); endif; ?>
			</select>
		   </div>
	   </div>
	   
     <button class="button" id="btnNewCliente"  type="button">Nuevo!</button>
     <button class="button" id="btnSaveCliente" type="button">Registrar!</button>
     <button class="button" id="btnUpdCliente"  type="button">Actualizar!</button>
     <button class="button" id="btnDelCliente"  type="button">Inactivar!</button> 	 
    </div>


	<div class="parteListClientes" >
       <div  id="Buscar-Clientes" class="input-control text" >
            <input type="text" id="txtBuscarClient" placeholder="Buscar">
            <button class="btn-clear" id="btnClearClient" tabindex="-1"></button>
      </div>
      <!-- Parte Lista Clientes-->
	    <div class="parteList listview" id="Lista-clientes">
	    </div>
    </div> 	
    