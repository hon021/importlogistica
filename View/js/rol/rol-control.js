
function Lista_Roles()
{	  
	$("#cargando").show();
	$("#Lista-roles").empty();
	jQuery("input[type='text']").prop("disabled", true);
	jQuery("button").prop("disabled", true);
	
	//Clientes
	$.ajax({ //  $.ajax clientes
		type: "POST",
		url:  "Controller/php/apiRol.php",
		dataType: "html",
		data: "action=GetRol",
				  		
		success: function(DataRoles){	
					  
			var rol = jQuery.parseJSON(DataRoles);
			
			$.each(rol, function(i,item) {
		
				if(i>0){
		
					$("#Lista-roles").append(
					"<a class='list' id ='Elemento-rol' name = '"+rol[i].IdRol+"'>"+
					"			<div class='list-content' >"+
					"               <img src='View/images/user_role.png' class = 'icon'>"+
					"				<div class='data'>"+
					"					<span class ='list-title' id = 'idNombreRol"+rol[i].IdRol+"'>"+rol[i].Nombre+"</span> "+
					"				</div>"+
					"			</div>"+
					"</a>");	
					
			    }
				
			});
			
			
			jQuery("input[type='text']").prop("disabled", false);
			jQuery("button").prop("disabled", false);
			$( "#btnNewRol" ).prop( "disabled", true );
			$("#txtNombre_Rol").focus();
			var div = document.getElementById("cargando");
			div.style.display="none";
		}
	});//  $.ajax clientes
			  
}

var objModule; 
var sbElement;
var sbIdRol;
$(document).delegate('#Elemento-rol','click',function(){
	var sbValue = this.name;
	
	$("#cargando").show();
	
	
	sbIdRol = sbValue;
	//Clientes
	$.ajax({ //  $.ajax clientes
		type: "POST",
		url:  "Controller/php/apiModule.php",
		dataType: "html",
		data: "action=GetModulosRol"+
		"&nuRol="+sbValue,
				  		
		success: function(DataModule){
			objModule = jQuery.parseJSON(DataModule);
			jQuery("input[type='checkbox']").prop("checked", false);
			sbElement = document.getElementById("idNombreRol"+sbValue).innerHTML;
			$("#txtNombre_Rol").val(sbElement);
			$.each(objModule, function(i,item) {
				if(i>0){
					$("#Module"+objModule[i].IdModulo).prop("checked", true);
				}
			});
			
			//Activa Boton Nuevo
			$( "#btnNewRol" ).prop( "disabled", false );
			
			if(sbValue=="1"){
				$("#btnNewRol").prop("disabled", true); 
				$("#btnSaveRol").prop("disabled",true); 
				$("#btnUpdRol").prop("disabled", true);  
				$("#btnDelRol").prop("disabled", true);   
			}else{
				$("#btnNewRol").prop("disabled", false); 
				$("#btnSaveRol").prop("disabled",false); 
				$("#btnUpdRol").prop("disabled", false);  
				$("#btnDelRol").prop("disabled", false); 	
			}	
			
			(document.getElementById("cargando")).style.display="none";

		}
	});//  $.ajax clientes
});



$(document).delegate('#btnNewRol','click',function(){
	
	 $("#txtNombre_Rol").val("");
	 $("#txtNombre_Rol").focus();
	 jQuery("input[type='checkbox']").prop("checked", false);
	 
});

$(document).delegate('#btnSaveRol','click',function(){

	var bolControl = true;
	var nuControl = 0;
	var sbMensaje = " ";
	
	//Campos
    var sbNombre=$("#txtNombre_Rol").val();
   

    if(sbNombre.length == 0){
    	bolControl=false;
    	sbMensaje += "-Ingrese Nombre Rol ";
    }
    
    $("input[type=checkbox]:checked").each(function(i){
		//cada elemento seleccionado
		nuControl++;
	});
    
    if(nuControl<=0){
    	bolControl=false;
    	sbMensaje += "-Debe seleccionar al menos un modulo! ";
    }
       
    
    
    if(bolControl){
    	//Buscar Nombre Rol
    	$.ajax({ //  $.ajax Nombre Rol
    		type: "POST",
    		url:  "Controller/php/apiRol.php",
    		dataType: "html",
    		data: "action=GetNombreRol"+
    		"&sbNombre="+sbNombre,
    				  		
    		success: function(DataNombreRol){//success: function(DataNombreRol)
    			if(DataNombreRol == "0"){//if(DataNombreRol 
    				  $.ajax({ //  $.ajax registro rol
							type: "POST",
							url:  "Controller/php/apiRol.php",
							dataType: "html",
							data: "action=RegRol" +
								  "&sbNombre="+sbNombre,
								
								  
							success: function(IdRol){	//success: function(IdRol)
								
								array_Modulos = new Array();
	
								 //Capturando los modulos seleccionados
								$("input[type=checkbox]:checked").each(function(i){
									//cada elemento seleccionado
									array_Modulos[i]=$(this).val();
								});
								
								 $.ajax({ //  $.ajax registro detalle modulo
	    								type: "POST",
	    								url:  "Controller/php/apiModuledetail.php",
	    								dataType: "html",
	    								data: "action=RegDetalleModulo" +
	    									  "&idRol="+IdRol+"&arrayModules="+ArrayJson(array_Modulos),
	    									
	    									  
	    								success: function(DataDetalle){	
	    									
	    									 if(DataDetalle == "Registro Exitoso!"){
	    										 Lista_Roles(); 
	    									 }
	    									 alert(DataDetalle);
	    								}
	    							 
	    						 });// $.ajax registro detalle modulo
								 
							}//success: function(IdRol)
						 
					 });//  $.ajax registro rol
    			}//if(DataNombreRol 
    			else//if(DataNombreRol 
    			{
    				alert("-Ya exite el nombre del Rol! ");
    			}//if(DataNombreRol 

    			
    		}//success: function(DataNombreRol)
    	});//  $.ajax Nombre Rol
    }//if(bolControl)
    else
    {
    	alert(sbMensaje);
    }//if(bolControl)
});



