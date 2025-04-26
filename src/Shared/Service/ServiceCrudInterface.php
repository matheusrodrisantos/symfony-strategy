<?php

namespace App\Shared\Service;


use App\Shared\DTO\InputDto;
use App\Shared\DTO\OutputDto;

interface ServiceCrudInterface{
    
    public function save(InputDto $input): OutputDto;

    public function update(int $id, InputDto $input): OutputDto;

    public function delete(int $id): void;

    public function list():array;

    public function listById(int $id):OutputDto;
}