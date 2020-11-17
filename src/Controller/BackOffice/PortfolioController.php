<?php

namespace App\Controller\BackOffice;

use App\Entity\Portfolio;
use App\Form\PortfolioType;
use App\Repository\PortfolioRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @Route("/admin/portfolio")
 */
class PortfolioController extends AbstractController
{
    /**
     * @Route(name="manage_portfolio")
     */
    public function manage(PortfolioRepository $portfolioRepository): Response
    {
        return $this->render('back_office/portfolio/manage.html.twig', [
            'portfolio' => $portfolioRepository->findAll()
        ]);
    }

    /**
     * @Route("/creer", name="create_portfolio")
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(PortfolioType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $portfolio = $form->getData();
            $file = $form['image']->getData();
            $directory = $this->getParameter('kernel.project_dir') . '/public/uploads/';

            $file->move($directory, $file->getClientOriginalName());
            $portfolio->setImage('/uploads/' . $file->getClientOriginalName());

            $this->getDoctrine()->getManager()->persist($portfolio);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('manage_portfolio');
        }

        return $this->render('back_office/portfolio/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/{id<\d+>}/modifier", name="update_portfolio")
     */
    public function update(Request $request, Portfolio $portfolio): Response
    {


        $form = $this->createForm(PortfolioType::class, $portfolio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form['image']->getData();
            if ($file !== null) {
                $directory = $this->getParameter('kernel.project_dir') . '/public/uploads/';  
                $file->move($directory, $file->getClientOriginalName());
                unlink($this->getParameter('kernel.project_dir') . '/public' . $portfolio->getImage());
                $portfolio->setImage('/uploads/' . $file->getClientOriginalName());
            }

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Le portfolio a été modifié avec succès !");
            return $this->redirectToRoute('manage_portfolio');
        }

        return $this->render('back_office/portfolio/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id<\d+>}/supprimer", name="delete_portfolio")
     */
    public function delete(Portfolio $portfolio): RedirectResponse
    {
        $fileName = $portfolio->getImage();

        $this->getDoctrine()->getManager()->remove($portfolio);
        $this->getDoctrine()->getManager()->flush();

        unlink($this->getParameter('kernel.project_dir') . '/public' . $fileName);

        $this->addFlash("success", "Le portfolio a été supprimé avec succès !");

        return $this->redirectToRoute('manage_portfolio');
    }
}
