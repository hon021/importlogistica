<?php
include_once ("Controller.php");
include_once ( "../../Controller/cnn/dataBaseConnection.php" );
include_once ( "../../Controller/querys/observationQuerys.php" );
include_once ( "../../Controller/querys/commodityQuerys.php");
include_once ( "../../Controller/querys/shippingQuerys.php");
include_once ( "../../Controller/querys/localizationQuerys.php");
include_once ("../../System/user/session.php");
include ( "../../Controller/define/constants.php" );
include ("apiSmartyAbout.php");

class apiObservation extends Controller{
	private $objSmarty;
	private $objQuerys;
	private $objQuerysMercancia;
	private $objQuerysEnvio;
	private $objQuerysLocalization;
	
	function __construct()
	{
		$this->objQuerys = new ObservationQuerys();
		$this->objQuerysMercancia = new commodityQuerys();
		$this->objQuerysEnvio = new shippingQuerys();
		$this->objQuerysLocalization = new localizationQuerys();
		$this->objSmarty = new ApiSmartyAbout();
        $this->objSmarty->template_dir = "../../View/observacion";
	}
	
	
	function executeGetObservaciones()
    {    	
    	
    	$Obser = $this->objQuerys->Observation();

	    if($Obser == true){
	        echo json_encode($this->objQuerys->observation_array);
	    }
	    else if ($Obser == false){
	        echo '{"IdObservaciones":"00"}';
	        
	    }
    
    }
    
 	function executeGetObservacionId()
    {
    	$nuIdObservacion = $_REQUEST['nuIdObservacion'];
    	
    	$Obser = $this->objQuerys->GetObservationId($nuIdObservacion);
	  
		
	    if($Obser == true){
	        echo json_encode($this->objQuerys->observationAdministrator_array);
	    }
	    else if ($Obser == false){
	        echo '{"IdObservaciones":"00"}';
	        
	    }
    }

    
	function executeViewObservacion() {
		 
		    $sbTitulo="Observacion";
		    $sbIdRol=getSession("idrol");
		    
		    //Capturar Localizacion
		    $this->objQuerysLocalization->getLocalization();
			foreach ($this->objQuerysLocalization->localization_array as $Localization) {
				$this->ArrayIdLocali[]=$Localization["IdLocalizacion"];
				$this->ArrayNombreLocali[]=$Localization["Nombre"];
			}
		
			//Capturar Mercancia
			/*
			$this->objQuerysMercancia->Commodity();
			foreach ($this->objQuerysMercancia->commodity_array as $Commodity) {
				$this->ArrayIdMercancia[]=$Commodity["IdMercancia"];
				$this->ArrayNroComprobante[]=$Commodity["NoComprobante"];
			}*/
			
			//Capturar Envio
			//$this->objQuerysEnvio->Shipping();
			$this->objQuerysEnvio->GetShippingList();
			
			foreach ($this->objQuerysEnvio->shipping_array as $Shipping) {
				$this->ArrayIdEnvio[]=$Shipping["IdEnvios"];
				$this->ArrayDescripcion[]= "DNI= ".$Shipping["DNI"]." || No. Comprobante: ".$Shipping["NoCoprobante"]." || No. Contenedor: ".$Shipping["NroContenedor"]." - ".$Shipping["FechaEnvio"];
			}
			
		
			//Localizacion
			$this->objSmarty->assign("array_IdLocali",$this->ArrayIdLocali);
			$this->objSmarty->assign("array_NombreLocali",$this->ArrayNombreLocali);
		
			//Mercancia
			/*
			$this->objSmarty->assign("array_IdMercancia",$this->ArrayIdMercancia);
			$this->objSmarty->assign("array_NroComprobante",$this->ArrayNroComprobante);
			*/
			
			//Envio
			$this->objSmarty->assign("array_IdEnvio",$this->ArrayIdEnvio);
			$this->objSmarty->assign("array_Descripcion",$this->ArrayDescripcion);
		
			$this->objSmarty->assign("Titulo",$sbTitulo);
			$this->objSmarty->assign("IdRol",$sbIdRol);
			
			$this->objSmarty->display ("observacion.html");
		
	}
	
	
	function executeRegObservacion() {

		$IdMercancia = $_REQUEST['IdMercancia'];
		$IdLocalizacion = $_REQUEST['IdLocalizacion'];
		$dtFechaIngreso = $_REQUEST['dtFechaIngreso'];
		$sbObservaciones = $_REQUEST['sbObservaciones'];

		$objReg_commodity = $this->objQuerys->saveRegisterObservation($IdMercancia, $IdLocalizacion, $dtFechaIngreso, $sbObservaciones);
				
        if($objReg_commodity){
	        echo $objReg_commodity;
        }else {
	        echo "Registro Exitoso!";
	    }
    
    }
    
    
    function executeUpdObservacion() {
		$idObservacion = $_REQUEST['idObservacion'];
		$idMercancia = $_REQUEST['idMercancia'];
		$idLocalizacion = $_REQUEST['idLocalizacion'];
		$dtFechaIngreso = $_REQUEST['dtFechaIngreso'];
		$sbObservaciones = $_REQUEST['sbObservaciones'];
			
		$objReg_observation = $this->objQuerys->UpdateObservation($idObservacion, $idMercancia, $idLocalizacion, $dtFechaIngreso, $sbObservaciones);

        if($objReg_observation){
	        echo $objReg_observation;
        }else {
	        echo "Actualizacion Exitosa!";
	        
	    }
    
    }
    
	function executeInactiveObservacion() {
		$idObservacion = $_REQUEST['idObservacion'];
		$objInactive_observation = $this->objQuerys->InactiveObservation($idObservacion);

        if($objInactive_observation){
        	echo "Proceso Exitoso!"; 
        }else {
	        echo $objInactive_observation; 
	    }
    
    }
    
		

}

$objApiObservation = new apiObservation();
$sbAction = $_REQUEST['action'];
$objApiObservation->execute( $objApiObservation , $sbAction );


?>