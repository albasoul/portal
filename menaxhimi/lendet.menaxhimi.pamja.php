<?php
	if(!empty($_GET['drejtimi']) && is_numeric($_GET['drejtimi'])){
		$_SESSION['d_id'] = $lidhja->real_escape_string($_GET['drejtimi']);
	}
	else{
		$_SESSION['d_id'] = 1;
	}
?>
<div class="col-md-12">
	<span class="pull-right">
		<a data-toggle="modal" data-target="#shtoLende" class="btn btn-md btn-primary"><span class="glyphicon glyphicon-plus"></span> Shto l&euml;nd&euml;</a>
		<!-- Modal -->
		<div class="modal fade" id="shtoLende" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		    <form action="menaxhimi.php?shto=lende" method="POST" role="form">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Shto l&euml;nd&euml;</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="row">
			    	<div class="form-group col-md-12">
			    		<label for="emri" class="control-label">Emri</label>
			    		<input type="text" id="emri" class="form-control" name="emri"/>
			    	</div>
			    </div>
			   	<div class="row">
			    	<div class="form-group col-md-6">
			    		<label for="drejtimi" class="control-label">Drejtimi</label>
			    		<select name="drejtimi" class="form-control" id="drejtimi">
			    			<?php
			    				if($drejtimet = getDrejtimet(0)){
			    					foreach($drejtimet as $d){
			    						echo '<option value="'.$d['id'].'">'.$d['emri'].'</option>';
			    					}
			    				}
			    		?>
			    		</select>
			    	</div>
			    	<div class="form-group col-md-6">
				    	<label for="profesori" class="control-label">Profesori</label>
			    		<select name="profesori" class="form-control" id="profesori">
			    		<?php
			    				if($profesoret = Profesor::getProfesoret('T')){
			    					foreach($profesoret as $p){
			    						echo '<option value="'.$p['id'].'">'.$p['emri'].' '.$p['mbiemri'].'</option>';
			    					}
			    				}
			    		?>
			    		</select>
			    	</div>
		    	</div>
		    	<div class="row">
		    		<div class="form-group col-md-2">
		    			<label for="semestri" class="control-label">Semestri</label>
		    			<input type="number" class="form-control" name="semestri" id="semestri" />
		    		</div>
		    		<div class="form-group col-md-2">
		    			<label for="kredi" class="control-label">Kredi</label>
		    			<input type="number" class="form-control" name="kredi" id="kredi" />
		    		</div>
		    		<div class="form-group col-md-3">
		    			<label for="lloji" class="control-label">Lloji</label>
		    			<select name="lloji" id="lloji" class="form-control">
		    				<option value="O">Obligative</option>
		    				<option value="Z">Zgjedhore</option>
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
	</span>
</div>
<div class="col-md-9 lendet-menaxhim-majt">
	<?php
		if($lendet = Lenda::getLendet($_SESSION['d_id'])){
			echo '<ul class="nav nav-pills">';
			foreach($lendet as $l){
				$lenda = new Lenda($l['id']);
				echo '<li class="col-md-6"><a data-toggle="modal" data-target="#ndryshoLenden'.$lenda->getID().'" href="menaxhimi.php?ndryshoLende='.$lenda->getID().'">'.$lenda->getEmri().'<span class="pull-right"><abbr title="Kredi">K</abbr>'.$lenda->getKredi().' <abbr title="Semestri">S</abbr>'.$lenda->getSemestri().'</span></a></li>';
				echo '	<!--Modal-->
	  					<div class="modal fade" id="ndryshoLenden'.$lenda->getID().'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						    </div>
						  </div>
						</div>';
			}
			echo '</ul>';
		}
		else{
			echo '<p class="bg-danger"> Nuk ka l&euml;nd&euml;. </p>';
		}
	?>
</div>
<div class="col-md-3 lendet-menaxhim-djatht">
		<?php
			if($fakultetet = getFakultetet()){
				echo '<ul class="list-unstyled">';
				foreach($fakultetet as $fk){
					echo '<li><h4>'.$fk['emri'].'</h4></li>';
					if($drejtimet = getDrejtimet($fk['id'])){
						echo '<ul class="list-unstyled drejtimet">';
						foreach($drejtimet as $d){
							if($_SESSION['d_id'] == $d['id']){
								echo '<li><a href=""><strong>'.$d['emri'].'</strong></a></li>';
							}
							else{
								echo '<li><a href="index.php?faqja=lendet&drejtimi='.$d['id'].'">'.$d['emri'].'</a></li>';
							}
						}
						echo '</ul>';
					}
				}
				echo '</ul>';
			}
			else{
				echo '<p class="bg-danger">Nuk ka fakultete</p>';
			}
		?>
</div>