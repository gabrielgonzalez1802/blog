<?php $conn = new Conex(); ?>
<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<ol class="breadcrumb">
			<li><a href="?module=indexBlog"><i class="fas fa-home"></i> Inicio</a></li>
			<li><a href="?module=indexBlog">Blog</a></li>
			<li class="active">Lista de categor&iacute;as</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box box-info">
			<!-- Alertas -->
			<?php $space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			if (empty($_GET['alert'])) {
				echo "";
			} 
			elseif ($_GET['alert'] == 1) {
				echo "<div class='alert alert-info alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4>  <i class='icon fa fa-check-circle'></i> Muy Bien!!!</h4>
				Se ha generado la categor&iacute;a correctamente.
				</div>";
			}
			elseif ($_GET['alert'] == 11) {
				echo "<div class='bg-danger alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4>  <i class='icon fa fa-times-circle'></i> Error!!!</h4>
				Su solicitud no pudo ser Creada, Verifique los datos ingresados e intente nuevamente.
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
			}elseif ($_GET['alert'] == 4) {
				echo "<div class='alert alert-warning alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4>  <i class='icon fas fa-exclamation-triangle'></i> Advertencia!!!</h4>
				 La categor&iacute;a ya existe.
				</div>";
			}
			?>
			<!--/.Alertas -->
			<div class="box-header">
				<div class="box-icons">
					<a class="expand-link">
						<i class="fas fa-external-link-alt"></i>
					</a>
				</div>
			</div>
			<div class="box-content">
				<h3 class="page-header">Lista de categor&iacute;as</h3>
				<table id="myTable" class="table table-striped table-bordered">
					<thead>
						<tr class="primary">
							<th id="">No.</th>
							<th id="">Categor&iacute;a</th>
							<th id="">Acciones<?php echo $space?>	
						</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					$userID=$_SESSION['user_id'];
					$sql = "SELECT c.id_category_blog, c.name FROM categories_blog c 
					INNER JOIN suppress s ON s.id_supress = c.suppress_id
					WHERE s.is_supress = 'N'";

					$result = $conn->getConn()->query($sql);
					
					if ($result->num_rows > 0) {			
						while($row = $result->fetch_assoc()) {
							$id_category_blog = $row["id_category_blog"];
							$category = $row["name"];
							echo "<tr>
							<td>$no</td>";?>
				<?php echo "<td>$category</td>";?>
							<td class='center' width='80'>	
				<?php echo "<a title='Modificar' id='' class='btn btn-info btn-sm tool' href='?module=post&act=updateCategory&id=$id_category_blog'>
							<i style='color:#fff' class='fa fa-edit'></i>
							</a>";
							?>
							<a title="Suprimir" class="btn btn-danger btn-sm tool" href="modules/blog/process.php?act=delete&id=<?php echo $id_category_blog ?>" onclick="return confirm('Estas seguro de eliminar la categor&iacute;a <?php echo $category; ?> ?');">
								<i style="color:#fff" class="fas fa-trash-alt"></i>
							</a>
					 <?php 
				   	echo "  </td>"; ?>
					<?php echo "</tr>"; 
							$no++;
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
  </div>
</div>
<?php $conn->getConn()->close(); ?>