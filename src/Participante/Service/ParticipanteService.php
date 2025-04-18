<?php

namespace App\Participante\Service;


use App\Participante\DTO\{ParticipanteInputDTO,ParticipanteOutputDTO};

use App\Participante\Repository\ParticipanteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Exception\ValidatorException;


class ParticipanteService{


    public function __construct(
        private ValidatorInterface $validator,
        private EntityManagerInterface $em, 
        private ParticipanteRepository $participanteRepository
    ){}

    public function save(ParticipanteInputDTO $participanteInputDTO): ParticipanteOutputDTO{
        
        $participante=$participanteInputDTO->toEntity();
        $this->em->persist($participante);
        $this->em->flush();

        return ParticipanteOutputDTO::fromEntity($participante);
    }

    public function update(ParticipanteInputDTO $participanteInputDTO):ParticipanteOutputDTO{
        $participante=$participanteInputDTO->toEntity();
        $this->em->persist($participante);
        $this->em->flush();

        return ParticipanteOutputDTO::fromEntity($participante);
    }

}