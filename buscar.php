<?php $conn=new Conex();?>
<div class="row">
	<div id="breadcrumb" class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="?module=inicio">Inicio</a></li>
			<li class="active">Buscar</li>
		</ol>
	</div>
</div>
<style>
.txt-primary, .p_1_sJ{
	color:black;
	font-size: 14px;
}

.large {
    font-size: 20px;
}

h3, .h3 {
    font-size: 14px;
}

p {
text-align: left !important;
font-size: 14px !important;
margin: 0 0 10px !important;
}

.findPage img {
	height: 30px;
	width: 30px;
    display: block;
    margin: auto;
    border: 0;
    float: left;
}

div{
	text-align: left !important;
}
</style>
<div class="row">
	<div class="col-xs-12">
		<form class="form-inline" id="" role="form" action="?module=buscar" method="POST" novalidate="novalidate">
			<div class="input-group">
				<input type="text" name="objFind" autocomplete="off" id="objFind" class="form-control input-lg" placeholder="Que desea encontrar?...">
				<span class="input-group-btn">
					<button class="btn btn-primary" id="btnFind" disabled="disabled" style="margin-left: -1px;
					margin-bottom: 0;
					height: 39px;" type="submit">
						<i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>
		
		<div class="col col-xs-12 findPage" style="word-break: break-all;">
	<br>	
	<p id="txtResult" class="small text-green">N&uacute;mero de coincidencias: <span id="totalResultFind">1</span>.</p> 
		
		<?php if($_POST["objFind"]){ 
			$totalRes = "0";
			$objFind = $_POST["objFind"]; ?>
		
		<?php $sqlMod = "SELECT * FROM modules m 
		INNER JOIN suppress s ON s.id_supress = m.supress_id
		INNER JOIN status st ON st.id_status = m.status_id
		WHERE s.is_supress = 'N' AND st.status = 'Activo' 
		AND UPPER(m.module) LIKE UPPER('%$objFind%')";
		
		$resultMod = $conn->getConn ()->query ( $sqlMod ); ?>
		
		<?php 
		if ($resultMod->num_rows > 0) { ?>
		
			<?php while ($rowMod = $resultMod->fetch_assoc ()) { 
				$id_module = $rowMod['id_module'];
				$module = !empty($objFind)?highlightWords($rowMod['module'], $objFind):$row['module'];
				?>
					<div class="one-result">
						<a href="<?php if($rowMod['module']=='Doctores'){
							echo "?module=doctorList";
						}else if($rowMod['module']=='Pacientes'){
							echo "?module=patientList";
						}else if($rowMod['module']=='Empleados'){
							echo "?module=listEmployees";
						}else if($rowMod['module']=='listSpeciality'){
							echo "?module=listEmployees";
						}else if($rowMod['module']=='Configuraciones'){
							echo "?module=config";
						}else if($rowMod['module']=='Citas'){
							echo "?module=listAppointments";
						}else if($rowMod['module']=='calendar'){
							echo "?module=Calendario";
						}else if($rowMod['module']=='Historia clínica' || $rowMod['module']=='Historia clinica'){
							echo "?module=listClinicHistory";
						}else if($rowMod['module']=='Cuentas'){
							echo "?module=invoice";
						}else if($rowMod['module']=='Chat'){
							echo "?module=chat";
						}else if($rowMod['module']=='Tipos de sangre'){
							echo "?module=bloodGroupList";
						}else if($rowMod['module']=='Notificaciones'){
							echo "?module=notifications";
						}else if($rowMod['module']=='Blog'){
							echo "?module=indexBlog";
						}else if($rowMod['module']=='Perfil'){
							echo "?module=viewProfile";
						}else if($rowMod['module']=='Mercancias'){
							echo "?module=commodity";
						}
						?>" class="large">M&oacute;dulo | <?php echo $rowMod['module']; ?></a>
						<p class="txt-primary"><?php echo $module; ?></p>
					</div>
<?php 			$totalRes++;
			}
		}?>
		
		<?php 
			 $sql="SELECT * FROM post_blog p 
			INNER JOIN suppress s ON s.id_supress = p.suppress_id
			WHERE UPPER(p.title) LIKE UPPER('%$objFind%')
			OR  UPPER(p.brief_description) LIKE UPPER('%$objFind%')
			OR  UPPER(p.content) LIKE UPPER('%$objFind%')
			AND s.is_supress = 'N'
			GROUP BY p.content, p.id_post_blog";
		 
			$result = $conn->getConn ()->query ( $sql ); ?>
		
		<?php 
			if ($result->num_rows > 0) { ?>
			<?php while ($row = $result->fetch_assoc ()) { 
					$title = !empty($objFind)?highlightWords($row['title'], $objFind):$row['title'];
					$brief_description = !empty($objFind)?highlightWords($row['brief_description'], $objFind):$row['brief_description'];
					$content = !empty($objFind)?highlightWords($row['content'], $objFind):$row['content'];
					?>
					<div class="one-result">
						<a href="?module=viewPost&post=<?php echo $row['id_post_blog'];?>" class="large">Post | <?php echo $row['title']; ?></a>
						<p class="txt-primary"><?php echo $brief_description; ?></p>
					</div>
					<?php $cadena = '';
					$res = explode(',', $content);
					 
					for ($i = 0; $j = count($res), $i < $j; $i++) {
					        $cadena .= "...$res[$i]...";
					} ?>
					<p style="color: black; font-size: 14px;"><?php echo $cadena;?></p>
   <?php $totalRes++;} ?>
<script type="text/javascript">
	 document.getElementById("totalResultFind").innerHTML = "<?php  echo $totalRes;?>"; 
</script>
<?php  		}

		}?>
		
		<?php if($totalRes==0){
			echo "<div class='alert alert-warning alert-dismissable'>
	          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	          <h4>  <i class='icon fas fa-exclamation-triangle'></i> Advertencia!!!</h4>
	          No se encontraron coincidencias.
	          </div>"; ?>
	          <script type="text/javascript">
	 				 document.getElementById("txtResult").style.display = "none"; 
			</script>
		<?php }?>
		
		</div>
		
		<?php function highlightWords($text, $word){
			    $text = preg_replace('#'. preg_quote($word) .'#i', '<span style="background-color: #F9F902;">\0</span>', $text);
			    $pos = strpos($text, $word);
			    $newText = substr($text, 0, $pos+400);
			    return substr($newText, -500);
			  }?>

	</div>
</div>