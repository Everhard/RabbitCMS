<?php
// Start session:
session_start();

// CMS files:
require_once("lib/model.php");
require_once("lib/view.php");
require_once("lib/controller.php");

Controller::run();
?>