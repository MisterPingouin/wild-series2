<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
    
        for($i = 0; $i < 10; $i++) {
            for($j = 0; $j < 4; $j++) { 
                for($k = 0; $k < 10; $k++) {
                    $episode = new Episode();
                    $episode->setTitle($faker->sentence());
                    $episode->setNumber($k + 1);
                    $episode->setSynopsis($faker->paragraphs(3, true));
                    $season = $this->getReference('season_' . $i . '_' . $j);
                    $episode->setSeason($season);
                    $manager->persist($episode);
                }
            }
        }
        
        $manager->flush();
    }
    
    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
