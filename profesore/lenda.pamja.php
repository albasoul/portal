<div class="col-md-12 profesor-ligjerata">
	<div class="page-header">
	  <h3><?php echo $lenda->getEmri(); ?> <small><?php if($lenda->getLloji() == "O") echo 'Obligative'; else echo 'Zgjedhore'; ?></small> <?php echo $lenda->getKredi(); ?><small>kredi</small></h3>
	</div>
	<?php
		$LID = $lenda->getID();
		$PID = $profesori->getID();
		$ligjeratat = $lidhja->query("SELECT id FROM ligjeratat WHERE id_l=$LID AND id_p=$PID ORDER by id");
	?>
	<ul class="nav nav-pills nav-stacked">
		<?php
			foreach($ligjeratat as $l){
				$ligjerata = new Ligjerata($l['id']);
				echo '<li class="profesor-ligjerata-all">
					<a class="col-md-6 emri" href="index.php?faqja=lendet&lenda='.$LID.'&ligjerata='.$ligjerata->getID().'">
						<strong>'.$ligjerata->getAlias().'</strong> - '.$ligjerata->getEmri().'
					</a>
					<span class="col-md-3 text-center" style="padding-top:10px;">'.rregulloDaten($ligjerata->getData()).'</span>
					<a class="col-md-1 text-center text-info" href="'.$ligjerata->getLink().'"><i class="fa fa-download"></i></a> 
					<a class="col-md-1 text-center" data-toggle="modal" data-target="#ndrysho-'.$ligjerata->getID().'"><i class="fa fa-pencil-square-o"></i></a>
					<a class="col-md-1 text-center text-danger" data-toggle="modal" data-target="#fshi-'.$ligjerata->getID().'"><i class="fa fa-trash-o"></i></a>
				</li>';
				// MODALI PER NDRYSHIM TE LIGJERATES
				echo '
				<div class="modal fade" id="ndrysho-'.$ligjerata->getID().'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				    <form action="ligjerata.php?ndryshoLigjerate='.$ligjerata->getID().'" enctype="multipart/form-data" method="POST" role="form">
				    <input type="hidden" name="LID" value="'.$lenda->getID().'"/>
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h4 class="modal-title" id="myModalLabel">Ndrysho ligj&euml;rat&euml;</h4>
				      </div>
				      <div class="modal-body">
				        <div class="row">
				        	<div class="form-group col-md-2">
				        		<label for="alias">Alias</label>
				        		<input type="text" class="form-control" name="alias" value="'.$ligjerata->getAlias().'" id="alias" />
				        	</div>
				        	<div class="form-group col-md-10">
				        		<label for="emri">Emri</label>
				        		<input type="text" class="form-control" name="emri" value="'.$ligjerata->getEmri().'" id="emri" />
				        	</div>
				        </div>
				        <div class="row">
				        	<p><label>Ligj&euml;rata: </label> <span class="text-primary">'.$ligjerata->getLink().'</span></p>
				        </div>
				        <div class="row">
				        	<div class="form-group col-md-12">
				        		<label for="ligjerata">Ngarko tjet&euml;r ligj&euml;rat&euml;</label>
				        		<input type="file" name="ligjerata" id="ligjerata" class="form-control" />
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
				// MODALI PER FSHIRJE TE LIGJERATES
				echo '
				<div class="modal fade" id="fshi-'.$ligjerata->getID().'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-sm">
				    <div class="modal-content">
				    <form action="ligjerata.php?fshijLigjerate='.$ligjerata->getID().'" method="POST" role="form">
				    <input type="hidden" name="LID" value="'.$lenda->getID().'"/>
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h4 class="modal-title" id="myModalLabel">Fshi ligj&euml;rat&euml;</h4>
				      </div>
				      <div class="modal-body">
				       	<p><strong>'.$ligjerata->getAlias().' - '.$ligjerata->getEmri().'</strong></p>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
				        <button type="submit" class="btn btn-danger">Fshije</button>
				      </div>
				     </form>
				    </div>
				  </div>
				</div>';
			}
		?>
	</ul>
	<br/>
	<p class="text-right"><a data-toggle="modal" data-target="#shtoligjerat" class="btn btn-info"><i class="fa fa-plus"></i> Shto ligj&euml;rat&euml;</a></p> <!--shto ligjerat-->
	<!-- Modal -->
	<div class="modal fade" id="shtoligjerat" tabindex="-1" role="dialog" aria-labelledby="shtoligjerat" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	    <form action="ligjerata.php?shtoligjerate=true" enctype="multipart/form-data" method="POST" role="form">
	    <input type="hidden" name="LID" value="<?php echo $lenda->getID(); ?>"/>
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="shtoligjerat">Shto ligj&euml;rat&euml;</h4>
	      </div>
	      <div class="modal-body">
	    	<div class="form-group col-md-3">
	    		<label for="alias">Alias</label>
	    		<input type="text" name="alias" id="alias" placeholder="L1" class="form-control"/>
	    	</div>
	    	<div class="form-group col-md-9">
	    		<label for="emri">Emri</label>
	    		<input type="text" name="emri" id="emri"  class="form-control"/>
	    	</div>
	    	<div class="form-group">
	    		<label for="ligjerata">Ligjerata</label>
	    		<input type="file" name="ligjerata" id="ligjerata" class="form-control"/>
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