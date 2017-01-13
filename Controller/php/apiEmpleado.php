<?php
include_once ("Controller.php");
include_once ( "../../Controller/cnn/dataBaseConnection.php" );
include_once ( "../../Controller/querys/employeeQuerys.php" );
include ( "../../Controller/define/constants.php" );
include_once ( "../../Controller/querys/rolQuerys.php" );
include_once ("../../System/user/session.php");
include ("apiSmartyAbout.php");

class apiEmpleado extends Controller{

	private $objSmarty;
	private $objQuerys;
	private $objQuerysRol;
	
	function __construct()
	{
		$this->objQuerys = new EmployeeQuerys();
		$this->objQuerysRol = new RolQuerys();
		$this->objSmarty = new ApiSmartyAbout();
		$this->objSmarty->template_dir = "../../View/empleado/";
	}
	
	function executeViewRegEmpleados() {
		 
		    $sbTitulo="Empleados";
		   
		    $this->objQuerysRol->Rol();	
			foreach ($this->objQuerysRol->rol_array as $Roles) {
			    $this->ArrayIdRol[]=$Roles["IdRol"];
				$this->ArrayNombreRol[]=$Roles["Nombre"];

		    }	    
		    
			$this->objSmarty->template_dir = "../../View/empleado";
			$this->objSmarty->assign("array_NombreRol",$this->ArrayNombreRol);
			$this->objSmarty->assign("array_IdRol",$this->ArrayIdRol);
			$this->objSmarty->assign("Titulo",$sbTitulo);
			$this->objSmarty->display ("empleado.html");				
	}

	function executeGetMain()
	{
		include_once ("../../Lenguage/Spanish/L.Empleados.php");

		$sbTitulo="Empleados";
		   
		    $this->objQuerysRol->Rol();	
			foreach ($this->objQuerysRol->rol_array as $Roles) {
			    $this->ArrayIdRol[]=$Roles["IdRol"];
				$this->ArrayNombreRol[]=$Roles["Nombre"];

		    }	    
		    
			$this->objSmarty->template_dir = "../../View/empleado";
			$this->objSmarty->assign("array_NombreRol",$this->ArrayNombreRol);
			$this->objSmarty->assign("array_IdRol",$this->ArrayIdRol);
			$this->objSmarty->assign("Titulo",$sbTitulo);

		$this->objSmarty->assign("Label_Tittle", LABEL_TITTLE);/*
		$this->objSmarty->assign("Label_Login",LABEL_LOGIN);
		$this->objSmarty->assign("Label_About",LABEL_ABOUT);
		$this->objSmarty->assign("Label_App",LABEL_APP);
		$this->objSmarty->assign("Label_Version",LABEL_VERSION);*/
		
		//$this->objSmarty->assign("user",sbUser);
		//$this->objSmarty->assign("password",sbPassword);
		$this->objSmarty->display ("empleado.html");
	}

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

	function executeGetEmployeeLite()
	{
		$employee = $this->objQuerys->getEmployeeLite();
		if($employee == true)
		{
			echo json_encode($this->objQuerys->Employee_Array);
		}
		else if($employee == false)
		{
			echo '{"IdEmpleado":"00"}';
		}
	}

	function executeGetEmployeeById()
	{
		$sbID = $_REQUEST['sbID'];
		$employee = $this->objQuerys->getEmployeeById($sbID);
		if($employee == true)
		{
			echo json_encode($this->objQuerys->Employee_Array);
		}
		else if( $employee == false)
		{
			echo '{"IdEmpleado":"00"}';
		} 
	} 


	function executeInactiveEmpleado() {
		$sbDNI = $_REQUEST['sbDNI'];

		$objInactive_Empleado = $this->objQuerys->InactiveEmpleado($sbDNI);

        if($objInactive_Empleado)
        {
        	echo "Proceso Exitoso!"; 
        }else 
        {
	        echo $objInactive_Empleado; 
	    }
    
    }

	function executeUpdtEmpleado()
	{
		$objUpdt_Empleados = $this->objQuerys->UpdtEmployee($_REQUEST['sbNombre'], $_REQUEST['sbApellido'], $_REQUEST['sbDNI'], $_REQUEST['sbCelular'], $_REQUEST['sbFijo'], $_REQUEST['sbEmail'], $_REQUEST['sbSexo'], $_REQUEST['sbCargo'], $_REQUEST['sbPerfil']);
		if($objUpdt_Empleados)
		{
			echo $objUpdt_Empleados;
		}
		else 
		{
			echo "Actualizacion Exitosa!";
		}

	}

	function executeRegEmpleados()
	{
		$objReg_Empleados = $this->objQuerys->SaveEmployee($_REQUEST['sbNombre'], $_REQUEST['sbApellido'], $_REQUEST['sbDNI'], $_REQUEST['sbCelular'], $_REQUEST['sbFijo'], $_REQUEST['sbEmail'], $_REQUEST['sbSexo'], $_REQUEST['sbCargo'], $_REQUEST['sbPerfil']);
		if($objReg_Empleados){
			echo $objReg_Empleados;
		}
		else {
			echo "Registro Exitoso!";
		}
	}
}

$objApiEmpleado = new apiEmpleado();
$sbAction = $_REQUEST['action'];
$objApiEmpleado->execute( $objApiEmpleado , $sbAction );


?>