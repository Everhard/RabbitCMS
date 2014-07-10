<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/<?php echo $this->template_folder; ?>/images/favicon.ico">
    <title>RabbitCMS</title>
    <!-- Bootstrap core CSS -->
    <link href="/<?php echo $this->template_folder; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="/<?php echo $this->template_folder; ?>/css/custom.css" rel="stylesheet">

    <style type="text/css">

.form-signin {
  max-width: 350px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading {
  margin-bottom: 10px;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
}
    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" role="form">
        <h2 class="form-signin-heading">RabbitCMS</h2>
        <input name="password" type="password" class="form-control" placeholder="Enter password..." required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>

    </div> <!-- /container -->
      
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/<?php echo $this->template_folder; ?>/js/bootstrap.min.js"></script>
    <script src="/<?php echo $this->template_folder; ?>/js/custom.js"></script>
  </body>
</html>