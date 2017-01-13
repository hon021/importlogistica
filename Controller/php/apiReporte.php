<?php
include_once ("Controller.php");
include_once ("apiDescargarFiles.php");
include_once ( "../../Controller/cnn/dataBaseConnection.php" );
include_once ( "../../Controller/querys/customerQuerys.php" );
include_once ( "../../Controller/querys/reportsQuerys.php" );
include_once ("../../System/user/session.php");
include_once ("../../System/user/ReportManager.php");
include ( "../../Controller/define/constants.php" );
include ("apiSmartyAbout.php");

class apiReporte extends Controller{
	private $objSmarty;
	private $objQuerys;
	private $objQuerysCustomer;
	private $objPdf;
	private $objApiDescargas;
	
	function __construct()
	{
		$this->objQuerys = new ReportQuerys();
		$this->objQuerysCustomer = new CustomerQuerys();
		$this->objSmarty = new ApiSmartyAbout();
		$this->objPdf = new ReportManager();
		$this->objApiDescargas = new ApiDescargarFiles();
		$this->objSmarty->template_dir = "../../View";

	}
	

	function executeGetReport1()
    {    	
    	
    	$sbFechaIni = $_REQUEST['FechaIni'];
    	$sbFechaFin = $_REQUEST['FechaFin'];
    	
    	$IdPerfil = getSession("idperfil");
    	
    	$sbResultReport = "<font color='blue'><b>Reporte Estado Caja</b></font><br>";
    	$sbResultReport .= "<br>";
    	$sbResultReport .= "<b>Usuario-Identificacion-Mercancia-FechaObservacion-Localizacion</b>";
    	$sbResultReport .= "<br><br>";
    	$reports = $this->objQuerys->Report1($sbFechaIni, $sbFechaFin, $IdPerfil);
    	
    	$i=0;
    	foreach ($this->objQuerys->report_array as $Reportes) {    
				if($i>0){
					$Usuario=$Reportes["Usuario"];
					$Identificacion=$Reportes["Identificacion"];
					$Mercancia=$Reportes["Mercancia"];
					$Observacion=$Reportes["Observacion"];
					$FechaObservacion=$Reportes["FechaObservacion"];
					$Localizacion=$Reportes["Localizacion"];
					
					$sbResultReport.=$Usuario."|".$Identificacion."|".$Mercancia."|".$Observacion."|".$FechaObservacion."|".$Localizacion."<br>";
				}
				$i++;
		}

		echo $sbResultReport;
    	
    }
    
    
	function executeGetReport2()
    {    	
    	
    	$sbFechaIni = $_REQUEST['FechaIni'];
    	$sbFechaFin = $_REQUEST['FechaFin'];
    	$sbNoComprobante = $_REQUEST['NoComprobante'];
    	
        $reports = $this->objQuerys->Report2($sbFechaIni, $sbFechaFin, $sbNoComprobante);
        
    	$i=0;
    	foreach ($this->objQuerys->report_array as $Reportes) {    
				if($i>0){
					$NoCoprobante=$Reportes["NoCoprobante"];
					$Descripcion=$Reportes["Descripcion"];

					$sbResultReport.=$NoCoprobante."|".$Descripcion;
				}
				$i++;
		}

		echo $sbResultReport;
    	
    }
    
    
	function executeGetReport1Pdf()
    {    	
    	
    	$sbFechaIni = $_REQUEST['FechaIni'];
    	$sbFechaFin = $_REQUEST['FechaFin'];
    	
    	$IdPerfil = getSession("idperfil");
    
    	
    	$this->objQuerys->Report1($sbFechaIni, $sbFechaFin, $IdPerfil);
    	
    	$fecha = date("Y")."-".date("m")."-".date("d");
		$hora = getdate(time());
		$sbUserName=getSession("username");
    	
		$sbTitleSec = "Fecha Inicial: ". $sbFechaIni . " Fecha Final: " . $sbFechaFin . " Usuario: ".$sbUserName;
    	
    	$this->objPdf->setTitulo("Reporte Estado Caja");
    	$this->objPdf->setTituloSecundario($sbTitleSec);
    	$this->objPdf->setFecha($fecha." ".$hora["hours"] . ":" . $hora["minutes"] . ":" . $hora["seconds"]);
    	
    	//Armando Reporte
    	$nuTamanoCelda = 25;
		$nuAnchoCelda = 7;

		$this->objPdf->AddPage('L');
		$this->objPdf->SetFont('Arial', 'B', 14);
	
		$this->objPdf->SetFont('Arial', 'B', 10);
		
		
		$this->objPdf->SetFillColor(50);
		$this->objPdf->centrarTexto(($nuTamanoCelda*10)+($nuTamanoCelda/3));
		$this->objPdf->Cell($nuTamanoCelda/3, 7, '#', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+50, 7, 'Cliente', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda, 7, 'Nro Cajas', 1, 0, 'C');			
		$this->objPdf->Cell($nuTamanoCelda, 7, 'Cubicaje', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+5, 7, 'Nro Contenedor', 1, 1, 'C');
		//$this->objPdf->Cell($nuTamanoCelda, 7, 'Fecha', 1, 0, 'C');
		//$this->objPdf->Cell($nuTamanoCelda, 7, 'Localizacion', 1, 1, 'C');

	
	    $nuI = 0;
		foreach ($this->objQuerys->report_array as $rcDatos) { 
     			
			if($nuI>0){		
				$this->objPdf->SetFont('Arial', '', 9);
				
				$this->objPdf->centrarTexto(($nuTamanoCelda*10)+($nuTamanoCelda/3));
				$nuCantidad++;
							
				$this->objPdf->Cell($nuTamanoCelda/3, $nuAnchoCelda, $nuCantidad, 1, 0, 'C');
				$this->objPdf->Cell($nuTamanoCelda+50, $nuAnchoCelda, $rcDatos["Cliente"], 1, 0, 'C' );
				$this->objPdf->Cell($nuTamanoCelda, $nuAnchoCelda, $rcDatos["NoCajas"], 1, 0, 'C');			
				$this->objPdf->Cell($nuTamanoCelda, $nuAnchoCelda, $rcDatos["Cubicaje"], 1, 0, 'C');
				$this->objPdf->Cell($nuTamanoCelda+5, $nuAnchoCelda, $rcDatos["NroContenedor"], 1, 1, 'C');				
			}
			
			$nuI++;

		}
    	//Fin Armando Reporte
    	
    	$sbTitle = "Reporte_Estado_Caja";
		$sbNomArchivo = $fecha."_".$sbTitle.'.pdf';
		
	    $this->objPdf->Output( $sbNomArchivo, 'D' );
    	
    }
    
    
    
