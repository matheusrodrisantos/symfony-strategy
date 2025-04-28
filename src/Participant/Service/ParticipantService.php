<?php

namespace App\Participant\Service;


use App\Participant\DTO\ParticipantInputDTO;

use App\Participant\Repository\ParticipantRepository;
use App\Participant\Factory\ParticipantFactory;
use App\Shared\Service\ServiceCrudInterface;
use Exception;

use App\Shared\DTO\{InputDto,OutputDto};

class ParticipantService implements ServiceCrudInterface
{

    public function __construct(
        private ParticipantRepository $participantRepository,
        private ParticipantFactory $participantFactory
    ){}

    public function save(InputDto $participantInputDTO): OutputDto{
        
        if (!$participantInputDTO instanceof ParticipantInputDTO) {
            throw new Exception("Input DTO deve ser do tipo ParticipantInputDTO");
        }

        $participant=$this->participantFactory->createEntityFromDto($participantInputDTO);

        $this->participantRepository->save($participant);

        return $this->participantFactory->createOutputDtoFromEntity($participant);

    }

    public function update(int $id, InputDto $participantInputDTO) : OutputDto{
        
        if (!$participantInputDTO instanceof ParticipantInputDTO) {
            throw new Exception("Input DTO deve ser do tipo ParticipantInputDTO");
        }

        $participant = $this->participantRepository->find($id);

        if (!$participant) {
            throw new Exception("Participant não encontrado");
        }

        $this->participantFactory->updateEntityFromDto($participant, $participantInputDTO);

        $this->participantRepository->update($participant);

        return $this->participantFactory->createOutputDtoFromEntity($participant);
    }

    public function delete(int $id): void
    {
        $participant = $this->participantRepository->find($id);

        if (!$participant) {
            throw new Exception("Participant não encontrado");
        }

        $this->participantRepository->delete($participant);
    }

    public function list():array{

        $participants=$this->participantRepository->findAll();

        return $this->participantFactory->createOutputDtoListFromEntities($participants);

    }

    public function listById(int $id):OutputDto{

        $participant=$this->participantRepository->getOrFail($id);

        return $this->participantFactory->createOutputDtoFromEntity($participant);

    }


    public function listByEmail(string $email): OutputDto{

        $participant=$this->participantRepository->findOneBy(['email'=>$email],['id' => 'DESC']);
        if(!$participant){
            throw new Exception("Participant não encontrado");
        }
        return $this->participantFactory->createOutputDtoFromEntity($participant);
    }

}