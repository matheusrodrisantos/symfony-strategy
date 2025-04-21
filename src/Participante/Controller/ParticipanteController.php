<?php

namespace App\Participante\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse,Request,Response};
use Symfony\Component\Routing\Attribute\Route;

use App\Participante\Service\ParticipanteService;

use App\Participante\DTO\ParticipanteInputDTO;


use App\Service\{ValidatorJsonToDto,ResponseService};

final class ParticipanteController extends AbstractController
{
    
    public function __construct(
        private ParticipanteService $participanteService,
        private ValidatorJsonToDto $validatorJsonToDto,
        private ResponseService $responseService
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

            return $this->responseService->createSuccessResponse($dtoOutput->toArray(),Response::HTTP_CREATED); 

        }catch(\Exception $j){
         
            return $this->responseService->createErrorResponse($j->getMessage(),Response::HTTP_BAD_REQUEST);
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

            return $this->responseService->createSuccessResponse($dtoOutput->toArray(),Response::HTTP_CREATED); 

        }catch(\Exception $j){
         
            return $this->responseService->createErrorResponse($j->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/participante/{id}', 
    name: 'app_participante_delete', 
    methods:['DELETE'],
    requirements: ['id' => '\d+'])]
    public function delete(int $id): JsonResponse
    {
        try{
            $this->participanteService->delete($id);
            return $this->responseService->createSuccessResponse(['DELETADO COM SUCESSO'],Response::HTTP_OK);
        }catch(\Exception $e){

            return $this->responseService->createErrorResponse($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    
    #[Route('/participante', name: 'app_participante_list', methods:['GET'])]
    public function list(): JsonResponse
    {
        try{
            return $this->responseService->createSuccessResponse($this->participanteService->list(),Response::HTTP_OK);
        }catch(\Exception $e){
            return $this->responseService->createErrorResponse($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/participante/{id}', 
        name: 'app_participante_list_one', 
        methods:['GET'],
        requirements: ['id' => '\d+'])]
    public function listOneById(int $id): JsonResponse
    {
        try{
            return $this->responseService->createSuccessResponse($this->participanteService->listById($id)
                ->toArray(),Response::HTTP_OK);
        }catch(\Exception $e){
            return $this->responseService->createErrorResponse($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/participante/email', name: 'participante_by_email', methods: ['GET'])]
    public function getByEmail(Request $request)
    {
        $email = $request->query->get('email');

        try{
            return $this->responseService->createSuccessResponse($this->participanteService->listByEmail($email)
                ->toArray(),Response::HTTP_OK);

        }catch(\Exception $e){
            
            return $this->responseService->createErrorResponse($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }  
    }

 
}
