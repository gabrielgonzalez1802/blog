<?php
session_start();
require_once "../../config/databaseObject.php";
include "../../funciones.php";
$conn = new Conex();
$user = 1; //para demo
//Process ADD
if ($_GET['act']=='insertCategory') {
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$category = ucfirst (test_input($_POST["category"]));
		$sql = "SELECT name FROM categories_blog WHERE name = '$category'";
		$result = $conn->getConn()->query($sql);
		if ($result->num_rows > 0) {
			if($row = $result->fetch_assoc()) {
				header("location: ../../index.php?module=listCategories&alert=4");
			}
		}else{
			$sql = "INSERT INTO categories_blog (name) VALUES('$category')";
			if ($conn->getConn()->query($sql) === TRUE) {
				header("location: ../../index.php?module=listCategories&alert=1");
			}else{
				header("location: ../../index.php?module=listCategories&alert=11");
			}
		}	
	}
}
else if ($_GET['act']=='updateCategory') {
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$category = ucfirst (test_input($_POST["category"]));
		$categoryID = $_POST["categoryID"];
		$sql = "UPDATE categories_blog SET name = '$category' WHERE id_category_blog = $categoryID";
		if ($conn->getConn()->query($sql) === TRUE) {
			header("location: ../../index.php?module=listCategories&alert=2");
		}else{
			header("location: ../../index.php?module=listCategories&alert=22");
		}
	}
}
    //Process Update
