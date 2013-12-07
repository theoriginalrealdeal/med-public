<?php
class database {

	private $connection = null;
	public $live = false;
	public $error = null;
	private $host = "medpub.db.5809618.hostedresource.com";
	private $dbname = "medpub";
	private $user = "medpub";
	private $password = "m3dp@ss3D";
	private $force_char = false;
	private $charset = "UTF-8";
	public $errmode = null;

	function __construct() {

		$this->connect();
		if ($this->query("SELECT 1")) $this->live = true;

		}

	public function connect() {

		$host = $this->host;
		$dbname = $this->dbname;
		$user = $this->user;
		$password = $this->password;
		try {

			$db = new PDO("mysql:host=$host;dbname=$dbname".($this->force_char?";charset=".$this->charset:""),$user,$password);
			$this->connection = $db;
			//if ($this->errmode) $db->setAttribute(

			}

		catch(PDOException $e) {

			$this->error = $e;

			}

		}

	public function query($sql,$return=false,$return_type=null) {

		$q = $this->connection->prepare($sql);
		$chk = $q->execute();
		if (substr(strtolower($sql),0,6) == "select" && $return) {

			if ($return_type == null) $return_type = PDO::FETCH_ASSOC;
			$q->setFetchMode($return_type);
			return $q->fetch();

			}

		else return $chk;

		}

	public function getDrivers() {

		return PDO::getAvailableDrivers();

		}

	}
?>