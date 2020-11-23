<?php

namespace App\Controller;

use App\Entity\RapportVisite;
use App\Form\RapportType;
use App\Repository\RapportVisiteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VisiteurRapportController extends AbstractController
{
    /**
     * @Route("/rapports/{page<\d+>?1}", name="visiteur_rapports_index")
     */
    public function index(RapportVisiteRepository $repo, $page)
    {
        $limit = 10;
        $start = $page * $limit - $limit;

        //Calcul des pages
        $total = count($repo->findAll());
        $pages = ceil($total / $limit);

        return $this->render('rapport/index.html.twig', [
           'rapports' => $repo->findBy([], [], $limit, $start),
           'pages' => $pages,
           'page' => $page
        ]);
    }
   
   
   /**
    * Permet d'afficher le formulaire d'edition
    *
    *@Route("/rapports/{id}/edit" , name="admin_rapports_edit")
    * @param RapportVisite $rapport
    * @return Response
    */
    public function edit(RapportVisite $rapport){
        $form = $this->createForm(RapportType::class, $rapport);
        return $this->render('admin/rapport/edit.html.twig' , [
            'rapport' => $rapport,
            'form' => $form->createView()
        ]);
    }
}
