<?php /* Smarty version 2.6.1, created on 2014-10-30 15:53:09
         compiled from contenedor.html */ ?>
<div>
     <legend><?php echo $this->_tpl_vars['Label_Tittle']; ?>
</legend>
     <div class="parteForm" id="formContainer">
			<div id="ContainerMercancia">
			
			<div class="input-control text size3" data-role="input-control">
		        <input type="text" id="txtNroContenedor" placeholder="Nro. Contenedor" maxlength="50">
		        <button class="btn-clear" tabindex="-1"></button>
		    </div>
		    <div class="input-control text size3" data-role="input-control">
		        <input type="text" id="txtNroInterno" placeholder="Nro. Interno" maxlength="50">
		        <button class="btn-clear" tabindex="-1"></button>
		    </div>
		    <div class="input-control text size3" data-role="input-control">
		        <input type="text" id="txtDescripcion" placeholder="Descripcion" maxlength="50">
		        <button class="btn-clear" tabindex="-1"></button>
		    </div>
		</div>
		<br>		 

	    <button class="button" id="btnNewContainer"  type="button">Nuevo!</button>
	    <button class="button" id="btnSaveContainer" type="button">Registrar!</button>
	    <?php if ($this->_tpl_vars['IdRol'] != 3): ?>  
		    <button class="button" id="btnUpdateContainer"  type="button">Actualizar!</button>
		    <button class="button" id="btnDeleteContainer"  type="button">Inactivar!</button> 
	    <?php endif; ?>	 
    </div>
    
    <div class="parteListCont" >
	    <div  id="Buscar-Contenedor" class="input-control text" >
	            <input type="text" id="txtBuscarContenedor" placeholder="Buscar">
	            <button class="btn-clear" id="btnClearCont" tabindex="-1"></button>
	    </div>
	    <div class="parteList listview" id="Lista-container">
   	</div> 
    </div>

     <!--<input id="btnScripts" name="Scripts" type="button" value=<?php echo $this->_tpl_vars['sbDato']; ?>
 />-->
</div>
 