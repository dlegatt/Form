<?php

namespace App\Validation\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueValue extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /** @var \Doctrine\DBAL\Query\QueryBuilder $qb */
        $qb = $constraint->dbal->createQueryBuilder();
        $query = $qb->select('id')->from($constraint->table)
            ->where($constraint->field.' = ?')
            ->setParameter($constraint->field,$value);
        $params = [$value];

        if ($constraint->id !== null) {
            $query->andWhere('id != ?')
                ->setParameter('id', $constraint->id);
            $params[] = $constraint->id;
        }

        $result = $constraint->dbal->fetchAssoc($query->getSQL(),$params);


        if (is_array($result) && count($result) > 0) {
            $this->context->addViolation(
                $constraint->message,
                [
                    '%field%' => $constraint->field,
                    '%table%' => $constraint->table
                ]
            );
        }
    }
}