<?php

namespace App\Validation\Builder;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validation\Constraint as Constraint;

class Guestbook
{
    public static function constraints()
    {
        return new Assert\Collection(
            [
                'first_name' => new Assert\NotBlank(),
                'last_name' => new Assert\NotBlank(),
                'email' => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                ]
            ]
        );
    }
}
