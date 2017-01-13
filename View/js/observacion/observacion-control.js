var objObservation;
var ListObservationes;

function Lista_Observaciones()
{	  
	$("#cargando").show();
	$("#Lista-observacion").empty();
	jQuery("input[type='text']").prop("disabled", true);
	jQuery("button").prop("disabled", true);

	//Observaciones
	$.ajax({ //  $.ajax Observaciones
		type: "POST",
		url:  "Controller/php/apiObservacion.php",
		dataType: "html",
		data: "action=GetObservaciones",
				  		
		success: function(DataObservaciones){	
					  
			ListObservationes = jQuery.parseJSON(DataObservaciones);
			
			$.each(ListObservationes, function(i,item) {
		
				if(i>0){
		
					$("#Lista-observacion").append(
					"<a class='list' id ='Elemento-observer' name = '"+ListObservationes[i].IdObservaciones+"'>"+
					"			<div class='list-content' >"+
					"               <img src='View/images/note.png' class = 'icon'>"+
					"				<div class='data'>"+
					"					<span class ='list-title' id = 'idObservacion"+ListObservationes[i].IdObservaciones+"'>"+ListObservationes[i].Observacion+"</span> "+
					"				</div>"+
					"			</div>"+
					"</a>");	
					
			    }
				
			});
			
			jQuery("input[type='text']").prop("disabled", false);
			jQuery("button").prop("disabled", false);
			$( "#btnNewObservacion" ).prop( "disabled", true );
			$("#cmbObservMercancia").focus();

			loadDateObservation();
			var div = document.getElementById("cargando");
			div.style.display="none";
		}
	});//  $.ajax Observaciones
			  
}


$(document).delegate('#btnSaveObservacion','click',function(){

	var bolControl = true;
	var sbMensaje = " ";
	
	//Campos
    var sbEnvio=$("#cmbObservEnvio").val();
    var sbLocalizacion=$("#cmbObservLocali").val();
    var sbObservacion=$("#txtObservacion").val();
    var dtFechaIngreso=$("#dateObservacion").val();
   

    if(sbEnvio==="0"){
    	bolControl=false;
    	sbMensaje += "-Seleccione Envio ";
    }
    
    if(sbLocalizacion==="0"){
    	bolControl=false;
    	sbMensaje += "-Seleccione una Localizacion ";
    }
    
    if(sbObservacion.length == 0){
    	bolControl=false;
    	sbMensaje += "-Seleccione una Observacion ";
    }
    
    if(bolControl){
    	
    	 $.ajax({ //  $.ajax registro observaciones
				type: "POST",
				url:  "Controller/php/apiObservacion.php",
				dataType: "html",
				data: "action=RegObservacion" +
				  "&IdMercancia="+sbEnvio+"&IdLocalizacion="+sbLocalizacion+"&dtFechaIngreso="+dtFechaIngreso+"&sbObservaciones="+sbObservacion,
					  
				success: function(DataObserv){	
					
					 if(DataObserv == "Registro Exitoso!"){
						 Lista_Observaciones();
					 }
					 alert(DataObserv);
				}
			 
		 });// $.ajax registro observaciones						
							
    }//if(bolControl)
    else
    {
    	alert(sbMensaje);
    }//if(bolControl)
});

//Load
function loadDateObservation(){
	
	$("#calendarFechaObservacion").datepicker({
		format: "yyyy-mm-dd", // set output format
		effect: "slide", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: "en"
	});
	$("#dateObservacion").val(getFecha());
}

$(document).delegate('#Elemento-observer','click',function(){
	var sbValue = this.name;
	var sbElement = document.getElementById("idObservacion"+sbValue).innerHTML;
	
	$("#cargando").show();
	
	//Observaciones
	$.ajax({ //  $.ajax Observaciones
		type: "POST",
		url:  "Controller/php/apiObservacion.php",
		dataType: "html",
		data: "action=GetObservacionId"+
		"&nuIdObservacion="+sbValue,
				  		
		success: function(DataObser){
			objObservation = jQuery.parseJSON(DataObser);
			
			$("#cmbObservEnvio").val(objObservation.IdEnvios);
			$("#cmbObservLocali").val(objObservation.IdLocalizacion); 
			$("#dateObservacion").val(objObservation.FechaIngreso);
			$("#txtObservacion").val(objObservation.Observacion); 
		
			
			//Activa Boton Nuevo
			$( "#btnNewObservacion" ).prop( "disabled", false );
			(document.getElementById("cargando")).style.display="none";
		}
		
	});//  $.ajax Observaciones
	//
	
	
});

