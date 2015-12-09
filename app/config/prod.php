<?php
# ./app/config/prod.php

use Silex\Provider\MonologServiceProvider;
use Monolog\Logger;

$app['debug'] = false;

require_once __DIR__.'/common.php';

$app->register(new MonologServiceProvider(), [
    'monolog.logfile' => __DIR__.'/../var/logs/prod.log',
    'monolog.level' => Logger::ERROR,
]);
