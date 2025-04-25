<?php

namespace App\Participant\Service;


use App\Participant\DTO\{ParticipantInputDTO,ParticipantOutputDTO};

use App\Participant\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Exception\ValidatorException;

use App\Participant\Factory\ParticipantFactory;
use Exception;

class ParticipantService{


    public function __construct(
        private ValidatorInterface $validator,
        private EntityManagerInterface $em, 
        private ParticipantRepository $participantRepository,
        private ParticipantFactory $participantFactory
    ){}

    public function save(ParticipantInputDTO $participantInputDTO): ParticipantOutputDTO{
        
        $participant=$this->participantFactory->createEntityFromDto($participantInputDTO);

        $this->participantRepository->save($participant);

        return $this->participantFactory->createOutputDtoFromEntity($participant);

    }

    public function update(int $id, ParticipantInputDTO $participantInputDTO) : ParticipantOutputDTO{
        
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

    public function list(){

        $participants=$this->participantRepository->findAll();

        return $this->participantFactory->createOutputDtoListFromEntities($participants);

    }

    public function listById(int $id){

        $participant=$this->participantRepository->getOrFail($id);

        return $this->participantFactory->createOutputDtoFromEntity($participant);

    }


    public function listByEmail(string $email){

        $participant=$this->participantRepository->findOneBy(['email'=>$email],['id' => 'DESC']);
        if(!$participant){
            throw new Exception("Participant não encontrado");
        }
        return $this->participantFactory->createOutputDtoFromEntity($participant);

    }


   

}