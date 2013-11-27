<?php
class user {

	public $uid = null;
	private $auth = false;
	public $u = array();
	private $token = null;
	function __construct($uid=null) {

		if (is_numeric($uid)) {

			$u = $this->db("SELECT * FROM users WHERE id = '$id'");
			if (is_array($u)&&count($u)>0) $this->u = $u;

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

			else {

				$this->buildError("login","Incorrect username or password");

				}

			}

		}

	public function logUserIn($u=null) {

		if (!is_array($u)||!isset($u["id"])||!is_numeric($u["id"])) $this->buildError("critical","Bad values passed to logUserIn(). Unable to proceed.");
		else {

			$msid = md5(session_id());
			setcookie("msid",$msid));
			$_SESSION["msid"] = $msid;
			$_SESSION["uid"] = $u["id"];
			$_SESSION["id"] = session_id();
			$this->u = $u;
			$this->generateToken($u["id"]);

			}

		}

	public function authorizeUser($uid=null) {

		$token = uniqid("MED_");
		$this->token = $token;
		$d = new database();
		$d->exec("UPDATE users SET token = '$token' WHERE id = '$uid'");

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