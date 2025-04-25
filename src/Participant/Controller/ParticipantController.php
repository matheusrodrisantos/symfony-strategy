<?php

namespace App\Participant\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse,Request,Response};
use Symfony\Component\Routing\Attribute\Route;

use App\Participant\Service\ParticipantService;

use App\Participant\DTO\ParticipantInputDTO;


use App\Service\{ValidatorJsonToDto,ResponseService};

final class ParticipantController extends AbstractController
{
    
    public function __construct(
        private ParticipantService $participantService,
        private ValidatorJsonToDto $validatorJsonToDto,
        private ResponseService $responseService
    ){}


    #[Route('/participant', name: 'app_participant_create', methods:['POST'])]
    public function create(Request $request): JsonResponse
    {
        try{
            
            $participantDto=$this->validatorJsonToDto->validate(
                data: $request->getContent(),
                pathDtoClass: ParticipantInputDTO::class,
                group:['create']
            );
          
            $dtoOutput=$this->participantService->save($participantDto);

            return $this->responseService->createSuccessResponse($dtoOutput->toArray(),Response::HTTP_CREATED); 

        }catch(\Exception $j){
         
            return $this->responseService->createErrorResponse($j->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/participant/{id}', name: 'app_participant_update', methods:['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        try{
            
            $participantDto=$this->validatorJsonToDto->validate(
                data:$request->getContent(),
                pathDtoClass:ParticipantInputDTO::class,
                group:['update']
            );
          
            $dtoOutput=$this->participantService->update($id, $participantDto);

            return $this->responseService->createSuccessResponse($dtoOutput->toArray(),Response::HTTP_CREATED); 

        }catch(\Exception $j){
         
            return $this->responseService->createErrorResponse($j->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/participant/{id}', 
    name: 'app_participant_delete', 
    methods:['DELETE'],
    requirements: ['id' => '\d+'])]
    public function delete(int $id): JsonResponse
    {
        try{
            $this->participantService->delete($id);
            return $this->responseService->createSuccessResponse(['DELETADO COM SUCESSO'],Response::HTTP_OK);
        }catch(\Exception $e){

            return $this->responseService->createErrorResponse($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    
    #[Route('/participant', name: 'app_participant_list', methods:['GET'])]
    public function list(): JsonResponse
    {
        try{
            return $this->responseService->createSuccessResponse($this->participantService->list(),Response::HTTP_OK);
        }catch(\Exception $e){
            return $this->responseService->createErrorResponse($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/participant/{id}', 
        name: 'app_participant_list_one', 
        methods:['GET'],
        requirements: ['id' => '\d+'])]
    public function listOneById(int $id): JsonResponse
    {
        try{
            return $this->responseService->createSuccessResponse($this->participantService->listById($id)
                ->toArray(),Response::HTTP_OK);
        }catch(\Exception $e){
            return $this->responseService->createErrorResponse($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/participant/email', name: 'participant_by_email', methods: ['GET'])]
    public function getByEmail(Request $request)
    {
        $email = $request->query->get('email');

        try{
            return $this->responseService->createSuccessResponse($this->participantService->listByEmail($email)
                ->toArray(),Response::HTTP_OK);

        }catch(\Exception $e){
            
            return $this->responseService->createErrorResponse($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }  
    }

 
}
