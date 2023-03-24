<?php

namespace App\Controller;

use App\Repository\HunterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMapsController extends AbstractController
{
    #[Route('/admin/maps', name: 'app_admin_maps')]
    public function index(HunterRepository $hunterRepository): Response
    {


        $markers =  $hunterRepository->findAll([]);


        return $this->render('admin_maps/index.html.twig', [
            'controller_name' => 'AdminMapsController',
            'markers' => $markers,

        ]);
    }

    #[Route('/admin/maps/load', name: 'app_admin_maps_load')]
    public function load(HunterRepository $hunterRepository): Response
    {


        $markers =  $hunterRepository->findAll([]);


        return $this->json($markers);
    }
}
