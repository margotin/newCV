<?php

namespace App\Controller\BackOffice;

use App\Entity\Degree;
use App\Form\DegreeType;
use App\Repository\DegreeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @Route("/admin/diplomes")
 */
class DegreeController extends AbstractController
{
    /**
     * @Route(name="manage_degree")
     */
    public function manage(DegreeRepository $degreeRepository): Response
    {
        return $this->render('back_office/degree/manage.html.twig', [
            'degrees' => $degreeRepository->findAll()
        ]);
    }

    /**
     * @Route("/creer", name="create_degree")
     */
    public function create(Request $request): Response
    {

        $form = $this->createForm(DegreeType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $degree = $form->getData();
            $this->getDoctrine()->getManager()->persist($degree);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('manage_degree');
        }

        return $this->render('back_office/degree/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/{id<\d+>}/modifier", name="update_degree")
     */
    public function update(Request $request, Degree $degree): Response
    {
        $form = $this->createForm(DegreeType::class, $degree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Le diplôme a été modifié avec succès !");
            return $this->redirectToRoute('manage_degree');
        }

        return $this->render('back_office/degree/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id<\d+>}/supprimer", name="delete_degree")
     */
    public function delete(Degree $degree): RedirectResponse
    {
        $this->getDoctrine()->getManager()->remove($degree);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash("success", "Le diplôme a été supprimé avec succès !");

        return $this->redirectToRoute('manage_degree');
    }
}
