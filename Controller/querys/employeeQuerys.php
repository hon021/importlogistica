<?php

class EmployeeQuerys
{
	public $Employee_Array;

	function __constructor()
	{
		$this->Employee_Array[] = array();
	}

	function UpdtEmployee($Nombre, $Apellido , $DNI , $Celular , $Fijo , $Email, $Sexo, $Cargo , $Perfil)
	{
		open_database();
		$Query = "UPDATE `empleados` SET IdPerfil = $Perfil, Nombre  = '$Nombre' , Apellido = '$Apellido'  , DNI = '$DNI', Celular = '$Celular', Fijo = '$Fijo', Email = '$Email', Genero = '$Sexo', Cargo = '$Cargo' WHERE DNI = '$DNI' ;";
		$result = mysql_query($Query) or die (mysql_error());
		close_database();
	}

	function SaveEmployee($Nombre, $Apellido , $DNI , $Celular , $Fijo , $Email, $Sexo, $Cargo , $Perfil)
	{
		open_database();
		$Query = "INSERT INTO `empleados` ( `IdPerfil` , `Nombre`, `Apellido`,`DNI`,`Celular`,`Fijo`, `Email`, `Estado`, `Genero`, `Cargo`)  values ( $Perfil, '$Nombre', '$Apellido', '$DNI' ,'$Celular','$Fijo', '$Email', '".ACTIVE_STATE."' ,'$Sexo', '$Cargo');";
		$result = mysql_query($Query) or die (mysql_error());
		close_database();
	}

	function InactiveEmpleado  ($sbDNI)
	{
		open_database();

		$qry =  "SELECT * FROM empleados WHERE DNI = '$sbDNI' AND Estado = '".ACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result) != 0 ) 
        {		
        	open_database();
			$qry = "UPDATE `empleados` SET Estado = '".INACTIVE_STATE."' WHERE DNI = '$sbDNI'";
        
        	$result = mysql_query($qry) or die(mysql_error());
        	close_database();

        	return true;
        }
		else
		{
			open_database();

			$qry =  "SELECT * FROM empleados WHERE DNI = '$sbDNI' AND Estado = '".INACTIVE_STATE."'";
        	$result = mysql_query($qry) or die(mysql_error());
        	close_database();

        	if(mysql_num_rows($result) != 0 ) 
        	{		
        		open_database();
				$qry = "UPDATE `empleados` SET Estado = '".ACTIVE_STATE."' WHERE DNI = '$sbDNI'";
        
        		$result = mysql_query($qry) or die(mysql_error());
        		close_database();

        		return true;
        	}
			
			return false;
		}
	}

 
	function getEmployee()
	{
		open_database();
		$qry = "SELECT IdEmpleado, IdPerfil, Nombre, Apellido, DNI, Celular, Fijo, Email, Estado, Genero, Cargo FROM empleados ";//WHERE Estado = '".ACTIVE_STATE."'
		$result = mysql_query($qry) or die (mysql_error());
		close_database();

		if(mysql_num_rows($result) != 0)
		{
			while ($row = mysql_fetch_array($result)) 
			{
				$this->Employee_Array[] = array("IdEmpleado"=>$row["IdEmpleado"],
													"IdPerfil"=>$row["IdPerfil"],
													"Nombre"=>$row["Nombre"],
													"Apellido"=>$row["Apellido"],
													"DNI"=>$row["DNI"],
													"Celular"=>$row["Celular"],
													"Fijo"=>$row["Fijo"],
													"Email"=>$row["Email"],
													"Estado"=>$row["Estado"],
													"Genero"=>$row["Genero"],
													"Cargo"=>$row["Cargo"]);
			}
			return true;
		}
		else 
		{
			return false;
		}
	}


	function getEmployeeLite()
	{
		open_database();
		$qry = "SELECT IdEmpleado, Nombre, Apellido, Genero, Cargo FROM empleados WHERE Estado = '".ACTIVE_STATE."' ";//WHERE Estado = '".ACTIVE_STATE."'
		$result = mysql_query($qry) or die (mysql_error());
		close_database();

		if(mysql_num_rows($result) != 0)
		{
			while ($row = mysql_fetch_array($result)) 
			{
				$this->Employee_Array[] = array("IdEmpleado"=>$row["IdEmpleado"],
													/*"IdPerfil"=>$row["IdPerfil"],*/
													"Nombre"=>$row["Nombre"],
													"Apellido"=>$row["Apellido"],
													/*"DNI"=>$row["DNI"],
													"Celular"=>$row["Celular"],
													"Fijo"=>$row["Fijo"],
													"Email"=>$row["Email"],
													"Estado"=>$row["Estado"],*/
													"Genero"=>$row["Genero"],
													"Cargo"=>$row["Cargo"]);
			}
			return true;
		}
		else 
		{
			return false;
		}
	}


	function getEmployeeById ($sbID)
	{
	
        open_database();
        $qry =  "SELECT IdEmpleado, IdPerfil, Nombre, Apellido, DNI, Celular, Fijo, Email, Estado, Genero, Cargo FROM empleados WHERE  DNI = '$sbID' ";//Estado = '".ACTIVE_STATE."' and
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
	        while($row = mysql_fetch_array($result)) {
			    
	        		$this->Employee_Array[] = array("IdEmpleado"=>$row["IdEmpleado"],
													"IdPerfil"=>$row["IdPerfil"],
													"Nombre"=>$row["Nombre"],
													"Apellido"=>$row["Apellido"],
													"DNI"=>$row["DNI"],
													"Celular"=>$row["Celular"],
													"Fijo"=>$row["Fijo"],
													"Email"=>$row["Email"],
													"Estado"=>$row["Estado"],
													"Genero"=>$row["Genero"],
													"Cargo"=>$row["Cargo"]
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