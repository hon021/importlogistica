<?php
class AuthenticationQuerys {

    public  $authentication_array;
    public  $authenticationAdministrator_array;

    function __construct()
    {
        $this->authentication_array = array();
        $this->authenticationAdministrator_array = array();
    }
     

     function authentication ($username, $password){
	
        open_database();
        $qry =  "SELECT IdPerfil, IdRol, Usuario, Clave FROM perfil WHERE Usuario = '$username'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->authentication_array = array(	"IdPerfil"=>$row["IdPerfil"],
        												"IdRol"=>$row["IdRol"],
				        								"Usuario"=>$row["Usuario"],
        												"Clave"=>$row["Clave"]);
        				        
		    }
		    return true;
		}
		else{
			return false;
		}
    }
    
}
?>