<?php

namespace App\Controller;

use DateTime;
use App\Entity\Hunter;
use App\Repository\HunterRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminFixtureController extends AbstractController 
{
    #[Route('/admin/fixture', name: 'app_admin_fixture')]
    public function index(EntityManagerInterface  $manager): Response
    {
        $faker = \Faker\Factory::create('fr_FR');
        $Type = [
            "Chasse a courre", "Chasse à l'arc", "chasse au gibier d'eau"
        ];
        for ($i = 0; $i < 50; $i++) {
            $date = new DateTime(rand(1, 7) . 'days');
            $hunter = new Hunter();
            $hunter->setLatitude($faker->latitude($min = 47, $max = 47));
            $hunter->setLongitude($faker->longitude($min = 1, $max = 3));
            $hunter->setDate($date);
            $hunter->setType($faker->randomElement($Type));
            $hunter->setRadius(rand(1, 10));
            $manager->persist($hunter);
        }
        $manager->flush();

        return $this->redirectToRoute('admin');
    }
}
