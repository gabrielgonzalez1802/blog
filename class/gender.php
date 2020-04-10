<?php
/**
 * @author Gabriel
 *
 */
class Gender extends Conexion{
	private $servername;
	private $username;
	private $password;
	private $dbname;
	private $id_gender;
	private $gender_type;
	private $description_gender;
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
			$sql = "SELECT * FROM genders WHERE id_gender = '$id'";
			$result = $conn->query( $sql );
			if ($result->num_rows > 0) {
				while ( $row = $result->fetch_assoc () ) {
					$this->id_gender = $row["id_gender"];
					$this->gender_type = $row["gender_type"];
					$this->description_gender= $row["description_gender"];
					$this->supress_id= $row["supress_id"];
				}
			}
		}
		$conn->close();
	}
	
	public function getsupress_id(){
		return $this->supress_id;
	}
	
	public function setsupress_id($supress_id){
		$this->supress_id=$supress_id;
	}
	
	public function getGender_type(){
		return $this->gender_type;
	}
	
	public function setGender_type($gender_type){
		$this->gender_type=$gender_type;
	}
	
	public function getId_gender(){
		return $this->id_gender;
	}
	
	public function setId_gender($id_gender){
		$this->id_gender=$id_gender;
	}
	
	public function getDescription_gender(){
		return $this->description_gender;
	}
	
	public function setDescription_gender($description_gender){
		$this->description_gender=$description_gender;
	}
	
}