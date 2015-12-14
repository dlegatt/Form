<?php

namespace App\Validation;

use Doctrine\DBAL\Connection;
use Silex\Application;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\RecursiveValidator;
use App\Validation\Constraint as Constraint;

class Guestbook
{
    /**
     * @var Assert\Collection
     */
    private $constraints;

    /**
     * @var RecursiveValidator;
     */
    private $validator;

    /**
     * @var Connection;
     */
    private $db;

    /**
     * @var array
     */
    private $errors;

    /**
     * @var array
     */
    private $messages = [];


    public function __construct(Application $app, Assert\Collection $constraints)
    {
        $this->validator = $app['validator'];
        $this->db = $app['db'];
        $this->constraints = $constraints;
    }

    public function isValid($data, $id = null)
    {
        $this->constraints->fields['email']->constraints[] =
            new Constraint\UniqueValue([
                'dbal' => $this->db,
                'table' => 'guestbook',
                'field' => 'email',
                'id' => $id
            ]);
        $this->errors = $this->validator->validateValue($data,$this->constraints);
        if (count($this->errors) > 0) {
            foreach ($this->errors as $error) {
                $this->messages[] = [
                    'field' => trim(
                        $error->getPropertyPath(), '[]'
                    ),
                    'message' => $error->getMessage(),
                ];
            }
            return false;
        } else {
            return true;
        }
    }

    public function getMessages()
    {
        return $this->messages;
    }
}