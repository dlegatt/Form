<?php
# ./src/Provider/HelloCotrollerProvider.php

namespace App\Provider;

use Silex\Application;
use Silex\ControllerProviderInterface;

class GuestbookControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/gb', 'App\Controller\GuestbookController::index');
        $controllers->match('/gb', 'App\Controller\GuestbookController::newEntry')->method("POST|OPTIONS");
        $controllers->get('/gb/{id}', 'App\Controller\GuestbookController::show');
        $controllers->put('/gb/{id}', 'App\Controller\GuestbookController::update');
        $controllers->delete('/gb/{id}', 'App\Controller\GuestbookController::delete');

        return $controllers;
    }
}