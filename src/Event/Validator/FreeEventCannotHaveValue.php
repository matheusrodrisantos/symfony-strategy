<?php
 
namespace App\Event\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class FreeEventCannotHaveValue extends Constraint{
    
    public string $message = 'Eventos gratuitos não podem ter valor';

    public ?array $groups = ['create', 'update', 'Default'];
    
    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}