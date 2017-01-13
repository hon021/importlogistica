<?php
include_once ("Controller.php");
include_once ( "../../Controller/cnn/dataBaseConnection.php" );
include_once ( "../../Controller/querys/boxQuerys.php" );
include_once ( "../../Controller/querys/commodityQuerys.php");
include_once ("../../System/user/session.php");

include ( "../../Controller/define/constants.php" );
include ("apiSmartyAbout.php");

class apiCaja extends Controller{
	private $objSmarty;
	private $objQuerys;
	private $objQueryMercancia;
	private $objQueryEstadoCaja;


	function __construct()
	{
		$this->objQuerys = new BoxQuerys();
		$this->objQueryMercancia = new commodityQuerys();
		$this->objQueryEstadoCaja = new commodityQuerys();
		$this->objSmarty = new ApiSmartyAbout();
		$this->objSmarty->template_dir = "../../View";

	}


	function executeGetCaja()
	{
		$roles = $this->objQuerys->Box();

		if($roles == true){
			echo json_encode($this->objQuerys->box_array);
		}
		else if ($roles == false){
			echo '{"IdCajas":"00"}';
			 
		}
	}

	function executeGetCajaById()
	{
		$sbId = $_REQUEST['sbID'];
		$Caja = $this->objQuerys->GetCajaById($sbId);
		if($Caja == true)
		{
			echo json_encode($this->objQuerys->Caja_Array);
		}
		else if($Caja == false)
		{
			echo '{"IdCaja":"00"}';
		}
	}
	
 

	function executeRegCaja()
	{
		$objReg_Caja = $this->objQuerys->SaveCaja($_REQUEST['sbMercancia'], $_REQUEST['sbEstado'], $_REQUEST['sbCodigoBarras']);
		if($objReg_Caja)
			echo $objReg_Caja;
		else 
		{
			echo "Registro Exitoso!";
		}
	}
	
	function executeUpdtCaja()
	{
		$objUpdate_Caja = $this->objQuerys->UpdtCaja($_REQUEST['sbMercancia'], $_REQUEST['sbEstado'], $_REQUEST['sbCodigoBarras'], $_REQUEST['sbIdCajas']);
		if($objUpdate_Caja)
			echo $objUpdate_Caja;
		else 
			echo "Actualizacion Exitosa!";
	}

	function executeInactiveCaja()
	{
		$sbIdCajas = $_REQUEST['sbIdCajas'];
		$objInactiveCaja = $this->objQuerys->InactiveCaja($sbIdCajas);
		if($objInactiveCaja)
			echo "Proceso Exitoso!";
		else 
			echo $objInactiveCaja;
	}
	
	/*
	 * 
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
	 * 
	 */
	
	function executeViewCaja()
	{
			
		$sbTitulo="Cajas";

		$this->objQueryMercancia->Commodity();
		foreach ($this->objQueryMercancia->commodity_array as $Mercancia)
		{
			$this->ArrayIdMercancia[]=$Mercancia["IdMercancia"];
			$this->ArrayNombreMercancia[]="Cliente DNI ".$Mercancia["ClienteDNI"]." || Comprobanete No ".$Mercancia["NoCoprobante"]." - ".$Mercancia["FechaIngreso"];
		}

		$this->objQueryEstadoCaja->GetCommodityState();
		foreach ($this->objQueryEstadoCaja->commodity_array as $EstadoCaja)
		{
			$this->ArrayIdEstadoCaja[]=$EstadoCaja["IdEstado"];
			$this->ArrayDescripcionEstadoCaja[]=$EstadoCaja["Descripcion"];
		}

		$this->objSmarty->assign("arrayIdMercancia", $this->ArrayIdMercancia);
		$this->objSmarty->assign("array_NombreMercancia", $this->ArrayNombreMercancia);
		 
		$this->objSmarty->assign("arrayIdEstadoCaja", $this->ArrayIdEstadoCaja);
		$this->objSmarty->assign("arrayDescripcionEstadoCaja", $this->ArrayDescripcionEstadoCaja);


		$this->objSmarty->template_dir = "../../View/caja";
		$this->objSmarty->assign("Titulo",$sbTitulo);
		$this->objSmarty->display ("caja.html");

	}


}

$objApiCaja = new apiCaja();
$sbAction = $_REQUEST['action'];
$objApiCaja->execute( $objApiCaja , $sbAction );


?>