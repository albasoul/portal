<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="assets/ico/favicon.jpg">
    <title><?php echo $page->getTitle(); ?></title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Stili i veqant -->
    <link href="css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <br/>
  <div class="container">
  	<nav class="navbar navbar-default" role="navigation">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="index.php"><img src="<?php echo $page->getLogo(); ?>"/><?php echo $page->getTitle(); ?></a>
	    </div>
	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	     	<?php $page->headerNavbar(); ?>
	      </ul>
		  	<ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php" class="glyphicon glyphicon-log-out"></a></li>
			</ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	</div>
    <div class="container">
    	<div id="portal-slide" class="carousel slide hidden-xs hidden-sm" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		  <?php
		  	for($i=0; $i<5; $i++)
		  	{
		  		if($i==0){ echo '<li data-target="#portal-slide" data-slide-to="'.$i.'" class="active"></li>'; }
		  		else{
		  			echo '<li data-target="#portal-slide" data-slide-to="'.$i.'"></li>';
		  		}
		  	}
		  ?>
		  </ol>
		  <!-- Wrapper for slides -->
		  <div class="carousel-inner">
		    <?php 
		    global $lidhja;
		    $lajmetQuery = $lidhja->query("SELECT id FROM lajmet ORDER BY data DESC LIMIT 5"); // i marrim 5 lajmet e fundit, sipas dates
		    $i=0;
		    	foreach($lajmetQuery as $l)
		    	{	
		    		$lajmi = new Lajmi($l['id']); // e thirrim klasen Lajmi, per me kriju 1 objekt te lajmit, edhe i thirrim funksionet, gettitulli,etj..
		    		# shtohet 1 if per me bo lajmin e par "0", me bo active, me dal i pari nlist..
		    		if($i == 0 ) {
		    			echo '<div class="item active">';
		    		}
		    		else{
		    			echo '<div class="item">';
		    		}
		    		if($lajmi->getFoto()){
		    			echo '<img alt="" class="img-responsive" src="'.$lajmi->getFoto().'">';
		    		}
		    		else{
		    			echo '<img alt="" src="http://www.transportenvironment.org/sites/te/files/styles/large/public/defaults/news_default.png">';
		    		}
				  echo '<div class="carousel-caption col-md-4">
				        <a href="lajmi.php?id='.$lajmi->getID().'"><h3>'. $lajmi->getTitulli(). '</h3></a>
				        <p>'.substr($lajmi->getBody(),0,145).'...</p>
				      </div>
				    </div>';
			    $i++;
		    	}
		    ?>
		    </div>
		  <!-- Controls -->
		  <a class="left carousel-control" href="#portal-slide" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left"></span>
		  </a>
		  <a class="right carousel-control" href="#portal-slide" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right"></span>
		  </a>
		</div>
		
		<div class="clearfix"></div><br/>
		<div class="row">
			<div class="col-md-3 user-info">
					<img class="img-circle hidden-sm hidden-xs" src="<?php echo $studenti->getFoto(); ?>" />
					<p class="emri"><?php echo $studenti->getEmri() . ' '. $studenti->getMbiemri();  ?></p>
					<p>Gjithsej kredi: <em><?php echo $studenti->getKredi(); ?></em></p>
					<hr class="hidden-xs">
					<table class="table table-hover text-left">
					<thead><tr><th>Emri</th><th>Kredi</th></tr></thead>
					<tbody><?php 
						# lendet vetem te atij semestri qe eshte edhe studenti..
						$lendet = getLendetMeSemester($studenti->getSemestri());
						foreach($lendet as $l){
							$lenda = new Lenda($l['id']);
echo '<tr>
							<td><a href="index.php?faqja=lenda&id='.$l['id'].'">'.$lenda->getEmri().'</a></td>
								<td>'.$lenda->getKredi().'</td>
							</tr>';
						}?>

					</tbody>
					</table>
					<div class="lajmet-fundit hidden-md hidden-lg">
					<label>Lajmet e fundit:</label>
						<div class="list-group">
						<?php
							foreach($lajmetQuery as $l){
								$lajmi = new Lajmi($l['id']);
								echo '<a href="lajmi.php?id='.$lajmi->getID().'" class="list-group-item">'. substr($lajmi->getTitulli(),0,90). '...</a>';
							}
						?>
						</div>
					</div>
			</div>
			<div class="col-md-8 col-md-offset-1 gazeta-news">
				<ul class="list-group">
				  <li class="list-group-item">
				  		<div class="row">
				  			<div class="col-md-2 col-xs-4">
				  				<a href="#" class="thumbnail">
				  					<img class="img-responsive" src="https://www.permajet.com/themes/default/images/uploads/default.png" />
				  				</a>
				  			</div>
				  			<div class="col-md-10 text-center">
				  				<h3> Titulli postimit te gazetes </h3>
				  				<p class="text-left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
				  				<p class="text-right"><a href="#">Lexo më shumë</a></p>
				  			</div>
				  		</div>
				  </li>
				  <li class="list-group-item">
				  	<div class="row">
				  			<div class="col-md-2 col-xs-4">
				  				<a href="#" class="thumbnail">
				  					<img class="img-responsive" src="https://www.permajet.com/themes/default/images/uploads/default.png" />
				  				</a>
				  			</div>
				  			<div class="col-md-10 text-center">
				  				<h3> Titulli postimit te gazetes </h3>
				  				<p class="text-left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
				  				<p class="text-right"><a href="#">Lexo më shumë</a></p>
				  			</div>
				  		</div>
				  </li>
				  <li class="list-group-item">
				  		<div class="row">
				  			<div class="col-md-2 col-xs-4">
				  				<a href="#" class="thumbnail">
				  					<img class="img-responsive" src="https://www.permajet.com/themes/default/images/uploads/default.png" />
				  				</a>
				  			</div>
				  			<div class="col-md-10 text-center">
				  				<h3> Titulli postimit te gazetes </h3>
				  				<p class="text-left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
				  				<p class="text-right"><a href="#">Lexo më shumë</a></p>
				  			</div>
				  		</div>
				  </li>
				  <li class="list-group-item">
				  		<div class="row">
				  			<div class="col-md-2 col-xs-4">
				  				<a href="#" class="thumbnail">
				  					<img class="img-responsive" src="https://www.permajet.com/themes/default/images/uploads/default.png" />
				  				</a>
				  			</div>
				  			<div class="col-md-10 text-center">
				  				<h3> Titulli postimit te gazetes </h3>
				  				<p class="text-left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
				  				<p class="text-right"><a href="#">Lexo më shumë</a></p>
				  			</div>
				  		</div>
				  </li>
				  <li class="list-group-item">
				  		<div class="row">
				  			<div class="col-md-2 col-xs-4">
				  				<a href="#" class="thumbnail">
				  					<img class="img-responsive" src="https://www.permajet.com/themes/default/images/uploads/default.png" />
				  				</a>
				  			</div>
				  			<div class="col-md-10 text-center">
				  				<h3> Titulli postimit te gazetes </h3>
				  				<p class="text-left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
				  				<p class="text-right"><a href="#">Lexo më shumë</a></p>
				  			</div>
				  		</div>
				  </li>
				</ul>
			</div>
		</div>
		<!-- FOOTER -->
		<div class="well well-md text-left">
			<span><?php echo $page->getFooter(); ?></span>
			<div class="visible-xs"><div class="clearfix"></div></div>
			<span class="pull-right">
				<?php $page->footerLinks(); ?>
			</span>
		</div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
  </body>
</html>