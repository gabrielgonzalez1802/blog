<?php
/**
 * @author Gabriel
 *
 */
class Category extends Conexion{
	private $servername;
	private $username;
	private $password;
	private $dbname;
	private $id_category;
	private $name_category;
	private $suppress_id;
	
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
			$sql = "SELECT * FROM categories WHERE id_category = '$id'";
			$result = $conn->query( $sql );
			if ($result->num_rows > 0) {
				while ( $row = $result->fetch_assoc () ) {
					$this->id_category = $row["id_category"];
					$this->name_category = $row["name_category"];
					$this->suppress_id= $row["suppress_id"];
				}
			}
		}
		$conn->close();
	}
	
	public function getSuppress_id(){
		return $this->suppress_id;
	}
	
	public function setSuppress_id($suppress_id){
		$this->suppress_id=$suppress_id;
	}
	
	public function getName_category(){
		return $this->name_category;
	}
	
	public function setName_category($name_category){
		$this->name_category=$name_category;
	}
	
	public function getId_category(){
		return $this->id_category;
	}
	
	public function setId_category($id_category){
		$this->id_category=$id_category;
	}
}
?>