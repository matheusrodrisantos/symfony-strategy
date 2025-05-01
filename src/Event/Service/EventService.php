<?php

namespace App\Event\Service;

use App\Event\DTO\EventInputDTO;
use App\Event\Factory\EventFactory;
use App\Event\Repository\EventRepository;
use App\Shared\DTO\InputDto;
use App\Shared\DTO\OutputDto;
use App\Shared\Service\ServiceCrudInterface;

class EventService implements ServiceCrudInterface{

    public function __construct(
        private EventRepository $eventRepository,
        private EventFactory $eventFactory
    ){}

    public function save(InputDto $eventInputDTO): OutputDto{

        if (!$eventInputDTO instanceof EventInputDTO) {
            throw new \Exception("Input DTO deve ser do tipo EventInputDTO");
        }

        $event=$this->eventFactory->createEntityFromDto($eventInputDTO);

        $this->eventRepository->save($event);

        return $this->eventFactory->createOutputDtoFromEntity($event);
    }

    public function update(int $id, InputDto $eventInputDTO): OutputDto
    {
        if (!$eventInputDTO instanceof EventInputDTO) {
            throw new \Exception("Input DTO deve ser do tipo EventInputDTO");
        }
    
        $event = $this->eventRepository->getOrFail($id);
    
        $this->eventFactory->updateEntityFromDto($event, $eventInputDTO);
    
        $this->eventRepository->save($event); // ou `update`, dependendo da implementação
    
        return $this->eventFactory->createOutputDtoFromEntity($event);
    }
    

    public function delete(int $id): void{
        $participant = $this->eventRepository->find($id);

        if (!$participant) {
            throw new \Exception("Event não encontrado");
        }

        $this->eventRepository->delete($participant);
    }

    public function list():array{

        $participants=$this->eventRepository->findAll();

        return $this->eventFactory->createOutputDtoListFromEntities($participants);
    }

    public function listById(int $id):OutputDto{
        
        $event=$this->eventRepository->getOrFail($id);

        return $this->eventFactory->createOutputDtoFromEntity($event);
    }

}