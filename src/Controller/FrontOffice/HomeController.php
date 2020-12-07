<?php

namespace App\Controller\FrontOffice;

use Exception;
use App\Entity\Home;
use App\Repository\HomeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(HomeRepository $homeRepository): Response
    {

        $home = $homeRepository->findAll();

        if (empty($home)) {
            $home = new Home();
        } else if (count($home) === 1) {
            $home = $home[0];
        } else {
            throw new Exception("La table HOME contient plus d'une ligne.");
        }       

        return $this->render('front_office/home/index.html.twig',[
            'home' => $home
        ]);
    }

    /**
     * @Route("/get-qualities", methods={"GET"})
     */
    public function getQualities(HomeRepository $homeRepository) : JsonResponse{
        $home = $homeRepository->findAll();

        if (empty($home)) {
            $home = new Home();
        } else if (count($home) === 1) {
            $home = $home[0];
        } else {
            throw new Exception("La table HOME contient plus d'une ligne.");
        }       

        return new JsonResponse($home->getTitle());

    }
}
