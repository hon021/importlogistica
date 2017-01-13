var ObjMercancia;
var ListMercancia;


$(document).delegate("#btnNewMercancia", 'click', function()
{
	ObjMercancia = null;
	Lista_Mercancia();
	SetToViewMercancia();

});


$(document).delegate('#btnClearMerc', 'click', function()
{
	AddToListMercancia(ListMercancia);
});

$(document).delegate('#txtBuscarMercancia', 'keyup', function()
{
     var str = this.value.toUpperCase();
     var flag = false;
    
     for (var i = ListMercancia.length - 1; i >= 0; i--)
     {
	      //if(!(ListClientes[i].DNI == undefined))
	      if(!(ListMercancia[i].ClienteDNI == undefined && ListMercancia[i].NoCoprobante == undefined))          
	      {
	           //if(str.search($.trim(ListClientes[i].DNI.toUpperCase())) != '-1' )
	           if(str.search($.trim(ListMercancia[i].ClienteDNI.toUpperCase())) != '-1' || str.search($.trim(ListMercancia[i].NoCoprobante.toUpperCase())) != '-1')
	           {
	                flag = true;
	           }
	      }
     };
    
     if(flag)
     {
          $("#Lista-mercancia").empty();
          for (var i = ListMercancia.length - 1; i >= 0; i--)
          {
               if(!(ListMercancia[i].ClienteDNI == undefined && ListMercancia[i].NoCoprobante == undefined))   
               {
                    if(str.search($.trim(ListMercancia[i].ClienteDNI.toUpperCase())) != '-1' || str.search($.trim(ListMercancia[i].NoCoprobante.toUpperCase())) != '-1')
                    {
                         AddToListMercanciaOne(ListMercancia[i]);
                    }
               }
          };
     }
     else
     {
          AddToListMercancia(ListMercancia);
     }
});

function Lista_Mercancia()
{	  
	$("#cargando").show();
	$("#Lista-mercancia").empty();
	
	//Mercancia
	$.ajax({ //  $.ajax Mercancia
		type: "POST",
		url:  "Controller/php/apiMercancia.php",
		dataType: "html",
		data: "action=GetMercancia",
				  		
		success: function(DataCommodity){	
					  
			var Mercancia = jQuery.parseJSON(DataCommodity);
			ListMercancia = Mercancia;
			AddToListMercancia(ListMercancia);
			/*$.each(Mercancia, function(i,item) {
		
				if(i>0){
		
					$("#Lista-mercancia").append(
					"<a class='list' id ='Elemento-mercancia' name = '"+Mercancia[i].IdMercancia+"'>"+
					"			<div class='list-content' >"+
					"               <img src='View/images/commodity.png' class = 'icon'>"+
					"				<div class='data'>"+
					"					<span class ='list-title' id = 'idMercancia"+Mercancia[i].IdMercancia+"'>No:"+Mercancia[i].NoCoprobante+"</span> "+
					"					<span class ='list-title' >DNI Cliente:"+Mercancia[i].ClienteDNI+"</span> "+
					"				</div>"+
					"			</div>"+
					"</a>");	
					
			    }
				
			});*/
			loadDateCommodity();
			(document.getElementById("cargando")).style.display="none";	
			ObjMercancia = null;
			SetToViewMercancia();
			
			
		}
	}); 
			  
}


function AddToListMercanciaOne(Mercancia)
{
	$("#Lista-mercancia").append(
	"<a class='list' id ='Elemento-mercancia' name = '"+Mercancia.IdMercancia+"'>"+
	"			<div class='list-content' >"+
	"               <img src='View/images/commodity.png' class = 'icon'>"+
	"				<div class='data'>"+
	"					<span class ='list-title' id = 'idMercancia"+Mercancia.IdMercancia+"'>No:"+Mercancia.NoCoprobante+"</span> "+
	"					<span class ='list-title' >DNI Cliente:"+Mercancia.ClienteDNI+"</span> "+
	"				</div>"+
	"			</div>"+
	"</a>");	
}

