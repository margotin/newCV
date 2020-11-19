<?php

namespace App\Controller\BackOffice;

use App\Repository\DegreeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
<<<<<<< HEAD
=======
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
>>>>>>> release/v1
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
<<<<<<< HEAD
=======
 * @IsGranted("ROLE_ADMIN", statusCode=404, message="Page non trouvée...")
>>>>>>> release/v1
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
