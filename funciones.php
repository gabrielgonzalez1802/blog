<?php
//Devuelve el dato purificado
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function depureSpecialText($text){
	$text = test_input($text);
	$text = html_entity_decode($text);
	$text = str_replace("'", "", $text);
	return $text;
}

function generateTempPassword(){
	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
	$passwordTemp = substr(str_shuffle($permitted_chars), 0, 10);
	return $passwordTemp;
}

function encrypt($string, $key) {
	$result = '';
	for($i=0; $i<strlen($string); $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)+ord($keychar));
		$result.=$char;
	}
	return base64_encode($result);
}

function decrypt($string, $key) {
	$result = '';
	$string = base64_decode($string);
	for($i=0; $i<strlen($string); $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)-ord($keychar));
		$result.=$char;
	}
	return $result;
}

/**
 * Busca los empleados con especialidades
 * @param  $id
 * @return string
 */
function findEmployeWhitSpecializations($id){
	$sql = "SELECT * FROM mm_users_specializations mm 
	INNER JOIN specializations sp ON sp.id_specialization = mm.specialization_id
	INNER JOIN users us ON us.id = mm.user_id
	INNER JOIN persons p ON p.user_id = mm.user_id
	WHERE p.id_person = $id";
	
	return $sql;
}

/**
 * Retorna el detalle del empleado con de su/s especialidad/es
 * @param $id 
 */
function detailEmployeeWhitSpeciality($id){
	$sql = "SELECT c.telephone_prefix,es.name_state,pick.location,r.role_name,b.blood_type,st.status,c.country_name, GROUP_CONCAT(sp.speciality) AS 'especialidad-es', g.gender_type, p.* FROM persons p 
			INNER JOIN mm_users_specializations mm ON mm.user_id = p.user_id
			INNER JOIN specializations sp ON sp.id_specialization = mm.specialization_id
			INNER JOIN users us ON us.id = p.user_id
			INNER JOIN roles r ON r.id_role = us.role_id
			INNER JOIN suppress s ON p.supress_id = s.id_supress
			INNER JOIN genders g ON g.id_gender = p.gender_id
			INNER JOIN countries c ON c.id_country = p.country_id
			INNER JOIN bloods b ON b.id_blood = p.blood_id
			INNER JOIN picks pick ON pick.id_pick = p.pick_id
			INNER JOIN status st ON st.id_status = us.status_id
			INNER JOIN states es ON es.id_state = p.state_id 
			WHERE p.id_person = $id AND s.is_supress = 'N'
			GROUP BY p.id_person, p.first_name";
	
	return $sql;	
}

/**
 * Detalle del empleado distinto a doctor
 * @return string
 */
function detailEmployee($id){
	$sql = "SELECT c.telephone_prefix,es.name_state,pick.location,r.role_name,b.blood_type,st.status,c.country_name, g.gender_type, p.* FROM persons p
	INNER JOIN users us ON us.id = p.user_id
	INNER JOIN roles r ON r.id_role = us.role_id
	INNER JOIN suppress s ON p.supress_id = s.id_supress
	INNER JOIN genders g ON g.id_gender = p.gender_id
	INNER JOIN countries c ON c.id_country = p.country_id
	INNER JOIN bloods b ON b.id_blood = p.blood_id
	INNER JOIN picks pick ON pick.id_pick = us.pick_id
	INNER JOIN status st ON st.id_status = us.status_id
	INNER JOIN states es ON es.id_state = p.state_id 
	WHERE p.id_person = $id AND s.is_supress = 'N'
	GROUP BY p.id_person, p.first_name";
	
	return $sql;
}

/**
 * Lista de doctores
 * @return string
 */
