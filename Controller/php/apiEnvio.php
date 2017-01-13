<?php
include_once ("Controller.php");
include_once ( "../../Controller/cnn/dataBaseConnection.php" );
include_once ( "../../Controller/querys/shippingQuerys.php" );
include_once ( "../../Controller/querys/commodityQuerys.php");
include_once ( "../../Controller/querys/containerQuerys.php");
include_once ("../../System/user/session.php");

include ( "../../Controller/define/constants.php" );
include ("apiSmartyAbout.php");

class apiEnvio extends Controller{
	private $objSmarty;
	private $objQuerys;
	private $objQueryMercancia;
	private $objQuerysContainer;


	function __construct()
	{
		$this->objQuerys = new shippingQuerys();
		$this->objQueryMercancia = new commodityQuerys();
		$this->objQuerysContainer = new containerQuerys();
		$this->objSmarty = new ApiSmartyAbout();
		$this->objSmarty->template_dir = "../../View";

	}


	function executeGetEnvios()
	{
		$roles = $this->objQuerys->Shipping();

		if($roles == true){
			echo json_encode($this->objQuerys->shipping_array);
		}
		else if ($roles == false){
			echo '{"IdEnvios":"00"}';
			 
		}
	}

	function executeGetEnvioById()
	{
		$sbIdEnvio = $_REQUEST['sbIdEnvio'];
		$Caja = $this->objQuerys->GetEnvioById($sbIdEnvio);
		if($Caja == true)
		{
			echo json_encode($this->objQuerys->shipping_array);
		}
		else if($Caja == false)
		{
			echo '{"IdEnvios":"00"}';
		}
	}
	
 

	function executeRegEnvio()
	{
		$sbMercancia=$_REQUEST['sbMercancia'];
		$sbContenedor=$_REQUEST['sbContenedor'];
		$dtFechaEnvio = $_REQUEST['dtFechaEnvio'];
		$sbNroCajas=$_REQUEST['NroCajas'];
		
		$objReg_Envio = $this->objQuerys->SaveEnvio($sbMercancia, $sbContenedor, $sbNroCajas, $dtFechaEnvio);
		if($objReg_Envio)
			echo $objReg_Envio;
		else 
		{
			echo "Registro Exitoso!";
		}
	}
	
	function executeUpdtEnvio()
	{
		$sbMercancia=$_REQUEST['sbMercancia'];
		$sbContenedor=$_REQUEST['sbContenedor'];
		$dtFechaEnvio = $_REQUEST['dtFechaEnvio'];
		$sbNroCajas=$_REQUEST['NroCajas'];
		$sbIdEnvio = $_REQUEST['sbIdEnvio'];
		
		$objUpdate_Envio = $this->objQuerys->UpdtEnvio($sbMercancia, $sbContenedor, $sbNroCajas, $dtFechaEnvio, $sbIdEnvio);
		if($objUpdate_Envio)
			echo $objUpdate_Envio;
		else 
			echo "Actualizacion Exitosa!";
	}

	function executeInactiveEnvio()
	{
		$sbIdEnvio = $_REQUEST['sbIdEnvio'];
		$objInactiveEnvio = $this->objQuerys->InactiveEnvio($sbIdEnvio);
		
		echo $objInactiveEnvio;
		/*
		if($objInactiveEnvio)
			echo "Proceso Exitoso!";
		else 
			echo $objInactiveEnvio;
		 */
	}
	
	function executeViewEnvio()
	{
			
		$sbTitulo="Envios";
		$sbIdRol=getSession("idrol");

		//Mercancia
		$this->objQueryMercancia->Commodity();
		foreach ($this->objQueryMercancia->commodity_array as $Mercancia)
		{
			$this->ArrayIdMercancia[]=$Mercancia["IdMercancia"];
			//$this->ArrayNombreMercancia[]=$Mercancia["NoCoprobante"]." - DNI:".$Mercancia["IdCliente"];
			//$this->ArrayNombreMercancia[]="Comprobante:".$Mercancia["NoCoprobante"];
			$this->ArrayNombreMercancia[]="Cliente DNI:".$Mercancia["ClienteDNI"]." || No Comprobante:".$Mercancia["NoCoprobante"]." || Fecha Ingreso:".$Mercancia["FechaIngreso"];
		}
		
		//Contenedor
		$this->objQuerysContainer->getContainer();
		foreach ($this->objQuerysContainer->container_array as $Container) {
			$this->ArrayIdCont[]=$Container["idContenedor"];
			$this->ArrayDescripcionCont[]="Contenedor Nro: ".$Container["NroContenedor"];
		}
		
        //Mercancia
		$this->objSmarty->assign("arrayIdMercancia", $this->ArrayIdMercancia);
		$this->objSmarty->assign("array_NombreMercancia", $this->ArrayNombreMercancia);
		
		//Contenedor
		$this->objSmarty->assign("array_IdCont",$this->ArrayIdCont);
		$this->objSmarty->assign("array_DescripcionCont",$this->ArrayDescripcionCont);

		$this->objSmarty->template_dir = "../../View/envio";
		$this->objSmarty->assign("Titulo",$sbTitulo);
		$this->objSmarty->assign("IdRol",$sbIdRol);
		
		$this->objSmarty->display ("envio.html");

	}


}

$objApiEnvio = new apiEnvio();
$sbAction = $_REQUEST['action'];
$objApiEnvio->execute( $objApiEnvio , $sbAction );


?>