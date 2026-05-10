<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $article = new Article();
            $article->setTitre("Titre de l'article n°$i")
                    ->setContenu("Ceci est le contenu détaillé de l'article n°$i. Il permet de tester l'affichage du CRUD.")
                    ->setAuteur("Auteur $i")
                    ->setDateCreation(new \DateTime())
                    ->setPublie(($i % 2 == 0)); 

            $manager->persist($article);
        }

        $manager->flush();
    }
}
