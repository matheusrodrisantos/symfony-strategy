<?php

namespace App\Participante\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse,Request,Response};
use Symfony\Component\Routing\Attribute\Route;

use App\Participante\Service\ParticipanteService;

use App\Participante\DTO\ParticipanteInputDTO;


use App\Service\ValidatorJsonToDto;

final class ParticipanteController extends AbstractController
{
    
    public function __construct(
        private ParticipanteService $participanteService,
        private ValidatorJsonToDto $validatorJsonToDto
    ){}


    #[Route('/participante', name: 'app_participante_create', methods:['POST'])]
    public function create(Request $request): JsonResponse
    {
        try{
            
            $participanteDto=$this->validatorJsonToDto->validate(
                data: $request->getContent(),
                pathDtoClass: ParticipanteInputDTO::class,
                group:['create']
            );
          
            $dtoOutput=$this->participanteService->save($participanteDto);

            return new JsonResponse($dtoOutput->toArray(),201);

        }catch(\Exception $j){
         
            return $this->json(
                ['error' => 'An error : ' . $j->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    #[Route('/participante/{id}', name: 'app_participante_update', methods:['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        try{
            
            $participanteDto=$this->validatorJsonToDto->validate(
                data:$request->getContent(),
                pathDtoClass:ParticipanteInputDTO::class,
                group:['update']
            );
          
            $dtoOutput=$this->participanteService->update($id, $participanteDto);

            return new JsonResponse($dtoOutput,Response::HTTP_CREATED);

        }catch(\Exception $j){
         
            return $this->json(
                ['error' => 'An error : ' . $j->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
    
    #[Route('/participante/', name: 'app_participante_list', methods:['GET'])]
    public function list(): JsonResponse
    {
        try{
            return $this->json($this->participanteService->list());
        }catch(\Exception $e){
            return $this->json(
                ['error' => 'An error : ' . $e->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    #[Route('/participante/{id}', 
        name: 'app_participante_list_one', 
        methods:['GET'],
        requirements: ['id' => '\d+'])]
    public function listOneById(int $id): JsonResponse
    {
        try{
            return $this->json($this->participanteService->listById($id));
        }catch(\Exception $e){
            return $this->json(
                ['error' => 'An error : ' . $e->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    #[Route('/participante/email', name: 'participante_by_email', methods: ['GET'])]
    public function getByEmail(Request $request)
    {
        $email = $request->query->get('email');

        try{
            return $this->json($this->participanteService->listByEmail($email));

        }catch(\Exception $e){
            
            return $this->json(
                ['error' => 'An error : ' . $e->getMessage()],
                Response::HTTP_BAD_REQUEST
            );

        }  
    }

 
}
