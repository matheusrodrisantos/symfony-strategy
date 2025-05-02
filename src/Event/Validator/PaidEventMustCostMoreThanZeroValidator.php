<?php

namespace App\Event\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Event\DTO\EventInputDTO;


class PaidEventMustCostMoreThanZeroValidator extends ConstraintValidator
{
    public function validate(mixed $dto, Constraint $constraint)
    {
        if (!$dto instanceof EventInputDTO) {
            throw new \InvalidArgumentException('must be to class '.EventInputDTO::class);
        }

        if ($dto->free == false && $dto->value <= 0) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }

    }
}
