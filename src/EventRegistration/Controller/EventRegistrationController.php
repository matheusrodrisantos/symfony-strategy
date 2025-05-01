<?php

namespace App\EventRegistration\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use App\EventRegistration\Service\EventRegistrationService;
use App\EventRegistration\DTO\EventRegistrationInputDTO;
use App\Shared\Service\ResponseService;
use App\Shared\Validator\ValidatorJsonToDto;
use Exception;

class EventRegistrationController extends AbstractController
{
    public function __construct(
        private EventRegistrationService $eventRegistrationService,
        private ValidatorJsonToDto $validatorJsonToDto,
        private ResponseService $responseService
    ) {}

    #[Route('/eventregistration', name: 'app_eventregistration_list', methods: ['GET'])]
    public function list(): Response
    {
        try {
            return $this->responseService->createSuccessResponse(
                $this->eventRegistrationService->list(),
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return $this->responseService->createErrorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/eventregistration/{id}', name: 'app_eventregistration_get', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function listOneById(int $id): JsonResponse
    {
        try {
            return $this->responseService->createSuccessResponse(
                $this->eventRegistrationService->listById($id)->toArray(),
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return $this->responseService->createErrorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/eventregistration', name: 'app_eventregistration_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        try {
            $inputDto = $this->validatorJsonToDto->validate(
                data: $request->getContent(),
                pathDtoClass: eventRegistrationInputDTO::class,
                group: ['create']
            );

            $dtoOutput = $this->eventRegistrationService->save($inputDto);

            return $this->responseService->createSuccessResponse($dtoOutput->toArray(), Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->responseService->createErrorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/eventregistration/{id}', name: 'app_eventregistration_update', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        try {
            $inputDto = $this->validatorJsonToDto->validate(
                data: $request->getContent(),
                pathDtoClass: eventRegistrationInputDTO::class,
                group: ['update']
            );

            $dtoOutput = $this->eventRegistrationService->update($id, $inputDto);

            return $this->responseService->createSuccessResponse($dtoOutput->toArray(), Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->responseService->createErrorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/eventregistration/{id}', name: 'app_eventregistration_delete', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        try {
            $this->eventRegistrationService->delete($id);
            return $this->responseService->createSuccessResponse(['DELETADO COM SUCESSO'], Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->responseService->createErrorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }



}
