var objCustomer;
var ClientSeleccionado; //Sin uso por ahora
var objProfile;
var ListClientes;
var boolShowPassword = false;

$(document).delegate('#btnShowPassword', 'click', function() 
{
	if(!boolShowPassword)
	{
		$('#txtPassword_Cliente').attr('type', 'text');
		boolShowPassword = true;
	}
	else 
	{
		$('#txtPassword_Cliente').attr('type', 'password');
		boolShowPassword = false;	
	}

});

$(document).delegate('#btnClearClient', 'click', function()
{
	$("#Lista-clientes").empty();
	AddToListClient(ListClientes);
});

$(document).delegate('#txtBuscarClient', 'keyup', function()
{
	var str = this.value.toUpperCase();
	var flag = false;
	
	for (var i = ListClientes.length - 1; i >= 0; i--) 
	{
		//if(!(ListClientes[i].Nombre == undefined && ListClientes[i].Apellido == undefined))
		if(!(ListClientes[i].DNI == undefined))
		{
			//if(str.search($.trim(ListClientes[i].Nombre.toUpperCase())) != '-1' || str.search($.trim(ListClientes[i].Apellido.toUpperCase())) != '-1') 
			if(str.search($.trim(ListClientes[i].DNI.toUpperCase())) != '-1' )
			{
				flag = true;
			}
		}
	};
	 
	if(flag)
	{
		$("#Lista-clientes").empty();
		for (var i = ListClientes.length - 1; i >= 0; i--) 
		{
			if(!(ListClientes[i].DNI == undefined))
			{
				if(str.search($.trim(ListClientes[i].DNI.toUpperCase())) != '-1' )
				{
					AddToListClientOne(ListClientes[i]);
				}
			}
		};
	}
	else 
	{
		$("#Lista-clientes").empty();
		AddToListClient(ListClientes);
	}
});

