<?php

namespace App\EventRegistration\Entity;

use Doctrine\ORM\Mapping\Embeddable;
use Doctrine\ORM\Mapping\Column;
use Exception;

#[Embeddable]
class Money{
        
        #[Column(type: "int")]
        private int $value;

        #[Column(type: "int")]
        private int $valuePaid;
    public function __construct(

        
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