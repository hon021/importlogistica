<?php

define ("HORA_IGUAL", 0);
define ("HORA_MAYOR", 1);
define ("HORA_MENOR", -1);

class Time {
	var $tiHora;

	function Time() {
		$this->getHoraActual();
	}

	function add($nuMinutos) {
		$rcData = explode(':', $this->tiHora);
		$nuHora = mktime($rcData[0], $rcData[1], $rcData[2]);
		$nuHora += $nuMinutos * 60;
		$tiHora = strftime("%H:%M:%S", $nuHora);
		return $tiHora;
	}

	function setTime($tiHoraNew) {
		$this->tiHora = $tiHoraNew;
	}

	function getTime() {
		return $this->tiHora;
	}

	function getHoraActual() {
		$this->tiHora = date("H:i:s");
	}

	function getTimestamp() {
		$rcData = explode(':', $this->tiHora);
		$nuHora = mktime($rcData[0], $rcData[1], $rcData[2]);
		return $nuHora;
	}

	function between($tiHoraUno, $tiHoraDos) {
		$rcData = explode(':', $tiHoraUno);
		$rcDataDos = explode(':', $tiHoraDos);
		$nuHoraUno = mktime($rcData[0], $rcData[1], $rcData[2]);
		$nuHoraDos = mktime($rcDataDos[0], $rcDataDos[1], $rcDataDos[2]);

		$nuHoraActual = $this->getTimestamp();

		if (($nuHoraDos >= $nuHoraActual) && ($nuHoraUno <= $nuHoraActual)) {
			return true;
		} else
			return false;
	}

	function compararHora($objTime) {
		$nuHoraComparacion = $objTime->getTimestamp();
		$nuHoraActual = $this->getTimestamp();

		if ($nuHoraActual == $nuHoraComparacion)
			return HORA_IGUAL;
		if ($nuHoraActual > $nuHoraComparacion)
			return HORA_MAYOR;
		if ($nuHoraActual < $nuHoraComparacion)
			return HORA_MENOR;
	}
	
	function compare ($tiHora) {
		$objHoraCompare = new Time();
		$objHoraCompare->setTime($tiHora);
		$nuHoraComparacion = $objHoraCompare->getTimestamp();
		$nuHoraActual = $this->getTimestamp();

		if ($nuHoraActual == $nuHoraComparacion)
			return HORA_IGUAL;
		if ($nuHoraActual > $nuHoraComparacion)
			return HORA_MAYOR;
		if ($nuHoraActual < $nuHoraComparacion)
			return HORA_MENOR;
	}

	function getString() {
		$rcData = explode(":", $this->tiHora);
		return join('', $rcData);
	}

}
?>
