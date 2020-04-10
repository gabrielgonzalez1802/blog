<?php require_once 'config/databaseObject.php';
$conn = new Conex();
?>
<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<ol class="breadcrumb">
			<li><a href="?module=indexBlog"><i class="fas fa-home"></i> Inicio</a></li>
			<li><a href="?module=indexBlog">Blog</a></li>
			<li class="active">Comentarios</li>
		</ol>
	</div>
</div>
<section class="content">
<div class="row">
	<div class="col-xs-12 col-sm-12">
	  <div class="box box-info">
		<!-- Alertas -->
		<?php  
		$space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		if (empty($_GET['alert'])) {
			echo "";
		} 
		elseif ($_GET['alert'] == 1) {
			echo "<div class='alert alert-info alert-dismissable'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<h4>  <i class='icon fa fa-check-circle'></i> Muy Bien!!!</h4>
			los datos del nuevo paciente se almacen&oacute; correctamente.
			</div>";
		}
		elseif ($_GET['alert'] == 11) {
			echo "<div class='bg-danger alert-dismissable'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<h4>  <i class='icon fa fa-times-circle'></i> Error!!!</h4>
			El Registro no pudo ser Creado, Verifique los datos ingresados e intente nuevamente.
			</div>";
		}
		elseif ($_GET['alert'] == 2) {
			echo "<div class='alert alert-info alert-dismissable'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<h4>  <i class='icon fa fa-check-circle'></i> Muy Bien!!!</h4>
			El Registro ha sido Modificado.
			</div>";
		}
		elseif ($_GET['alert'] == 22) {
			echo "<div class='alert alert-danger alert-dismissable'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<h4>  <i class='icon fa fa-times-circle'></i> Error!!!</h4>
			El Registro no pudo ser Modificado, Verifique los datos ingresados e intente nuevamente.
			</div>";
		}
		elseif ($_GET['alert'] == 3) {
			echo "<div class='alert alert-info alert-dismissable'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<h4>  <i class='icon fa fa-check-circle'></i> Muy Bien!!!</h4>
			El Registro ha sido Borrado.
			</div>";
		}
		elseif ($_GET['alert'] == 33) {
			echo "<div class='alert alert-danger alert-dismissable'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<h4>  <i class='icon fa fa-times-circle'></i> Error!!!</h4>
			El Registro no pudo ser Eliminado.
			</div>";
		}
		elseif ($_GET['alert'] == 44) {
			echo "<div class='alert alert-danger alert-dismissable'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<h4>  <i class='icon fa fa-times-circle'></i> Error!!!</h4>
			Ocurri&oacute; un error al agregar el paciente, se guardo el registro sin antecedentes.
			</div>";
		}
		?>
		<!--/.Alertas -->
		<div class="row">
					<div class="col-xs-12 col-sm-12">	
					<div class="box-header">
						<div class="box-icons">
							<a class="expand-link">
								<i class="fas fa-external-link-alt"></i>
							</a>
						</div>
					</div>
		<div class="box-content">  
			<h3 class="page-header">Comentarios</h3>
		<table id="myTable" class="table table-striped table-bordered">
			<thead>
					<tr class="primary">
						<th class="center" id="">No.</th>
						<th class="center" id="">Entrada</th>
						<th class="center" id="">Usuario</th>
						<th class="center" id="">Comentario</th>
						<th class="center" id="">Fecha</th>
						<th class="center" id="">Acciones<?php echo $space?>	
					</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no = 1;
				$sql = "SELECT c.id_comment_blog, p.id_person, p.first_name, p.first_surname, b.title, c.comment, b.id_post_blog,
						DATE_FORMAT(c.created,'%d/%m/%Y - %r') AS created  FROM comment_blog c 
						INNER JOIN post_blog b ON c.post_blog_id = b.id_post_blog
						INNER JOIN persons p ON p.user_id = c.user_id";

				$result = $conn->getConn()->query($sql);

				while($row = $result->fetch_assoc()) {
					$id_comment_blog = $row["id_comment_blog"];
					$id_post_blog = $row["id_post_blog"];
					$id_person=$row["id_person"];
					$first_name = $row["first_name"];
					$first_surname = $row["first_surname"];
					$title = $row["title"];
					$comment = $row["comment"];
					$created = $row["created"];
					echo "<tr>
					<td>$no</td>
					<td><a href='?module=viewPost&post=$id_post_blog'>$title</a></td>
					<td>Demo</td>
					<td>$comment</td>
					<td>$created</td>";?>
					<td><div><a title="Suprimir" class="btn btn-danger btn-sm tool" id="" onclick="confirmDelete(<?php echo $id_comment_blog; ?>,'modules/blog/process.php?act=deleteComents&id=<?php echo$id_comment_blog;?>')"><i style="color:#fff" class="fas fa-trash-alt"></i></a></div>
					<?php echo "
					</td>
					</tr>";
					$no++;
				}
				?>
			</tbody>
		</table>
	</div>
  </div>
  </div>
  </div>
</div>
</div>
</section>
<?php $conn->getConn()->close(); ?>