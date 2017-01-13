<?php
class ContainerQuerys {

	public  $container_array;

	function __constructor()
	{
		$this->container_array[] = array();
	}

	function InactiveContainer($sbID)
	{
		open_database();

        $qry =  "SELECT idContenedor FROM contenedor WHERE idContenedor = '$sbID' AND Estado = '".ACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result) != 0 ) 
        {      
        	open_database();

        	$qry =  "SELECT env.IdEnvios FROM contenedor con, Envios env WHERE env.IdContenedor = con.IdContenedor and con.idContenedor = '$sbID' AND con.Estado = '".ACTIVE_STATE."'";

	        $result = mysql_query($qry) or die(mysql_error());
	        close_database();
	        
	        if(mysql_num_rows($result) != 0 ) 
	        { 
				return "No se ha podido inactivar el envio debido a que tiene Envios Asociados";
			}
			else 
			{
	        	open_database();
	            $qry = "UPDATE `contenedor` SET Estado = '".INACTIVE_STATE."' WHERE idContenedor = '$sbID'";
	        
	            $result = mysql_query($qry) or die(mysql_error());
	            close_database();

	            return "Proceso Exitoso!";
	        }
        }
        else
        {
            open_database();

            $qry =  "SELECT idContenedor FROM contenedor WHERE idContenedor = '$sbID' AND Estado = '".INACTIVE_STATE."'";
            $result = mysql_query($qry) or die(mysql_error());
            close_database();

            if(mysql_num_rows($result) != 0 ) 
            {       
                open_database();
                $qry = "UPDATE `contenedor` SET Estado = '".ACTIVE_STATE."' WHERE idContenedor = '$sbID'";
        
                $result = mysql_query($qry) or die(mysql_error());
                close_database();

                return "Proceso Exitoso!";
            }
            
            return "Ha ocurrido un error al actualizar!";
        }
	}
 
	function SaveContainer( $NroContenedor , $NroInterno , $Descripcion)
	{
		open_database();
		$Query = "INSERT INTO `contenedor` (  `NroContenedor`,`NroInterno`,`Descripcion` , `Estado` )  values ( '$NroContenedor', '$NroInterno', '$Descripcion' , '".ACTIVE_STATE."' );";
		$result = mysql_query($Query) or die (mysql_error());
		close_database();
	}

	function UpdateContainer($idContenedor, $NroContenedor , $NroInterno , $Descripcion)
	{
		open_database();
		$Query = "UPDATE `contenedor` set NroContenedor  = '$NroContenedor' , NroInterno = '$NroInterno'  , Descripcion = '$Descripcion' where idContenedor = '$idContenedor' ;";
		$result = mysql_query($Query) or die (mysql_error());
		close_database();
	}

	function GetContainerById($sbID)
	{
	
        open_database();
        $qry =  "SELECT idContenedor, NroContenedor, NroInterno, Descripcion, Estado FROM contenedor WHERE  idContenedor = '$sbID' ";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) 
        {		
	        while($row = mysql_fetch_array($result)) 
	        {
			    
	        		$this->container_array[] = array("idContenedor"=>$row["idContenedor"],
													"NroContenedor"=>$row["NroContenedor"],
													"NroInterno"=>$row["NroInterno"],
													"Descripcion"=>$row["Descripcion"],
													"Estado"=>$row["Estado"]);	        				        
			 }        	
        	return true;
        }
		else
		{
			return false;
		}
    }

	function GetContainerList()
	{
		open_database();
		$qry =  "SELECT idContenedor, NroContenedor , Descripcion FROM contenedor WHERE Estado = '".ACTIVE_STATE."'";
		$result = mysql_query($qry) or die(mysql_error());
		close_database();

		if(mysql_num_rows($result)!=0) {
			 
			while($row = mysql_fetch_array($result)) 
			{

				$this->container_array[] = array("idContenedor"=>$row["idContenedor"],
				                                 "NroContenedor"=>$row["NroContenedor"],
										        "Descripcion"=>$row["Descripcion"]);

			}
			return true;
		}
		else{
			return false;
		}
	}

	
	function getContainer (){

		open_database();
		$qry =  "SELECT idContenedor, NroContenedor , Descripcion FROM contenedor WHERE Estado = '".ACTIVE_STATE."'";
		$result = mysql_query($qry) or die(mysql_error());
		close_database();

		if(mysql_num_rows($result)!=0) {
			 
			while($row = mysql_fetch_array($result)) {

				$this->container_array[] = array("idContenedor"=>$row["idContenedor"],
				                                 "NroContenedor"=>$row["NroContenedor"],
										         "Descripcion"=>$row["Descripcion"]);

			}
			return true;
		}
		else{
			$this->container_array[] = array("idContenedor"=>"0",
				                             "NroContenedor"=>"0",
										     "Descripcion"=>"0");
			
			return false;
		}
	}
}
?>