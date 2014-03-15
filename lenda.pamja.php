<?php
global $lidhja;

/*
* Duhet me kontrollu qe studenti te mos kyqet te naj land tjeter perveq semestrave te tij..........
*/
$l_id = $lidhja->real_escape_string($_GET['id']);
$drejtimi = $studenti->getDrejtimi();
$semestri = $studenti->getSemestri();
$lenda = $lidhja->query("SELECT * FROM lendet WHERE id=$l_id AND semestri<=$semestri AND drejtimi=$drejtimi") or die('<p>Kerkesa refuzohet.</p><a href="index.php">Kthehuni mbrapa.</a>');
if($lenda->num_rows){
	$lenda = new Lenda($l_id);
	$lejo = TRUE;
}
else{
	$lejo = FALSE;
}
?>
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
    <?php 
    if($lejo){
    	$prof = new Profesor($lenda->getProfID());
    	echo' <div class="jumbotron text-center">
		  <h1>'. $lenda->getEmri() .'<em> '.$prof->getEmri().' '.$prof->getMbiemri().'</em></h1>
		</div>';
    }
    ?>
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
			<div class="col-md-8 col-md-offset-1 ligjeratat">
			<?php if(!$lejo){ 
				echo '<p> Nuk ju lejohet te keni qasje ne lende te drejtimeve/semestrave t&euml; tjer&euml;.</p>';
			} 
			else {?>
				<div class="list-group">
				  <a href="ligjerata.php" class="list-group-item">
				    <h4 class="list-group-item-heading">L1 - Hyrje ne aplikime</h4>
				    <p class="list-group-item-text text-right"><em class="text-danger">16-03-2014</em> <small class="text-info">2.3MB</small></p>
				  </a>
				  <a href="ligjerata.php" class="list-group-item">
				    <h4 class="list-group-item-heading">L2 - Hyrje ne aplikime</h4>
				    <p class="list-group-item-text text-right"><em class="text-danger">15-03-2014</em> <small class="text-info">2.1MB</small></p>
				  </a>
				  <a href="ligjerata.php" class="list-group-item">
				    <h4 class="list-group-item-heading">L3 - Hyrje ne aplikime</h4>
				    <p class="list-group-item-text text-right"><em class="text-danger">14-03-2014</em> <small class="text-info">3.3MB</small></p>
				  </a>
				  <a href="ligjerata.php" class="list-group-item">
				    <h4 class="list-group-item-heading">L4 - Hyrje ne aplikime</h4>
				    <p class="list-group-item-text text-right"><em class="text-danger">13-03-2014</em> <small class="text-info">5.3MB</small></p>
				  </a>
				  <a href="ligjerata.php" class="list-group-item">
				    <h4 class="list-group-item-heading">L5 - Hyrje ne aplikime</h4>
				    <p class="list-group-item-text text-right"><em class="text-danger">12-03-2014</em> <small class="text-info">1.3MB</small></p>
				  </a>
				  <a href="ligjerata.php" class="list-group-item">
				    <h4 class="list-group-item-heading">L6 - Hyrje ne aplikime</h4>
				    <p class="list-group-item-text text-right"><em class="text-danger">11-03-2014</em> <small class="text-info">2.1MB</small></p>
				  </a>
				</div>
			<?php } ?>
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