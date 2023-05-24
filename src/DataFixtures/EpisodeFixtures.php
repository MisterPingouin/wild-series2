<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODES = [
        [
            'title' => 'John Wick à la plage',
            'number' => '1',
            'synopsis' => 'John Wick Fait boom boom bam bim',
            'season' => '1',
            'program' => 'John Wick'
        ],
        [
            'title' => 'John Wick à la montagne',
            'number' => '2',
            'synopsis' => 'John Wick Fait boom boom bam bim bem',
            'season' => '1',
            'program' => 'John Wick',
        ],
        [
            'title' => 'Paddington à la montagne',
            'number' => '1',
            'synopsis' => 'Paddington Fait boom boom bam bim bem',
            'season' => '1',
            'program' => 'Paddington',
        ],
        [
            'title' => 'Babar à la montagne',
            'number' => '1',
            'synopsis' => 'Babar Fait boom boom bam bim bem',
            'season' => '1',
            'program' => 'Babar',
        ],
        [
            'title' => 'Cleopatra à la montagne',
            'number' => '1',
            'synopsis' => 'Cleopatra Fait boom boom bam bim bem',
            'season' => '1',
            'program' => 'Cleopatra',
        ],
        [
            'title' => 'Bambi à la montagne',
            'number' => '1',
            'synopsis' => 'Bambi Fait boom boom bam bim bem',
            'season' => '1',
            'program' => 'Bambi',
        ],
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::EPISODES as $episodeInfo) {
            $episode = new Episode();
            $episode->setTitle($episodeInfo['title']);
            $episode->setNumber($episodeInfo['number']);
            $episode->setSynopsis($episodeInfo['synopsis']);
            $season = $this->getReference('season' . $episodeInfo['season'] . '_' . $episodeInfo['program']);
            $episode->setSeason($season);
            $manager->persist($episode);
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
