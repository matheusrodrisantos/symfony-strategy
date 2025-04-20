<?php

namespace App\Participante\Factory;

use App\Participante\DTO\ParticipanteInputDTO;
use App\Participante\DTO\ParticipanteOutputDTO;
use App\Participante\Entity\Participante;

class ParticipanteFactory
{
    public function createEntityFromDto(ParticipanteInputDTO $inputDto):Participante{
        
        $participante = new Participante();

        $participante->setNome($inputDto->nome);
        $participante->setCpf($inputDto->cpf);
        $participante->setDataNascimento($inputDto->dataNascimento);
        $participante->setEmail($inputDto->email);
        $participante->setNumero($inputDto->numero);
        $participante->setAceiteLgpd($inputDto->aceiteLgpd);

        return $participante;
    }

    public function updateEntityFromDto(Participante $participante,ParticipanteInputDTO $inputDto):Participante{

        if ($inputDto->nome !== null) {
            $participante->setNome($inputDto->nome);
        }
        
        if ($inputDto->cpf !== null) {
            $participante->setCpf($inputDto->cpf);
        }

        if ($inputDto->dataNascimento !== null) {
            $participante->setDataNascimento($inputDto->dataNascimento);
        }

        if ($inputDto->email !== null) {
            $participante->setEmail($inputDto->email);
        }
        
        if ($inputDto->numero !== null) {
            $participante->setNumero($inputDto->numero);
        }
        
        if ($inputDto->aceiteLgpd !== null) {
            $participante->setAceiteLgpd($inputDto->aceiteLgpd);
        }
        
        return $participante;
    }

    public function createOutputDtoFromEntity(Participante $participante) : ParticipanteOutputDTO{
        return new ParticipanteOutputDTO( 
            id:$participante->getId(),
            nome:$participante->getNome(),
            cpf:$participante->getCpf(),
            dataNascimento:$participante->getDataNascimento(),
            email:$participante->getEmail(),
            numero:$participante->getNumero()
        );

    }

}