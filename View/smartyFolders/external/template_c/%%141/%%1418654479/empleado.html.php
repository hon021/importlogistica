<?php /* Smarty version 2.6.1, created on 2014-07-24 17:52:51
         compiled from empleado.html */ ?>
<div>
    <legend><?php echo $this->_tpl_vars['Label_Tittle']; ?>
</legend>
    <!--<label>Nombre</label>-->

    <div class="parteForm" id="formEmpleado">
        <div class="input-control text" data-role="input-control">
            <input type="text" id="txtEmpDNI" placeholder="DNI" maxlength="18">
            <button class="btn-clear" tabindex="-1"></button>
        </div>
        <div class="input-control text" data-role="input-control">
            <input type="text" id="txtEmpNombre" placeholder="Tus nombres" maxlength="80">
            <button class="btn-clear" tabindex="-1"></button>
        </div>
        <div class="input-control text" data-role="input-control">
            <input type="text" id="txtEmpApellido" placeholder="Tus Apellidos" maxlength="80">
            <button class="btn-clear" tabindex="-1"></button>
        </div>
        <div class="input-control text" data-role="input-control">
            <input type="tel" id="txtEmpCel" placeholder="Celular" maxlength="18">
            <button class="btn-clear" tabindex="-1"></button>
        </div>
        <div class="input-control text" data-role="input-control">
            <input type="tel" id="txtEmpFijo" placeholder="Fijo" maxlength="18">
            <button class="btn-clear" tabindex="-1"></button>
        </div>
        <div class="input-control text" data-role="input-control">
            <input type="email" id="txtEmpEmail" placeholder="E-mail" maxlength="80"> 
            <button class="btn-clear" tabindex="-1"></button>
        </div>
        <div>
            <div class="input-control radio inline-block" data-role="input-control">
                <label class="inline-block">
                    <input type="radio" id="rbEmpMasculino" value="M" name="Sex"/>
                    <span class="check"></span>
                    Hombre
                </label>
                <label class="inline-block">
                    <input type="radio" id="rbEmpFemenino" value="F" name="Sex"  />
                    <span class="check"></span>
                    Mujer
                </label>
            </div>
       </div>
        
        <div class="input-control text" data-role="input-control">
            <input type="text" id="txtEmpCargo" placeholder="Tu Cargo" maxlength="40">
            <button class="btn-clear" tabindex="-1"></button>
        </div>
        
        
        <div class="example">
           <div class="input-control text" data-role="input-control">
                <input type="text" id="txtUsername_Cliente" placeholder="Nombre de Usuario" maxlength="18"/>
                <button class="btn-clear" tabindex="-1"></button>
           </div>
           
           <div class="input-control text" data-role="input-control">
                <input type="password" id="txtPassword_Cliente" placeholder="Clave" maxlength="18" class="icon-locked"/>
                <button class="btn-clear" tabindex="-1"></button>
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
       
	   <button class="button" id="btnNewEmployee"  type="button">Nuevo!</button>
	   <button class="button" id="btnSaveEmployee" type="button">Registrar!</button>
	   <button class="button" id="btnUpdEmployee"  type="button">Actualizar!</button>
	   <button class="button" id="btnDelEmployee"  type="button">Inactivar!</button> 	 

    </div>
    
    <div class="parteListEmp" >
       <div  id="Buscar-Empleados" class="input-control text" >
            <input type="text" id="txtBuscar" placeholder="Buscar">
            <button class="btn-clear" id="btnClear" tabindex="-1"></button>
      </div>
      <div class="parteList listview" id="Lista-Empleados">
      </div>
    </div> 
</div>

 
