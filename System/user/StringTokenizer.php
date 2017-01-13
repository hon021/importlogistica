<?php
include_once ("../../Model/define/brDefineGeneral.php");   
   
 class StringTokenizer {
 	var $rcCampos;
 	var $sbSeparador;
 	var $nuSize;
 	var $nuPosition;
 	var $sbString;
 	
  /*function StringTokenizer() {
	  
  }*/
  
  function StringTokenizer($sbStringTokenize="", $sbToken="") {  	
	$this->sbSeparador = $sbToken;
	$this->sbString = $sbStringTokenize;
	if ($sbStringTokenize!= "" && $sbStringTokenize!= "")
		$this->tokenizer();
	$this->nuPosition=0;
  }
  
  /*function StringTokenizer($sbStringTokenize) {
	$this->sbSeparador = SEPAREGISTROS;
	$this->sbCadena = $sbStringTokenize;
	$this->tokenizer();
  }*/
  
  function tokenizer () {
  	$this->rcCampos = explode($this->sbSeparador, $this->sbString);  	
  	$this->nuSize = sizeof ($this->rcCampos);  	
  	$this->nuPosition = 0;  	 	
  }
  
  function tokenizerString ($sbStringTokenize, $sbToken) {
  	$this->sbSeparador = $sbToken;
	$this->sbString = $sbStringTokenize;
	$this->tokenizer();
	$this->nuPosition=0;
  }
  
  function hasMoreTokens (){
  	if ($this->nuPosition>=$this->nuSize)
  	  return false;
  	else 
  	  return true;
  }
  
  function nextToken() {  	    
    $sbReturn = $this->rcCampos[$this->nuPosition];    
    $this->nuPosition++;
    return $sbReturn;
  }
  
  function nextFloat() {
  	return round($this->nextToken());
  }
  
 function nextFloatWithDecimals() {
  	return ($this->nextToken());
  }
  
  function nextBool () {
  	$sbCadena = $this->nextToken();
  	if ($sbCadena==TRUE_CADENA) 
  		return true;
  	else 
  		return false;
  }
  	
}
?>
