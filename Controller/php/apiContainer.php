<?php
include_once ("Controller.php");
include_once ( "../../Controller/cnn/dataBaseConnection.php" );
include_once ( "../../Controller/querys/containerQuerys.php" );
include ( "../../Controller/define/constants.php" );
include_once ( "../../Controller/querys/rolQuerys.php" );
include_once ("../../System/user/session.php");
include ("apiSmartyAbout.php");

class apiContainer extends Controller{

	private $objSmarty;
	private $objQuerys;
	private $objQuerysRol;
	
	function __construct()
	{
		$this->objQuerys = new ContainerQuerys();
		
		$this->objSmarty = new ApiSmartyAbout();
		$this->objSmarty->template_dir = "../../View/contenedor/";
	}
	/*
	function executeViewRegEmpleados() {
		 
		    $sbTitulo="Contenedor";		   
		     
			$this->objSmarty->template_dir = "../../View/container";
			$this->objSmarty->assign("array_NombreRol",$this->ArrayNombreRol);
			$this->objSmarty->assign("array_IdRol",$this->ArrayIdRol);
			$this->objSmarty->assign("Titulo",$sbTitulo);
			$this->objSmarty->display ("container.html");				
	}
*/
	function executeGetMain()
	{
		include_once ("../../Lenguage/Spanish/L.Container.php");

		$sbTitulo="Contenedor";
		$sbIdRol=getSession("idrol");

		$this->objSmarty->template_dir = "../../View/contenedor";		
		$this->objSmarty->assign("Titulo",$sbTitulo);
		$this->objSmarty->assign("Label_Tittle", LABEL_TITTLE);
		$this->objSmarty->assign("IdRol",$sbIdRol);

		$this->objSmarty->display ("contenedor.html");
	}
/*
	function executeGetEmployee()
	{
		$employee = $this->objQuerys->getEmployee();

		if($employee == true)
		{
			echo json_encode($this->objQuerys->Employee_Array);
		}
		else if($employee == false)
		{
			echo '{"IdEmpleado":"00"}';
		}
	}
*/
	function executeGetContainerList()
	{
		$container = $this->objQuerys->GetContainerList();
		if($container == true)
		{
			echo json_encode($this->objQuerys->container_array);
		}
		else if($container == false)
		{
			echo '{"idContenedor":"00"}';
		}
	}

	function executeGetContainerById()
	{
		$sbID = $_REQUEST['sbID'];
		$container = $this->objQuerys->GetContainerById($sbID);
		if($container == true)
		{
			echo json_encode($this->objQuerys->container_array);
		}
		else if( $container == false)
		{
			echo '{"idContenedor":"00"}';
		} 
	} 

	function executeRegContainer()
	{
		 //$NroContenedor , $NroInterno , $Descripcion
		$objReg_Container = $this->objQuerys->SaveContainer($_REQUEST['sbNroContenedor'], $_REQUEST['sbNroInterno'], $_REQUEST['sbDescripcion']);
		if($objReg_Container)
		{
			echo $objReg_Container;
		}
		else
		{
			echo "Registro Exitoso!";
		}
	}


	function executeUpdtContainer()
	{
		//$idContenedor, $NroContenedor , $NroInterno , $Descripcion
		$objUpdt_Container = $this->objQuerys->UpdateContainer($_REQUEST['sbidContenedor'], $_REQUEST['sbNroContenedor'], $_REQUEST['sbNroInterno'], $_REQUEST['sbDescripcion']);
		if($objUpdt_Container)
		{
			echo $objUpdt_Container;
		}
		else 
		{
			echo "Actualizacion Exitosa!";
		}

	}

	function executeInactiveContainer() {
		
		$sbDNI = $_REQUEST['sbidContenedor'];

		$objInactive_Container = $this->objQuerys->InactiveContainer($sbDNI);

		echo $objInactive_Container; 
        /*if($objInactive_Container)
        {
        	echo "Proceso Exitoso!"; 
        }else 
        {
	        echo $objInactive_Container; 
	    }*/
    
    }
}

$objApiContainer = new apiContainer();
$sbAction = $_REQUEST['action'];
$objApiContainer->execute( $objApiContainer , $sbAction );


?>