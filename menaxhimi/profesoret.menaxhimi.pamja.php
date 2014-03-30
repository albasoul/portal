<?php
	if(!empty($_GET['lloji'])){
		$temp = $lidhja->real_escape_string($_GET['lloji']);
		if($temp == 'R' OR $temp=='A' OR $temp =='S' OR $temp =='L' OR $temp =='T'){
			$_SESSION['ch'] = $temp;
		}
		else{
			$_SESSION['ch'] = 'R';
		}
	}
	else{
		$_SESSION['ch'] = 'R';
	}
?>
<div class="row">
	<div class="col-md-8">
		<ul class="list-inline">
		<?php 
			$rolet = array('R' => 'I rregullt', 'A'=>'Asistent', 'L'=> 'Ligj&euml;rues', 'S'=>'Asociuar', 'T' => 'T&euml; gjith&euml;'); 
			foreach($rolet as $shkronja => $dmth){
				if($_SESSION['ch'] == $shkronja){
					echo '<li><a class="btn btn-primary" href="index.php?faqja=profesoret&lloji='.$shkronja.'">'.$dmth.'</a></li>';
				}
				else{
					echo '<li><a class="btn btn-default" href="index.php?faqja=profesoret&lloji='.$shkronja.'">'.$dmth.'</a></li>';
				}
			}
		?>
		</ul>
	</div>
	<div class="col-md-4">
		<a data-toggle="modal" data-target="#shtoProfesor" class="btn btn-md btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span> Shto profesor&euml; </a>
		<!-- Modal -->
		<div class="modal fade" id="shtoProfesor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		    <form action="menaxhimi.php?shto=profesor" method="POST" role="form">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Shto profesor&euml;</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="row">
			    	<div class="form-group col-md-6">
			    		<label for="emri">Emri</label>
			    		<input type="text" class="form-control" placeholder="emri profesorit" name="emri" id="emri" />
			    	</div>
			    	<div class="form-group col-md-6">
			    		<label for="mbiemri">Mbiemri</label>
			    		<input type="text" class="form-control" placeholder="mbiemri profesorit" name="mbiemri" id="mbiemri" />
			    	</div>
			    </div>
			    <div class="row">
			    	<div class="form-group col-md-6">
			    		<label for="email"><span class="glyphicon glyphicon-envelope"></span> e-mail</label>
			    		<input type="email" class="form-control" placeholder="email@uppz.net" name="email" id="email" />
			    	</div>
			    	<div class="form-group col-md-3">
			    		<label for="lloji" class="control-label"><span class="glyphicon glyphicon-bookmark"></span> Roli</label>
			    		<select name="lloji" id="lloji" class="form-control">
			    	<?php $rolet = array('R' => 'I rregullt', 'A'=>'Asistent', 'L'=> 'Ligj&euml;rues', 'S'=>'Asociuar'); 
			    		foreach($rolet as $shkronja=>$dmth){
			    			echo '<option value="'.$shkronja.'">'.$dmth.'</option>';
			    		}
			    	?>
			    		</select>
			    	</div>
			    	<div class="form-group col-md-3">
			    		<label for="gjinia" class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Gjinia</label>
			    		<select name="gjinia" id="gjinia" class="form-control">
			    			<option value="M">M</option>
			    			<option value="F">F</option>
			    		</select>
			    	</div>
			    </div>
			    <div class="row">
			    	<div class="form-group col-md-7">
			    		<label for="lokacioni" class="control-label"><span class="glyphicon glyphicon-home"></span> Lokacioni</label>
			    		<input type="text" name="lokacioni" id="lokacioni" class="form-control" />
			    	</div>
			    	<div class="form-group col-md-5">
			    		<label for="tel" class="control-label"><span class="glyphicon glyphicon-earphone"></span> Tel.</label>
			    		<input type="text" name="tel" id="tel" class="form-control" />
			    	</div>
			    </div>
			    <div class="row">
			    	<div class="form-group col-md-6">
			    		<label for="password" class="control-label"><span class="glyphicon glyphicon-lock"></span> Fjal&euml;kalimi</label>
			    		<input type="password" autocomplete="off" name="password" id="password" class="form-control" />
			    	</div>
			    	<div class="form-group col-md-6">
			    		<label for="password1" class="control-label"><span class="glyphicon glyphicon-lock"></span> P&euml;rs&euml;rit fjal&euml;kalimin</label>
			    		<input type="password" name="password1" id="password1" class="form-control" />
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
<div class="row profesoret-menaxhim">
	<?php
		if($profesoret = Profesor::getProfesoret($_SESSION['ch'])){
			echo '<ul class="nav nav-pills">';
			foreach($profesoret as $p){
				$prof = new Profesor($p['id']);
				echo '
				  <li class="col-md-4 text-center"><a data-toggle="modal" data-target="#ndryshoProf'.$prof->getID().'" href="menaxhimi.php?ndryshoProf='.$prof->getID().'"><h4>'.$prof->getEmri().' '.$prof->getMbiemri().'</h4></a></li>
				';
				echo '	<!--Modal-->
	  					<div class="modal fade" id="ndryshoProf'.$prof->getID().'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						    </div>
						  </div>
						</div>';
			}
			echo '</ul>';
		}
		else{
			echo '<p class="bg-danger"> Nuk ka profesor&euml;. </p>';
		}
	?>
</div>