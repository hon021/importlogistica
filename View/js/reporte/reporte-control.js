function loadDateReport(){
	
	$("#calendarInicio").datepicker({
		format: "yyyy-mm-dd", // set output format
		effect: "slide", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: "en"
	});
	
	$("#calendarFin").datepicker({
		format: "yyyy-mm-dd", // set output format
		effect: "slide", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: "en"
	});
	
	$("#dateInicio").val(getFecha());
	$("#dateFin").val(getFecha());
}


function loadDateReport2(){
	
	$("#calendarInicioRp2").datepicker({
		format: "yyyy-mm-dd", // set output format
		effect: "slide", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: "en"
	});
	
	$("#calendarFinRp2").datepicker({
		format: "yyyy-mm-dd", // set output format
		effect: "slide", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: "en"
	});
	
	$("#dateInicioRp2").val(getFecha());
	$("#dateFinRp2").val(getFecha());
}


function loadDateReport3(){
	
	$("#calendarInicioRp3").datepicker({
		format: "yyyy-mm-dd", // set output format
		effect: "slide", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: "en"
	});
	
	$("#calendarFinRp3").datepicker({
		format: "yyyy-mm-dd", // set output format
		effect: "slide", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: "en"
	});
	
	$("#dateInicioRp3").val(getFecha());
	$("#dateFinRp3").val(getFecha());
}


function loadDateReport4(){
	
	$("#calendarInicioRp4").datepicker({
		format: "yyyy-mm-dd", // set output format
		effect: "slide", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: "en"
	});
	
	$("#calendarFinRp4").datepicker({
		format: "yyyy-mm-dd", // set output format
		effect: "slide", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: "en"
	});
	
	$("#dateInicioRp4").val(getFecha());
	$("#dateFinRp4").val(getFecha());
}


function loadDateReport5(){
	
	$("#calendarInicioRp5").datepicker({
		format: "yyyy-mm-dd", // set output format
		effect: "slide", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: "en"
	});
	
	$("#calendarFinRp5").datepicker({
		format: "yyyy-mm-dd", // set output format
		effect: "slide", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: "en"
	});
	
	$("#dateInicioRp5").val(getFecha());
	$("#dateFinRp5").val(getFecha());
}

$(document).delegate('#btnReportPdf1','click',function(){

	var dtFechaIni=$("#dateInicio").val();
	var dtFechaFin=$("#dateFin").val();

	parent.location ="Controller/php/apiReporte.php?action=GetReport1Pdf&FechaIni="+dtFechaIni+'&FechaFin='+dtFechaFin;
	
});



$(document).delegate('#btnReportExcel1','click',function(){

	var dtFechaIni=$("#dateInicio").val();
	var dtFechaFin=$("#dateFin").val();

	parent.location ="Controller/php/apiReporte.php?action=GetReport1Excel&FechaIni="+dtFechaIni+'&FechaFin='+dtFechaFin;
	
});


$(document).delegate('#btnReportPdf2','click',function(){
	
	var bolControl = true;
	var sbMensaje = " ";
	var dtFechaIni=$("#dateInicioRp2").val();
	var dtFechaFin=$("#dateFinRp2").val();
	var sbNoComprobante=$("#txtNoComprobanteRp2").val();
	
	if(sbNoComprobante.length == 0){
	   	bolControl=false;
	   	sbMensaje += "-Ingrese Numero de Comprobante ";
    }
	
	if(bolControl){
	    parent.location ="Controller/php/apiReporte.php?action=GetReport2Pdf&FechaIni="+dtFechaIni+'&FechaFin='+dtFechaFin+'&NoComprobante='+sbNoComprobante;
	}//if(bolControl)
    else
    {
    	alert(sbMensaje);
    }//if(bolControl)
	  
});


$(document).delegate('#btnReportExcel2','click',function(){
	
	var bolControl = true;
	var sbMensaje = " ";
	var dtFechaIni=$("#dateInicioRp2").val();
	var dtFechaFin=$("#dateFinRp2").val();
	var sbNoComprobante=$("#txtNoComprobanteRp2").val();
	
	if(sbNoComprobante.length == 0){
	   	bolControl=false;
	   	sbMensaje += "-Ingrese Numero de Comprobante ";
    }
	
	if(bolControl){
		parent.location ="Controller/php/apiReporte.php?action=GetReport2Excel&FechaIni="+dtFechaIni+'&FechaFin='+dtFechaFin+'&NoComprobante='+sbNoComprobante;
	}//if(bolControl)
    else
    {
    	alert(sbMensaje);
    }//if(bolControl)
	  
	
});


