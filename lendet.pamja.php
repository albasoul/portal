<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="assets/ico/favicon.jpg">
    <title>Portal 1.0</title>

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
	      <a class="navbar-brand" href="index.php"><?php echo $page->getTitle(); ?></a>
	    </div>
	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <?php $page->headerNavbar(); ?>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	</div>
    <div class="container">
		<div id="carousel-example-generic" class="carousel slide hidden-xs" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		  <?php
		  	for($i=0; $i<5; $i++)
		  	{
		  		if($i==0){ echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" class="active"></li>'; }
		  		else{
		  			echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'"></li>';
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
		    		echo '
			      <img alt="" src="'.$lajmi->getFoto().'">
			      <div class="carousel-caption col-md-4">
			        <h1>'. $lajmi->getTitulli(). '</h1>
			        <p>'.$lajmi->getBody().'</p>
			        <p><a href="'.$lajmi->getLink().'" class="btn btn-md btn-primary pull-right">Lexo më shumë</a></p>
			      </div>
			    </div>';
			    $i++;
		    	}
		    ?>
		    </div>
		  <!-- Controls -->
		  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left"></span>
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right"></span>
		  </a>
		</div>
		<div class="clearfix"></div><br/>
		<div class="row">
			<div class="col-md-3 user-info">
					<img class="img-circle" src="<?php echo $studenti->getFoto(); ?>" />
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
			</div>
			<div class="col-md-8 col-md-offset-1 lendet">
				<hr>
				<?php 
					/*
					* Lendet per qdo semester
					*/
					for ($i=$studenti->getSemestri(); $i > 0 ; $i--) {  // Ja nisim prej semestrit ma t'madh, dmth $i = $semestri i studentit e tani e zvoglojm $i
						$lendet = $lidhja->query("SELECT * FROM lendet WHERE semestri=$i");
						// Nese ka lende ne ate semester paraqitet forma me poshte
						// mujm me bo edhe: $lendet->num_rows > 0
						// e kom bo vetem: $lendet->num_rows, se kjo kthen numer pozitive nese ka rezultate, e qdo numer pozitiv osht True
						// nese kthen numer negativ, dmth 0, at'her False..
						if($lendet->num_rows){ 
							echo '<h2>L&euml;nd&euml;t e semestrit '.$i.'</h2>'; // Lendet e semestrit 4, Lendet e semestrit 3, etj.. 
							//
							//	per qdo Semester krijohet nga 1 tabel e re <table>.....
							//
							echo '
							<table class="table">
								<thead><tr><th>Emri</th><th>Kredi</th><th>Semestri</th><th>Nota</th><th>Data</th></tr></thead>
								<tbody>
								';
								//
								//	e shtijm ket Foreach mbrenda <table> </table>.. mos mu perserit tabela, vetem rreshtat mbrenda, dmth <tr></tr>
								//
									foreach($lendet as $l){ // Per secilen lende e bojm kodin ma posht
										$lenda = new Lenda($l['id']);
										if($nota = $studenti->getLendaKaluara($l['id'])){ //Nese ka kaluar merrja noten dhe ruje tek $nota.
											echo '<tr><td>'.$lenda->getEmri().'</td><td>'.$lenda->getKredi().'</td><td>'.$lenda->getSemestri().'</td><td>'.$nota['nota'].'</td><td>'.$nota['data'].'</td></tr>';
										}
										else{
											echo '<tr><td>'.$lenda->getEmri().'</td><td>'.$lenda->getKredi().'</td><td>'.$lenda->getSemestri().'</td><td></td><td></td></tr>';
										}
									}

							echo '</tbody>
							</table>';
						} // perfundon IF
					} // perfundon FOR loop per semestra
				?>
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