$(document).delegate('#btnSaveCliente','click',function()
{


	var bolControl = true;
	var sbMensaje = " ";
	var sbGenero = "M";
	//Datos Cliente
    var sbNombre=$("#txtNombre_Cliente").val();
    var sbApellido=$("#txtApellido_Cliente").val(); 
    var sbDNI=$("#txtDNI_Cliente").val();
    var sbCel=$("#txtCel_Cliente").val(); 
    var sbFijo=$("#txtFijo_Cliente").val(); 
    var sbEmail=$("#txtEmail_Cliente").val();
    var sbCiudad=$("#txtCiudad_Cliente").val();
    sbGenero=$('input:radio[name=Sex]:checked').val();

    
    //Datos Perfil
    var sbIdRol=$("#cmbRol").val();
    var sbUsuario=$("#txtUsername_Cliente").val(); 
    var sbClave=$("#txtPassword_Cliente").val();
    var sbComparePassword=$("#txtConfirma_Password_Cliente").val();

    if(sbNombre.length == 0){
    	bolControl=false;
    	sbMensaje += "-Ingrese Nombre ";
    }
    
    if(sbApellido.length == 0){
    	bolControl=false;
    	sbMensaje += "-Ingrese Apellidos ";
    }
    
    if(sbDNI.length == 0){
    	bolControl=false;
    	sbMensaje += " -Ingrese DNI ";
    }
    
    if(sbEmail.length == 0){
    	bolControl=false;
    	sbMensaje += "-Ingrese Email ";
    }
    
    if(sbCiudad.length == 0){
    	bolControl=false;
    	sbMensaje += "-Ingrese Ciudad ";
    }
    
    if(sbUsuario.length == 0){
    	bolControl=false;
    	sbMensaje += "-Ingrese Nombre Usuario ";
    }
    
    
    if(sbClave.length == 0){
    	bolControl=false;
    	sbMensaje += "-Ingrese Clave ";
    }
    
    
    if(sbIdRol=="0"){
    	bolControl=false;
    	sbMensaje += "-Seleccione un Rol ";
    }
    
    
    if(sbClave != sbComparePassword){
    	bolControl=false;
    	sbMensaje += "-La clave y la confirmaci\xf3n no coinciden! ";
    }
    
    if(bolControl){
    	//Buscar DNI Cliente
    	$.ajax({ //  $.ajax DNI clientes
    		type: "POST",
    		url:  "Controller/php/apiClientes.php",
    		dataType: "html",
    		data: "action=GetDNI"+
    		"&sbDNI="+sbDNI,
    				  		
    		success: function(DataDNI){//success: function(DataDNI)
    			if(DataDNI == "0"){//if(DataDNI == "0")
    				
    				//Buscar Nombre Usuario
			    	$.ajax({ //  $.ajax Nombre Usuario
			    		type: "POST",
			    		url:  "Controller/php/apiProfile.php",
			    		dataType: "html",
			    		data: "action=GetUser"+
			    		"&sbUsuario="+sbUsuario,
			    				  		
			    		success: function(DataUser){
			    			if(DataUser == "0"){//if(DataUser == "0")
			    				 
			    				 $.ajax({ //  $.ajax registro perfil
			    				 		type: "POST",
			    				 		url:  "Controller/php/apiProfile.php",
			    				 		dataType: "html",
			    				 		data: "action=RegProfiles" +
			    				 		  	  "&idRol="+sbIdRol+"&sbUsuario="+sbUsuario+"&sbClave="+sbClave,
			    				 		  	
			    				 		  	  
			    				 		success: function(sbIdPerfil){	
			    				 	          
			    							 $.ajax({ //  $.ajax registro cliente
			    								type: "POST",
			    								url:  "Controller/php/apiClientes.php",
			    								dataType: "html",
			    								data: "action=RegCliente" +
			    									  "&idPerfil="+sbIdPerfil+"&sbNombre="+sbNombre+"&sbApellido="+sbApellido+"&sbDNI="+sbDNI+"&sbCelular="+sbCel+"&sbFijo="+sbFijo+"&sbEmail="+sbEmail+"&sbGenero="+sbGenero+"&sbCiudad="+sbCiudad,
			    									
			    									  
			    								success: function(DataCliente){	
			    									
			    									 if(DataCliente == "Registro Exitoso!"){
			    										 //Campos Cliente
			    										 $("#txtNombre_Cliente").val("");
			    										 $("#txtApellido_Cliente").val(""); 
			    										 $("#txtDNI_Cliente").val("");
			    										 $("#txtCel_Cliente").val(""); 
			    										 $("#txtFijo_Cliente").val(""); 
			    										 $("#txtEmail_Cliente").val("");
			    										 $("#txtCiudad_Cliente").val("");
			    				                         //Datos Perfil
			    										 $("#txtUsername_Cliente").val(""); 
			    										 $("#txtPassword_Cliente").val("");
			    										 $("#txtConfirma_Password_Cliente").val("");
			    										 
			    										 
			    										 if(sbGenero == "F"){
			    												$sbImg="<img src='View/images/user_female.png' class = 'icon'>";
			    										 }else{
			    												$sbImg="<img src='View/images/user_male.png' class = 'icon'> ";
			    										 }
			    										 
			    										 $("#Lista-clientes").append(
			    											"<a class='list' id ='Elemento-cliente' name = '"+sbDNI+"'>"+
			    											"			<div class='list-content' >"+
			    											$sbImg
			    											+"				<div class='data'>"+
			    											"					<span class ='list-title'> "+sbNombre+" "+sbApellido+"</span> "+
			    											"					<span class ='list-title'> DNI: "+sbDNI+"</span> "+
			    											"				</div>"+
			    											"			</div>"+
			    											"</a>");
			    									 }
			    									 alert(DataCliente);
			    								}
			    							 
			    							});//  $.ajax registro cliente
			    							
			    				 		}
			    				 	});//  $.ajax registro perfil
			    			}
			    			else////if(DataUser == "0")
			    			{
			    				alert("-Ya exite el nombre usuario! ");
			    			}//if(DataUser == "0")
			    		}
			    	});//  $.ajax Nombre Usuario
	    		}
    			else//if(DataDNI == "0")
	    		{
					alert("-Ya exite el DNI, es probable que el Cliente ya este registrado! ");
				}//if(DataDNI == "0")
    		}//success: function(DataDNI)
    	});//  $.ajax DNI clientes
    }//if(bolControl)
    else
    {
    	alert(sbMensaje);
    }//if(bolControl)
});

