<?php

namespace App\EventRcc\Service;

use App\EventRcc\DTO\{EventRccOutputDTO,EventRccInputDTO};
use App\EventRcc\Factory\EventRccFactory;
use App\EventRcc\Repository\EventRccRepository;
use App\Shared\DTO\InputDto;
use App\Shared\DTO\OutputDto;
use App\Shared\Service\ServiceCrudInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EventRccService implements ServiceCrudInterface{

    public function __construct(
        private ValidatorInterface $validator,
        private EntityManagerInterface $em,
        private EventRccRepository $eventRepository,
        private EventRccFactory $eventRccFactory
    ){}

    public function save(InputDto $eventInputDTO): OutputDto{

        if (!$eventInputDTO instanceof EventRccInputDTO) {
            throw new \Exception("Input DTO deve ser do tipo ParticipantInputDTO");
        }

        $eventRcc=$this->eventRccFactory->createEntityFromDto($eventInputDTO);

        $this->eventRepository->save($eventRcc);

        return $this->eventRccFactory->createOutputDtoFromEntity($eventRcc);
    }

    public function update(int $id, InputDto $eventInputDTO): OutputDto{
        if (!$eventInputDTO instanceof EventRccInputDTO) {
            throw new \Exception("Input DTO deve ser do tipo ParticipantInputDTO");
        }

        $eventRcc=$this->eventRccFactory->createEntityFromDto($eventInputDTO);

        $this->eventRepository->save($eventRcc);

        return $this->eventRccFactory->createOutputDtoFromEntity($eventRcc);
    }

    public function delete(int $id): void{
        $participant = $this->eventRepository->find($id);

        if (!$participant) {
            throw new \Exception("Participant não encontrado");
        }

        $this->eventRepository->delete($participant);
    }

    public function list():array{

        $participants=$this->eventRepository->findAll();

        return $this->eventRccFactory->createOutputDtoListFromEntities($participants);
    }

    public function listById(int $id):OutputDto{
        
        $eventRcc=$this->eventRepository->getOrFail($id);

        return $this->eventRccFactory->createOutputDtoFromEntity($eventRcc);
    }

}