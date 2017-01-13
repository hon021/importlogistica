<?php
class ModulesDetailQuerys {
   
    public  $modules_array;
    public  $modulesAdministrator_array;

    function __construct()
    {
        $this->modules_array [] = array();
        $this->modulesAdministrator_array = array();
    }
     

     function ModulesDetail (){
	
        open_database();
        $qry =  "SELECT IdModulo, IdRol FROM detallemodulo";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->modules_array[] = array("IdModulo"=>$row["IdModulo"],
        									   "IdRol"=>$row["IdRol"]
        		);
        				        
		    }
		    return true;
		}
		else{
			return false;
		}
    }
    
    
    
 	function Modules_Rol ($IdRol){
	
        open_database();
        $qry =  "SELECT dm.IdModulo FROM detallemodulo dm WHERE dm.IdRol = $IdRol";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->modules_array[] = array("IdModulo"=>$row["IdModulo"]
        		
        		);
        				        
		    }
		    return true;
		}
		else{
			return false;
		}
    }
    
    
    
	function saveRegisterModulesDetail($IdModulo, $IdRol){
		 
        open_database();

        $qry = "INSERT INTO `detallemodulo` (`IdModulo`, `IdRol`)
				VALUES ($IdModulo,$IdRol);";
        
        
        $result = mysql_query($qry) or die(mysql_error());

        close_database();

    }
    
 	function UpdateModulesDetail($IdModulo, $IdRol){
		 
        open_database();

        $qry = "UPDATE `detallemodulo` SET IdModulo = $IdModulo, IdRol = $IdRol WHERE IdRol = $IdRol";
        
        $result = mysql_query($qry) or die(mysql_error());

        close_database();
    }
    
    
	function DeleteModulesDetail($IdRol){
		 
        open_database();

        $qry = "DELETE FROM `detallemodulo` WHERE IdRol = $IdRol";
        
        $result = mysql_query($qry) or die(mysql_error());

        close_database();
    }
    

   	
}
?>