<?php include_once 'class/users.php'; ?>
<ul class="nav main-menu">
<?php if ($_GET["module"]=="blog" || $_GET["module"]=="post" || $_GET["module"]=="indexBlog" || $_GET["module"]=="coments" || $_GET["module"]=="listCategories" || $_GET["act"]=="updateCategory"){ ?>
	<li class="dropdown">
	    <?php if($_GET["module"]=="indexBlog"){?>
			<li class="active-parent active"><a class="" href="?module=indexBlog">Blog</a></li>
		<?php }else{?>
		    <li><a class="" href="?module=indexBlog">Blog</a></li>
		<?php }?>
		<?php if($_GET["form"]=="addPost"){?>
		<li class="active-parent active"><a class="" href="?module=post&form=addPost">Crear entrada</a></li>
		<?php }else{?>
			<li><a class="" href="?module=post&form=addPost">Crear entrada</a></li>
		<?php } ?>	
		<?php if($_GET["module"]=="coments"){?>
			<li class="active-parent active"><a class="" href="?module=coments">Comentarios</a></li>	
		<?php }else{?>	
		    <li><a class="" href="?module=coments">Comentarios</a></li>	
		<?php }?>	
		<?php if($_GET["module"]=="listCategories" || $_GET["act"]=="createCategory" || $_GET["act"]=="updateCategory"){?>
			<li class="dropdown active">
		<?php }else{?>
		   <li class="dropdown">
		<?php }?>	
				<a href="#" class="dropdown-toggle">
					<i class="fa fa-plus-square"></i>
					<span class="hidden-xs">Categor&iacute;as</span>
				</a>
				<ul class="dropdown-menu">
				   <?php if($_GET["act"]=="createCategory"){?>
					<li class="active-parent active"><a class="" href="?module=post&act=createCategory">Crear categor&iacute;a</a></li>
					<?php }else{ ?>
					<li><a class="" href="?module=post&act=createCategory">Crear categor&iacute;a</a></li>
				<?php } ?>	
				<?php if($_GET["module"]=="listCategories"){ ?>
					<li class="active-parent active"><a class="" href="?module=listCategories">Lista de categor&iacute;as</a></li>
				<?php }else{?>
				    <li><a class="" href="?module=listCategories">Lista de categor&iacute;as</a></li>
				<?php }?>
				</ul>			
			</li>
		</ul>
	</li>
	<?php
	} else { ?>
	<li><a class="active" href="?module=indexBlog">Blog</a></li>
    <li><a class="" href="?module=post&form=addPost">Crear entrada</a></li>
    <li><a class="" href="?module=coments">Comentarios</a></li>
    <li class="dropdown"><a href="#" class="dropdown-toggle"> <i
    	class="fa fa-plus-square"></i> <span class="hidden-xs">Categor&iacute;as</span></a>
    	<ul class="dropdown-menu">
    		<li><a class="" href="?module=post&act=createCategory">Crear
    				categor&iacute;a</a></li>
    		<li><a class="" href="?module=listCategories">Lista de
    				categor&iacute;as</a></li>
    	</ul>
    </li>
<?php }?>