<?php
class ReportQuerys {
   
    public  $report_array;
    public  $reportAdministrator_array;

    function __construct()
    {
        $this->report_array [] = array();
        $this->reportAdministrator_array = array();
    }
     

     function Report1 ($sbFechaIni, $sbFechaFin, $IdPerfil){

        open_database();
        $qry =  "SELECT c.DNI AS Cliente,
				       m.Nocajas AS NoCajas,
					   m.Cubicaje AS Cubicaje,
					   co.NroContenedor AS NroContenedor
				FROM cliente c, mercancia m, montenedor co
				WHERE c.IdCliente = m.IdCliente 
				AND m.IdContenedor = co.IdContenedor
				AND m.FechaIngreso 
				BETWEEN '$sbFechaIni' 
				AND '$sbFechaFin' 
				AND m.Estado = '".ACTIVE_STATE."'";
        
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->report_array []= array("Cliente"=>$row["Cliente"],
	        								  "NoCajas"=>$row["NoCajas"],
	        								  "Cubicaje"=>$row["Cubicaje"],
								        	  "NroContenedor"=>$row["NroContenedor"]);
        				        
		    }
		    return true;
		}
		else{
			return false;
		}
    }
    
    
	function Report2 ($sbFechaIni, $sbFechaFin, $DNI){

        open_database();
        $qry =  "SELECT c.DNI AS Cliente,
				       e.FechaEnvio AS FechaEnvio,
					   m.NoCoprobante AS NoComprobante,
					   m.Nocajas AS TotalCajas,
					   e.Nocajas AS CajasEnviadas,
				       m.Pendiente AS Pendientes
				FROM cliente c, mercancia m, envios e
				WHERE c.IdCliente = m.IdCliente
				AND m.IdMercancia = e.IdMercancia
				AND m.FechaIngreso 
				BETWEEN '$sbFechaIni' 
				AND '$sbFechaFin' 
				AND c.DNI = '$DNI'";
        
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->report_array []= array("Cliente"=>$row["Cliente"],
							        		  "FechaEnvio"=>$row["FechaEnvio"],
							        		  "NoComprobante"=>$row["NoComprobante"],
							        		  "TotalCajas"=>$row["TotalCajas"],
        									  "CajasEnviadas"=>$row["CajasEnviadas"],
							        		  "Pendientes"=>$row["Pendientes"]);
        				        
		    }
		    return true;
		}
		else{
			return false;
		}
    }
    
    
	function Report3 ($sbFechaIni, $sbFechaFin, $DNI){

        open_database();
        /*
        $qry =  "SELECT c.DNI AS Cliente,
				       m.NoCoprobante AS NoComprobante,
					   m.FechaIngreso AS FechaIngreso,
					   m.Nocajas AS TotalCajas,
					   m.Pendiente AS CajasActuales,
					   m.Cubicaje AS Cubicaje,
					   m.Notas AS Notas
				FROM Cliente c, Mercancia m
				WHERE c.IdCliente = m.IdCliente
				AND m.FechaIngreso 
				BETWEEN '$sbFechaIni' 
				AND '$sbFechaFin' 
				AND c.DNI = '$DNI'";
		*/
        $qry = "SELECT c.DNI AS Cliente,
				       m.NoCoprobante AS NoComprobante,
				       m.FechaIngreso AS FechaIngreso,
				       m.Nocajas AS TotalCajas,
				       CASE e.CajasEnviadas WHEN NULL THEN m.Nocajas 
				       ELSE m.Nocajas - e.CajasEnviadas 
				       END AS CajasActuales, m.Cubicaje AS Cubicaje, m.Notas AS Notas
				FROM cliente c INNER JOIN mercancia m ON  c.IdCliente = m.IdCliente LEFT JOIN 
				(SELECT m.IdMercancia , m.Nocajas CajasIniciales , env.NoCajas2 CajasEnviadas FROM mercancia M , 
				(SELECT IdMercancia,SUM(Nocajas) NoCajas2 FROM envios GROUP BY idMercancia) env WHERE M.IdMercancia = env.IdMercancia) e ON m.IdMercancia = e.IdMercancia
				WHERE c.DNI = '$DNI' AND m.FechaIngreso BETWEEN '$sbFechaIni' AND '$sbFechaFin'";
        
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->report_array []= array("Cliente"=>$row["Cliente"],
							        		  "NoComprobante"=>$row["NoComprobante"],
							        		  "FechaIngreso"=>$row["FechaIngreso"],
							        		  "TotalCajas"=>$row["TotalCajas"],
        									  "CajasActuales"=>$row["CajasActuales"],
							        		  "Cubicaje"=>$row["Cubicaje"],
        									  "Notas"=>$row["Notas"]);
        				        
		    }
		    return true;
		}
		else{
			return false;
		}
    }
    
    
	function Report4 ($sbFechaIni, $sbFechaFin, $DNI){

        open_database();
        $qry =  "SELECT c.DNI AS Cliente,
					   co.NroContenedor AS Contenedor,				           
					   m.NoCoprobante AS NoComprobante,
					   co.Descripcion AS Descripcion
				FROM cliente c, mercancia m, contenedor co
				WHERE c.IdCliente = m.IdCliente
				AND m.IdContenedor = co.IdContenedor 
				AND m.FechaIngreso 
				BETWEEN '$sbFechaIni' 
				AND '$sbFechaFin' 
				AND c.DNI = '$DNI'";
        
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->report_array []= array("Cliente"=>$row["Cliente"],
							        		  "Contenedor"=>$row["Contenedor"],
							        		  "NoComprobante"=>$row["NoComprobante"],
							        		  "Descripcion"=>$row["Descripcion"]);
        				        
		    }
		    return true;
		}
		else{
			return false;
		}
    }
    
    
    function Report5 ($sbFechaIni, $sbFechaFin, $sbCodCont){

        open_database();
        $qry =  "SELECT c.DNI AS Cliente,
					   co.NroContenedor AS Contenedor,				           
					   m.NoCoprobante AS NoComprobante,
					   co.Descripcion AS Descripcion
				FROM cliente c, mercancia m, contenedor co
				WHERE c.IdCliente = m.IdCliente
				AND m.IdContenedor = co.IdContenedor 
				AND m.FechaIngreso 
				BETWEEN '$sbFechaIni' 
				AND '$sbFechaFin' 
				AND co.NroContenedor  = '$sbCodCont'";
        
        $result = mysql_query($qry) or die(mysql_error());
        close_database();
        
        if(mysql_num_rows($result)!=0) {		
        	
        	while($row = mysql_fetch_array($result)) {
		    
        		$this->report_array []= array("Cliente"=>$row["Cliente"],
							        		  "Contenedor"=>$row["Contenedor"],
							        		  "NoComprobante"=>$row["NoComprobante"],
							        		  "Descripcion"=>$row["Descripcion"]);
        				        
		    }
		    return true;
		}
		else{
			return false;
		}
    }
    
  
}
?>