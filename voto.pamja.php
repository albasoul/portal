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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
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
			<div class="col-md-3 user-info hidden-sm hidden-xs"> <!-- KTU FILLON paraqitja e anes se majte te antarit -->
					<img class="img-circle" src="<?php echo $studenti->getFoto(); ?>" />
					<p class="emri"><?php echo $studenti->getEmri() . ' '. $studenti->getMbiemri();  ?></p>
					<p>Gjithsej kredi: <em><?php echo $studenti->getKredi(); ?></em></p>
					<hr class="hidden-xs">
					<table class="table table-hover text-left">
					<thead><tr><th>Emri</th><th>Kredi</th></tr></thead>
					<tbody><?php 
						# lendet vetem te atij semestri qe eshte edhe studenti..
						$lendet = getLendetMeSemester($studenti->getSemestri(), $studenti->getDrejtimi());
						foreach($lendet as $l){
							$lenda = new Lenda($l['id']);
						echo '<tr>
								<td><a href="index.php?faqja=lenda&id='.$l['id'].'">'.$lenda->getEmri().'</a></td>
								<td>'.$lenda->getKredi().'</td>
							</tr>';
						}?>

					</tbody>
					</table>
			</div>
			<div class="col-md-8 col-md-offset-1 voto"> <!-- KTU FILLON paraqitja e anes se djathte per votim -->
				<form class="form" role="form" action="voto.php" method="POST">
					<?php
					$i=0;
						foreach($lendet as $l){
							/*
							* Krijojm 2 objektet, per secilen lende, dhe secilin profesore
							*/
							$lenda = new Lenda($l['id']);
							$profesor = new Profesor($lenda->getProfID());

							/*
							*	Emrat e lendeve dhe emrat/mbiemrat e profesoreve i ruajme ne nje Array
							*	emri_lendes[] dhe emri_prof[] jane array
							*/
							echo '<input type="hidden" name="emri_lendes[]" value="'.$lenda->getEmri().'" />';
							echo '<input type="hidden" name="emri_prof[]" value="'.$profesor->getEmri().' '.$profesor->getMbiemri().'" />';	
					echo'<table class="table table-">';
							if($pyetjet = getPyetjet()){
								echo '<span class="text-danger lenda-prof"><strong>'.$profesor->getEmri().' '.$profesor->getMbiemri().' - '.$lenda->getEmri().'</strong></span>';
								foreach($pyetjet as $pyetja){
									echo '<input type="hidden" name="pyetja[]" value="'.$pyetja['pyetja'].'"/>';
									echo '	<tr><td><span class="pyetja col-md-8"> '.$pyetja['pyetja'].' </span>
											<div class="btn-group form-group col-md-4 has-error" data-toggle="buttons">
											  <label class="btn btn-default">
											    <input type="radio" class="form-control" id="nota'.$pyetja['id'].''.$i.'[]" name="nota'.$pyetja['id'].''.$i.'[]"  required value="1">  1
											  </label>
											  <label class="btn btn-default">
											    <input type="radio" class="form-control" id="nota'.$pyetja['id'].''.$i.'[]" name="nota'.$pyetja['id'].''.$i.'[]"  required value="2">  2
											  </label>
											  <label class="btn btn-default">
											    <input type="radio" class="form-control" id="nota'.$pyetja['id'].''.$i.'[]" name="nota'.$pyetja['id'].''.$i.'[]"  required value="3"> 3
											  </label>
											  <label class="btn btn-default">
											    <input type="radio" class="form-control" id="nota'.$pyetja['id'].''.$i.'[]" name="nota'.$pyetja['id'].''.$i.'[]"  required value="4"> 4
											  </label>
											  <label class="btn btn-default">
											    <input type="radio" class="form-control" id="nota'.$pyetja['id'].''.$i.'[]" name="nota'.$pyetja['id'].''.$i.'[]"  required value="5"> 5
											  </label>
											</div></td></tr>';
								}
							}
							else{
								echo 'Nuk ka pyejte.';
							}
					echo '</table>';
						$i++;
						}
					?>
					<div class="form-group">
						<button type="submit" class="btn btn-md form-control btn-primary" id="ruaj" data-loading-text="Duke kontrolluar...">Ruaj!</button>
					</div>
					<div class="ruajtjeError"></div>
				</form>
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
    <!-- 
    Ky kod Javascript nga Bootstrap sherben per me bo animated butonin "Ruaj!",
    pas 4000( 4sec ) tek <div ruajtjeError, do te vendoset kodi mbrenda ".html('')" ,
    kjo i lejon 4 sec kohe severit qe te shikoje a i ka plotesuar te gjitha pyetjet ,
    kjo funksionon sepse <input type... e kane parametrin "required" 
    -->
    <script type="text/javascript">
        $(function(){
            $('#ruaj').click(function(){
                  var btn = $(this); 
                  btn.button('loading');
				  setTimeout(function () {
			            btn.button('reset');
			            $('.ruajtjeError').html('<div class="alert alert-warning text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Ju lutemi ti vler&euml;soni t&euml; gjith&euml; profesor&euml;t.</strong></div>');
			        }, 4000)
            });
        });
    </script>
    
  </body>
</html>