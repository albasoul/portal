<?php
global $lidhja;
if(!empty($_GET['faqe'])){
	$faqja = $lidhja->real_escape_string($_GET['faqe'])-1;
}
else{
	$faqja = 0;
}
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
	$muaji = date('m');
}
$perFaqe = 3; // Rezultatet per faqe , duhet me bo naj funksion qe me ndryshu kto prej Administratorit
$momentale = $faqja * $perFaqe;
$lajmetID = Lajmi::getLajmetID($momentale,$perFaqe,$viti,$muaji); // marrim ID e te gjitha lendeve, nese ska, behet FALSE!
$total = Lajmi::totalLajmet(); // numri total i lajmeve
$faqet = ceil($total/$perFaqe);
$page = new Page();
?>
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
	      <a class="navbar-brand" href="index.php"><?php echo $page->getTitle(); ?></a>
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
		<div class="row">
			<div class="col-md-8 col-md-offset-1 lajmet">
			<?php
			if($lajmetID){
				foreach($lajmetID as $lajmet){
					$lajmi = new Lajmi($lajmet['id']);
					echo '<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">'.$lajmi->getTitulli().'</h3>
								<p><span class="pull-right"><em>'.rregulloDaten($lajmi->getData()).'</em></span></p>
							</div>';
					echo 	'<div class="panel-body">';
						if($lajmi->getFoto()){
							echo '<div class="col-md-4"><img src="'.$lajmi->getFoto().'" class="img-responsive"/></div>';
							echo '<div class="col-md-8"><p>'.substr($lajmi->getBody(),0,200).'...</p></div>';
						}
						else{
							echo '<div class="col-md-12"><p>'.substr($lajmi->getBody(),0,200).'...</p></div>';
						}
					echo '	</div>';
					if($lajmi->getBody() && strlen($lajmi->getBody())>200) {
								echo '<div class="panel-footer text-center"><a href="#" >Lexo m&euml; shum&euml;</a></div>';
					}
					echo'  </div>';
				}
				echo '<ul class="pagination">';
				for($i=1; $i<=$faqet;$i++) echo' <li><a href="index.php?faqja=lajmet&faqe='.$i.'">'.$i.'</a></li>';
				echo '</ul>';
			}
			?>
			</div>
			<div class="col-md-2">
				<div class="panel panel-default">
				 	<div class="panel-body">
				 	<h3>Arkiva</h3>
						<ul class="list-unstyled">
							<li><a class="btn btn-link" href="#">Janar</a></li>
							<li><a class="btn btn-link" href="index.php?faqja=lajmet&viti<?php echo $viti; ?>&muaji=2">Shkurt</a></li>
							<li><a class="btn btn-link" href="index.php?faqja=lajmet&viti<?php echo $viti; ?>&muaji=3">Mars</a></li>
							<li><a class="btn btn-link" href="#">Prill</a></li>
							<li><a class="btn btn-link" href="#">Maj</a></li>
							<li><a class="btn btn-link" href="#">Qershor</a></li>
							<li><a class="btn btn-link" href="#">Korrik</a></li>
						</ul>
						<hr/>
						<h3>Viti</h3>
						<ul class="list-unstyled">
							<li><a class="btn btn-link" href="index.php?faqja=lajmet">2014</a></li>
							<li><a class="btn btn-link" href="#">2013</a></li>
							<li><a class="btn btn-link" href="#">2012</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- FOOTER -->
		<div class="well well-md text-center">
			<span class="pull-left"><a href="#">Administrata</a>&nbsp;&nbsp;&nbsp;<a href="#">Ndihm&euml;</a></span>
			<div class="visible-xs"><div class="clearfix"></div></div>
			<span>Copyright &copy;2014</span>
			<div class="visible-xs"><div class="clearfix"></div></div>
			<span class="pull-right"><a href="#">Kontakti</a>&nbsp;&nbsp;&nbsp;<a href="#"><span class="glyphicon glyphicon-log-out"></span></a></span>
		</div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
  </body>
</html>