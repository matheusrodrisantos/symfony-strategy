<?php

namespace App\Participante\Service;


use App\Participante\DTO\{ParticipanteInputDTO,ParticipanteOutputDTO};

use App\Participante\Repository\ParticipanteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Exception\ValidatorException;

use App\Participante\Factory\ParticipanteFactory;
use Exception;

class ParticipanteService{


    public function __construct(
        private ValidatorInterface $validator,
        private EntityManagerInterface $em, 
        private ParticipanteRepository $participanteRepository,
        private ParticipanteFactory $participanteFactory
    ){}

    public function save(ParticipanteInputDTO $participanteInputDTO): ParticipanteOutputDTO{
        
        $participante=$this->participanteFactory->createEntityFromDto($participanteInputDTO);

        $this->participanteRepository->save($participante);

        return $this->participanteFactory->createOutputDtoFromEntity($participante);

    }

    public function update(int $id, ParticipanteInputDTO $participanteInputDTO) : ParticipanteOutputDTO{
        
        $participante = $this->participanteRepository->find($id);

        if (!$participante) {
            throw new Exception("Participante não encontrado");
        }

        $this->participanteFactory->updateEntityFromDto($participante, $participanteInputDTO);

        $this->participanteRepository->update($participante);

        return $this->participanteFactory->createOutputDtoFromEntity($participante);
    }

    public function delete(int $id): void
    {
        $participante = $this->participanteRepository->find($id);

        if (!$participante) {
            throw new Exception("Participante não encontrado");
        }

        $this->participanteRepository->delete($participante);
    }

    public function list(){

        $participantes=$this->participanteRepository->findAll();

        return $this->participanteFactory->createOutputDtoListFromEntities($participantes);

    }

    public function listById(int $id){

        $participante=$this->participanteRepository->getOrFail($id);

        return $this->participanteFactory->createOutputDtoFromEntity($participante);

    }


    public function listByEmail(string $email){

        $participante=$this->participanteRepository->findOneBy(['email'=>$email],['id' => 'DESC']);

        return $this->participanteFactory->createOutputDtoFromEntity($participante);

    }


   

}