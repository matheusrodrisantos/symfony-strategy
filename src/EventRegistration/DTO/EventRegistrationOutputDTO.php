<?php

namespace App\EventRegistration\DTO;

use App\Shared\DTO\OutputDto;

class EventRegistrationOutputDTO implements OutputDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?int $userId,
        public readonly ?int $eventId,
        public readonly ?\DateTimeImmutable $createdAt,
        public readonly ?\DateTimeImmutable $updatedAt,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->userId,
            'eventId' => $this->eventId,
            'createdAt' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt?->format('Y-m-d H:i:s'),
        ];
    }
}
