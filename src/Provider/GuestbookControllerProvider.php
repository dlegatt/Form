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

        $controllers->get('/', 'App\Controller\GuestbookController::index');
        $controllers->post('/new', 'App\Controller\GuestbookController::newEntry');
        $controllers->get('/show/{id}', 'App\Controller\GuestbookController::show');
        $controllers->put('/update/{id}', 'App\Controller\GuestbookController::update');
        $controllers->delete('/delete/{id}', 'App\Controller\GuestbookController::delete');

        return $controllers;
    }
}