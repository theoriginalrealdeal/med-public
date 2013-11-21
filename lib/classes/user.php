<?php
class user {

	public $uid = null;
	private $auth = false;
	function __construct($uid=null) {

		if (is_numeric($uid)) {

			$u = $this->db("SELECT * FROM users WHERE id = '$id'");

			}

		}

	public function login($p=null) {

		if (!is_array($p)) return $this->buildError("login","Incorrect username or password");
		else {

			$med = new med();
			$a = $med->cleanInput($p);
			$password = $med->hash($a["password"]);
			return $this->buildError("login","Received: $password");

			}

		}

	public function buildError($context=null,$message=null) {

		if ($context == null) $context = "global";
		global $errorArray;
		$errorArray[$context][] = $message;

		}

	private function db($sql) {

		$d = new database();

		}

	}
?>