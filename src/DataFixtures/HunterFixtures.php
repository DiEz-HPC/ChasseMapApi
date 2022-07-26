<?php

namespace App\DataFixtures;

use App\Entity\Hunter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HunterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        $Type = [
            "Chasse a courre", "Chasse à l'arc", "chasse au gibier d'eau"
        ];

        for ($i=0; $i < 10; $i++) { 
            $hunter = new Hunter();
            $hunter->setLatitude($faker->randomFloat());
            $hunter->setLongitude($faker->randomFloat());
            $hunter->setDate($faker->dateTime());
            $hunter->setType($faker->randomElement($Type));
            $hunter->setRadius(rand(1, 10));
            $manager->persist($hunter);
        }
       

        $manager->flush();
    }
}
