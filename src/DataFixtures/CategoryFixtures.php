<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = ['Horreur', 'Action', 'Comédie', 'Drame', 'Science-fiction', 'Thriller', 'Fantaisie', 'Documentaire', 'Animation', 'Aventure', 'Mystère', 'Romance', 'Policier', 'Historique', 'Guerre', 'Super-héros', 'Western', 'Musical', 'Sport', 'Biographie', 'Politique', 'Cuisine', 'Jeunesse', 'Espionnage', 'Fantastique', 'Sitcom', 'Reality show', 'Téléréalité', 'Game show', 'Talk show', 'Variétés', 'Anthologie', 'Émission de voyage', 'Téléfilm', 'Soap opera', 'Art', 'Nature', 'Technologie', 'Éducation', 'Humour', 'Fashion', 'Web-série', 'Horreur', 'Action', 'Comédie', 'Drame', 'Science-fiction', 'Thriller', 'Fantaisie', 'Documentaire', 'Animation'];

        foreach ($categories as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
