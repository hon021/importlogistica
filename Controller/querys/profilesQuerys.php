<?php
class ProfilesQuerys {
   
    public  $profiles_array;
    public  $profilesAdministrator_array;

    function __construct()
    {
        $this->profiles_array [] = array();
        $this->profilesAdministrator_array = array();
    }
     

     function Profiles ($IdRol){
	
        open_database();
        $qry =  "SELECT m.codigopermiso, m.nombre FROM modulo m, detallemodulo dm WHERE m.idmodulo = dm.idmodulo AND dm.idrol = $IdRol AND m.estado = '".ACTIVE_STATE."'";
        
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->profiles_array []= array(	"CodigoPermiso"=>$row["codigopermiso"],
        										    "NombreModulo"=>$row["nombre"]);
        				        
		    }
		    return true;
		}
		else{
			return false;
		}
    }
    
    
   	function GetProfilesCustomer ($idPerfil ){
	
        open_database();
        $qry = "SELECT * FROM perfil WHERE IdPerfil = '$idPerfil' and Estado = '".ACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->profilesAdministrator_array = array(	"IdPerfil"=>$row["IdPerfil"],
        										    		"IdRol"=>$row["IdRol"],
											        		"Usuario"=>$row["Usuario"],
											        		"Clave"=>$row["Clave"],
											        		"Estado"=>$row["Estado"]
        		
        		);
        				        
		    }
		    return true;
		}
		else{
			return false;
		}
    }
    
	function GetUser ($User){
	
        open_database();
        $qry =  "SELECT Usuario FROM perfil WHERE Usuario = '".$User."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)==0) {		

		    return true;
		}
		else{
			return false;
		}
    }
    
    
    function ActiveProfiles ($IdPerfil){

        open_database();
        $qry =  "SELECT IdPerfil, IdRol, Usuario, Clave, Estado FROM perfil WHERE IdPerfil = '$IdPerfil' AND Estado = '".ACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	open_database();
			$qry = "UPDATE `perfil` SET Estado =".ACCOUNT_ACTIVE." WHERE IdPerfil = '$IdPerfil'";
        
        	$result = mysql_query($qry) or die(mysql_error());
        	close_database();

        	return true;
        }
		else{
			return false;
		}
    }
    
    
   function InactiveProfiles ($IdPerfil){

        open_database();
        $qry =  "SELECT IdPerfil, IdRol, Usuario, Clave, Estado FROM perfil WHERE IdPerfil = '$IdPerfil' AND Estado = '".ACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	open_database();
			$qry = "UPDATE `perfil` SET Estado =".ACCOUNT_ACTIVE." WHERE IdPerfil = '$IdPerfil'";
        
        	$result = mysql_query($qry) or die(mysql_error());
        	close_database();

        	return true;
        }
		else{
			return false;
		}
    }
    
    function saveRegisterProfile($IdRol, $Usuario, $Clave){
 
        open_database();

        $qry = "INSERT INTO `perfil` (`IdRol` ,`Usuario` , `Clave`, `Estado`)
				VALUES ($IdRol , '$Usuario', '$Clave', '".ACTIVE_STATE."');";
        
        $result = mysql_query($qry) or die(mysql_error());

        $nuIdProfile=mysql_insert_id();
        
        close_database();
        
        return $nuIdProfile;
        
    }
    
    
	function updateProfile($IdPerfil, $IdRol, $Usuario, $Clave){
 
        open_database();

        $qry = "UPDATE `perfil` SET IdRol = $IdRol, Usuario = '$Usuario', `Clave` = '$Clave' WHERE Usuario = '$Usuario' AND IdPerfil = $IdPerfil";

        $result = mysql_query($qry) or die(mysql_error());
    
        close_database();
        
    }
    
    
	function updatePasswordProfile($Usuario, $Clave, $NuevaClave){
 
        open_database();

        $qry = "UPDATE `perfil` SET `Clave` = '$NuevaClave' WHERE Usuario = '$Usuario' AND Clave = '$Clave'";

        $result = mysql_query($qry) or die(mysql_error());
    
        close_database();
        
    }
    
   
    
}
?>