// Reporte Mercancia x DNI
$(document).delegate('#btnReportPdf3','click',function(){
	
	var bolControl = true;
	var sbMensaje = " ";
	var dtFechaIni=$("#dateInicioRp3").val();
	var dtFechaFin=$("#dateFinRp3").val();
	var sbNoComprobante=$("#txtDNIRp3").val();
	
	if(sbNoComprobante.length == 0){
	   	bolControl=false;
	   	sbMensaje += "-Ingrese Numero de Comprobante ";
    }
	
	if(bolControl){
	    parent.location ="Controller/php/apiReporte.php?action=GetReport3Pdf&FechaIni="+dtFechaIni+'&FechaFin='+dtFechaFin+'&NoComprobante='+sbNoComprobante;
	}//if(bolControl)
    else
    {
    	alert(sbMensaje);
    }//if(bolControl)
	  
});


$(document).delegate('#btnReportExcel3','click',function(){
	
	var bolControl = true;
	var sbMensaje = " ";
	var dtFechaIni=$("#dateInicioRp3").val();
	var dtFechaFin=$("#dateFinRp3").val();
	var sbNoComprobante=$("#txtDNIRp3").val();
	
	if(sbNoComprobante.length == 0){
	   	bolControl=false;
	   	sbMensaje += "-Ingrese Numero de Comprobante ";
    }
	
	if(bolControl){
		parent.location ="Controller/php/apiReporte.php?action=GetReport3Excel&FechaIni="+dtFechaIni+'&FechaFin='+dtFechaFin+'&NoComprobante='+sbNoComprobante;
	}//if(bolControl)
    else
    {
    	alert(sbMensaje);
    }//if(bolControl)
	  
	
});


//Reporte Contenedor x DNI
$(document).delegate('#btnReportPdf4','click',function(){
	
	var bolControl = true;
	var sbMensaje = " ";
	var dtFechaIni=$("#dateInicioRp4").val();
	var dtFechaFin=$("#dateFinRp4").val();
	var sbNoComprobante=$("#txtDNIRp4").val();
	
	if(sbNoComprobante.length == 0){
	   	bolControl=false;
	   	sbMensaje += "-Ingrese Numero de Comprobante ";
    }
	
	if(bolControl){
	    parent.location ="Controller/php/apiReporte.php?action=GetReport4Pdf&FechaIni="+dtFechaIni+'&FechaFin='+dtFechaFin+'&NoComprobante='+sbNoComprobante;
	}//if(bolControl)
    else
    {
    	alert(sbMensaje);
    }//if(bolControl)
	  
});


$(document).delegate('#btnReportExcel4','click',function(){
	
	var bolControl = true;
	var sbMensaje = " ";
	var dtFechaIni=$("#dateInicioRp4").val();
	var dtFechaFin=$("#dateFinRp4").val();
	var sbNoComprobante=$("#txtDNIRp4").val();
	
	if(sbNoComprobante.length == 0){
	   	bolControl=false;
	   	sbMensaje += "-Ingrese Numero de Comprobante ";
    }
	
	if(bolControl){
		parent.location ="Controller/php/apiReporte.php?action=GetReport4Excel&FechaIni="+dtFechaIni+'&FechaFin='+dtFechaFin+'&NoComprobante='+sbNoComprobante;
	}//if(bolControl)
    else
    {
    	alert(sbMensaje);
    }//if(bolControl)
	  
	
});




//Reporte Contenedor x Codigo
$(document).delegate('#btnReportPdf5','click',function(){
	
	var bolControl = true;
	var sbMensaje = " ";
	var dtFechaIni=$("#dateInicioRp5").val();
	var dtFechaFin=$("#dateFinRp5").val();
	var sbNoComprobante=$("#txtCodContRp5").val();
	
	if(sbNoComprobante.length == 0){
	   	bolControl=false;
	   	sbMensaje += "-Ingrese Codigo Contenedor ";
    }
	
	if(bolControl){
	    parent.location ="Controller/php/apiReporte.php?action=GetReport5Pdf&FechaIni="+dtFechaIni+'&FechaFin='+dtFechaFin+'&NoComprobante='+sbNoComprobante;
	}//if(bolControl)
    else
    {
    	alert(sbMensaje);
    }//if(bolControl)
	  
});


$(document).delegate('#btnReportExcel5','click',function(){
	
	var bolControl = true;
	var sbMensaje = " ";
	var dtFechaIni=$("#dateInicioRp5").val();
	var dtFechaFin=$("#dateFinRp5").val();
	var sbNoComprobante=$("#txtCodContRp5").val();
	
	if(sbNoComprobante.length == 0){
	   	bolControl=false;
	   	sbMensaje += "-Ingrese Codigo Contenedor ";
    }
	
	if(bolControl){
		parent.location ="Controller/php/apiReporte.php?action=GetReport5Excel&FechaIni="+dtFechaIni+'&FechaFin='+dtFechaFin+'&NoComprobante='+sbNoComprobante;
	}//if(bolControl)
    else
    {
    	alert(sbMensaje);
    }//if(bolControl)
	  
	
});