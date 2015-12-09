<?php
// app/config/twig.php

$app['twig.path'] = [
    __DIR__.'/../../src/View',
];

$app['twig.options'] = [
    'cache' => __DIR__.'/../var/cache/twig',
];

$app['twig'] = $app->extend('twig', function ($twig,$app) {
    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) use ($app) {
        return $app['request_stack']->getMasterRequest()->getBasePath().'/'.ltrim($asset, '/');
    }));
    return $twig;
});

return $app;