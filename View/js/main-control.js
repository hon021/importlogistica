$(window).load(function(){

	$(document).delegate('#btnLogin','click',function(){
		    //Inicia Carga
		    $("#cargando").show();
		    
		    var sbLogin=$("#username").val();
			var sbPassword=$("#password").val();
			var sbActiva="0";
			
			$.ajax({
				type: "POST",
				url: "Controller/php/frmAuthentication.php?action=Authentication",
				dataType: 'html',
				data: "username="+sbLogin+"&password="+sbPassword,
				
				beforeSend:function(){
				},
				
				success: function(Data){
              	  
              	  var authentication = jQuery.parseJSON(Data);
              	 
              	  if(authentication.Usuario){
              		  
	                	  if(authentication.Usuario == 0){
	                		  //Fin Carga
	                		  var div = document.getElementById("cargando");
	        				  div.style.display="none";
	        				  
	                		  $("#username").focus();
	                		  sbMensaje = "Nombre de usuario Invalido, vuelva a Intentarlo!";
	                		  alert(sbMensaje);
	                          //$("#messages").html(sbMensaje);
	                          //$( "#messages" ).dialog( "open" );
	                		  
	                	  }else{
	                		  if(sbPassword == authentication.Clave){
	                			  //if(authentication.db_users_status == "0"){
	                			  if(sbActiva == "0"){   
	                				  $.ajax({
	                					  type: "POST",
	                					  url:  "Controller/php/frmAuthentication.php",
	                					  dataType: "html",
	                					  data: "action=CreateSesion" +
	                					  		"&UserName="+sbLogin+"&IdPerfil="+authentication.IdPerfil+"&IdRol="+authentication.IdRol,
	                					  		
	                					  success: function(data){	
	                						  
	                						   //Perfiles
	                						   $.ajax({ //  $.ajax perfiles
	    	                					  type: "POST",
	    	                					  url:  "Controller/php/apiMenu.php",
	    	                					  dataType: "html",
	    	                					  data: "action=Profiles" +
	    	                					  		"&idRol="+authentication.IdRol,
	    	                					  		
	    	                					   success: function(DataProfiles){	

	    	                						  var profiles = jQuery.parseJSON(DataProfiles);
	    	                						  array_CodigoPermiso = new Array();
	    	                						  array_NombreModulo = new Array();
	    	                						  
	    	                						  $.each(profiles, function(i,item) {
	    	                							    if(i>0){
		    	                							    array_CodigoPermiso[i]=profiles[i].CodigoPermiso;
		    	                							    array_NombreModulo[i]=profiles[i].NombreModulo;
	    	                							    }
	    	                						  });
	    	                						  
	    	                					
	    	                						  if(profiles.CodigoPermiso == "00"){
	    	                							  //Fin Carga
	    	                	                		  var div = document.getElementById("cargando");
	    	                	        				  div.style.display="none";
	    	                	        				  
	    	                							  sbMensaje = "El usuario no tiene un rol asignado, comuniquese con el administrador del sistema!";
	    	                	                		  alert(sbMensaje);
	    	                						  }else{
	    	                							  //Fin Carga
	    	                	                		  var div = document.getElementById("cargando");
	    	                	        				  div.style.display="none";
	    	                						       
		    	                						  $("#divMenu").load("Controller/php/apiMenu.php?action=GetMenu&array_CodigoPermiso="+ArrayJson(array_CodigoPermiso)+"&array_NombreModulo="+ArrayJson(array_NombreModulo)+"&sbLogin="+sbLogin,function(){	
		    	                					      });

		    	                						  $("#divMain").load("Controller/php/apiMenu.php?action=GetMain",function(){	
		    	                					      });
		    	                					      
		    	                						  
	    	                						  }
	    	                					   }
	    	                					 });//  $.ajax perfiles
	                						  
	                						  //Fin Perfiles
	                						  
	                					  }
	                				  
	                				   });
	                				     
	                			  }
	                			  else{
	                				 //Fin Carga
	    	                		  var div = document.getElementById("cargando");
	    	        				  div.style.display="none";
	    	        				  
	                        		  sbMensaje = "Esta Cuenta No se encuentra Activada, comuníquese con el administrador del sistema!";
	                                  alert(sbMensaje);
	                        		  //$("#messages").html(sbMensaje);
	                                  //$( "#messages" ).dialog( "open" );
	                			  }
	                		  }
	                		  else{
	                			  //Fin Carga
		                		  var div = document.getElementById("cargando");
		        				  div.style.display="none";
		        				  
	                    		  $("#password").focus();
	                    		  sbMensaje = "Contrasena Invalida, vuelva a Intentarlo!";
	                    		  alert(sbMensaje);
	                              //$("#messages").html(sbMensaje);
	                              //$( "#messages" ).dialog( "open" );
	                		  }
	                	  }
                 }else if (authentication.error_code){
              	      //Fin Carga
	           		  var div = document.getElementById("cargando");
	   				  div.style.display="none";
	   				  
                	  alert(authentication.error_msg);
                 }
            },
            
			complete: function(){
	
			}
		});//$.ajax({
	
	 });//$("#btnLogin").click(function(){
     
	
		
	//$("#idLogin").click(function(){
	$(document).delegate('#idLogin','click',function(){
		$("#divMain").load("View/login.html",function(){
		});
	});

});