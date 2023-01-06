<?php

namespace App\DataFixtures;

use App\Entity\POI;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PoiFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $hunter = new POI();
            $hunter->setLatitude($faker->randomFloat());
            $hunter->setLongitude($faker->randomFloat());
            $hunter->setDate($faker->dateTime());
            $hunter->setTitle($faker->sentence());
            $hunter->setDescription($faker->text());
            $manager->persist($hunter);
        }

        $manager->flush();
    }
}
