<?php
include_once ("../../Lenguage/Spanish/L.sesion.php");
include_once ("../../Lenguage/Spanish/L.acerca.php");
include_once ("../../System/user/session.php");
include_once ("Controller.php");
include ("apiSmartyAbout.php");

class frmAbout extends Controller{
    
	private $objSmarty;
	
	
	function __construct()
	{	
		$this->objSmarty = new ApiSmartyAbout();
		$this->objSmarty->template_dir = "../../View/templates";

	}
	function executeForMain(){
		$this->objSmarty->assign("login",OpenSeason);
		$this->objSmarty->assign("user",User);
		$this->objSmarty->assign("about",About);
		$this->objSmarty->assign("password",Password);
		$this->objSmarty->display ("main.html");
	}
	function executeAbout(){
		$this->objSmarty->assign("home",Home);
		$this->objSmarty->assign("Text1",Text1);
		$this->objSmarty->assign("Text2",Text2);
		$this->objSmarty->assign("Text3",Text3);
		$this->objSmarty->assign("Text4",Text4);
		$this->objSmarty->display ("about.html");
	}
}

$objFrmAbout = new frmAbout();
$sbAction = $_REQUEST['action'];
$objFrmAbout->execute( $objFrmAbout , $sbAction );
?>