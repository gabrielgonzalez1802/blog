<?php
/**
 * @author Gabriel
 *
 */
class Rol extends Conexion{
	private $servername;
	private $username;
	private $password;
	private $dbname;
	private $id_role;
	private $role_name;
	private $id_status;
	
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
			$sql = "SELECT * FROM roles WHERE id_role = '$id'";
			$result = $conn->query( $sql );
			if ($result->num_rows > 0) {
				while ( $row = $result->fetch_assoc () ) {
					$this->id_role = $row["id_role"];
					$this->role_name = $row["role_name"];
					$this->id_status= $row["id_status"];
				}
			}
		}
		$conn->close();
	}	
	
	public function getRole_name(){
		return $this->role_name;
	}
	
	public function setRole_name($role_name){
		$this->role_name=$role_name;
	}
	
	public function getId_status(){
		return $this->id_status;
	}
	
	public function setId_status($id_status){
		$this->id_status=$id_status;
	}
	
	public function getId_role(){
		return $this->id_role;
	}
	
	public function setId_role($id_role){
		$this->id_role=$id_role;
	}
	
	public function verifiAccessRol($module,$action){
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
		$rol = $this->id_role;
		$sql="SELECT p.* ,r.role_name, m.module FROM mm_roles_modules mm
			INNER JOIN roles r ON r.id_role = mm.rol_id
			INNER JOIN modules m ON m.id_module = mm.module_id
			INNER JOIN permissions p ON p.mm_roles_modules_id = mm.id_mm_roles_modules
			WHERE mm.rol_id = $rol AND mm.status_id = 1 AND m.module='$module' AND p.$action = 'Y'";
		$result = $conn->query( $sql );
		if ($result->num_rows > 0) {
			$r = "Y";
		}else{
			$r = "N";
		}
		$conn->close();
		return $r;
	}
	
}