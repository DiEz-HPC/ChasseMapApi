<?php

namespace App\DataFixtures;

use App\Entity\Feedback;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FeedbackFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {  
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $feedback = new Feedback();
            $feedback->setFirstname($faker->firstname());
            $feedback->setLastname($faker->lastname());
            $feedback->setEmail($faker->email());
            $feedback->setDescription($faker->paragraph());
            $feedback->setDate($faker->dateTime());
            $manager->persist($feedback);
        }

        $manager->flush();
    }
}
