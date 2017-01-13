var ListContenedor;
var ObjContainer;


$(document).delegate("#btnNewContainer", 'click', function()
{
	ObjContainer = null;
	Lista_Container();
	SetToViewContainer();

});

$(document).delegate('#btnClearCont', 'click', function()
{
	AddToListContainer(ListContenedor);
});


$(document).delegate('#txtBuscarContenedor', 'keyup', function()
{
	var str = this.value.toUpperCase();
	var flag = false;
	
	for (var i = ListContenedor.length - 1; i >= 0; i--) 
	{
		if(!(ListContenedor[i].NroContenedor == undefined))
		{
			if(str.search($.trim(ListContenedor[i].NroContenedor.toUpperCase())) != '-1' )
			{
				flag = true;
			}
		}
	};
	 
	if(flag)
	{
		$("#Lista-container").empty();
		for (var i = ListContenedor.length - 1; i >= 0; i--) 
		{
			if(!(ListContenedor[i].NroContenedor == undefined))
			{
				if(str.search($.trim(ListContenedor[i].NroContenedor.toUpperCase())) != '-1' )
				{
					AddToListContainerOne(ListContenedor[i]);
				}
			}
		};
	}
	else 
	{
		AddToListContainer(ListContenedor);
	}
});

function AddToListContainerOne(Container)
{
		$("#Lista-container").append(
		"<a class='list' id ='SelectedElementoContainer' name = '"+Container.idContenedor+"'>"+
		"			<div class='list-content' >"+
		"               <img src='View/images/commodity.png' class = 'icon'>"+
		"				<div class='data'>"+
		"					<span class ='list-title' id = 'idContenedor"+Container.idContenedor+"'>No:"+Container.NroContenedor+"</span> "+
		"				</div>"+
		"			</div>"+
		"</a>");	
}

function AddToListContainer(List)
{
	$("#Lista-container").empty();
	$.each(List, function(i, item)
	{
		if(i > 0)
		{
			$("#Lista-container").append(
			"<a class='list' id ='SelectedElementoContainer' name = '"+List[i].idContenedor+"'>"+
			"			<div class='list-content' >"+
			"               <img src='View/images/commodity.png' class = 'icon'>"+
			"				<div class='data'>"+
			"					<span class ='list-title' id = 'idContenedor"+List[i].idContenedor+"'>No:"+List[i].NroContenedor+"</span> "+
			"				</div>"+
			"			</div>"+
			"</a>");	
		}
	});

}

function Lista_Container()
{	  
	$("#cargando").show();
	$("#Lista-container").empty();
	
	//Mercancia
	$.ajax({ //  $.ajax Mercancia
		type: "POST",
		url:  "Controller/php/apiContainer.php",
		dataType: "html",
		data: "action=GetContainerList",
				  		
		success: function(DataCommodity){	
					  
			var Containers = jQuery.parseJSON(DataCommodity);
			ListContenedor = Containers;
			AddToListContainer(Containers);
			/*
			$.each(Containers, function(i,item) {
		
				if(i>0){
		
					$("#Lista-container").append(
					"<a class='list' id ='SelectedElementoContainer' name = '"+Containers[i].idContenedor+"'>"+
					"			<div class='list-content' >"+
					"               <img src='View/images/commodity.png' class = 'icon'>"+
					"				<div class='data'>"+
					"					<span class ='list-title' id = 'idContenedor"+Containers[i].idContenedor+"'>No:"+Containers[i].NroContenedor+"</span> "+
					"				</div>"+
					"			</div>"+
					"</a>");	
					
			    }
				
			});*/
			(document.getElementById("cargando")).style.display="none";	
			ObjContainer = null;
			SetToViewContainer();				
		}
	});
			  
}  

$(document).delegate('#btnDeleteContainer','click',function()
{
	if(ObjContainer != null && ObjContainer[0] != null)
	{
		$("#cargando").show();
				
		$.ajax({ //  $.ajax Inactivar Usuario
			type: "POST",
			url:  "Controller/php/apiContainer.php",
			dataType: "html",
			data: "action=InactiveContainer"+
					"&sbidContenedor="+ObjContainer[0].idContenedor,

			 /*
					  +"type: "POST",
			url:  "Controller/php/apiContainer.php",
			dataType: "html",
			data: "action=RegContainer" +
				  "&sbNroContenedor="+NroContenedor
				  +"&sbNroInterno="+NroInterno
				  +"&sbDescripcion="+$("#txtDescripcion").val(),*/
					  		
			success: function(DataMercancia)
			{
				(document.getElementById("cargando")).style.display="none";	
				alert(DataMercancia);
				ObjContainer = null;
				Lista_Container();
				SetToViewContainer();
			}

	
		});//  $.ajax Inactivar Usuario
	} 	
});


