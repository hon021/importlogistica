var obCaja;
var CajaSeleccionada;
var ListCaja;

function OnLoseFocus(value)
{
	//alert(value);
	if(value > 0)
	{
		$("#Lista-caja").empty();
		for (var i = ListCaja.length - 1; i >= 0; i--) 
		{
			if(ListCaja[i].IdMercancia == value)
			{
				AddToListCajaOne(ListCaja[i]);
			}
		};
	}
	else 
	{
		AddToListCaja(ListCaja);
	}

}

$(document).delegate('#btnDelCaja','click',function()
{
	if(CajaSeleccionada != null)
	{
		$("#cargando").show();
				
		$.ajax({ //  $.ajax Inactivar Usuario
			type: "POST",
			url:  "Controller/php/apiCaja.php",
			dataType: "html",
			data: "action=InactiveCaja"+
			"&sbIdCajas="+CajaSeleccionada.IdCajas,
					  		
			success: function(DataCaja)
			{
				document.getElementById("cargando").style.display="none";
				alert(DataCaja);
			}
	
		});//  $.ajax Inactivar Usuario
	} 	
	
});

$(document).delegate('#btnUpdCaja','click', function()
{
	try	
	{
		if(CajaSeleccionada == null)
			return;
		
		var sbCajaUpdate = JSON.stringify
		({
			sbIdCajas 		: CajaSeleccionada.IdCajas,
			Mercancia		: $("#cmbMercancia").val(),
			Estado			: $("#cmbEstadoCaja").val(),
			CodigoBarras	: $("#txtCodigoBarra").val()
		});
		
		sbCajaUpdate = JSON.parse(sbCajaUpdate);
		if(estaCajaCompletada(sbCajaUpdate))
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
		url: 		"Controller/php/apiCaja.php",
		dataType: 	"html",
		data: 		"action=UpdtCaja"
				+ "&sbMercancia="+sbCajaUpdate.Mercancia
				+ "&sbEstado="+sbCajaUpdate.Estado
				+ "&sbCodigoBarras="+sbCajaUpdate.CodigoBarras
				+ "&sbIdCajas="+sbCajaUpdate.sbIdCajas,

		success: function(DataCaja)
			{
				try
				{
					(document.getElementById("cargando")).style.display="none";
					
					if(DataCaja == "Actualizacion Exitosa!")
					{
						Lista_Caja();
					}
					alert(DataCaja);
				}
				catch(err)
				{
					alert(err);
				}
			}
	});
});

$(document).delegate('#btnSaveCaja','click', function()
{
	try	
	{
		var sbCaja = JSON.stringify(
		{
			Mercancia		: $("#cmbMercancia").val(),
			Estado			: $("#cmbEstadoCaja").val(),
			CodigoBarras	: $("#txtCodigoBarra").val()
		});
 
		sbCaja = JSON.parse(sbCaja);

		if(estaCajaCompletada(sbCaja))
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
		url: 		"Controller/php/apiCaja.php",
		dataType: 	"html",
		data: 		"action=RegCaja"
				+ "&sbMercancia="+sbCaja.Mercancia
				+ "&sbEstado="+sbCaja.Estado
				+ "&sbCodigoBarras="+sbCaja.CodigoBarras,

		success: function(DataCaja)
			{
				try
				{
					(document.getElementById("cargando")).style.display="none";
					
					if(DataCaja == "Registro Exitoso!")
					{
						Lista_Caja();
					}
					alert(DataCaja);
				}
				catch(err)
				{
					alert(err);
				}
				}
	});
});



$(document).delegate('#Elemento-caja','click', function()
{
	var sbValue = this.name;

	$("#cargando").show();

	$.ajax
	({ 
			type	: 	"POST",
			url		:	"Controller/php/apiCaja.php",
			dataType:	"html",
			data	:	"action=GetCajaById&sbID=" +sbValue ,			
			success	:	function(DataCaja)
 			{	
				try {
					obCaja = jQuery.parseJSON(DataCaja);
				}
				catch(err)
				{
					document.getElementById("cargando").style.display="none";
					alert("Se ha producido un error al intentar cargar la información. \n\n El siguiente es un mensaje tecnico: "+err.message+" \n "+DataCaja+"");
					return;
				}
				
				SetToViewCaja();

				CajaSeleccionada = obCaja[0];
				document.getElementById("cargando").style.display="none";
			}
	});
});

