<?php

namespace App\Controller\FrontOffice;

use App\Repository\PortfolioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    /**
     * @Route("/portfolio", name="portfolio")
     */
    public function index(PortfolioRepository $portfolioRepository): Response
    {
        return $this->render('front_office/portfolio/index.html.twig',[
            'portfolio' => $portfolioRepository->findAll()
        ]);
    }
}
