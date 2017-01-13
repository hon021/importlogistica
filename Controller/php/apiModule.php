<?php
include_once ("Controller.php");
include_once ( "../../Controller/cnn/dataBaseConnection.php" );
include_once ( "../../Controller/querys/modulesQuerys.php" );
include_once ("../../System/user/session.php");
include ( "../../Controller/define/constants.php" );
include ("apiSmartyAbout.php");

class apiModule extends Controller{
	private $objSmarty;
	private $objQuerys;
	private $ArrayIdModulo;
    private	$ArrayNombreModulo;
	
	function __construct()
	{
		$this->objQuerys = new ModulesQuerys();
		$this->objSmarty = new ApiSmartyAbout();
		$this->objSmarty->template_dir = "../../View";

	}
	
	
	function executeGetModulos()
    {    	
    	
    	$roles = $this->objQuerys->Modules();

	    if($roles == true){
	        echo json_encode($this->objQuerys->modules_array);
	    }
	    else if ($roles == false){
	        echo '{"IdModulo":"00"}';
	        
	    }
    
    }

	function executeGetModulosRol()
    {    	
    	
    	$IdRol = $_REQUEST['nuRol'];
    	
    	$roles = $this->objQuerys->Modules_Rol($IdRol);

	    if($roles == true){
	        echo json_encode($this->objQuerys->modules_array);
	    }
	    else if ($roles == false){
	        echo '{"IdModulo":"00"}';
	        
	    }
    }
    
    
    
	function executeViewModulo() {
		 
		    $sbTitulo="Modulos";

			$this->objSmarty->template_dir = "../../View/modulo";
			$this->objSmarty->assign("Titulo",$sbTitulo);
			$this->objSmarty->display ("modulos.html");
		
	}
		

}

$objApiModule = new apiModule();
$sbAction = $_REQUEST['action'];
$objApiModule->execute( $objApiModule , $sbAction );


?>