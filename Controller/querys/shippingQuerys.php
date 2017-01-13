<?php
class shippingQuerys {
	 
	public  $shipping_array;
	public  $shippingAdministrator_array;

	function __construct()
	{
		$this->shipping_array [] = array();
		$this->shippingAdministrator_array = array();
	}
	
	
	function Shipping(){

		open_database();
		$qry =  "SELECT IdEnvios, IdMercancia, IdContenedor, Nocajas, FechaEnvio, Estado FROM envios WHERE Estado = '".ACTIVE_STATE."'";
		$result = mysql_query($qry) or die(mysql_error());
		close_database();

		if(mysql_num_rows($result)!=0) {
			 
			while($row = mysql_fetch_array($result)) {

				$this->shipping_array []= array("IdEnvios"=>$row["IdEnvios"],
        								   "IdMercancia"=>$row["IdMercancia"],
        								   "IdContenedor"=>$row["IdContenedor"],
        		                           "Nocajas"=>$row["Nocajas"],
										   "FechaEnvio"=>$row["FechaEnvio"]);

			}
			return true;
		}
		else{
				
			$this->shipping_array []= array("IdEnvios"=>"0",
        								   "IdMercancia"=>"0",
        								   "IdContenedor"=>"0",
        		                           "Nocajas"=>"0",
										   "FechaEnvio"=>"0");
			return false;
		}
	}

	function GetShippingList(){

		open_database();
		$qry =  "SELECT env.IdEnvios, env.FechaEnvio AS FechaEnvio, cl.DNI AS DNI, mer.NoCoprobante as NoCoprobante , con.NroContenedor as NroContenedor , env.NoCajas as NoCajas FROM envios env, mercancia mer, contenedor con, cliente cl  WHERE env.Estado = '".ACTIVE_STATE."' and env.IdMercancia = mer.IdMercancia  and env.IdContenedor = con.IdContenedor and mer.IdCliente = cl.IdCliente ";

		$result = mysql_query($qry) or die(mysql_error());
		close_database();

		if(mysql_num_rows($result)!=0) {
			 
			while($row = mysql_fetch_array($result)) {

				$this->shipping_array []= array("IdEnvios"=>$row["IdEnvios"],
        								   "FechaEnvio"=>$row["FechaEnvio"],
        								   "DNI"=>$row["DNI"],
        		                           "NoCoprobante"=>$row["NoCoprobante"],
										   "NroContenedor"=>$row["NroContenedor"],
										   "NoCajas"=>$row["NoCajas"]);

			}
			return true;
		}
		else{
				
			$this->shipping_array []= array("IdEnvios"=>"0",
        								   "FechaEnvio"=>"0",
        								   "DNI"=>"0",
        		                           "NoCoprobante"=>"0",
										   "NroContenedor"=>"0",
										   "NoCajas"=>"0");
			return false;
		}
	}
	 
	function GetEnvioById($sbIdEnvio)
	{
		open_database();
		$qry = "SELECT IdEnvios, IdMercancia, IdContenedor, Nocajas, FechaEnvio, Estado FROM envios WHERE IdEnvios = $sbIdEnvio";
		$result = mysql_query($qry) or die(mysql_error());
		close_database();
		
		if(mysql_num_rows($result)!=0)
		{
			while($row = mysql_fetch_array($result))
			{
				$this->shipping_array []= array("IdEnvios"=>$row["IdEnvios"],
        								   "IdMercancia"=>$row["IdMercancia"],
        								   "IdContenedor"=>$row["IdContenedor"],
        		                           "Nocajas"=>$row["Nocajas"],
										   "FechaEnvio"=>$row["FechaEnvio"]);
				
			}
			return true;
		}
		else
		return false;
		 
	}
	
