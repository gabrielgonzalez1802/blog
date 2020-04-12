<?php
class Conexion {
	private $dbname = "ghcu0v1h36y6lmmz";
	private $password = "f6c28sbvk8hb21uf";
	private $username = "dk5ceemguzo4vj3f";
	private $servername = "eporqep6b4b8ql12.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
	private $port = 5432;

	public function getPort() {
		return $this->port;
	}
	
	public function setPort($value) {
		$this->port = $value;
	}

	public function getServername() {
		return $this->servername;
	}
	
	public function setServername($value) {
		$this->servername = $value;
	}
	
	public function getUsername() {
		return $this->username;
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
}
?>
