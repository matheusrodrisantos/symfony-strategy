<?php

namespace App\User\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use App\User\Service\UserService;
use App\User\DTO\UserInputDTO;
use App\Shared\Service\ResponseService;
use App\Shared\Validator\ValidatorJsonToDto;
use Exception;

class UserController extends AbstractController
{
    public function __construct(
        private UserService $userService,
        private ValidatorJsonToDto $validatorJsonToDto,
        private ResponseService $responseService
    ) {}

    #[Route('/user', name: 'app_user_list', methods: ['GET'])]
    public function list(): Response
    {
        try {
            return $this->responseService->createSuccessResponse(
                $this->userService->list(),
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return $this->responseService->createErrorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/user/{id}', name: 'app_user_get', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function listOneById(int $id): JsonResponse
    {
        try {
            return $this->responseService->createSuccessResponse(
                $this->userService->listById($id)->toArray(),
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return $this->responseService->createErrorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/user', name: 'app_user_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        try {
            $inputDto = $this->validatorJsonToDto->validate(
                data: $request->getContent(),
                pathDtoClass: userInputDTO::class,
                group: ['create']
            );

            $dtoOutput = $this->userService->save($inputDto);

            return $this->responseService->createSuccessResponse($dtoOutput->toArray(), Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->responseService->createErrorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/user/{id}', name: 'app_user_update', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        try {
            $inputDto = $this->validatorJsonToDto->validate(
                data: $request->getContent(),
                pathDtoClass: userInputDTO::class,
                group: ['update']
            );

            $dtoOutput = $this->userService->update($id, $inputDto);

            return $this->responseService->createSuccessResponse($dtoOutput->toArray(), Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->responseService->createErrorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/user/{id}', name: 'app_user_delete', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        try {
            $this->userService->delete($id);
            return $this->responseService->createSuccessResponse(['DELETADO COM SUCESSO'], Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->responseService->createErrorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }



}
