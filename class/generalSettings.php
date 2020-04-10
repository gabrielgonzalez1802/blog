<?php
/**
 * @author Gabriel
 *
 */
	class Settings extends Conexion{
		private $company_name;
		private $contact_person;
		private $address;
		private $country_id;
		private $state_id;
		private $countryName;
		private $stateName;
		private $email;
		private $phone_number;
		private $mobile_number;
		private $fax;
		private $website_url;
		private $title;
		private $favicon;
		private $appointment_minutes;
		private $postal_code;
		private $servername;
		private $username;
		private $password;
		private $dbname;
		private $telephonePrefix;
		private $invoiceTax;
		private $currency_id;
		private $invoice_prefix;
		private $invoice_color;
		private $invoice_auto_increment;
		private $invoice_suffix;
		private $invoice_foot;
		private $rif;
		private $style;
		private $nameStyle;
		private $titleHeader;
		private $email_transfer_protocol;
		private $email_from_address;
		private $email_from_name;
		private $email_smtp_host;
		private $email_smtp_user;
		private $email_smtp_password;
		private $email_smtp_port;
		private $email_smtp_security;
		private $email_smtp_domain;
		private $email_smtp_debug;

		public function __construct($id=null){
			$this->servername = parent::getServername();
			$this->username = parent::getUsername();
			$this->password = parent::getPassword();
			$this->dbname = parent::getDBname();
			// Create connection
			$conn = new mysqli ($this->servername, $this->username, $this->password, $this->dbname);
			// Check connection
			if ($conn->connect_error) {
				die ( "La conexi&oacute;n fall&oacute;, Error: " . $conn->connect_error );
			}
			if (!$conn->set_charset("utf8")) {
				die("Error cargando el conjunto de caracteres utf8: %s\n". $conn->error);
			} else {
				//printf("Conjunto de caracteres actual: %s\n", $conn->character_set_name());
			}
			error_reporting(E_ALL ^ E_NOTICE);
			
				$sql = "SELECT st.name_state, c.telephone_prefix, c.country_name, gs.* FROM general_settings gs
						INNER JOIN countries c ON c.id_country = gs.country_id
						INNER JOIN states st ON st.id_state = gs.state_id";
				$result = $conn->query( $sql );
				if ($result->num_rows > 0) {
					while ( $row = $result->fetch_assoc () ) {
						$this->address = $row["address"];
						$this->appointment_minutes= $row["appointment_minutes"];
						$this->company_name= $row["company_name"];
						$this->contact_person= $row["contact_person"];
						$this->country_id= $row["country_id"];
						$this->state_id= $row["state_id"];
						$this->dbname= $row["dbname"];
						$this->postal_code = $row["postal_code"];
						$this->email= $row["email"];
						$this->favicon= $row["favicon"];
						$this->fax= $row["fax"];
						$this->rif= $row["rif"];
						$this->invoice_auto_increment= $row["invoice_auto_increment"];
						$this->invoice_prefix= $row["invoice_prefix"];
						$this->invoice_suffix= $row["invoice_suffix"];
						$this->invoice_foot= $row["invoice_foot"];
						$this->invoice_color= $row["invoice_color"];
						$this->mobile_number= $row["mobile_number"];
						$this->password= $row["password"];
						$this->phone_number= $row["phone_number"];
						$this->servername= $row["servername"];
						$this->title= $row["title"];
						$this->invoiceTax = $row["invoiceTax"];
						$this->username= $row["username"];
						$this->website_url= $row["website_url"];
						$this->countryName= $row["country_name"];
						$this->stateName= $row["name_state"];
						$this->telephonePrefix= $row["telephone_prefix"];
						$this->currency_id = $row["currency_id"];
						$this->style = $row["style"];
						$this->titleHeader = $row["titleHeader"];
						$this->email_transfer_protocol = $row["email_transfer_protocol"];
						$this->email_from_address = $row["email_from_address"];
						$this->email_from_name = $row["email_from_name"];
						$this->email_smtp_host = $row["email_smtp_host"];
						$this->email_smtp_user = $row["email_smtp_user"];
						$this->email_smtp_password = $row["email_smtp_password"];
						$this->email_smtp_port = $row["email_smtp_port"];
						$this->email_smtp_security = $row["email_smtp_security"];
						$this->email_smtp_domain = $row["email_smtp_domain"];
						$this->email_smtp_debug = $row["email_smtp_debug"];
						$this->host = $row["host"];
					}
				}
				$conn->close();
		}
		
		public function getNameStyle(){
			switch ($this->style) {
				case 1:
				    return "Devoops";
				break;
				case 2:
					return "Zebra";
				break;
				case 3:
					return "Selva";
				break;
				case 4:
					return "Mar";
				break;
			}
		}
		
		public function getHost(){
			return $this->host;
		}
		
		public function setHost($host){
			$this->host=$host;
		}
		
		public function getEmail_smtp_debug(){
			return $this->email_smtp_debug;
		}
		
		public function setEmail_smtp_debug($email_smtp_debug){
			$this->email_smtp_debug=$email_smtp_debug;
		}
		
		public function getEmail_smtp_domain(){
			return $this->email_smtp_domain;
		}
		
		public function setEmail_smtp_domain($email_smtp_domain){
			$this->email_smtp_domain=$email_smtp_domain;
		}
		
		public function getEmail_smtp_security(){
			return $this->email_smtp_security;
		}
		
		public function setEmail_smtp_security($email_smtp_security){
			$this->email_smtp_security=$email_smtp_security;
		}
		
		public function getEmail_smtp_port(){
			return $this->email_smtp_port;
		}
		
		public function setEmail_smtp_port($email_smtp_port){
			$this->email_smtp_port=$email_smtp_port;
		}
		
		public function getEmail_smtp_password(){
			return $this->email_smtp_password;
		}
		
		public function setEmail_smtp_password($email_smtp_password){
			$this->email_smtp_password=$email_smtp_password;
		}
		
		public function getEmail_smtp_user(){
			return $this->email_smtp_user;
		}
		
		public function setEmail_smtp_user($email_smtp_user){
			$this->email_smtp_user=$email_smtp_user;
		}
		
		public function getEmail_smtp_host(){
			return $this->email_smtp_host;
		}
		
		public function setEmail_smtp_host($email_smtp_host){
			$this->email_smtp_host=$email_smtp_host;
		}
		
		
		public function getEmail_from_name(){
			return $this->email_from_name;
		}
		
		public function setEmail_from_name($email_from_name){
			$this->email_from_name=$email_from_name;
		}
		
		public function getEmail_from_address(){
			return $this->email_from_address;
		}
		
		public function setEmail_from_address($email_from_address){
			$this->email_from_address=$email_from_address;
		}
		
		public function getEmail_transfer_protocol(){
			return $this->email_transfer_protocol;
		}
		
		public function setEmail_transfer_protocol($email_transfer_protocol){
			$this->email_transfer_protocol=$email_transfer_protocol;
		}
		
		public function getStyle(){
			return $this->style;
		}
		
		public function setStyle($style){
			$this->style=$style;
		}
		
		public function getInvoice_foot(){
			return $this->invoice_foot;
		}
		
		public function setInvoice_foot($invoice_foot){
			$this->invoice_foot=$invoice_foot;
		}
		
		public function getInvoice_suffix(){
			return $this->invoice_suffix;
		}
		
		public function setInvoice_suffix($invoice_suffix){
			$this->invoice_suffix=$invoice_suffix;
		}
		
		public function getInvoice_auto_increment(){
			return $this->invoice_auto_increment;
		}
		
		public function setInvoice_auto_increment($invoice_auto_increment){
			$this->invoice_auto_increment=$invoice_auto_increment;
		}
		
		public function getInvoice_color(){
			return $this->invoice_color;
		}
		
		public function setInvoice_color($invoice_color){
			$this->invoice_color=$invoice_color;
		}
		
		public function getCurrency_id(){
			return $this->currency_id;
		}
		
		public function setCurrency_id($currency_id){
			$this->currency_id=$currency_id;
		}
		
		public function getState_id(){
			return $this->state_id;
		}
		
		public function setState_id($state_id){
			$this->state_id=$state_id;
		}
		
		public function getPostal_code(){
			return $this->postal_code;
		}
		
		public function setPostal_code($postalCode){
			$this->postal_code=$postalCode;
		}
		
		public function getTelephonePrefix(){
			return $this->telephonePrefix;
		}
		
		public function setTelephonePrefix($telephonePrefix){
			$this->telephonePrefix=$telephonePrefix;
		}
		
		public function getStateName(){
			return $this->stateName;
		}
		
		public function setStateName($stateName){
			$this->stateName=$stateName;
		}
		
		public function getCountryName(){
			return $this->countryName;
		}
		
		public function setCountryName($countryName){
			$this->countryName=$countryName;
		}
		
		public function getAppointments_minutes(){
			return $this->appointment_minutes;
		}
		
		public function setAppoinments_minutes($appointments_minutes){
			$this->appointment_minutes=$appointments_minutes;
		}
		
		public function getInvoice_prefix(){
			return $this->invoice_prefix;
		}
		
		public function setInvoice_prefix($invoice_prefix){
			$this->invoice_prefix=$invoice_prefix;
		}
		
		public function getFavicon(){
			return $this->favicon;
		}
		
		public function setFavicon($favicon){
			$this->favicon=$favicon;
		}
		
		public function getTitle(){
			return $this->title;
		}
		
		public function setTitle($title){
			$this->title=$title;
		}
		
		public function getWebsite_url(){
			return $this->website_url;
		}
		
		public function setWebsite_url($website_url){
			$this->website_url=$website_url;
		}
		
		public function getFax(){
			return $this->fax;
		}
		
		public function setFax($fax){
			$this->fax=$fax;
		}
		
		public function getMobile_number(){
			return $this->mobile_number;
		}
		
		public function setMobile_number($mobile_number){
			$this->mobile_number=$mobile_number;
		}
		
		public function getPhone_number(){
			return $this->phone_number;
		}
		
		public function setPhone_number($phone_number){
			$this->phone_number=$phone_number;
		}
		
		public function getEmail(){
			return $this->email;
		}
		
		public function setEmail($email){
			$this->email=$email;
		}
		
		public function getCountry_id(){
			return $this->country_id;
		}
		
		public function setCountry_id($country_id){
			$this->country_id=$country_id;
		}
		
		public function getAddress(){
			return $this->address;
		}
		
		public function setAddress($address){
			$this->address=$address;
		}
		
		public function getContact_person(){
			return $this->contact_person;
		}
		
		public function setContact_person($contact_person){
			$this->contact_person=$contact_person;
		}
		
		public function getCompany_name(){
			return $this->company_name;
		}
		
		public function setCompany_name($company_name){
			$this->company_name=$company_name;
		}
		
		public function getInvoiceTax(){
			return $this->invoiceTax;
		}
		
		public function setInvoiceTax($invoiceTax){
			$this->invoiceTax=$invoiceTax;
		}
		
		public function getRif(){
			return $this->rif;
		}
		
		public function setRif($rif){
			$this->rif=$rif;
		}
		
		public function getTitleHeader(){
			return $this->titleHeader;
		}
		
		public function setTitleHeader($titleHeader){
			$this->titleHeader=$titleHeader;
		}
	}
?>