<?php
class license {

	public $key = null;
	function __construct() {

		$this->key = md5($_SERVER["HTTP_HOST"]);

		}

	}
?>