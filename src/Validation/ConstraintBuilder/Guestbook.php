<?php

namespace App\Validation\ConstraintBuilder;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validation\Constraint as Constraint;

class Guestbook
{
    public static function constraints()
    {
        return new Assert\Collection(
            [
                'first_name' => [
                    new Assert\NotBlank(),
                    new Assert\NotNull,
                ],
                'last_name' => [
                    new Assert\NotBlank(),
                    new Assert\NotNull(),
                ],
                'email' => [
                    new Assert\NotNull(),
                    new Assert\NotBlank(),
                    new Assert\Email(),
                ]
            ]
        );
    }
}
