<?php
include_once ("Controller.php");
include_once ("../../System/user/session.php");
include_once ( "../../Controller/cnn/dataBaseConnection.php");
include_once ( "../../Controller/querys/customerQuerys.php");
include_once ( "../../Controller/querys/containerQuerys.php");
include_once ( "../../Controller/querys/commodityQuerys.php");
include_once ( "../../Controller/querys/localizationQuerys.php");
include ( "../../Controller/define/constants.php" );
include ("apiSmartyAbout.php");

class apiMercancia extends Controller{
	
	private $objSmarty;
	private $objQuerys;
	private $objQuerysCostumer;
	private $objQuerysContainer;
	private $objQuerysLocalization;
	
	function __construct()
	{
		$this->objQuerys = new commodityQuerys();
		$this->objQuerysCostumer = new customerQuerys();
		$this->objQuerysContainer = new containerQuerys();
		$this->objQuerysLocalization = new localizationQuerys();
		$this->objSmarty = new ApiSmartyAbout();
		$this->objSmarty->template_dir = "../../View/mercancia/";
	}

	// Main
	function executeGetMain()
	{
		include_once ("../../Lenguage/Spanish/L.Mercancia.php");
		
		$sbIdRol=getSession("idrol");
		$this->objSmarty->assign("Label_Tittle", LABEL_TITTLE);
		
		$this->objQuerysCostumer->getCustomerOrder();
		foreach ($this->objQuerysCostumer->customer_array as $Costumers) {
			$this->ArrayIdCost[]=$Costumers["IdCliente"];
			$this->ArrayNombreCliente[]=$Costumers["Nombre"]." ".$Costumers["Apellido"]." - ".$Costumers["DNI"];
		}
		/*
		$this->objQuerysContainer->getContainer();
		foreach ($this->objQuerysContainer->container_array as $Container) {
			$this->ArrayIdCont[]=$Container["IdContenedor"];
			$this->ArrayDescripcionCont[]=$Container["Descripcion"];
		}
		*/
		
		$this->objQuerysLocalization->getLocalization();
		foreach ($this->objQuerysLocalization->localization_array as $Localization) {
			$this->ArrayIdLocali[]=$Localization["IdLocalizacion"];
			$this->ArrayNombreLocali[]=$Localization["Nombre"];
		}
		
		$this->objSmarty->assign("array_IdCost",$this->ArrayIdCost);
		$this->objSmarty->assign("array_NombreCliente",$this->ArrayNombreCliente);
		
		$this->objSmarty->assign("array_IdCont",$this->ArrayIdCont);
		$this->objSmarty->assign("array_DescripcionCont",$this->ArrayDescripcionCont);
		
		$this->objSmarty->assign("array_IdLocali",$this->ArrayIdLocali);
		$this->objSmarty->assign("array_NombreLocali",$this->ArrayNombreLocali);
		
		$this->objSmarty->assign("IdRol",$sbIdRol);
		
		$this->objSmarty->display ("mercancia.html");
	}
	
	function executeGetMercancia()
    {    	
    	$sbIdPerfil=getSession("idperfil");
    	$sbIdRol=getSession("idrol");
    	 
    	$Commodity = $this->objQuerys->CommodityByPerfil($sbIdPerfil, $sbIdRol);
    	
	    if($Commodity == true){
	        echo json_encode($this->objQuerys->commodity_array);
	    }
	    else if ($Commodity == false){
	        echo '{"IdMercancia":"00"}';
	        
	    }
    }
	

	function executeInactiveMercancia() 
	{
		$IdMer = $_REQUEST['IdMercancia'];
		$objInactive_Mercancia = $this->objQuerys->InactiveMercancia($IdMer);
		
		/*
        if($objInactive_Mercancia)
        {
        	echo "Proceso Exitoso!"; 
        }else 
        {*/
	        echo $objInactive_Mercancia; 
	    //}
    
    }

	// Registro
	function executeRegMercancia() {

		$IdCliente = $_REQUEST['IdCliente'];
		$nuComprobante = $_REQUEST['nuComprobante'];
		$Nocajas = $_REQUEST['Nocajas'];
		$Cubicaje = $_REQUEST['Cubicaje'];
		$Notas = $_REQUEST['Notas'];
		$dtFechaIngreso = $_REQUEST['FechaIngreso'];


		$objReg_commodity = $this->objQuerys->saveRegisterCommodity($IdCliente, $nuComprobante,  $Nocajas ,  $Cubicaje , $Notas, $dtFechaIngreso);
		
		//echo $objReg_commodity;

        if($objReg_commodity){
	        echo $objReg_commodity;
        }else {
	        echo "Registro Exitoso!";
	    }
    }

	function executeUpdtMercancia() 
	{
		$IdMercancia = $_REQUEST['IdMercancia'];
		$IdCliente = $_REQUEST['IdCliente'];
		$nuComprobante = $_REQUEST['nuComprobante'];
		$Nocajas = $_REQUEST['Nocajas'];
		$Cubicaje = $_REQUEST['Cubicaje'];
		$Notas = $_REQUEST['Notas'];
		$dtFechaIngreso = $_REQUEST['FechaIngreso'];

		$objReg_commodity = $this->objQuerys->UpdateCommodity($IdMercancia, $IdCliente, $nuComprobante,  $Nocajas ,  $Cubicaje , $Notas, $dtFechaIngreso);
		
        if($objReg_commodity){
	        echo $objReg_commodity;
        }else {
	        echo "Actualizacion Exitosa!";
	    }
    }
    function executeGetMercanciaById() 
    {

    	$sbID = $_REQUEST['sbID'];
		$Commodity = $this->objQuerys->GetMercanciaById($sbID);
		if($Commodity == true)
		{
			echo json_encode($this->objQuerys->Mercancia_Array);
		}
		else if( $Commodity == false)
		{
			echo '{"IdMercancia":"00"}';
		} 
    }
}

$objApiMercancia = new apiMercancia();
$sbAction = $_REQUEST['action'];
$objApiMercancia->execute( $objApiMercancia , $sbAction );


?>