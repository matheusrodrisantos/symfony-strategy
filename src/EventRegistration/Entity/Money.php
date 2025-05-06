<?php

namespace App\EventRegistration\Entity;

use Doctrine\ORM\Mapping\Embeddable;
use Doctrine\ORM\Mapping\Column;
use Exception;

#[Embeddable]
class Money{
        
    public function __construct(
        #[Column(type: "integer")]
        private int $value,

        #[Column(type: "integer")]
        private int $valuePaid
    ){     
        $this->validate();
    }

    public function validate(): void {
        if($this->valuePaid<$this->value){
            throw new Exception('valor invalido, não pode ser menor que o valor da inscrição');
        }
    }

    public function getValue(){
        return $this->value;
    }

    public function getValuePaid(){
        return $this->valuePaid;
    }

}