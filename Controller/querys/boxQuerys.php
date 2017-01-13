<?php
class BoxQuerys {
	 
	public  $box_array;
	public  $boxAdministrator_array;

	function __construct()
	{
		$this->box_array [] = array();
		$this->boxAdministrator_array = array();
	}
	 
	function GetCajaById($sbId)
	{
		open_database();
		$qry = "select IdCajas, IdMercancia, IdEstado, CodigoBarras, Estado from cajas where IdCajas = '$sbId' ";
		$result = mysql_query($qry) or die(mysql_error());
		 
		if(mysql_num_rows($result)!=0)
		{
			while($row = mysql_fetch_array($result))
			{
				$this->Caja_Array[] = array("IdCajas"=>$row["IdCajas"],
													"IdMercancia"=>$row["IdMercancia"],
													"IdEstado"=>$row["IdEstado"],
													"CodigoBarras"=>$row["CodigoBarras"],
													"Estado"=>$row["Estado"]
				);
			}
			return true;
		}
		else
		return false;
		 
	}
	
	function SaveCaja($sbMercancia, $sbEstado ,$sbCodigoBarras)
	{
		open_database();
		$qry = "INSERT INTO `cajas` (`IdMercancia` , `IdEstado` , `CodigoBarras` , `Estado`) values ('$sbMercancia', '$sbEstado', '$sbCodigoBarras' , '".ACTIVE_STATE."' );  ";
		$result = mysql_query($qry) or die (mysql_error());
		close_database();
	}
	
	function InactiveCaja($sbIdCajas)
	{
		open_database();

		$qry =  "SELECT * FROM cajas WHERE IdCajas = '$sbIdCajas' AND Estado = '".ACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result) != 0 ) 
        {		
        	open_database();
			$qry = "UPDATE `cajas` SET Estado = '".INACTIVE_STATE."' WHERE IdCajas = '$sbIdCajas'";
        
        	$result = mysql_query($qry) or die(mysql_error());
        	close_database();

        	return true;
        }
		else
		{
			open_database();

			$qry =  "SELECT * FROM cajas WHERE IdCajas = '$sbIdCajas' AND Estado = '".INACTIVE_STATE."'";
        	$result = mysql_query($qry) or die(mysql_error());
        	close_database();

        	if(mysql_num_rows($result) != 0 ) 
        	{		
        		open_database();
				$qry = "UPDATE `cajas` SET Estado = '".ACTIVE_STATE."' WHERE IdCajas = '$sbIdCajas'";
        
        		$result = mysql_query($qry) or die(mysql_error());
        		close_database();

        		return true;
        	}
			
			return false;
		}
		
	}
	
	function UpdtCaja($sbMercancia, $sbEstado ,$sbCodigoBarras , $sbIdCajas)
	{
		/*$Query = "UPDATE `cajas` set IdMercancia = $sbMercancia, IdEstado  = '$sbEstado' , CodigoBarras = '$sbCodigoBarras' where IdCajas = '$sbIdCajas' ;";
		return $Query;
		*/
		
		open_database();
		$qry = "UPDATE `cajas` set IdMercancia = $sbMercancia, IdEstado  = '$sbEstado' , CodigoBarras = '$sbCodigoBarras' where IdCajas = '$sbIdCajas' ;  ";
		$result = mysql_query($qry) or die (mysql_error());
		close_database();
	}
	
	function Box (){

		open_database();
		$qry =  "SELECT IdCajas, IdMercancia, IdEstado, CodigoBarras FROM  cajas WHERE Estado = '".ACTIVE_STATE."'";
		$result = mysql_query($qry) or die(mysql_error());
		close_database();

		if(mysql_num_rows($result)!=0) {
			 
			while($row = mysql_fetch_array($result)) {

				$this->box_array []= array("IdCajas"=>$row["IdCajas"],
        								   "IdMercancia"=>$row["IdMercancia"],
        								   "IdEstado"=>$row["IdEstado"],
        		                           "CodigoBarras"=>$row["CodigoBarras"]);

			}
			return true;
		}
		else{
				
			$this->box_array []= array("IdCajas"=>"0",
        								 "IdMercancia"=>"0",
        								 "IdEstado"=>"0",
        		                         "CodigoBarras"=>"0");
			return false;
		}
	}

}
?>