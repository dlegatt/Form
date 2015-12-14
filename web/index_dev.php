<?php
# ./web/index_dev.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

use Symfony\Component\Debug\Debug;

$app = require_once __DIR__.'/../app/app.php';

ini_set('display_errors', 1);
Debug::enable();

require_once __DIR__.'/../app/config/dev.php';

$app->run();