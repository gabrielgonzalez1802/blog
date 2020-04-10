<?php
require_once 'conexion.php';
class Conex extends Conexion{
	private $dbname;
	private $password;
	private $username;
	private $servername;
	private $conn;

	public function getConn() {
		return $this->conn;
	}

	public function getServername() {
		return $this->servername;
	}
	public function setServername($value) {
		$this->servername = $value;
	}
	public function getUsername() {
		return $this->userName;
	}
	public function setUsername($value) {
		$this->userName = $value;
	}
	public function getPassword() {
		return $this->password;
	}
	public function setPassword($value) {
		$this->password = $value;
	}
	public function getDBname() {
		return $this->dbname;
	}
	public function setDBname($value) {
		$this->dbname = $value;
	}
	public function setPropertyName($value) {
		$this->PropertyName = $value;
	}
	public function __construct() {
		$this->servername = parent::getServername();
		$this->username = parent::getUsername();
		$this->password = parent::getPassword();
		$this->dbname = parent::getDBname();
		date_default_timezone_set('America/New_York');
		setlocale(LC_ALL,"es_ES");
		// Create connection
		$this->conn = new mysqli ($this->servername, $this->username, $this->password, $this->dbname);
		// Check connection
		if ($this->conn->connect_error) {
			die ( "La conexi&oacute;n fall&oacute;, Error: " . $this->conn->connect_error );
		}
		if (!$this->conn->set_charset("utf8")) {
			die("Error cargando el conjunto de caracteres utf8: %s\n". $conn->error);
		} else {
			//printf("Conjunto de caracteres actual: %s\n", $conn->character_set_name());
		}
		error_reporting(E_ALL ^ E_NOTICE);
	}
}
?>