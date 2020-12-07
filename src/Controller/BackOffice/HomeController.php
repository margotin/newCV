<?php

namespace App\Controller\BackOffice;

use App\Entity\Home;
use App\Form\HomeType;
use App\Repository\HomeRepository;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN", statusCode=404, message="Page non trouvée...")
 */
class HomeController extends AbstractController
{
    /**
     * @Route(name="manage_home")
     */
    public function manage(Request $request, HomeRepository $homeRepository): Response
    {
        $home = $homeRepository->findAll();

        if (empty($home)) {
            $home = new Home();
        } else if (count($home) === 1) {
            $home = $home[0];
        } else {
            $this->addFlash("error", "La table Home contient plus d'une ligne.");
            return $this->redirectToRoute('manage_home');
        }

        $form = $this->createForm(HomeType::class, $home);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form['image']->getData();
            if ($file !== null) {
                $directory = $this->getParameter('kernel.project_dir') . '/public/uploads/';
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFileName = sprintf('%s-%s.%s', $safeFilename, uniqid(), $file->guessExtension());
                $file->move($directory, $newFileName);
                if (!empty($home->getImage())) {
                    unlink($this->getParameter('kernel.project_dir') . '/public' . $home->getImage());
                }
                $home->setImage('/uploads/' . $newFileName);
            }
            $home->setContent(trim($home->getContent()));


            $this->getDoctrine()->getManager()->persist($home);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La page d'accueil a été modifiée avec succès !");
            return $this->redirectToRoute('manage_home');
        }



        return $this->render('back_office/home/manage.html.twig', [
            'form' => $form->createView(),
            'home' => $home
        ]);
    }
}
