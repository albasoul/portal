<div class="col-md-12">
	<div class="col-md-6 panel panel-default" style="padding:0px;">
		<?php 
		echo '<form action="menaxhimi.php?ndryshoS='.$studenti->getID().'" role="form" method="POST">
				<div class="page-header text-center" style="font-size:20px;">
				<i class="fa fa-user"></i>  <strong>'.$studenti->getEmri().' '.$studenti->getMbiemri().'</strong>
			</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label class="control-label" for="sid">SID</label>
							<input type="number" class="form-control" name="SID" id="sid" value="'.$studenti->getSID().'"/>
						</div>
						<div class="form-group col-md-4">
							<label class="control-label" for="emri">Emri</label>
							<input type="text" class="form-control" name="emri" id="emri" value="'.$studenti->getEmri().'"/>
						</div>
						<div class="form-group col-md-4">
							<label class="control-label" for="mbiemri">Mbiemri</label>
							<input type="text" class="form-control" name="mbiemri" id="mbiemri" value="'.$studenti->getMbiemri().'"/>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label class="control-label" for="email">e-mail</label>
							<input type="text" class="form-control" name="email" id="email" value="'.$studenti->getEmail().'"/>
						</div>
						<div class="form-group col-md-6">
			    			<label for="lokacioni" class="control-label">Adresa</label>
				    		<input type="text" id="lokacioni" class="form-control" name="lokacioni" value="'.$studenti->getLokacioni().'"/>
			    		</div>
						
					</div>
					<div class="row">
						<div class="form-group col-md-3">
			    			<label for="semestri" class="control-label">Semestri</label>
			    			<input type="number" class="form-control" name="semestri" id="semestri" value="'.$studenti->getSemestri().'" />
			    		</div>
			    		<div class="form-group col-md-3">
			    			<label for="kredi" class="control-label">Kredi</label>
			    			<input type="number" class="form-control" name="kredi" id="kredi" value="'.$studenti->getKredi().'"/>
			    		</div>
			    		<div class="form-group col-md-6">
							<label for="drejtimi" class="control-label">Drejtimi</label>
		    				<select name="drejtimi" class="form-control" id="drejtimi">';
		    				if($drejtimet = getDrejtimet(0)){
		    					foreach($drejtimet as $d){
		    						if($d['id'] == $studenti->getDrejtimi()){
		    							echo '<option selected value="'.$d['id'].'">'.$d['emri'].'</option>';
		    						}
		    						else{
		    							echo '<option value="'.$d['id'].'">'.$d['emri'].'</option>';
		    						}
		    					}
		    				}
			echo'			</select>
						</div>
			    	</div>
					<div class="row">
				      	<div class="form-group col-md-6">
				      		<label for="password1" class="control-label"><i class="fa fa-lock"></i> Fjal&euml;kalimi <abbr title="Fjal&euml;kalimi duhet t&euml; jet&euml; m&euml; i gjat&euml; se 5 karaktere"><i class="fa fa-info-circle"></i></abbr></label>
				    		<input type="password" autocomplete="off" class="form-control" name="password1" id="password1" />
				      	</div>
				      	<div class="form-group col-md-6">
				      		<label for="password2" class="control-label"><i class="fa fa-lock"></i> P&euml;rs&euml;rit fjal&euml;kalimin</label>
				    		<input type="password" autocomplete="off" class="form-control" name="password2" id="password2" />
				    	</div>
				    </div>
				<div class="col-md-12">
				<label>'.$studenti->getKredi().' kredi</label>
				<button type="submit" class="btn btn-primary pull-right">Ruaj</button>
				</div>
				<div class="clearfix"></div><br/>
			</form>';
		?>
	</div>
	<div class="col-md-6 studenti-djathti" style="padding-right:0px;">
			<div class="panel panel-default">
			<div class="page-header text-center">
				<strong>L&euml;nd&euml;t e paraqitura</strong>
			</div>
				<div class="panel-body" style="padding:0px;">
				<?php
					$SID = $studenti->getSID();
					  $lendetParaqitura = $lidhja->query("SELECT LID,nota FROM paraqitjet WHERE SID=$SID order by data");
					  if($lendetParaqitura->num_rows > 0){
					  	echo '<div class="list-group" style="margin-bottom:0px;">';
					  	foreach($lendetParaqitura as $l){
					  		$lenda = new Lenda($l['LID']);
					  		if($l['nota'] == 0){
					  			echo '<a class="list-group-item lendetParaqitura">'.$lenda->getEmri().'<span class="label label-primary pull-right hidden-xs">Paraqitur</span><span class="label label-primary visible-xs"><i class="fa fa-info"></i></span></a>';
					  		}
					  		elseif ($l['nota'] == 1) {
					  			echo '<a class="list-group-item lendetParaqitura">'.$lenda->getEmri().'<span class="label label-warning pull-right hidden-xs">Refuzim</span><span class="label label-warning visible-xs"><i class="fa fa-arrow-circle-down"></i></span></a>';
					  		}
					  		elseif($l['nota'] == 5){
					  			echo '<a class="list-group-item lendetParaqitura">'.$lenda->getEmri().'<span class="label label-danger pull-right hidden-xs">D&euml;shtim</span><span class="label label-danger visible-xs"><i class="fa fa-thumbs-o-down"></i></span></a>';
					  		}
					  		else{
					  			echo '<a class="list-group-item lendetParaqitura">'.$lenda->getEmri().'<span class="label label-success pull-right hidden-xs">Sukses</span><span class="label label-success visible-xs"><i class="fa fa-thumbs-o-up"></i></span></a>';
					  		}
					  	}
					  	echo '</div>';
					  }
					  else{
					  	echo '<p class="bg-primary text-center"> Nuk ka paraqitje </p>';
					  }
				?>
				</div>
			</div>
	</div>
</div>
		<div class="col-md-12 lendet-kaluara">
			<div class="panel panel-default">
				<div class="page-header text-center">
					<strong>L&euml;nd&euml;t e kaluara</strong>
				</div>
				<div class="panel-body" style="padding:0px;">
				<?php
					$lendetKaluara = $lidhja->query("SELECT lid,nota,data FROM notat WHERE sid=$SID order by data DESC");
					if($lendetKaluara->num_rows > 0){
						echo '<table class="table table-hover table-responsive" style="margin-bottom:0px;">';
						echo '<thead><tr><th><i class="fa fa-dot-circle-o"></i></th><th>L&euml;nda</th><th>Nota</th><th>Kredi</th><th>Semestri</th><th>Data</th></tr></thead>
							<tbody>';
						foreach ($lendetKaluara as $l) {
							$lenda = new Lenda($l['lid']);
							echo '<tr><td><strong>'.$lenda->getLloji().'</strong></td><td>'.$lenda->getEmri().'</td><td><strong>'.$l['nota'].'</strong></td><td>'.$lenda->getKredi().'</td><td>'.$lenda->getSemestri().'</td><td>'.rregulloDaten($l['data']).'</td></tr>';
						}
						echo '
							</tbody>
						</table>';
					}
					else{
						echo '<p class="bg-primary text-center"> Nuk ka l&euml;nd&euml; t&euml; kaluara. </p>';
					}
				?>
				</div>
			</div>
		</div>