	function executeGetReport1Excel()
    {    	
    	
    	$sbFechaIni = $_REQUEST['FechaIni'];
    	$sbFechaFin = $_REQUEST['FechaFin'];
    	
    	$IdPerfil = getSession("idperfil");
    
    	
    	$this->objQuerys->Report1($sbFechaIni, $sbFechaFin, $IdPerfil);
    	
    	$fecha = date("Y")."-".date("m")."-".date("d");
		$hora = getdate(time());
		$sbUserName=getSession("username");
    	
		$sbTitleSec = "Fecha Inicial: ". $sbFechaIni . " Fecha Final: " . $sbFechaFin . " Usuario: ".$sbUserName;
		
    	$nomArchivo=PATH_INFORMES_GENERADOS_EXCEL.$fecha."_Reporte_Estado_Caja.csv";
		$arch = fopen($nomArchivo,"w+");
		fwrite($arch,$sbTitleSec.ENTER_ARCHIVOS_EXCEL);
		fwrite($arch,"Cliente".SEPARADOR_ARCHIVOS_EXCEL.
					 "NoCajas".SEPARADOR_ARCHIVOS_EXCEL.
					 "Cubicaje".SEPARADOR_ARCHIVOS_EXCEL.
					 "NroContenedor".ENTER_ARCHIVOS_EXCEL);
		
	

		
		foreach ($this->objQuerys->report_array as $rcDatos) { 	
			
			    $sbObservacion= $rcDatos["Observacion"];
				$nuLen=strlen($sbObservacion);
				if($nuLen>40){
					$sbObservacion = substr($sbObservacion,0,40);
				}
			
		        fwrite($arch, $rcDatos["Cliente"].SEPARADOR_ARCHIVOS_EXCEL.       
			                  $rcDatos["NoCajas"].SEPARADOR_ARCHIVOS_EXCEL.
			                  $rcDatos["Cubicaje"].SEPARADOR_ARCHIVOS_EXCEL.
			                  $rcDatos["NroContenedor"].ENTER_ARCHIVOS_EXCEL);
	     } 
	     
	     
	    fclose($arch);
		$sbFileName = $fecha."_Reporte_Estado_Caja.csv";
		$this->objApiDescargas ->descargarArchivo($nomArchivo, $sbFileName, ARCHIVO_EXCEL);					

    	
    }
    
    
    
    
	function executeGetReport2Pdf()
    { 

    	$sbFechaIni = $_REQUEST['FechaIni'];
    	$sbFechaFin = $_REQUEST['FechaFin'];
    	$sbDNI = $_REQUEST['NoComprobante'];
    
    	
    	$this->objQuerys->Report2($sbFechaIni, $sbFechaFin, $sbDNI);
    	
    	$fecha = date("Y")."-".date("m")."-".date("d");
		$hora = getdate(time());
		$sbUserName=getSession("username");
    	
		$sbTitleSec = "Fecha Inicial: ". $sbFechaIni . " Fecha Final: " . $sbFechaFin . " Usuario: ".$sbUserName;
    	
    	$this->objPdf->setTitulo("Reporte Estado Mercancia");
    	$this->objPdf->setTituloSecundario($sbTitleSec);
    	$this->objPdf->setFecha($fecha." ".$hora["hours"] . ":" . $hora["minutes"] . ":" . $hora["seconds"]);
    	
    	//Armando Reporte
    	$nuTamanoCelda = 25;
		$nuAnchoCelda = 7;

		$this->objPdf->AddPage('L');
		$this->objPdf->SetFont('Arial', 'B', 14);
	
		$this->objPdf->SetFont('Arial', 'B', 10);
		
		
		$this->objPdf->SetFillColor(50);
		$this->objPdf->centrarTexto(($nuTamanoCelda*10)+($nuTamanoCelda/3));
		$this->objPdf->Cell($nuTamanoCelda/3, 7, '#', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+50, 7, 'Cliente', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+5, 7, 'FechaEnvio', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+5, 7, 'NoComprobante', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda, 7, 'TotalCajas', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda, 7, 'CajasEnviadas', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda, 7, 'Pendientes', 1, 1, 'C');			

	
	    $nuI = 0;
		foreach ($this->objQuerys->report_array as $rcDatos) { 
     			
			if($nuI>0){	
				$this->objPdf->SetFont('Arial', '', 9);
				
				$this->objPdf->centrarTexto(($nuTamanoCelda*10)+($nuTamanoCelda/3));
				$nuCantidad++;
				
				$this->objPdf->Cell($nuTamanoCelda/3, $nuAnchoCelda, $nuCantidad, 1, 0, 'C');
				$this->objPdf->Cell($nuTamanoCelda+50, $nuAnchoCelda, $rcDatos["Cliente"], 1, 0, 'C' );
				$this->objPdf->Cell($nuTamanoCelda+5, $nuAnchoCelda, $rcDatos["FechaEnvio"], 1, 0, 'C' );
				$this->objPdf->Cell($nuTamanoCelda+5, $nuAnchoCelda, $rcDatos["NoComprobante"], 1, 0, 'C' );
				$this->objPdf->Cell($nuTamanoCelda, $nuAnchoCelda, $rcDatos["TotalCajas"], 1, 0, 'C' );
				$this->objPdf->Cell($nuTamanoCelda, $nuAnchoCelda, $rcDatos["CajasEnviadas"], 1, 0, 'C' );
				$this->objPdf->Cell($nuTamanoCelda, $nuAnchoCelda, $rcDatos["Pendientes"], 1, 1, 'C');	
			}
			$nuI++;		

		}
    	//Fin Armando Reporte
    	
    	$sbTitle = "Reporte_Estado_Mercancia";
		$sbNomArchivo = $fecha."_".$sbTitle.'.pdf';
		
	    $this->objPdf->Output( $sbNomArchivo, 'D' );
    	
    }
    
    
    function executeGetReport2Excel()
    {    	

    	$sbFechaIni = $_REQUEST['FechaIni'];
    	$sbFechaFin = $_REQUEST['FechaFin'];
    	$sbNoComprobante = $_REQUEST['NoComprobante'];
    
    	
    	$this->objQuerys->Report2($sbFechaIni, $sbFechaFin, $sbNoComprobante);
    	
    	$fecha = date("Y")."-".date("m")."-".date("d");
		$hora = getdate(time());
		$sbUserName=getSession("username");
    	
		$sbTitleSec = "Fecha Inicial: ". $sbFechaIni . " Fecha Final: " . $sbFechaFin . " Usuario: ".$sbUserName;
		
    	$nomArchivo=PATH_INFORMES_GENERADOS_EXCEL.$fecha."_Reporte_Estado_Mercancia.csv";
		$arch = fopen($nomArchivo,"w+");
		fwrite($arch,$sbTitleSec.ENTER_ARCHIVOS_EXCEL);
		fwrite($arch,"Cliente".SEPARADOR_ARCHIVOS_EXCEL.
		             "FechaEnvio".SEPARADOR_ARCHIVOS_EXCEL.
					 "NoComprobante".SEPARADOR_ARCHIVOS_EXCEL.
					 "TotalCajas".SEPARADOR_ARCHIVOS_EXCEL.
					 "CajasEnviadas".SEPARADOR_ARCHIVOS_EXCEL.
					 "Pendientes".ENTER_ARCHIVOS_EXCEL);
		
	

		
		foreach ($this->objQuerys->report_array as $rcDatos) { 	
	
		        fwrite($arch, $rcDatos["Cliente"].SEPARADOR_ARCHIVOS_EXCEL.
		                      $rcDatos["FechaEnvio"].SEPARADOR_ARCHIVOS_EXCEL.
		                      $rcDatos["NoComprobante"].SEPARADOR_ARCHIVOS_EXCEL.
		                      $rcDatos["TotalCajas"].SEPARADOR_ARCHIVOS_EXCEL.
		                      $rcDatos["CajasEnviadas"].SEPARADOR_ARCHIVOS_EXCEL.
			                  $rcDatos["Pendientes"].ENTER_ARCHIVOS_EXCEL);
	     } 
	     
	     
	    fclose($arch);
		$sbFileName = $fecha."_Reporte_Estado_Mercancia.csv";
		$this->objApiDescargas ->descargarArchivo($nomArchivo, $sbFileName, ARCHIVO_EXCEL);					

    	
    }
    
