<?php

namespace App\EventRcc\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\{Request,Response};
use Symfony\Component\Routing\Attribute\Route;

use App\EventRcc\DTO\{EventRccInputDTO,EventRccOutputDTO};
use App\EventRcc\Service\EventRccService;
use App\Shared\Validator\ValidatorJsonToDto;
use App\Shared\Service\ResponseService;

final class EventRccController extends AbstractController
{
    public function __construct(
        private EventRccService $eventRccService,
        private ValidatorJsonToDto $validatorJsonToDto,
        private ResponseService $responseService
    ){ }

    #[Route('/evento', name: 'app_event_create', methods:['POST'])]
    public function create(Request $request): JsonResponse
    {
        try{
            $eventRccDto=$this->validatorJsonToDto->validate(
                data:$request->getContent(),
                pathDtoClass:EventRccInputDTO::class,
                group:['create']
            );

            $eventRccOutputc=$this->eventRccService->save($eventRccDto);

            return $this->responseService->createSuccessResponse($eventRccOutputc->toArray(),Response::HTTP_CREATED); 

        }catch(\Exception $e){
            return $this->json('ERROR !'.$e->getMessage());   
        }
    }

    #[Route('/event/{id}', name: 'app_event_update', methods:['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        try{
            
            $eventRccDto=$this->validatorJsonToDto->validate(
                data:$request->getContent(),
                pathDtoClass:EventRccInputDTO::class,
                group:['update']
            );
          
            $dtoOutput=$this->eventRccService->update($id, $eventRccDto);

            return $this->responseService->createSuccessResponse($dtoOutput->toArray(),Response::HTTP_CREATED); 

        }catch(\Exception $j){
         
            return $this->responseService->createErrorResponse($j->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/participant/{id}', 
    name: 'app_event_rcc_delete', 
    methods:['DELETE'],
    requirements: ['id' => '\d+'])]
    public function delete(int $id): JsonResponse
    {
        try{
            $this->eventRccService->delete($id);
            return $this->responseService->createSuccessResponse(['DELETADO COM SUCESSO'],Response::HTTP_OK);
        }catch(\Exception $e){

            return $this->responseService->createErrorResponse($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    
    #[Route('/participant', name: 'app_event_rcc_list', methods:['GET'])]
    public function list(): JsonResponse
    {
        try{
            return $this->responseService->createSuccessResponse($this->eventRccService->list(),Response::HTTP_OK);
        }catch(\Exception $e){
            return $this->responseService->createErrorResponse($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/participant/{id}', 
        name: 'app_event_rcc_list_one', 
        methods:['GET'],
        requirements: ['id' => '\d+'])]
    public function listOneById(int $id): JsonResponse
    {
        try{
            return $this->responseService->createSuccessResponse($this->eventRccService->listById($id)
                ->toArray(),Response::HTTP_OK);
        }catch(\Exception $e){
            return $this->responseService->createErrorResponse($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }


}
