<?php
// Install RabbitCMS:
if (isset($_GET['thank-you!'])) {

    $DBH = new SQLite3("rabbitcms.sqlite");

    // Creating pages table:
    $result = $DBH->query('CREATE TABLE "pages" (
        "id" INTEGER NOT NULL,
        "url" TEXT NOT NULL,
        "title" TEXT NOT NULL,
        "text" TEXT NOT NULL,
        "template" TEXT NOT NULL,
        PRIMARY KEY ("id")
    )');
    
    // Creating menus table:
    $result = $DBH->query('CREATE TABLE "menus" (
        "id" INTEGER NOT NULL,
        "tag" TEXT NOT NULL,
        "name" TEXT NOT NULL,
        PRIMARY KEY ("id")
    )');
    
    // Creating menu items table:
    $result = $DBH->query('CREATE TABLE "menuitems" (
        "id" INTEGER NOT NULL,
        "menu_id" INTEGER NOT NULL,
        "name" TEXT NOT NULL,
        "url" TEXT NOT NULL,
        PRIMARY KEY ("id")
    )');
    
    // Creating journal table:
    $result = $DBH->query('CREATE TABLE "journal" (
        "id" INTEGER NOT NULL,
        "message" TEXT NOT NULL,
        "ip" TEXT NOT NULL,
        "browser" TEXT NOT NULL,
        "time" INTEGER NOT NULL,
        PRIMARY KEY ("id")
    )');
    
    // Creating settings table:
    $result = $DBH->query('CREATE TABLE "settings" (
        "field_name" TEXT NOT NULL,
        "field_value" TEXT NOT NULL
    )');
    
    $result = $DBH->query("INSERT INTO settings (field_name, field_value) VALUES ('password_hash', '".md5('password')."')");
    
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/admin/images/favicon.ico">
    <title>RabbitCMS</title>
    <!-- Bootstrap core CSS -->
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
	<link href="/admin/css/custom.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar-fixed-top.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="jumbotron">
        <h1>RabbitCMS</h1>
        <p>To install this content management system just click the button below.</p>
        <p>Yes, just click the button.</p>
        <p>
          <a class="btn btn-lg btn-primary" href="install.php?thank-you!" role="button">Install &raquo;</a>
        </p>
      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/admin/js/bootstrap.min.js"></script>
    <script src="/admin/js/custom.js"></script>
  </body>
</html>