function AddToListMercancia(List)
{
	$("#Lista-mercancia").empty();
	$.each(List, function(i,item) 
	{
		if(i>0)
		{
			$("#Lista-mercancia").append(
			"<a class='list' id ='Elemento-mercancia' name = '"+List[i].IdMercancia+"'>"+
			"			<div class='list-content' >"+
			"               <img src='View/images/commodity.png' class = 'icon'>"+
			"				<div class='data'>"+
			"					<span class ='list-title' id = 'idMercancia"+List[i].IdMercancia+"'>No:"+List[i].NoCoprobante+"</span> "+
			"					<span class ='list-title' >DNI Cliente:"+List[i].ClienteDNI+"</span> "+
			"				</div>"+
			"			</div>"+
			"</a>");	
	    }
	});
}

$(document).delegate('#btnDelMercancia','click',function()
{
	if(MercanciaSeleccionada != null)
	{
		$("#cargando").show();
				
		$.ajax({ //  $.ajax Inactivar Usuario
			type: "POST",
			url:  "Controller/php/apiMercancia.php",
			dataType: "html",
			data: "action=InactiveMercancia"+
			"&IdMercancia="+ObjMercancia[0].IdMercancia,
					  		
			success: function(DataMercancia)
			{
				document.getElementById("cargando").style.display="none";
				alert(DataMercancia);
				ObjMercancia = null;
				Lista_Mercancia();
				SetToView();
			}

	
		});
	} 	
});


$(document).delegate("#btnUpdMercancia", 'click', function()
{
	if(ObjMercancia != null && ObjMercancia[0] != null)
	{
		var bolControl = true;
		var sbMensaje = "Faltan datos por completar \n \n ";
		
		var IdCliente=$("#cmbCliente").val();
		var nuComprobante=$("#txtComprobante").val();
	    var Nocajas=$("#txtTotalCajas").val();
	    var Cubicaje=$("#txtCubicaje").val();
	    var Notas=$("#txtNotasMercancia").val();
	    var dtFechaIngreso=$("#dateMercancia").val();
	    
	    if(IdCliente == 0){
	    	bolControl=false;
	    	sbMensaje += "-Seleccione el Cliente\n ";
	    }
	    if(nuComprobante.length == 0){
	    	bolControl=false;
	    	sbMensaje += " -Ingrese Numero de Comprobante\n ";
	    }
	    if(Nocajas.length == 0){
	    	bolControl=false;
	    	sbMensaje += " -Ingrese Numero de Cajas\n ";
	    }
	    if(Cubicaje.length == 0){
	    	bolControl=false;
	    	sbMensaje += " -Ingrese El Cubicaje\n ";
	    }
	    
	    if(bolControl)
	    {
	    	$.ajax
	    	({ 
				type: "POST",
				url:  "Controller/php/apiMercancia.php",
				dataType: "html",
				data: "action=UpdtMercancia" +
					  	"&IdMercancia="+ObjMercancia[0].IdMercancia
						+"&IdCliente="+IdCliente
						+"&nuComprobante="+nuComprobante
						+"&Nocajas="+Nocajas
						+"&Cubicaje="+Cubicaje
						+"&Notas="+Notas
						+"&FechaIngreso="+dtFechaIngreso,
					
					
				success: function(DataMercancia)
				{	
					
					 if(DataMercancia == "Actualizacion Exitosa!")
					 {
						 Lista_Mercancia();
					 }
					 alert(DataMercancia);
				}
			 
			});
	    }
	    else
	    {
	    	alert(sbMensaje);
	    }
	}		
});


$(document).delegate('#Elemento-mercancia', 'click', function() 
{
	var sbValue = this.name;

	$("#cargando").show();
  	 
	$.ajax(
	{ //  $.ajax registro mercancia
			type: 		"POST",
			url:  		"Controller/php/apiMercancia.php",
			dataType: 	"html",
			data: 		"action=GetMercanciaById&sbID="+sbValue,
			success: function(DataCommodity)
			{
				try
				{
					
					(document.getElementById("cargando")).style.display="none";	

						
					ObjMercancia = jQuery.parseJSON(DataCommodity);
					ObjMercancia[0].IdMercancia = sbValue;
					SetToViewMercancia();
				}
				catch(err)
				{
					(document.getElementById("cargando")).style.display="none";		
					alert(err);

				}
	 
			}
	});			
});


