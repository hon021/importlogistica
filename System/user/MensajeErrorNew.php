<?php

include_once ("Constantes.php");
include_once ("Sistema.php");
include_once ("StringTokenizer.php");

class MensajeErrorNew {
	
	private $sbMensaje;
	var $nuCodigoerror;
	var $nuLenguaje;
	var $sbDescripcion;
	var $nuPrioridad;
	var $sbRecomendaciones;
	var $dtFecha;
	var $tiHora;
	
  /*function _MensajeError() {
	  
  }*/
  
  function MensajeErrorNew ($sbMensaje) 
  {
  	$sbMensaje = str_replace('\n', '\0', $sbMensaje);  	
  	$objParser = new StringTokenizer($sbMensaje,SEPAREGISTROS);  	 
  	$this->nuCodigoerror = $objParser->nextToken();  
  		
  	if (!$this->esExitosa()) 
  	{
  	  $objParserCampos = new StringTokenizer ($objParser->nextToken(), SEPACAMPOS);
  	  $this->nuPrioridad=$objParserCampos->nextToken();
  	  $this->sbDescripcion = $objParserCampos->nextToken();
  	  $this->sbRecomendaciones = $objParserCampos->nextToken();
  	}
  }
  
  /*
  function MensajeError()
  {
  	$this->sbMensaje = "";
  	$this->nuCodigoerror = -1;
  	$this->nuLenguaje = -1;
  	$this->sbDescripcion = "";
  	$this->nuPrioridad = -1;
  	$this->sbRecomendaciones = "";
  	$this->dtFecha = null;
  	$this->tiHora = null;
  }
  
  function setMensajeError( $sbMensaje )
  {
  	$this->sbMensaje = $sbMensaje;
  }
  
  private function procesarError()
  {
  	$sbMensaje = str_replace('\n', '\0', $sbMensaje);  	
  	$objParser = new StringTokenizer($sbMensaje,SEPAREGISTROS);  	 
  	$this->nuCodigoerror = $objParser->nextToken();  
  		
  	if (!$this->esExitosa()) 
  	{
  	  $objParserCampos = new StringTokenizer ($objParser->nextToken(), SEPACAMPOS);
  	  $this->nuPrioridad=$objParserCampos->nextToken();
  	  $this->sbDescripcion = $objParserCampos->nextToken();
  	  $this->sbRecomendaciones = $objParserCampos->nextToken();
  	}
  }*/
  
  function esExitosa () {
  	return ($this->nuCodigoerror == 0);
  }
  
  function getFechaHoraServer () {
  	$objSocket = new Socket();
  	$sbPeticion = 4456;
  	
  	$objSocket->EscribirToken($sbPeticion);
  	$sbRespuesta = $objSocket->LeerToken();
  	$objSocket->CerrarSocket(); //cierra el socket
  	  	
  	$objParserCampos = new StringTokenizer($sbRespuesta, SEPACAMPOS);
  	$this->dtFecha = $objParserCampos->nextToken();
  	$this->tiHora = $objParserCampos->nextToken();
  }  
  
  function showMessage () {
 	$sbCadena = '<script>';
 	$sbCadena.= 'sbMensaje = "[ error '.$this->nuCodigoerror.' ]\n";'.SEPALINEA;
	$sbCadena.= 'sbMensaje+= "'.$this->sbDescripcion.'\n"; '.SEPALINEA;
	$sbCadena.= 'sbMensaje+= "'.$this->sbRecomendaciones.'";'.SEPALINEA;
	$sbCadena.= ' alert(sbMensaje)'.SEPALINEA;
	$sbCadena.= '</script>';  	
  	echo $sbCadena;
  }
  
  function goBack () {
  	$sbCadena = '<script>window.history.back();</script>';
  	echo $sbCadena;
  } 
  
  /**
   * @author Hfrojas
   * @access public
   * @param {intger} nuCodigoError
   * @param {String} sbMensajeError
   * @return {String} Retorna mensaje de error en formato Json.
   * +Description: Funcion que recibe el codigo de error y el mensaje
   * 			   y lo devuelve en formato Json.
   * */
  public function mensajeErrorJson()
  {
  	$arrParametrosError = array(
  								  'error' 			=> $this->nuCodigoerror,
  								  'descripcion'		=> $this->sbDescripcion,
  								  'recomendaciones' => $this->sbRecomendaciones
  								);
  	
  	header("HTTP/1.0 404 Not Found");
  	echo( json_encode( $arrParametrosError ) );
  }
  
}
 
?>