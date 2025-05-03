<?php

namespace App\Shared\ObjectValue;

use InvalidArgumentException;

class Cpf{

    public function __construct(private string $cpf)
    {
        $this->validate();
    }

    public function validate():void
    {
        $cpf = preg_replace( '/[^0-9]/is', '', $this->cpf );
     
        if (strlen($cpf) != 11) {
            throw new InvalidArgumentException('CPF INVALIDO');
        }
   
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            throw new InvalidArgumentException('CPF INVALIDO');
        }
    
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                throw new InvalidArgumentException('CPF INVALIDO');
            }
        }
    }

    public function __toString()
    {
        return $this->cpf;
    }
}