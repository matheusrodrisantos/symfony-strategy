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

        // Cria a entidade EventRegistration a partir do DTO
        $eventRegistration = $this->eventRegistrationFactory->createEntityFromDto($input);

        // Salva a entidade no repositório
        $this->eventRegistrationRepository->save($eventRegistration);

        // Retorna o DTO de saída
        return $this->eventRegistrationFactory->createOutputDtoFromEntity($eventRegistration);
    }

    public function update(int $id, InputDto $input): OutputDto
    {
        if (!$input instanceof EventRegistrationInputDTO) {
            throw new \Exception("Input DTO deve ser do tipo EventRegistrationInputDTO");
        }

        // Busca a entidade EventRegistration existente
        $eventRegistration = $this->eventRegistrationRepository->find($id);

        if (!$eventRegistration) {
            throw new \Exception("EventRegistration não encontrado");
        }

        // Atualiza a entidade EventRegistration com os dados do DTO
        $eventRegistration = $this->eventRegistrationFactory->updateEntityFromDto($eventRegistration, $input);

        // Salva a entidade no repositório
        $this->eventRegistrationRepository->save($eventRegistration);

        // Retorna o DTO de saída
        return $this->eventRegistrationFactory->createOutputDtoFromEntity($eventRegistration);
    }

    public function delete(int $id): void
    {
        // Busca a entidade EventRegistration existente
        $eventRegistration = $this->eventRegistrationRepository->find($id);

        if (!$eventRegistration) {
            throw new \Exception("EventRegistration não encontrado");
        }

        // Deleta a entidade no repositório
        $this->eventRegistrationRepository->delete($eventRegistration);
    }

    public function list(): array
    {
        // Busca todas as entidades EventRegistration
        $eventRegistrations = $this->eventRegistrationRepository->findAll();

        // Retorna a lista de DTOs de saída
        return $this->eventRegistrationFactory->createOutputDtoListFromEntities($eventRegistrations);
    }

    public function listById(int $id): OutputDto
    {
        // Busca a entidade EventRegistration pelo ID
        $eventRegistration = $this->eventRegistrationRepository->getOrFail($id);

        // Retorna o DTO de saída
        return $this->eventRegistrationFactory->createOutputDtoFromEntity($eventRegistration);
    }
}
