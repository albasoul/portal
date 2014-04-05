<?php

?>

<div class="row">
	<div class="col-md-12">
		<label>Navbar</label>
		
			<div class="navbar-links">
				<?php $navbar = $lidhja->query("SELECT * FROM navbar");
				foreach($navbar as $nav){
					if($nav['enabled']==0){
						echo '<a data-toggle="modal" data-target=".navbar-links-'.$nav['ID'].'" class="btn btn-danger">'.$nav['emri'].'</a>';
					}
					else{
						echo '<a data-toggle="modal" data-target=".navbar-links-'.$nav['ID'].'" class="btn btn-success">'.$nav['emri'].'</a>';
					}
					echo '
					<div class="modal fade navbar-links-'.$nav['ID'].'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-sm">
					    <div class="modal-content">
					      <form role="form" action="menaxhimi.php?navbar='.$nav['ID'].'" method="POST">
					      	<div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title">Navbar</h4>
						      </div>
						      <div class="modal-body">
						      <div class="row">
						      	<div class="form-group col-md-12">
						      		<label class="control-label" for="emri">Emri</label>
						      		<input type="text" name="emri" id="emri" value="'.$nav['emri'].'" class="form-control"/>
						      	</div>
						      	<div class="form-group col-md-12">
						      		<label for="enabled" class="control-label">Aktivizimi</label>
						      		<select name="enabled" id="enabled" class="form-control">';
						      			if($nav['enabled']==1){
						      				echo '<option value="1" selected>Aktive</option>';
						      				echo '<option value="0">Ndalo</option>';
						      			}
						      			else{
						      				echo '<option value="1">Aktive</option>';
						      				echo '<option value="0" selected>Ndalo</option>';
						      			}
						echo'  		</select>
						      	</div>
						      </div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
						        <button type="submit" class="btn btn-primary">Ruaj</button>
						      </div>
					      </form>
					    </div>
					  </div>
					</div>';
				}
				 ?>
			</div>
		
	</div>
</div>
<hr/>
<div class="row">
	<div class="col-md-12">
		<label>Afatet e provimit</label>
		<div class="afatet">
		<?php
		$afatet = $lidhja->query("SELECT * FROM afatet");
		foreach($afatet as $afati){
			if($afati['active'] == 1){
				echo '<a data-toggle="modal" data-target=".afati-'.$afati['id'].'" class="btn btn-success">'.$afati['emri'].'</a>';
			}
			else{
				echo '<a data-toggle="modal" data-target=".afati-'.$afati['id'].'" class="btn btn-danger">'.$afati['emri'].'</a>';
			}
				echo '
					<div class="modal fade afati-'.$afati['id'].'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-sm">
					    <div class="modal-content">
					      <form role="form" action="menaxhimi.php?afati='.$afati['id'].'" method="POST">
					      	<div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title">Afati</h4>
						      </div>
						      <div class="modal-body">
						      <div class="row">
						      	<div class="form-group col-md-12">
						      		<label class="control-label" for="emri">Emri</label>
						      		<input type="text" name="emri" id="emri" value="'.$afati['emri'].'" class="form-control"/>
						      	</div>
						      	<div class="form-group col-md-12">
						      		<label for="enabled" class="control-label">Aktivizimi</label>
						      		<select name="enabled" id="enabled" class="form-control">';
						      			if($afati['active']==1){
						      				echo '<option value="1" selected>Aktiv</option>';
						      				echo '<option value="0">Ndalur</option>';
						      			}
						      			else{
						      				echo '<option value="1">Aktiv</option>';
						      				echo '<option value="0" selected>Ndalur</option>';
						      			}
						echo'  		</select>
						      	</div>
						      	<div class="form-group col-md-12">
						      		<label for="data_fillimit">Data fillimit</label>
						      		<input type="date" value="'.$afati['data_fillimit'].'" class="form-control" name="data_fillimit" id="data_fillimit"/>
						      	</div>
						      	<div class="form-group col-md-12">
						      		<label for="data_mbarimit">Data fillimit</label>
						      		<input type="date" value="'.$afati['data_mbarimit'].'" class="form-control" name="data_mbarimit" id="data_mbarimit"/>
						      	</div>
						      	<div class="form-group col-md-12">
						      		<label for="lloji">Lloji</label>
						      		<select name="lloji" id="lloji" class="form-control">';

						      		if($afati['lloji']==1){
						      			echo '<option value="0" selected> Rregullt </option>	
						      				<option value="1"> Jo-rregullt </option>';
						      		}
						      		else{
						      			echo '<option value="0"> Rregullt </option>	
						      				<option value="1" selected> Jo-regullt </option>';
						      		}
						echo'  		</select>
								</div>
						      </div>
						      </div>
						      <div class="modal-footer">
						      	<a href="menaxhimi.php?fshiAfat='.$afati['id'].'" class="btn btn-danger">Fshije</a>
						        <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
						        <button type="submit" class="btn btn-primary">Ruaj</button>
						      </div>
					      </form>
					    </div>
					  </div>
					</div>';
		}

		?>
		<a data-toggle="modal" data-target=".shto-afat" class="btn btn-info"><i class="fa fa-plus"></i></a>
		<div class="modal fade shto-afat" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-sm">
					    <div class="modal-content">
					      <form role="form" action="menaxhimi.php?shtoafat=1" method="POST">
					      	<div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title">Afati</h4>
						      </div>
						      <div class="modal-body">
						      <div class="row">
						      	<div class="form-group col-md-12">
						      		<label class="control-label" for="emri">Emri</label>
						      		<input type="text" name="emri" id="emri" placeholder="afati" class="form-control"/>
						      	</div>
						      	<div class="form-group col-md-12">
						      		<label for="enabled" class="control-label">Aktivizimi</label>
						      		<select name="enabled" id="enabled" class="form-control">';
						      			<option value="1">Aktiv</option>';
						      			<option value="0" selected>Ndalur</option>
							  		</select>
						      	</div>
						      	<div class="form-group col-md-12">
						      		<label for="data_fillimit">Data fillimit</label>
						      		<input type="date" placeholder="YYYY/mm/dd" class="form-control" name="data_fillimit" id="data_fillimit"/>
						      	</div>
						      	<div class="form-group col-md-12">
						      		<label for="data_mbarimit">Data fillimit</label>
						      		<input type="date" placeholder="YYYY/mm/dd" class="form-control" name="data_mbarimit" id="data_mbarimit"/>
						      	</div>
						      	<div class="form-group col-md-12">
						      		<label for="lloji">Lloji</label>
						      		<select name="lloji" id="lloji" class="form-control">';
										<option value="0" selected> Rregullt </option>	
						      			<option value="1"> Jo-rregullt </option>
							  		</select>
								</div>
						      </div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
						        <button type="submit" class="btn btn-primary">Ruaj</button>
						      </div>
					      </form>
					    </div>
					  </div>
					</div>
		</div>
	</div>
