var objEnvio;
var EnvioSeleccionado;
var ListEnvio;

function OnLoseFocus_Envio(value)
{
	//alert(value);
	if(value > 0)
	{
		$("#Lista-envio").empty();
		for (var i = ListEnvio.length - 1; i >= 0; i--) 
		{
			if(ListEnvio[i].IdMercancia == value)
			{
				AddToListEnvioOne(ListEnvio[i]);
			}
		};
	}
	else 
	{
		AddToListEnvio(ListEnvio);
	}

}

$(document).delegate('#btnDelEnvio','click',function()
{
	if(EnvioSeleccionado != null)
	{
		$("#cargando").show();
				
		$.ajax({ //  $.ajax Inactivar Envio
			type: "POST",
			url:  "Controller/php/apiEnvio.php",
			dataType: "html",
			data: "action=InactiveEnvio"+
			"&sbIdEnvio="+EnvioSeleccionado.IdEnvios,
					  		
			success: function(DataEnvio)
			{
				document.getElementById("cargando").style.display="none";
				alert(DataEnvio);
				Lista_Envio();
			}
	
		});//  $.ajax Inactivar Envio
	} 	
	
});

$(document).delegate('#btnUpdEnvio','click', function()
{
	try	
	{
		if(EnvioSeleccionado == null)
			return;
		
		var sbEnvioUpdate = JSON.stringify
		({
			sbIdEnvios 		: EnvioSeleccionado.IdEnvios,
			Mercancia		: $("#cmbMercancia_Envio").val(),
			Contenedor		: $("#cmbContenedor_Envio").val(),
			FechaEnvio		: $("#dateEnvio").val(),
			NoCaja      	: $("#txtNro_Cajas_Envios").val()
		});
		
		sbEnvioUpdate = JSON.parse(sbEnvioUpdate);
		if(EnvioCompletado(sbEnvioUpdate))
			return;
	}
	catch(err)
	{
		alert(err);
	}
	$("#cargando").show();

	$.ajax(
	{
		type: 		"POST",
		url: 		"Controller/php/apiEnvio.php",
		dataType: 	"html",
		data: 		"action=UpdtEnvio"
				+ "&sbMercancia="+sbEnvioUpdate.Mercancia
				+ "&sbContenedor="+sbEnvioUpdate.Contenedor
				+ "&dtFechaEnvio="+sbEnvioUpdate.FechaEnvio
				+ "&NroCajas="+sbEnvioUpdate.NoCaja
				+ "&sbIdEnvio="+sbEnvioUpdate.sbIdEnvios,

		success: function(DataEnvio)
			{
				try
				{
					(document.getElementById("cargando")).style.display="none";
					
					if(DataEnvio == "Actualizacion Exitosa!")
					{
						Lista_Envio();
					}
					alert(DataEnvio);
				}
				catch(err)
				{
					alert(err);
				}
			}
	});
});

$(document).delegate('#btnSaveEnvio','click', function()
{
	try	
	{
		var sbEnvio = JSON.stringify(
		{
			Mercancia		: $("#cmbMercancia_Envio").val(),
			Contenedor		: $("#cmbMercancia_Envio").val(),
			FechaEnvio		: $("#dateEnvio").val(),
			NoCaja      	: $("#txtNro_Cajas_Envios").val()
		});
 
		sbEnvio = JSON.parse(sbEnvio);

		if(EnvioCompletado(sbEnvio))
			return;
	}
	catch(err)
	{
		alert(err);
	}
	$("#cargando").show();

	$.ajax(
	{
		type: 		"POST",
		url: 		"Controller/php/apiEnvio.php",
		dataType: 	"html",
		data: 		"action=RegEnvio"
				+ "&sbMercancia="+sbEnvio.Mercancia
				+ "&sbContenedor="+sbEnvio.Contenedor
				+ "&dtFechaEnvio="+sbEnvio.FechaEnvio
				+ "&NroCajas="+sbEnvio.NoCaja,

		success: function(DataEnvio)
			{
				try
				{
					(document.getElementById("cargando")).style.display="none";
					
					if(DataEnvio == "Registro Exitoso!")
					{
						Lista_Envio();
					}
					alert(DataEnvio);
				}
				catch(err)
				{
					alert(err);
				}
				}
	});
});



$(document).delegate('#Elemento-envio','click', function()
{
	var sbValue = this.name;

	$("#cargando").show();

	$.ajax
	({ 
			type	: 	"POST",
			url		:	"Controller/php/apiEnvio.php",
			dataType:	"html",
			data	:	"action=GetEnvioById&sbIdEnvio=" +sbValue ,			
			success	:	function(DataEnvio)
 			{	
				try {
					objEnvio = jQuery.parseJSON(DataEnvio);
				}
				catch(err)
				{
					document.getElementById("cargando").style.display="none";
					alert("Se ha producido un error al intentar cargar la información. \n\n El siguiente es un mensaje tecnico: "+err.message+" \n "+DataEnvio+"");
					return;
				}
				
				SetToViewEnvio();

				EnvioSeleccionado = objEnvio[1];
				document.getElementById("cargando").style.display="none";
			}
	});
});

