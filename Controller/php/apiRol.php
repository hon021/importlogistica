<?php
include_once ("Controller.php");
include_once ( "../../Controller/cnn/dataBaseConnection.php" );
include_once ( "../../Controller/querys/rolQuerys.php" );
include_once ( "../../Controller/querys/modulesQuerys.php" );
include_once ("../../System/user/session.php");
include ( "../../Controller/define/constants.php" );
include ("apiSmartyAbout.php");

class apiRol extends Controller{
	private $objSmarty;
	private $objQuerys;
	private $objQuerysModule;
	private $ArrayIdModulo;
    private	$ArrayNombreModulo;
	
	function __construct()
	{
		$this->objQuerys = new RolQuerys();
		$this->objQuerysModule = new ModulesQuerys();
		$this->objSmarty = new ApiSmartyAbout();
		$this->objSmarty->template_dir = "../../View";

	}
	

	function executeGetRol()
    {    	
    	$roles = $this->objQuerys->Rol();

	    if($roles == true){
	        echo json_encode($this->objQuerys->rol_array);
	    }
	    else if ($roles == false){
	        echo '{"IdRol":"00"}';
	        
	    }
    }
    
 	function executeGetNombreRol() {
		$sbNombre = $_REQUEST['sbNombre'];
		$bolRol = $this->objQuerys->getNombreRol($sbNombre);
	    if($bolRol){
	    	echo 0;
	    }else{
	    	echo 1;
	    }
    }
    
    
 	function executeRegRol() {
		$sbNombre = $_REQUEST['sbNombre'];
		
		$objReg_role = $this->objQuerys->saveRegisterRole($sbNombre);

		echo $objReg_role;
    
    }
    
	function executeUpdRol() {
		$IdRol = $_REQUEST['idRol'];
		$sbNombre = $_REQUEST['sbNombre'];
		
		$objUpd_rol = $this->objQuerys->updateRole($IdRol, $sbNombre);


	    if($objUpd_rol){
	        echo $objUpd_rol;
        }else {
	        echo "0"; 
        }
        
    
    }
    
    
	function executeInactiveRol() {
		$IdRol = $_REQUEST['idRol'];
		
		$objInactive_rol = $this->objQuerys->InactiveRole($IdRol);

        if($objInactive_rol){
	        echo "Proceso Exitoso!";
        }else {
	        echo $objInactive_rol;
	    }
    
    }
    
    
	function executeViewRol() {
		 
		    $sbTitulo="Roles";
		  
		    $this->objQuerysModule->Modules();	
			foreach ($this->objQuerysModule->modules_array as $Modules) {
			    $this->ArrayIdModulo[]=$Modules["IdModulo"];
				$this->ArrayNombreModulo[]=$Modules["Nombre"];
		    }
		    
			$this->objSmarty->template_dir = "../../View/rol";
			$this->objSmarty->assign("array_NombreModulo",$this->ArrayNombreModulo);
			$this->objSmarty->assign("array_IdModulo",$this->ArrayIdModulo);
			$this->objSmarty->assign("Titulo",$sbTitulo);
			$this->objSmarty->display ("roles.html");
		
	}
		

}

$objApiRol = new apiRol();
$sbAction = $_REQUEST['action'];
$objApiRol->execute( $objApiRol , $sbAction );


?>