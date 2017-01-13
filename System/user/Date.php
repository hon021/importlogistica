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
date_default_timezone_set('UTC');
class Date {
	
   var $dtFecha;
   private $rcDias;
   private $rcMeses;
   private $tmHora;
   private $tmHoraSinMeridiano;

  function Date() 
  {
  	$this->rcDias = array();
  	$this->rcMeses = array();
	$this->getFechaActual();	 
	$this->getHoraActual();
	$this->getHoraSinMeridiano();
  }
  
  function getFechaActual () {
  	$this->dtFecha = date('Y-m-d');
  }
  
  private function getHoraActual()
  {
  	$this->tmHora = date( 'h:i:s a' );
  }
  
  private function getHoraSinMeridiano()
  {
  	$this->tmHoraSinMeridiano = date( 'h:i:s' );
  }
  
  function getString() {
  	$rcData = explode("-", $this->dtFecha);
  	return join('',$rcData);
  }
  
  function getDate() {
  	return $this->dtFecha;
  }
  
  public function getHour()
  {
  	return $this->tmHora;
  }
  
  public function getHourWithoutMeridian()
  {
  	return $this->tmHoraSinMeridiano;
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
  
  function sumarDiasDate( $numeroDias )
  {
  	list( $anio, $mes, $dia ) = split( "-", $this->dtFecha );
  	$nuevaFecha = mktime( 0, 0, 0, $mes, $dia, $anio ) + $numeroDias * 24 * 60 * 60;
  	return date( 'Y-m-d', $nuevaFecha ); 
  }
  
  public function getDateLong()
  {
  	$nuYear = $this->getYear();
  	$nuDia = $this->getDay();
  	$nuMes = $this->getMonth()-1;
  	$nuDiaMes = $this->getDay();
  	
  	if( $nuYear < 1000 )
  		$nuYear += 1900;
  	
  	if( $nuDiaMes < 10 )
  		$nuDiaMes = "0" . $nuDiaMes;
  	
  	$this->cargarDias();
  	$this->cargarMeses();
  	
  	return $this->getDiaVector( $nuDia ) . " " . $nuDia . " de " . $this->getMesVector( $nuMes ) . " del " . $nuYear;
  } 
  
  public function getDiaVector( $nuDia )
  {
  	return $this->rcDias[ $nuDia ];
  }
  
  public function getMesVector( $nuMes )
  {
  	return $this->rcMeses[ $nuMes ];
  }
  
  private function cargarDias()
  {
  	array_push( $this->rcDias, "Domigo" );
  	array_push( $this->rcDias, "Lunes" );
  	array_push( $this->rcDias, "Martes" );
  	array_push( $this->rcDias, "Miercoles" );
  	array_push( $this->rcDias, "Jueves" );
  	array_push( $this->rcDias, "Viernes" );
  	array_push( $this->rcDias, "Sabado" );
  }
  
  private function cargarMeses()
  {
  	array_push( $this->rcMeses, "Enero" );
  	array_push( $this->rcMeses, "Febrero" );
  	array_push( $this->rcMeses, "Marzo" );
  	array_push( $this->rcMeses, "Abril" );
  	array_push( $this->rcMeses, "Mayo" );
  	array_push( $this->rcMeses, "Junio" );
  	array_push( $this->rcMeses, "Julio" );
  	array_push( $this->rcMeses, "Agosto" );
  	array_push( $this->rcMeses, "Septiembre" );
  	array_push( $this->rcMeses, "Octubre" );
  	array_push( $this->rcMeses, "Noviembre" );
  	array_push( $this->rcMeses, "Diciembre" );
  }
  
}
 
// Final de archivo PHP 
?>
