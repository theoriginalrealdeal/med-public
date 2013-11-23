<?php
// debug mode, needs to be based on validation, but for now open
$debug = isset($_GET["debug"])?true:false;
if ($debug) {

	error_reporting(E_ALL);
	ini_set('display_errors','1');

	}

// php < 5.3 doesn't support anonymous functions, so using this autoloader which is compatible with php 5.0+
function compatibleAutoloader($class) {

	include 'lib/classes/' . $class . '.php';

	}

spl_autoload_register('compatibleAutoloader');

// default timezone, will make this a database variable
date_default_timezone_set('America/Chicago');


// errorArray holds all global errors, page then finds and processes errors
$errorArray = array();


// start templating
define("MED_BASE","lib/template/");	// root template directory, from root directory
if (!isset($_GET["MED_DO"]) || $_GET["MED_DO"] == "login") {

	define("MED_DO","login");
	define("MED_PAGE",MED_BASE."login.php");

	}

else if (isset($_GET["MED_DO"]) && $_GET["MED_DO"] == "information") {

	define("MED_DO","information");
	define("MED_PAGE",MED_BASE."information.php");

	}

?>