<?php
require "../../configuracion.php";

function open_database(){

	$server = MS_HOST.":".MS_PORT;
	if(!$GLOBALS["connection"]=mysql_connect($server , MS_USER, MS_PASSWORD))
		trigger_error("No se Pudo establecer la Conexión", E_USER_ERROR);
	else	
		if(!mysql_select_db(MS_DBNAME) or mysql_error())
		trigger_error("No se Pudo encontrar la base de datos", E_USER_ERROR);
    		
}

function close_database(){
    @mysql_close($GLOBALS["connection"]);
} 

function begin() {
	@mysql_query("BEGIN");
}

function commit(){
	@mysql_query("COMMIT");
}

function rollback(){
	@mysql_query("ROLLBACK");
}
?>