elseif ($_GET['act']=='createPost') {

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = test_input($_POST["title"]);
    $description = test_input($_POST["description"]);
    $contenido = test_input($_POST["contenido"]);
    $contenido = html_entity_decode($contenido);
    $contenido = str_replace("'", "", $contenido);
    $categorias = $_POST["categorias"];
    
    if(isset($categorias)){
    	asort($categorias);
    }
    
    $name_file          = $_FILES['foto']['name'];
    $size_file          = $_FILES['foto']['size'];
    $tipe_file          = $_FILES['foto']['type'];
    $tmp_file           = $_FILES['foto']['tmp_name'];

    $allowed_extensions = array('jpg');

    $file               = explode(".", $name_file);

    $extension           = array_pop($file);
    
    $temp = date('d-m-Y-H-i-s');
        
    $catError=0;
    
    //Si no se selecciona la imagen queda nula y guarda los demas datos
    if (empty($_FILES['foto']['name'])) {
    	
    	$sql = "INSERT INTO post_blog (title,brief_description,content,user_id) VALUES('$title','$description','$contenido','$user')";
    	if ($conn->getConn()->query($sql) === TRUE) {
    		$last_id = $conn->getConn()->insert_id;
	    	if (is_array($categorias)){
	    		foreach ($categorias as $categoria){
	    			$sql = "INSERT INTO mm_post_blog_categories (post_blog_id, categories_blog)
	    			VALUES ($last_id, $categoria)";
	    			if ($conn->getConn()->query($sql) === TRUE) {
	    				//echo "todo bien";
	    			} else {
	    				$catError++;
	    			}
	    		}
	    		if($catError==0){
	    			header("location: ../../index.php?module=viewPost&post=$last_id&alert=1");
	    		}else{
	    			header("location: ../../index.php?module=viewPost&post=$last_id&alert=99");
	    		}
	    	}else{
	    		header("location: ../../index.php?module=viewPost&post=$last_id&alert=99");
	    	}
    	}else{
    		header("location: ../../index.php?module=viewPost&post=$last_id&alert=111");
    	} 	
    }else{
        //hay foto -  verifica si la imagen tiene un formato jpg
    	$sql = "INSERT INTO post_blog (title,brief_description,content,user_id) VALUES('$title','$description','$contenido','$user')";
    	if ($conn->getConn()->query($sql) === TRUE) {
    		$last_id = $conn->getConn()->insert_id;
    		if (is_array($categorias)){
    			foreach ($categorias as $categoria){
    				$sql = "INSERT INTO mm_post_blog_categories (post_blog_id, categories_blog)
    				VALUES ($last_id, $categoria)";
    				if ($conn->getConn()->query($sql) === TRUE) {
    					//echo "todo bien";
    				} else {
    					$catError++;
    				}
    			}
    			if($catError==0){
    				$path_file          = "../../img/blog/"."Post"."_".$last_id.".".$extension;
    				if (in_array($extension, $allowed_extensions)) {
    					//verifica que la imagen pese menos de 1mb
    					if($size_file <= 9000000) {
    						//verifico si puedo mover la imagen
    						if(move_uploaded_file($tmp_file, $path_file)) {
    							//se crea el registro de la imagen
    							$sql = "INSERT INTO picks (name, pick_type, pick_size, location) VALUES ('$name_file','$extension','$size_file','$path_file')";
    							if ($conn->getConn()->query($sql) === TRUE) {
    								$pick_id = $conn->getConn()->insert_id;
    								$sql="UPDATE post_blog SET pick_id=$pick_id WHERE id_post_blog = $last_id";
    								if ($conn->getConn()->query($sql) === TRUE) {
    									header("location: ../../index.php?module=viewPost&post=$last_id&alert=1");
    								}else{
    									header("location: ../../index.php?module=viewPost&post=$last_id&alert=10");
    								}
    							}else{
    								header("location: ../../index.php?module=viewPost&post=$last_id&alert=10");
    							}
    						}else{
    							//en caso de que falle...
    							header("location: ../../index.php?module=viewPost&post=$last_id&alert=11");
    						}
    					}else {
    						//Si la imagen pesa mas de 9mb muestra el mensaje de error
    						header("location: ../../index.php?module=viewPost&post=$last_id&alert=44");
    					}
    				}else {
    					//Si la imagen no es de formato jpg muestra el mensaje de error
    					header("location: ../../index.php?module=viewPost&post=$last_id&alert=55");
    				} 
    			}else{
    				header("location: ../../index.php?module=viewPost&post=$last_id&alert=99");
    			}
    		}else{
    			header("location: ../../index.php?module=viewPost&post=$last_id&alert=99");
    		}
    	}else{
    		//en caso de que falle...
//     		echo $sql;
    		header("location: ../../index.php?module=viewPost&post=$last_id&alert=111");
    	} 
    } //Fin de seleccion de foto
  } 
}elseif ($_GET['act']=='updatePost') {
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$title=$_POST["title"];
		$description=$_POST["description"];
		$contenido=$_POST["contenido"];
		$contenido = str_replace("'", "", $contenido);
		$postID=$_POST["postID"];
		$categorias = $_POST["categorias"];
		$prominent = $_POST["prominent"];
		
		$name_file          = $_FILES['foto']['name'];
		$size_file          = $_FILES['foto']['size'];
		$tipe_file          = $_FILES['foto']['type'];
		$tmp_file           = $_FILES['foto']['tmp_name'];
		
		$allowed_extensions = array('jpg');
		
		$file               = explode(".", $name_file);
		
		$extension           = array_pop($file);
		
		$temp = date('d-m-Y-H-i-s');
		
		$path_file          = "../../img/blog/"."Post"."_".$postID.".".$extension;
		
		$catError=0;
				
		if(isset($categorias)){
			asort($categorias);
			if (is_array($categorias)){
				$sql="DELETE FROM mm_post_blog_categories WHERE post_blog_id = $postID";
				if ($conn->getConn()->query($sql) === TRUE) {
					foreach ($categorias as $categoria){
						$sql = "INSERT INTO mm_post_blog_categories (post_blog_id, categories_blog)
						VALUES ($postID, $categoria)";
						if ($conn->getConn()->query($sql) === TRUE) {
// 							echo "todo bien";
						} else {
							$catError++;
						}
					}
					if($catError==0){
						//Si no se selecciona la imagen queda nula y guarda los demas datos
						if (empty($_FILES['foto']['name'])) {
							$sql="UPDATE post_blog SET title='$title', brief_description='$description',content='$contenido',prominent='$prominent' WHERE id_post_blog = $postID";
							if ($conn->getConn()->query($sql) === TRUE) {
								header("location: ../../index.php?module=viewPost&post=$postID&alert=2");
							}
						}else{
							//hay foto -  verifica si la imagen tiene un formato jpg
							if (in_array($extension, $allowed_extensions)) {
								
								//verifica que la imagen pese menos de 1mb
								if($size_file <= 9000000) {
									//verifico si puedo mover la imagen
									if(move_uploaded_file($tmp_file, $path_file)) {										
										$sql="SELECT location FROM picks WHERE location LIKE '%Post_".$postID."%'";
										$result = $conn->getConn()->query($sql);
										
										if($row = $result->fetch_assoc()) {											
											$sql="SELECT pick_id FROM post_blog WHERE id_post_blog = $postID";
											$result2 = $conn->getConn()->query($sql);
											if($row2 = $result2->fetch_assoc()) {
												$id_pick= $row2["pick_id"];
												$sql = "UPDATE picks SET name='$name_file', pick_type='$extension', pick_size='$size_file', location='$path_file' WHERE id_pick = $id_pick";
												if ($conn->getConn()->query($sql) === TRUE) {
													//se actualiza el post
													if(isset($prominent)){
														$sql = "UPDATE post_blog SET title='$title', pick_id='$id_pick', brief_description='$description',content='$contenido',prominent='$prominent' WHERE id_post_blog = $postID";
													}else{
														$sql = "UPDATE post_blog SET title='$title', pick_id='$id_pick', brief_description='$description',content='$contenido' WHERE id_post_blog = $postID";
													}
													if ($conn->getConn()->query($sql) === TRUE) {
														header("location: ../../index.php?module=viewPost&post=$postID&alert=2");
													}else{
														//en caso de que falle...
														header("location: ../../index.php?module=viewPost&post=$postID&alert=22");
													}
												}else{
													header("location: ../../index.php?module=viewPost&post=$postID&alert=22");
												}
											}
										}else{
											//crea el registro
											$sql = "INSERT INTO picks (name, pick_type, pick_size, location) VALUES ('$name_file','$extension','$size_file','$path_file')";
											if ($conn->getConn()->query($sql) === TRUE) {
												$pick_id = $conn->getConn()->insert_id;
												//se actualiza el post
												if(isset($prominent)){
													$sql = "UPDATE post_blog SET title='$title', pick_id='$pick_id', brief_description='$description',content='$contenido',prominent='$prominent' WHERE id_post_blog = $postID";
												}else{
													$sql = "UPDATE post_blog SET title='$title', pick_id='$pick_id', brief_description='$description',content='$contenido' WHERE id_post_blog = $postID";
												}
												if ($conn->getConn()->query($sql) === TRUE) {
													header("location: ../../index.php?module=viewPost&post=$postID&alert=2");
												}else{
													//en caso de que falle...
													header("location: ../../index.php?module=viewPost&post=$postID&alert=22");
												}
											}else{
												header("location: ../../index.php?module=viewPost&post=$postID&alert=88");
											}
										}										
									}else {
										// 								//Si la imagen pesa mas de 9mb muestra el mensaje de error
										header("location: ../../index.php?module=viewPost&post=$postID&alert=44");
									}
								}else {
									//Si la imagen no es de formato JPG, *.JPEG, *.PNG muestra el mensaje de error
									header("location: ../../index.php?module=viewPost&post=$postID&alert=55");
								}
							}
						}
					}else{
						header("location: ../../index.php?module=viewPost&post=$postID&alert=22");
					}
				}else{
					header("location: ../../index.php?module=viewPost&post=$postID&alert=66");
				}
			}
		}else{
			//sin categoria
			//Si no se selecciona la imagen queda nula y guarda los demas datos
			if (empty($_FILES['foto']['name'])) {
				$sql="UPDATE post_blog SET title='$title', brief_description='$description',content='$contenido',prominent='$prominent' WHERE id_post_blog = $postID";
				if ($conn->getConn()->query($sql) === TRUE) {
					header("location: ../../index.php?module=viewPost&post=$postID&alert=2");
				}
			}else{
				//hay foto -  verifica si la imagen tiene un formato jpg
				if (in_array($extension, $allowed_extensions)) {
					
					if($size_file <= 9000000) {
						//verifico si puedo mover la imagen
						if(move_uploaded_file($tmp_file, $path_file)) {
							//se crea el registro de la imagen
							$sql="SELECT location FROM picks WHERE location LIKE '%Post_".$postID."%'";
							$result = $conn->getConn()->query($sql);
							if($row = $result->fetch_assoc()) {
								$sql="SELECT pick_id FROM post_blog WHERE id_post_blog = $postID";
								$result2 = $conn->getConn()->query($sql);
								if($row2 = $result2->fetch_assoc()) {
									$id_pick= $row2["pick_id"];
									$sql = "UPDATE picks SET name='$name_file', pick_type='$extension', pick_size='$size_file', location='$path_file' WHERE id_pick = $id_pick";
									if ($conn->getConn()->query($sql) === TRUE) {
										//se actualiza el post
										if(isset($prominent)){
											$sql = "UPDATE post_blog SET title='$title', pick_id='$id_pick', brief_description='$description',content='$contenido',prominent='$prominent' WHERE id_post_blog = $postID";
										}else{
											$sql = "UPDATE post_blog SET title='$title', pick_id='$id_pick', brief_description='$description',content='$contenido' WHERE id_post_blog = $postID";
										}
										if ($conn->getConn()->query($sql) === TRUE) {
											header("location: ../../index.php?module=viewPost&post=$postID&alert=2");
										}else{
											//en caso de que falle...
 											header("location: ../../index.php?module=viewPost&post=$postID&alert=22");
										}
									}else{
 										header("location: ../../index.php?module=viewPost&post=$postID&alert=22");
									}
								}
							}else{
								//crea el registro
								$sql = "INSERT INTO picks (name, pick_type, pick_size, location) VALUES ('$name_file','$extension','$size_file','$path_file')";
								if ($conn->getConn()->query($sql) === TRUE) {
									$pick_id = $conn->getConn()->insert_id;
									//se actualiza el post
									if(isset($prominent)){
										$sql = "UPDATE post_blog SET title='$title', pick_id='$pick_id', brief_description='$description',content='$contenido',prominent='$prominent' WHERE id_post_blog = $postID";
									}else{
										$sql = "UPDATE post_blog SET title='$title', pick_id='$pick_id', brief_description='$description',content='$contenido' WHERE id_post_blog = $postID";
									}
									if ($conn->getConn()->query($sql) === TRUE) {
										header("location: ../../index.php?module=viewPost&post=$postID&alert=2");
									}else{
										//en caso de que falle...
										header("location: ../../index.php?module=viewPost&post=$postID&alert=22");
									}
								}else{
									header("location: ../../index.php?module=viewPost&post=$postID&alert=88");
								}
							}
						}else{
							//en caso de que falle...
							header("location: ../../index.php?module=viewPost&post=$postID&alert=88");
						}
					}else {
						//Si la imagen pesa mas de 9mb muestra el mensaje de error
						header("location: ../../index.php?module=viewPost&post=$postID&alert=44");
					}
				}else {
					//Si la imagen no es de formato JPG, *.JPEG, *.PNG muestra el mensaje de error
					header("location: ../../index.php?module=viewPost&post=$postID&alert=55");
				}
			}
		}
	}
	
}elseif ($_GET['act']=='delete') {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "UPDATE categories_blog SET suppress_id = (SELECT id_supress 
    FROM suppress where is_supress = 'Y') 
    where id_category_blog = $id"; // supress_id is_supress

   if ($conn->getConn()->query($sql) === TRUE) {
   		header("location: ../../index.php?module=listCategories&alert=3");
    }else{
    	header("location: ../../index.php?module=listCategories&alert=33");
    }  
 }
}elseif ($_GET['act']=='deletePost') {
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		
		$sql="DELETE FROM mm_post_blog_categories WHERE post_blog_id = $id";
		if ($conn->getConn()->query($sql) === TRUE) {
			$sql="DELETE FROM votes WHERE post_blog_id = $id";
			if ($conn->getConn()->query($sql) === TRUE) {
				$sql="DELETE FROM post_blog WHERE id_post_blog = $id";
				if ($conn->getConn()->query($sql) === TRUE) {
					header("location: ../../index.php?module=indexBlog&alert=3");
				}else{
					header("location: ../../index.php?module=indexBlog&alert=33");
				}
			}else{
				header("location: ../../index.php?module=indexBlog&alert=33");
			}
		}else{
			header("location: ../../index.php?module=indexBlog&alert=33");		
		}
	}else{
		echo "error no se recibio el id";
	}
}else if($_GET['act']=='deleteComents'){
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
 		$sql = "DELETE FROM comment_blog WHERE id_comment_blog = $id"; // supress_id is_supress
		
//  		echo $sql;
		if ($conn->getConn()->query($sql) === TRUE) {
			header("location: ../../index.php?module=coments&alert=3");
		}else{
			header("location: ../../index.php?module=coments&alert=33");
 		}
	}
}
mysqli_close($conn->getConn()); 
?>	