$(document).delegate('#btnNewObservacion','click',function(){
	
	$("#cmbObservEnvio").val("0");
	$("#cmbObservLocali").val("0"); 
	$("#dateObservacion").val(getFecha());
	$("#txtObservacion").val(""); 
	$("#cmbObservMercancia").focus();
	 
});


$(document).delegate('#btnUpdObservacion','click',function(){
			
	var bolControl = true;
	var sbMensaje = " ";
	
	//Campos
    var sbEnvio=$("#cmbObservEnvio").val();
    var sbLocalizacion=$("#cmbObservLocali").val();
    var sbObservacion=$("#txtObservacion").val();
    var dtFechaIngreso=$("#dateObservacion").val();
   

    if(sbEnvio==="0"){
    	bolControl=false;
    	sbMensaje += "-Seleccione Envio";
    }
    
    if(sbLocalizacion==="0"){
    	bolControl=false;
    	sbMensaje += "-Seleccione una Localizacion ";
    }
    
    if(sbObservacion.length == 0){
    	bolControl=false;
    	sbMensaje += "-Seleccione una Observacion ";
    }
    
		    
	if(bolControl){
		 if(Cambio_Campos_Observacion()){//if(Cambio_Campos())
			$.ajax({ //  $.ajax registro observaciones
				type: "POST",
				url:  "Controller/php/apiObservacion.php",
				dataType: "html",
				data: "action=UpdObservacion" +
				"&idObservacion="+objObservation.IdObservaciones+"&idMercancia="+sbEnvio+"&idLocalizacion="+sbLocalizacion+"&dtFechaIngreso="+dtFechaIngreso+"&sbObservaciones="+sbObservacion,


				success: function(DataObserver){	

					if(DataObserver == "Actualizacion Exitosa!"){
						Lista_Observaciones();
					}
					alert(DataObserver);
				}

			});//  $.ajax registro observaciones		  

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



function Cambio_Campos_Observacion(){
	var bolControl = false;

	//Campos
    var sbMercancia=$("#cmbObservMercancia").val();
    var sbLocalizacion=$("#cmbObservLocali").val();
    var sbObservacion=$("#txtObservacion").val();
    var dtFechaIngreso=$("#dateObservacion").val();
 
    if(sbMercancia != objObservation.IdMercancia){
    	bolControl = true;
    }else
    if(sbLocalizacion != objObservation.IdLocalizacion){
    	bolControl = true;
    }else
    if(sbObservacion != objObservation.Observacion){
    	bolControl = true;
    }else
    if(dtFechaIngreso != objObservation.FechaIngreso){
    	bolControl = true;
    }else{
    	bolControl = false;
    }
    
    
    return bolControl;
}


$(document).delegate('#btnDelObservacion','click',function(){
	var bolControl = true;
	var sbMensaje = " ";
	
	//Campos
    var sbMercancia=$("#cmbObservMercancia").val();
    var sbLocalizacion=$("#cmbObservLocali").val();
   
    if(sbMercancia==="0"){
    	bolControl=false;	
    }
    
    if(sbLocalizacion==="0"){
    	bolControl=false;
    	
    }
   
    if(bolControl){

		$.ajax({ //  $.ajax Inactivar Observacion
			type: "POST",
			url:  "Controller/php/apiObservacion.php",
			dataType: "html",
			data: "action=InactiveObservacion"+
			"&idObservacion="+objObservation.IdObservaciones,
					  		
			success: function(DataObserver){
				if(DataObserver == "Proceso Exitoso!"){
					Lista_Observaciones();
				}
				alert(DataObserver);
			}
	
		});//  $.ajax Inactivar Observacion
	
    }//if(bolControl)
    else
    {
    	sbMensaje += "-Debe seleccionar una Observacion de la lista! ";
    	alert(sbMensaje);
    }//if(bolControl)
});