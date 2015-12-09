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

        return $controllers;
    }
}