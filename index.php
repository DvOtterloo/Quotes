<?php

require_once 'app/app.php';
require_once 'app/Database.php';
require_once 'app/Person.php';
require_once 'app/Quote.php';
require_once 'app/Tag.php';
require_once 'app/View.php';

define("URL", "http://localhost/Quotes/");

// Database
define("HOST",      "localhost");
define("DATABASE",  "Quotes");
define("USER",      "root");
define("PASSWORD",  "root");


 error_reporting(E_ALL);
  ini_set('display_errors', '1'); 

$app = new App();
