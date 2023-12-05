<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    const PROGRAM = [
        "Pancho Villa : le Centaure du Nord" => [
            "synopsis" => "Découvrez l'incroyable destin de Doroteo Arango, un gamin qui débute sa vie du mauvais côté de la loi et devient 'Pancho Villa', un commandant redouté et la figure emblématique de la Révolution mexicaine.",
            "category" => "category_Aventure",
        ],
        "Castlevania" => [
            "synopsis" => "Un chasseur de vampires se bat pour sauver une ville qu'une armée de monstres, envoyée par Dracula en personne, a assiégée. Une série inspirée du célèbre jeu vidéo...",
            "category" => "category_Animation",
        ],
        "Dark" => [
            "synopsis" => "Un enfant disparu lance quatre familles dans une quête éperdue pour trouver des réponses. La chasse au coupable fait émerger les péchés et les secrets d'une petite ville...",
            "category" => "category_Fantastique",
        ],
        "Paranormal Revenge" => [
            "synopsis" => "Chaque épisode explore deux histoires glaçantes de rencontres paranormales réelles qui s'entrecroisent avec la vengeance.",
            "category" => "category_Horreur",
        ],
        "Black Knight" => [
            "synopsis" => "Dans un futur dystopique ravagé par la pollution de l'air, la survie de l'humanité dépend de livreurs atypiques surnommés les 'chevaliers noirs'...",
            "category" => "category_Action",
        ],
    ];

    public function load(ObjectManager $manager)
    {
        /*foreach (self::PROGRAM as $titleSerie => $content) {
            $program = new Program();
            $program->setTitle($titleSerie);
            $program->setSynopsis($content['synopsis']);
            $program->setCategory($this->getReference($content['category']));
            $manager->persist($program);
        }
        $manager->flush();*/
        //src/DataFixtures/ProgramFixtures.php

        $program = new Program();
        $program->setTitle('Arcane');
        $program->setCategory($this->getReference('category_Animation'));
        $program->setSynopsis('Raconte l\'intensification des tensions entre deux villes suite à l\'apparition de nouvelles inventions qui menacent de provoquer une véritable révolution.');
        $program->setPoster('');
        $program->setCountry('France');
        $program->setYear(2021);
        $this->addReference('program_Arcane', $program);
        $manager->persist($program);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
