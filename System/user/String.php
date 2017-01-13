<?php
 include_once ("../../Model/define/brDefineGeneral.php");
 
 class String
 {
 	/**
 	 * @author Hfrojas
 	 * @param String sbServicio
 	 * @param Array	 arrDatosServicio
 	 * @return String Retorna una cadena con el formato de envio
 	 * 				  de servicios por Socket.
 	 * +Description Funcion que apartir del servicio y una coleccion
 	 * 				de datos retorna una cadena con el formato requerido
 	 * 				para enviarlo por Socket.
 	 * */
 	function crearCadenaServicio( $sbServicio, $arrDatosServicio )
 	{
 		$sbCadena = $sbServicio.SEPAREGISTROS;
 		$nuCantidadDatos = count( $arrDatosServicio ) - 1;
 		
 		foreach( $arrDatosServicio as $indice => $valor )
 		{
 			$sbCadena .= $valor;
 			
 			if( $indice < $nuCantidadDatos )
 				$sbCadena .= SEPACAMPOS;
 		}
 		
 		return $sbCadena;	 		
 	}
 	
 	/**
 	 * @author Hfrojas
 	 * @param  Array arrDatos
 	 * @return String Cadena en formato JSON
 	 * +Description: funcion que recibe un arreglo
 	 * 				 asociativo y lo converte a una
 	 * 				 cadena en formato JSON
 	 * */
 	/*static function convertirACadenaJSON( $arrDatos )
 	{
 		echo json_encode( $arrDatos );
 	}*/
 	
 }
 
?>
