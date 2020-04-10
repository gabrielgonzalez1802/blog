<?php require_once "config/databaseObject.php";

if($_GET['module'] == 'post'){
	include "modules/blog/form.php";
}else if($_GET['module'] == 'listCategories'){
	include "modules/blog/listCategories.php";
}else if($_GET['module'] == 'indexBlog'){
	include "modules/blog/indexBlog.php";
}else if($_GET['module'] == 'viewPost'){
	include "modules/blog/viewPost.php";
}else if($_GET['module'] == 'listOneCategory'){
	include "modules/blog/listOneCategory.php";
}else if($_GET['module'] == 'coments'){
	include "modules/blog/coments.php";
}else{
    include "modules/blog/indexBlog.php";
}
?>