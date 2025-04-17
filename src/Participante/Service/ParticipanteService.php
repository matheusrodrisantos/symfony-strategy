<?php

namespace App\Participante\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;

use App\Participante\DTO\{ParticipanteInputDTO,ParticipanteOutputDTO};

use App\Participante\Entity\Participante;
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

    public function save(ParticipanteInputDTO $participanteInputDTO){
        
        $participante=$participanteInputDTO->toEntity();
        $this->em->persist($participante);
        $this->em->flush();

    }

    public function validate(array $data): ParticipanteInputDTO|array {

        $dataNascimento = null;
        $errors = '';
    
        if (isset($data['dataNascimento'])) {
            try {
                $dataNascimento = new \DateTimeImmutable($data['dataNascimento']);
            } catch (\Exception $e) {
                $errors[] = ['property' => 'dataNascimento', 'message' => 'Data de nascimento inválida'];
            }
        }
    
        $participanteInputDto = new ParticipanteInputDTO(
            nome: $data['nome'] ?? null,
            cpf: $data['cpf'] ?? null,
            dataNascimento: $dataNascimento,
            email: $data['email'] ?? null,
            numero: $data['numero'] ?? null,
            aceiteLgpd: $data['aceiteLgpd'] ?? null
        );
    
        $dtoValidationErrors = $this->validator->validate($participanteInputDto);
    
        if (count($dtoValidationErrors) > 0) {
            foreach ($dtoValidationErrors as $error) {
                $errors.="property:". $error->getPropertyPath().
                    " message:" . $error->getMessage()."  \n";
            }
        }
    
        if (!empty($errors)) {
            throw new ValidatorException($errors);
        }
    
        return $participanteInputDto;
    }

}