<?php
/**
 * @author Gabriel
 *
 */
class Service extends Conexion{
	private $name;
	private $servername;
	private $username;
	private $password;
	private $dbname;
	private $id_service;
	private $product_code;
	private $quantity_stock;
	private $price;
	private $category_id;
	private $suppress_id;
	private $description;
	private $currency_id;

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
			$sql = "SELECT * FROM services WHERE id_service = '$id'";
			$result = $conn->query( $sql );
			if ($result->num_rows > 0) {
				while ( $row = $result->fetch_assoc () ) {
					$this->id_service = $row["id_service"];
					$this->product_code = $row["product_code"];
					$this->name= $row["name"];
					$this->quantity_stock= $row["quantity_stock"];
					$this->price= $row["price"];
					$this->category_id= $row["category_id"];
					$this->suppress_id= $row["suppress_id"];
					$this->description= $row["description"];
					$this->currency_id= $row["currency_id"];
				}
			}
		}
		$conn->close();
	}
	
	public function getCurrency_id(){
		return $this->currency_id;
	}
	
	public function setCurrency_id($currency_id){
		$this->currency_id=$currency_id;
	}
	
	public function getSuppress_id(){
		return $this->suppress_id;
	}
	
	public function setSuppress_id($suppress_id){
		$this->suppress_id=$suppress_id;
	}
	
	public function getCategory_id(){
		return $this->category_id;
	}
	
	public function setCategory_id($category_id){
		$this->category_id=$category_id;
	}
	
	public function getPrice(){
		return $this->price;
	}
	
	public function setPrice($price){
		$this->price=$price;
	}
	
	public function getQuantity_stock(){
		return $this->quantity_stock;
	}
	
	public function setQuantity_stock($quantity_stock){
		$this->quantity_stock=$quantity_stock;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function setName($name){
		$this->name=$name;
	}
	
	public function getProduct_code(){
		return $this->product_code;
	}
	
	public function setProduct_code($product_code){
		$this->product_code=$product_code;
	}
	
	public function getId_service(){
		return $this->id_service;
	}
	
	public function setId_service($id_service){
		$this->id_service=$id_service;
	}
	
	public function getDescription(){
		return $this->description;
	}
	
	public function setDescription($description){
		$this->description=$description;
	}
}