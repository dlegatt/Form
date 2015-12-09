<?php
# ./web/index.php
// stops errors from displaying
ini_set('display_errors', 0);

$app = require_once __DIR__.'/../app/app.php';

require_once __DIR__.'/../app/config/prod.php';

$app->run();