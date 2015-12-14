<?php

header("Access-Control-Allow-Origin: http://www.form.local");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
header("Access-Control-Allow-Headers: content-type, accept");
header("Access-Control-Max-Age: 1728000");
# ./web/index.php
// stops errors from displaying
ini_set('display_errors', 0);

$app = require_once __DIR__.'/../app/app.php';

require_once __DIR__.'/../app/config/prod.php';

$app->run();