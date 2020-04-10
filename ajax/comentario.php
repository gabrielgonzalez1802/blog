<?php
require_once "../config/databaseObject.php";
include "../funciones.php";
$conn = new Conex();

if($_POST["comentario"]!=""){
	$user=$_POST["usuario"];
	$coment=$_POST["comentario"];
	$blog=$_POST["blog"];
	$sql="INSERT INTO comment_blog (comment,post_blog_id,user_id) VALUES ('$coment','$blog','$user')";
	$queryInsert = $conn->getConn()->query($sql);
	if ($queryInsert) {
		$act=true;
	}else{
		$act=false;
	}
}else{
	$act=false;
}
echo $act;
?>