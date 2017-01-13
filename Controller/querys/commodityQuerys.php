<?php
class commodityQuerys {

    public  $commodity_array;
    public  $commodityAdministrator_array;

    function __construct()
    {
        $this->commodity_array[] = array();
        $this->commodityAdministrator_array = array();
    }
    
    function GetCommodityState()
    {
    	open_database();
    	$qry = "SELECT IdEstado, Descripcion FROM  estadocaja where Estado = '".ACTIVE_STATE."' ";
    	$result = mysql_query($qry) or die(mysql_error());
    	close_database();
    	
    	if(mysql_num_rows($result) != 0)
    	{
    		while($row = mysql_fetch_array($result)) 
    		{
    			$this->commodity_array[]= array("IdEstado"=>$row["IdEstado"],
    										"Descripcion"=>$row["Descripcion"]);
    		}
    		return true;
    	}
    	else 
    	{
    		$this->commodity_array[]= array("IdEstado"=>"0",
    										"Descripcion"=>"0");
    		return false;
    	}
    }
    
	function Commodity ()
    {

        open_database();
        $qry =  "SELECT IdMercancia, cli.DNI AS ClienteDNI, NoCoprobante, Nocajas, Cubicaje , Notas, FechaIngreso FROM  mercancia  as mer , cliente cli where cli.idCliente  = mer.IdCliente and mer.Estado = '".ACTIVE_STATE."' order by cli.DNI";
        //$qry = "SELECT IdMercancia, cli.DNI AS ClienteDNI, NoCoprobante, Nocajas, Cubicaje , Notas, FechaIngreso FROM  Mercancia  AS mer , cliente cli WHERE cli.idCliente  = mer.IdCliente AND cli.IdPerfil = $sbIdPerfil AND mer.Estado = '".ACTIVE_STATE."' ORDER BY cli.DNI";
        
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
                
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->commodity_array[]= array("IdMercancia"=>$row["IdMercancia"],
        									    "ClienteDNI"=>$row["ClienteDNI"],
        									    "NoCoprobante"=>$row["NoCoprobante"],
        		                                "Nocajas"=>$row["Nocajas"],
                                                "Cubicaje"=>$row["Cubicaje"],
                                                "Notas"=>$row["Notas"],
        										"FechaIngreso"=>$row["FechaIngreso"]);
        				        
		    }
		    return true;
		    
		}
		else{
			return false;
		}
    }
    
    
    function CommodityByPerfil ($sbIdPerfil, $sbIdRol)
    {

        open_database();
        
        if($sbIdRol=="2"){
        	$qry =  "SELECT IdMercancia, cli.DNI AS ClienteDNI, NoCoprobante, Nocajas, Cubicaje, Notas, FechaIngreso FROM  mercancia AS mer , cliente cli WHERE cli.idCliente  = mer.IdCliente AND cli.IdPerfil = $sbIdPerfil AND mer.Estado = '".ACTIVE_STATE."' ORDER BY cli.DNI";   	
        }else{
        	$qry =  "SELECT IdMercancia, cli.DNI AS ClienteDNI, NoCoprobante, Nocajas, Cubicaje, Notas, FechaIngreso FROM  mercancia As mer , cliente cli WHERE cli.idCliente  = mer.IdCliente AND mer.Estado = '".ACTIVE_STATE."' ORDER BY cli.DNI";
        }
        
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
                
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->commodity_array[]= array("IdMercancia"=>$row["IdMercancia"],
        									    "ClienteDNI"=>$row["ClienteDNI"],
        									    "NoCoprobante"=>$row["NoCoprobante"],
        		                                "Nocajas"=>$row["Nocajas"],
                                                "Cubicaje"=>$row["Cubicaje"],
                                                "Notas"=>$row["Notas"],
        										"FechaIngreso"=>$row["FechaIngreso"]);
        				        
		    }
		    return true;
		    
		}
		else{
			return false;
		}
    }
    

    function GetMercanciaById($sbID) 
    {

        open_database();
        $qry =  "SELECT IdMercancia, IdCliente, NoCoprobante, Nocajas, Cubicaje , Notas, FechaIngreso, Estado FROM mercancia WHERE  IdMercancia = '$sbID' ";//Estado = '".ACTIVE_STATE."' and
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {        
            while($row = mysql_fetch_array($result)) {
                
                    $this->Mercancia_Array[] = array("IdMercancia"=>$row["IdMercancia"],
                                                    "IdCliente"=>$row["IdCliente"],
                                                    "NoCoprobante"=>$row["NoCoprobante"],
                                                    "Nocajas"=>$row["Nocajas"],
                                                    "Cubicaje"=>$row["Cubicaje"],
                                                    "Notas"=>$row["Notas"],
                    								"FechaIngreso"=>$row["FechaIngreso"],
                                                    "Estado"=>$row["Estado"] );                                  
             }          
            return true;
        }
        else{
            return false;
        }
          
    } 

     function UpdateCommodity($IdMercancia, $IdCliente, $noComprobante, $Nocajas ,  $Cubicaje , $Notas, $dtFechaIngreso)
     {
        
        open_database();

        $qry = "UPDATE `mercancia` set IdCliente = $IdCliente, NoCoprobante = '$noComprobante', Nocajas = $Nocajas, Cubicaje = '$Cubicaje', Notas = '$Notas', FechaIngreso = '$dtFechaIngreso' WHERE IdMercancia = '$IdMercancia' ;";
        
        $result = mysql_query($qry) or die(mysql_error());

        close_database();
    }
    
    function saveRegisterCommodity($IdCliente, $noComprobante, $Nocajas ,  $Cubicaje , $Notas, $dtFechaIngreso)
    {
        open_database();

        /*$qry = "INSERT INTO `Mercancia` ( `IdCliente`, `IdContenedor`, `NoCoprobante`, `FechaIngreso`, `Estado`)
				VALUES ($IdCliente, $IdContenedor, $nuComprobante, '$dtFecha', '".ACTIVE_STATE."');";*/

        $qry = "INSERT INTO `mercancia` ( `IdCliente`,  `NoCoprobante`, `Nocajas` , `Cubicaje` , `Notas` , `FechaIngreso` , `Estado`) VALUES ($IdCliente , '$noComprobante', $Nocajas , '$Cubicaje' , '$Notas', '$dtFechaIngreso', '".ACTIVE_STATE."');";
        
        $result = mysql_query($qry) or die(mysql_error());

        close_database();
    }


    function InactiveMercancia($IdMer)
    {
        open_database();

        $qry =  "SELECT idMercancia FROM mercancia WHERE idMercancia = '$IdMer' AND Estado = '".ACTIVE_STATE."'";
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result) != 0 ) 
        {       
            open_database();
            $qry = "SELECT env.IdEnvios  FROM `envios` env , `mercancia` mer  where mer.IdMercancia = env.idMercancia  and  env.Estado = '".ACTIVE_STATE."' and mer.IdMercancia = '$IdMer' ";
            
            $result = mysql_query($qry) or die(mysql_error());
            close_database();
            if(mysql_num_rows($result) != 0 ) 
            {
                return "Error al inactivar la mercancia debido a que tiene envios asociados";
            }
            else 
            {
                open_database();
                $qry = "SELECT ca.IdCajas  FROM `cajas` ca , `mercancia` mer  where mer.IdMercancia = ca.idMercancia and  ca.Estado = '".ACTIVE_STATE."' and mer.IdMercancia = '$IdMer' ";
                
                $result = mysql_query($qry) or die(mysql_error());
                close_database();
                if(mysql_num_rows($result) != 0 ) 
                {
                    return "Error al inactivar la mercancia debido a que tiene cajas asociados";
                }
                else
                {
                    open_database();
                    $qry = "UPDATE `mercancia` SET Estado = '".INACTIVE_STATE."' WHERE idMercancia = '$IdMer'";
                
                    $result = mysql_query($qry) or die(mysql_error());
                    close_database();

                    return "Actualizacion Exitosa!";
                }
            }
            
        }
        else
        {
            open_database();

            $qry =  "SELECT * FROM mercancia WHERE idMercancia = '$IdMer' AND Estado = '".INACTIVE_STATE."'";
            $result = mysql_query($qry) or die(mysql_error());
            close_database();

            if(mysql_num_rows($result) != 0 ) 
            {       
                open_database();
                $qry = "UPDATE `mercancia` SET Estado = '".ACTIVE_STATE."' WHERE idMercancia = '$IdMer'";
        
                $result = mysql_query($qry) or die(mysql_error());
                close_database();

                return "Actualizacion Exitosa!";
            }
            
            return "Error al Actualizar la Mercancia!";
        }
    }

}
?>