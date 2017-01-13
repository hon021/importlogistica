<?php

class ApiDescargarFiles
{
	public function descargarArchivo( $sbFile, $sbName, $sbTipo )
	{
		header("Content-Disposition: attachment; filename=" . $sbName);
	
		if( $sbTipo == ARCHIVO_PDF  )
		{	
			header("Content-type: application/pdf");
			header("Content-Length: ".filesize($sbFile));
			readfile($sbFile);
			
			
		}else if ( $sbTipo == ARCHIVO_EXCEL )
		{
			
			header("Content-type: application/octetstream");
			header("Content-Length: ".filesize($sbFile));
			readfile ($sbFile);
			//unlink($sbPath);
		}
	}	
}
?>