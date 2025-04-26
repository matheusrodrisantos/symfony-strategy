<?php

namespace App\EventRcc\Factory;

use App\EventRcc\DTO\EventRccInputDTO;
use App\EventRcc\DTO\EventRccOutputDTO;
use App\EventRcc\Entity\EventRcc;

class EventRccFactory
{
    public function createEntityFromDto(EventRccInputDTO $inputDto):EventRcc{
        
        $EventRcc = new EventRcc();

        $EventRcc->setName($inputDto->name);
        $EventRcc->setType($inputDto->type);
        $EventRcc->setFree($inputDto->free);
        $EventRcc->setValue($inputDto->value);
        $EventRcc->setStartDate($inputDto->startDate);
        $EventRcc->setEndDate($inputDto->endDate);
        $EventRcc->setOnline($inputDto->online);
        $EventRcc->setinPerson($inputDto->inPerson);

        return $EventRcc;
    }

    public function updateEntityFromDto(EventRcc $EventRcc, EventRccInputDTO $inputDto):EventRcc {

        if ($inputDto->name !== null) {
            $EventRcc->setName($inputDto->name);
        }
        
        if ($inputDto->type !== null) {
            $EventRcc->setType($inputDto->type);
        }

        if ($inputDto->free !== null) {
            $EventRcc->setFree($inputDto->free);
        }

        if ($inputDto->value !== null) {
            $EventRcc->setValue($inputDto->value);
        }
        
        if ($inputDto->startDate !== null) {
            $EventRcc->setStartDate($inputDto->startDate);
        }
        
        if ($inputDto->endDate !== null) {
            $EventRcc->setEndDate($inputDto->endDate);
        }
        
        if ($inputDto->online !== null) {
            $EventRcc->setOnline($inputDto->online);
        }

        if ($inputDto->inPerson !== null) {
            $EventRcc->setinPerson($inputDto->inPerson);
        }

        return $EventRcc;
    }

    public function createOutputDtoFromEntity(EventRcc $EventRcc) : EventRccOutputDTO{
        return new EventRccOutputDTO( 
            id:$EventRcc->getId(),
            name:$EventRcc->getName(),
            type:$EventRcc->getType(),
            free:$EventRcc->isFree(),
            value:$EventRcc->getValue(),
            startDate:$EventRcc->getStartDate(),
            endDate:$EventRcc->getEndDate(),
            online:$EventRcc->isOnline(),
            inPerson:$EventRcc->isInPerson()
        );

    }

    public function  createOutputDtoListFromEntities(array $entities) : array {
        
        return array_map([$this, 'createOutputDtoFromEntity'], $entities);
    }

}