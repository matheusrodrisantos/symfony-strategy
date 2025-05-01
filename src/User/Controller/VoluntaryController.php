<?php

namespace App\User\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use App\User\Service\VoluntaryService;
use App\User\DTO\VoluntaryInputDTO;
use App\Shared\Service\ResponseService;
use App\Shared\Validator\ValidatorJsonToDto;
use Exception;

class VoluntaryController extends AbstractController
{
    public function __construct(
        private VoluntaryService $voluntaryService,
        private ValidatorJsonToDto $validatorJsonToDto,
        private ResponseService $responseService
    ) {}

    #[Route('/voluntary', name: 'app_voluntary_list', methods: ['GET'])]
    public function list(): Response
    {
        try {
            return $this->responseService->createSuccessResponse($this->voluntaryService->list(), Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->responseService->createErrorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/voluntary', name: 'app_voluntary_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        try{
            $voluntaryDto=$this->validatorJsonToDto->validate(
                data:$request->getContent(),
                pathDtoClass: VoluntaryInputDTO::class,
                group:['create']
            );

            $voluntaryOutputDTO=$this->voluntaryService->save($voluntaryDto);

            return $this->responseService->createSuccessResponse($voluntaryOutputDTO->toArray(),Response::HTTP_CREATED); 

        }catch(\Exception $e){
            return $this->json('ERROR !'.$e->getMessage());   
        }
    }

    #[Route('/voluntary/{id}', name: 'app_voluntary_update', methods: ['PUT'], requirements: ['id' => '\d+'])]
    public function update(int $id, Request $request): JsonResponse
    {
        try {
            $voluntaryDto = $this->validatorJsonToDto->validate(
                data: $request->getContent(),
                pathDtoClass: VoluntaryInputDTO::class,
                group: ['update']
            );

            $voluntaryOutputDTO = $this->voluntaryService->update($id, $voluntaryDto);

            return $this->responseService->createSuccessResponse($voluntaryOutputDTO->toArray(), Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->responseService->createErrorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/voluntary/{id}', name: 'app_voluntary_delete', methods: ['DELETE'], requirements: ['id' => '\d+'])]
    public function delete(int $id): JsonResponse
    {
        try {
            $this->voluntaryService->delete($id);
            return $this->responseService->createSuccessResponse(['DELETADO COM SUCESSO'], Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->responseService->createErrorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/voluntary/{id}', name: 'app_voluntary_list_one', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function listOneById(int $id): JsonResponse
    {
        try {
            $voluntaryOutputDTO = $this->voluntaryService->listById($id);

            return $this->responseService->createSuccessResponse($voluntaryOutputDTO->toArray(), Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->responseService->createErrorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }





}
