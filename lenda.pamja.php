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
$profat = $lenda->getProfID();
if(!empty($_POST['profesori']) && is_numeric($_POST['profesori'])){
	$PID=$_POST['profesori'];
}
else{
	if(count($profat) > 1){

	}
	else{
		$PID = $profat[0];
	}
}

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
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	</div>
    <div class="container">
    <?php 
    if($lejo && count($profat)==1 || !empty($_POST['profesori'])){
    	$prof = new Profesor($PID);
    	echo' <div class="jumbotron text-center">
		  <h1>'. $lenda->getEmri() .' - <em> '.$prof->getEmri().' '.$prof->getMbiemri().'</em></h1>
		</div>';
    }
    ?>
		<div class="row">
			<div class="col-md-3 user-info hidden-xs hidden-sm">
					<img class="img-circle " src="<?php echo $studenti->getFoto(); ?>" />
					<p class="emri"><?php echo $studenti->getEmri() . ' '. $studenti->getMbiemri();  ?></p>
					<p>Gjithsej kredi: <em><?php echo $studenti->getKredi(); ?></em></p>
					<hr class="hidden-xs">
					<table class="table table-hover text-left">
					<thead><tr><th>Emri</th><th>Kredi</th></tr></thead>
					<tbody><?php 
						# lendet vetem te atij semestri qe eshte edhe studenti..
						$lendetSemestrit = getLendetMeSemester($studenti->getSemestri(), $studenti->getDrejtimi());
						foreach($lendetSemestrit as $l){
							$lendet = new Lenda($l['id']);
echo '<tr>
							<td><a href="index.php?faqja=lenda&id='.$l['id'].'">'.$lendet->getEmri().'</a></td>
								<td>'.$lendet->getKredi().'</td>
							</tr>';
						}?>

					</tbody>
					</table>
			</div>
			<div class="col-md-8 col-md-offset-1 ligjeratat">
			<?php if(!$lejo){ 
				echo '<p> Nuk ju lejohet &ccedilasja n&euml; lend&euml;.</p>';
			} 
			else{
				if(count($profat)==1 OR !empty($_POST['profesori'])){ // Nese eshte i caktuar profesori
					if($lenda->getLigjeratat($PID)){ // nese ka ligjerata
						$ligjeratat = $lenda->getLigjeratat($PID);
						echo '<div class="list-group">';
							foreach($ligjeratat as $l){ // krejt ligjeratat paraqiten
								$ligjerata = new Ligjerata($l['id']);
								echo '
									<a href="ligjerata.php?id='.$ligjerata->getID().'" class="list-group-item">
									    <h4 class="list-group-item-heading">'.$ligjerata->getAlias().' - '.$ligjerata->getEmri().'</h4>
										<p class="list-group-item-text pull-right hidden-xs" style="margin-top:-25px;"><em class="text-danger">'.$ligjerata->getExtension().'</em> <small class="text-info">'.$ligjerata->getMadhesia().'</small></p>
									</a>';
							}
						echo '</div>';
					}
					else{
						echo '<div class="alert alert-info">Nuk ka ligj&euml;rata n&euml; k&euml;t&euml; l&euml;nd&euml;.</div>';
					}
				}
				else{
					echo '<h4>Zgjedhni profesorin p&euml;r ti ndjekur ligj&euml;ratat.</h4>';
					echo'
					<form action="" method="POST" role="form">
						<div class="form-group col-md-8">
							<select name="profesori" id="profesori" class="form-control">';
							foreach($profat as $key => $id){
								$p = new Profesor($id);
								echo '<option value="'.$p->getID().'">'.$p->getEmri().' '.$p->getMbiemri().'</option>';
							}
					echo'	</select>
						</div>
						<div class="form-group col-md-4">
							<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-angle-double-right"></i></button>
						</div>
					</form>';
				}
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