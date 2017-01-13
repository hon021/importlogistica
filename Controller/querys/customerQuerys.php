<?php
class CustomerQuerys {

    public  $customer_array;
    public  $customerAdministrator_array;
    public  $DNI;

    function __construct()
    {
        $this->customer_array[] = array();
        $this->customerAdministrator_array = array();
        $this->DNI = 0;
    }
     

     function getCustomer (){
	
        open_database();
        $qry =  "SELECT IdCliente, IdPerfil, Nombre, Apellido, DNI, Celular, Fijo, Email, Estado, Genero, Ciudad FROM cliente WHERE Estado = '".ACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->customer_array[] = array("IdCliente"=>$row["IdCliente"],
        										"IdPerfil"=>$row["IdPerfil"],
				        						"Nombre"=>$row["Nombre"],
        										"Apellido"=>$row["Apellido"],
										        "DNI"=>$row["DNI"],
										        "Celular"=>$row["Celular"],
										        "Fijo"=>$row["Fijo"],
										        "Email"=>$row["Email"],
										        "Estado"=>$row["Estado"],
										        "Genero"=>$row["Genero"],
        		 								"Ciudad"=>$row["Ciudad"]
        		);
        				        
		    }
		    return true;
		}
		else{
			return false;
		}
    }
    
    
	function getCustomerOrder (){
	
        open_database();
        
        $qry =  "SELECT IdCliente,DNI,CONCAT(Nombre, ' ', Apellido) As Nombre From cliente WHERE Estado = '".ACTIVE_STATE."' order by Nombre;";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->customer_array[] = array("IdCliente"=>$row["IdCliente"],
				        						"Nombre"=>$row["Nombre"],
        										"DNI"=>$row["DNI"]
        		);
        				        
		    }
		    return true;
		}
		else{
			return false;
		}
    }
    

    function getCustomerDNI ($sbDNI){
	
        open_database();
        $qry =  "SELECT IdCliente, IdPerfil, Nombre, Apellido, DNI, Celular, Fijo, Email, Estado, Genero, Ciudad FROM cliente WHERE DNI = '$sbDNI' and Estado = '".ACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
	        while($row = mysql_fetch_array($result)) {
			    
	        		$this->customerAdministrator_array = array("IdCliente"=>$row["IdCliente"],
				        										"IdPerfil"=>$row["IdPerfil"],
								        						"Nombre"=>$row["Nombre"],
				        										"Apellido"=>$row["Apellido"],
														        "DNI"=>$row["DNI"],
														        "Celular"=>$row["Celular"],
														        "Fijo"=>$row["Fijo"],
														        "Email"=>$row["Email"],
														        "Estado"=>$row["Estado"],
														        "Genero"=>$row["Genero"],
	        													"Ciudad"=>$row["Ciudad"]
	        		);
	        				        
			 }
        	
        	return true;
        }
		else{
			return false;
		}
    }
    
    
    function getCustomerPerfil ($IdPerfil){
    	open_database();
    	$qry =  "SELECT DNI FROM cliente WHERE IdPerfil = '$IdPerfil' AND Estado = '".ACTIVE_STATE."'";
    	$result = mysql_query($qry) or die(mysql_error());
    	close_database();

    	if(mysql_num_rows($result)!=0) {
    	
    		while($row = mysql_fetch_array($result)) {
    			 
    			$this->DNI = $row[0];
    				
    		}
    		return true;
    		
    	}
    	
    	else{
    		return false;
    	}
    }
    
    
	function getDNI ($sbDNI){
	
        open_database();
        $qry =  "SELECT * FROM cliente WHERE DNI = '$sbDNI'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)==0) {		
        	return true;
        }
		else{
			return false;
		}
    }
    
    
    function ActiveCustomer ($sbDNI){
	
        open_database();
        $qry =  "SELECT * FROM cliente WHERE DNI = '$sbDNI' and Estado = '".INACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	open_database();
			$qry = "UPDATE `cliente` SET Estado = '".ACTIVE_STATE."' WHERE DNI = '$sbDNI'";
        
        	$result = mysql_query($qry) or die(mysql_error());
        	close_database();

        	return true;
        }
		else{
			return false;
		}
    }
    
    
	function InactiveCustomer ($sbDNI){
	
        open_database();
        $qry =  "SELECT * FROM cliente WHERE DNI = '$sbDNI' AND Estado = '".ACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	open_database();
			$qry = "UPDATE `cliente` SET Estado = '".INACTIVE_STATE."' WHERE DNI = '$sbDNI'";
        
        	$result = mysql_query($qry) or die(mysql_error());
        	close_database();

        	return true;
        }
		else{
			return false;
		}
    }
    
    
    function saveRegisterCustomer($IdPerfil, $Nombre, $Apellido, $DNI, $Celular, $Fijo, $Email, $Genero, $sbCiudad){
		 
        open_database();

        $qry = "INSERT INTO `cliente` ( `IdPerfil`, `Nombre`, `Apellido`, `DNI`, `Celular`, `Fijo`, `Email`, `Estado`, `Genero`, `Ciudad`)
				VALUES ($IdPerfil, '$Nombre','$Apellido','$DNI','$Celular','$Fijo','$Email','".ACTIVE_STATE."','$Genero','$sbCiudad');";
        
        
        $result = mysql_query($qry) or die(mysql_error());

        close_database();
    }
    
    
 	function UpdateCustomer($IdCliente, $IdPerfil, $Nombre, $Apellido, $DNI, $Celular, $Fijo, $Email, $Genero, $sbCiudad){
		 
        open_database();

        $qry = "UPDATE `cliente` SET IdPerfil = $IdPerfil, Nombre = '$Nombre', Apellido = '$Apellido', DNI = '$DNI', Celular = '$Celular', Fijo = '$Fijo', Email = '$Email', Genero = '$Genero', Ciudad = '$sbCiudad' WHERE DNI = '$DNI' AND IdCliente = $IdCliente";
        
        $result = mysql_query($qry) or die(mysql_error());

        close_database();
    }

}
?>