    //Reporte Mercancia x DNI
    
    function executeGetReport3Pdf()
    { 

    	$sbFechaIni = $_REQUEST['FechaIni'];
    	$sbFechaFin = $_REQUEST['FechaFin'];
    	$sbDNI = $_REQUEST['NoComprobante'];
    
    	
    	$this->objQuerys->Report3($sbFechaIni, $sbFechaFin, $sbDNI);
    	
    	$fecha = date("Y")."-".date("m")."-".date("d");
		$hora = getdate(time());
		$sbUserName=getSession("username");
    	
		$sbTitleSec = "Fecha Inicial: ". $sbFechaIni . " Fecha Final: " . $sbFechaFin . " Usuario: ".$sbUserName;
    	
    	$this->objPdf->setTitulo("Reporte Mercancia x DNI");
    	$this->objPdf->setTituloSecundario($sbTitleSec);
    	$this->objPdf->setFecha($fecha." ".$hora["hours"] . ":" . $hora["minutes"] . ":" . $hora["seconds"]);
    	
    	//Armando Reporte
    	$nuTamanoCelda = 25;
		$nuAnchoCelda = 7;

		$this->objPdf->AddPage('L');
		$this->objPdf->SetFont('Arial', 'B', 14);
	
		$this->objPdf->SetFont('Arial', 'B', 10);
		
		$this->objPdf->SetFillColor(50);
		$this->objPdf->centrarTexto(($nuTamanoCelda*10)+($nuTamanoCelda/3));
		$this->objPdf->Cell($nuTamanoCelda/3, 7, '#', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+15, 7, 'Cliente', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+5, 7, 'NoComprobante', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+5, 7, 'FechaIngreso', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda, 7, 'TotalCajas', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda, 7, 'CajasActuales', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda, 7, 'Cubicaje', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+50, 7, 'Notas', 1, 1, 'C');			

	
	    $nuI = 0;
		foreach ($this->objQuerys->report_array as $rcDatos) { 
     			
			if($nuI>0){	
				$this->objPdf->SetFont('Arial', '', 9);
				
				$this->objPdf->centrarTexto(($nuTamanoCelda*10)+($nuTamanoCelda/3));
				$nuCantidad++;
				
    			$this->objPdf->Cell($nuTamanoCelda/3, $nuAnchoCelda, $nuCantidad, 1, 0, 'C');
				$this->objPdf->Cell($nuTamanoCelda+15, $nuAnchoCelda, $rcDatos["Cliente"], 1, 0, 'C' );
				$this->objPdf->Cell($nuTamanoCelda+5, $nuAnchoCelda, $rcDatos["NoComprobante"], 1, 0, 'C' );
				$this->objPdf->Cell($nuTamanoCelda+5, $nuAnchoCelda, $rcDatos["FechaIngreso"], 1, 0, 'C' );
				$this->objPdf->Cell($nuTamanoCelda, $nuAnchoCelda, $rcDatos["TotalCajas"], 1, 0, 'C' );
				if($rcDatos["CajasActuales"]== ""){
					$this->objPdf->Cell($nuTamanoCelda, $nuAnchoCelda, $rcDatos["TotalCajas"], 1, 0, 'C' );
				}else{
					$this->objPdf->Cell($nuTamanoCelda, $nuAnchoCelda, $rcDatos["CajasActuales"], 1, 0, 'C' );
				}
				$this->objPdf->Cell($nuTamanoCelda, $nuAnchoCelda, $rcDatos["Cubicaje"], 1, 0, 'C' );
				$this->objPdf->Cell($nuTamanoCelda+50, $nuAnchoCelda, $rcDatos["Notas"], 1, 1, 'C');	
			}
			$nuI++;		

		}
    	//Fin Armando Reporte
    	
    	$sbTitle = "Reporte_Mercancia_DNI";
		$sbNomArchivo = $fecha."_".$sbTitle.'.pdf';
		
	    $this->objPdf->Output( $sbNomArchivo, 'D' );
    	
    }
    
    
    function executeGetReport3Excel()
    {    	

    	$sbFechaIni = $_REQUEST['FechaIni'];
    	$sbFechaFin = $_REQUEST['FechaFin'];
    	$sbNoComprobante = $_REQUEST['NoComprobante'];
    	
    	$this->objQuerys->Report3($sbFechaIni, $sbFechaFin, $sbNoComprobante);
    	
    	$fecha = date("Y")."-".date("m")."-".date("d");
		$hora = getdate(time());
		$sbUserName=getSession("username");
    	
		$sbTitleSec = "Fecha Inicial: ". $sbFechaIni . " Fecha Final: " . $sbFechaFin . " Usuario: ".$sbUserName;
		
    	$nomArchivo=PATH_INFORMES_GENERADOS_EXCEL.$fecha."_Reporte_Mercancia_DNI.csv";
		$arch = fopen($nomArchivo,"w+");
		fwrite($arch,$sbTitleSec.ENTER_ARCHIVOS_EXCEL);

		fwrite($arch,"Cliente".SEPARADOR_ARCHIVOS_EXCEL.
		             "NoComprobante".SEPARADOR_ARCHIVOS_EXCEL.
					 "FechaIngreso".SEPARADOR_ARCHIVOS_EXCEL.
					 "TotalCajas".SEPARADOR_ARCHIVOS_EXCEL.
					 "CajasActuales".SEPARADOR_ARCHIVOS_EXCEL.
					 "Cubicaje".SEPARADOR_ARCHIVOS_EXCEL.
					 "Notas".ENTER_ARCHIVOS_EXCEL);
		
	

		
		foreach ($this->objQuerys->report_array as $rcDatos) { 	
	
			    $sbCajasActuales = "";
			    if($rcDatos["CajasActuales"]== ""){
			   	  $sbCajasActuales=$rcDatos["TotalCajas"];
			    }else{
			   	  $sbCajasActuales=$rcDatos["CajasActuales"];
			    }
		        fwrite($arch, $rcDatos["Cliente"].SEPARADOR_ARCHIVOS_EXCEL.
		                      $rcDatos["NoComprobante"].SEPARADOR_ARCHIVOS_EXCEL.
		                      $rcDatos["FechaIngreso"].SEPARADOR_ARCHIVOS_EXCEL.
		                      $rcDatos["TotalCajas"].SEPARADOR_ARCHIVOS_EXCEL.
		                      $sbCajasActuales.SEPARADOR_ARCHIVOS_EXCEL.
			                  $rcDatos["Cubicaje"].SEPARADOR_ARCHIVOS_EXCEL.
			                  $rcDatos["Notas"].ENTER_ARCHIVOS_EXCEL);
	     } 
	     
	     
	    fclose($arch);
		$sbFileName = $fecha."_Reporte_Mercancia_DNI.csv";
		$this->objApiDescargas ->descargarArchivo($nomArchivo, $sbFileName, ARCHIVO_EXCEL);					

    	
    }
    
