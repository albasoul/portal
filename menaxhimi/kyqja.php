<?php
	include($_SERVER['DOCUMENT_ROOT'].'/portal/includes/config.php');
	if(!empty($_POST['username']) && !empty($_POST['password'])){
		$user = $lidhja->real_escape_string($_POST['username']);
		$pass = $lidhja->real_escape_string($_POST['password']);
		if(verifikojePerdoruesin($user,$pass)){
			header('Location: index.php');
			die();
		}
		else{
			header('Location: kyqja.php?gabim=1');
			die();
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.jpg">

    <title>Menaxhimi</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">
    <style type="text/css">
    body {
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #eee;
    }
    </style>
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <form class="form-signin" role="form" method="POST" action="">
        <p class="form-signin-heading">Ju lutemi t&euml; jepni email/username dhe fjal&euml;kalimin p&euml;r t&euml; pasur &ccedil;asje n&euml; menaxhimin e faqes.</p>
        <input type="text" name="username" class="form-control" placeholder="email / username" autocomplete="off" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="fjalekalimi" required>
        <button class="btn btn-lg btn-danger btn-block" type="submit">Ky&ccedil;u!</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
