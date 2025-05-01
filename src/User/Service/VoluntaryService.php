<?php

namespace App\User\Service;

use App\Shared\Service\ServiceCrudInterface;
use App\Shared\DTO\InputDto;
use App\Shared\DTO\OutputDto;

class VoluntaryService implements ServiceCrudInterface
{
    public function save(InputDto $input): OutputDto
    {
        // TODO: Implementar método save
    }

    public function update(int $id, InputDto $input): OutputDto
    {
        // TODO: Implementar método update
    }

    public function delete(int $id): void
    {
        // TODO: Implementar método delete
    }

    public function list(): array
    {
        // TODO: Implementar método list
    }

    public function listById(int $id): OutputDto
    {
        // TODO: Implementar método listById
    }
}
