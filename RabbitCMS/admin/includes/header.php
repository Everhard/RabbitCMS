<?php defined('_RabbitCMS') or die('Restricted access'); ?>
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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/rabbit-control">RabbitCMS</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="/rabbit-control"><span class="glyphicon glyphicon-stats"></span> Statistics</a></li>
            <li><a href="/rabbit-control/pages"><span class="glyphicon glyphicon-file"></span> Pages</a></li>
            <li><a href="/rabbit-control/menus"><span class="glyphicon glyphicon-list"></span> Menus</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-wrench"></span> Settings <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="/rabbit-control/template">Template installation</a></li>
                <li><a href="#">Change password</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/rabbit-control/journal"><span class="glyphicon glyphicon-hdd"></span> Logs</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-arrow-up"></span> Exit</a></li>
          </ul>
        </div>
      </div>
    </div>