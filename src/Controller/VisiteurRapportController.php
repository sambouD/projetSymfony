<?php

namespace App\Controller;
use App\Service\Pagination;
use App\Service\PaginationService;
use App\Form\RapportType;
use App\Entity\RapportVisite;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RapportVisiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VisiteurRapportController extends AbstractController
{
    /**
     * @Route("/rapports/{page<\d+>?1}", name="visiteur_rapports_index")
     */
    public function index(RapportVisiteRepository $repo, $page, Pagination $pagination )
    {
       /* $limit = 10;
        $start = $page * $limit - $limit;

        //Calcul des pages
        $total = count($repo->findAll());
        $pages = ceil($total / $limit);*/
        $pagination->setEntityClass(RapportVisite::class)
                ->setPage($page);
               

<<<<<<< HEAD
        return $this->render('rapport/index.html.twig', [
          'pagination' =>$pagination
=======

        

        return $this->render('rapport/index.html.twig', [
          'pagination' =>$pagination

>>>>>>> b02c7ced654d5b9f32ec0ba7b8d1162aa9bdf10e
        ]);
    }
   
   
   /**
    * Permet d'afficher le formulaire d'edition
    *
    *@Route("/rapports/{id}/edit" , name="rapports_edit")
    * @param RapportVisite $rapport
    * @return Response
    */
    public function edit(RapportVisite $rapport, Request $request, EntityManagerInterface $manager ){
        $form = $this->createForm(RapportType::class, $rapport);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($rapport);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le rapport <strong>{$rapport->getId()}<strong> à bien été enregistrer !"
            );

        }
        return $this->render('rapport/edit.html.twig' , [
            'rapport' => $rapport,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet de supprimer un rapport de visite ! 
<<<<<<< HEAD
     *@Route("/rapports/{id}/delete", name="rapports_delete")
=======
     *@Route("/rapports/{id}/delete", name="admin_rapports_delete")
>>>>>>> b02c7ced654d5b9f32ec0ba7b8d1162aa9bdf10e
     * @param RapportVisite $rapport
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(RapportVisite $rapport, EntityManagerInterface $manager){
        if (count($rapport->getOffrirs()) > 0) {
           $this->addFlash(
               'warning',
               "Vous ne pouvez pas supprimer le rapport <strong>{$rapport->getId()} </strong> "

           );
        }

        else{
            $manager->remove($rapport);
            $manager->flush();
    
            $this->addFlash(
                'success',
                "Le rapport <strong>{$rapport->getId()}</strong> a bien été supprimée ! "
            );
        }

        return $this->redirectToRoute('visiteur_rapports_index');
    }


}