    //Reporte Contenedor x DNI
  
    function executeGetReport4Pdf()
    { 

    	$sbFechaIni = $_REQUEST['FechaIni'];
    	$sbFechaFin = $_REQUEST['FechaFin'];
    	$sbDNI = $_REQUEST['NoComprobante'];
    
    	
    	$this->objQuerys->Report4($sbFechaIni, $sbFechaFin, $sbDNI);
    	
    	$fecha = date("Y")."-".date("m")."-".date("d");
		$hora = getdate(time());
		$sbUserName=getSession("username");
    	
		$sbTitleSec = "Fecha Inicial: ". $sbFechaIni . " Fecha Final: " . $sbFechaFin . " Usuario: ".$sbUserName;
    	
    	$this->objPdf->setTitulo("Reporte Contenedor x DNI");
    	$this->objPdf->setTituloSecundario($sbTitleSec);
    	$this->objPdf->setFecha($fecha." ".$hora["hours"] . ":" . $hora["minutes"] . ":" . $hora["seconds"]);
    	
    	//Armando Reporte
    	$nuTamanoCelda = 25;
		$nuAnchoCelda = 7;

		$this->objPdf->AddPage('L');
		$this->objPdf->SetFont('Arial', 'B', 14);
	
		$this->objPdf->SetFont('Arial', 'B', 10);
		
		$this->objPdf->SetFillColor(50);
		$this->objPdf->centrarTexto(($nuTamanoCelda*10)+($nuTamanoCelda/3));
		$this->objPdf->Cell($nuTamanoCelda/3, 7, '#', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+15, 7, 'Cliente', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+5, 7, 'Contenedor', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+5, 7, 'NoComprobante', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+10, 7, 'Descripcion', 1, 1, 'C');		

	
	    $nuI = 0;
		foreach ($this->objQuerys->report_array as $rcDatos) { 
     			
			if($nuI>0){	
				$this->objPdf->SetFont('Arial', '', 9);
				
				$this->objPdf->centrarTexto(($nuTamanoCelda*10)+($nuTamanoCelda/3));
				$nuCantidad++;
				
    			$this->objPdf->Cell($nuTamanoCelda/3, $nuAnchoCelda, $nuCantidad, 1, 0, 'C');
				$this->objPdf->Cell($nuTamanoCelda+15, $nuAnchoCelda, $rcDatos["Cliente"], 1, 0, 'C' );
				$this->objPdf->Cell($nuTamanoCelda+5, $nuAnchoCelda, $rcDatos["Contenedor"], 1, 0, 'C' );
				$this->objPdf->Cell($nuTamanoCelda+5, $nuAnchoCelda, $rcDatos["NoComprobante"], 1, 0, 'C' );
				$this->objPdf->Cell($nuTamanoCelda+10, $nuAnchoCelda, $rcDatos["Descripcion"], 1, 1, 'C' );	
			}
			$nuI++;		

		}
    	//Fin Armando Reporte
    	
    	$sbTitle = "Reporte_Contenedor_DNI";
		$sbNomArchivo = $fecha."_".$sbTitle.'.pdf';
		
	    $this->objPdf->Output( $sbNomArchivo, 'D' );
    	
    }
    
    
    function executeGetReport4Excel()
    {    	

    	$sbFechaIni = $_REQUEST['FechaIni'];
    	$sbFechaFin = $_REQUEST['FechaFin'];
    	$sbNoComprobante = $_REQUEST['NoComprobante'];
    
    	
    	$this->objQuerys->Report4($sbFechaIni, $sbFechaFin, $sbNoComprobante);
    	
    	$fecha = date("Y")."-".date("m")."-".date("d");
		$hora = getdate(time());
		$sbUserName=getSession("username");
    	
		$sbTitleSec = "Fecha Inicial: ". $sbFechaIni . " Fecha Final: " . $sbFechaFin . " Usuario: ".$sbUserName;
		
    	$nomArchivo=PATH_INFORMES_GENERADOS_EXCEL.$fecha."_Reporte_Contenedor_DNI.csv";
		$arch = fopen($nomArchivo,"w+");
		fwrite($arch,$sbTitleSec.ENTER_ARCHIVOS_EXCEL);
	
		fwrite($arch,"Cliente".SEPARADOR_ARCHIVOS_EXCEL.
		             "Contenedor".SEPARADOR_ARCHIVOS_EXCEL.
					 "NoComprobante".SEPARADOR_ARCHIVOS_EXCEL.
					 "Descripcion".ENTER_ARCHIVOS_EXCEL);
		
		foreach ($this->objQuerys->report_array as $rcDatos) { 	
	
		        fwrite($arch, $rcDatos["Cliente"].SEPARADOR_ARCHIVOS_EXCEL.
		                      $rcDatos["Contenedor"].SEPARADOR_ARCHIVOS_EXCEL.
		                      $rcDatos["NoComprobante"].SEPARADOR_ARCHIVOS_EXCEL.
		                      $rcDatos["Descripcion"].ENTER_ARCHIVOS_EXCEL);
	     } 
	     
	     
	    fclose($arch);
		$sbFileName = $fecha."_Reporte_Contenedor_DNI.csv";
		$this->objApiDescargas ->descargarArchivo($nomArchivo, $sbFileName, ARCHIVO_EXCEL);					

    	
    }
    
    

