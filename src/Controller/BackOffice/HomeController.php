<?php

namespace App\Controller\BackOffice;

use App\Repository\DegreeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN", statusCode=404, message="Page non trouvée...")
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
