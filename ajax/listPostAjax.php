<style>
.title{
 word-wrap: break-word; 
   max-width:230px;
   width:400px;
   height: 320px;
   text-align: right;
   color: #223438;
   font-weight: bolt;
   padding-top: 5px;
   padding-right: 5px;
   font-size: 15px;
}
.cat{
 word-wrap: break-word; 
   max-width:200px; 
   width:200px;
   text-align: right;
   color: #223438;
   font-weight: bolt;
   padding-top: 5px;
   padding-right: 5px;
   font-size: 15px;
   font-family: 'Righteous',cursive;
}
.line{
	border-bottom: 2px solid #6aa6d6;
}
</style>
<?php
require_once "../config/databaseObject.php";
include "../funciones.php";
$conn = new Conex();
	
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
		$query = mysqli_real_escape_string($conn->getConn(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	// 	sleep(0.4);
	    $sql="SELECT GROUP_CONCAT(c.NAME) AS categorias, pic.id_pick, pic.location, p.id_post_blog, p.title, p.brief_description,
		p.created FROM post_blog p
		INNER JOIN picks pic ON pic.id_pick = p.pick_id
		INNER JOIN suppress s ON s.id_supress = p.suppress_id
		INNER JOIN mm_post_blog_categories mm ON mm.post_blog_id = p.id_post_blog
		INNER JOIN categories_blog c ON c.id_category_blog = mm.categories_blog
		WHERE s.is_supress = 'N'
		AND upper(p.title) LIKE UPPER('%$query%') || upper(c.NAME) LIKE UPPER('%$query%')
		GROUP BY p.id_post_blog ORDER BY p.created DESC, p.title";
		
		if ($result=mysqli_query($conn->getConn(),$sql)){
			$numrows = mysqli_num_rows($result);
		}
		
		include '../paginationPost.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	// 	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
		$per_page = 6; 
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
	
		$total_pages = ceil($numrows/$per_page);
		//main query to fetch the data
		$query = mysqli_query($conn->getConn(),"SELECT GROUP_CONCAT(c.NAME) AS categorias, pic.id_pick, pic.location, p.id_post_blog, p.title, p.brief_description,
		p.created FROM post_blog p
		INNER JOIN picks pic ON pic.id_pick = p.pick_id
		INNER JOIN suppress s ON s.id_supress = p.suppress_id
		INNER JOIN mm_post_blog_categories mm ON mm.post_blog_id = p.id_post_blog
		INNER JOIN categories_blog c ON c.id_category_blog = mm.categories_blog
		WHERE s.is_supress = 'N'
		AND upper(p.title) LIKE UPPER('%$query%') || upper(c.NAME) LIKE UPPER('%$query%')
		GROUP BY p.id_post_blog ORDER BY p.created DESC, p.title LIMIT $offset,$per_page");
		
		if ($numrows>0){
			
		?>
		<?php while($row = mysqli_fetch_array($query)){	
			$id_pick = $row["id_pick"];
			$location = $row["location"];
			$id_post_blog = $row["id_post_blog"];
			$title = $row["title"];
			$description = $row["brief_description"];
			$created = $row["title"];
			$location = str_replace("JPG","jpg",$location);
			$categorias = $row["categorias"];
			$strrchrPick = strrchr($location,"/");
			$pick = substr($strrchrPick,1);
		?>	
			<div class="co-lg-3 col-md-4 col-sm-6 col-xs-12">
				<div class="thumbnail title">
					<a href="?module=viewPost&post=<?php echo $id_post_blog;?>">
					<?php if($id_pick=='0'){ ?>
						 <img src="img/blog/sinFoto.jpg" alt="<?php echo $title;?>" style="width:400px;height: 150px;">
						<?php }else{?>
							 <img src="img/blog/<?php echo $pick?>" alt="<?php echo $title;?>" style="width:400px;height: 150px;">
						<?php }?>
						   <p><center><strong><?php echo $title;?></strong></center></p>
						   <p><center><?php echo $description?></center></p>
						   <div class="line"></div>
						   <p><span class="cat pull-right"><?php echo $categorias?></span></p>
					</a>
	    		</div>
			</div>
		<?php 
	}
	?>
			<div class="table">
				<table class="table">                               
							<tr>
								<td colspan='5'> 
									<?php 
										$inicios=$offset+1;
										$finales+=$inicios -1;
										echo "Mostrando $inicios al $finales de $numrows registros";
										echo paginate( $page, $total_pages, $adjacents);
									?>
								</td>
							</tr>
					</tbody>			
				</table>
			</div>	
	<?php }else{ ?>
			<div class="conten col-md-4 col-sm-4 col-xs-12 profile">No se encontraron registros</div>
		<?php } 
}?>