	function SaveEnvio($sbMercancia, $sbContenedor, $sbNoCajas, $dtFechaEnvio)
	{
		open_database();
		$qry = "INSERT INTO `envios` (`IdMercancia` , `IdContenedor` , `Nocajas` , `FechaEnvio`, `Estado`) values ($sbMercancia, $sbContenedor, $sbNoCajas, '$dtFechaEnvio', '".ACTIVE_STATE."' );  ";
		$result = mysql_query($qry) or die (mysql_error());
		close_database();
		
		//---Actualiza Pendientes---
		/*
		$nuPendiente = 0;

		//Calcular Pendiente 
		open_database();
		$qry = "SELECT (m.Nocajas - e.Nocajas) AS Pendientes FROM Mercancia m, Envios e WHERE m.IdMercancia = e.IdMercancia AND e.IdMercancia = $sbMercancia";
		$result = mysql_query($qry) or die(mysql_error());
		close_database();
		 
		if(mysql_num_rows($result)!=0)
		{
			while($row = mysql_fetch_array($result))
			{
				$nuPendiente= $row["Pendientes"];						   
			}
		}
		
		
		$this->UpdtPendienteMercancia($sbMercancia,$nuPendiente);
		*/
	}
	
	
	function InactiveEnvio($sbIdEnvio)
	{
		open_database();

		$qry =  "SELECT * FROM envios WHERE IdEnvios = $sbIdEnvio AND Estado = '".ACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result) != 0 ) 
        {	

        	open_database();

			$qry =  "SELECT obs.IdObservaciones FROM observaciones obs, envios env WHERE obs.IdEnvios = env.IdEnvios and env.IdEnvios = $sbIdEnvio AND obs.Estado = '".ACTIVE_STATE."'";
			
	        $result = mysql_query($qry) or die(mysql_error());
	        close_database();
	        
	        if(mysql_num_rows($result) != 0 ) 
	        {	
	        	return "No se ha podido inactivar el envio debido a que tiene Observaciones Asociadas";
	        }else
	        {
	        	open_database();
				$qry = "UPDATE `envios` SET Estado = '".INACTIVE_STATE."' WHERE IdEnvios = '$sbIdEnvio'";
	        
	        	$result = mysql_query($qry) or die(mysql_error());
	        	close_database();

	        	return "Proceso Exitoso!";
	        }
        }
		else
		{
			open_database();

			$qry =  "SELECT * FROM envios WHERE IdEnvios = $sbIdEnvio AND Estado = '".INACTIVE_STATE."'";
        	$result = mysql_query($qry) or die(mysql_error());
        	close_database();

        	if(mysql_num_rows($result) != 0 ) 
        	{		
        		open_database();
				$qry = "UPDATE `envios` SET Estado = '".ACTIVE_STATE."' WHERE IdEnvios = $sbIdEnvio";
        
        		$result = mysql_query($qry) or die(mysql_error());
        		close_database();

        		return "Proceso Exitoso!";
        	}
			
			return "Ha ocurrido un error al actualizar!";
		}
		
	}
	
	function UpdtEnvio($sbMercancia, $sbContenedor, $sbNoCajas, $dtFechaEnvio, $sbIdEnvio)
	{
		open_database();
		$qry = "UPDATE `envios` set IdMercancia = $sbMercancia, IdContenedor  = $sbContenedor , Nocajas = $sbNoCajas, FechaEnvio = '$dtFechaEnvio' WHERE IdEnvios = $sbIdEnvio";
		$result = mysql_query($qry) or die (mysql_error());
		close_database();
		
		//---Actualiza Pendientes---
		/*
		$nuPendiente = 0;
		
		//Calcular Pendiente 
		open_database();
		$qry = "SELECT (m.Nocajas - e.Nocajas) AS Pendientes FROM Mercancia m, Envios e WHERE m.IdMercancia = e.IdMercancia AND e.IdMercancia = $sbMercancia";
		$result = mysql_query($qry) or die(mysql_error());
		close_database();
		 
		if(mysql_num_rows($result)!=0)
		{
			while($row = mysql_fetch_array($result))
			{
				$nuPendiente= $row["Pendientes"];						   
			}
		}
		
		
		$this->UpdtPendienteMercancia($sbMercancia,$nuPendiente);
		*/
	}
	
	
	function UpdtPendienteMercancia($sbMercancia,$nuPendiente)
	{

		open_database();
		$qry = "UPDATE `mercancia` SET Pendiente = $nuPendiente WHERE IdMercancia = $sbMercancia";
		$result = mysql_query($qry) or die (mysql_error());
		close_database();
	}
	
	

}
?>