<?php
class ModulesQuerys {
   
    public  $modules_array;
    public  $modulesAdministrator_array;

    function __construct()
    {
        $this->modules_array [] = array();
        $this->modulesAdministrator_array = array();
    }
     

     function Modules (){
	
        open_database();
        $qry =  "SELECT IdModulo, Nombre, CodigoPermiso FROM modulo WHERE Estado = '".ACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->modules_array[] = array("IdModulo"=>$row["IdModulo"],
        									   "Nombre"=>$row["Nombre"],
				        					   "CodigoPermiso"=>$row["CodigoPermiso"]
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

   	
}
?>