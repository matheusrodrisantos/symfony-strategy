<?php

namespace App\EventRegistration\ObjectValue;


class Status{

    public const STATUS_PENDING = 'PENDING';
    public const STATUS_PAID = 'PAID';
    public const STATUS_CANCELED = 'CANCELED';

    public function __construct(
        private string $status
    ){}

    public function validate(): void{
        $this->status = match($this->status){
            null => throw new \InvalidArgumentException("Status não pode ser nulo"),
            self::STATUS_CANCELED,
            self::STATUS_PAID,
            self::STATUS_PENDING =>$this->status,
            default => throw new \InvalidArgumentException("Status inválido: $this->status"),
        };

    }
    
    public function __toString(){
        return $this->status;   
    }

}