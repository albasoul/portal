<?php
global $lidhja;
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
$lajmetID = Lajmi::getLajmetID($viti,$muaji); // marrim ID e te gjitha lendeve, nese ska, behet FALSE!
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
		<div class="row">
			<div class="col-md-8 col-md-offset-1 lajmet">
			<?php
			if($lajmetID){
				foreach($lajmetID as $lajmet){
					$lajmi = new Lajmi($lajmet['id']);
					echo '<div class="panel panel-primary">
							<div class="panel-heading" style="padding-bottom: 0px; ">
								<h3 class="panel-title">'.$lajmi->getTitulli().'</h3>
								<p class="text-right" style="margin-bottom: 0px; "><em>'.rregulloDaten($lajmi->getData()).'</em></p>
							</div>';
					echo 	'<div class="panel-body" style="padding-left:0px; padding-right:0px">';
						if($lajmi->getFoto()){
							echo '<div class="col-md-4"><img src="'.$lajmi->getFoto().'" class="img-responsive img-rounded"></img></div>';
							if(strlen($lajmi->getBody()) > 200){
								echo '<div class="col-md-8 lajm-trupi" style="margin-top: -15px; "><div class="clearfix"></div><p class="lajmi-rend">'.substr(strip_tags(html_entity_decode($lajmi->getBody())),0,200).'...</p><div class="clearfix"></div></div>';
							}
							else{
								echo '<div class="col-md-8 lajm-trupi" style="margin-top: -15px; "><div class="clearfix"></div><p class="lajmi-rend">'.strip_tags(html_entity_decode($lajmi->getBody())).'</p><div class="clearfix"></div></div>';
							}
							
						}
						else{
							if(strlen($lajmi->getBody()) > 200){
								echo '<div class="col-md-12 lajm-trupi" style="margin-top: -15px; "><div class="clearfix"></div><p class="lajmi-rend">'.substr(strip_tags(html_entity_decode($lajmi->getBody())),0,200).'...</p></div>';
							}
							else{
								echo '<div class="col-md-12 lajm-trupi" style="margin-top: -15px; "><div class="clearfix"></div><p class="lajmi-rend">'.strip_tags(html_entity_decode($lajmi->getBody())).'</p></div>';
							}
						}
					echo '	</div>';
					if($lajmi->getBody() && strlen($lajmi->getBody())>200) {
								echo '<div class="panel-footer text-center"><a href="lajmi.php?id='.$lajmi->getID().'" >Lexo m&euml; shum&euml;</a></div>';
					}
					echo'  </div>';
				}
			}
			else{
				echo '<div class="alert alert-info">Nuk ka lajme!</div>';
			}
			?>
			</div>
			<div class="col-md-2">
				<div class="panel panel-default">
				 	<div class="panel-body">
				 	<h3>Arkiva</h3>
						<ul class="list-unstyled">
						<!-- Paraqitja e arkives sipas muajve-->
							<?php paraqitArkiven($viti); ?>
						</ul>
						<hr/>
						<h3>Viti</h3>
						<ul class="list-unstyled">
						<!-- Paraqitja e arkives sipas muajve-->
							<?php paraqitVitetEArkives(); ?>
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