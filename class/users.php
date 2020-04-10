<?php
/**
 * @author Gabriel
 *
 */
class Users extends Conexion{
	private $servername;
	private $username;
	private $password;
	private $dbname;
	private $id;
	private $has_charge;
	private $chat_online;
	private $is_typing;
	private $last_chat_activity;
	private $role_id;
	private $pick_id;
	private $status_id;
	private $supress_id;
	private $tempSessionID;
	private $tempPassword;

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
			$sql = "SELECT * FROM users WHERE id = '$id'";
			$result = $conn->query( $sql );
			if ($result->num_rows > 0) {
				while ( $row = $result->fetch_assoc () ) {
					$this->id = $row["id"];
					$this->id_nationality = $row["id_nationality"];
					$this->username = $row["username"];
					$this->password = $row["password"];
					$this->has_charge = $row["has_charge"];
					$this->chat_online= $row["chat_online"];
					$this->is_typing= $row["is_typing"];
					$this->last_chat_activity= $row["last_chat_activity"];
					$this->role_id= $row["role_id"];
					$this->pick_id= $row["pick_id"];
					$this->status_id= $row["status_id"];
					$this->supress_id= $row["supress_id"];
					$this->tempSessionID= $row["tempSessionID"];
					$this->tempPassword= $row["tempPassword"];
				}
			}
		}
		$conn->close();
	}
	
	public function getTempPassword(){
		return $this->tempPassword;
	}
	
	public function setTempPassword($tempPassword){
		$this->tempPassword=$tempPassword;
	}
	
	public function getTempSessionID(){
		return $this->tempSessionID;
	}
	
	public function setTempSessionID($tempSessionID){
		$this->tempSessionID=$tempSessionID;
	}
	
	public function getSupress_id(){
		return $this->supress_id;
	}
	
	public function setSupress_id($supress_id){
		$this->supress_id=$supress_id;
	}
	
	public function getStatus_id(){
		return $this->status_id;
	}
	
	public function setStatus_id($status_id){
		$this->status_id=$status_id;
	}
	
	public function getPick_id(){
		return $this->pick_id;
	}
	
	public function setPick_id($pick_id){
		$this->pick_id=$pick_id;
	}
	
	public function getRole_id(){
		return $this->role_id;
	}
	
	public function setRole_id($role_id){
		$this->role_id=$role_id;
	}
	
	public function getLast_chat_activity(){
		return $this->last_chat_activity;
	}
	
	public function setLast_chat_activity($last_chat_activity){
		$this->last_chat_activity=$last_chat_activity;
	}
	
	public function getIs_typing(){
		return $this->is_typing;
	}
	
	public function setIs_typing($is_typing){
		$this->is_typing=$is_typing;
	}
	
	public function getChat_online(){
		return $this->chat_online;
	}
	
	public function setChat_online($chat_online){
		$this->chat_online=$chat_online;
	}
	
	public function getHas_charge(){
		return $this->has_charge;
	}
	
	public function setHas_charge($has_charge){
		$this->has_charge=$has_charge;
	}
	
	public function getPassword(){
		return $this->password;
	}
	
	public function setPassword($password){
		$this->password=$password;
	}
	
	public function getUsername(){
		return $this->username;
	}
	
	public function setUsername($username){
		$this->username=$username;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id=$id;
	}
	
	public function getValuePersonUser($person){
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
		
		
		$sql="SELECT user_id FROM persons WHERE id_person = $person";
		$userID = "";
		
		$result = $conn->query( $sql );
		if ($result->num_rows > 0) {
			if($row = $result->fetch_assoc()) {
				$userID = $row["user_id"];
			}
		}
		
		$conn->close();
		return $userID;
	}
	
}