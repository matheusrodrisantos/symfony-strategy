<?php

namespace App\User\Factory;

use App\Shared\DTO\InputDto;
use App\Shared\DTO\OutputDto;
use App\Shared\ObjectValue\Cpf;
use App\User\Entity\User;
use App\User\DTO\UserInputDTO;
use App\User\DTO\UserOutputDTO;


class UserFactory
{
    public function createEntityFromDto(InputDto $userInputDto): User
    {
        if (!$userInputDto instanceof UserInputDTO) {
            throw new \InvalidArgumentException("Invalid DTO type");
        }

        $cpf = new Cpf($userInputDto->cpf);

        $user = new User();
        $user->setName($userInputDto->name)
            ->setCpf($cpf)
            ->setDateOfBirth(new \DateTimeImmutable($userInputDto->dateOfBirth))
            ->setEmail($userInputDto->email)
            ->setPhoneNumber($userInputDto->phoneNumber)
            ->setLgpdAcceptance($userInputDto->lgpdAcceptance);

        return $user;
    }

    public function updateEntityFromDto(User $user, InputDto $userInputDto): User
    {
        if (!$userInputDto instanceof UserInputDTO) {
            throw new \InvalidArgumentException("Invalid DTO type");
        }

        $user->setName($userInputDto->name)
            ->setCpf($userInputDto->cpf)
            ->setDateOfBirth(new \DateTimeImmutable($userInputDto->dateOfBirth))
            ->setEmail($userInputDto->email)
            ->setPhoneNumber($userInputDto->phoneNumber)
            ->setLgpdAcceptance($userInputDto->lgpdAcceptance);

        return $user;
    }

    public function createOutputDtoFromEntity(User $user): OutputDto
    {
        return new UserOutputDTO(
            id: $user->getId(),
            name: $user->getName(),
            cpf: $user->getCpf(),
            dateOfBirth: $user->getDateOfBirth(),
            email: $user->getEmail(),
            phoneNumber: $user->getPhoneNumber(),
            lgpdAcceptance: $user->isLgpdAcceptance(),
            createdAt: $user->getCreatedAt(),
            updatedAt: $user->getUpdatedAt()
        );
    }

    public function createOutputDtoListFromEntities(array $entities): array
    {
        return array_map([$this, 'createOutputDtoFromEntity'], $entities);
    }
}
