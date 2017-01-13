<?php
/*
 * Created on 19/05/2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 include_once("String.php");
 include_once("MensajeErrorNew.php");
 
 class Service
 {
 	private $objSocket;
 	private $objMensajeError;
 	private $sbRespuesta;
 	
 	public function __construct()
 	{
 		$this->objSocket = new Socket();
 		$this->objMensajeError = null;
 		$this->sbRespuesta = null;
 	}	
 	
 	public function sendService( $nuServicio, $arrDatos )
 	{
 		$sbServicio = "";
 		$sbServicio = String::crearCadenaServicio( $nuServicio, $arrDatos );
 		
 		$this->objSocket->EscribirToken( $sbServicio );
 		$sbRespuesta = $this->objSocket->LeerToken();
 		$this->objSocket->CerrarSocket();
 		
 		$objMensajeError = new MensajeErrorNew( $sbRespuesta );
 		$this->setMensaje( $objMensajeError );
 		$this->setRespuesta( $sbRespuesta );
 	}
 	
 	private function setMensaje( $objMensaje )
 	{
 		$this->objMensajeError = $objMensaje;
 	}
 	
 	private function setRespuesta( $sbRespuesta )
 	{
 		$this->sbRespuesta = $sbRespuesta;
 	}
 	
 	public function getMensaje()
 	{
 		return $this->objMensajeError;
 	}
 	
 	public function getRespuesta()
 	{
 		return $this->sbRespuesta;
 	}
 }
 
?>
