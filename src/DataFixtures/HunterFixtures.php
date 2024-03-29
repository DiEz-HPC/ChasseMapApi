<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Hunter;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Query\Expr\Math;

class HunterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        $Type = [
            "Chasse a courre", "Chasse à l'arc", "chasse au gibier d'eau"
        ];
        $coordonnée = [
            [
                "latitude" => 47.993905448634905,
                "longitude" => 2.069435859776751
            ],
            [
                "latitude" => 47.99950369398146,
                "longitude" => 2.096086288386268
            ],
            [
                "latitude" => 48.00475687868963,
                "longitude" => 2.059607845033345
            ],
            [
                "latitude" => 48.000000000000000,
                "longitude" => 2.000000000000000
            ],
            [
                "latitude" => 48.02066495256024,
                "longitude" => 2.0569045794465373
            ],
            [
                "latitude" => 48.02097342256024,
                "longitude" => 2.0569045794465373
            ],
            [
                "latitude" => 47.99428716287941,
                "longitude" => 2.1275711059570317
            ],
            [
                "latitude" => 47.834116704385984,
                "longitude" => 1.97230339050293
            ],
            [
                "latitude" => 47.83076044232549,
                "longitude" => 1.9774532318115237
            ],
            [
                "latitude" => 47.83044353082956,
                "longitude" => 1.958441734313965
            ]
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
    }
}