function listDoctors(){
	$sql = "SELECT st.status,c.country_name,pc.location, p.id_person as doctor,
        p.first_name as 'primer_nombre',
        p.first_surname as 'first_surname',
        GROUP_CONCAT(sp.speciality) as 'especialidad-es' FROM mm_users_specializations mm 
		INNER JOIN users u ON mm.user_id = u.id
		INNER JOIN persons p ON p.user_id = u.id
		INNER JOIN roles r ON r.id_role = u.role_id
		INNER JOIN specializations sp ON mm.specialization_id = sp.id_specialization
		INNER JOIN countries c ON c.id_country = p.country_id
		INNER JOIN suppress s ON s.id_supress = (p.supress_id=(SELECT id_supress FROM suppress WHERE is_supress = 'N') AND u.supress_id=(SELECT id_supress FROM suppress WHERE is_supress = 'N'))
		INNER JOIN status st ON st.id_status = u.status_id
		INNER JOIN picks pc ON pc.id_pick IN (u.pick_id,p.pick_id)
		WHERE upper(r.role_name) = upper('doctor')
		AND s.is_supress = 'N'
		GROUP BY p.id_person, p.first_name
		ORDER BY st.id_status,p.first_name";
	
	return $sql;
}

function totalPatientSexForMonth(){
	$sql="SELECT COUNT(g.gender_type) AS total , 
COUNT((SELECT g.gender_type FROM genders g 
	INNER JOIN patients pat ON g.id_gender = pat.gender_id
	INNER JOIN appointments ap ON ap.patient_id = pat.id_patient
	INNER JOIN status sta ON sta.id_status = ap.status_id
	INNER JOIN suppress sup ON sup.id_supress = ap.supress_id 
	WHERE ap.DATE >= date_sub(NOW(), INTERVAL 30 DAY) AND ap.date <= NOW()
   AND sup.is_supress = 'N' AND sta.status = 'Completo' AND ap.id_appointment = a.id_appointment
	AND g.gender_type = 'F')) AS F , 
	COUNT((SELECT g.gender_type FROM genders g 
	INNER JOIN patients pat ON g.id_gender = pat.gender_id
	INNER JOIN appointments ap ON ap.patient_id = pat.id_patient
	INNER JOIN status sta ON sta.id_status = ap.status_id
	INNER JOIN suppress sup ON sup.id_supress = ap.supress_id 
	WHERE ap.DATE >= date_sub(NOW(), INTERVAL 30 DAY) AND ap.date <= NOW()
   AND sup.is_supress = 'N' AND sta.status = 'Completo' AND ap.id_appointment = a.id_appointment
	AND g.gender_type = 'M')) AS M, 
DATE_FORMAT(a.DATE,'%d/%m/%Y') AS fecha FROM  appointments a 
	INNER JOIN suppress s ON s.id_supress = a.supress_id
	INNER JOIN status st ON st.id_status = a.status_id
	INNER JOIN specializations sp ON sp.id_specialization = a.specialization_id
	INNER JOIN patients pat ON pat.id_patient = a.patient_id
	INNER JOIN genders g ON g.id_gender = pat.gender_id
	WHERE s.is_supress = 'N'
	AND st.status = 'Completo' 
	AND a.date >= date_sub(NOW(), INTERVAL 30 DAY) AND a.date <= NOW() AND s.is_supress = 'N' 
	GROUP BY a.date
	ORDER BY a.date";
	
	return $sql;
}

/**
 * Formatea la fecha para que se setee en la base de datos o la muestre al usuario
 * @param date fecha 
 * @param string true if vista usuario
 * @return $fecha fecha formateada
 */
function formatDate($date,$dia=false){
	$newJoin = strtr($date, '/', '-');
	if(!$dia){
		$fecha=date('Y-m-d', strtotime($newJoin));
	}else if($dia='/'){
		$fecha=date('d/m/Y', strtotime($newJoin));	
	}else{
		$fecha=date('d-m-Y', strtotime($newJoin));	
	}
	return $fecha;
}

function formatTime($time,$form=true){
	if($form){
		$hora=substr($time,0,2);
		$minuto=substr($time,3,2);
		$model='AM';
		if($hora>12){
			switch ($hora) {
				case 13:
					$hora ='01';
					break;
				case 14:
					$hora = '02';
					break;
				case 15:
					$hora = '03';
					break;
				case 16:
					$hora = '04';
					break;
				case 17:
					$hora = '05';
					break;
				case 18:
					$hora = '06';
					break;
				case 19:
					$hora = '07';
					break;
				case 20:
					$hora = '08';
					break;
				case 21:
					$hora = '09';
					break;
				case 22:
					$hora = '10';
					break;
				case 23:
					$hora = '11';
					break;
				case 24:
					$hora = '12';
					break;
			}
			$model='PM';
		}
		return $hora.':'.$minuto.' '.$model;
	}else{
		$hora=substr($time,0,5);
		return $hora;
	}
}

