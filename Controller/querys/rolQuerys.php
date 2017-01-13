<?php
class RolQuerys {
   
    public  $rol_array;
    public  $rolAdministrator_array;

    function __construct()
    {
        $this->rol_array [] = array();
        $this->rolAdministrator_array = array();
    }
     

     function Rol (){

        open_database();
        $qry =  "SELECT IdRol, Estado, Nombre FROM rol WHERE Estado = '".ACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->rol_array []= array("IdRol"=>$row["IdRol"],
        									"Estado"=>$row["Estado"],
        									"Nombre"=>$row["Nombre"]);
        				        
		    }
		    return true;
		}
		else{
			
			$this->rol_array []= array("IdRol"=>"0",
        							   "Estado"=>"0",
        							    "Nombre"=>"Sin Rol");
			return false;
		}
    }
    
    
   function getNombreRol ($sbNombre){
	
        open_database();
        $qry =  "SELECT IdRol FROM rol WHERE Nombre = '$sbNombre'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)==0) {		
        	return true;
        }
		else{
			return false;
		}
    }
    
    
    function ActiveRol ($IdRol){

        open_database();
        $qry =  "SELECT IdRol, Estado, Nombre FROM rol WHERE IdRol = $IdRol AND Estado = '".INACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	open_database();
			$qry = "UPDATE `rol` SET Estado= '".ACTIVE_STATE."' WHERE IdRol = $IdRol";
        
        	$result = mysql_query($qry) or die(mysql_error());
        	close_database();

        	return true;
        }
		else{
			return false;
		}
    }
    
    
   function InactiveRole ($IdRol){

        open_database();
        $qry =  "SELECT IdRol, Estado, Nombre FROM rol WHERE IdRol = $IdRol AND Estado = '".ACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	open_database();
			$qry = "UPDATE `rol` SET Estado = '".INACTIVE_STATE."' WHERE IdRol = $IdRol";
        
        	$result = mysql_query($qry) or die(mysql_error());
        	close_database();

        	return true;
        }
		else{
			return false;
		}
    }
    
    
    function saveRegisterRole($Nombre){
		 
        open_database();

        $qry = "INSERT INTO `rol` (`Estado`, `Nombre`)
				VALUES ('".ACTIVE_STATE."','$Nombre');";
        
        
        $result = mysql_query($qry) or die(mysql_error());

        $nuIdRol=mysql_insert_id();
        
        close_database();
        
        return $nuIdRol;
    }
    
    
	function updateRole($IdRol, $Nombre){
 
        open_database();

        $qry = "UPDATE `rol` SET Nombre = '$Nombre' WHERE IdRol = $IdRol";

        $result = mysql_query($qry) or die(mysql_error());
    
        close_database();
        
    }
}
?>