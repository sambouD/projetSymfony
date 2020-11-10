<?php

namespace App\DataFixtures;

use App\Entity\ActiviteComplet;
use App\Entity\Medicament;
use Faker\Factory;
use App\Entity\Praticien;
use App\Entity\Visiteur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class Visiteurfixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        //ActiviteComplet
        for ($i=1; $i <=20 ; $i++) { 
           
            $activiteComplet = new ActiviteComplet();

            $acDate = $faker->dateTimeBetween('now', '+30 years');
            $acTheme = $faker->sentence();
            $acLieu = $faker->city();

            $activiteComplet->setAcDate($acDate)
                            ->setAcLieu($acLieu)
                            ->setAcTheme($acTheme);
        
            $manager->persist($activiteComplet);
        }

        //Praticien
        $genres = ["male" , "female"];

        for ($i=1; $i <=30 ; $i++) { 
            # code...
            $praticien = new Praticien();
            

            $praticien->setNom($faker->lastName())
                      ->setPrenom($faker->lastName($genres[mt_rand(0,1)]));
            
            $manager->persist($praticien);
        }

        //Visiteur

        for ($i=0; $i <= 40; $i++) { 
            $visiteur = new Visiteur();

       
            $login = $faker->userName();
            $mdp = $faker->password();
            $adresse = $faker->address();
            $cp = $faker->postcode();
            $ville = $faker->city(); 
            $dateEmbauche = $faker->dateTimeBetween('-20 years' , 'now');                               

            $visiteur->setNom($faker->lastName())
                     ->setPrenom($faker->lastName($genres[mt_rand(0,1)]))
                     ->setLogin($login)
                     ->setMdp($mdp)
                     ->setAdresse($adresse)
                     ->setCp($cp)
                     ->setVille($ville)
                     ->setDateEmbouche($dateEmbauche);
        
            $manager->persist($visiteur);  
        }

    //Medicament

        $medicaments=fopen(__DIR__."/medicaments.csv","r");
        while (!feof($medicaments)) {
          $lesmedicaments[]=fgetcsv($medicaments);
        }
        fclose($medicaments);

    foreach ($lesmedicaments as $value) {
      $medicament = new Medicament();
      $medicament->setId(intval($value[0]))
                ->setLibelle($value[1]);
        
        $manager->persist($medicament); 
    }

    //rapport_visite
    

        $manager->flush();
    }
}
