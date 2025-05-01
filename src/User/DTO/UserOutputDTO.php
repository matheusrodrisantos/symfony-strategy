<?php

namespace App\User\DTO;

use App\Shared\DTO\OutputDto;

class UserOutputDTO implements OutputDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $cpf,
        public readonly \DateTimeInterface $dateOfBirth,
        public readonly string $email,
        public readonly ?string $phoneNumber,
        public readonly bool $lgpdAcceptance,
        public readonly \DateTimeImmutable $createdAt,
        public readonly \DateTimeImmutable $updatedAt,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cpf' => $this->cpf,
            'dateOfBirth' => $this->dateOfBirth->format('Y-m-d'),
            'email' => $this->email,
            'phoneNumber' => $this->phoneNumber,
            'lgpdAcceptance' => $this->lgpdAcceptance,
            'createdAt' => $this->createdAt->format(\DateTime::ATOM),
            'updatedAt' => $this->updatedAt->format(\DateTime::ATOM),
        ];
    }
}
