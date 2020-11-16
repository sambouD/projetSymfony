<?php

namespace App\Controller;

use App\Entity\Praticien;
use App\Entity\RapportVisite;
use App\Form\RapportType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RapportController extends AbstractController
{
    /**
     * @Route("/rapport", name="rapport_index")
     */
    public function index(): Response
    {
        return $this->render('/index.html.twig', [
            'controller_name' => 'RapportController',
        ]);
    }

    /**
     * Permet de créer le rapport de visite
     * 
     *@Route("/rapports/new", name="rapports_create")
     
     * @return Reponse
     */
    public function create(){
        //Creation de form
        $rapport_visite = new RapportVisite();
        
        $form = $this->createForm(RapportType::class, $rapport_visite);

        return $this->render('rapport/new.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