$(document).delegate('#btnUpdRol','click',function(){
	var bolControl = true;
	var nuControl = 0;
	var sbMensaje = " ";
	
	
	//Campos
    var sbNombre=$("#txtNombre_Rol").val();

    if(sbNombre.length == 0){
    	bolControl=false;
    	sbMensaje += "-Debe seleccionar un Rol de la lista ";
    }
    
	
    $("input[type=checkbox]:checked").each(function(i){
		//cada elemento seleccionado
		nuControl++;
	});
    
    if(nuControl<=0){
    	bolControl=false;
    	sbMensaje += "-Debe seleccionar al menos un modulo! ";
    }
    
    
    if(bolControl)
    {
    	if(Cambio_Campos_Rol())
    	{
    		$.ajax({ //  $.ajax actualizar rol
	    		type: "POST",
	    		url:  "Controller/php/apiRol.php",
	    		dataType: "html",
	    		data: "action=UpdRol" +
	    		"&idRol="+sbIdRol+"&sbNombre="+sbNombre,
	            
	    		success: function(updRol){	//success: function(updRol)
	    			if(updRol == "0"){
	    				
	    				//
	    				array_Modulos = new Array();
	    				
						 //Capturando los modulos seleccionados
						$("input[type=checkbox]:checked").each(function(i){
							//cada elemento seleccionado
							array_Modulos[i]=$(this).val();
						});
						
						 $.ajax({ //  $.ajax registro detalle modulo
								type: "POST",
								url:  "Controller/php/apiModuledetail.php",
								dataType: "html",
								data: "action=UpdDetalleModulo" +
									  "&idRol="+sbIdRol+"&arrayModules="+ArrayJson(array_Modulos),
									
									  
								success: function(DataDetalle){	
									
									 if(DataDetalle == "Actualizacion Exitosa!"){
										 Lista_Roles(); 
									 }
									 alert(DataDetalle);
								}
							 
						 });// $.ajax registro detalle modulo
	    				
	    			}
	    		
	    		}
	    	});// $.ajax actualizar rol
    		
    	}//if(Cambio_Campos_Rol()){
    	else
    	{
    	   alert("No se detectan cambios en los campos!")	
    	}//if(Cambio_Campos_Rol()){
    	
    }//if(bolControl)
    else
    {
    	alert(sbMensaje);
    }//if(bolControl)
    
    
    
});


function Cambio_Campos_Rol(){

	var nuControl = 0;
	var bolControl = false;
	//array_Modulos = new Array();

	//Datos Rol
	var sbNombre=$("#txtNombre_Rol").val();

	if(sbNombre != sbElement){
    	bolControl = true;
	}
    
	//return bolControl;
	return true;

}


$(document).delegate('#btnDelRol','click',function(){
	
	var bolControl = true;
	var nuControl = 0;
	var sbMensaje = " ";
	
	//Campos
    var sbNombre=$("#txtNombre_Rol").val();

    if(sbNombre.length == 0){
    	bolControl=false;
    	sbMensaje += "-Debe seleccionar un Rol de la lista ";
    }
    
	
    $("input[type=checkbox]:checked").each(function(i){
		//cada elemento seleccionado
		nuControl+=i;
	});
    
    if(nuControl<=0){
    	bolControl=false;
    	sbMensaje += "-No hay modulos seleccionados, es probable que haya un error! ";
    }
    
    
    if(bolControl)////if(bolControl)
    {

		$.ajax({ //  $.ajax Inactivar Rol
			type: "POST",
			url:  "Controller/php/apiRol.php",
			dataType: "html",
			data: "action=InactiveRol"+
			"&idRol="+sbIdRol,
					  		
			success: function(DataRol){
				if(DataRol == "Proceso Exitoso!"){
					Lista_Roles();
				}
				alert(DataRol);
			}
	
		});//  $.ajax Inactivar Rol
	
   
	}//if(bolControl)
	else
	{
		alert(sbMensaje);
	}//if(bolControl)
	
});

