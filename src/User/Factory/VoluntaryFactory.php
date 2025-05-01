<?php

namespace App\Voluntary\Factory;

use App\Shared\DTO\InputDto;
use App\Shared\DTO\OutputDto;
use App\Voluntary\Entity\Voluntary;

class VoluntaryFactory
{
    public function createEntityFromDto(InputDto $voluntaryInputDto)
    {
        // TODO: Mapear InputDto para Entity
    }

    public function updateEntityFromDto(Voluntary $voluntary, InputDto $voluntaryInputDto): Voluntary
    {
        // TODO: Atualizar dados da Entity a partir do InputDto
        return $voluntary;
    }

    public function createOutputDtoFromEntity(Voluntary $voluntary): OutputDto
    {
        // TODO: Mapear Entity para OutputDto
    }

    public function createOutputDtoListFromEntities(array $entities): array
    {
        return array_map([$this, 'createOutputDtoFromEntity'], $entities);
    }
}
