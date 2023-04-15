<?php

namespace App\Controller;

use App\Repository\ObstacleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminObstacleController extends AbstractController
{
    #[Route('/admin/obstacle', name: 'app_admin_obstacle')]
    public function index(): Response
    {
        return $this->render('admin_obstacle/index.html.twig', [
            'controller_name' => 'AdminObstacleController',
        ]);
    }

    #[Route('/admin/obstacles/load', name: 'app_admin_obstacles_load')]
    public function load(ObstacleRepository $obstacleRepository): Response
    {


        $markers =  $obstacleRepository->findAll([]);


        return $this->json($markers);
    }
}
