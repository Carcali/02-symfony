<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
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

        /*$program = new Program();
        $program->setTitle('Arcane');
        $program->setCategory($this->getReference('category_Animation'));
        $program->setSynopsis('Raconte l\'intensification des tensions entre deux villes suite à l\'apparition de nouvelles inventions qui menacent de provoquer une véritable révolution.');
        $program->setPoster('');
        $program->setCountry('France');
        $program->setYear(2021);
        $this->addReference('program_Arcane', $program);
        $manager->persist($program);
        $manager->flush();*/

        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $program = new Program();
            $program->setTitle($faker->title());
            $program->setCategory($this->getReference('category_' . rand(0, 14)));
            $program->setSynopsis($faker->paragraphs(3, true));
            $program->setCountry($faker->country());
            $program->setYear($faker->year());
            $manager->persist($program);
            $this->addReference('program_' . $i, $program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
