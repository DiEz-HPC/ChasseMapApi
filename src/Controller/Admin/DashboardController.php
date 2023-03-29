<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\POI;
use App\Entity\User;
use App\Entity\Hunter;
use App\Entity\Obstacle;
use App\Entity\ReportedProblem;
use Doctrine\ORM\Cache\TimestampCacheKey;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use PhpParser\Node\Expr\New_;

class DashboardController extends AbstractDashboardController
{
    public function __construct(public EntityManagerInterface $entityManager)
    {

        return $entityManager;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $entities = $this->entityManager->getRepository(Hunter::class)->findByDate(new DateTime());
        $dateArr = [];

        foreach ($entities as $entitie) {

            $date = $entitie->getdate()->format('Y-m-d');
            if (array_key_exists($date, $dateArr)) {
                $dateArr[$date]++;
            } else {
                $dateArr[$date] = 1;
            }
        }

        for ($i = 0; $i <= 7; $i++) {
            $date = (new DateTime())->modify("+$i day")->format('Y-m-d');
            if (!array_key_exists($date, $dateArr)) {
                $dateArr += [$date => 0];
            }
        }
        ksort($dateArr);
        $jsonDates = json_encode($dateArr);

        return $this->render('admin/dashboard.html.twig', [
            'entities' => $entities,
            'countEntity' => count($entities),
            'jsonDates' => $jsonDates


        ]);
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
        yield MenuItem::subMenu('Hunter', 'fa-solid fa-map', Hunter::class)
            ->setSubItems([
                MenuItem::linkToCrud('Points', 'fas fa-map-marker-alt', Hunter::class),
                MenuItem::linkToRoute('Maps', 'fas fa-map-marked-alt', 'app_admin_maps')
            ]);
        yield MenuItem::linkToCrud('Obstacle', 'fa-solid fa-road-barrier', Obstacle::class);
        yield MenuItem::linkToCrud('POI', 'fas fa-list', POI::class);
        yield MenuItem::linkToCrud('Questions-Help', 'fa-solid fa-message', ReportedProblem::class);
    }
}
