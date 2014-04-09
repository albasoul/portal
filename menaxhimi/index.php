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
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap-theme.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/font-awesome.css" rel="stylesheet">
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
	<div class="row">
	 	<div class="col-md-2 menaxhim-majt">
	 		<div class="row text-center"><img class="img-rounded" src="<?php echo '../'.$page->getLogo(); ?>"/></div>
	 		<br/>
		  	<ul class="nav nav-pills nav-stacked">
				<li class="<?php if($faqja === "index") echo "active"; ?> text-center"><a href="index.php?faqja=index"><span class="glyphicon glyphicon-home pull-left"></span> Home</a></li>
				<li class="<?php if($faqja === "menaxhimi") echo "active"; ?> text-center"><a href="index.php?faqja=menaxhimi"><span class="glyphicon glyphicon-cog pull-left"></span> Menaxhimi</a></li>
				<li class="<?php if($faqja === "lajmet") echo "active"; ?> text-center"><a href="index.php?faqja=lajmet"><span class="glyphicon glyphicon-bullhorn pull-left"></span> Lajmet</a></li>
				<li class="<?php if($faqja === "studentet") echo "active"; ?> text-center"><a href="index.php?faqja=studentet"><i class="fa fa-users pull-left"></i> Student&euml;t</a></li>
		  		<li class="<?php if($faqja === "lendet") echo "active"; ?> text-center"><a href="index.php?faqja=lendet"><span class="glyphicon glyphicon-book pull-left"></span> L&euml;nd&euml;t</a></li>
		  		<li class="<?php if($faqja === "profesoret") echo "active"; ?> text-center"><a href="index.php?faqja=profesoret"><i class="fa fa-users pull-left"></i>Profesor&euml;t</a></li>
		  		<li class="<?php if($faqja === "vleresimi") echo "active"; ?> text-center"><a href="index.php?faqja=vleresimi"><i class="fa fa-bar-chart-o pull-left"></i> Vler&euml;simi</a></li>
		  		<li class="<?php if($faqja === "paraqitja") echo "active"; ?> text-center"><a href="index.php?faqja=paraqitja"><span class="glyphicon glyphicon-th-list pull-left"></span> Paraqitja</a></li>
			</ul>
	 	</div>
	  	<div class="col-md-9 menaxhim-djathti">
	  	<br/>
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
					elseif($faqja === "pyetjet"){
						include('pyetjet.pamja.php');
					}
					elseif($faqja === "studenti"){
						if(!empty($_GET['sid']) && is_numeric($_GET['sid'])){
							$studenti = new Studenti($_GET['sid']);
							if($studenti->getEmri() !== "panjohur"){
								include('studenti.php');
							}
							else{
								header('Location: index.php?faqja=index');
								die();
							}
						}
						else{
							header('Location: index.php?faqja=index');
							die();
						}
					}
					else{
						header('Location: index.php?faqja=index');
						die();
					}
	  			?>
				</div>
				<div class="panel-footer text-center uni-pz"><?php echo $page->getTitle(); ?></div>
	  		</div>
		</div>
	 </div>
  </body>
</html>