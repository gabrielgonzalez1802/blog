<?php
/**
 * @author Gabriel
 *
 */
class Speciality extends Conexion{
	private $servername;
	private $username;
	private $password;
	private $dbname;
	private $id_specialization;
	private $speciality;
	private $rol_id;
	private $supress_id;

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
			$sql = "SELECT * FROM specializations WHERE id_specialization = '$id'";
			$result = $conn->query( $sql );
			if ($result->num_rows > 0) {
				while ( $row = $result->fetch_assoc () ) {
					$this->id_specialization = $row["id_specialization"];
					$this->speciality = $row["speciality"];
					$this->rol_id= $row["rol_id"];
					$this->supress_id= $row["supress_id"];
				}
			}
		}
		$conn->close();
	}
	
	public function getSupress_id(){
		return $this->supress_id;
	}
	
	public function setSupress_id($supress_id){
		$this->supress_id=$supress_id;
	}
	
	public function getRol_id(){
		return $this->rol_id;
	}
	
	public function setRol_id($rol_id){
		$this->rol_id=$rol_id;
	}
	
	public function getSpeciality(){
		return $this->speciality;
	}
	
	public function setSpeciality($speciality){
		$this->speciality=$speciality;
	}
	
	public function getId_specialization(){
		return $this->id_specialization;
	}
	
	public function setId_specialization($id_specialization){
		$this->id_specialization=$id_specialization;
	}
}
?>