</div>
<hr/>
<div class="row">
	<div class="col-md-6">
		<form role="form" id="page_info" action="menaxhimi.php" method="POST">
			<div class="form-group">
				<label for="title">Titulli</label>
				<input class="form-control" type="text" name="title" value='<?php echo $page->getTitle(); ?>' id="title" />
			</div>
			<div class="form-group">
				<label for="footer">Footer</label>
				<input type="text" value='<?php echo $page->getFooter(); ?>' class="form-control" id="footer" name="footer"/>
			</div>
			<div class="form-group">
				<input type="submit" name="title-footer-submit" value="Ruaj!" class="btn btn-md btn-primary"/>
			</div>
		</form>
	</div>
	<div class="col-md-6">
		<script type="text/javascript">
	        $(function() {
	            $('#onlineoffline').bind('submit', function(){
	                $.ajax({
	                    type: 'post',
	                    url: "menaxhimi.php",
	                    data: $("#onlineoffline").serialize(),
	                    success: function(info) {
	                        $('#onoff').html(info);
	                    }
	                });
	                return false;
	            });
	        });
	    </script>
		<form role="form" method="POST" action="menaxhimi.php" id="onlineoffline">
		<label> Aktivizimi i faqes </label>
			<div class="form-group" id="onoff">

			<?php
				if($page->isActivated() == 1){
					echo '<input type="hidden" name="online" value="1"/>
				<p class="bg-success text-left"><input name="online-offline-submit" id="faqjaOnline" type="submit" class="btn btn-md btn-primary" value="Online"/> Faqja &euml;sht&euml; aktive!<span class="glyphicon glyphicon-ok pull-right text-primary hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
				}
				else{
					echo '<input type="hidden" name="offline" value="1"/>
				<p class="bg-danger text-left"><input name="online-offline-submit" id="faqjaOnline" type="submit" class="btn btn-md btn-danger" value="Offline"/> Faqja &euml;sht&euml; e ndalur!<span class="glyphicon glyphicon-remove pull-right text-danger hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
				}
			?>
			</div>
		</form>
		 <script type="text/javascript">
	        $(function() {
	            $('#votimOnOff').bind('submit', function(){
	                $.ajax({
	                    type: 'post',
	                    url: "menaxhimi.php",
	                    data: $("#votimOnOff").serialize(),
	                    success: function(info) {
	                        $('#votim').html(info);
	                    }
	                });
	                return false;
	            });
	        });
	    </script>
		<form role="form" method="POST" id="votimOnOff">
		<label> Vler&euml;simi i profesor&euml;ve </label>
			<div class="form-group" id="votim">
			<?php
				if($page->getVleresimi() == 1){
					echo '<input type="hidden" name="votimOn" value="1"/>
				<p class="bg-success text-left"><button name="votimOnOff-submit" id="faqjaOnline" type="submit" class="btn btn-md btn-primary">Online</button> Vler&euml;simi &euml;sht&euml; aktiv!<span class="glyphicon glyphicon-ok pull-right text-primary hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
				}
				else{
					echo '<input type="hidden" name="votimOff" value="1"/>
				<p class="bg-danger text-left"><button name="votimOnOff-submit" id="faqjaOnline" type="submit" class="btn btn-md btn-danger">Offline</button> Vler&euml;simi &euml;sht&euml; ndalur!<span class="glyphicon glyphicon-remove pull-right text-danger hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
				}
			?>
			</div>
		</form>
	</div>
