<?php
  include($_SERVER['DOCUMENT_ROOT'].'/portal/includes/config.php');
  if(!empty($_POST['username']) && !empty($_POST['password'])){
    $user = $lidhja->real_escape_string($_POST['username']);
    $pass = $lidhja->real_escape_string($_POST['password']);
    if(verifikojeProfesorin($user,$pass)){
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <style type="text/css">
    body {
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #eee;
    }
    </style>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <form class="form-signin" role="form" method="POST" autocomplete="off" action="">
        <p class="form-signin-heading">Ju lutemi t&euml; jepni email/username dhe fjal&euml;kalimin p&euml;r t&euml; pasur &ccedil;asje.</p>
        <input type="text" name="username" class="form-control" placeholder="email / username" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="fjalekalimi" required>
        <button class="btn btn-lg btn-danger btn-block" type="submit">Ky&ccedil;u!</button>
      </form>

    </div>
  </body>
</html>
