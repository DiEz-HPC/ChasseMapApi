<?php

namespace App\Controller;

use App\Repository\HunterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RandEntityController extends AbstractController
{
    #[Route('/api/entity', name: 'app_rand_entity')]
    public function index(HunterRepository $hunterRepository): Response
    {
        $hunter = $hunterRepository->findOneBy([]);
        return $this->json($hunter);
    }
}