$(document).delegate('#btnNewEnvio','click', function()
{
	Lista_Envio();
});

function Lista_Envio()
{	  
	$("#cargando").show();
	
	objEnvio = null;
	EnvioSeleccionado = null;
	ListEnvio = null;
	$("#Lista-envio").empty();
	SetToViewEnvio();
	
	//jQuery("input[type='text']").prop("disabled", true);
	//jQuery("button").prop("disabled", true);
	
	//envio
	$.ajax({ //  $.ajax envio
		type: "POST",
		url:  "Controller/php/apiEnvio.php",
		dataType: "html",
		data: "action=GetEnvios",
				  		
		success: function(DataShipping){	
					  
			var Envio = jQuery.parseJSON(DataShipping);

			ListEnvio = Envio;
			AddToListEnvio(ListEnvio);
			
			$( "#btnNewEnvio" ).prop( "disabled", false );
			$( "#cmbMercancia_Envio" ).focus();

			loadDateShipping();
			document.getElementById("cargando").style.display="none";
		}
	});//  $.ajax envio
}

function AddToListEnvio(ListEnvio)
{
	$.each(ListEnvio, function(i,item) 
	{	
		if( i > 0)
		{

			$("#Lista-envio").append(
			"<a class='list' id ='Elemento-envio' name = '"+ListEnvio[i].IdEnvios+"'>"+
			"			<div class='list-content' >"+
			"               <img src='View/images/shipping.png' class = 'icon'>"+
			"				<div class='data'>"+
			"					<span class ='list-title' id = 'idEnvio"+ListEnvio[i].IdEnvios+"'>Cajas Enviadas: "+ListEnvio[i].Nocajas+"</span> "+
			"				</div>"+
			"			</div>"+
			"</a>");	
	    }
	});
}

function AddToListEnvioOne(Obj)
{
	$("#Lista-caja").append(
			"<a class='list' id ='Elemento-envio' name = '"+Obj.IdEnvios+"'>"+
			"			<div class='list-content' >"+
			"               <img src='View/images/shipping.png' class = 'icon'>"+
			"				<div class='data'>"+
			"					<span class ='list-title' id = 'idEnvio"+Obj.IdEnvios+"'>Cajas Enviadas:"+Obj.Nocajas+"</span> "+
			"				</div>"+
			"			</div>"+
			"</a>");	
}


function SetToViewEnvio()
{
	if(objEnvio != null && objEnvio[1] != null)
	{
		EnvioSeleccionado = objEnvio[1];
		$("#cmbMercancia_Envio").val(EnvioSeleccionado.IdMercancia);
		$("#cmbContenedor_Envio").val(EnvioSeleccionado.IdContenedor);
		$("#txtNro_Cajas_Envios").val(EnvioSeleccionado.Nocajas);
		$("#dateEnvio").val(EnvioSeleccionado.FechaEnvio)
		
		$( "#btnSaveEnvio" ).prop( "disabled", true );
		$( "#btnUpdEnvio" ).prop( "disabled", false );
		$( "#btnDelEnvio" ).prop( "disabled", false );
	}
	else 
	{
		$("#txtNro_Cajas_Envios").val("");

		$("#cmbMercancia_Envio").val("");
		$("#cmbMercancia_Envio option[value=0]").attr("selected",true);
		$("#cmbContenedor_Envio").val("");
		$("#cmbContenedor_Envio option[value=0]").attr("selected",true);

		//$("#cmbMercancia_Envio").val("");
		//$("#cmbContenedor_Envio").val("")

		$( "#btnSaveEnvio" ).prop( "disabled", false );
		$( "#btnUpdEnvio" ).prop( "disabled", true );
		$( "#btnDelEnvio" ).prop( "disabled", true );

		//$("#cmbMercancia_Envio option[value=0]").attr("selected",true);
		//$("#cmbContenedor_Envio option[value=0]").attr("selected",true);


	}
}
function EnvioCompletado(sbEnvio)
{
	if(sbEnvio.Mercancia <= 0)
	{
		alert("Seleccione Mercancia");
		return true;
	}
	if(sbEnvio.Contenedor <= 0)
	{
		alert("Seleccione Contenedor");
		return true;
	}
	if(sbEnvio.NoCaja.length == 0)
	{
		alert("Ingrese Numero de Cajas a Enviar");
		return true;
	}

	return false;
}

function loadDateShipping(){
	
	$("#calendarFechaEnvio").datepicker({
		format: "yyyy-mm-dd", // set output format
		effect: "slide", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: "en"
	});
	$("#dateEnvio").val(getFecha());
}