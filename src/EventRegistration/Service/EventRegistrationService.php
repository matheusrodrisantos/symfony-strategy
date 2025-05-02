<?php

namespace App\EventRegistration\Service;

use App\EventRegistration\DTO\EventRegistrationInputDTO;
use App\EventRegistration\Factory\EventRegistrationFactory;
use App\EventRegistration\Repository\EventRegistrationRepository;
use App\Shared\DTO\InputDto;
use App\Shared\DTO\OutputDto;
use App\Shared\Service\ServiceCrudInterface;

class EventRegistrationService implements ServiceCrudInterface
{
    public function __construct(
        private EventRegistrationRepository $eventRegistrationRepository,
        private EventRegistrationFactory $eventRegistrationFactory
    ) {}

    public function save(InputDto $input): OutputDto
    {
        if (!$input instanceof EventRegistrationInputDTO) {
            throw new \Exception("Input DTO deve ser do tipo EventRegistrationInputDTO");
        }


        

        
        $eventRegistration = $this->eventRegistrationFactory->createEntityFromDto($input);

        $this->eventRegistrationRepository->save($eventRegistration);
        
        return $this->eventRegistrationFactory->createOutputDtoFromEntity($eventRegistration);
    }

    public function update(int $id, InputDto $input): OutputDto
    {
        if (!$input instanceof EventRegistrationInputDTO) {
            throw new \Exception("Input DTO deve ser do tipo EventRegistrationInputDTO");
        }
        
        $eventRegistration = $this->eventRegistrationRepository->find($id);

        if (!$eventRegistration) {
            throw new \Exception("EventRegistration não encontrado");
        }

        
        $eventRegistration = $this->eventRegistrationFactory->updateEntityFromDto($eventRegistration, $input);

        
        $this->eventRegistrationRepository->save($eventRegistration);

        
        return $this->eventRegistrationFactory->createOutputDtoFromEntity($eventRegistration);
    }

    public function delete(int $id): void
    {
        
        $eventRegistration = $this->eventRegistrationRepository->find($id);

        if (!$eventRegistration) {
            throw new \Exception("EventRegistration não encontrado");
        }

        
        $this->eventRegistrationRepository->delete($eventRegistration);
    }

    public function list(): array
    {
        
        $eventRegistrations = $this->eventRegistrationRepository->findAll();

        
        return $this->eventRegistrationFactory->createOutputDtoListFromEntities($eventRegistrations);
    }

    public function listById(int $id): OutputDto
    {
        
        $eventRegistration = $this->eventRegistrationRepository->getOrFail($id);

        
        return $this->eventRegistrationFactory->createOutputDtoFromEntity($eventRegistration);
    }

    public function verifyIfCanRegister() {
        
    }
}
