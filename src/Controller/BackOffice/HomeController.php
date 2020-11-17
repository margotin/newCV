<?php

namespace App\Controller\BackOffice;

use App\Repository\DegreeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class HomeController extends AbstractController
{
    /**
     * @Route(name="manage_home")
     */
    public function manage(DegreeRepository $degreeRepository): Response
    {
        return $this->render('back_office/home/manage.html.twig');
    }
}
