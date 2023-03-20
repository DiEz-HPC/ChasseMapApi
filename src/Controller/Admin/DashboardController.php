<?php

namespace App\Controller\Admin;

use App\Entity\Hunter;
use App\Entity\Obstacle;
use App\Entity\POI;
use App\Entity\ReportedProblem;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ChasseMap - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Membres', 'fa-solid fa-user', User::class);
        yield MenuItem::linkToCrud('Hunter', 'fa-solid fa-map', Hunter::class);
        yield MenuItem::linkToCrud('Obstacle', 'fa-solid fa-road-barrier', Obstacle::class);
        yield MenuItem::linkToCrud('POI', 'fas fa-list', POI::class);
        yield MenuItem::linkToCrud('Questions-Help', 'fa-solid fa-message', ReportedProblem::class);
    }
}
