<?php

namespace App\Controller;

use App\Entity\RapportVisite;


use App\Repository\RapportVisiteRepository;
use App\Service\Pagination;
use App\Service\PaginationService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VisiteurRapportController extends AbstractController
{
    /**
     * @Route("/admin/rapports/{page<\d+>?1}", name="visiteur_rapports_index")
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
               

        return $this->render('admin/rapport/index.html.twig', [
          'pagination' =>$pagination
        ]);
    }
}
