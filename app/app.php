<?php
# ./app/app.php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider());
$app->register(new Silex\Provider\HttpFragmentServiceProvider());
$app->register(new \Silex\Provider\ValidatorServiceProvider());
$app->register(new \Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
       'driver'    => 'pdo_mysql',
       'host'      => '127.0.0.1',
       'dbname'    => 'tacobell',
       'user'      => 'root',
       'password'  => '',
       'charset'   => 'utf8'
    ]
]);

// Service config
$app['repo.guestbook'] = function ($app) {
    return new \App\Repository\Guestbook($app['db']);
};

return $app;