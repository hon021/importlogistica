<?php
include_once ("Controller.php");
include_once ( "../../Controller/cnn/dataBaseConnection.php" );
include_once ( "../../Controller/querys/customerQuerys.php" );
include_once ( "../../Controller/querys/rolQuerys.php" );
include_once ("../../System/user/session.php");
include ( "../../Controller/define/constants.php" );
include ("apiSmartyAbout.php");

class apiClientes extends Controller{
	private $objSmarty;
	private $objQuerys;
	private $objQuerysRol;
	private $ArrayIdRol;
    private	$ArrayNombreRol;
	
	function __construct()
	{

		$this->objQuerys = new CustomerQuerys();
		$this->objQuerysRol = new RolQuerys();
		$this->objSmarty = new ApiSmartyAbout();
		$this->objSmarty->template_dir = "../../View";

	}
	
		
	
	function executeViewRegCliente() {
		 
		    $sbTitulo="Clientes";
		   
		    $this->objQuerysRol->Rol();	
			foreach ($this->objQuerysRol->rol_array as $Roles) {
			    $this->ArrayIdRol[]=$Roles["IdRol"];
				$this->ArrayNombreRol[]=$Roles["Nombre"];

		    }
		    
		    
			$this->objSmarty->template_dir = "../../View/cliente";
			$this->objSmarty->assign("array_NombreRol",$this->ArrayNombreRol);
			$this->objSmarty->assign("array_IdRol",$this->ArrayIdRol);
			$this->objSmarty->assign("Titulo",$sbTitulo);
			$this->objSmarty->display ("registro_cliente.html");
	
				
	}
	
	
	function executeGetCliente()
    {
    	
    	$customers = $this->objQuerys->getCustomer();
	  
		
	    if($customers == true){
	        echo json_encode($this->objQuerys->customer_array);
	    }
	    else if ($customers == false){
	        echo '{"IdCliente":"00"}';
	        
	    }
    }
    
    
    function executeGetClienteDNI()
    {
    	$sbDNI = $_REQUEST['sbDNI'];
    	
    	$customers = $this->objQuerys->getCustomerDNI($sbDNI);
	  
		
	    if($customers == true){
	        echo json_encode($this->objQuerys->customerAdministrator_array);
	    }
	    else if ($customers == false){
	        echo '{"IdCliente":"00"}';
	        
	    }
    }
    
    
   function executeGetDNI() {
		$sbDNI = $_REQUEST['sbDNI'];
		$bolUser = $this->objQuerys->getDNI($sbDNI);
	    if($bolUser){
	    	echo 0;
	    }else{
	    	echo 1;
	    }
    }
	
    function executeRegCliente() {
		$idPerfil = $_REQUEST['idPerfil'];
		$sbNombre = $_REQUEST['sbNombre'];
		$sbApellido = $_REQUEST['sbApellido'];
		$sbDNI = $_REQUEST['sbDNI'];
		$sbCelular = $_REQUEST['sbCelular'];
		$sbFijo = $_REQUEST['sbFijo'];
		$sbEmail = $_REQUEST['sbEmail'];
		$sbGenero = $_REQUEST['sbGenero'];
		$sbCiudad = $_REQUEST['sbCiudad'];
		
		$objReg_customer = $this->objQuerys->saveRegisterCustomer($idPerfil, $sbNombre, $sbApellido, $sbDNI, $sbCelular, $sbFijo, $sbEmail, $sbGenero, $sbCiudad);

		
        if($objReg_customer){
	        echo $objReg_customer;
        }else {
	        echo "Registro Exitoso!";
	        
	    }
    
    }
    
    
	function executeUpdCliente() {
		$idCliente = $_REQUEST['idCliente'];
		$idPerfil = $_REQUEST['idPerfil'];
		$sbNombre = $_REQUEST['sbNombre'];
		$sbApellido = $_REQUEST['sbApellido'];
		$sbDNI = $_REQUEST['sbDNI'];
		$sbCelular = $_REQUEST['sbCelular'];
		$sbFijo = $_REQUEST['sbFijo'];
		$sbEmail = $_REQUEST['sbEmail'];
		$sbGenero = $_REQUEST['sbGenero'];
		$sbCiudad = $_REQUEST['sbCiudad'];
		
		$objReg_customer = $this->objQuerys->UpdateCustomer($idCliente, $idPerfil, $sbNombre, $sbApellido, $sbDNI, $sbCelular, $sbFijo, $sbEmail, $sbGenero, $sbCiudad);

		
        if($objReg_customer){
	        echo $objReg_customer;
        }else {
	        echo "Actualizacion Exitosa!";
	        
	    }
    
    }
    
    
    
	function executeInactiveCliente() {
		$sbDNI = $_REQUEST['sbDNI'];
		$objInactive_customer = $this->objQuerys->InactiveCustomer($sbDNI);

        if($objInactive_customer){
        	echo "Proceso Exitoso!"; 
        }else {
	        echo $objInactive_customer; 
	    }
    
    }
	
	
}


$objApiClientes = new apiClientes();
$sbAction = $_REQUEST['action'];
$objApiClientes->execute( $objApiClientes , $sbAction );


?>