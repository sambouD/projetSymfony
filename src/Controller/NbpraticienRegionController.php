<?php

namespace App\Controller;

use App\Repository\RegionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NbpraticienRegionController extends AbstractController
{
    /**
     * @Route("/nbpraticienregion", name="nbpraticien_region")
     */
    public function index(RegionRepository $repo): Response
    {
        $nbpratiens = $repo->NbRegion();
        return $this->render('nbpraticien_region/index.twig', [
            'nbpratiens' => $nbpratiens,
        ]);
    }

     /**
     * @Route("/listeRegion", name="liste_region")
     */
    public function listedeRegion(RegionRepository $repo): Response
    {


        $regions = $repo->findAll();
        return $this->render('nbpraticien_region/listeRegion.twig', [
            'regions' => $regions,
        ]);
    }
}