$(document).delegate('#btnNewCliente','click',function()
{

	 //ReadOnly DNI
	 $('#txtDNI_Cliente').prop('readonly', false);
	 //ReadOnly User
	 $('#txtUsername_Cliente').prop('readonly', false);
	
	 //Campos Cliente
	 $("#txtNombre_Cliente").val("");
	 $("#txtApellido_Cliente").val(""); 
	 $("#txtDNI_Cliente").val("");
	 $("#txtCel_Cliente").val(""); 
	 $("#txtFijo_Cliente").val(""); 
	 $("#txtEmail_Cliente").val("");
	 $("#txtCiudad_Cliente").val("");
     //Datos Perfil
	 $("#txtUsername_Cliente").val(""); 
	 $("#txtPassword_Cliente").val("");
	 $("#txtConfirma_Password_Cliente").val("");

	 $('#txtPassword_Cliente').attr('type', 'password');
	 boolShowPassword = false;
	 
	 $("#txtDNI_Cliente").focus();

	 Lista_Clientes();
});


function Lista_Clientes()
{	  
	
	$("#cargando").show();
	jQuery("input[type='text']").prop("disabled", true);
	jQuery("button").prop("disabled", true);
	
	//Clientes
	$.ajax({ //  $.ajax clientes
		type: "POST",
		url:  "Controller/php/apiClientes.php",
		dataType: "html",
		data: "action=GetCliente",
				  		
		success: function(DataClientes)
		{
			var customer = jQuery.parseJSON(DataClientes);
			ListClientes = customer;
			$("#Lista-clientes").empty();	

			AddToListClient(ListClientes);
			
			jQuery("input[type='text']").prop("disabled", false);
			jQuery("button").prop("disabled", false);
			
			
			$("#txtDNI_Cliente").focus();

			document.getElementById("cargando").style.display="none";
		}
	});//  $.ajax clientes
}

function AddToListClient(ListClientes)
{
	$.each(ListClientes, function(i,item) {

		if(i>0){
			
			if(ListClientes[i].Genero == "F"){
				$sbImg="<img src='View/images/user_female.png' class = 'icon'>";
			}else{
				$sbImg="<img src='View/images/user_male.png' class = 'icon'> ";
			}
					
			$("#Lista-clientes").append(
			"<a class='list' id ='Elemento-cliente' name = '"+ListClientes[i].DNI+"'>"+
			"			<div class='list-content' >"+
			$sbImg
			+"				<div class='data'>"+
			"					<span class ='list-title'> "+ListClientes[i].Nombre+" "+ListClientes[i].Apellido+"</span> "+
			"					<span class ='list-title'> DNI: "+ListClientes[i].DNI+"</span> "+
			"				</div>"+
			"			</div>"+
			"</a>");	
			
	    }
		
	});
}

function AddToListClientOne(Cliente)
{
	if(Cliente.Genero == "F")
	{
		$sbImg="<img src='View/images/user_female.png' class = 'icon' />";
	}else{
		$sbImg="<img src='View/images/user_male.png' class = 'icon' /> ";
	}

	$("#Lista-clientes").append
	(
		"<a class='list' id='Elemento-cliente' name = '"+Cliente.DNI+"'>"+
		"			<div class='list-content' >"+
		$sbImg+
		"				<div class='data' >"+
		"					<span class ='list-title'> "+Cliente.Nombre+" "+Cliente.Apellido+"</span> "+
		"					<span id='EmpDNI' class ='list-title'> DNI: "+Cliente.DNI+"</span> "+
		"				</div>"+
		"			</div>"+
		"</a>"
	);
}
 

