<?php
class med {

	public $init = false;
	public $version = "V0.0.2";
	function __construct() {

		$this->init = true;

		}

	public function cleanInput($a) {

		if (!is_array($a)) return false;
		$x = array();
		foreach ($a as $key=>$value) $x[$key] = addslashes($value);
		return $x;

		}

	public function hash($string=null) {

		$salt = "temporary salt";
		return hash("whirlpool",$string);

		}

	public function copyright() {

		return "&copy; 2013".(date("Y")>2013?"-".date("Y"):"").". ".$this->version;

		}

	}
?>