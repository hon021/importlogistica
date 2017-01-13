<?php
include_once ("Controller.php");
include_once ( "../../System/user/StringTokenizer.php");
include_once ( "../../Controller/cnn/dataBaseConnection.php" );
include_once ( "../../Controller/querys/profilesQuerys.php" );
include_once ("../../System/user/session.php");
include ( "../../Controller/define/constants.php" );
include ("apiSmartyAbout.php");


class apiMenu extends Controller{
	
	private $objSmarty;
	private $objQuerys;
	private $ArrayCodigoPermiso;
    private	$ArrayNombreModulo;
	
	function __construct()
	{

		$this->objQuerys = new ProfilesQuerys();
		$this->objSmarty = new ApiSmartyAbout();
		$this->objSmarty->template_dir = "../../View";

	}
	
	
	//ArrayCodigoPermiso
	function setArrayCodigoPermiso($ArrayCodigoPermiso){
		$this->ArrayCodigoPermiso=$ArrayCodigoPermiso;

	}

	function getArrayCodigoPermiso(){
		return $this->ArrayCodigoPermiso;
	}
	
	
	
    //ArrayNombreModulo
	function setArrayNombreModulo($ArrayNombreModulo){
		$this->ArrayNombreModulo=$ArrayNombreModulo;

	}

	function getArrayNombreModulo(){
		return $this->ArrayNombreModulo;
	}
	
	
	
	function executeProfiles()
    {
    	$idRol = $_REQUEST['idRol'];
    	
    	$profiles = $this->objQuerys->Profiles($idRol);

	    if($profiles == true){
	        echo json_encode($this->objQuerys->profiles_array);
	    }
	    else if ($profiles == false){
	        echo '{"CodigoPermiso":"00"}';
	        
	    }
    	//Llamar a GetMenu
    }
		
	
	function executeGetMenu() {
		    $CodigoPermiso=$_REQUEST["array_CodigoPermiso"];
		    $NombreModulo=$_REQUEST["array_NombreModulo"];
		    $sbLogin=$_REQUEST["sbLogin"];
		    
		    $sbIdRol=getSession("idrol");
		    
		    //Parser
			$objParserCodigoPermiso = new StringTokenizer($CodigoPermiso, ";");
			$objParserNombreModulo = new StringTokenizer($NombreModulo, ";");
			//Cantidad de Registros Recibos
			$nuCodigoPermiso=$objParserCodigoPermiso->nuSize;
			$nuNombreModulo=$objParserNombreModulo->nuSize;
			
			
		    for ($i = 0; $i < $nuCodigoPermiso; $i++){
		    	$this->ArrayCodigoPermiso[] =$objParserCodigoPermiso->nextToken();
			}
			
	        for ($i = 0; $i < $nuNombreModulo; $i++){
		    	$this->ArrayNombreModulo[] =$objParserNombreModulo->nextToken();
			}

			$this->objSmarty->template_dir = "../../View";
			$this->objSmarty->assign("array_CodigoPermiso",$this->getArrayCodigoPermiso());
			$this->objSmarty->assign("array_NombreModulo",$this->getArrayNombreModulo());
			$this->objSmarty->assign("sbLogin",$sbLogin);
			$this->objSmarty->assign("IdRol",$sbIdRol);
			$this->objSmarty->display ("menu.html");			
	}
	
	
     function executeGetMain() {

		    $sbTitulo="Bienvenido";
			$this->objSmarty->template_dir = "../../View";
			$this->objSmarty->assign("Titulo",$sbTitulo);
			$this->objSmarty->display ("start.html");
				
	}
	
	
}


$objApiMenu = new apiMenu();
$sbAction = $_REQUEST['action'];
$objApiMenu->execute( $objApiMenu , $sbAction );


?>