$(document).delegate("#btnUpdateContainer", 'click', function()
{
	if(ObjContainer != null && ObjContainer[0] != null)
	{
		var bolControl = true;
		var sbMensaje = "Faltan datos por completar \n \n ";
		
		var NroContenedor=$("#txtNroContenedor").val();
		var NroInterno=$("#txtNroInterno").val();
	    
	    if(NroContenedor.length == 0){
	    	bolControl=false;
	    	sbMensaje += "-Ingrese el Numero del Contenedor\n ";
	    }
	    if(NroInterno.length == 0){
	    	bolControl=false;
	    	sbMensaje += " -Ingrese Numero interno\n ";
	    }       
	    
	    if(bolControl)
	    {
	    	$.ajax
	    	({ 
				type: "POST",
				url:  "Controller/php/apiContainer.php",
				dataType: "html",
				data: "action=UpdtContainer" +
					  		"&sbidContenedor="+ObjContainer[0].idContenedor
							+"&sbNroContenedor="+NroContenedor
						  	+"&sbNroInterno="+NroInterno
						  	+"&sbDescripcion="+$("#txtDescripcion").val(),
					 
					
				success: function(DataContenedor)
				{	
					
					 if(DataContenedor == "Actualizacion Exitosa!")
					 {
						 Lista_Container();
					 }
					 alert(DataContenedor);
				}
			 
			});
	    }
	    else
	    {
	    	alert(sbMensaje);
	    }
	}		
});


$(document).delegate('#SelectedElementoContainer', 'click', function() 
{
	var sbValue = this.name;

	$("#cargando").show();
  	 
	$.ajax(
	{ //  $.ajax registro mercancia
			type: 		"POST",
			url:  		"Controller/php/apiContainer.php",
			dataType: 	"html",
			data: 		"action=GetContainerById&sbID="+sbValue,
			success: function(DataCommodity)
			{
				try
				{
					
					(document.getElementById("cargando")).style.display="none";	

						
					ObjContainer = jQuery.parseJSON(DataCommodity);
					ObjContainer[0].idContenedor = sbValue;
					SetToViewContainer();
				}
				catch(err)
				{
					(document.getElementById("cargando")).style.display="none";		
					alert(err);

				}
	 
			}
	});			
});


function SetToViewContainer()
{
	if(ObjContainer != null &&ObjContainer[0] != null)
	{
		ContenedorSeleccionado = ObjContainer[0];

		$("#txtNroContenedor").val(ContenedorSeleccionado.NroContenedor);
		$("#txtNroInterno").val(ContenedorSeleccionado.NroInterno);
		$("#txtDescripcion").val(ContenedorSeleccionado.Descripcion);

		$( "#btnNewContainer" ).prop( "disabled", false );
		$( "#btnSaveContainer" ).prop( "disabled", true );
		$( "#btnUpdateContainer" ).prop( "disabled", false );
		$( "#btnDeleteContainer" ).prop( "disabled", false );
		
	}
	else 
	{
		$("#txtNroContenedor").val("");
		$("#txtNroInterno").val("");
		$("#txtDescripcion").val("");
 
 		jQuery("input[type='text']").prop("disabled", false);
		jQuery("button").prop("disabled", false);

		$( "#btnUpdateContainer" ).prop( "disabled", true );
		$( "#btnDeleteContainer" ).prop( "disabled", true );			
		
		$("#txtNroContenedor").focus();

	}
} 

$(document).delegate('#btnSaveContainer','click',function(){

	var bolControl = true;
	var sbMensaje = "Faltan datos por completar \n \n ";
	
	var NroContenedor=$("#txtNroContenedor").val();
	var NroInterno=$("#txtNroInterno").val();
    
    if(NroContenedor.length == 0){
    	bolControl=false;
    	sbMensaje += "-Ingrese el Numero del Contenedor\n ";
    }
    if(NroInterno.length == 0){
    	bolControl=false;
    	sbMensaje += " -Ingrese Numero interno\n ";
    }       
    
    if(bolControl){
    	$.ajax
    	({ 
			type: "POST",
			url:  "Controller/php/apiContainer.php",
			dataType: "html",
			data: "action=RegContainer" +
				  "&sbNroContenedor="+NroContenedor
				  +"&sbNroInterno="+NroInterno
				  +"&sbDescripcion="+$("#txtDescripcion").val(),
				
			success: function(DataContenedor){	
				
				 if(DataContenedor == "Registro Exitoso!"){
					 Lista_Container();
				 }
				 alert(DataContenedor);
			}
		 
		});
    }
    else
    {
    	alert(sbMensaje);
    }
});