<?php

namespace App\Participant\DTO;

use DateTimeInterface;

class ParticipantOutputDTO
{
    public readonly int $id;
    public readonly string $name;
    public readonly string $cpf;
    public readonly DateTimeInterface $dateOfBirth;
    public readonly string $email;
    public readonly string $phoneNumber;

    public function __construct(
        int $id,
        string $name,
        string $cpf,
        DateTimeInterface $dateOfBirth,
        string $email,
        string $phoneNumber
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->cpf = $cpf;
        $this->dateOfBirth = $dateOfBirth;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cpf' => $this->cpf,
            'dateOfBirth' => $this->dateOfBirth->format('Y-m-d'),
            'email' => $this->email,
            'phoneNumber' => $this->phoneNumber
        ];
    }
}
