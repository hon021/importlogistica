<?php
include_once ("Lenguage/Spanish/L.sesion.php");
include_once ("Controller/php/Controller.php");
include ("Controller/php/apiSmarty.php");

class frmMain extends Controller{
    
	private $objSmarty;
	
	function __construct()
	{
		$this->objSmarty = new ApiSmarty();
		$this->objSmarty->template_dir = "View/";

	}
	function executeFormMain(){
		$this->objSmarty->assign("Label_Login",LABEL_LOGIN);
		$this->objSmarty->assign("Label_About",LABEL_ABOUT);
		$this->objSmarty->assign("Label_App",LABEL_APP);
		$this->objSmarty->assign("Label_Version",LABEL_VERSION);
		
		//$this->objSmarty->assign("user",sbUser);
		//$this->objSmarty->assign("password",sbPassword);
		$this->objSmarty->display ("main.html");
	}
}

$objFrmIndex = new frmMain();
$sbAction = $_REQUEST['action'];
$objFrmIndex->execute( $objFrmIndex , $sbAction );

?>