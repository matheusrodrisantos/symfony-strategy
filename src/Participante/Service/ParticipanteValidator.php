<?php

namespace App\Participante\Service;

use App\Participante\DTO\ParticipanteInputDTO;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Exception\ValidatorException;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class ParticipanteValidator{

    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorInterface $validator
    ){}

    public function validate($data): ParticipanteInputDTO
    {
        $participanteInputDto = $this->serializer->deserialize(
            $data,
            ParticipanteInputDTO::class,
            'json'
        );

        $dtoValidationErrors = $this->validator->validate($participanteInputDto);
    
        if (count($dtoValidationErrors) > 0) {
            $errors = '';
            foreach ($dtoValidationErrors as $error) {
                $errors .= "property: " . $error->getPropertyPath() . 
                        " message: " . $error->getMessage() . " \n";
            }
            
            throw new ValidatorException($errors);
        }
        
        return $participanteInputDto;
    }

    

}