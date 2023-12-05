<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //src/DataFixtures/SeasonFixtures.php
        $season = new Season();
        $season->setNumber(1);
        $season->setProgram($this->getReference('program_Arcane'));
        $season->setYear(2021);
        $season->setDescription('Première saison de la série Arcane');
        $this->addReference('season1_Arcane', $season);
        $manager->persist($season);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
