<?php
// Install RabbitCMS:
if (isset($_POST['install'])) {

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
    
    $password = PasswordGenerator::get_password();
    
    $result = $DBH->query("INSERT INTO settings (field_name, field_value) VALUES ('password_hash', '".md5($password)."')");
    
    unlink("install.php");
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
<?php if (isset($_POST['install'])) { ?>
        <p>RabbitCMS successfully installed!</p>
        <p>Admin password: <strong><?php echo $password; ?></strong></p>
        <a href="/rabbit-control" class="btn btn-lg btn-primary">Go to admin panel &raquo;</a>
<?php } else { ?>
        <p>To install this content management system just click the button below.</p>
        <p>Yes, just click the button.</p>
        <form method="post">
            <input type="submit" name="install" class="btn btn-lg btn-primary" value="Install &raquo;">
        </form>
<?php } ?>
      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/admin/js/bootstrap.min.js"></script>
    <script src="/admin/js/custom.js"></script>
  </body>
</html>

<?php
class PasswordGenerator {
    public static function get_password($length = 20) {
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $current_index = rand(0, count(self::$symbols) - 1);
            $character = self::$symbols[$current_index];
            
            if (!is_numeric($character)) {
                if (rand(0, 1)) $character = strtoupper($character);
            }
            
            $password .= $character;
        }
        return $password;
    }
    
    private static $symbols = array(
        "a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","0","1","2","3","4","5","6","7","8","9"
    );
}
?>