<?php

namespace App\EventRcc\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


final class EventRccController extends AbstractController
{
    public function __construct()
    { }


    #[Route('/event', name: 'app_event')]
    public function index(Request $request): JsonResponse
    {
        return $this->json(
        ['']
        );
    }
}
