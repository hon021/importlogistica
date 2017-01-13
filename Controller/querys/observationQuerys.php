<?php
class ObservationQuerys {
   
    public  $observation_array;
    public  $observationAdministrator_array;

    function __construct()
    {
        $this->observation_array [] = array();
        $this->observationAdministrator_array = array();
    }
     

     function Observation(){
	
        open_database();
        $qry =  "SELECT IdObservaciones, IdLocalizacion, IdEnvios, FechaIngreso, Observacion FROM observaciones WHERE Estado = '".ACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->observation_array[] = array("IdObservaciones"=>$row["IdObservaciones"],
        									   "IdLocalizacion"=>$row["IdLocalizacion"],
				        					   "IdEnvios"=>$row["IdEnvios"],
        		 							   "FechaIngreso"=>$row["FechaIngreso"],
        		 							   "Observacion"=>$row["Observacion"]
        		);
        				        
		    }
		    return true;
		}
		else{
			return false;
		}
    }
    
    
	function GetObservationId($nuId){
	
        open_database();
        $qry =  "SELECT IdObservaciones, IdLocalizacion, IdEnvios, FechaIngreso, Observacion FROM observaciones WHERE IdObservaciones = $nuId  AND Estado = '".ACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->observationAdministrator_array = array("IdObservaciones"=>$row["IdObservaciones"],
        									   "IdLocalizacion"=>$row["IdLocalizacion"],
				        					   "IdEnvios"=>$row["IdEnvios"],
        		 							   "FechaIngreso"=>$row["FechaIngreso"],
        		 							   "Observacion"=>$row["Observacion"]
        		);
        				        
		    }
		    return true;
		}
		else{
			return false;
		}
    }
    
    
    
	function saveRegisterObservation($IdMercancia, $IdLocalizacion, $dtFechaIngreso, $sbObservaciones){
        open_database();

        $qry = "INSERT INTO `observaciones` (`IdLocalizacion`, `IdEnvios`, `FechaIngreso`, `Observacion`, `Estado`)
				VALUES ($IdLocalizacion, $IdMercancia, '$dtFechaIngreso', '$sbObservaciones', '".ACTIVE_STATE."');";
        
        
        $result = mysql_query($qry) or die(mysql_error());

        close_database();
    }
 	
    
	function UpdateObservation($IdObservaciones, $IdMercancia, $IdLocalizacion, $dtFechaIngreso, $sbObservaciones){
		 
        open_database();

        $qry = "UPDATE `observaciones` SET IdLocalizacion = $IdLocalizacion, IdEnvios = $IdMercancia, FechaIngreso = '$dtFechaIngreso', Observacion = '$sbObservaciones'  WHERE IdObservaciones = $IdObservaciones";
        
        $result = mysql_query($qry) or die(mysql_error());

        close_database();
    }
    
    
	function InactiveObservation ($IdObservaciones){
	
        open_database();
        $qry =  "SELECT * FROM observaciones WHERE IdObservaciones = $IdObservaciones AND Estado = '".ACTIVE_STATE."'";
        
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	open_database();
			$qry = "UPDATE `observaciones` SET Estado = '".INACTIVE_STATE."' WHERE IdObservaciones = $IdObservaciones";
        
        	$result = mysql_query($qry) or die(mysql_error());
        	close_database();

        	return true;
        }
		else{
			return false;
		}
    }

   	
}
?>