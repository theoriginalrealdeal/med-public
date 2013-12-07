<?php
class user {

	public $uid = null;
	public $auth = false;
	public $u = array();
	private $token = null;
	private $block_ip = false;
	private $expire = 15;	// minutes until session expires
	function __construct($uid=null) {

		if (is_numeric($uid)) {

			$d = new database();
			$u = $d->query("SELECT * FROM users WHERE id = '$id'",true);
			if (is_array($u)&&count($u)>0) $this->u = $u;

			}

		}

	public function login($p=null) {

		if (!is_array($p)) {

			$this->tick("ip");
			$this->buildError("login","Incorrect username or password");
			return false;

			}

		else {

			$med = new med();
			$a = $med->cleanInput($p);
			$username = $a["username"];
			$password = $med->hash($a["password"]);
			$d = new database();
			$u = $d->query("SELECT * FROM users WHERE username = '$username'",true);
			//$u = $d->getResult();
			//$d->cleanse();
			if (isset($u["id"])) {

				$p = $d->query("SELECT * FROM passwords WHERE uid = $u[id] AND status = '1'",true);
				//$p = $d->getResult();
				//$d->cleanse();
				if ($p["password"] == $password) {

					return $this->logUserIn($u);

					}

				else {

					$this->tick("username",$username);
					$this->buildError("login","Incorrect username or password [0]");
					return false;

					}

				}

			else {

				$this->tick("ip");
				$this->buildError("login","Incorrect username or password [1]");
				return false;

				}

			}

		}

	public function logUserIn($u=null) {

		if (!is_array($u)||!isset($u["id"])||!is_numeric($u["id"])) $this->buildError("critical","Bad values passed to logUserIn(). Unable to proceed.");
		else {

			$msid = md5(session_id());
			setcookie("msid",$msid);
			$_SESSION["msid"] = $msid;
			$_SESSION["uid"] = $u["id"];
			$_SESSION["id"] = session_id();
			$now = date("Y-m-d H:i:s");
			$this->u = $u;
			$d = new database();
			//$d->update("users","sessionid = '$_SESSION[id]', sessionstamp = '$now'","id = '$u[id]'");
			$d->query("UPDATE users SET sessionid = '$_SESSION[id]', sessionstamp = '$now' WHERE id = '$u[id]'");
			$this->generateToken($u["id"]);
			return true;

			}

		}

	public function authenticate() {

		$uid = $_SESSION["uid"];
		$msid = $_SESSION["msid"];
		$csid = $_COOKIE["msid"];
		$ssid = $_SESSION["id"];
		$token = $_SESSION["public_token"];
		$now = date("Y-m-d H:i:s");
		$init = date("Y-m-d H:i:s",mktime(date("H"),(date("i")+$this->expire),date("s"),date("m"),date("d"),date("Y")));
		if (!is_numeric($uid)) {

			$this->clearUser();

			}

		else if ($msid != $csid) {

			$this->clearUser();

			}

		else if (md5($ssid) != $msid) {

			$this->clearUser();

			}

		else {

			$d = new database();
			$user = $d->query("SELECT * FROM users WHERE id = '$uid'",true);
			//$user = $d->getResult();
			if (!isset($user["id"])) $this->clearUser();
			else {

				if (strtotime($user["sessionstamp"]) > strtotime($init)) {

					$this->clearUser();

					}

				else if ($token != $user["token"]) {

					$this->clearUser();

					}

				else if ($ssid != $user["sessionid"]) {
die("ssid = $ssid db = $user[sessionid]");
					$this->clearUser();

					}

				else {

					//$d->update("users","sessionstamp = '$now'","id = '$uid'");
					$d->query("UPDATE users SET sessionstamp = '$now' WHERE id = '$uid'");
					$this->auth = true;

					}

				}

			}

		}

	public function clearUser() {

		session_unset();
		setcookie("msid","",time()-3600);
		session_regenerate_id(true);
		header("Location: index.php");

		}

	public function generateToken($uid=null) {

		if (is_numeric($uid)) {

			$token = uniqid("med");
			$d = new database();
			$d->query("UPDATE users SET token = '$token' WHERE id = '$uid'");
			//$d->update("users","token = '$token'","id = '$uid'");
			$_SESSION["public_token"] = $token;
			return true;

			}

		else return false;

		}

	public function buildError($context=null,$message=null) {

		if ($context == null) $context = "global";
		global $errorArray;
		$errorArray[$context][] = $message;
		if ($context == "critical") die($message);

		}

	private function tick($t=null,$m=null) {

		if ($t == null) return false;
		else {

			$d = new database();
			if ($t == "ip") {

				$userid = 0;

				}

			else if ($t == "username" && strlen($m) > 0) {

				$u = $d->exec("SELECT id FROM users WHERE username = '$m'");
				$userid = isset($u["id"])?$u["id"]:0;

				}

			else return false;

			$type = 1;
			$ip = ip2long($_SERVER["REMOTE_ADDR"]);
			$d->insert("userlog","user, ip, type, notes","'$userid', '$ip', '$type', 'Invalid login'");
			return true;

			}

		}

	private function db($sql) {

		$d = new database();

		}

	}
?>