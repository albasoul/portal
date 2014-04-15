<?php
	# perfshije config.php
	include('includes/config.php');

	//marrim ID e ligjerates
if(!empty($_GET['id']) && is_numeric($_GET['id'])){
	$id = $lidhja->real_escape_string($_GET['id']);
	$ligjerata = new Ligjerata($id); // Krijojm 1 ligjerat permes Klases per ligjerata
	$lenda = new Lenda($ligjerata->getLID()); // Krijojm Lenden nga klasa lenda.class
	$studenti = new Studenti($_SESSION['s_id']); // Krijojm Studentin nga klasa studenti.class
	$profesori = new Profesor($ligjerata->getPID()); // Krijojm Profesorin nga klasa profesor.class
	$page = new Page(); // Krijojm objektin $page nga klasa Page.
	/*
	* Kontrollojm se a eshte ajo ligjerate e asaj ne lende, ne drejtimin e njejt me studentin ose ne semestrat qe studenti i ka kalu
	*/
	if($lenda->getDrejtimi() != $studenti->getDrejtimi()){ // kontrollojm lenden se a eshte ne drejtimin e njejt me studentin 
		$lejo = FALSE;
	}
	elseif( !($lenda->getSemestri() <= $studenti->getSemestri()) ) { // kontrollojm lenden se a eshte ne semestrin e njejt, ose me te vogel te studentit
		$lejo = FALSE;
	}
	else{
		$lejo = TRUE; // nese lenda
	}
}
else{
	header('Location: index.php');
	die();
}

if($page->isActivated() != 1){
		header('Location: index.php');
		die();
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $page->getTitle();?></title>
	<link rel="shortcut icon" href="../assets/ico/favicon.jpg">

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
	      <a class="navbar-brand" href="index.php"><img src="<?php echo $page->getLogo(); ?>"/><?php echo $page->getTitle(); ?></a>
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
		<div class="row">
			<div class="col-md-12">
			<?php
				if(!$lejo){
					echo '	<div class="alert alert-danger col-md-4 col-md-offset-4 text-center">&Ccedilasja nuk lejohet.
					 <a href="index.php?faqja=lendet" class="btn btn-link">Kthehu mbrapa.</a>
					</div>';
				}
				else{
					echo '	
					<ol class="breadcrumb">
					  <li><a href="index.php?faqja=lendet">Lendet</a></li>
					  <li><a href="index.php?faqja=lenda&id='.$lenda->getID().'">'.$lenda->getEmri().'</a></li>
					  <li class="active">'.$ligjerata->getEmri().'</li>
					</ol>
					<div class="jumbotron text-center">
							  <h1>'.$lenda->getEmri().' - <em>'. $profesori->getEmri() . ' ' . $profesori->getMbiemri().'</em></h1>
							  <p>'.$ligjerata->getAlias().' - '. $ligjerata->getEmri() .'</p>
							  <h4><small>Formati: </small>'.$ligjerata->getExtension().'</h4>
							  <h4><small>Madh&euml;sia: </small>'.$ligjerata->getMadhesia().'</h4>
							</div>';
								echo '<iframe src="http://docs.google.com/viewer?url=http://178.175.120.234/portal/'.$ligjerata->getLink().'&embedded=true" width="100%" height="780" style="border: none;">
								</iframe>';
					
					echo '<ul class="pager">';
					if($info = $ligjerata->kaLigjerat($ligjerata->getID(),"p",$lenda->getID(),$profesori->getID())) { // "p" = posht
						echo '<li class="previous"><a href="ligjerata.php?id='.$info[0].'">&larr; '.$info[1].'</a></li>';
					}
					else{
						echo '<li class="previous disabled"><a>&larr;</a></li>';
					}
					if($info = $ligjerata->kaLigjerat($ligjerata->getID(),"l",$lenda->getID(),$profesori->getID())) { // "l" = lart
						echo '<li class="next"><a href="ligjerata.php?id='.$info[0].'">'.$info[1].' &rarr;</a></li>';
					}
					else{
						echo '<li class="next disabled"><a>&rarr;</a></li>';
					}
					echo '</ul>';
				}
			?>
			</div>
		</div>
		<br/>
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