$(document).delegate('#Elemento-cliente','click',function()
{

	var sbValue = this.name;

	$("#cargando").show();
	
	//Clientes
	$.ajax({ //  $.ajax clientes
		type: "POST",
		url:  "Controller/php/apiClientes.php",
		dataType: "html",
		data: "action=GetClienteDNI"+
		"&sbDNI="+sbValue,
				  		
		success: function(DataCliente){
			objCustomer = jQuery.parseJSON(DataCliente);
			
			$("#txtNombre_Cliente").val(objCustomer.Nombre);
			$("#txtApellido_Cliente").val(objCustomer.Apellido); 
			$("#txtDNI_Cliente").val(objCustomer.DNI);
			$("#txtCel_Cliente").val(objCustomer.Celular); 
			$("#txtFijo_Cliente").val(objCustomer.Fijo); 
			$("#txtEmail_Cliente").val(objCustomer.Email);
			$("#txtCiudad_Cliente").val(objCustomer.Ciudad);
			
			
			if(objCustomer.Genero=="F"){
				$("#rbFemenino").prop("checked", true);
			}else{
				$("#rbMasculino").prop("checked", true);
			}
			
			//ReadOnly DNI
			$('#txtDNI_Cliente').prop('readonly', true);
			
			//Datos Perfil
			$.ajax({ //  $.ajax Datos Perfil
				type: "POST",
				url:  "Controller/php/apiProfile.php",
				dataType: "html",
				data: "action=GetProfilesCustomer"+
				"&idPerfil="+objCustomer.IdPerfil,
						  		
				success: function(DataPerfil){
					
					objProfile = jQuery.parseJSON(DataPerfil);					
				    $("#txtUsername_Cliente").val(objProfile.Usuario); 
				    $("#txtPassword_Cliente").val(objProfile.Clave);
				    $("#txtConfirma_Password_Cliente").val(objProfile.Clave);
				    $("#cmbRol").val(objProfile.IdRol);
				    
				    //ReadOnly User
					$('#txtUsername_Cliente').prop('readonly', true);
					
					//Activa Boton Nuevo
					$( "#btnNewCliente" ).prop( "disabled", false );
					
					(document.getElementById("cargando")).style.display="none";
				}
			});//  $.ajax Datos Perfil
			
		}
	});//  $.ajax clientes
});

$(document).delegate('#btnUpdCliente','click',function()
{
	
	var bolControl = true;
	var sbMensaje = " ";
	var sbGenero = "M";
	//Datos Cliente
    var sbNombre=$("#txtNombre_Cliente").val();
    var sbApellido=$("#txtApellido_Cliente").val(); 
    var sbDNI=$("#txtDNI_Cliente").val();
    var sbCel=$("#txtCel_Cliente").val(); 
    var sbFijo=$("#txtFijo_Cliente").val(); 
    var sbEmail=$("#txtEmail_Cliente").val();
    var sbCiudad=$("#txtCiudad_Cliente").val();
    sbGenero=$('input:radio[name=Sex]:checked').val();

    
    //Datos Perfil
    var sbIdRol=$("#cmbRol").val();
    var sbUsuario=$("#txtUsername_Cliente").val(); 
    var sbClave=$("#txtPassword_Cliente").val();
    var sbComparePassword=$("#txtConfirma_Password_Cliente").val();

    if(sbNombre.length == 0){
    	bolControl=false;
    	//sbMensaje += "-Ingrese Nombre ";
    }
    
    if(sbApellido.length == 0){
    	bolControl=false;
    	//sbMensaje += "-Ingrese Apellidos ";
    }
    
    if(sbDNI.length == 0){
    	bolControl=false;
    	//sbMensaje += "-Ingrese DNI ";
    	sbMensaje += "-Debe seleccionar un Cliente de la lista! ";
    }
    
    if(sbEmail.length == 0){
    	bolControl=false;
    	//sbMensaje += "-Ingrese Email ";
    }
    
    if(sbCiudad.length == 0){
    	bolControl=false;
    	//sbMensaje += "-Ingrese Ciudad ";
    }
    
    if(sbUsuario.length == 0){
    	bolControl=false;
    	//sbMensaje += "-Ingrese Nombre Usuario ";
    }
    
    
    if(sbClave.length == 0){
    	bolControl=false;
    	//sbMensaje += "-Ingrese Clave ";
    }
    
    
    if(sbIdRol=="0"){
    	bolControl=false;
    	//sbMensaje += "-Seleccione un Rol ";
    }
    
    
    if(sbClave != sbComparePassword){
    	bolControl=false;
    	sbMensaje += "-La clave y la confirmaci\xf3n no coinciden! ";
    }
    
    if(bolControl){
    	
    	if(Cambio_Campos_Cliente()){//if(Cambio_Campos())
	    				 
	    	$.ajax({ //  $.ajax registro perfil
	    		type: "POST",
	    		url:  "Controller/php/apiProfile.php",
	    		dataType: "html",
	    		data: "action=UpdProfiles" +
	    		"&idPerfil="+objProfile.IdPerfil+"&idRol="+sbIdRol+"&sbUsuario="+sbUsuario+"&sbClave="+sbClave,
	
	
	    		success: function(updProfile){	
	    			
	    			if(updProfile == "0"){
	    				$.ajax({ //  $.ajax registro cliente
		    				type: "POST",
		    				url:  "Controller/php/apiClientes.php",
		    				dataType: "html",
		    				data: "action=UpdCliente" +
		    				"&idCliente="+objCustomer.IdCliente+"&idPerfil="+objCustomer.IdPerfil+"&sbNombre="+sbNombre+"&sbApellido="+sbApellido+"&sbDNI="+sbDNI+"&sbCelular="+sbCel+"&sbFijo="+sbFijo+"&sbEmail="+sbEmail+"&sbGenero="+sbGenero+"&sbCiudad="+sbCiudad,
		
		
		    				success: function(DataCliente){	
		
		    					if(DataCliente == "Actualizacion Exitosa!"){
		    						Lista_Clientes();
		    					}
		    					alert(DataCliente);
		    				}
		
		    			});//  $.ajax registro cliente
	    			}
	    			else//if(updProfile == "0")
	    			{
	    				alert(updProfile);	    				
	    			}//if(updProfile == "0")	

	    		}
	    	});//  $.ajax registro perfil
        }//if(Cambio_Campos()){
    	else
    	{
    	   alert("No se detectan cambios en los campos!")	
    	}//if(Cambio_Campos()){
    }//if(bolControl)
    else
    {
    	alert(sbMensaje);
    }//if(bolControl)
});

