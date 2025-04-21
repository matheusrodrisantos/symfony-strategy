<?php

namespace App\Participante\DTO;
use DateTimeInterface;

class ParticipanteOutputDTO{

    public readonly int $id;
    public readonly string $nome;
    public readonly string $cpf;
    public readonly DateTimeInterface $dataNascimento;
    public readonly string $email;
    public readonly string $numero;
    

    public function __construct(
        int $id,
        string $nome,
        string $cpf,
        DateTimeInterface $dataNascimento,
        string $email,
        string $numero
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->dataNascimento = $dataNascimento;
        $this->email = $email;
        $this->numero = $numero;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'dataNascimento' => $this->dataNascimento->format('Y-m-d'),
            'email' => $this->email,
            'numero' => $this->numero
        ];
    }

}

