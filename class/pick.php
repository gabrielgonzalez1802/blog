<?php
/**
 * @author Gabriel
 *
 */
class Pick extends Conexion{
	private $servername;
	private $username;
	private $password;
	private $dbname;
	private $id_pick;
	private $name;
	private $pick_type;
	private $pick_size;
	private $location;

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
			$sql = "SELECT * FROM picks WHERE id_pick = '$id'";
			$result = $conn->query( $sql );
			if ($result->num_rows > 0) {
				while ( $row = $result->fetch_assoc () ) {
					$this->id_pick = $row["id_pick"];
					$this->name= $row["name"];
					$this->pick_type= $row["pick_type"];
					$this->pick_size= $row["pick_size"];
					$this->location= $row["location"];
				}
			}
		}
		$conn->close();
	}
	
	public function getLocation(){
		return $this->location;
	}
	
	public function setLocation($location){
		$this->location=$location;
	}
	
	public function getPick_size(){
		return $this->pick_size;
	}
	
	public function setPick_size($pick_size){
		$this->pick_size=$pick_size;
	}
	
	public function getPick_type(){
		return $this->pick_type;
	}
	
	public function setPick_type($pick_type){
		$this->pick_type=$pick_type;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function setName($name){
		$this->name=$name;
	}
	
	public function getId_pick(){
		return $this->id_pick;
	}
	
	public function setId_pick($id_pick){
		$this->id_pick=$id_pick;
	}
	
	public function getPick(){
		$foto=$this->location;
		$strrchrPick = strrchr($foto,"/");
 		$pick = substr($strrchrPick,1);
 		return $pick;
	}
	
	public function getFullPick(){
		return "<img src='img/avatar/".$this->getPick()."'></img>";
	}
	
}