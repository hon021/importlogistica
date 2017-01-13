
/*$(document).delegate('#btnNewCliente','click',function(){
	 //Campos Cliente
	 $("#txtNombre_Cliente").val("");
	 $("#txtApellido_Cliente").val(""); 
	 $("#txtDNI_Cliente").val("");
	 $("#txtCel_Cliente").val(""); 
	 $("#txtFijo_Cliente").val(""); 
	 $("#txtEmail_Cliente").val("");
     //Datos Perfil
	 $("#txtUsername_Cliente").val(""); 
	 $("#txtPassword_Cliente").val("");
	 $("#txtConfirma_Password_Cliente").val("");
	 
	 $("#txtNombre_Cliente").focus();
	 
});*/


function Lista_Modulos()
{	  
	$("#cargando").show();
	jQuery("input[type='text']").prop("disabled", true);
	//jQuery("button").prop("disabled", true);
	
	//Clientes
	$.ajax({ //  $.ajax clientes
		type: "POST",
		url:  "Controller/php/apiModule.php",
		dataType: "html",
		data: "action=GetModulos",
				  		
		success: function(DataModulos){	
					  
			var modulo = jQuery.parseJSON(DataModulos);
			
			$.each(modulo, function(i,item) {
		
				if(i>0){
		
					$("#Lista-modulos").append(
					"<a class='list' id ='Elemento-modulo' name = '"+modulo[i].IdModulo+"'>"+
					"			<div class='list-content' >"+
					"               <img src='View/images/modules.png' class = 'icon'>"+
					"				<div class='data'>"+
					"					<span class ='list-title' id = 'idNombreModulo"+modulo[i].IdModulo+"'>"+modulo[i].Nombre+"</span> "+
					"				</div>"+
					"			</div>"+
					"</a>");	
					
			    }
				
			});
			
			
			jQuery("input[type='text']").prop("disabled", false);
			//jQuery("button").prop("disabled", false);
			$("#txtNombre_Modulo").focus();
			var div = document.getElementById("cargando");
			div.style.display="none";
		}
	});//  $.ajax clientes
			  
}

$(document).delegate('#Elemento-modulo','click',function(){
	var sbValue = this.name;
	var sbElement = document.getElementById("idNombreModulo"+sbValue).innerHTML;
	$("#txtNombre_Modulo").val(sbElement);
	
	
});

