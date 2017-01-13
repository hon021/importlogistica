<?php
session_start();
function setSession($parameter,$value){
	$_SESSION[$parameter] = $value;
}
function getSession($parameter){
	return $_SESSION[$parameter];
}

?>