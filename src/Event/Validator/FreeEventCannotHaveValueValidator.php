<?php 


namespace App\Event\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Event\DTO\EventInputDTO;


class FreeEventCannotHaveValueValidator extends ConstraintValidator
{
    public function validate(mixed $dto, Constraint $constraint): void
    {
        if (!$dto instanceof EventInputDTO) {
            return;
        }

        if ($dto->free == true && $dto->value > 0) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
