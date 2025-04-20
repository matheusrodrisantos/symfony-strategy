<?php

namespace App\Service;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Exception\ValidatorException;

class ValidatorJsonToDto{

    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorInterface $validator
    ){}

    public function validate($data, string $pathDtoClass ,array $group): ?object
    {
        $inputDto = $this->serializer->deserialize(
            $data,
            $pathDtoClass,
            'json'
        );

        $dtoValidationErrors = $this->validator->validate(value: $inputDto, groups: $group);
    
        if (count($dtoValidationErrors) > 0) {
            $errors = '';
            foreach ($dtoValidationErrors as $error) {
                $errors .= "property: " . $error->getPropertyPath() . 
                        " message: " . $error->getMessage() . " \n";
            }
            
            throw new ValidatorException($errors);
        }

        return $inputDto;

    }

}