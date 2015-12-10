<?php
# ./src/Controller/HelloController.php

namespace App\Controller;

use App\Repository\Guestbook;
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
        $req = json_decode($request->getContent(), true);
        $constraint = new Assert\Collection(
            [
                'first_name' => new Assert\NotBlank(),
                'last_name' => new Assert\NotBlank(),
                'email' => [
                    new Assert\NotBlank(),
                    new Assert\Email()
                ]
            ]
        );
        $errors = $app['validator']->validateValue($req, $constraint);
        if (count($errors) > 0) {
            $msg = [];
            foreach ($errors as $error) {
                $msg[] = $error->getPropertyPath().' '.$error->getMessage();
            }
            return new JsonResponse(['guestbook' => $req, 'errors' => $msg]);
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
        if ($app['repo.guestbook']->find($id)) {
            $req = json_decode($request->getContent(), true);
            $constraint = new Assert\Collection(
                [
                    'first_name' => new Assert\NotBlank(),
                    'last_name' => new Assert\NotBlank(),
                    'email' => [
                        new Assert\NotBlank(),
                        new Assert\Email()
                    ]
                ]
            );
            $errors = $app['validator']->validateValue($req, $constraint);
            if (count($errors) > 0) {
                $msg = [];
                foreach ($errors as $error) {
                    $msg[] = $error->getPropertyPath().' '.$error->getMessage();
                }
                return new JsonResponse(['guestbook' => $req, 'errors' => $msg]);
            } else {
                $guestbook = $app['repo.guestbook']->update($id, $req);
                return new JsonResponse($guestbook);
            }
        } else {
            return new JsonResponse(['errors'=> 'Entry not found'], 404);
        }
    }
}