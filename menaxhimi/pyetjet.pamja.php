<?php
$pyetjet = $lidhja->query("SELECT * FROM pyetjet");
echo '<div class="col-md-12 pyetjet">';
echo '<p class="text-right"><a href="index.php?faqja=vleresimi" class="pull-left btn btn-info"><i class="fa fa-angle-double-left"></i> Kthehu</a><a data-toggle="modal" data-target="#shtoPyetje" class="btn btn-info"><i class="fa fa-plus"></i> Shto pyetje</a></p>';
echo '
<!-- Modal -->
<div class="modal fade" id="shtoPyetje" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form role="form" action="menaxhimi.php?shtoPyetje=1" method="POST">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Shto pyetje</h4>
      </div>
      <div class="modal-body">
        <div class="row">
	      	<div class="form-group col-md-12">
	      		<label class="control-label" for="pyetja">Pyetja</label>
	      		<input type="text" class="form-control" placeholder="pyetja..." id="pyetja" name="pyetja"/>
	      	</div>
	      	<div class="form-group col-md-6">
	      		<label class="control-label" for="lloji">Lloji</label>
	      		<select name="lloji" class="form-control" id="lloji">
	      			<option value="0" selected>Pyetje</option>
	      			<option value="1">Koment</option>
	      		</select>
	      	</div>
	      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
        <button type="submit" class="btn btn-primary">Ruaj</button>
      </div>
    </div>
   </form>
  </div>
</div>';
echo '<ul class="list-group">';
foreach($pyetjet as $p){
	if($p['lloji'] == 1){
		echo '<li class="list-group-item"><i class="fa fa-comment"></i> '.$p['pyetja'].' <span class="pull-right"><a data-toggle="modal" data-target="#pyetja-'.$p['id'].'" class="btn btn-md btn-default"><i class="fa fa-pencil"></i></a> <a data-toggle="modal" data-target="#fshi-pyetja-'.$p['id'].'" class="btn btn-md btn-danger"><i class="fa fa-trash-o"></i></a></span></li>';
	}
	else{
		echo '<li class="list-group-item"><strong>?</strong> '.$p['pyetja'].' <span class="pull-right"><a data-toggle="modal" data-target="#pyetja-'.$p['id'].'" class="btn btn-md btn-default"><i class="fa fa-pencil"></i></a> <a data-toggle="modal" data-target="#fshi-pyetja-'.$p['id'].'" class="btn btn-md btn-danger"><i class="fa fa-trash-o"></i></a></span></li>';
	}

	echo '
	<!-- Modal -->
	<div class="modal fade" id="pyetja-'.$p['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	  <form action="menaxhimi.php?ndryshoPyetje='.$p['id'].'" method="POST" role="form">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">Ndrysho pyetjen</h4>
	      </div>
	      <div class="modal-body">
	      <div class="row">
	      	<div class="form-group col-md-12">
	      		<label class="control-label" for="pyetja">Pyetja</label>
	      		<input type="text" class="form-control" value="'.$p['pyetja'].'" id="pyetja" name="pyetja"/>
	      	</div>
	      	<div class="form-group col-md-6">
	      		<label class="control-label" for="lloji">Lloji</label>
	      		<select name="lloji" class="form-control" id="lloji">';
	      			if($p['lloji'] == 1){
	      				echo '
	      				<option value="1" selected>Koment</option>
	      				<option value="0">Pyetje</option>';
	      			}
	      			else{
	      				echo '
	      				<option value="1">Koment</option>
	      				<option value="0" selected>Pyetje</option>';
	      			}
	 echo' 		</select>
	      	</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
	        <button type="submit" class="btn btn-primary">Ruaj</button>
	      </div>
	    </div>
	  </form>
	  </div>
	</div>
	<!--Modal small -->
	<div class="modal" tabindex="-1" id="fshi-pyetja-'.$p['id'].'" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <form action="menaxhimi.php?fshiPyetje='.$p['id'].'" method="POST" role="form">
    	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">Fshi pyetjen</h4>
	    </div>
	    <div class="modal-body">
	    	<div class="row">
	    	<p class="text-center"><strong>'.$p['pyetja'].'</strong></p>
	    	</div>
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Anulo</button>
	        <button type="submit" class="btn btn-danger">Fshije</button>
	     </div>
	 </form>
    </div>
  </div>
</div>';
	
}
echo '</ul>';
echo '</div>';
?>