<?php

namespace App\Controller;

use App\Repository\SpecialiteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NbpraticienController extends AbstractController
{
    /**
     * @Route("/nbpraticien", name="nbpraticien")
     */
    public function index(SpecialiteRepository $repo): Response
    {

        $nbpratiens = $repo->nbpraticien();
        return $this->render('nbpraticien/nbpraticien.html.twig', [
            'nbpraticiens' =>   $nbpratiens,
        ]);
    }
}
