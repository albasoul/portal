<?php 
	include($_SERVER['DOCUMENT_ROOT'].'/portal/includes/config.php');
	if(!Perdorues::loggedIn()){
		header('Location: kyqja.php');
		die();
	}
	$page = new Page();
	if(!empty($_GET['faqja'])){
		$faqja = $lidhja->real_escape_string($_GET['faqja']);
	}
	else{
		header('Location: index.php?faqja=index');
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    
    <script src="../js/summernote.js"></script>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="../js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <br/>
  	<nav class="navbar navbar-default" role="navigation">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menaxhimi">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	     <a class="navbar-brand" href="index.php"><img src="<?php echo '../'.$page->getLogo(); ?>"/><?php echo $page->getTitle(); ?></a>
	    </div>
	    <div class="collapse navbar-collapse" id="menaxhimi">
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="logout.php">Dil</a></li>
	      </ul>
	      <form class="navbar-form navbar-left" role="search">
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="Search">
	        </div>
	        <button type="submit" class="btn btn-link"><span class="glyphicon glyphicon-search"></span></button>
	      </form>
	     </div>
	  </div>
	</nav><!-- Perfundon Navbar -->
	<div class="row">
	 	<div class="col-md-2 menaxhim-majt">
		  	<ul class="nav nav-pills nav-stacked">
				<li class="<?php if($faqja === "index") echo "active"; ?> text-center"><a href="index.php?faqja=index"><span class="glyphicon glyphicon-home pull-left"></span> Home</a></li>
				<li class="<?php if($faqja === "menaxhimi") echo "active"; ?> text-center"><a href="index.php?faqja=menaxhimi"><span class="glyphicon glyphicon-cog pull-left"></span> Menaxhimi</a></li>
				<li class="<?php if($faqja === "lajmet") echo "active"; ?> text-center"><a href="index.php?faqja=lajmet"><span class="glyphicon glyphicon-bullhorn pull-left"></span> Lajmet</a></li>
				<li class="<?php if($faqja === "studentet") echo "active"; ?> text-center"><a href="index.php?faqja=studentet"><span class="glyphicon glyphicon-user pull-left"></span> Student&euml;t</a></li>
		  		<li class="<?php if($faqja === "lendet") echo "active"; ?> text-center"><a href="index.php?faqja=lendet"><span class="glyphicon glyphicon-book pull-left"></span> L&euml;nd&euml;t</a></li>
		  		<li class="<?php if($faqja === "profesoret") echo "active"; ?> text-center"><a href="index.php?faqja=profesoret"><span class="glyphicon glyphicon-user pull-left"></span> Profesor&euml;t</a></li>
		  		<li class="<?php if($faqja === "vleresimi") echo "active"; ?> text-center"><a href="index.php?faqja=vleresimi"><span class="glyphicon glyphicon-stats pull-left"></span> Vler&euml;simi</a></li>
		  		<li class="<?php if($faqja === "paraqitja") echo "active"; ?> text-center"><a href="index.php?faqja=paraqitja"><span class="glyphicon glyphicon-th-list pull-left"></span> Paraqitja</a></li>
			</ul>
	 	</div>
	  	<div class="col-md-9 menaxhim-djathti">
	  		<div class="panel panel-default">
	  			<div class="panel-body">
	  			<?php
	  				if($faqja === "index"){
						include('index.menaxhimi.pamja.php');
					}
					elseif($faqja === "menaxhimi"){
						include('menaxhimi.pamja.php');
					}
					elseif($faqja === "lajmet"){
						include('lajmet.menaxhimi.pamja.php');
					}
					elseif($faqja === "studentet"){
						include('studentet.menaxhimi.pamja.php');
					}
					elseif($faqja === "lendet"){
						include('lendet.menaxhimi.pamja.php');
					}
					elseif($faqja === "profesoret"){
						include('profesoret.menaxhimi.pamja.php');
					}
					elseif($faqja === "vleresimi"){
						include('vleresimi.menaxhimi.pamja.php');
					}
					elseif($faqja === "paraqitja"){
						include('paraqitja.menaxhimi.pamja.php');
					}
					else{
						header('Location: index.php?faqja=index');
						die();
					}
	  			?>
				</div>
				<div class="panel-footer text-center"><?php echo $page->getFooter(); ?></div>
	  		</div>
		</div>
	 </div>
  </body>
</html>