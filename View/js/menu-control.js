//Opciones de Empleados
$(document).delegate('#idEmpleados','click', function()
{
	$("#divMain").load("Controller/php/apiEmpleado.php?action=GetMain",function(){	
		Lista_Empleados();
		
	});
		
});

//Fin Opciones de Empleados
	

//Opciones de Clientes	
$(document).delegate('#idModulo_Clientes','click',function(){
	
    
	$("#divMain").load("Controller/php/apiClientes.php?action=ViewRegCliente",function(){
	    Lista_Clientes();
	});
	
	
});

//Fin Opciones de Clientes


//Opciones de Mercancia
$(document).delegate('#idMercancia','click',function(){
	$("#divMain").load("Controller/php/apiMercancia.php?action=GetMain",function(){	
		Lista_Mercancia();
	});
});


//Opciones de Cajas
$(document).delegate('#idCajas','click',function(){
	$("#divMain").load("Controller/php/apiCaja.php?action=ViewCaja",function(){	
		Lista_Caja();
	});
});


//Opciones de Observaciones
$(document).delegate('#idObservacion','click',function(){
	$("#divMain").load("Controller/php/apiObservacion.php?action=ViewObservacion",function(){	
		Lista_Observaciones();
	});
});


//Opciones de Envios
$(document).delegate('#idEnvios','click',function(){
	$("#divMain").load("Controller/php/apiEnvio.php?action=ViewEnvio",function(){	
		Lista_Envio();
	});
});

//Opciones de Contenedor
$(document).delegate('#idContenedor','click',function(){
	$("#divMain").load("Controller/php/apiContainer.php?action=GetMain",function(){	
		Lista_Container();
	});
});

//Opciones de Roles
$(document).delegate('#idModuloRoles','click',function(){
	$("#divMain").load("Controller/php/apiRol.php?action=ViewRol",function(){	
		Lista_Roles();
	});
});


//Opciones de Modulos
$(document).delegate('#idModulos','click',function(){
	$("#divMain").load("Controller/php/apiModule.php?action=ViewModulo",function(){	
		Lista_Modulos();
	});
});


//Opciones de Reporte1
$(document).delegate('#idReporte1','click',function(){
	$("#divMain").load("Controller/php/apiReporte.php?action=ViewReport1",function(){	
		loadDateReport();
	});
});

//Opciones de Reporte2
$(document).delegate('#idReporte2','click',function(){
	$("#divMain").load("Controller/php/apiReporte.php?action=ViewReport2",function(){	
		loadDateReport2();
	});
});

//Opciones de Reporte3: Mercancia
$(document).delegate('#idReporte3','click',function(){
	$("#divMain").load("Controller/php/apiReporte.php?action=ViewReport3",function(){	
		loadDateReport3();
	});
});


//Opciones de Reporte4: Contenedor
$(document).delegate('#idReporte4','click',function(){
	$("#divMain").load("Controller/php/apiReporte.php?action=ViewReport4",function(){	
		loadDateReport4();
	});
});


//Opciones de Reporte5: Contenedor
$(document).delegate('#idReporte5','click',function(){
	$("#divMain").load("Controller/php/apiReporte.php?action=ViewReport5",function(){	
		loadDateReport5();
	});
});

//Cambio Clave
//$("#createWindowDraggable").on('click', function(){
$(document).delegate('#IdDialogCambioClave','click',function(){
    $.Dialog({
        shadow: true,
        overlay: false,
        draggable: true,
        icon: '<span class="icon-key-2"></span>',
        title: 'Draggable window',
        width: 500,
        padding: 10,
        content: 'This Window is draggable by caption.',
        onShow: function(){
            var content = '<div id="myDialogClave">'+
				            '  <div id="dialog-body">'+
				            '   <input style="margin-top: 8px" type="password" placeholder="Clave" id="txtClave" />'+
				            '	<input style="margin-top: 8px" type="password" placeholder="Nueva Clave" id="txtNuevaClave" />'+
				            '	<input style="margin-top: 8px" type="password" placeholder="Repita Clave" id="txtRepitaClave" />'+			     
				            '  </div>'+
				            '  <div id="dialog-footer">'+
				            '    <button class="button primary" onclick="action_CambioClave();" >Cambiar Clave</button>'+
				            '    <button class="button" type="button" onclick="$.Dialog.close()">Cerrar</button> '+
				            '  </div>'+
				            '    <br>'+
				            '</div>';

            $.Dialog.title("Cambio Clave");
            $.Dialog.content(content);
        }

    });
});

function action_CambioClave(){
	var sbPassword=$("#txtClave").val();
	var sbNewPassword=$("#txtNuevaClave").val();
	var sbComparePassword=$("#txtRepitaClave").val();
	if(sbNewPassword === sbComparePassword){
		 $.ajax({
			    
				type: "POST",
				url: "Controller/php/apiProfile.php?action=CambioClave",
				dataType: 'html',
				data: "Clave="+sbPassword+'&NuevaClave='+sbNewPassword,
				beforeSend:function(){

				},
				success: function(DataClave){
					$("#txtClave").val("");
		            $("#txtNuevaClave").val("");
		            $("#txtRepitaClave").val("");

		            alert(DataClave);
				},
				complete: function(){

				}
		 });
		
	}else{
		alert("La nueva clave y la confirmaci\xf3n no coinciden!!!");
	}
	 
}


//Soporte
$(document).delegate('#IdDialogSoporte','click',function(){
  $.Dialog({
	  shadow: true,
      overlay: false,
      draggable: true,
      icon: '<span class="icon-thumbs-up"></span>',
      title:'Draggable window',
      width: 600,
      padding: 10,
      onShow: function(){
          var content =    '<div class="content">'+
						          '<label>&iquest;Tienes problemas con la esta aplicaci&oacute;n o alg&uacute;n otro producto de <b>Scripts</b>?</label>'+
						          '<label>&iquest;Tienes dudas o sugerencias?</label>'+
						          '<label>&iquest;Te interesar&iacute;a trabajar en <b>Scripts</b>?</label>'+
						          '<br>'+
						          '<label>Cont&aacute;ctanos, con gusto te atenderemos:</label>'+
						          '<br>'+
						  		  '<label><b>Scripts S.A.S.</b></label> '+
						  		  '<label>Colombia. Cali (Valle)</label>'+ 
						      '</div>';
          $.Dialog.title("Soporte");
          $.Dialog.content(content);
      }

  });
});