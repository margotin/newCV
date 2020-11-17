<?php

namespace App\Controller\FrontOffice;

use App\Repository\ExperienceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExperiencesController extends AbstractController
{
    /**
     * @Route("/experiences", name="experiences")
     */
    public function index(ExperienceRepository $experienceRepository): Response
    {
        return $this->render('front_office/experiences/index.html.twig',[
            'experiences' => $experienceRepository->findAll()
        ]);
    }
}
