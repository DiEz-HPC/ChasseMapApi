<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMapsController extends AbstractController
{
    #[Route('/admin/maps', name: 'app_admin_maps')]
    public function index(): Response
    {
        return $this->render('admin_maps/index.html.twig', [
            'controller_name' => 'AdminMapsController',
        ]);
    }
}
