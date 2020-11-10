<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
