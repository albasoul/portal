<?php
	# perfshije config.php
	include('includes/config.php');
if(!empty($_GET['id']) && $_GET['id'] > 0){
	$id = $lidhja->real_escape_string($_GET['id']);
	$ligjerata = new Ligjerata($id);
	$lenda = new Lenda($ligjerata->getLID());
	$studenti = new Studenti($_SESSION['s_id']);
	if($lenda->getDrejtimi() != $studenti->getDrejtimi()){
		$lejo = FALSE;
	}
	elseif( !($lenda->getSemestri() <= $studenti->getSemestri()) ) {
		$lejo = FALSE;
	}
	else{
		$lejo = TRUE;
	}
}
else{
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
	      <a class="navbar-brand" href="index.php">"Ukshin Hoti"</a>
	    </div>
	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li class="active"><a href="lendet.php">Lendet</a></li>
	        <li><a href="gazeta.php">Gazeta</a></li>
	        <li><a href="lajmet.php">Lajmet</a></li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	</div>
    <div class="container">
    	<div class="jumbotron text-center">
		  <h1>Programimi i aplikacioneve per servere - <em>Ilir Bytyqi</em></h1>
		  <p>Ligjerata 1 - Hyrje ne Aplikim</p>
		</div>
		<div class="row">
		<?php
			if($lejo){
				echo '<p>&Ccedilasja nuk lejohet. <a href="index.php?faqja=lendet" class="btn btn-link">Kthehu mbrapa.</a></p>';
			}
			else{
				echo '<div class="col-md-12">
				<iframe src="https://docs.google.com/viewer?url=http://research.google.com/archive/bigtable-osdi06.pdf&amp;embedded=true" width="100%" height="700px" style="border: none;"></iframe>
			</div>';
			}
		?>
		</div>
		<br/>
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