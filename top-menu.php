<style>
.panel-menu > li {
    font-size: 20px;
 }
</style>
			<div class="col-xs-8 col-sm-4">
						<a href="#" class="show-sidebar">
						  <i class="fa fa-bars"></i>
						</a>
						<div class="licence">
						<a class="" rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank">
						<img alt="Licencia de Creative Commons" style="border-width:0" 
						src="https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png" /></a>
						</div>
<!-- 						<div id="search"> -->
<!-- 							<input type="text" placeholder="search"/> -->
<!-- 							<span class="input-group-btn"> -->
<!-- 					      </span> -->
<!-- 						</div> -->
					</div>			
					<div class="col-xs-4 col-sm-8 top-panel-right">
						<ul class="nav navbar-nav pull-right panel-menu">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle account" data-toggle="dropdown">
									<div class="avatar">
									<?php if($_SESSION['pickPersonalized']==1){
										$strrchrPick = strrchr($_SESSION["pick"],"/");
										$pick = substr($strrchrPick,1);
										echo "<img src='img/avatar/$pick"."?.rand(1,1000)' class='img-rounded' alt='avatar'/>";
									}else{
										echo "<img src='img/avatar/user.jpg"."?.rand(1,1000)' class='img-rounded' alt='avatar'/>";
									}?>
									</div>
									<div class="user-mini pull-right">
										<span class="welcome"><?php echo $welcome;?>,</span>
										<span><?php echo "Usuario Demo";?></span>
									</div>
								</a>
							</li>
						</ul>
					</div>