<?php

namespace App\Controller\BackOffice;

use App\Entity\School;
use App\Form\SchoolType;
use App\Repository\SchoolRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/ecoles")
 */
class SchoolController extends AbstractController
{
    /**
     * @Route(name="manage_school")
     */
    public function manage(SchoolRepository $schoolRepository): Response
    {
        return $this->render('back_office/school/manage.html.twig', [
            'schools' => $schoolRepository->findAll()
        ]);
    }

    /**
     * @Route("/creer", name="create_school")
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(SchoolType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $school = $form->getData();
            $this->getDoctrine()->getManager()->persist($school);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('manage_school');
        }

        return $this->render('back_office/school/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/{id<\d+>}/modifier", name="update_school")
     */
    public function update(Request $request, School $school): Response
    {
        $form = $this->createForm(SchoolType::class, $school);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "L'école a été modifiée avec succès !");
            return $this->redirectToRoute('manage_school');
        }

        return $this->render('back_office/school/update.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/{id<\d+>}/supprimer", name="delete_school")
     */
    public function delete(School $school): RedirectResponse
    {
        $this->getDoctrine()->getManager()->remove($school);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash("success", "L'école a été supprimée avec succès !");

        return $this->redirectToRoute('manage_school');
    }
}
