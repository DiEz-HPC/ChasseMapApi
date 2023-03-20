<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\HunterRepository;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class MarkerController extends AbstractController
{
    public function __construct(private HunterRepository $hunterRepository)
    {
    }
    // This method calcul the distance between the user position and the markers position. 
    public function __invoke($lat, $long)
    {
        // Limit in meters
        $limit = 50000;

        $markers =  $this->hunterRepository->createQueryBuilder('h')
            ->select('h, ST_Distance_Sphere(POINT(h.latitude, h.longitude), POINT(:lat, :long)) as distance')
            ->where('ST_Distance_Sphere(POINT(h.latitude, h.longitude), POINT(:lat, :long)) < :limit')
            ->setParameter('lat', $lat)
            ->setParameter('long', $long)
            ->setParameter('limit', $limit)
            ->getQuery()
            ->getResult();

        return $this->json($markers);
    }
}
