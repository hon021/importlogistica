<?php
/*
 * Nombre					:	Date.php
 * Fecha de creacion	:	21-feb-2006 - 9:24:57
 * Creado por				:	Usuario
 * 
 *	Historial de Modificaciones
 *
 */
 
// Inicio de archivos PHP

class Date {
	var $dtFecha;

  function Date() {
	$this->getFechaActual();	  
  }
  
  function getFechaActual () {
  	$this->dtFecha = date('Y-m-d');
  }
  
  function getString() {
  	$rcData = explode("-", $this->dtFecha);
  	return join('',$rcData);
  }
  
  function getDate() {
  	return $this->dtFecha;
  }
  
   function getDayOfTheWeek() {
	$rcData = explode("-", $this->dtFecha);
	$nuTime = mktime(0, 0, 0, $rcData[1], $rcData[2], $rcData[0]);
	return date ('w', $nuTime); 
  }
  
  function getDay() {
	$rcData = explode("-", $this->dtFecha);
	$nuTime = mktime(0, 0, 0, $rcData[1], $rcData[2], $rcData[0]);
	return date ('d', $nuTime); 
  }
  
  function getMonth () {
  	$rcData = explode("-", $this->dtFecha);
	$nuTime = mktime(0, 0, 0, $rcData[1], $rcData[2], $rcData[0]);
	return date ('m', $nuTime);
  }
  
  function getYear () {
  	$rcData = explode("-", $this->dtFecha);
	$nuTime = mktime(0, 0, 0, $rcData[1], $rcData[2], $rcData[0]);
	return date ('Y', $nuTime);
  }
  
  function getYearShort () {
  	$rcData = explode("-", $this->dtFecha);
	$nuTime = mktime(0, 0, 0, $rcData[1], $rcData[2], $rcData[0]);
	return date ('y', $nuTime);
  }
  
  function getDayName () {
  	$rcData = explode("-", $this->dtFecha);
	$nuTime = mktime(0, 0, 0, $rcData[1], $rcData[2], $rcData[0]);
	return date('D', $nuTime);
  }
  
  function getDateShort () {
  	$rcData = explode("-", $this->dtFecha);
	$nuTime = mktime(0, 0, 0, $rcData[1], $rcData[2], $rcData[0]);
	return date ('y-m-d', $nuTime);
  }
  
  function addDays($dtDate,$nuDays) {
  	$rcData = explode("-", $dtDate);
  	$nuTime = mktime(0, 0, 0, $rcData[1], $rcData[2], $rcData[0]) + $nuDays * 24 * 60 * 60;
  	return date('Y-m-d',$nuTime);
  }
  
}
 
// Final de archivo PHP 
?>
