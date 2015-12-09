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
        return new JsonResponse($app['repo.guestbook']->findAll());
    }
}