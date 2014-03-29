<script src="../js/summernote.js"></script>
<link href="../css/summernote.css" rel="stylesheet">
<link href="../css/font-awesome.css" rel="stylesheet">
					<div class="col-md-5">
					    <ul class="list-group">
						  <li class="list-group-item">
						    Student&euml; t&euml; regjistruar<span class="badge"><?php echo Studenti::getTotalStudentet(); ?></span>
						  </li>
						  <li class="list-group-item">
						    Profesor&euml; t&euml; regjistruar<span class="badge"><?php echo Profesor::getTotalProfesoret(); ?></span>
						  </li>
						  <li class="list-group-item">
						    L&euml;nd&euml; t&euml; regjistruara<span class="badge"><?php echo Lenda::getTotalLendet(); ?></span>
						  </li>
						  <li class="list-group-item">
						    Provimet e paraqitura<span class="badge">1244</span>
						  </li>
						  <li class="list-group-item">
						    Lajmet<span class="badge"><?php echo Lajmi::totalLajmet(); ?></span>
						  </li>
						</ul>
					</div>
					<div class="col-md-7">
						<div class="panel panel-default">
						  <div class="panel-heading">
						    <h3 class="panel-title">Lajmet e fundit</h3>
						  </div>
						  <div class="panel-body">
						  	<ul class="list-unstyled">
						    <?php
						    	$lajmetFundit = $lidhja->query("SELECT id FROM lajmet ORDER BY data DESC LIMIT 5");
						    	$i=1;
						    	foreach($lajmetFundit as $l){
						    		$lajmi = new Lajmi($l['id']);
						    		echo '<li><p><span class="text-primary"><strong>#'.$i++.'</strong></span> <a href="../lajmi.php?id='.$lajmi->getID().'">'.$lajmi->getTitulli().'</a></p></li>';
						    	}
						    ?>
						    </ul>
						  </div>
						  <div class="panel-footer text-right"><a class="pull-left" href="index.php?faqja=lajmet"><span class="glyphicon glyphicon-new-window"></span> Shiko t&euml; gjitha</a>
						  <button data-toggle="modal" data-target=".shtim-lajmi" class="glyphicon glyphicon-plus btn btn-sm btn-primary"></button>

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
												<script type="text/javascript">
										          $(document).ready(function() {
										            $('.permbajtja').summernote({
										             	height: 300,   //set editable area's height
  														focus: true    //set focus editable area after Initialize summernote
										            });
										          });
										        </script>
						  </div>
						</div>
					</div>