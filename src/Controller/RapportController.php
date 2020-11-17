<?php

namespace App\Controller;

use App\Entity\Medicament;
use App\Entity\Offrir;
use App\Entity\Praticien;
use App\Form\RapportType;
use App\Entity\RapportVisite;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function create(Request $request, EntityManagerInterface $manager){
        //Creation de form
        $rapport_visite = new RapportVisite();

        
        $form = $this->createForm(RapportType::class, $rapport_visite);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           // $manager = $this->getDoctrine()->getManager();
         
            $manager->persist($rapport_visite);
            $manager->flush();

            
            $this->addFlash(
                'success',
                "Le rapport a bien été enregistrée ! "
            );
            //  return $this->redirectToRoute();
        }

        return $this->render('rapport/new.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
