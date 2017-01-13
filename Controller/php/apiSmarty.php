<?php

//include_once ("../../libraries/Smarty3.1.11/libs/Smarty.class.php");
 require_once( "smarty/Smarty.class.php" );

class ApiSmarty extends Smarty
{
	function ApiSmarty()
	{
		$this->compile_dir = "View/smartyFolders/external/template_c";
		$this->config_dir =  "View/smartyFolders/template/config";
		$this->cache_dir =   "View/smartyFolders/template/cache";
	}
}

?>