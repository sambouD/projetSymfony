<?php

namespace App\DataFixtures;

use App\Entity\Praticien;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Visiteurfixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $praticien = new Praticien();
        $praticien->setNom("Nom de praticien")
                  ->setPrenom("Prenom de praticien");
        
        $manager->persist($praticien);
        $manager->flush();
    }
}
