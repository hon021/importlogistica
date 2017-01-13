<?php

include_once ("Constantes.php");
include_once ("Sistema.php");
include_once ("StringTokenizer.php");

class ErrorMessage {
	
	var $nuErrorCode;
	var $nuLenguaje;
	var $sbDescription;
	var $nuPriority;
	var $sbRecomendations;
	
	var $dtFecha;
	var $tiHora;
	
  /*function _MensajeError() {
	  
  }*/
  
  function ErrorMessage ($Message) {
  	//$sbMensaje = str_replace('\n', '\0', $sbMensaje);  	
  	$objParser = new StringTokenizer($Message,";");  	 
  	$this->nuErrorCode = $objParser->nextToken();  	
  	
  	if (!$this->isSuccessfull()) {
  	  $this->nuPriority = 10;
  	  $this->sbDescription = "Error en Respuesta";
  	  $this->sbRecomendations = "Scripts S.A.S"; 	   
  	  	  
  	}
  }
  
  function isSuccessfull () {
  	return ($this->nuErrorCode == 0);
  }
  
  function getFechaHoraServer () {
  	$objSocket = new Socket();
  	$sbRequest = 4456;
  	
  	$objSocket->EscribirToken($sbRequest);
  	$sbResponse = $objSocket->LeerToken();
  	$objSocket->CerrarSocket(); //cierra el socket
  	  	
  	$objParserCampos = new StringTokenizer($sbResponse, SEPACAMPOS);
  	$this->dtFecha = $objParserCampos->nextToken();
  	$this->tiHora = $objParserCampos->nextToken();
  }  
  
  function showMessage () {
 	$sbString = '<script>';
 	$sbString.= 'sbMensaje = "[ error '.$this->nuErrorCode.' ]\n";'.SEPALINEA;
	$sbString.= 'sbMensaje+= "'.$this->sbDescription.'\n"; '.SEPALINEA;
	$sbString.= 'sbMensaje+= "'.$this->sbRecomendations.'";'.SEPALINEA;
	$sbString.= ' alert(sbMensaje)'.SEPALINEA;
	$sbString.= '</script>';  	
  	echo $sbString;
  }
  
  function goBack () {
  	$sbString = '<script>window.history.back();</script>';
  	echo $sbString;
  } 
}
 
?>