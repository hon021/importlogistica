<?php
require "../../configuracion.php";
	
	function open_database(){
		$tns= "(DESCRIPTION =
    			(ADDRESS = (PROTOCOL = TCP)(HOST = ".ORACLE_HOST.")(PORT = ".ORACLE_PORT."))
    			(CONNECT_DATA =
     		 	(SERVER = DEDICATED)
      			(SERVICE_NAME = ".ORACLE_SERVICE_NAME.")
    			)
  				)";
		
		$db = $GLOBALS["connection"]=@oci_connect(ORACLE_USER, ORACLE_PASSWORD, $tns);
	}
	
	function close_database(){
	   @oci_close ($GLOBALS["connection"]);
	} 
	
	function commit(){
		@oci_commit($GLOBALS["connection"]);
	}
	
	function rollback(){
		@oci_rollback($GLOBALS["connection"]);
	}

?>