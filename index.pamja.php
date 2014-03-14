<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="assets/ico/favicon.jpg">
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
	      <a class="navbar-brand" href="index.php"><?php echo $page->getTitle(); ?></a>
	    </div>
	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	      <?php $page->headerNavbar(); ?>
	      </ul>
		  <ul class="nav navbar-nav navbar-right">
          <?php
		  		if ($_SESSION['logged_in']==TRUE)
		{ 
		  echo ' <li><a href="logout.php"class="glyphicon glyphicon-log-out"> Dilni</a> </li>'; 
		}
		else {
		header("Location: login.pamja.php");
		}
		?>
		</ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	</div>
    <div class="container">
    	<div id="carousel-example-generic" class="carousel slide hidden-xs" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		  <?php
		  	for($i=0; $i<5; $i++)
		  	{
		  		if($i==0){ echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" class="active"></li>'; }
		  		else{
		  			echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'"></li>';
		  		}
		  		
		  	}
		  ?>
		  </ol>
<?php $a = "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI5MDAiIGhlaWdodD0iNTAwIj48cmVjdCB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzc3NyI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjQ1MCIgeT0iMjUwIiBzdHlsZT0iZmlsbDojN2E3YTdhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjU2cHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+Rmlyc3Qgc2xpZGU8L3RleHQ+PC9zdmc+"; ?>
		  <!-- Wrapper for slides -->
		  <div class="carousel-inner">
		    <?php 
		    	for($i=0; $i<5; $i++)
		    	{
		    		# shtohet 1 if per me bo lajmin e par "0", me bo active, me dal i pari nlist..
		    		if($i ==0 ) {
		    			echo '<div class="item active">';
		    		}
		    		else{
		    			echo '<div class="item">';
		    		}
		    		echo '
			      <img alt="First slide" src="">
			      <div class="carousel-caption col-md-4">
			        <h1>Lajmi 1</h1>
			        <p>Informacione per lajmin e pare do zgjasin shume dhe jo vetem pak per arsye te ndryshme shkencore.</p>
			        <p><a href="" class="btn btn-md btn-primary pull-right">Lexo më shumë</a></p>
			      </div>
			    </div>';
		    	}
		    ?>
		    <div class="item">
		      <img alt="First slide" src="">
		      <div class="carousel-caption">
		        <h1>Lajmi 2</h1>
		        <p>Informacione per lajmin e pare do zgjasin shume dhe jo vetem pak per arsye te ndryshme shkencore.</p>
		        <p><a href="" class="btn btn-md btn-primary pull-right">Lexo më shumë</a></p>
		      </div>
		    </div>
		    <div class="item">
		      <img src="">
		      <div class="carousel-caption">
		        <h1>Lajmi 3</h1>
		        <p>Informacione per lajmin e pare do zgjasin shume dhe jo vetem pak per arsye te ndryshme shkencore.</p>
		        <p><a href="" class="btn btn-md btn-primary pull-right">Lexo më shumë</a></p>
		      </div>
		    </div>
		    <div class="item">
		      <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI5MDAiIGhlaWdodD0iNTAwIj48cmVjdCB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzc3NyI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjQ1MCIgeT0iMjUwIiBzdHlsZT0iZmlsbDojN2E3YTdhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjU2cHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+Rmlyc3Qgc2xpZGU8L3RleHQ+PC9zdmc+">
		      <div class="carousel-caption">
		        <h1>Lajmi 4</h1>
		        <p>Informacione per lajmin e pare do zgjasin shume dhe jo vetem pak per arsye te ndryshme shkencore.</p>
		        <p><a href="" class="btn btn-md btn-primary pull-right">Lexo më shumë</a></p>
		      </div>
		    </div>
		    <div class="item">
		      <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI5MDAiIGhlaWdodD0iNTAwIj48cmVjdCB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzc3NyI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjQ1MCIgeT0iMjUwIiBzdHlsZT0iZmlsbDojN2E3YTdhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjU2cHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+Rmlyc3Qgc2xpZGU8L3RleHQ+PC9zdmc+">
		      <div class="carousel-caption">
		        <h1>Lajmi 5</h1>
		        <p>Informacione per lajmin e pare do zgjasin shume dhe jo vetem pak per arsye te ndryshme shkencore.</p>
		        <p><a href="" class="btn btn-md btn-primary pull-right">Lexo më shumë</a></p>
		      </div>
		    </div>
		  </div>

		  <!-- Controls -->
		  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left"></span>
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right"></span>
		  </a>
		</div>
		<div class="row">

			<div class="col-md-3 user-info">
					<img class="img-circle" src="<?php echo $studenti->getFoto(); ?>" />
					<p class="emri"><?php echo $studenti->getEmri() . ' '. $studenti->getMbiemri();  ?></p>
					<p>Gjithsej kredi: <em><?php echo $studenti->getKredi(); ?></em></p>
					<hr class="hidden-xs">
					<table class="table table-hover text-left">
					<thead><tr><th>Emri</th><th>Kredi</th></tr></thead>
					<tbody>
						<tr>
							<td><a href="#"><strong>Programimi i aplikacioneve për serverë</strong></a></td>
							<td>6</td>
						</tr>
						<tr>
							<td><a href="#">Menaxhimi i kualitetit në TI</a></td>
							<td>3</td>
						</tr>
						<tr>
							<td><a href="#"><strong>Menaxhimi i projekteve</strong></a></td>
							<td>6</td>
						</tr>
						<tr>
							<td><a href="#"><strong>Matematikë 2</strong></a></td>
							<td>6</td>
						</tr>
						<tr>
							<td><a href="#">Anglisht 4</a></td>
							<td>3</td>
						</tr>
					</tbody>
					</table>
			</div>
			<div class="col-md-8 col-md-offset-1 gazeta-news">
				<ul class="list-group">
				  <li class="list-group-item">
				  		<div class="row">
				  			<div class="col-md-2 col-xs-4">
				  				<a href="#" class="thumbnail">
				  					<img class="img-responsive" src="https://www.permajet.com/themes/default/images/uploads/default.png" />
				  				</a>
				  			</div>
				  			<div class="col-md-10 text-center">
				  				<h3> Titulli postimit te gazetes </h3>
				  				<p class="text-left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
				  				<p class="text-right"><a href="#">Lexo më shumë</a></p>
				  			</div>
				  		</div>
				  </li>
				  <li class="list-group-item">
				  	<div class="row">
				  			<div class="col-md-2 col-xs-4">
				  				<a href="#" class="thumbnail">
				  					<img class="img-responsive" src="https://www.permajet.com/themes/default/images/uploads/default.png" />
				  				</a>
				  			</div>
				  			<div class="col-md-10 text-center">
				  				<h3> Titulli postimit te gazetes </h3>
				  				<p class="text-left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
				  				<p class="text-right"><a href="#">Lexo më shumë</a></p>
				  			</div>
				  		</div>
				  </li>
				  <li class="list-group-item">
				  		<div class="row">
				  			<div class="col-md-2 col-xs-4">
				  				<a href="#" class="thumbnail">
				  					<img class="img-responsive" src="https://www.permajet.com/themes/default/images/uploads/default.png" />
				  				</a>
				  			</div>
				  			<div class="col-md-10 text-center">
				  				<h3> Titulli postimit te gazetes </h3>
				  				<p class="text-left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
				  				<p class="text-right"><a href="#">Lexo më shumë</a></p>
				  			</div>
				  		</div>
				  </li>
				  <li class="list-group-item">
				  		<div class="row">
				  			<div class="col-md-2 col-xs-4">
				  				<a href="#" class="thumbnail">
				  					<img class="img-responsive" src="https://www.permajet.com/themes/default/images/uploads/default.png" />
				  				</a>
				  			</div>
				  			<div class="col-md-10 text-center">
				  				<h3> Titulli postimit te gazetes </h3>
				  				<p class="text-left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
				  				<p class="text-right"><a href="#">Lexo më shumë</a></p>
				  			</div>
				  		</div>
				  </li>
				  <li class="list-group-item">
				  		<div class="row">
				  			<div class="col-md-2 col-xs-4">
				  				<a href="#" class="thumbnail">
				  					<img class="img-responsive" src="https://www.permajet.com/themes/default/images/uploads/default.png" />
				  				</a>
				  			</div>
				  			<div class="col-md-10 text-center">
				  				<h3> Titulli postimit te gazetes </h3>
				  				<p class="text-left">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
				  				<p class="text-right"><a href="#">Lexo më shumë</a></p>
				  			</div>
				  		</div>
				  </li>
				</ul>
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