$(document).delegate('#btnNewCaja','click', function()
{
	Lista_Caja();
});

function Lista_Caja()
{	  
	$("#cargando").show();
	
	obCaja = null;
	CajaSeleccionada = null;
	ListCaja = null;
	$("#Lista-caja").empty();
	SetToViewCaja();
	
	//jQuery("input[type='text']").prop("disabled", true);
	//jQuery("button").prop("disabled", true);
	
	//Caja
	$.ajax({ //  $.ajax Caja
		type: "POST",
		url:  "Controller/php/apiCaja.php",
		dataType: "html",
		data: "action=GetCaja",
				  		
		success: function(DataBox){	
					  
			var Caja = jQuery.parseJSON(DataBox);

			ListCaja = Caja;
			AddToListCaja(ListCaja);
			
			//jQuery("input[type='text']").prop("disabled", false);
			//jQuery("button").prop("disabled", false);
			
			$( "#btnNewCaja" ).prop( "disabled", false );
			$( "#cmbMercancia" ).focus();

			document.getElementById("cargando").style.display="none";
		}
	});//  $.ajax Caja
}

function AddToListCaja(ListCaja)
{
	$.each(ListCaja, function(i,item) 
	{	
		if( i > 0)
		{

			$("#Lista-caja").append(
			"<a class='list' id ='Elemento-caja' name = '"+ListCaja[i].IdCajas+"'>"+
			"			<div class='list-content' >"+
			"               <img src='View/images/box.png' class = 'icon'>"+
			"				<div class='data'>"+
			"					<span class ='list-title' id = 'idCaja"+ListCaja[i].IdCajas+"'>Codigo Caja: "+ListCaja[i].CodigoBarras+"</span> "+
			"				</div>"+
			"			</div>"+
			"</a>");	
	    }
	});
}

function AddToListCajaOne(Obj)
{
	$("#Lista-caja").append(
			"<a class='list' id ='Elemento-caja' name = '"+Obj.IdCajas+"'>"+
			"			<div class='list-content' >"+
			"               <img src='View/images/box.png' class = 'icon'>"+
			"				<div class='data'>"+
			"					<span class ='list-title' id = 'idCaja"+Obj.IdCajas+"'>Comprobante No:"+Obj.CodigoBarras+"</span> "+
			"				</div>"+
			"			</div>"+
			"</a>");	
}


function SetToViewCaja()
{
	if(obCaja != null && obCaja[0] != null)
	{
		CajaSeleccionada = obCaja[0];

		$("#txtCodigoBarra").val(CajaSeleccionada.CodigoBarras);
		$("#cmbMercancia").val(CajaSeleccionada.IdMercancia);
		$("#cmbEstadoCaja").val(CajaSeleccionada.IdEstado)
		$( "#btnSaveCaja" ).prop( "disabled", true );
		$( "#btnUpdCaja" ).prop( "disabled", false );
		$( "#btnDelCaja" ).prop( "disabled", false );
	}
	else 
	{
		$("#txtCodigoBarra").val("");
		$("#cmbMercancia").val("");
		$("#cmbEstadoCaja").val("")

		$( "#btnSaveCaja" ).prop( "disabled", false );
		$( "#btnUpdCaja" ).prop( "disabled", true );
		$( "#btnDelCaja" ).prop( "disabled", true );

		$("#cmbEstadoCaja option[value=0]").attr("selected",true);
		$("#cmbMercancia option[value=0]").attr("selected",true);


	}
}
function estaCajaCompletada(sbCaja)
{
	if(sbCaja.Mercancia <= 0)
	{
		alert("Seleccione Mercancia");
		return true;
	}
	if(sbCaja.Estado <= 0)
	{
		alert("Seleccione Estado");
		return true;
	}
	if(sbCaja.CodigoBarras.length == 0)
	{
		alert("Ingres Numero de Codigo de Barras");
		return true;
	}

	return false;
}