<?php

namespace App\DataFixtures;

use App\Entity\Obstacle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ObstacleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        $types = [
            "Arbre renversé", "Nid de poule", "Guêpe", "Trou"
        ];

        for ($i = 0; $i < 10; $i++) {
            $hunter = new Obstacle();
            $hunter->setLatitude($faker->randomFloat());
            $hunter->setLongitude($faker->randomFloat());
            $hunter->setDate($faker->dateTime());
            $hunter->setType($faker->randomElement($types));
            $hunter->setDescription($faker->text());
            $manager->persist($hunter);
        }

        $manager->flush();
    }
}
