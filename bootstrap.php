<?php
$debug = isset($_GET["debug"])?true:false;
function compatibleAutoloader($class) {

	include 'lib/classes/' . $class . '.php';

	}

spl_autoload_register('compatibleAutoloader');
date_default_timezone_set('America/Chicago');
$errorArray = array();
?>