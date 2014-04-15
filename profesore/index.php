<?php 
	include($_SERVER['DOCUMENT_ROOT'].'/portal/includes/config.php');
	if(!empty($_GET['logout']) && $_GET['logout']==="true"){
		session_destroy();
	}
	if(!Profesor::loggedIn()){
		header('Location: login.php');
		die();
	}
	$profesori = new Profesor($_SESSION['profesori']);
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
				<li class="<?php if($faqja === "paraqitjet") echo "active"; ?> text-center"><a href="index.php?faqja=paraqitjet"><i class="fa fa-users pull-left"></i> Paraqitjet</a></li>
		  		<li class="<?php if($faqja === "lendet") echo "active"; ?> text-center"><a href="index.php?faqja=lendet"><span class="glyphicon glyphicon-book pull-left"></span> L&euml;nd&euml;t</a></li>
			</ul>
	 	</div>
	  	<div class="col-md-9 menaxhim-djathti">
	  	<br/>
	  		<div class="panel panel-default">
	  			<div class="panel-body">
	  			<?php
	  				if($faqja === "index"){
						include('index.pamja.php');
					}
					elseif($faqja === "paraqitjet"){
						include('paraqitjet.pamja.php');
					}
					elseif($faqja === "lendet"){ //nese ka hy profi tek lendet e tij
						if(!empty($_GET['lenda']) && is_numeric($_GET['lenda'])){ //nese eshte caktuar lenda
							$lenda = new Lenda($_GET['lenda']);//krijojm lenden objekt
							$id_profave = $lenda->getProfID(); //marrim id e profesorave te asaj lende
							if(in_array($profesori->getID(), $id_profave)){ //nese ai profesor ekziston tek ajo lende, ne rregull
								if(!empty($_GET['ligjerata']) && is_numeric($_GET['ligjerata'])){
									if($lenda->getLigjeratat($profesori->getID())) {
										include('ligjerata.pamja.php');
									}
									else{
										include('lenda.pamja.php');
									}
								}
								else{
									include('lenda.pamja.php');
								}
							}
							else{
								header('Location: index.php');
								die();
							}
						}
						else{
							include('lendet.pamja.php');
						}
					}
					else{
						header('Location: index.php?faqja=index');
						die();
					}
	  			?>
				</div>
				<div class="panel-footer text-center uni-pz"><?php echo $page->getTitle(); ?><span class="pull-right"><a href="index.php?logout=true" class="btn btn-danger"><i class="fa fa-sign-out"></i></a></span><p></p></div>
	  		</div>
		</div>
	 </div>
  </body>
</html>