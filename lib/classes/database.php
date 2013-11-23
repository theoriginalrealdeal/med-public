<?php
class database {

	private $db_host = 'medpub.db.5809618.hostedresource.com';
	private $db_user = 'medpub';
	private $db_pass = 'm3dp@ss3D';
	private $db_name = 'medpub';
	private $db_type = "mysql";
	private $force_char = false;
	private $db_char = "UTF-8";
	public $connected = false;
	private $connection = null;
	private $allow = false;
	function __construct() {

		$this->connect();

		}

	public function connect() {

		if ($this->connected) return true;
		$host = $this->db_host;
		$type = $this->db_type;
		$name = $this->db_name;
		$user = $this->db_user;
		$pass = $this->db_pass;
		$char = $this->db_char;
		$pdx = "$type:host=$host;dbname=$name".($this->force_char?";charset=$char":"");
		$tmp = new PDO("$pdx","$user","$pass");
		$tmp->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$tmp->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
		$this->connection = $tmp;
		$this->connected = true;
		return true;

		}

	public function exec($s) {

		if (!$this->connected) return false;
		else {

			$c = $this->connection;
			$r = $c->query($s);
			$result = $r->fetchAll(PDO::FETCH_ASSOC);
			$this->result = $result;

			}

		}

	private function errorLog($m=null) {

		if ($m == null) die("Database Error.");
		else die($m);

		}

	public function cleanse() {

		$this->result = null;

		}

	public function getResult($legacy=true) {

		$a = $this->result;
		if (!is_array($a)) return $a;
		else {

			// legacy
			if ($legacy && isset($a[0]) && !isset($a[1])) {

				$t = $a[0];
				unset($a);
				$a = $t;
				return $a;

				}

			else return $a;

			}

		}

	public function insert($table=null,$columns=null,$values=null) {

		if ($table == null || $columns == null || $values == null) return false;
		else if (!$this->connected) return false;
		else {

			$r = $this->connection;
			$str = "INSERT INTO $table ($columns) VALUES ($values);";
			$affected = $r->exec($str);
			if (is_numeric($affected) && $affected > 0) return true;
			else return false;

			}

		}

	public function select($table=null,$columns=null,$where=null,$order=null,$limit=null) {

		if ($table == null || $columns == null) return false;
		else if (!$this->connected) return false;
		else {

			$sql = "SELECT $columns FROM $table";
			if ($where != null) $sql.= " WHERE $where";
			if ($order != null) $sql.= " ORDER BY $order";
			if ($limit != null && is_numeric($limit)) $sql.= " LIMIT $limit";
			$c = $this->connection;
			$r = $c->query($sql);
			$result = $r->fetchAll(PDO::FETCH_ASSOC);
			$this->result = $result;

			}

		}

	public function update($table=null,$query=null,$where=null) {

		if ($table == null || $query == null) return false;
		else if (!$this->connected) return false;
		else {

			$sql = "UPDATE $table SET $query";
			if ($where != null) $sql.= " WHERE $where";
			$r = $this->connection;
			$affected = $r->exec($sql);
			if (is_numeric($affected) && $affected > 0) return true;
			else return false;

			}

		}

	}
?>