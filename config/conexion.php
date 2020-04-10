<?php
class Conexion {
	private $dbname = "blog";
	private $password = "";
	private $username = "root";
	private $servername = "localhost";

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