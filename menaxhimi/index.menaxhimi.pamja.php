					<div class="page-header">
						<h1> Ballina <small>Informacione t&euml; p&euml;rgjithshme</small></h1>
					</div>

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
						  <div class="panel-footer text-right"><a class="pull-left" href=""><span class="glyphicon glyphicon-new-window"></span> Shiko t&euml; gjitha</a><a href="#"><span class="glyphicon glyphicon-plus btn btn-primary"></span></a></div>
						</div>
					</div>