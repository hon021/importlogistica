var ObEmpleado; //Array 
var EmpSeleccionado ;	//Seleccionado
var objProfile;
var ListEmpleados;

$(document).delegate('#btnClear', 'click', function()
{

	$("#Lista-Empleados").empty();
	AddToListEmp(ListEmpleados);
});

$(document).delegate('#txtBuscar', 'keyup', function()
{
	var str = this.value.toUpperCase();
	var flag = false;
	for (var i = ListEmpleados.length - 1; i >= 0; i--) 
	{
		if(str.search($.trim(ListEmpleados[i].Nombre.toUpperCase())) != '-1' || str.search($.trim(ListEmpleados[i].Apellido.toUpperCase())) != '-1') 
		{
			flag = true;
		}
	};

	if(flag)
	{
		$("#Lista-Empleados").empty();
		for (var i = ListEmpleados.length - 1; i >= 0; i--) 
		{
			if(str.search($.trim(ListEmpleados[i].Nombre.toUpperCase())) != '-1' || str.search($.trim(ListEmpleados[i].Apellido.toUpperCase())) != '-1') 
			{
				AddToListEmpOne(ListEmpleados[i]);
			}
		};
	}
	else 
	{
		$("#Lista-Empleados").empty();
		AddToListEmp(ListEmpleados);
	}
});

$(document).delegate('#txtUsername_Cliente','focusout',function()
{
	if($('#txtUsername_Cliente').is('[readonly]'))
		return;
	var sbValue = $("#txtUsername_Cliente").val();

	if(sbValue == '')
		return;
	
	$("#cargando").show();
	$.ajax(
	{ //  $.ajax Nombre Usuario
    		type: "POST",
    		url:  "Controller/php/apiProfile.php",
    		dataType: "html",
    		data: "action=GetUser"+
    		"&sbUsuario="+sbValue,
    				  		
    		success: function(DataUser)
    		{
    			(document.getElementById("cargando")).style.display="none";
    			if(DataUser != "0")
    			{
					alert("-Ya exite el nombre usuario! ");
					$("#txtUsername_Cliente").val("");
    			}
    		}
	});
});

