<?php

namespace App\EventRegistration\Factory;

use App\Shared\DTO\InputDto;
use App\Shared\DTO\OutputDto;
use App\EventRegistration\Entity\EventRegistration;
use App\EventRegistration\DTO\EventRegistrationInputDTO;
use App\EventRegistration\DTO\EventRegistrationOutputDTO;
use App\User\Repository\UserRepository;
use App\Event\Repository\EventRepository;

class EventRegistrationFactory
{
    private UserRepository $userRepository;
    private EventRepository $eventRepository;

    public function __construct(UserRepository $userRepository, EventRepository $eventRepository)
    {
        $this->userRepository = $userRepository;
        $this->eventRepository = $eventRepository;
    }

    public function createEntityFromDto(InputDto $inputDto): EventRegistration
    {
        if (!$inputDto instanceof EventRegistrationInputDTO) {
            throw new \InvalidArgumentException('Invalid DTO type');
        }

        $user = $this->userRepository->find($inputDto->user);
        $event = $this->eventRepository->find($inputDto->event);

        if (!$user || !$event) {
            throw new \InvalidArgumentException('User or Event not found');
        }

        $eventRegistration = new EventRegistration();
        $eventRegistration->setUser($user);
        $eventRegistration->setEvent($event);

        return $eventRegistration;
    }

    public function updateEntityFromDto(EventRegistration $eventRegistration, InputDto $inputDto): EventRegistration
    {
        if (!$inputDto instanceof EventRegistrationInputDTO) {
            throw new \InvalidArgumentException('Invalid DTO type');
        }

        $user = $this->userRepository->find($inputDto->user);
        $event = $this->eventRepository->find($inputDto->event);

        if (!$user || !$event) {
            throw new \InvalidArgumentException('User or Event not found');
        }

        
        $eventRegistration->setUser($user);
        $eventRegistration->setEvent($event);

        return $eventRegistration;
    }

    public function createOutputDtoFromEntity(EventRegistration $eventRegistration): OutputDto
    {
        return new EventRegistrationOutputDTO(
            id: $eventRegistration->getId(),
            userId: $eventRegistration->getUser()?->getId(),
            eventId: $eventRegistration->getEvent()?->getId(),
            createdAt: $eventRegistration->getCreatedAt(),
            updatedAt: $eventRegistration->getUpdatedAt(),
        );
    }

    public function createOutputDtoListFromEntities(array $entities): array
    {
        return array_map([$this, 'createOutputDtoFromEntity'], $entities);
    }
}
