<?php

namespace App\Participante\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse,Request,Response};
use Symfony\Component\Routing\Attribute\Route;

use App\Participante\Service\ParticipanteService;
use App\Participante\Service\ParticipanteValidator;

final class ParticipanteController extends AbstractController
{
    
    public function __construct(
        private ParticipanteService $participanteService,
        private ParticipanteValidator $participanteValidator
    ){}


    #[Route('/participante', name: 'app_participante_create', methods:['POST'])]
    public function create(Request $request): JsonResponse
    {
        try{
            
            $participanteDto=$this->participanteValidator->validate($request->getContent());
          
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
    public function toUpdate(Request $request): JsonResponse
    {
        try{
            
            $participanteDto=$this->participanteValidator->validate($request->getContent());
            $dtoOutput=$this->participanteService->update($participanteDto);

            return new JsonResponse($dtoOutput->toArray(),201);

        }catch(\Exception $j){
         
            return $this->json(
                ['error' => 'An error : ' . $j->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    #[Route('/participante/', name: 'app_participante_list', methods:['GET'])]
    public function getAll(Request $request): JsonResponse
    {
        try{
            
            $participanteDto=$this->participanteValidator->validate($request->getContent());
            $dtoOutput=$this->participanteService->update($participanteDto);

            return new JsonResponse($dtoOutput->toArray(),201);

        }catch(\Exception $j){
         
            return $this->json(
                ['error' => 'An error : ' . $j->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    
}
