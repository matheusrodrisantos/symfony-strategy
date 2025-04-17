<?php

namespace App\DTO;
use App\Entity\Participante;
use DateTimeInterface;

class ParticipanteOutputDTO{

    public readonly int $id;
    public readonly string $nome;
    public readonly string $cpf;
    public readonly DateTimeInterface $dataNascimento;
    public readonly string $email;
    public readonly string $numero;
    
    public static function fromEntity(Participante $participante) : self {
        return new self(
            id:$participante->getId(),
            nome:$participante->getNome(),
            cpf:$participante->getCpf(),
            dataNascimento:$participante->getDataNascimento(),
            email:$participante->getEmail(),
            numero:$participante->getNumero()
        );
    }
}

