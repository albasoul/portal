<?php
	# perfshije config.php
	include('includes/config.php');
	if(!empty($_GET['id'])){
		$id = $lidhja->real_escape_string($_GET['id']);
		$lajmi = new Lajmi($id);
		$page = new Page();
	}
	else{
		header('Location: index.php?faqja=lajmet');
		die();
	}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="assets/ico/favicon.jpg">
    <title><?php echo $lajmi->getTitulli(); ?></title>
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

		
		<div class="clearfix"></div><br/>
		<div class="row">
			<div class="col-md-8 lajmi">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><strong><?php echo $lajmi->getTitulli(); ?></strong></h3>
						<p><span class="pull-right"><em><?php echo rregulloDaten($lajmi->getData()); ?></em></span></p>
					</div>
					<div class="panel-body">
					<?php 
						if($lajmi->getFoto()){
							echo '<div class="col-md-4"><img src="'.$lajmi->getFoto().'" class="img-responsive"/></div>';
							echo '<div class="col-md-8"><p>'.$lajmi->getBody().'</p></div>';
						}
						else{
							echo '<div class="col-md-12"><p>'.rregulloLajmin($lajmi->getBody()).'</p></div>';
						}
					?>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<?php
					$lajmet = $lidhja->query("SELECT id FROM lajmet ORDER BY data DESC LIMIT 10");
					if($lajmet->num_rows){
						echo '<div class="list-group" id="lajmetShtese">';
						foreach($lajmet as $l){
							$lajmi2 = new Lajmi($l['id']);
							if($lajmi->getID() == $lajmi2->getID()){
								echo '<a href="lajmi.php?id='.$lajmi2->getID().'" class="list-group-item active">'.substr($lajmi2->getTitulli(), 0,100).'...</a>';
							}
							else{
								echo '<a href="lajmi.php?id='.$lajmi2->getID().'" class="list-group-item">'.substr($lajmi2->getTitulli(), 0,100).'...</a>';
							}
						}
						echo '</div>';
					}
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