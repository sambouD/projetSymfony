<?php

namespace App\Controller;

use App\Repository\RapportVisiteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PraticienNbRapportController extends AbstractController
{
    /**
     * @Route("/praticien/nbrapport", name="praticien_nb_rapport")
     */
    public function index(RapportVisiteRepository $repo): Response
    {
        $praticien_nb_rapports = $repo->PraticienNbRapport();
        return $this->render('praticien_nb_rapport/praticienNbrapport.html.twig', [
            'praticien_nb_rapports' =>  $praticien_nb_rapports,
        ]);
    }
}
