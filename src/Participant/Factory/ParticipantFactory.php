<?php

namespace App\Participant\Factory;

use App\Participant\DTO\ParticipantInputDTO;
use App\Participant\DTO\ParticipantOutputDTO;
use App\Participant\Entity\Participant;

class ParticipantFactory
{
    public function createEntityFromDto(ParticipantInputDTO $inputDto): Participant
    {
        $participant = new Participant();

        $participant->setName($inputDto->name);
        $participant->setCpf($inputDto->cpf);
        $participant->setDateOfBirth($inputDto->dateOfBirth);
        $participant->setEmail($inputDto->email);
        $participant->setPhoneNumber($inputDto->phoneNumber);
        $participant->setLgpdAcceptance($inputDto->lgpdAcceptance);

        return $participant;
    }

    public function updateEntityFromDto(Participant $participant, ParticipantInputDTO $inputDto): Participant
    {
        if ($inputDto->name !== null) {
            $participant->setName($inputDto->name);
        }

        if ($inputDto->cpf !== null) {
            $participant->setCpf($inputDto->cpf);
        }

        if ($inputDto->dateOfBirth !== null) {
            $participant->setDateOfBirth($inputDto->dateOfBirth);
        }

        if ($inputDto->email !== null) {
            $participant->setEmail($inputDto->email);
        }

        if ($inputDto->phoneNumber !== null) {
            $participant->setPhoneNumber($inputDto->phoneNumber);
        }

        if ($inputDto->lgpdAcceptance !== null) {
            $participant->setLgpdAcceptance($inputDto->lgpdAcceptance);
        }

        return $participant;
    }

    public function createOutputDtoFromEntity(Participant $participant): ParticipantOutputDTO
    {
        return new ParticipantOutputDTO(
            id: $participant->getId(),
            name: $participant->getName(),
            cpf: $participant->getCpf(),
            dateOfBirth: $participant->getDateOfBirth(),
            email: $participant->getEmail(),
            phoneNumber: $participant->getPhoneNumber()
        );
    }

    public function createOutputDtoListFromEntities(array $entities): array
    {
        return array_map([$this, 'createOutputDtoFromEntity'], $entities);
    }
}
