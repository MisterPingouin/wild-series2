<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        [
            'title' => 'John Wick',
            'synopsis' => 'Pan pan pan Bing Bing',
            'category' => 'Action',
        ],
        [
            'title' => 'Paddington',
            'synopsis' => 'Un ours maléfique',
            'category' => 'Aventure',
        ],
        [
            'title' => 'Babar',
            'synopsis' => 'Un éléphant ça trompe énormément',
            'category' => 'Animation',
        ],
        [
            'title' => 'Cleopatra',
            'synopsis' => 'Un faux docu',
            'category' => 'Fantastique',
        ],
        [
            'title' => 'Bambi',
            'synopsis' => 'Une biche tueuse',
            'category' => 'Horreur',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programInfo) {
            $program = new Program();
            $program->setTitle($programInfo['title']);
            $program->setSynopsis($programInfo['synopsis']);
            $category = $this->getReference('category_' . $programInfo['category']);
            $program->setCategory($category);
            $manager->persist($program);
            $this->addReference('program_' . $programInfo['title'], $program);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
        CategoryFixtures::class,
        ];
    }
}
