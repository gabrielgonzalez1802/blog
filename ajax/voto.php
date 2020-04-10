<?php
require_once "../config/databaseObject.php";
include "../funciones.php";
$conn = new Conex();

if (isset ( $_POST ["accion"] ) && $_POST ["accion"] != "") {
	$accion = $_POST ["accion"];
	
	switch ($accion) {
		case "vote" :
			{
				if (intval ( $_POST ["blog"] ) > 0) {
					$blog = intval ( $_POST ["blog"] );
					$user = intval ( $_POST ["user"] );
					
					$tipo = mysqli_real_escape_string ( $conn->getConn(), $_POST ["tipo"] ); /* Evitamos inyección */
					$querySelect = $conn->getConn()->query ( "SELECT score,votes,type FROM votes WHERE user_id='".$user."' AND post_blog_id='" . $blog."'");
					if ($row = mysqli_fetch_array($querySelect)){
						$type = $row["type"];
						if($tipo == $type){
							$query = mysqli_query($conn->getConn(), "DELETE FROM votes WHERE user_id='".$user."' and post_blog_id='" . $blog."'");
							if ($query) {
								if ($conn->getConn()->affected_rows > 0) {
									/* Voto alterado correctamente, debemos obtener nuevo valor para cambiarlo en el index */
									$querySelect = $conn->getConn()->query ( "SELECT count(votes) as votes, score FROM votes WHERE type='" . $tipo . "' and post_blog_id='" . $blog."'");
									if ($fila = $querySelect->fetch_array ()) {
										$votos =  $fila ["votes"];
									} else{
										$votos = "-3";
									}
								}else{
									$votos = "-3";
								}
							}
						}else{
							//trabajar en esta parte
							$query = mysqli_query($conn->getConn(), "DELETE FROM votes WHERE user_id='".$user."' and post_blog_id='" . $blog."'");
							if ($query) {
								if ($conn->getConn()->affected_rows > 0) {
									$queryInsert = $conn->getConn()->query ("INSERT INTO votes (post_blog_id,user_id,type,score,votes) VALUES ('" . $blog . "','" . $user . "','" . $tipo . "',1" . ",1".")" );
									if ($queryInsert) {
										/* Voto realizado correctamente, debemos obtener nuevo valor para cambiarlo en el index */
										$sqlCount = "SELECT count(votes) as votes, type FROM votes 
																					WHERE TYPE IN ('like','dislike') 
																					AND post_blog_id=$blog
																					GROUP BY TYPE
																					ORDER BY TYPE DESC";
										$votos=array();
										$querySelect = $conn->getConn()->query ($sqlCount);
										if ($fila = $querySelect->fetch_array ()) {
											$votos= $fila ["votes"];
										} else{
											$votos = "-3";
										}
									}
								}else{
									$votos = "-3";
								}
							}
						}
						echo $votos;
					}else{
// 						//No ha votado aún
						/* El registro no existe, entonces debemos crearlo */
						$queryInsert = $conn->getConn()->query ("INSERT INTO votes (post_blog_id,user_id,type,score,votes) VALUES ('" . $blog . "','" . $user . "','" . $tipo . "',1" . ",1".")" );
						if ($queryInsert) {
						/* Voto realizado correctamente, debemos obtener nuevo valor para cambiarlo en el index */
							$querySelect = $conn->getConn()->query ( "SELECT count(votes) as votes, score FROM votes WHERE type='" . $tipo . "' and post_blog_id='" . $blog."'");
							if ($fila = $querySelect->fetch_array ()) {
								$votos =  $fila ["votes"];
							} else{
								$votos = "-3";
							}		
						}else{
							$votos = "-3";
						}
						echo $votos;
					}
				}
				break;
			}
		default :
			{
				exit ();
			}
	}
}
?>