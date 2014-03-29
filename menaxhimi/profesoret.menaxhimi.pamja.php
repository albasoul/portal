<div class="row profesoret-menaxhim">
	<?php
		if($profesoret = Profesor::getProfesoret()){
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