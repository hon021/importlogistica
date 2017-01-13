<?php

class  Properties{
	var $fp;
	var $vect;

    function PropertiesPHP(){
    }

    function load($file){    	    	
		$this->vect=NULL;
		$this->fp = fopen($file,"r");
		if ( !$this->fp) {
			return false;
		}
		
		while (!feof ($this->fp)) {
			$linea = fgets($this->fp,100);
			$token = strtok($linea,"\t");
			if($token){
				$valor = strtok("\t");
				if($valor)$this->vect[$token]=$valor;
				else $this->vect[$token]=NULL;
			}
		}
		fclose ($this->fp);
		
		return true;		
    }

	function get($llave){
		return trim($this->vect[$llave]);
	}
}
?>