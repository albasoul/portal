<?php

	if(!empty($_GET['drejtimi']) && is_numeric($_GET['drejtimi'])){
		$_SESSION['d_id'] = $lidhja->real_escape_string($_GET['drejtimi']);
	}
	else{
		$_SESSION['d_id'] = 1;
	}
	if(!empty($_GET['fq']) && is_numeric($_GET['fq'])){
		$faqja = $lidhja->real_escape_string($_GET['fq']);
	}
	else{
		$faqja = 1;
	}
	if($studentetQuery = Studenti::getStudentet($_SESSION['d_id'],0)){
		$totalStudentet = $studentetQuery->num_rows;
		$total = ceil($totalStudentet/12);
	}
	else{
		$total = 0;
	}
?>
<div class="col-md-12">
	<span class="pull-right">
		<a data-toggle="modal" data-target="#shtoStudent" class="btn btn-md btn-primary"><span class="glyphicon glyphicon-plus"></span> Shto student&euml;</a>
		<!-- Modal -->
		<div class="modal fade" id="shtoStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		    <form action="menaxhimi.php?shto=student" method="POST" role="form">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Shto student&euml;</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="row">
			    	<div class="form-group col-md-3">
			    		<label for="SID" class="control-label">SID</label>
			    		<input type="number" id="SID" class="form-control" name="SID"/>
			    	</div>
			    	<div class="form-group col-md-3">
			    		<label for="emri" class="control-label">Emri</label>
			    		<input type="text" id="emri" class="form-control" name="emri"/>
			    	</div>
			    	<div class="form-group col-md-3">
			    		<label for="mbiemri" class="control-label">Mbiemri</label>
			    		<input type="text" id="mbiemri" class="form-control" name="mbiemri"/>
			    	</div>
			    	<div class="form-group col-md-3">
			    		<label for="email" class="control-label">e-mail</label>
			    		<input type="email" id="email" class="form-control" name="email"/>
			    	</div>
		    	</div>
		    	<div class="row">
		    		<div class="form-group col-md-4">
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
		    		<div class="form-group col-md-2">
		    			<label for="semestri" class="control-label">Semestri</label>
		    			<input type="number" class="form-control" name="semestri" id="semestri" />
		    		</div>
		    		<div class="form-group col-md-2">
		    			<label for="kredi" class="control-label">Kredi</label>
		    			<input type="number" class="form-control" name="kredi" id="kredi" />
		    		</div>
		    		<div class="form-group col-md-4">
		    			<label for="lokacioni" class="control-label">Adresa</label>
			    		<input type="text" id="lokacioni" class="form-control" name="lokacioni"/>
		    		</div>
		    	</div>
		    	<div class="row">
			      	<div class="form-group col-md-4">
			      		<label for="password1" class="control-label">Fjal&euml;kalimi</label>
			    		<input type="password" autocomplete="off" class="form-control" name="password1" id="password1" />
			      	</div>
			      	<div class="form-group col-md-4">
			      		<label for="password2" class="control-label">P&euml;rs&euml;rit fjal&euml;kalimin</label>
			    		<input type="password" autocomplete="off" class="form-control" name="password2" id="password2" />
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
<div class="col-md-9 studentet-menaxhim-majt">
	
	  <?php
	  	if($studentet = Studenti::getStudentet($_SESSION['d_id'],$faqja)){
	  		echo '<ul class="nav nav-pills">';
	  		foreach($studentet as $s){
	  			$studenti = new Studenti($s['SID']);
	  			echo '<li class="text-left col-md-4"><a data-toggle="modal" data-target="#ndryshoStudentin'.$studenti->getID().'" href="menaxhimi.php?ndryshoStudentin='.$studenti->getSID().'"><h4><strong>'.$studenti->getEmri().' ' .$studenti->getMbiemri(). '</strong></h4><span class="">'.$studenti->getSID().'</span> <abbr class="pull-right" title="Semestri">S'.$studenti->getSemestri().'</abbr></a></li>';
	  			echo '	<!--Modal-->
	  					<div class="modal fade" id="ndryshoStudentin'.$studenti->getID().'" tabindex="-1" role="dialog" aria-labelledby="Ndryshostudent" aria-hidden="true">
						  <div class="modal-dialog modal-lg">
						    <div class="modal-content">
						    </div>
						  </div>
						</div>';
	  		}
	  		echo '</ul>';
	  	}
	  	else{
	  		echo '<p class="bg-danger"> Nuk ka student&euml;. </p>';
	  	}

	  if($total>0){
	  	echo '<label class="pull-left" style="margin-top:23px; margin-right:10px;">Faqja</label> ';

	  	echo '<ul class="pagination">';
	  	for($i=1; $i<=$total;$i++){
	  		echo'<li><a href="index.php?faqja=studentet&drejtimi='.$_SESSION['d_id'].'&fq='.$i.'">'.$i.'</a></li>';
	  	}
	  	echo '</ul>';
	  }
	  ?>
</div>
<div class="col-md-3 studentet-menaxhim-djatht">
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
								echo '<li><a href="index.php?faqja=studentet&drejtimi='.$d['id'].'">'.$d['emri'].'</a></li>';
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
	</ul>
</div>