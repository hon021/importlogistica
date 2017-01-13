<?php 
 class Request {
  function Request() {
	  
  }
  
  function getAttribute ($rcParametros, $sbAtributeName) {  	   
  	if ( array_key_exists($sbAtributeName, $rcParametros)) {
  		$sbParameter = $rcParametros[$sbAtributeName];
  		return $sbParameter;
  	} else {
  		return false;
  	}  	
  }
  
  function getAttributeNumeric ($rcParametros, $sbAtributeName) {
  	if ( array_key_exists($sbAtributeName, $rcParametros)) {
  		$sbParameter = $rcParametros[$sbAtributeName];
  		if ($sbParameter=='')
  			return '0';
  		else  		
  			return $sbParameter;
  	} else {
  		return 0;
  	}
  }
  
  function getCheckBoxValues($rcParametros, $nuLogitud, $sbPrefijo) {
  	for($i=0;$i<$nuLogitud;$i++) {
			$sbNombre =$sbPrefijo.$i;
			$sbValor=$this->getAttribute($rcParametros,$sbNombre);			
			if ($sbValor) {
				$rcValores[]=$sbValor;
			}
  	}  	
  	return $rcValores;
  }
  
  function getAttributeRequest ($rcParametros, $sbAtributeName) {  	   
  	if ( array_key_exists($sbAtributeName, $rcParametros)) {
  		$sbParameter = $rcParametros[$sbAtributeName];
  		return $sbParameter;
  	} else {
  		return false;
  	}
  	
  }
}
 
?>