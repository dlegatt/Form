<?php
# ./web/index_dev.php
header("Access-Control-Allow-Origin: http://www.form.local");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Access-Control-Allow-Headers: accept, content-type');
    header('Access-Control-Allow-Methods: POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1728000');
}
use Symfony\Component\Debug\Debug;

$app = require_once __DIR__.'/../app/app.php';

ini_set('display_errors', 1);
Debug::enable();

require_once __DIR__.'/../app/config/dev.php';

$app->run();