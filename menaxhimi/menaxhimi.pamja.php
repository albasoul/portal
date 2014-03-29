<?php

?>
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
				<p class="bg-success text-left"><input name="online-offline-submit" id="faqjaOnline" type="submit" class="btn btn-md btn-success" value="Online"/> Faqja &euml;sht&euml; aktive!<span class="glyphicon glyphicon-ok pull-right text-success hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
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
				<p class="bg-success text-left"><button name="votimOnOff-submit" id="faqjaOnline" type="submit" class="btn btn-md btn-success">Online</button> Vler&euml;simi &euml;sht&euml; aktiv!<span class="glyphicon glyphicon-ok pull-right text-success hidden-xs" style="font-size:20px;padding:5px;"></span></p>';
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
		<div class="panel panel-primary">
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
		<div class="panel panel-primary">
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
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">P&euml;rdorues&euml;t<a data-toggle="modal" data-target="#shtoperdorues" href="menaxhimi.php?shto=perdorues" style="margin:-5px;" href="#" class="pull-right"><span class="btn btn-info glyphicon glyphicon-plus"></span></a></h3>
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