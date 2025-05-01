<?php

namespace App\Event\Factory;

use App\Event\DTO\EventInputDTO;
use App\Event\DTO\EventOutputDTO;
use App\Event\Entity\Event;

class EventFactory
{
    public function createEntityFromDto(EventInputDTO $inputDto):Event{
        
        $event = new Event();

        $event->setName($inputDto->name);
        $event->setType($inputDto->type);
        $event->setFree($inputDto->free);
        $event->setValue($inputDto->value);
        $event->setStartDate($inputDto->startDate);
        $event->setEndDate($inputDto->endDate);
        $event->setOnline($inputDto->online);
        $event->setinPerson($inputDto->inPerson);

        return $event;
    }

    public function updateEntityFromDto(Event $event, EventInputDTO $inputDto):Event {

        if ($inputDto->name !== null) {
            $event->setName($inputDto->name);
        }
        
        if ($inputDto->type !== null) {
            $event->setType($inputDto->type);
        }

        if ($inputDto->free !== null) {
            $event->setFree($inputDto->free);
        }

        if ($inputDto->value !== null) {
            $event->setValue($inputDto->value);
        }
        
        if ($inputDto->startDate !== null) {
            $event->setStartDate($inputDto->startDate);
        }
        
        if ($inputDto->endDate !== null) {
            $event->setEndDate($inputDto->endDate);
        }
        
        if ($inputDto->online !== null) {
            $event->setOnline($inputDto->online);
        }

        if ($inputDto->inPerson !== null) {
            $event->setinPerson($inputDto->inPerson);
        }

        return $event;
    }

    public function createOutputDtoFromEntity(Event $event) : EventOutputDTO{
        return new EventOutputDTO( 
            id:$event->getId(),
            name:$event->getName(),
            type:$event->getType(),
            free:$event->isFree(),
            value:$event->getValue(),
            startDate:$event->getStartDate(),
            endDate:$event->getEndDate(),
            online:$event->isOnline(),
            inPerson:$event->isInPerson()
        );

    }

    public function  createOutputDtoListFromEntities(array $entities) : array {
        
        return array_map([$this, 'createOutputDtoFromEntity'], $entities);
    }

}