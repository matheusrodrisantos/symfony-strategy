<?php

namespace App\User\Factory;

use App\Shared\DTO\InputDto;
use App\Shared\DTO\OutputDto;
use App\User\Entity\User;

class UserFactory
{
    public function createEntityFromDto(InputDto $userInputDto)
    {
        // TODO: Mapear InputDto para Entity
    }

    public function updateEntityFromDto(User $user, InputDto $userInputDto): User
    {
        // TODO: Atualizar dados da Entity a partir do InputDto
        return $user;
    }

    public function createOutputDtoFromEntity(User $user): OutputDto
    {
        // TODO: Mapear Entity para OutputDto
    }

    public function createOutputDtoListFromEntities(array $entities): array
    {
        return array_map([$this, 'createOutputDtoFromEntity'], $entities);
    }
}
