<?php

namespace App\Event\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\{Request,Response};
use Symfony\Component\Routing\Attribute\Route;

use App\Event\DTO\EventInputDTO;
use App\Event\Service\EventService;
use App\Shared\Validator\ValidatorJsonToDto;
use App\Shared\Service\ResponseService;

final class EventController extends AbstractController
{
    public function __construct(
        private EventService $eventService,
        private ValidatorJsonToDto $validatorJsonToDto,
        private ResponseService $responseService
    ){ }

    #[Route('/event', name: 'app_event_create', methods:['POST'])]
    public function create(Request $request): JsonResponse
    {
        try{
            $eventDto=$this->validatorJsonToDto->validate(
                data:$request->getContent(),
                pathDtoClass:EventInputDTO::class,
                group:['create']
            );

            $eventOutputc=$this->eventService->save($eventDto);

            return $this->responseService->createSuccessResponse($eventOutputc->toArray(),Response::HTTP_CREATED); 

        }catch(\Exception $e){
            return $this->json('ERROR !'.$e->getMessage());   
        }
    }

    #[Route('/event/{id}', name: 'app_event_update', methods:['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        try{
            
            $eventDto=$this->validatorJsonToDto->validate(
                data:$request->getContent(),
                pathDtoClass:EventInputDTO::class,
                group:['update']
            );
          
            $dtoOutput=$this->eventService->update($id, $eventDto);

            return $this->responseService->createSuccessResponse($dtoOutput->toArray(),Response::HTTP_CREATED); 

        }catch(\Exception $j){
         
            return $this->responseService->createErrorResponse($j->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/event/{id}', 
    name: 'app_event_rcc_delete', 
    methods:['DELETE'],
    requirements: ['id' => '\d+'])]
    public function delete(int $id): JsonResponse
    {
        try{
            $this->eventService->delete($id);
            return $this->responseService->createSuccessResponse(['DELETADO COM SUCESSO'],Response::HTTP_OK);
        }catch(\Exception $e){

            return $this->responseService->createErrorResponse($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    
    #[Route('/event', name: 'app_event_rcc_list', methods:['GET'])]
    public function list(): JsonResponse
    {
        try{
            return $this->responseService->createSuccessResponse($this->eventService->list(),Response::HTTP_OK);
        }catch(\Exception $e){
            return $this->responseService->createErrorResponse($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/event/{id}', 
        name: 'app_event_rcc_list_one', 
        methods:['GET'],
        requirements: ['id' => '\d+'])]
    public function listOneById(int $id): JsonResponse
    {
        try{
            return $this->responseService->createSuccessResponse($this->eventService->listById($id)
                ->toArray(),Response::HTTP_OK);
        }catch(\Exception $e){
            return $this->responseService->createErrorResponse($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }


}
