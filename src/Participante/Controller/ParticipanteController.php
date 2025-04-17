<?php

namespace App\Participante\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse,Request,Response};
use Symfony\Component\Routing\Attribute\Route;

use App\Participante\Service\ParticipanteService;

final class ParticipanteController extends AbstractController
{
    
    public function __construct(private ParticipanteService $participanteService){}


    #[Route('/participante', name: 'app_participante', methods:['POST'])]
    public function index(Request $request): JsonResponse
    {
        try{
            $data=$request->toArray();
          
            $participanteDto=$this->participanteService->validate($data);
          
            $dtoOutput=$this->participanteService->save($participanteDto);
            return new JsonResponse($dtoOutput->toArray());
            return new JsonResponse(['mensagem' => 'Participante salvo com sucesso!'], 201);
        }catch(\Exception $j){
         
            return $this->json(
                ['error' => 'An error : ' . $j->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }
        
    }
}
