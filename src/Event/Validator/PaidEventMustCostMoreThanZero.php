<?php

namespace App\Event\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class PaidEventMustCostMoreThanZero extends Constraint{

    public string $message ='Eventos pagos não podem custar menos ou igual a 0';

    public ?array $groups =['create', 'update','Default'];

    public function getTargets(): string|array
    {
        return self::CLASS_CONSTRAINT;
    }

}