<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExperiencesController extends AbstractController
{
    /**
     * @Route("/experiences", name="experiences")
     */
    public function index(): Response
    {
        return $this->render('experiences/index.html.twig');
    }
}
