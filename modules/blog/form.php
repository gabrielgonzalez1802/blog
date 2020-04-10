<?php include_once 'class/rol.php';
include_once 'class/users.php';
$conn = new Conex();
if(isset($_GET["form"])=='addPost'){ ?>
 	<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<ol class="breadcrumb">
			<li><a href="?module=indexBlog"><i class="fas fa-home"></i> Inicio</a></li>
			<li><a href="?module=indexBlog">Blog</a></li>
			<li class="active">Crear entrada</li>
		</ol>
	</div>
</div>
<?php if($_GET['form']=='addPost'){ ?>
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box box-info">
			<!-- Alertas -->
			<!--/.Alertas -->
			<div class="box-header">
				<div class="box-icons">
					<a class="expand-link">
						<i class="fas fa-external-link-alt"></i>
					</a>
				</div>
			</div>
			<div class="box-content">
				<h4 class="page-header">Crear Entrada</h4>
 				<form id="addBlog" name="addBlog" class="form-horizontal registerForm" enctype="multipart/form-data" action="modules/blog/process.php?act=createPost" method="POST">
 					<!-- box-body -->
 					<div class="row col-sm-12 col-sm-offset-1">
	 					<div class="form-group col-sm-11">
	 						<label for="" class="control-label">T&iacute;tulo</label>
	
	 						<div class="" id="">
	 							<input type="text" name="title" class="form-control" id="title" placeholder="T&iacute;tulo" autocomplete="off">
	 						</div>
	 					</div>
 					</div>
 					
 					<div class="row col-sm-12 col-sm-offset-1">
	 					<div class="form-group col-sm-11">
	 						<label for="" class="control-label">Descripci&oacute;n breve</label>
	
	 						<div class="" id="">
	 							<input type="text" name="description" class="form-control" id="description" placeholder="Descripci&oacute;n breve" autocomplete="off">
	 						</div>
	 					</div>
 					</div>
 					
 					<div class="row col-sm-12 col-sm-offset-1">
	 					<div class="form-group col-sm-11">
	 						<label for="" class="control-label">Contenido</label>
	
	 						<div class="" id="">
								<textarea class="form-control" rows="5" id="wysiwig_simple" name="contenido"></textarea>
	 						</div>
	 					</div>
 					</div>
 					
 					<div class="row col-sm-12 col-sm-offset-1">
	 					<div class="form-group col-sm-11">
 						   <label class="control-label">Foto</label>

 							<div class="">
 								<input type="file" name="foto" class="form-control" id="imagen">
 							</div>
 						</div>
 					</div>
 					
 					<div class="row col-sm-12 col-sm-offset-1">

	 					<div class="form-group col-sm-11" id="divCat">
	 						<label for="" class="control-label">Categor&iacute;a/s</label>
							<?php $sql="SELECT cb.id_category_blog, cb.name FROM categories_blog cb
										INNER JOIN suppress s ON s.id_supress = cb.suppress_id
										WHERE s.is_supress = 'N'"; 
							$result = $conn->getConn()->query($sql);
							?>
	 						<select id="multiCategory" multiple="multiple" name="categorias[]" class="populate placeholder" lang="es" onchange="verifyCat()">
	 							<?php 
	 							if ($result->num_rows > 0) {
	 								while ( $row = $result->fetch_assoc () ) {
	 										$categoryID = $row["id_category_blog"];
	 										$name = $row["name"];
	 									?>
	 						<option value="<?php echo $categoryID; ?>"><?php echo $name;?></option>			
	 					  <?php	    }
	 							}
	 							?>
	 						</select>
	 						<span id="alertCat"></span>
	 					</div>
 					</div>
 					
 					<div class="form-group">
	 					<div class="col-sm-11">
	 						<button type="submit" onclick="verifyCat()" id="btnAdd" class="btn btn-primary pull-right">Crear entrada</button>
	 					</div>
	 				</div>
 					
 				</form>
			</div>
	</div>
  </div>
</div>
 <?php  }else{
 	echo "<style>@media only screen and (max-width: 2500px) {
	  .resp {
	    height:600px;
	  }
	@media only screen and (max-width: 600px) {
	  .resp {
	    height:300px;
	  }
	}</style>";
 	echo "<div class='alert alert-warning alert-dismissable'>
	          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	          <h4>  <i class='icon fas fa-exclamation-triangle'></i> Advertencia!!!</h4>
	          Usted no tiene permiso para acceder a este m&oacute;dulo.
	          </div>";
 	echo "<div class='col col-md-12'>
				<div>
				<img class='resp' src='img/stop.jpg' alt='Alto!!'>
				</div>
			</div>";
 	}
}else if($_GET["act"]=='createCategory'){
	?>
 	<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<ol class="breadcrumb">
			<li><a href="?module=indexBlog"><i class="fas fa-home"></i> Inicio</a></li>
			<li><a href="?module=listCategories">Categor&iacute;as</a></li>
			<li class="active">Crear categor&iacute;a</li>
		</ol>
	</div>
</div>
<?php if($_GET['act']=='createCategory'){ ?>
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box box-info">
			<!-- Alertas -->
			<!--/.Alertas -->
			<div class="box-header">
				<div class="box-icons">
					<a class="expand-link">
						<i class="fas fa-external-link-alt"></i>
					</a>
				</div>
			</div>
			<div class="box-content">
				<h4 class="page-header">Crear categor&iacute;a</h4>
 				<form id="addCategoryBlog" name="addCategoryBlog" class="form-horizontal registerForm" action="modules/blog/process.php?act=insertCategory" method="POST">
 					<!-- box-body -->
 					
 					<div class="form-group has-feedback" id="check-blood">
 						<label for="inputNombre" class="col-sm-2 control-label">Categor&iacute;a</label>						
 						<div class="col-sm-6">
 							<input type="text" name="category" class="form-control" value="" required="required" placeholder="Categor&iacute;a" autocomplete="OFF" onKeyDown="">
 						</div>
 					</div>	

 					<div class="form-group">
	 					<div class="col-sm-8">
	 						<button type="submit" class="btn btn-primary pull-right">Crear categor&iacute;a</button>
	 					</div>
	 				</div>
 					
 				</form>
			</div>
	</div>
  </div>
</div>
<?php }else{
 	echo "<style>@media only screen and (max-width: 2500px) {
	  .resp {
	    height:600px;
	  }
	@media only screen and (max-width: 600px) {
	  .resp {
	    height:300px;
	  }
	}</style>";
 	echo "<div class='alert alert-warning alert-dismissable'>
	          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	          <h4>  <i class='icon fas fa-exclamation-triangle'></i> Advertencia!!!</h4>
	          Usted no tiene permiso para acceder a este m&oacute;dulo.
	          </div>";
 	echo "<div class='col col-md-12'>
				<div>
				<img class='resp' src='img/stop.jpg' alt='Alto!!'>
				</div>
			</div>";
 	}
}else if($_GET["act"]=='updateCategory'){
		$categoryID = $_GET["id"];
		$sql = "SELECT name FROM categories_blog WHERE id_category_blog = $categoryID";
		$result = $conn->getConn()->query($sql);
		
		if ($result->num_rows > 0) {
			if($row = $result->fetch_assoc()) {
				$category = $row["name"];
			}
	?>
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
		<ol class="breadcrumb">
			<li><a href="?module=indexBlog"><i class="fas fa-home"></i> Inicio</a></li>
			<li><a href="?module=listCategories">Categor&iacute;as</a></li>
			<li class="active">Actualiar categor&iacute;a</li>
		</ol>
	</div>
</div>
<?php if($_GET['act']=='updateCategory'){ ?>
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box box-info">
			<!-- Alertas -->
			<!--/.Alertas -->
			<div class="box-header">
				<div class="box-icons">
					<a class="expand-link">
						<i class="fas fa-external-link-alt"></i>
					</a>
				</div>
			</div>
			<div class="box-content">
				<h4 class="page-header">Actualizar categor&iacute;a</h4>
 				<form id="addCategoryBlog" name="addCategoryBlog" class="form-horizontal registerForm" action="modules/blog/process.php?act=updateCategory" method="POST">
 					<!-- box-body -->
 					<input type="hidden" name="categoryID" value="<?php echo $categoryID;?>">
 					<div class="form-group has-feedback" id="check-blood">
 						<label for="inputNombre" class="col-sm-2 control-label">Categor&iacute;a</label>						
 						<div class="col-sm-6">
 							<input type="text" name="category" class="form-control" value="<?php echo $category;?>" placeholder="Categor&iacute;a" autocomplete="OFF" onKeyDown="">
 						</div>
 					</div>	

 					<div class="form-group">
	 					<div class="col-sm-8">
	 						<button type="submit" class="btn btn-primary pull-right">Actualizar categor&iacute;a</button>
	 					</div>
	 				</div>
 					
 				</form>
			</div>
	</div>
  </div>
</div>
<?php }else{
	echo "<style>@media only screen and (max-width: 2500px) {
	  .resp {
	    height:600px;
	  }
	@media only screen and (max-width: 600px) {
	  .resp {
	    height:300px;
	  }
	}</style>";
	echo "<div class='alert alert-warning alert-dismissable'>
	          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	          <h4>  <i class='icon fas fa-exclamation-triangle'></i> Advertencia!!!</h4>
	          Usted no tiene permiso para acceder a este m&oacute;dulo.
	          </div>";
	echo "<div class='col col-md-12'>
				<div>
				<img class='resp' src='img/stop.jpg' alt='Alto!!'>
				</div>
			</div>";
	} 
}else{ ?>
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
		<ol class="breadcrumb">
			<li><a href="?module=indexBlog"><i class="fas fa-home"></i> Inicio</a></li>
			<li><a href="?module=listCategories">Categor&iacute;as</a></li>
			<li class="active">Actualiar categor&iacute;a</li>
		</ol>
	</div>
</div> <?php 
	include 'Error404Include.php';
}	
}else if($_GET["act"]=='updatePost' && isset($_GET["id"])){
		$idPost = $_GET["id"];
		$sql="SELECT p.*, pic.* FROM post_blog p 
			INNER JOIN picks pic ON pic.id_pick = p.pick_id 
			INNER JOIN suppress s ON s.id_supress = p.suppress_id
			WHERE s.is_supress='N' AND p.id_post_blog=$idPost";
		$result = $conn->getConn()->query($sql);
		if ($result->num_rows > 0) {
			if($rowPost = $result->fetch_assoc()) {
				$prominent = $rowPost["prominent"];
				$id_pick = $rowPost["pick_id"];
				$location = $rowPost["location"];
				$id_post_blog = $rowPost["id_post_blog"];
				$title = $rowPost["title"];
				$content = $rowPost["content"];
				$description = $rowPost["brief_description"];
				$created = $rowPost["title"];
				$location = str_replace("JPG","jpg",$location);
				$strrchrPick = strrchr($location,"/");
				$pick = substr($strrchrPick,1);
			}
		}
?>
<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<ol class="breadcrumb">
			<li><a href="?module=indexBlog"><i class="fas fa-home"></i> Inicio</a></li>
			<li><a href="?module=indexBlog">Blog</a></li>
			<li class="active">Modificar entrada</li>
		</ol>
	</div>
</div>
<?php if($_GET['act']=='updatePost'){ ?>
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box box-info">
			<!-- Alertas -->
			<!--/.Alertas -->
			<div class="box-header">
				<div class="box-icons">
					<a class="expand-link">
						<i class="fas fa-external-link-alt"></i>
					</a>
				</div>
			</div>
			<div class="box-content">
				<h4 class="page-header">Modificar Entrada</h4>
 				<form id="updateBlog" name="updateBlog" class="form-horizontal registerForm" enctype="multipart/form-data" action="modules/blog/process.php?act=updatePost" method="POST">
 					<!-- box-body -->
 					<input type="hidden" name="postID" value=<?php echo $idPost; ?>>
 					<div class="row col-sm-12 col-sm-offset-1">
	 					<div class="form-group col-sm-11">
	 						<label for="" class="control-label">T&iacute;tulo</label>
	
	 						<div class="" id="">
	 							<input type="text" value="<?php echo $title;?>" name="title" class="form-control" id="title" placeholder="T&iacute;tulo" autocomplete="off">
	 						</div>
	 					</div>
 					</div>
 					
 					<div class="row col-sm-12 col-sm-offset-1">
	 					<div class="form-group col-sm-11">
	 						<label for="" class="control-label">Descripci&oacute;n breve</label>
	
	 						<div class="" id="">
	 							<input type="text" value="<?php echo $description;?>" name="description" class="form-control" id="description" placeholder="Descripci&oacute;n breve" autocomplete="off">
	 						</div>
	 					</div>
 					</div>

 					<div class="row col-sm-12 col-sm-offset-1">
	 					<div class="form-group col-sm-11">
	 						<label for="" class="control-label">Contenido</label>
	
	 						<div class="" id="">
								<textarea class="form-control" rows="5" id="wysiwig_simple" name="contenido"><?php echo $content;?></textarea>
	 						</div>
	 					</div>
 					</div>
 					
 					<div class="row col-sm-12 col-sm-offset-1">
	 					<div class="form-group col-sm-11">
	 						<label class="control-label">Foto</label>
	
		 					<div class="">
		 						<input type="file" name="foto" class="form-control" id="imagen">
		 							<br>
									<?php echo $id_pick==0?'<img src="img/blog/sinFoto.jpg" alt="Los Angeles" style="width:800px;height: 400px;">':'<img src="img/blog/'.$pick.'" alt="Los Angeles" style="width:800px;height: 400px;">';?>
						     </div>
	 					</div>
 					</div>
 					
 					<?php $sql = "SELECT GROUP_CONCAT(c.NAME) AS categorias FROM mm_post_blog_categories mm 
							 INNER JOIN categories_blog c ON c.id_category_blog = mm.categories_blog
							 INNER JOIN post_blog p ON p.id_post_blog = mm.post_blog_id
							 INNER JOIN suppress s ON s.id_supress = p.suppress_id
							 WHERE s.is_supress = 'N' AND p.id_post_blog = $idPost
							 GROUP BY p.id_post_blog";
							$result = $conn->getConn()->query($sql);
							if ($result->num_rows > 0) {
								if ( $rowCat = $result->fetch_assoc () ) {
									$actualCat=$rowCat["categorias"];
								}
							}	
					?>
 					
 					<div class="row col-sm-12 col-sm-offset-1">

	 					<div class="form-group col-sm-11">
	 						<label for="" class="control-label">Categor&iacute;a/s</label>
							<?php $sql="SELECT cb.id_category_blog, cb.name FROM categories_blog cb
										INNER JOIN suppress s ON s.id_supress = cb.suppress_id
										WHERE s.is_supress = 'N'"; 
							$result = $conn->getConn()->query($sql);
							?>
	 						<select id="multiCategory" multiple="multiple" name="categorias[]" class="populate placeholder" lang="es">
	 							<?php 
	 							if ($result->num_rows > 0) {
	 								while ( $row = $result->fetch_assoc () ) {
	 										$categoryID = $row["id_category_blog"];
	 										$name = $row["name"];
	 									?>
	 						<option value="<?php echo $categoryID; ?>"><?php echo $name;?></option>			
	 					  <?php	    }
	 							}
	 							?>
	 						</select>
	 						<p style="color:green">Categor&iacute;a/s actual/es: <?php echo $actualCat;?></p>
	 					</div>
 					</div>
 					
 					<div class="row col-sm-12 col-sm-offset-1">
	 					<div class="form-group col-sm-11">
	 						<label for="" class="control-label">Destacado</label>
	
							<select id="prominent" name="prominent" class="form-control">
								<option value=""></option>
								<option value="Y">Destacado</option>
								<option value="N">No destacado</option>
							</select>
							<p style="color:green">Destacado actual: <?php echo $prominent=='Y'?'Si':'No';?></p>
	 					</div>
 					</div>
 					
 					<div class="form-group">
	 					<div class="col-sm-11">
	 						<button type="submit" class="btn btn-primary pull-right">Modificar entrada</button>
	 					</div>
	 				</div>
 					
 				</form>
			</div>
	</div>
  </div>
</div>
<?php } else{
	echo "<style>@media only screen and (max-width: 2500px) {
	  .resp {
	    height:600px;
	  }
	@media only screen and (max-width: 600px) {
	  .resp {
	    height:300px;
	  }
	}</style>";
	echo "<div class='alert alert-warning alert-dismissable'>
	          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	          <h4>  <i class='icon fas fa-exclamation-triangle'></i> Advertencia!!!</h4>
	          Usted no tiene permiso para acceder a este m&oacute;dulo.
	          </div>";
	echo "<div class='col col-md-12'>
				<div>
				<img class='resp' src='img/stop.jpg' alt='Alto!!'>
				</div>
			</div>";
}
}?>
<script>
function verifyCat(){
	var valor=$("#multiCategory").val();
	if(valor==null){
		$("#alertCat").html('<small class="help-block" data-bv-validator="notEmpty" data-bv-for="description" data-bv-result="INVALID" style="color:red">La categor\u00EDa es requerida</small>');
		var actClass= $("#divCat").attr('class');
		var classError = actClass+" has-error";
		$("#divCat").removeClass;
		$("#divCat").addClass(classError);
		$("#btnAdd").prop('disabled', true);
	}else{
		var actClass= $("#divCat").attr('class');
		$("#alertCat").html("");
		$("#divCat").removeClass(actClass);
		var classSuccess = " has-success";
		$("#btnAdd").prop('disabled', false);
		$("#divCat").addClass("form-group col-sm-11"+classSuccess);
	}
}
</script>