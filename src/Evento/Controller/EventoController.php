<?php

namespace App\Evento\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


final class EventoController extends AbstractController
{
    public function __construct()
    { }


    #[Route('/evento', name: 'app_evento')]
    public function index(Request $request): JsonResponse
    {
        return $this->json(
        ['']
        );
    }
}
