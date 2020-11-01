<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DegreesController extends AbstractController
{
    /**
     * @Route("/diplomes", name="degrees")
     */
    public function index(): Response
    {
        return $this->render('degrees/index.html.twig');
    }
}
