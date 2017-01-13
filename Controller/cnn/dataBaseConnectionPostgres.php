<?php

	function open_database(){
		$GLOBALS["connection"]=pg_connect("user=".DB_USER." port=".DB_PORT." dbname=".DB_NAME." host=".DB_HOST. "password=".DB_PASS) or die( pg_last_error());
	}
	
	function close_database(){
	   pg_close($GLOBALS["connection"]);
	} 
	
	function begin() {
		@pg_query("BEGIN");
	}
	
	function commit(){
		@pg_query("COMMIT");
	}
	
	function rollback(){
		@pg_query("ROLLBACK");
	}

?>