$(document).delegate('#txtEmpDNI','focusout',function()
{
	if($('#txtEmpDNI').is('[readonly]'))//Chekea si la propiedad es Read Only para que no busque si existe al perder el foco
		return;


	var sbValue = $("#txtEmpDNI").val();
	if( sbValue != '')
	{
		$("#cargando").show();

		$.ajax
		({ 
				type	: 	"POST",
				url		:	"Controller/php/apiEmpleado.php",
				dataType:	"html",
				data	:	"action=GetEmployeeById&sbID=" +sbValue ,			
				success	:	function(DataEmployees)
	 			{	
					ObEmpleado = jQuery.parseJSON(DataEmployees);
					if(ObEmpleado.IdEmpleado == "00")
					{
						(document.getElementById("cargando")).style.display="none";
						return;
					}
					SetToView();

					EmpSeleccionado = ObEmpleado[0];
					//Datos Perfil
					$.ajax({ //  $.ajax Datos Perfil
						type: "POST",
						url:  "Controller/php/apiProfile.php",
						dataType: "html",
						data: "action=GetProfilesCustomer"+
						"&idPerfil="+ObEmpleado[0].IdPerfil,
								  		
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


$(document).delegate('#btnDelEmployee','click',function()
{
	if(EmpSeleccionado != null)
	{
		$("#cargando").show();
				
		$.ajax({ //  $.ajax Inactivar Usuario
			type: "POST",
			url:  "Controller/php/apiEmpleado.php",
			dataType: "html",
			data: "action=InactiveEmpleado"+
			"&sbDNI="+EmpSeleccionado.DNI,
					  		
			success: function(DataEmpleado)
			{
				document.getElementById("cargando").style.display="none";
				alert(DataEmpleado);
			}
	
		});//  $.ajax Inactivar Usuario
	} 	
});

$(document).delegate('#Empleado-Seleccionado','click',function()
{
	var sbValue = this.name;

	$("#cargando").show();

	$.ajax
	({ 
			type	: 	"POST",
			url		:	"Controller/php/apiEmpleado.php",
			dataType:	"html",
			data	:	"action=GetEmployeeById&sbID=" +sbValue ,			
			success	:	function(DataEmployees)
 			{	
				ObEmpleado = jQuery.parseJSON(DataEmployees);
				SetToView();

				EmpSeleccionado = ObEmpleado[0];
				
				if(EmpSeleccionado.Estado == 0)
				{
					alert("Usuario Inactivo");
					$( "#btnNewCliente" ).prop( "disabled", false );
					$('#txtUsername_Cliente').prop('readonly', true);
					$('#txtPassword_Cliente').prop('readonly', true);
					$('#txtConfirma_Password_Cliente').prop('readonly', true);
					$('#cmbRol').prop('readonly', true);
					(document.getElementById("cargando")).style.display="none";
					return;
				}
				//Datos Perfil
				$.ajax({ //  $.ajax Datos Perfil
					type: "POST",
					url:  "Controller/php/apiProfile.php",
					dataType: "html",
					data: "action=GetProfilesCustomer"+
					"&idPerfil="+ObEmpleado[0].IdPerfil,
							  		
					success: function(DataPerfil)
					{
						
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
	});
});

$(document).delegate('#btnNewEmployee','click', function()
{
	Lista_Empleados();
});

$(document).delegate('#btnSaveEmployee','click', function()
{
	try	
	{
		var sbEmpleado = JSON.stringify(
		{
			Nombre		: $("#txtEmpNombre").val(),
			Apellido	: $("#txtEmpApellido").val(),
			DNI			: $("#txtEmpDNI").val(),
			Celular 	: $("#txtEmpCel").val(),
			Fijo		: $("#txtEmpFijo").val(),
			Email		: $("#txtEmpEmail").val(),
			Sex 		: $('input:radio[name=Sex]:checked').val(),
			Cargo 		: $("#txtEmpCargo").val(),
			IdRol 		: $("#cmbRol").val(),
			sbUsuario	: $("#txtUsername_Cliente").val(),
			sbClave 	: $("#txtPassword_Cliente").val(),
    		sbComparePassword : $("#txtConfirma_Password_Cliente").val()
		});
 
		sbEmpleado = JSON.parse(sbEmpleado);

		if(itsEmployeeCompleted(sbEmpleado))
		{
			return;
		}
	}
	catch(err)
	{
		alert(err);
	}
		$("#cargando").show();
		(document.getElementById("cargando")).style.display="none";
		//Buscar Nombre Usuario
    	$.ajax(
    	{ //  $.ajax Nombre Usuario
    		type: "POST",
    		url:  "Controller/php/apiProfile.php",
    		dataType: "html",
    		data: "action=GetUser"+
    		"&sbUsuario="+sbEmpleado.sbUsuario,
			
			success: function(DataUser)
				{
					(document.getElementById("cargando")).style.display="none";

	    			if(DataUser == "0")
	    			{//if(DataUser == "0")
	    				$("#cargando").show(); 
	    				$.ajax(
	    				{ //  $.ajax registro perfil
	    				 		type: "POST",
	    				 		url:  "Controller/php/apiProfile.php",
	    				 		dataType: "html",
	    				 		data: "action=RegProfiles" +
	    				 		  	  "&idRol="+sbEmpleado.IdRol+"&sbUsuario="+sbEmpleado.sbUsuario+"&sbClave="+sbEmpleado.sbClave,

    				 		  	  success: function(sbIdPerfil)
    				 		  	  {
    				 		  	  		(document.getElementById("cargando")).style.display="none";
    				 		  	  		$("#cargando").show(); 
    				 		  	  		$.ajax(
										{
											type: 		"POST",
											url: 		"Controller/php/apiEmpleado.php",
											dataType: 	"html",
											data: 		"action=RegEmpleados"
													+ "&sbNombre="+sbEmpleado.Nombre
													+ "&sbApellido="+sbEmpleado.Apellido
													+ "&sbDNI="+sbEmpleado.DNI
													+ "&sbCelular="+sbEmpleado.Celular
													+ "&sbFijo="+sbEmpleado.Fijo
													+ "&sbEmail="+sbEmpleado.Email
													+ "&sbSexo="+sbEmpleado.Sex
													+ "&sbCargo="+sbEmpleado.Cargo
													+ "&sbPerfil="+sbIdPerfil,

											success: function(DataEmpleados)
												{
													(document.getElementById("cargando")).style.display="none";
													
													if(DataEmpleados == "Registro Exitoso!")
													{
														Lista_Empleados();
													}
													alert(DataEmpleados);
												}
										});
    				 		  	  }	
    				 	});
	    			}
	    			else 
	    			{
	    				alert("-Ya exite el nombre usuario! ");
	    			}
		    	}
		}); 				 	          
		 
});


$(document).delegate('#btnUpdEmployee','click',function()
{
	try	
	{
		var sbEmpleado = JSON.stringify(
		{
			Nombre		: $("#txtEmpNombre").val(),
			Apellido	: $("#txtEmpApellido").val(),
			DNI			: $("#txtEmpDNI").val(),
			Celular 	: $("#txtEmpCel").val(),
			Fijo		: $("#txtEmpFijo").val(),
			Email		: $("#txtEmpEmail").val(),
			Sex 		: $('input:radio[name=Sex]:checked').val(),
			Cargo 		: $("#txtEmpCargo").val(),
			IdRol 		: $("#cmbRol").val(),
			sbUsuario	: $("#txtUsername_Cliente").val(),
			sbClave 	: $("#txtPassword_Cliente").val(),
    		sbComparePassword : $("#txtConfirma_Password_Cliente").val()
		});
 
		sbEmpleado = JSON.parse(sbEmpleado);

		if(itsEmployeeCompleted(sbEmpleado))
		{
			return;
		}
	}
	catch(err)
	{
		alert(err);
	}
	 

	if(Cambio_Campos(sbEmpleado))
	{//if(Cambio_Campos())
    				 
    	$("#cargando").show(); 

    	$.ajax(
    	{ //  $.ajax registro perfil
    		type: "POST",
    		url:  "Controller/php/apiProfile.php",
    		dataType: "html",
    		data: "action=UpdProfiles" +
    		"&idPerfil="+objProfile.IdPerfil+"&idRol="+sbEmpleado.IdRol+"&sbUsuario="+sbEmpleado.sbUsuario+"&sbClave="+sbEmpleado.sbClave,

    		success: function(updProfile)
    		{	
    			document.getElementById("cargando").style.display="none";
    			if(updProfile == "0")
    			{
    				$("#cargando").show(); 
    				$.ajax(
    				{ //  $.ajax registro cliente
	    				type: 		"POST",
	    				url:  		"Controller/php/apiEmpleado.php",
	    				dataType: 	"html",
	    				data: 		"action=UpdtEmpleado"
									+ "&sbNombre="+sbEmpleado.Nombre
									+ "&sbApellido="+sbEmpleado.Apellido
									+ "&sbDNI="+sbEmpleado.DNI
									+ "&sbCelular="+sbEmpleado.Celular
									+ "&sbFijo="+sbEmpleado.Fijo
									+ "&sbEmail="+sbEmpleado.Email
									+ "&sbSexo="+sbEmpleado.Sex
									+ "&sbCargo="+sbEmpleado.Cargo
									+ "&sbPerfil="+objProfile.IdPerfil,

						success: function(DataEmpleados)
							{
								document.getElementById("cargando").style.display="none";
								
								if(DataEmpleados == "Actualizacion Exitosa!")
								{
									Lista_Empleados();
								}
								
								alert(DataEmpleados);
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
    
});


function Lista_Empleados()
{
	$("#cargando").show();
	ObEmpleado = null;
	EmpSeleccionado = null;
	objProfile = null;
	jQuery("input[type='text']").prop("disabled", true);
	jQuery("button").prop("disabled", true);
	$.ajax(				
		{
			type	: 	"POST",
			url		:	"Controller/php/apiEmpleado.php",
			dataType:	"html",
			data	:	"action=GetEmployee",			
			success	:	function(DataEmployees)
			{
				var Employee = jQuery.parseJSON(DataEmployees);
				ListEmpleados = Employee;
				$("#Lista-Empleados").empty();

				AddToListEmp(ListEmpleados);
				$("#txtEmpDNI").focus();

				jQuery("input[type='text']").prop("disabled", false);
				jQuery("button").prop("disabled", false);
				/*$( "#btnNewCliente" ).prop( "disabled", true );
				$("#txtNombre_Cliente").focus();*/
				$("#txtEmpDNI").focus();
				SetToView()

			
				document.getElementById("cargando").style.display="none";
			}
	   });
}

function AddToListEmpOne(Employee)
{
	if(Employee.Genero == "F")
	{
		$sbImg="<img src='View/images/user_female.png' class = 'icon' />";
	}else{
		$sbImg="<img src='View/images/user_male.png' class = 'icon' /> ";
	}

	$("#Lista-Empleados").append
	(
		"<a class='list' id='Empleado-Seleccionado' name = '"+Employee.DNI+"'>"+
		"			<div class='list-content' >"+
		$sbImg+
		"				<div class='data' >"+
		"					<span class ='list-title'> "+Employee.Nombre+" "+Employee.Apellido+"</span> "+
		"					<span id='EmpDNI' class ='list-title'> DNI: "+Employee.DNI+"</span> "+
		"				</div>"+
		"			</div>"+
		"</a>"
	);
}
 
function AddToListEmp(ListEmpleados)
{
	$.each(ListEmpleados, function(i, item)					
				{
					if(i>= 0)
					{
						if(ListEmpleados[i].Genero == "F"){
							$sbImg="<img src='View/images/user_female.png' class = 'icon' />";
						}else{
							$sbImg="<img src='View/images/user_male.png' class = 'icon' /> ";
						}

						$("#Lista-Empleados").append
						(
							"<a class='list' id='Empleado-Seleccionado' name = '"+ListEmpleados[i].DNI+"'>"+
							"			<div class='list-content' >"+
							$sbImg+
							"				<div class='data' >"+
							"					<span class ='list-title'> "+ListEmpleados[i].Nombre+" "+ListEmpleados[i].Apellido+"</span> "+
							"					<span id='EmpDNI' class ='list-title'> DNI: "+ListEmpleados[i].DNI+"</span> "+
							"				</div>"+
							"			</div>"+
							"</a>"
						);
					}
				});
}

function Cambio_Campos(sbEmpleado)
{
	var bolControl = false;

    if(sbEmpleado.sbNombre != EmpSeleccionado.Nombre){
    	bolControl = true;
    }else
    if(sbEmpleado.sbApellido != EmpSeleccionado.Apellido){
    	bolControl = true;
    }else
    if(sbEmpleado.sbDNI != EmpSeleccionado.DNI){
    	bolControl = true;
    }else
    if(sbEmpleado.sbCel != EmpSeleccionado.Celular){
    	bolControl = true;
    }else 
    if(sbEmpleado.sbFijo != EmpSeleccionado.Fijo){
    	bolControl = true;
    }else
    if(sbEmpleado.sbEmail != EmpSeleccionado.Email){
    	bolControl = true;
    }else
    if(sbEmpleado.sbGenero != EmpSeleccionado.Genero){
    	bolControl = true;
    }else
    if(sbEmpleado.sbUsuario != objProfile.Usuario){
    	bolControl = true;
    }else
    if(sbEmpleado.sbClave != objProfile.Clave){
    	bolControl = true;
    }else
    if(sbEmpleado.sbComparePassword != objProfile.Clave){
    	bolControl = true;
    }else
    if(sbEmpleado.sbIdRol != objProfile.IdRol){
    	bolControl = true;
    }else{
    	bolControl = false;
    }
    
    return bolControl;
}

function itsEmployeeCompleted(sbEmpleado)
{
	if(sbEmpleado.Nombre.length == 0)
	{
		alert("-Ingrese Nombre");
		return true;
	}
	if(sbEmpleado.Apellido.length == 0)
	{
		alert("-Ingrese Apellido");
		return true;
	}
	if(sbEmpleado.DNI.length == 0)
	{
		alert("-Ingres Numero DNI");
		return true;
	}
	/*if(sbEmpleado.Celular.length == 0)
	{
		alert("Ingrese Telefono Celular");
		return true;
	}*/
	/*if(sbEmpleado.Fijo.length == 0)
	{
		alert("Ingrese Telefono Fijo");
		return true;
	}*/
	/*if(sbEmpleado.Email.length == 0)
	{
		alert("Ingrese un Correo Electronico");
		return true;
	}*/
	if(sbEmpleado.Sex.length == 0)
	{
		alert("-Seleccione un Sexo");
		return true;
	}
	if(sbEmpleado.Cargo.length == 0)
	{
		alert("-Ingrese un Cargo");
		return true;
	}
	
	if(sbEmpleado.sbUsuario.length == 0)
	{
		alert("-Ingrese un Usuario");
		return true;
	}
	
	if(sbEmpleado.sbClave.length == 0)
	{
		alert("-Ingrese una Clave");
		return true;
	}
	
	
	if(sbEmpleado.IdRol == "0")
	{
		alert("-Seleccione un Rol ");
		return true;
	}
	
	
	
    if(sbEmpleado.sbClave != sbEmpleado.sbComparePassword)
    {
    	alert("Las claves no coinciden! ");
    	return true;
    }
 
	return false;
}

function SetToView()
{

	$("#txtUsername_Cliente").val("");
	$("#txtPassword_Cliente").val("");
    $("#txtConfirma_Password_Cliente").val("");

	if(ObEmpleado != null && ObEmpleado[0] != null)
	{

		EmpSeleccionado = ObEmpleado[0];

		$("#txtEmpNombre").val(EmpSeleccionado.Nombre);
		$("#txtEmpApellido").val(EmpSeleccionado.Apellido);
		$("#txtEmpDNI").val(EmpSeleccionado.DNI);
		$("#txtEmpCel").val(EmpSeleccionado.Celular);
		$("#txtEmpFijo").val(EmpSeleccionado.Fijo);
		$("#txtEmpEmail").val(EmpSeleccionado.Email);
		$("#txtEmpCargo").val(EmpSeleccionado.Cargo);

		if(EmpSeleccionado.Genero != "F")
		{
			$("#rbEmpMasculino").prop("checked", true);
			$("#rbEmpFemenino").prop("checked", false);	
		}
		else
		{
			$("#rbEmpFemenino").prop("checked", true);
			$("#rbEmpMasculino").prop("checked", false);
		}

		$('#txtEmpDNI').prop('readonly', true);
		
		$( "#btnSaveEmployee" ).prop( "disabled", true );
		$( "#btnUpdEmployee" ).prop( "disabled", false );
		$( "#btnDelEmployee" ).prop( "disabled", false );
	}
	else
	{
		$("#txtEmpNombre").val("");
		$("#txtEmpApellido").val("");
		$("#txtEmpDNI").val("");
		$("#txtEmpCel").val("");
		$("#txtEmpFijo").val("");
		$("#txtEmpEmail").val("");
		$("#txtEmpCargo").val("");

		$("#rbEmpMasculino").prop("checked", false);
		$("#rbEmpFemenino").prop("checked", false);
		
		$('#txtEmpDNI').prop('readonly', false);
		$('#txtUsername_Cliente').prop('readonly', false);
		$("#txtEmpDNI").focus();
		$( "#btnSaveEmployee" ).prop( "disabled", false );
		$( "#btnUpdEmployee" ).prop( "disabled", true );
		$( "#btnDelEmployee" ).prop( "disabled", true );

		

	}
}
