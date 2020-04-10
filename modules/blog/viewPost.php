<?php $conn = new Conex(); ?>
<link href="css/blog.css" rel="stylesheet">
<?php 
if(isset($_GET["post"])){ ?>
	<?php 
	$postID = $_GET["post"];
	
	$sqlCat="SELECT c.id_category_blog, c.name FROM categories_blog c
					INNER JOIN suppress s ON s.id_supress = c.suppress_id
					WHERE s.is_supress = 'N'";

	$sqlPost="SELECT p.viewed, pic.id_pick, pic.location, p.content, p.title, p.brief_description,
				p.created FROM post_blog p
				INNER JOIN picks pic ON pic.id_pick = p.pick_id
				INNER JOIN suppress s ON s.id_supress = p.suppress_id
				WHERE s.is_supress = 'N' AND id_post_blog=$postID";
	
	$sqlRecentPost="SELECT p.id_post_blog ,pic.id_pick, pic.location, p.content, p.title, p.brief_description,
	p.created FROM post_blog p
	INNER JOIN picks pic ON pic.id_pick = p.pick_id
	INNER JOIN suppress s ON s.id_supress = p.suppress_id
	WHERE s.is_supress = 'N' LIMIT 5";
	
	$result = $conn->getConn()->query($sqlPost);
?>
<div class="row">
	<div id="breadcrumb" class="col-xs-12">
	<ol class="breadcrumb">
	<li><a href="?module=indexBlog"><i class="fas fa-home"></i> Inicio</a></li>
	<li><a href="?module=indexBlog">Blog</a></li>
	<li class="active">Post</li>
	</ol>
	</div>
	</div>
	<?php 
	if (empty($_GET['alert'])) {
		echo "";
	}elseif ($_GET['alert'] == 1) {
		echo "<div class='alert alert-info alert-dismissable'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
          <h4>  <i class='icon fa fa-check-circle'></i> Muy Bien!!!</h4>
          El Registro ha sido Creado Correctamente.
          </div>";
	}elseif ($_GET['alert'] == 11) {
		echo "<div class='alert alert-danger alert-dismissable'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
          <h4>  <i class='icon fa fa-times-circle'></i> Error!!!</h4>
          El Registro no pudo ser Creado, Verifique los datos ingresados e intente nuevamente.
          </div>";
	}
	elseif ($_GET['alert'] == 2) {
		echo "<div class='alert alert-info alert-dismissable'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
          <h4>  <i class='icon fa fa-check-circle'></i> Muy Bien!!!</h4>
          El Registro ha sido Modificado Correctamente.
          </div>";
	}
	elseif ($_GET['alert'] == 22) {
		echo "<div class='alert alert-danger alert-dismissable'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
          <h4>  <i class='icon fa fa-times-circle'></i> Error!!!</h4>
          El Registro no pudo ser Modificado, Verifique los datos ingresados e intente nuevamente.
          </div>";
	}elseif ($_GET['alert'] == 44) {
		echo "<div class='alert alert-danger alert-dismissable'>
			          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			          <h4>  <i class='icon fa fa-times-circle'></i> Error!</h4>
			          Solo se permiten im&aacute;genes con peso menor a 9Mb.
			          </div>";
	}elseif ($_GET['alert'] == 55) {
		echo "<div class='alert alert-danger alert-dismissable'>
				          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				          <h4>  <i class='icon fa fa-times-circle'></i> Error!</h4>
				          AsegÃºrese de que el tipo de archivo subido sea  *.jpg.
				          </div>";
	}elseif ($_GET['alert'] == 66) {
		echo "<div class='alert alert-danger alert-dismissable'>
				          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				          <h4>  <i class='icon fa fa-times-circle'></i> Error!</h4>
				          Ocurri&oacute; un error al actualizar las categor&iacute;as.
				          </div>";
	}elseif ($_GET['alert'] == 77) {
		echo "<div class='alert alert-warning alert-dismissable'>
				          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				          <h4>  <i class='icon fas fa-exclamation-triangle'></i> Advertencia!</h4>
				          No se pudo actualizar la imagen, sin embargo los dem&aacute;s datos fueron actualiados.
				          </div>";
	}elseif ($_GET['alert'] == 88) {
		echo "<div class='alert alert-danger alert-dismissable'>
				          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				          <h4>  <i class='icon fa fa-times-circle'></i> Error!</h4>
				          Ocurri&oacute; un error al intentar actualizar la imagen. No se actualiz&oacute; el registro.
				          </div>";
	}elseif ($_GET['alert'] == 99) {
		echo "<div class='alert alert-danger alert-dismissable'>
				          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				          <h4>  <i class='icon fa fa-times-circle'></i> Error!</h4>
				          Ocurri&oacute; un error al crear las categor&iacute;as.
				          </div>";
	}elseif ($_GET['alert'] == 10) {
		echo "<div class='alert alert-warning alert-dismissable'>
				          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				          <h4>  <i class='icon fas fa-exclamation-triangle'></i> Advertencia!</h4>
				          No se pudo crear la imagen, sin embargo los dem&aacute;s datos fueron creados.
				          </div>";
	}elseif ($_GET['alert'] == 11) {
		echo "<div class='alert alert-danger alert-dismissable'>
				          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				          <h4>  <i class='icon fa fa-times-circle'></i> Error!</h4>
				          Ocurri&oacute; un error al intentar crear la imagen. No se cre&oacute; el registro.
				          </div>";
	}elseif ($_GET['alert'] == 111) {
		echo "<div class='alert alert-danger alert-dismissable'>
				          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				          <h4>  <i class='icon fa fa-times-circle'></i> Error!</h4>
				          Ocurri&oacute; un error al intentar crear el post. Debe asegurarse que el texto cumpla con el formato de codificación de caracteres utf8_spanish2.
				          </div>";
	}
	?>
	<div class="contentStyle2">
			<div class="col-md-12"> 
				<br>
				<div class="row">
					<div class="col-md-12">
					<?php 	if ($result->num_rows > 0) {
								if($rowPost = $result->fetch_assoc()) {
				                	$id_pick = $rowPost["id_pick"];
				                	$location = $rowPost["location"];
				                	$id_post_blog = $rowPost["id_post_blog"];
				                	$title = $rowPost["title"];
				                	$viewed = $rowPost["viewed"];
				                	$content = $rowPost["content"];
				                	$description = $rowPost["brief_description"];
				                	$created = $rowPost["title"];
				                	$location = str_replace("JPG","jpg",$location);
				                	$strrchrPick = strrchr($location,"/");
				                	$pick = substr($strrchrPick,1);
				                	$viewed+=1;
				               if($id_pick=='0'){ ?>
				              <div style="overflow: auto" id="#fotoBlog">
								 <img id="imgBlog" src="img/blog/sinFoto.jpg" alt="<?php echo $title;?>">
							  </div>
						<?php }else{?>
							<div style="overflow: auto" id="#fotoBlog">
							 	<img id="imgBlog" src="img/blog/<?php echo $pick?>" alt="<?php echo $title;?>">
							</div>
						<?php } ?>
							<div class="content-post">
								<h2><?php echo $title; ?></h2>
							 	<?php echo $content;?>
							 	<br>
							 	<div class="pull-right">
								 <a href="?module=post&act=updatePost&id=<?php echo $postID;?>" class="btn btn-primary">Modificar</a>
								 <a href="#" onclick='confirmDelete(<?php echo $postID;?>,"modules/blog/process.php?act=deletePost&id=<?php echo $postID;?>")' class="btn btn-danger">Suprimir</a>
							 	 </div>
						  		<br>
						  <?php  $like=0;
						 		 $dislike=0;
						  		$sql="SELECT count(votes) as votes,type FROM votes WHERE post_blog_id=$postID AND type IN ('like','dislike') GROUP BY type";
								 $result =  $conn->getConn()->query($sql);
								 if(mysqli_num_rows($result)>0){
								 	while($row = mysqli_fetch_array($result)){	
								 		$type = $row["type"];
								 		$votes = $row["votes"];
								 		if($type=="like"){
								 			$like=$votes;
								 		}else if($type=="dislike"){
								 			$dislike=$votes;
								 		}
								 	}
								 }else{
								 	$like = "0";
								 	$dislike = "0";
								 }
						  ?>
							<input type="hidden" name="postID" id="postID" value="<?php echo $postID?>">
							<input type="hidden" name="userID" id="userID" value="<?php echo $userID?>">

							<ul class="lkdlk">
							    <li class="like"><a href="#" data-voto="like" title="&iexcl;ME GUSTA!"><span class="icon"></span><span class="count" id="countLike"><?php echo $like!=""?$like:"0";?></span></a></li>
							    <li class="dislike"><a href="#" data-voto="dislike" title="NO ME GUSTA"><span class="icon"></span><span class="count" id="countDesLike"><?php echo $dislike!=""?$dislike:"0";?></span></a></li>
							</ul>
							
							<div id="msjVoto"></div>
						  <form action="#">
						  	<h2>Comentarios</h2>
						  	<br>
							<?php
								$persona = new Person($_SESSION['user_id']);
								$fullName=ucfirst($persona->getFirst_name()).' '.ucfirst($persona->getFirst_surname());
							?>
						    <div class="form-group">
						      <label for="email">Email:</label>
						      <input type="email" value="test@test.com" class="form-control" id="email" name="email" disabled="disabled">
						    </div>
						    <div class="form-group">
						      <label for="pwd">Comentario:</label>
						      <textarea rows="10" cols="20" class="form-control" id="comentario"></textarea>
						    </div>
						  </form>
						<button type="submit" class="btn btn-primary pull-right" onclick="comentar('<?php echo 1;?>')">Enviar comentario</button>
						  </div>
				      <?php  }
						}else{ 
							include 'Error404Include.php'; 
						}?>	
					</div>
				</div>			
			</div>
	</div>		
</div>	
<script>
function comentar(user)
{
	var user=user;
	var coment=$("#comentario").val();
	var blogID=$("#postID").val();
	alerta("Se esta enviando su comentario!!","x");
	$.ajax({
		async:false,
	 	type: "POST", 
	 	url:"ajax/comentario.php",
		data: { usuario:user,comentario:coment,blog:blogID },
	    success:function(resp){
		    if (resp){
				$("#comentario").val("");
				alerta("Comentario enviado exitosamente!!","OK");
			}else{
				alerta("No se pudo enviar su comentario","x");
			} 
	    }
	}) 	
 }
function votar(tipo,puntaje,objeto)
{
	var blogID=$("#postID").val();
	var userID=$("#userID").val();
	$.ajax({
		async:false,
	 	type: "POST", 
	 	url:"ajax/voto.php", 
		data: { accion:"vote",tipo:tipo,blog:blogID,user:userID },
	    success:function(resp){
// 		    alert("recibi: "+resp);
		    if(resp=="-1"){
				alerta("Usted ya ha votado anteriormente en este Post!!","x");
			}else if(resp=="-2"){
				alerta("Voto alterado correctamente!!","x");
			}else if(resp>="0"){
			    if(tipo=="like"){
				    $("#countLike").html(resp);
				}else if(tipo=="dislike"){
					$("#countDesLike").html(resp);
				}
				alerta("Gracias por tu voto :)","ok");
			} 
	    }
	}) 	
 }
function alerta(mensaje,modo)
{	
	if(modo=='x'){
		$("#msjVoto").html("<div class='mensaje text-danger'>"+mensaje+"</div>");
	}else{
		$("#msjVoto").html("<div class='mensaje text-primary "+modo+"'>"+mensaje+"</div>");
	}
	$('.mensaje').fadeOut(4000, function(){ $(this).remove(); });
}
</script>
<?php } 
$conn->getConn()->close(); ?>