function SetToViewMercancia()
{
	if(ObjMercancia != null &&ObjMercancia[0] != null)
	{
		MercanciaSeleccionada = ObjMercancia[0];

		$("#cmbCliente").val(MercanciaSeleccionada.IdCliente);
		//$("#cmbContenedor").val(MercanciaSeleccionada.idContenedor);
		$("#txtComprobante").val(MercanciaSeleccionada.NoCoprobante);
		$("#txtTotalCajas").val(MercanciaSeleccionada.Nocajas);
		$("#txtCubicaje").val(MercanciaSeleccionada.Cubicaje);
		$("#txtNotasMercancia").val(MercanciaSeleccionada.Notas);
		$("#dateMercancia").val(MercanciaSeleccionada.FechaIngreso);
		

		$( "#btnNewMercancia" ).prop( "disabled", false );
		$( "#btnUpdMercancia" ).prop( "disabled", false );
		$( "#btnDelMercancia" ).prop( "disabled", false );
		$( "#btnSaveMercancia" ).prop( "disabled", true );
	}
	else 
	{
		$("#cmbCliente").val("");
		$("#cmbCliente option[value=0]").attr("selected",true);
		/*$("#cmbContenedor").val("");
		$("#cmbContenedor option[value=0]").attr("selected",true);*/
    	$("#txtComprobante").val("");
    	$("#txtTotalCajas").val("");
		$("#txtCubicaje").val("");
		$("#txtNotasMercancia").val("");

		jQuery("input[type='text']").prop("disabled", false);
		jQuery("button").prop("disabled", false);

		$( "#btnUpdMercancia" ).prop( "disabled", true );
		$( "#btnDelMercancia" ).prop( "disabled", true );			
		
		$("#cmbCliente").focus();
		//loadDateCommodity();

	}
}

function loadDateCommodity(){
	
	$("#calendarFechaMercancia").datepicker({
		format: "yyyy-mm-dd", // set output format
		effect: "slide", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: "en"
	});
	$("#dateMercancia").val(getFecha());
}


$(document).delegate('#btnSaveMercancia','click',function(){

	var bolControl = true;
	var sbMensaje = "Faltan datos por completar \n \n ";
	
	var IdCliente=$("#cmbCliente").val();
	var nuComprobante=$("#txtComprobante").val();
    var Nocajas=$("#txtTotalCajas").val();
    var Cubicaje=$("#txtCubicaje").val();
    var Notas=$("#txtNotasMercancia").val();
    var dtFechaIngreso=$("#dateMercancia").val();
    
    if(IdCliente == 0){
    	bolControl=false;
    	sbMensaje += "-Seleccione el Cliente\n ";
    }
    if(nuComprobante.length == 0){
    	bolControl=false;
    	sbMensaje += " -Ingrese Numero de Comprobante\n ";
    }
    if(Nocajas.length == 0){
    	bolControl=false;
    	sbMensaje += " -Ingrese Numero de Cajas\n ";
    }
    if(Cubicaje.length == 0){
    	bolControl=false;
    	sbMensaje += " -Ingrese El Cubicaje\n ";
    }
      
    
    if(bolControl){
    	$.ajax
    	({ 
			type: "POST",
			url:  "Controller/php/apiMercancia.php",
			dataType: "html",
			data: "action=RegMercancia" +
				  "&IdCliente="+IdCliente
				  +"&nuComprobante="+nuComprobante
				  +"&Nocajas="+Nocajas
				  +"&Cubicaje="+Cubicaje
				  +"&Notas="+Notas
				  +"&FechaIngreso="+dtFechaIngreso,
				
			success: function(DataMercancia){	
				
				 if(DataMercancia == "Registro Exitoso!"){
					 Lista_Mercancia();
				 }
				 alert(DataMercancia);
			}
		 
		});
    }
    else
    {
    	alert(sbMensaje);
    }
});