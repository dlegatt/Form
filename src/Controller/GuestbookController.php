<?php
# ./src/Controller/HelloController.php

namespace App\Controller;

use App\Repository\Guestbook;
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;

class GuestbookController
{
    public function index(Application $app)
    {
        $repo = new Guestbook($app['db']);
        return new JsonResponse($repo->findAll());
    }
}