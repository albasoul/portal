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
    <link href="css/font-awesome.css" rel="stylesheet">
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
		  	<ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php" class="glyphicon glyphicon-log-out"></a></li>
			</ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	</div>
    <div class="container">
		<div class="clearfix"></div><br/>
		<?php
			if($afati = afatAktiv()){
				$data = date('Y-m-d');
				echo '<h3 class="text-center"><i class="fa fa-check-square-o"></i> <strong><em>'.$afati['emri'].'</em></strong></h3>';
				echo '<div class="well well-lg col-md-6 statusi-lendeve">';
				paraqitStatusinLendeve($studenti);
				echo '</div>';

				echo '<div class="col-md-6 paraqitja-provimeve">';
				if(paraqitjaPerfundoi($studenti)){
					echo '<h4 class="bg-primary text-center" style="padding:10px;"> Paraqitja e l&euml;nd&euml;ve &euml;sht&euml; kryer me sukses! </h4>';
				}
				elseif($data < $afati['data_fillimit'] OR $data > $afati['data_mbarimit']){
					echo '<h4 class="bg-danger text-center" style="padding:10px;"> Afati i paraqitjes s&euml; provimeve ka kaluar!</h4>';
				}
				else{
					if($afati['lloji'] == 0){ //nese eshte afat i rregullt
						
					}
					else{ //nese eshte afat jo-i-rregullt
						echo '<div class="alert alert-danger"><strong><small>Keni t&euml; drejt&euml; t&euml; b&euml;ni paraqitjen e vet&euml;m 2 l&euml;nd&euml;ve p&euml;r provim.</small></strong> </div>';
					}
					echo '	<div class="panel panel-primary">';
					echo '		<div class="panel-heading"><h3 class="panel-title">Paraqitja e provimeve</h3></div>';
					echo '		<div class="panel-body">';
								paraqitjaProvimeve($studenti);
					echo '
								</div>
							</div>';
				}
				echo '</div>';
				
			}
			else{
				echo '<h4 class="bg-primary text-center" style="padding:10px;"> Nuk ka afat aktiv t&euml; provimeve! </h4>';
			}
		?>
		<div class="row">
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
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
  </body>
</html>