    //Reporte Contenedor x Codigo
  
    function executeGetReport5Pdf()
    { 

    	$sbFechaIni = $_REQUEST['FechaIni'];
    	$sbFechaFin = $_REQUEST['FechaFin'];
    	$sbCodCont = $_REQUEST['NoComprobante'];
    
    	
    	$this->objQuerys->Report5($sbFechaIni, $sbFechaFin, $sbCodCont);
    	
    	$fecha = date("Y")."-".date("m")."-".date("d");
		$hora = getdate(time());
		$sbUserName=getSession("username");
    	
		$sbTitleSec = "Fecha Inicial: ". $sbFechaIni . " Fecha Final: " . $sbFechaFin . " Usuario: ".$sbUserName;
    	
    	$this->objPdf->setTitulo("Reporte Contenedor x Codigo");
    	$this->objPdf->setTituloSecundario($sbTitleSec);
    	$this->objPdf->setFecha($fecha." ".$hora["hours"] . ":" . $hora["minutes"] . ":" . $hora["seconds"]);
    	
    	//Armando Reporte
    	$nuTamanoCelda = 25;
		$nuAnchoCelda = 7;

		$this->objPdf->AddPage('L');
		$this->objPdf->SetFont('Arial', 'B', 14);
	
		$this->objPdf->SetFont('Arial', 'B', 10);
		
		$this->objPdf->SetFillColor(50);
		$this->objPdf->centrarTexto(($nuTamanoCelda*10)+($nuTamanoCelda/3));
		$this->objPdf->Cell($nuTamanoCelda/3, 7, '#', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+15, 7, 'Cliente', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+5, 7, 'Contenedor', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+5, 7, 'NoComprobante', 1, 0, 'C');
		$this->objPdf->Cell($nuTamanoCelda+10, 7, 'Descripcion', 1, 1, 'C');		

	
	    $nuI = 0;
		foreach ($this->objQuerys->report_array as $rcDatos) { 
     			
			if($nuI>0){	
				$this->objPdf->SetFont('Arial', '', 9);
				
				$this->objPdf->centrarTexto(($nuTamanoCelda*10)+($nuTamanoCelda/3));
				$nuCantidad++;
				
    			$this->objPdf->Cell($nuTamanoCelda/3, $nuAnchoCelda, $nuCantidad, 1, 0, 'C');
				$this->objPdf->Cell($nuTamanoCelda+15, $nuAnchoCelda, $rcDatos["Cliente"], 1, 0, 'C' );
				$this->objPdf->Cell($nuTamanoCelda+5, $nuAnchoCelda, $rcDatos["Contenedor"], 1, 0, 'C' );
				$this->objPdf->Cell($nuTamanoCelda+5, $nuAnchoCelda, $rcDatos["NoComprobante"], 1, 0, 'C' );
				$this->objPdf->Cell($nuTamanoCelda+10, $nuAnchoCelda, $rcDatos["Descripcion"], 1, 1, 'C' );	
			}
			$nuI++;		

		}
    	//Fin Armando Reporte
    	
    	$sbTitle = "Reporte_Contenedor_Codigo";
		$sbNomArchivo = $fecha."_".$sbTitle.'.pdf';
		
	    $this->objPdf->Output( $sbNomArchivo, 'D' );
    	
    }
    
    
    function executeGetReport5Excel()
    {    	

    	$sbFechaIni = $_REQUEST['FechaIni'];
    	$sbFechaFin = $_REQUEST['FechaFin'];
    	$sbCodCont = $_REQUEST['NoComprobante'];
    
    	
    	$this->objQuerys->Report5($sbFechaIni, $sbFechaFin, $sbCodCont);
    	
    	$fecha = date("Y")."-".date("m")."-".date("d");
		$hora = getdate(time());
		$sbUserName=getSession("username");
    	
		$sbTitleSec = "Fecha Inicial: ". $sbFechaIni . " Fecha Final: " . $sbFechaFin . " Usuario: ".$sbUserName;
		
    	$nomArchivo=PATH_INFORMES_GENERADOS_EXCEL.$fecha."_Reporte_Contenedor_Codigo.csv";
		$arch = fopen($nomArchivo,"w+");
		fwrite($arch,$sbTitleSec.ENTER_ARCHIVOS_EXCEL);
	
		fwrite($arch,"Cliente".SEPARADOR_ARCHIVOS_EXCEL.
		             "Contenedor".SEPARADOR_ARCHIVOS_EXCEL.
					 "NoComprobante".SEPARADOR_ARCHIVOS_EXCEL.
					 "Descripcion".ENTER_ARCHIVOS_EXCEL);
		
		foreach ($this->objQuerys->report_array as $rcDatos) { 	
	
		        fwrite($arch, $rcDatos["Cliente"].SEPARADOR_ARCHIVOS_EXCEL.
		                      $rcDatos["Contenedor"].SEPARADOR_ARCHIVOS_EXCEL.
		                      $rcDatos["NoComprobante"].SEPARADOR_ARCHIVOS_EXCEL.
		                      $rcDatos["Descripcion"].ENTER_ARCHIVOS_EXCEL);
	     } 
	     
	     
	    fclose($arch);
		$sbFileName = $fecha."_Reporte_Contenedor_Codigo.csv";
		$this->objApiDescargas ->descargarArchivo($nomArchivo, $sbFileName, ARCHIVO_EXCEL);					

    	
    }
    
    
    