function Cambio_Campos_Cliente(){
	var bolControl = false;

	//Datos Cliente
    var sbNombre=$("#txtNombre_Cliente").val();
    var sbApellido=$("#txtApellido_Cliente").val(); 
    var sbDNI=$("#txtDNI_Cliente").val();
    var sbCel=$("#txtCel_Cliente").val(); 
    var sbFijo=$("#txtFijo_Cliente").val(); 
    var sbEmail=$("#txtEmail_Cliente").val();
    var sbCiudad=$("#txtCiudad_Cliente").val();
    sbGenero=$('input:radio[name=Sex]:checked').val();

    
    //Datos Perfil
    var sbIdRol=$("#cmbRol").val();
    var sbUsuario=$("#txtUsername_Cliente").val(); 
    var sbClave=$("#txtPassword_Cliente").val();
    var sbComparePassword=$("#txtConfirma_Password_Cliente").val();
    
    
    if(sbNombre != objCustomer.Nombre){
    	bolControl = true;
    }else
    if(sbApellido != objCustomer.Apellido){
    	bolControl = true;
    }else
    if(sbDNI != objCustomer.DNI){
    	bolControl = true;
    }else
    if(sbCel != objCustomer.Celular){
    	bolControl = true;
    }else 
    if(sbFijo != objCustomer.Fijo){
    	bolControl = true;
    }else
    if(sbEmail != objCustomer.Email){
    	bolControl = true;
    }else
    if(sbCiudad != objCustomer.Ciudad){
        	bolControl = true;
    }else
    if(sbGenero != objCustomer.Genero){
    	bolControl = true;
    }else
    if(sbUsuario != objProfile.Usuario){
    	bolControl = true;
    }else
    if(sbClave != objProfile.Clave){
    	bolControl = true;
    }else
    if(sbComparePassword != objProfile.Clave){
    	bolControl = true;
    }else
    if(sbIdRol != objProfile.IdRol){
    	bolControl = true;
    }else{
    	bolControl = false;
    }
    
    
    return bolControl;
}

$(document).delegate('#btnDelCliente','click',function(){
	var bolControl = true;
	var sbMensaje = " ";
	//Datos Cliente
    var sbDNI=$("#txtDNI_Cliente").val();

    //Datos Perfil
    var sbUsuario=$("#txtUsername_Cliente").val(); 
    
    if(sbDNI.length == 0){
    	bolControl=false;
    }
        
    if(sbUsuario.length == 0){
    	bolControl=false;
    }

    if(bolControl){

		$.ajax({ //  $.ajax Inactivar Usuario
			type: "POST",
			url:  "Controller/php/apiClientes.php",
			dataType: "html",
			data: "action=InactiveCliente"+
			"&sbDNI="+objCustomer.DNI,
					  		
			success: function(DataCliente){
				if(DataCliente == "Proceso Exitoso!"){
					///Lista_Clientes();
				}
				alert(DataCliente);
			}
	
		});//  $.ajax Inactivar Usuario
	
    }//if(bolControl)
    else
    {
    	sbMensaje += "-Debe seleccionar un Cliente de la lista! ";
    	alert(sbMensaje);
    }//if(bolControl)
});