function extractTime($time,$model){
	if($model=='min'){
		$min=substr($time,3,4);
		return $min;
	}else{
		$hora=substr($time,0,2);
		return $hora;
	}
}

/**
 * Extiende el tiempo de la sesion
 */
function extendTime($min){
	$_SESSION['expire'] += ($min * 60) ;
}

function calcularEdad( $fecha ) {
	list($Y,$m,$d) = explode("-",$fecha);
	return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}

function validateMinAppointment($h,$min,$validate){
	$valor=$min-$validate; //0
	if($valor<0){
		$h-=1;
		if($valor+60==0){
			$min='00';
		}else{
			$min = $valor+60;
		}
		return $h.":".$min.":00";
	}elseif($valor==0){
		return $h.":".$valor."0:00";
	}else{
		return $h.":".$valor.":00";
	}
}

function formatDateTime($dateTime,$val=null){
	//2019-05-18 10:30:00
	//20-05-2019
	if($val==null){
		$date= substr($dateTime,0,10);
		$date = formatDate($date,'/');
		$time = substr($dateTime,11,18);
		$time = formatTime($time);
		return $date.' '.$time;
	}else if($val=='fecha'){
		$date= substr($dateTime,0,10);
		$date = formatDate($date,'/');
		return $date;
	}else if($val=='fechaDB'){
		$date= substr($dateTime,0,10);
		$date = formatDate($date);
		return $date;
	}else if($val=='hora'){
		$time = substr($dateTime,11,5);
		return $time;
	}else if($val=='Y'){
		$time = substr($dateTime,6,10);
		return $time;
	}else if($val=='m'){
		$time = substr($dateTime,3,2);
		return $time;
	}else if($val=='d'){
		$time = substr($dateTime,0,2);
		return $time;
	}else{
		return "error";
	}
}

function addDate($date,$mas){
	$fecha = formatDate($date,'/');
	$mes = substr($fecha,3,2);
	$dia= substr($fecha,0,2);
	$agno= substr($fecha,6,5);
	if(esBisiesto($agno)){
		$febrero="29";
	}else{
		$febrero="28";
	}
	$meses = array(
		1 => "31",
		2 => "$febrero",
		3 => "31",
		4 => "30",
		5 => "31",
		6 => "30",
		7 => "31",
		8 => "31",	
		9 => "30",
		10 => "31",
		11 => "30",
		12 => "31"
	);
	for($i=1; $i<=12; $i++){
		if($i == $mes){
			if($mes == '12'){
				if($dia < $meses[12]){
					$dia++;
					if(strlen($dia)==1){
						$dia='0'.$dia;
					}
				}else{
					$dia='01';
					$mes='01';
					$agno++;
				}
			}else if($mes == '02' || $mes == '2'){
				if($dia < $meses[2]){
					$dia++;
					if(strlen($dia)==1){
						$dia='0'.$dia;
					}
				}else{
					$dia='01';
					$mes=='03';
				}
			}else if($mes<'12'){
				if($dia < $meses[$i]){
					$dia++;
					if(strlen($dia)<2){
						$dia='0'.$dia;
					}
				}else{
					$dia='00';
					$mes++;
					if(strlen($mes)==1){
						$mes='0'.$mes;
					}
				}
			}
		}
	}
	
// 	echo 'Fecha inicial: '.$tempDia.'/'.$tempMes.'/'.$agno.' - Nueva fecha: '.$dia.'/'.$mes.'/'.$agno.'<br>';
	return $agno.'-'.$mes.'-'.$dia;
}

function esBisiesto($year=NULL) {
	return checkdate(2, 29, ($year==NULL)? date('Y'):$year);
}

?>