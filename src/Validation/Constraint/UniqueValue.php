<?php

namespace App\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

class UniqueValue extends Constraint
{
    public $message = 'The field %field% in table %table% must be unique.';
    public $dbal;
    public $table;
    public $field;
    public $id;

    public function __construct($options = null)
    {
        parent::__construct($options);
    }

    public function validatedBy()
    {
        return 'App\Validation\Validator\UniqueValue';
    }
}