$(document).delegate('#txtDNI_Cliente','focusout',function()
{
			if($('#txtDNI_Cliente').is('[readonly]'))//Chekea si la propiedad es Read Only para que no busque si existe al perder el foco
				return;


			var sbValue = $("#txtDNI_Cliente").val();
			if( sbValue != '')
			{
				$("#cargando").show();

				$.ajax
				({ 
						type	: 	"POST",
						url		:	"Controller/php/apiClientes.php",
						dataType:	"html",
						data	:	"action=GetClienteDNI"+ 
							        "&sbDNI="+sbValue ,
							        
						success	:	function(DataCustomer)
			 			{	
							objCustomer = jQuery.parseJSON(DataCustomer);
							if(objCustomer.IdCliente == "00")
							{
								(document.getElementById("cargando")).style.display="none";
								return;
							}
							
							SetToViewClient();

							//ClientSeleccionado = objCustomer[0];
							//Datos Perfil
							$.ajax({ //  $.ajax Datos Perfil
								type: "POST",
								url:  "Controller/php/apiProfile.php",
								dataType: "html",
								data: "action=GetProfilesCustomer"+
								"&idPerfil="+objCustomer.IdPerfil,
										  		
								success: function(DataPerfil){
									
									objProfile = jQuery.parseJSON(DataPerfil);					
								    $("#txtUsername_Cliente").val(objProfile.Usuario); 
								    $("#txtPassword_Cliente").val(objProfile.Clave);
								    $("#txtConfirma_Password_Cliente").val(objProfile.Clave);
								    $("#cmbRol").val(objProfile.IdRol);
								    
								    //ReadOnly User
									$('#txtUsername_Cliente').prop('readonly', true);
									
									//Activa Boton Nuevo
									//$( "#btnNewCliente" ).prop( "disabled", false );


									(document.getElementById("cargando")).style.display="none";
				        			
								}
							});//  $.ajax Datos Perfil
						}
				});
			}	
});



function SetToViewClient()
{

	$("#txtUsername_Cliente").val("");
	$("#txtPassword_Cliente").val("");
    $("#txtConfirma_Password_Cliente").val("");

	//if(objCustomer != null && objCustomer[0] != null)
    if(objCustomer != null)
	{

		ClientSeleccionado = objCustomer;

		$("#txtNombre_Cliente").val(ClientSeleccionado.Nombre);
		$("#txtApellido_Cliente").val(ClientSeleccionado.Apellido);
		$("#txtDNI_Cliente").val(ClientSeleccionado.DNI);
		$("#txtCel_Cliente").val(ClientSeleccionado.Celular);
		$("#txtFijo_Cliente").val(ClientSeleccionado.Fijo);
		$("#txtEmail_Cliente").val(ClientSeleccionado.Email);

		if(ClientSeleccionado.Genero != "F")
		{
			$("#rbMasculino").prop("checked", true);
			$("#rbFemenino").prop("checked", false);	
		}
		else
		{
			$("#rbFemenino").prop("checked", true);
			$("#rbMasculino").prop("checked", false);
		}

		$('#txtDNI_Cliente').prop('readonly', true);
		
		$( "#btnSaveCliente" ).prop( "disabled", true );
		$( "#btnUpdCliente" ).prop( "disabled", false );
		$( "#btnDelCliente" ).prop( "disabled", false );
	}
	else
	{
		$("#txtNombre_Cliente").val("");
		$("#txtApellido_Cliente").val("");
		$("#txtDNI_Cliente").val("");
		$("#txtCel_Cliente").val("");
		$("#txtFijo_Cliente").val("");
		$("#txtEmail_Cliente").val("");

		$("#rbMasculino").prop("checked", false);
		$("#rbFemenino").prop("checked", false);
		
		$('#txtDNI_Cliente').prop('readonly', false);
		$('#txtUsername_Cliente').prop('readonly', false);
		$("#txtDNI_Cliente").focus();
		$( "#btnSaveCliente" ).prop( "disabled", false );
		$( "#btnUpdCliente" ).prop( "disabled", true );
		$( "#btnDelCliente" ).prop( "disabled", true );

	}
}
