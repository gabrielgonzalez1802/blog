<?php
/**
 * @author Gabriel
 *
 */
class Patient extends Conexion{
	private $name;
	private $servername;
	private $username;
	private $password;
	private $dbname;
	private $id_patient;
	private $first_name;
	private $second_name;
	private $first_surname;
	private $second_surname;
	private $birthdate;
	private $identification_card;
	private $gender_id;
	private $country_id;
	private $state_id;
	private $direction;
	private $local_number;
	private $telephone_number;
	private $postal_code;
	private $email;
	private $blood_id;
	private $status_id;
	private $supress_id;
	private $nationality_id;

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
			$sql = "SELECT * FROM patients WHERE id_patient = $id";
			$result = $conn->query( $sql );
			if ($result->num_rows > 0) {
				if ( $row = $result->fetch_assoc () ) {
					$this->id_patient = $id;
					$this->first_name= $row["first_name"];
					$this->second_name= $row["second_name"];
					$this->first_surname= $row["first_surname"];
					$this->second_surname= $row["second_surname"];
					$this->birthdate= $row["birthdate"];
					$this->nationality_id= $row["nationality_id"];
					$this->identification_card= $row["identification_card"];
					$this->gender_id= $row["gender_id"];
					$this->country_id= $row["country_id"];
					$this->state_id= $row["state_id"];
					$this->direction= $row["direction"];
					$this->local_number= $row["local_number"];
					$this->telephone_number= $row["telephone_number"];
					$this->postal_code= $row["postal_code"];
					$this->email= $row["email"];
					$this->blood_id= $row["blood_id"];
					$this->status_id= $row["status_id"];
					$this->supress_id= $row["supress_id"];
				}
			}
		}
		$conn->close();
	}
	
	public function getNationality_id(){
		return $this->nationality_id;
	}
	
	public function setNationality_id($nationality_id){
		$this->nationality_id=$nationality_id;
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
	
	public function getBlood_id(){
		return $this->blood_id;
	}
	
	public function setBlood_id($blood_id){
		$this->blood_id=$blood_id;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function setEmail($email){
		$this->email=$email;
	}
	
	public function getPostal_code(){
		return $this->postal_code;
	}
	
	public function setPostal_code($postal_code){
		$this->postal_code=$postal_code;
	}
	
	public function getTelephone_number(){
		return $this->telephone_number;
	}
	
	public function setTelephone_number($telephone_number){
		$this->telephone_number=$telephone_number;
	}
	
	public function getLocal_number(){
		return $this->local_number;
	}
	
	public function setLocal_number($local_number){
		$this->local_number=$local_number;
	}
	
	public function getDirection(){
		return $this->direction;
	}
	
	public function setDirection($direction){
		$this->direction=$direction;
	}
	
	public function getState_id(){
		return $this->state_id;
	}
	
	public function setState_id($state_id){
		$this->state_id=$state_id;
	}
	
	public function getCountry_id(){
		return $this->country_id;
	}
	
	public function setCountry_id($country_id){
		$this->country_id=$country_id;
	}
	
	public function getGender_id(){
		return $this->gender_id;
	}
	
	public function setGender_id($gender_id){
		$this->gender_id=$gender_id;
	}
	
	public function getIdentification_card(){
		return $this->identification_card;
	}
	
	public function setIdentification_card($identification_card){
		$this->identification_card=$identification_card;
	}
	
	public function getBirthdate(){
		return $this->birthdate;
	}
	
	public function setBirthdate($birthdate){
		$this->birthdate=$birthdate;
	}
	
	public function getSecond_surname(){
		return $this->second_surname;
	}
	
	public function setSecond_surname($second_surname){
		$this->second_surname=$second_surname;
	}
	
	public function getFirst_surname(){
		return $this->first_surname;
	}
	
	public function setFirst_surname($first_surname){
		$this->first_surname=$first_surname;
	}
	
	public function getSecond_name(){
		return $this->second_name;
	}
	
	public function setSecond_name($second_name){
		$this->second_name=$second_name;
	}
	
	public function getId_patient(){
		return $this->id_patient;
	}
	
	public function setId_patient($id_patient){
		$this->id_patient=$id_patient;
	}
	
	public function getFirst_name(){
		return $this->first_name;
	}
	
	public function setFirst_name($first_name){
		$this->first_name=$first_name;
	}
}