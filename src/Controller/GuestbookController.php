<?php
# ./src/Controller/HelloController.php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;

class GuestbookController
{
    public function index(Application $app)
    {
        return new JsonResponse($app['repo.guestbook']->findAll());
    }

    public function newEntry(Request $request, Application $app)
    {
        $req = json_decode($request->getContent() !== '' ? $request->getContent() : '{}', true);
        $req = $req !== null ? $req : [];

        $valid = $app['validate.guestbook']->isValid($req);
        if ($valid !== true) {
            return new JsonResponse(['guestbook' => $req, 'errors' => $app['validate.guestbook']->getMessages()],400);
        } else {
            $guestbook = $app['repo.guestbook']->saveNew($req);
            return new JsonResponse($guestbook);
        }
    }

    public function show(Application $app, $id)
    {
        if ($gb = $app['repo.guestbook']->find($id)) {
            return new JsonResponse($gb);
        } else {
            return new JsonResponse(['errors'=> 'Entry not found'], 404);
        }
    }

    public function delete(Application $app, $id)
    {
        if ($gb = $app['repo.guestbook']->find($id)) {
            $app['repo.guestbook']->delete($id);
            return new JsonResponse($gb);
        } else {
            return new JsonResponse(['errors'=> 'Entry not found'], 404);
        }
    }

    public function update(Application $app, Request $request, $id)
    {
        if ($old = $app['repo.guestbook']->find($id)) {
            $req = json_decode($request->getContent(), true);
            unset($req['id']);
            $valid = $app['validate.guestbook']->isValid($req, $id);
            if ($valid !== true) {
                return new JsonResponse(['guestbook' => $req, 'errors' => $app['validate.guestbook']->getMessages()], 400);
            } else {
                $guestbook = $app['repo.guestbook']->update($id, $req);
                return new JsonResponse($guestbook);
            }
        } else {
            return new JsonResponse(['errors'=> 'Entry not found'], 404);
        }
    }
}