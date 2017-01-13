<?php
include_once ("Controller.php");
include_once ( "../../System/user/StringTokenizer.php");
include_once ( "../../Controller/cnn/dataBaseConnection.php" );
include_once ( "../../Controller/querys/modulesdetailQuerys.php" );
include_once ("../../System/user/session.php");
include ( "../../Controller/define/constants.php" );
include ("apiSmartyAbout.php");

class apiModuledetail extends Controller{
	private $objSmarty;
	private $objQuerys;
	private $ArrayIdModulo;
    private	$ArrayNombreModulo;
	
	function __construct()
	{
		$this->objQuerys = new ModulesDetailQuerys();
		$this->objSmarty = new ApiSmartyAbout();
		$this->objSmarty->template_dir = "../../View";

	}
	
	
	function executeGetDetalleModulos()
    {    	
    	
    	$roles = $this->objQuerys->ModulesDetail();

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
    
    
	function executeRegDetalleModulo() {
		$IdRol=$_REQUEST["idRol"];
		$array_Modulos=$_REQUEST["arrayModules"];
		
		$bolControl = true;
		
		//Parser
		$objParser = new StringTokenizer($array_Modulos, ";");
		//Cantidad de Modulos
		$NumReg=$objParser->nuSize;
		
	
		for ($i = 0; $i < $NumReg; $i++){         
			$IdModulo=$objParser->nextToken();
			$objReg_role = $this->objQuerys->saveRegisterModulesDetail($IdModulo, $IdRol);
			
			if($objReg_role){
		       echo $objReg_role;
		       $bolControl = false;
		       break;
	        }
		}
		
		if($bolControl)
	        echo "Registro Exitoso!";
		
    }

    function executeUpdDetalleModulo() {
    	
		$IdRol=$_REQUEST["idRol"];
		$array_Modulos=$_REQUEST["arrayModules"];
		$bolControl = true;
		
		
		if($this->DelDetalleModulo($IdRol)){
		
			//Parser
			$objParser = new StringTokenizer($array_Modulos, ";");
			//Cantidad de Modulos
			$NumReg=$objParser->nuSize;
			
		
			for ($i = 0; $i < $NumReg; $i++){         
				$IdModulo=$objParser->nextToken();
				$objReg_role = $this->objQuerys->saveRegisterModulesDetail($IdModulo, $IdRol);
				
				if($objReg_role){
			       echo $objReg_role;
			       $bolControl = false;
			       break;
		        }
			}
			
			if($bolControl)
		        echo "Actualizacion Exitosa!";
	        
		}else{
			echo "Error en el proceso!";
		}

    }
    
    
    function DelDetalleModulo($IdRol) {
     	$objReg_role = $this->objQuerys->DeleteModulesDetail($IdRol);
     	
     	if($objReg_role){
	        return false; //Error
        }else {
	        return true;  //Bien
 
	    }
    }
    

}

$objApiModule = new apiModuledetail();
$sbAction = $_REQUEST['action'];
$objApiModule->execute( $objApiModule , $sbAction );


?>