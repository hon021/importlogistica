<?php
class Conexion{
	private $objConexion;
	private $nuTotal_consultas;
	
	public function Conexion(){
		if(!isset($this->objConexion)){
			$this->objConexion = (mysql_connect("localhost","root","trosky")) or die(mysql_error());
			mysql_select_db("test",$this->objConexion) or die(mysql_error());
		}
	}
	public function Ejecucion($sbConsulta){
		$this->nuTotal_consultas++;
		$sbResultado = mysql_query($sbConsulta,$this->objConexion);
		if(!$sbResultado){
			echo 'MySQL Error: ' . mysql_error();
			exit;
		}
		return $sbResultado;
	}
	
	public function fetch_array($sbConsulta){
		return mysql_fetch_array($sbConsulta);
	}
	
	public function num_rows($sbConsulta){
		return mysql_num_rows($sbConsulta);
	}
	
	public function getTotalConsultas(){
		return $this->nuTotal_consultas;
	}
}
?>