	function executeViewReport1() {
		
		    $sbTitulo="Reporte Estado Caja";
		     
			$this->objSmarty->template_dir = "../../View/reporte";
			$this->objSmarty->assign("Titulo",$sbTitulo);
			$this->objSmarty->display ("reporte1.html");
		
	}
	
	
	function executeViewReport2() {
		
			$sbIdPerfil=getSession("idperfil");
    		$sbIdRol=getSession("idrol");
			$this->objQuerysCustomer->getCustomerPerfil($sbIdPerfil);
					
		    $sbTitulo="Reporte Estado Mercancia";
		     
			$this->objSmarty->template_dir = "../../View/reporte";
			$this->objSmarty->assign("Titulo",$sbTitulo);
			$this->objSmarty->assign("IdRol",$sbIdRol);
			$this->objSmarty->assign("DNI",$this->objQuerysCustomer->DNI);
			$this->objSmarty->display ("reporte2.html");
		
	}
	
	
	function executeViewReport3() {
		
			$sbIdPerfil=getSession("idperfil");
    		$sbIdRol=getSession("idrol");
			$this->objQuerysCustomer->getCustomerPerfil($sbIdPerfil);
		
		    $sbTitulo="Reporte Mercancia x DNI";
		     
			$this->objSmarty->template_dir = "../../View/reporte";
			$this->objSmarty->assign("Titulo",$sbTitulo);
			$this->objSmarty->assign("IdRol",$sbIdRol);
			$this->objSmarty->assign("DNI",$this->objQuerysCustomer->DNI);
			$this->objSmarty->display ("reporteMercancia.html");
		
	}
	
	
	function executeViewReport4() {
		
			$sbIdPerfil=getSession("idperfil");
    		$sbIdRol=getSession("idrol");
			$this->objQuerysCustomer->getCustomerPerfil($sbIdPerfil);
		
		    $sbTitulo="Reporte Contenedor x DNI";
		     
			$this->objSmarty->template_dir = "../../View/reporte";
			$this->objSmarty->assign("Titulo",$sbTitulo);
			$this->objSmarty->assign("IdRol",$sbIdRol);
			$this->objSmarty->assign("DNI",$this->objQuerysCustomer->DNI);
			$this->objSmarty->display ("reporteContenedor.html");
		
	}
	
	
	function executeViewReport5() {
		
			$sbIdPerfil=getSession("idperfil");
    		$sbIdRol=getSession("idrol");
			$this->objQuerysCustomer->getCustomerPerfil($sbIdPerfil);
		
		    $sbTitulo="Reporte Contenedor x Codigo";
		     
			$this->objSmarty->template_dir = "../../View/reporte";
			$this->objSmarty->assign("Titulo",$sbTitulo);
			$this->objSmarty->assign("IdRol",$sbIdRol);
			$this->objSmarty->assign("DNI",$this->objQuerysCustomer->DNI);
			$this->objSmarty->display ("reporteContenedor2.html");
		
	}
		

}

$objApiReporte = new apiReporte();
$sbAction = $_REQUEST['action'];
$objApiReporte->execute( $objApiReporte , $sbAction );


?>