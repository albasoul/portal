<?php
if(!empty($_GET['viti'])){
	$viti = $lidhja->real_escape_string($_GET['viti']);
}
else{
	$viti = date('Y');
}
if(!empty($_GET['muaji'])){
	$muaji = $lidhja->real_escape_string($_GET['muaji']);
}
else{
	$muaji = 0;
}
$lajmetID = Lajmi::getLajmetID($viti,$muaji);

if($muaji == 1){ $m = "Janar";} elseif($muaji == 2) { $m ="Shkurt";} elseif($muaji == 3) { $m ="Mars";} elseif($muaji == 4) { $m ="Prill";} elseif($muaji == 5) { $m ="Maj";}
 elseif($muaji == 6) { $m ="Qershor";}  elseif($muaji == 7) { $m ="Korrik";} elseif($muaji == 8) { $m ="Gusht";} elseif($muaji == 9) { $m ="Shtator";} elseif($muaji == 10) { $m ="Tetor";}
  elseif($muaji == 11) { $m ="N&euml;ntor";} elseif($muaji == 12) { $m ="Dhjetor";} else { $m="";}
?>
<script src="../js/summernote.js"></script>
<link href="../css/summernote.css" rel="stylesheet">
<div class="col-md-12">
	<div class="row">
		<label>Muaji</label>
		<ul class="list-unstyled menaxhim-arkiva">
			<?php echo paraqitArkiven($viti);?>
		</ul>
	</div>
	<br/>
	<div class="row">
		<label>Viti</label>
		<ul class="list-unstyled menaxhim-arkiva">
			<?php echo paraqitVitetEArkives();?>
		</ul>
	</div>
</div>
<div class="clearfix"></div>
<div class="page-header">
  <h1>Lajmet <small><?php echo $m . ' ' . $viti; ?></small> <button data-toggle="modal" data-target=".shtim-lajmi" class="pull-right btn btn-md btn-primary"><span class="glyphicon glyphicon-plus"></span> Shto lajm</button></h1>
</div>
						<!-- Modal -->
							<div class="modal shtim-lajmi fade text-left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="shtolajm" aria-hidden="true">
							  <div class="modal-dialog modal-lg">
							  <form action="menaxhimi.php?shto=lajm" enctype="multipart/form-data" role="form" class="form-horizontal" method="POST">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							        <h4 class="modal-title" id="shtolajm">Shto lajm</h4>
							      </div>
							      <div class="modal-body">
							           	<div class="form-group">
							        		<label for="titulli" class="col-sm-2 control-label">Titulli</label>
							        		<div class="col-sm-10">
							        			<input type="text" value="" class="form-control" autofocus name="titulli" placeholder="titulli i lajmit" id="titulli" />
							        		</div>
							        	</div>
							        	<div class="form-group">
							        		<label for="body" class="col-sm-2 control-label">Teksti</label>
							        		<div class="col-sm-10">
							        			<textarea name="permbajtja" class="permbajtja"></textarea>
							        		</div>
							        	</div>
							        	<div class="form-group">
							        		<label for="fotolajmit" class="col-sm-2 control-label">Fotografi</label>
							        		<div class="col-sm-10">
							        			<input type="file" class="form-control btn btn-default" style="outline:none; border:none;" name="fotografia" id="fotolajmit" accept="image/x-png, image/gif, image/jpeg" />
							        		</div>
							        	</div>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
							        <button type="submit" class="btn btn-primary">Ruaje</button>
							      </div>
							    </div>
							    </form>
							  </div>
							</div>
<div class="row lajmet-menaxhim">
	<?php
		if($lajmetID){

			foreach($lajmetID as $lajmet){
				$lajmi = new Lajmi($lajmet['id']);
				echo '
				<div class="col-md-6">
					<div class="list-group">
					  <a data-toggle="modal" data-target="#lajmi-'.$lajmi->getID().'" class="list-group-item">
					    <h4 class="list-group-item-heading">'.$lajmi->getTitulli().'</h4>
					  </a>
					</div>
				</div>';
				echo '
				<div class="modal fade" id="lajmi-'.$lajmi->getID().'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg">
							  <form action="menaxhimi.php?ndrysholajm='.$lajmi->getID().'" enctype="multipart/form-data" role="form" class="form-horizontal" method="POST">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							        <h4 class="modal-title" id="shtolajm">Data: '.rregulloDaten($lajmi->getData()).'</h4>

							      </div>
							      <div class="modal-body">
							        	<div class="form-group">
							        		<label for="titulli" class="col-sm-2 control-label">Titulli</label>
							        		<div class="col-sm-10">
							        			<input type="text" class="form-control" name="titulli" value=\''.$lajmi->getTitulli().'\' id="titulli" />
							        		</div>
							        	</div>
							        	<div class="form-group">
							        		<label for="body" class="col-sm-2 control-label">Teksti</label>
							        		<div class="col-sm-10">
							        			<textarea name="permbajtja" class="permbajtja">'.$lajmi->getBody().'</textarea>
							        		</div>
							        	</div>
							        	<div class="form-group">
							        		<label for="fotolajmit" class="col-sm-2 control-label">Fotografi</label>';
							        		if($lajmi->getFoto()){
							        			echo '
							        			<div class="col-sm-5">
							        				<img class="img-thumbnail img-responsive" src="../'.$lajmi->getFoto().'">
							        			</div>';
							        		}
							   echo'   		<div class="col-sm-5">
							        			<input type="file" class="form-control btn btn-default" style="outline:none; border:none;" name="fotografia" id="fotolajmit" accept="image/x-png, image/gif, image/jpeg" />
							        		</div>
							        	</div>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
							        <button type="submit" class="btn btn-primary">Ruaje</button>
							      </div>
							    </div>
							    </form>
							  </div>
				</div>';
				echo '';
			}

		}
		else{
			echo '<div class="col-md-6 text-center col-md-offset-3"><div class="alert alert-info">Nuk ka lajme!</div></div>';
		}
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".permbajtja").summernote({
				height: 300,   //set editable area\'s height
				focus: true    //set focus editable area after Initialize summernote
			});
		});
	</script>
</div>
