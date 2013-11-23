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
			$username = $a["username"];
			$password = $med->hash($a["password"]);
			$d = new database();
			$d->exec("SELECT * FROM users WHERE username = '$username'");
			$u = $d->getResult();
			$d->cleanse();
			if (isset($u["id"])) {

				$d->exec("SELECT * FROM passwords WHERE uid = $u[id] AND status = '1'");
				$p = $d->getResult();
				$d->cleanse();
				if ($p["password"] == $password) $this->logUserIn($u);
				else $this->buildError("login","Incorrect username or password");

				}

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