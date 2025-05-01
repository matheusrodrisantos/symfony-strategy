<?php

namespace App\EventRegistration\Factory;

use App\Shared\DTO\InputDto;
use App\Shared\DTO\OutputDto;
use App\EventRegistration\Entity\EventRegistration;

class EventRegistrationFactory
{
    public function createEntityFromDto(InputDto $eventRegistrationInputDto)
    {
        // TODO: Mapear InputDto para Entity
    }

    public function updateEntityFromDto(EventRegistration $eventRegistration, InputDto $eventRegistrationInputDto): EventRegistration
    {
        // TODO: Atualizar dados da Entity a partir do InputDto
        return $eventRegistration;
    }

    public function createOutputDtoFromEntity(EventRegistration $eventRegistration): OutputDto
    {
        // TODO: Mapear Entity para OutputDto
    }

    public function createOutputDtoListFromEntities(array $entities): array
    {
        return array_map([$this, 'createOutputDtoFromEntity'], $entities);
    }
}
