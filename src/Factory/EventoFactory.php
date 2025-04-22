<?php

namespace App\Evento\Factory;

use App\Evento\DTO\EventoInputDTO;
use App\Evento\DTO\EventoOutputDTO;
use App\Evento\Entity\Evento;

class EventoFactory
{
    public function createEntityFromDto(EventoInputDTO $inputDto):Evento{
        
        $evento = new Evento();

        $evento->setName($inputDto->name);
        $evento->setTipo($inputDto->tipo);
        $evento->setAberto($inputDto->aberto);
        $evento->setValor($inputDto->valor);
        $evento->setDataInicio($inputDto->dataInicio);
        $evento->setDataFim($inputDto->dataFim);
        $evento->setOnline($inputDto->online);
        $evento->setPresencial($inputDto->presencial);

        return $evento;
    }

    public function updateEntityFromDto(Evento $evento, EventoInputDTO $inputDto):Evento {

        if ($inputDto->name !== null) {
            $evento->setName($inputDto->name);
        }
        
        if ($inputDto->tipo !== null) {
            $evento->setTipo($inputDto->tipo);
        }

        if ($inputDto->aberto !== null) {
            $evento->setAberto($inputDto->aberto);
        }

        if ($inputDto->valor !== null) {
            $evento->setValor($inputDto->valor);
        }
        
        if ($inputDto->dataInicio !== null) {
            $evento->setDataInicio($inputDto->dataInicio);
        }
        
        if ($inputDto->dataFim !== null) {
            $evento->setDataFim($inputDto->dataFim);
        }
        
        if ($inputDto->online !== null) {
            $evento->setOnline($inputDto->online);
        }

        if ($inputDto->presencial !== null) {
            $evento->setPresencial($inputDto->presencial);
        }

        return $evento;
    }

    public function createOutputDtoFromEntity(Evento $evento) : EventoOutputDTO{
        return new EventoOutputDTO( 
            id:$evento->getId(),
            name:$evento->getName(),
            tipo:$evento->getTipo(),
            aberto:$evento->getAberto(),
            valor:$evento->getValor(),
            dataInicio:$evento->getDataInicio(),
            dataFim:$evento->getDataFim(),
            online:$evento->isOnline(),
            presencial:$evento->isPresencial()
        );

    }

    public function  createOutputDtoListFromEntities(array $entities) : array {
        
        return array_map([$this, 'createOutputDtoFromEntity'], $entities);
    }

}