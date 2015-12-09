<?php
# ./app/config/dev.php

use Silex\Provider\MonologServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;

$app['debug'] = true;

require_once __DIR__.'/common.php';

$app->register(new MonologServiceProvider(), [
    'monolog.logfile' => __DIR__.'/../var/logs/dev.log',
]);

$app->register(new WebProfilerServiceProvider(), [
    'profiler.cache_dir' => __DIR__.'/../var/cache/profiler',
]);

