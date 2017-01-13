<?php
/**************************************************************************************************
 Clase Socket:  Crea las funciones para  trabajar con Socket
 **************************************************************************************************/
include_once ("StringTokenizer.php");
include_once ("PropertiesPHP.php");
include_once ("MensajeError.php");
include_once ("Sistema.php");
include_once ("Request.php");

include_once("../../Model/define/brDefineGeneral.php");
include_once("../../Model/br/Constantes.php");

class Socket {

	var $Parseo;

	function Socket() {
		$this->Parseo = new StringTokenizer("","");
	}


	function CreateSoket($sbString){
		set_time_limit(0);

		// DEFINICIÓN DE VARIABLES
		$host = IP;
		$port = PUERTO;
			

		// CREANDO EL SOCKET: (IP PROTOCOL[IPV4], TYPE SOCKET[TCP], PROTOCOL[TCP])
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		$conexion = socket_connect($socket, $host, $port);

		// DEFINICIÓN DE VARIABLES
		$buffer = "$sbString";
		$reading = 't';
		$out = "";
		$aux = true;


		// ESCRIBIENDO EL BUFFER EN EL SOCKET
		socket_write($socket, $buffer);
		// LEYENDO RESPUESTA DEL SOCKET

		while($resp = socket_read($socket, 1000)) {
			$out .= $resp;
			if (strpos($out, "&") !== false) break;
		}


		//$out =socket_read($socket, 2048);
		// CERRANDO LA CONEXIÓN
		socket_close($socket);

		return $out;
	}


}
?>