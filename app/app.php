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
       'dbname'    => 'spa_backend',
       'user'      => 'root',
       'password'  => 'NcbpT35t3d',
       'charset'   => 'utf8'
    ]
]);

// Service config
$app['repo.guestbook'] = function ($app) {
    return new \App\Repository\Guestbook($app['db']);
};

$app['validate.guestbook'] = $app->share(function ($app) {
    return new \App\Validation\Guestbook($app, \App\Validation\ConstraintBuilder\Guestbook::constraints());
});

return $app;