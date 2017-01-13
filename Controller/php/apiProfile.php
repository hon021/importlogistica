<?php
include_once ("Controller.php");
include_once ( "../../System/user/StringTokenizer.php");
include_once ( "../../Controller/cnn/dataBaseConnection.php" );
include_once ( "../../Controller/querys/profilesQuerys.php" );
include_once ("../../System/user/session.php");
include ( "../../Controller/define/constants.php" );
include ("apiSmartyAbout.php");


class apiProfile extends Controller{
	
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
	
	
	
	function executeQueryProfiles()
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
    
    
	function executeGetProfilesCustomer()
    {
    	$idPerfil = $_REQUEST['idPerfil'];
    	
    	$profiles = $this->objQuerys->GetProfilesCustomer($idPerfil);
	  
		
	    if($profiles == true){
	        echo json_encode($this->objQuerys->profilesAdministrator_array);
	    }
	    else if ($profiles == false){
	        echo '{"IdPerfil":"00"}';
	        
	    }
    	//Llamar a GetMenu
    }
    
    
    function executeRegProfiles() {
		$IdRol = $_REQUEST['idRol'];
		$sbUsuario = $_REQUEST['sbUsuario'];
		$sbClave = $_REQUEST['sbClave'];
	
		$nuReg_profile = $this->objQuerys->saveRegisterProfile($IdRol, $sbUsuario, $sbClave);

	    echo $nuReg_profile;
       
    
    }
    
    
	function executeUpdProfiles() {
		$IdPerfil = $_REQUEST['idPerfil'];
		$IdRol = $_REQUEST['idRol'];
		$sbUsuario = $_REQUEST['sbUsuario'];
		$sbClave = $_REQUEST['sbClave'];
	
		$objUpd_profile = $this->objQuerys->updateProfile($IdPerfil, $IdRol, $sbUsuario, $sbClave);


	    if($objUpd_profile){
	        echo $objUpd_profile;
        }else {
	        echo "0"; 
        }
        
    
    }
    
    
   function executeGetUser() {
		$sbUsuario = $_REQUEST['sbUsuario'];
		$bolUser = $this->objQuerys->GetUser($sbUsuario);
	    if($bolUser){
	    	echo 0;
	    }else{
	    	echo 1;
	    }

    }
    
    
	function executeCambioClave() {
		$sbPassword = $_REQUEST['Clave'];
		$sbNewPassword = $_REQUEST['NuevaClave'];
          
		$sbUserName=getSession("username");

		$objUpd_profile = $this->objQuerys->updatePasswordProfile($sbUserName, $sbPassword, $sbNewPassword);
		
	 	if($objUpd_profile){
	        echo $objUpd_profile;
        }else {
	        echo "Cambio de clave exitoso!"; 
        }
		
    }
		

}

$objApiProfile = new apiProfile();
$sbAction = $_REQUEST['action'];
$objApiProfile->execute( $objApiProfile , $sbAction );


?>