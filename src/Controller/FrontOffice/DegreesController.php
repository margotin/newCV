<?php

namespace App\Controller\FrontOffice;

use App\Repository\DegreeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DegreesController extends AbstractController
{
    /**
     * @Route("/diplomes", name="degrees")
     */
    public function index(DegreeRepository $degreeRepository): Response
    {

        return $this->render('front_office/degrees/index.html.twig', [
            'degrees' => $degreeRepository->findAll()
        ]);
    }
}
