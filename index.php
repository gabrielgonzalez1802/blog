<!DOCTYPE html>
<html lang="es">
<head>
<?php require_once 'config/conexion.php';
require_once 'config/databaseObject.php'; ?>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width"/>
	<title><?php echo "Blog"; ?></title>
	<link rel="icon"  href="img/favicon.png<?php echo "?".rand(1,1000);?>" type="image/png">
	<meta name="description" content="description">
	<meta name="author Software" content="Gabriel Gonzalez">
	<meta name="author Email" content="gabrielgonzalez1802@gmail.com">
	<meta name="author plantilla" content="DevOOPS">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
	<link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
	<link href="plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
	<link href="plugins/select2/select2.css" rel="stylesheet">
	<link href="css/ihover.min.css" rel="stylesheet">
	<link href="css/style.min.css" rel="stylesheet">
	<link href="plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
	<link href="css/mystyle.css" rel="stylesheet">
	<link href="css/fixedHeader.bootstrap.min.css" rel="stylesheet">
	<link href="css/responsive.bootstrap.min.css" rel="stylesheet">
	<link href="plugins/kartik-v-bootstrap-star-rating/css/star-rating.css" rel="stylesheet">
	<link href="css/selva.css" rel="stylesheet">	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
			<![endif]-->
		</head>
		<body>
		<?php 
		require 'funciones.php';
		require 'class/person.php';
		$persona = new Person(1);
		$userID=$persona->getId_person();
		$welcome="Bienvenido";
		$firstnameUser="Demo";
		$surnamenameUser="";
		$hasConfiguration=$persona->getHasConfiguration();
		?>
		<header class="navbar">
			<div class="container-fluid expanded-panel">
				<div class="row">
					<div id="logo" class="col-xs-12 col-sm-2">
						<a><?php echo "BLOG";?></a>
					</div>
					<div id="top-panel" class="col-xs-12 col-sm-10">
						<div class="row">
							<?php include('top-menu.php'); ?>
						</div>
					</div>
				</div>
			</div>
		</header>
			<!--End Header-->
			<!--Start Container-->
			<div id="main" class="container-fluid">
				<div class="row">
					<div id="sidebar-left" class="col-xs-2 col-sm-2">
						<?php //if($sidebarConf){
// 							include('sidebarConfig.php');
// 						}else{
							include('sidebar.php');
// 						}
						?>
					</div>
					<!--Start Content-->
					<div id="content" class="col-xs-12 col-sm-10">
					<?php include "content.php" ?>
				<?php if($_GET["module"]=='inicio'){?>
					<footer class="main-footer piePagina">
				    <div class="pull-right hidden-xs">
				      <b>Version</b> 1.0.0
				    </div>
					 <strong> Copyright &copy; 2019<?php if(date('Y') != 2019){echo '-'.date('Y');}?> <span id="transmark" style="display: none; width: 0px; height: 0px;"></span> <a href="#" target="_blank" marked="1">ImpactaMed</a>.</strong> All rights
				    reserved.
				  </footer>
			   <?php } ?>	  
					</div>
					<!--End Content-->
				</div>
			</div>
			<!--End Container-->
			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- 			<script src="http://code.jquery.com/jquery.js"></script> -->
			<script src="js/all.min.js"></script>
			<script src="plugins/jquery/jquery-2.1.0.min.js"></script>
			<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
			<script type="text/javascript" src="plugins/bootstrap-validator/dist/js/bootstrapValidator.js"></script>
			<!-- Include all compiled plugins (below), or include individual files as needed -->
			<script src="plugins/bootstrap/bootstrap.min.js"></script>
			<!-- All functions for this theme + document.ready processing -->
			<script src="js/devoops.js"></script>
			<!-- Data tables -->
			<script src="plugins/datatables/jquery.dataTables.min.js"></script>
			<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
						<script src="plugins/tinymce/tinymce.min.js"></script>
			<script src="plugins/tinymce/jquery.tinymce.min.js"></script>
						<?php require 'documentReady.php'?>
			
			<script src='js/dataTables.fixedHeader.min.js'></script>
			<script src='js/dataTables.responsive.min.js'></script>
			<script src='js/responsive.bootstrap.min.js'></script>
			<script src='plugins/sweetalert2/sweetalert2.min.js'></script>			
			<script src="plugins/kartik-v-bootstrap-star-rating/js/star-rating.js"></script>
			<script src="plugins/kartik-v-bootstrap-star-rating/js/locales/es.js"></script>
			<script>
			//necesario para usar en ventanas modales
			$.fn.modal.Constructor.prototype.enforceFocus = function() {};
			 function DemoSelect2(){
					$('#multiCategory').select2({placeholder: "Selecciona la categor\u00EDa"});
				}
			 </script>	 
		</body>
		</html>