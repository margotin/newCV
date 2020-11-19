<?php

namespace App\Controller\BackOffice;

use App\Entity\Experience;
use App\Form\ExperienceType;
use App\Repository\ExperienceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/experiences")
 * @IsGranted("ROLE_ADMIN", statusCode=404, message="Page non trouvée...")
 */
class ExperienceController extends AbstractController
{
    /**
     * @Route(name="manage_experience")
     */
    public function manage(ExperienceRepository $experienceRepository): Response
    {
        return $this->render('back_office/experience/manage.html.twig', [
            'experiences' => $experienceRepository->findAll()
        ]);
    }

    /**
     * @Route("/creer", name="create_experience")
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(ExperienceType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $experience = $form->getData();
            $this->getDoctrine()->getManager()->persist($experience);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('manage_experience');
        }

        return $this->render('back_office/experience/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/{id<\d+>}/modifier", name="update_experience")
     */
    public function update(Request $request, Experience $experience): Response
    {
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "L'expérience a été modifiée avec succès !");
            return $this->redirectToRoute('manage_experience');
        }

        return $this->render('back_office/experience/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id<\d+>}/supprimer", name="delete_experience")
     */
    public function delete(Experience $experience): RedirectResponse
    {
        $this->getDoctrine()->getManager()->remove($experience);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash("success", "L'expérience a été supprimée avec succès !");

        return $this->redirectToRoute('manage_experience');
    }
}
