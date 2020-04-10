<?php require_once 'config/databaseObject.php';
$conn = new Conex(); ?>
<link href="css/blog.css" rel="stylesheet">
<?php 
	$sqlCat="SELECT c.id_category_blog, c.name FROM categories_blog c
					INNER JOIN suppress s ON s.id_supress = c.suppress_id
					WHERE s.is_supress = 'N' ORDER BY c.name";
	
	include 'paginationPost.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	// 	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$per_page = 6;
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$cont=0;
	$total_pages = ceil($numrows/$per_page);
	
	$sqlPost="SELECT pic.id_pick, pic.location, p.id_post_blog, p.title, p.brief_description,
	p.created FROM post_blog p
	INNER JOIN picks pic ON pic.id_pick = p.pick_id
	INNER JOIN suppress s ON s.id_supress = p.suppress_id
	WHERE s.is_supress = 'N' LIMIT $offset,$per_page";
	
	$SQLRecentPost = $sqlPost." LIMIT 5";
	
	$sqlRrecentSidebarPost = "SELECT * FROM post_blog p 
								INNER JOIN suppress s
								ON s.id_supress = p.suppress_id
								WHERE s.is_supress = 'N'
								ORDER BY p.created DESC
								LIMIT 0,10;";
		
	$sqlDestacado = "SELECT pic.id_pick, pic.location, p.id_post_blog, p.title, p.brief_description, p.created
					FROM post_blog p
					INNER JOIN picks pic ON pic.id_pick = p.pick_id
					INNER JOIN suppress s ON s.id_supress = p.suppress_id
					WHERE s.is_supress = 'N'
					AND p.prominent = 'Y' ORDER BY p.created LIMIT 0,10";
	$resultDestacado = $conn->getConn()->query($sqlDestacado);
	$countDest  = $resultDestacado->num_rows;
?>
<div class="row">
	<div class="contentStyle">
		<div class="col-md-9"> 
		<?php 
		if (empty($_GET['alert'])) {
			echo "";
		}elseif ($_GET['alert'] == 3) {
			echo "<div class='alert alert-info alert-dismissable'>
	          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	          <h4>  <i class='icon fa fa-check-circle'></i> Muy Bien!!!</h4>
	          El Registro ha sido Borrado Correctamente.
	          </div>";
		}elseif ($_GET['alert'] == 33) {
			echo "<div class='alert alert-danger alert-dismissable'>
	          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	          <h4>  <i class='icon fa fa-times-circle'></i> Error!!!</h4>
	        	 Ha ocurrido un error al intentar borrar el registro.
	          </div>";
		}?>
			<br>
			<div class="row">
				<div class="col-md-12">
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
					    <!-- Indicators -->
					    <ol class="carousel-indicators">
					    <?php for($i=0; $i<$countDest; $i++):?>
					      <li data-target="#myCarousel" data-slide-to="<?php echo $i;?>" class="<?php echo $i==0?"active":""?>"></li>
					     <?php endfor;?>
					    </ol>
		
					    <!-- Wrapper for slides -->
					    <div class="carousel-inner" role="listbox">
					   <?php if ($countDest > 0) {
					   	while($rowDestacado = $resultDestacado->fetch_assoc()) {
								$id_pick = $rowDestacado["id_pick"];
								$location = $rowDestacado["location"];
								$id_post_blog = $rowDestacado["id_post_blog"];
								$title = $rowDestacado["title"];
								$description = $rowDestacado["brief_description"];
								$created = $rowDestacado["title"];
								$location = str_replace("JPG","jpg",$location);
								$strrchrPick = strrchr($location,"/");
								$pick = substr($strrchrPick,1); ?>
								
	<?php echo $cont==0?'<div class="item active">':'<div class="item">'?>
 <?php echo $id_pick==0?'<img id="imgCarrusel" src="img/blog/sinFoto.jpg" alt="" class="imgCarruselBlog">':'<img id="imgCarrusel" src="img/blog/'.$pick.'" alt="" class="imgCarruselBlog">';?>
							<div class="item active">
						        <div class="carousel-caption">
						          <h3><a class="color-white" href="?module=viewPost&post=<?php echo $id_post_blog;?>"><?php echo $title; ?></a></h3>
						          <p><?php echo $description; ?></p>
						        </div>
						     </div>
						     <?php $cont++;?>
						     </div>
					<?php }
						}?>

					    </div>
		
					    <!-- Left and right controls -->
<!-- 					    <a class="left carousel-control" href="#myCarousel" data-slide="prev"> -->
<!-- 					      <span class="glyphicon glyphicon-chevron-left"></span> -->
<!-- 					      <span class="sr-only">Previous</span> -->
<!-- 					    </a> -->
<!-- 					    <a class="right carousel-control" href="#myCarousel" data-slide="next"> -->
<!-- 					      <span class="glyphicon glyphicon-chevron-right"></span> -->
<!-- 					      <span class="sr-only">Next</span> -->
<!-- 					    </a> -->
						<br>
					</div>
					<div>
					<div class="col-md-12">
							<div id="loaderPost"></div><!-- Carga de datos ajax aqui -->
							<div id="resultadosPost"></div><!-- Carga de datos ajax aqui -->
							<div class='outer_divPost' id="bodyPostIndexBlog"></div><!-- Carga de datos ajax aqui -->
					</div>
					</div>
				</div>
			</div>
			
		</div>	
	
		<div class="col-md-3 style" id="panelBlog">
			<div class="style2">
				<div class="col-md-12">
					<div class="form-group has-feedback">
					    <label class="control-label">&nbsp;</label>
					    <input type="text" id="buscarPost" class="form-control" placeholder="Buscar post..." onkeyup = "loadPost(1);""/>
					    <i class="glyphicon glyphicon-search form-control-feedback" onclick="loadPost(1);"></i>
					</div>
					
					<div>
						<h4>Entradas recientes</h4>
						<?php $resultRecentPost = $conn->getConn()->query($SQLRecentPost);
						if ($resultRecentPost->num_rows > 0) {
					while($rowRecentPost = $resultRecentPost->fetch_assoc()) {
						$id_post_blog = $rowRecentPost["id_post_blog"];
						$title = $rowRecentPost["title"];
					?>
						<a href="?module=viewPost&post=<?php echo $id_post_blog;?>"><p><?php echo $title;?></p></a>
					<?php }
						}?>	
					</div>
					
					<div>
					<br>
						<h4>Categor&iacute;as</h4>
				<?php $resultCategory = $conn->getConn()->query($sqlCat);
				if ($resultCategory->num_rows > 0) {
					while($rowCat = $resultCategory->fetch_assoc()) {
							$id_category_blog = $rowCat["id_category_blog"];
							$category = $rowCat["name"];
					?>
						<a href="#" onclick="loadPost(1,'<?php echo $category;?>')"><p><?php echo $category;?></p></a>
					<?php }
						}?>	
					</div>
					
					<div>
					<br>
						<h4>&Uacute;ltimas Entradas</h4>
						<?php $resultRecentSidebarPost = $conn->getConn()->query($sqlRrecentSidebarPost);
						if ($resultRecentSidebarPost->num_rows > 0) {
							while($rowRes = $resultRecentSidebarPost->fetch_assoc()) {
									$titleSider = $rowRes["title"];
									$idPost = $rowRes["id_post_blog"];
							?>
						<a href="?module=viewPost&post=<?php echo $idPost;?>"><p><?php echo $titleSider;?></p></a>
						<?php }
						}?>
					</div>
					
				</div>		
			</div>		
		</div>
	</div>
<?php $conn->getConn()->close(); ?>