<?php

namespace App\Controller;

use App\Repository\RapportVisiteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NbRapportController extends AbstractController
{
    /**
     * @Route("/nbrapport", name="nb_rapport")
     */
    public function index(RapportVisiteRepository $repo)
    {
       $nb_rapports = $repo->NbRapportVisite();
       //$nb_rapports= $repo->findAll();
        return $this->render('nb_rapport/NombreRapport.twig', [
            'nb_rapports' => $nb_rapports,
        ]);
    }
}
