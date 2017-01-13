<?php


class Sistema {
  function Sistema() {
	  
  }
  
  function showMessage ($sbMessage) { 	
  	//
  	$sbCadena = "<script>alert ('".$sbMessage."');</script>";
  	echo $sbCadena;
  }
  
 	 
	function VerificarCeldaNull($Valor){		
		if ($Valor == null){
			echo "<td><img src='../../general/img/espacio.jpg'/></td>";
		}else{
			echo "<td>".$Valor."</td>";   			
		} 
	}
  
  /*function _showMessage ($nuError, $sbMessage) { 	
  	//
  	$sbCadena = "<script>alert (['".$nuError."'] ".$sbMessage."');</script>";
  	echo $sbCadena;
  }*/

function getFechaActual (){
	return date("Y-m-d");
}

}
 
?>
