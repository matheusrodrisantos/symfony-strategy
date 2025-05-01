<?php

namespace App\Event\DTO;
use App\Shared\DTO\OutputDto;

class EventOutputDTO implements OutputDto
{
    
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $name,
        public readonly ?string $type,
        public readonly ?string $free,
        public readonly ?float $value,
        public readonly ?\DateTimeImmutable $startDate,
        public readonly ?\DateTimeImmutable $endDate,
        public readonly ?bool $online,
        public readonly ?bool $inPerson
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'free' => $this->free,
            'value' => $this->value,
            'startDate' => $this->startDate ? $this->startDate->format('Y-m-d H:i:s') : null,
            'endDate' => $this->endDate ? $this->endDate->format('Y-m-d H:i:s') : null,
            'online' => $this->online,
            'inperson' => $this->inPerson            
        ];
    }
}
