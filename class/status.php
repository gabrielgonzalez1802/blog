<?php
/**
 * @author Gabriel
 *
 */
class Status extends Conexion{
	private $servername;
	private $username;
	private $password;
	private $dbname;
	private $id_status;
	private $status;
	
	public function __construct($id=null){
		$this->servername = parent::getServername();
		$this->username = parent::getUsername();
		$this->password = parent::getPassword();
		$this->dbname = parent::getDBname();
		// Create connection
		$conn = new mysqli ($this->servername, $this->username, $this->password, $this->dbname);
		// Check connection
		if ($conn->connect_error) {
			die ( "Connection failed: " . $conn->connect_error );
		}
		if (!$conn->set_charset("utf8")) {
			die("Error cargando el conjunto de caracteres utf8: %s\n". $conn->error);
		} else {
			//printf("Conjunto de caracteres actual: %s\n", $conn->character_set_name());
		}
		error_reporting(E_ALL ^ E_NOTICE);
		
		if(!is_null($id)){
			$sql = "SELECT * FROM status WHERE id_status = '$id'";
			$result = $conn->query( $sql );
			if ($result->num_rows > 0) {
				while ( $row = $result->fetch_assoc () ) {
					$this->id_status = $row["id_status"];
					$this->status = $row["status"];
				}
			}
		}
		$conn->close();
	}
	
	public function getId_status(){
		return $this->id_status;
	}
	
	public function setId_status($id_status){
		$this->id_status=$id_status;
	}
	
	public function getStatus(){
		return $this->status;
	}
	
	public function setStatus($status){
		$this->status=$status;
	}
	
}