</div>
<hr/>
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">Fakultetet<a style="margin:-5px;" data-toggle="modal" data-target="#shtofakultet" href="menaxhimi.php?shto=fakultet" class="pull-right"><span class="btn btn-info glyphicon glyphicon-plus"></span></a></h3>
		  </div>
		  <div class="panel-body">
				<?php
					if($fakultetet = getFakultetet()){
						echo '<ul class="nav nav-pills nav-stacked">';
						foreach($fakultetet as $fakulteti){
							echo '<li><a data-toggle="modal" data-target="#fak'.$fakulteti['id'].'" href="menaxhimi.php?fakulteti='.$fakulteti['id'].'">'.$fakulteti['emri'].'</a></li>';
							echo '<div class="modal fade" id="fak'.$fakulteti['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									    </div>
									  </div>
									</div>';
						}
						echo '</ul>';
					}
					else{
						echo '<p class="bg-primary"> Nuk ka fakultete. </p>';
					}
				?>
		  </div>
		<div class="modal fade" id="shtofakultet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		    </div>
		  </div>
		</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">Drejtimet<a data-toggle="modal" data-target="#shtodrejtim" href="menaxhimi.php?shto=drejtim" style="margin:-5px;" href="#" class="pull-right"><span class="btn btn-info glyphicon glyphicon-plus"></span></a></h3>
		  </div>
		  <div class="panel-body">
		    	<?php
					if($drejtimet = getDrejtimet(0)){
						echo '<ul class="nav nav-pills nav-stacked">';
						foreach($drejtimet as $drejtimi){
							$alias = $lidhja->query("SELECT alias FROM fakulteti WHERE id=$drejtimi[f_id]");
							$alias = $alias->fetch_assoc();
							echo '<li><a data-toggle="modal" data-target="#d'.$drejtimi['id'].'" href="menaxhimi.php?drejtimi='.$drejtimi['id'].'">'.$drejtimi['emri'].'<span class="pull-right"><em>'.$alias['alias'].'</em></span></a></li>';
							echo '<div class="modal fade" id="d'.$drejtimi['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									    </div>
									  </div>
									</div>';
						}
						echo '</ul>';
					}
					else{
						echo '<p class="bg-primary"> Nuk ka drejtime. </p>';
					}
				?>
		  </div>
		  <div class="modal fade" id="shtodrejtim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		    </div>
		  </div>
		</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">P&euml;rdoruesit<a data-toggle="modal" data-target="#shtoperdorues" href="menaxhimi.php?shto=perdorues" style="margin:-5px;" href="#" class="pull-right"><span class="btn btn-info glyphicon glyphicon-plus"></span></a></h3>
		  </div>
		  <div class="panel-body">
		    	<?php
					if($perdoruesit = getPerdoruesit()){
						echo '<ul class="nav nav-pills nav-stacked">';
						foreach($perdoruesit as $p){
							echo '<li><a data-toggle="modal" data-target="#p'.$p['id'].'" href="menaxhimi.php?perdoruesi='.$p['id'].'">'.$p['emri'].' '.$p['mbiemri'].'<span class="pull-right"><em>'.$p['niveli'].'</em></span></a></li>';
							echo '<div class="modal fade" id="p'.$p['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <div class="modal-dialog modal-lg">
									    <div class="modal-content">
									    </div>
									  </div>
									</div>';
						}
						echo '</ul>';
					}
					else{
						echo '<p class="bg-primary"> Nuk ka drejtime. </p>';
					}
				?>
		  </div>
		  <div class="modal fade" id="shtoperdorues" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		    </div>
		  </div>
		</div>
		</div>
	</div>
</div>