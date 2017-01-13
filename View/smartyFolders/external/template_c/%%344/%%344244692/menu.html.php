<?php /* Smarty version 2.6.1, created on 2014-10-30 16:56:15
         compiled from menu.html */ ?>
<div class="navigation-bar dark">
    <div class="navigation-bar-content container">
        <a href="/Exportc" class="element"><span class="icon-home"></span> Cerrar sesi&oacuten </a>
        <span class="element-divider"></span>

        <a class="element1 pull-menu" href="#"></a>
        <ul class="element-menu">
            
            <?php if (count($_from = (array)$this->_tpl_vars['array_NombreModulo'])):
    foreach ($_from as $this->_tpl_vars['dataid'] => $this->_tpl_vars['data']):
?>
   
               <?php if ($this->_tpl_vars['array_CodigoPermiso'][$this->_tpl_vars['dataid']] == '01'): ?>
		            <li>
			          <a href="#" id="idModulo_Clientes"><?php echo $this->_tpl_vars['data']; ?>
</a>
		            </li>
		       <?php endif; ?>  
		       
		       <?php if ($this->_tpl_vars['array_CodigoPermiso'][$this->_tpl_vars['dataid']] == '02'): ?>  
		            <li>
		              <a href="#" id="idEmpleados"><?php echo $this->_tpl_vars['data']; ?>
</a>
		            </li>
		       <?php endif; ?> 
		         
		       <?php if ($this->_tpl_vars['array_CodigoPermiso'][$this->_tpl_vars['dataid']] == '03'): ?>    
		            <li>
		              <a href="#" id="idContenedor"><?php echo $this->_tpl_vars['data']; ?>
</a>
		            </li>
		       <?php endif; ?>
		        
		       <?php if ($this->_tpl_vars['array_CodigoPermiso'][$this->_tpl_vars['dataid']] == '04'): ?>  
		            <li>
			              <a class="dropdown-toggle" href="#" id="idGestionMercancia"><?php echo $this->_tpl_vars['data']; ?>
</a>
			              <ul class="dropdown-menu dark" data-role="dropdown">
			                     <li><a href="#" id="idEnvios">Envios</a></li>
				                 <li><a href="#" id="idMercancia">Mercancia</a></li>
				                 <!--<li><a href="#" id="idCajas">Cajas</a></li>-->
				                 <li><a href="#" id="idObservacion">Observaciones</a></li>
				                 <!--<li><a href="#" id="idEstadoCaja">EstadoCaja</a></li>-->
				                 <!--<li><a href="#" id="idLocalizacion">Localizacion</a></li>-->
				          </ul> 
		            </li>
		       <?php endif; ?>
		       
		       
		        <?php if ($this->_tpl_vars['array_CodigoPermiso'][$this->_tpl_vars['dataid']] == '10'): ?>
		            <li>
		                 <a class="dropdown-toggle" href="#" id="idReportes"><?php echo $this->_tpl_vars['data']; ?>
</a>
			             <ul class="dropdown-menu dark" data-role="dropdown">
			                 <li><a href="#" id="idReporte1">Estado Caja</a></li>
			                 <li><a href="#" id="idReporte2">Estado Mercancia</a></li>
			                 <li><a href="#" id="idReporte3">Mercancia x DNI</a></li>
			                 <li><a href="#" id="idReporte4">Contenedor x DNI</a></li>
			                 <?php if ($this->_tpl_vars['IdRol'] == 1): ?> 
			                 	<li><a href="#" id="idReporte5">Reporte Contenedor</a></li>
			                 <?php endif; ?> 	 
			             </ul> 
		            </li>
		           
		       <?php endif; ?>  
		       
		       <?php if ($this->_tpl_vars['array_CodigoPermiso'][$this->_tpl_vars['dataid']] == '09'): ?> 
		            <li>
		                 <a class="dropdown-toggle" href="#" id="idAdmin"><?php echo $this->_tpl_vars['data']; ?>
</a>
			             <ul class="dropdown-menu dark" data-role="dropdown">
			                 <li><a href="#" id="idModuloRoles">Roles</a></li>
			                 <li><a href="#" id="idModulos">Modulos</a></li>
			             </ul> 
		            </li>
		       <?php endif; ?>  
		        
            <?php endforeach; unset($_from); endif; ?>
            
         </ul>
         
         
                    <div class="no-tablet-portrait">

                        <div class="element place-right">
                            <a class="dropdown-toggle" href="#">
                                <span class="icon-cog"></span>
                            </a>
                            <ul class="dropdown-menu place-right" data-role="dropdown">
                                <li><a href="#" id="IdDialogCambioClave">Cambio Clave</a></li>
                                <li><a href="#" id="IdDialogSoporte">Soporte</a></li>
                               
                            </ul>
                        </div>
                        <span class="element-divider place-right"></span>
                        <button class="element image-button image-left place-right">
                            <b><?php echo $this->_tpl_vars['sbLogin']; ?>
</b> 
                            <img src="View/images/user2.jpg"/>                                              
                        </button>
                    </div>
        

       
    </div>
</div>