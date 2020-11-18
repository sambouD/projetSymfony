<?php

namespace App\Controller;

use App\Repository\RapportVisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VisiteurRapportController extends AbstractController
{
    /**
     * @Route("/admin/rapports/{page<\d+>?1}", name="visiteur_rapports_index")
     */
    public function index(RapportVisiteRepository $repo, $page)
    {
        $limit = 10;
        $start = $page * $limit - $limit;

        //Calcul des pages
        $total = count($repo->findAll());
        $pages = ceil($total / $limit);

        return $this->render('admin/rapport/index.html.twig', [
           'rapports' => $repo->findBy([], [], $limit, $start),
           'pages' => $pages,
           'page' => $page
        ]);
    }
}
