<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASONS = [
        [
            'number' => '1',
            'year' => '2022',
            'description' => 'John Wick Fait boom boom',
            'program' => 'John Wick'
        ],
        [
            'number' => '2',
            'year' => '2023',
            'description' => 'John Wick Fait boom boom bim',
            'program' => 'John Wick'
        ],
        [
            'number' => '1',
            'year' => '2021',
            'description' => 'Paddington Fait boom boom bim',
            'program' => 'Paddington',
        ],
        [
            'number' => '1',
            'year' => '2022',
            'description' => 'Babar Fait boom boom bim',
            'program' => 'Babar',
        ],
        [
            'number' => '1',
            'year' => '2024',
            'description' => 'Cleopatra Fait boom boom bim',
            'program' => 'Cleopatra',
        ],
        [
            'number' => '1',
            'year' => '2020',
            'description' => 'Bambi Fait boom boom bim',
            'program' => 'Bambi',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SEASONS as $seasonInfo) {
            $season = new Season();
            $season->setNumber($seasonInfo['number']);
            $season->setYear($seasonInfo['year']);
            $season->setDescription($seasonInfo['description']);
            $program = $this->getReference('program_' . $seasonInfo['program']);
            $season->setProgram($program);
            $manager->persist($season);
            $this->addReference('season' . $seasonInfo['number'] . '_' . $seasonInfo['program'], $season);
        }
        $manager->flush();
    }
    public function getDependencies()
    {

        return [
    ProgramFixtures::class,
        ];
    }
}
