<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo $this->template_path; ?>/images/favicon.ico">
    <title>RabbitCMS</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo $this->template_path; ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $this->template_path; ?>/css/custom.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar-fixed-top.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">RabbitCMS</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Statistics</a></li>
            <li><a href="#about">Pages</a></li>
            <li><a href="#contact">Navigations</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Change password</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../navbar/">Logs</a></li>
            <li><a href="../navbar-static-top/">Exit</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

	<div class="panel panel-default">
		<div class="panel-heading">Statistics</div>
		<div class="panel-body">
			<button class='btn btn-default' data-toggle="modal" data-target="#add-project">X</button>
		</div>
		<table class="table table-striped" id="prjects-list-table">
			<thead>
				<th>X</th>
				<th>X</th>
				<th>X</th>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo $this->template_path; ?>/js/bootstrap.min.js"></script>
  </body>
</html>
