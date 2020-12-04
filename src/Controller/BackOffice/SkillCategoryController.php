<?php

namespace App\Controller\BackOffice;

use App\Entity\SkillCategory;
use App\Form\SkillCategoryType;
use App\Repository\SkillCategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/competences/categories")
 * @IsGranted("ROLE_ADMIN", statusCode=404, message="Page non trouvée...")
 */
class SkillCategoryController extends AbstractController
{
    /**
     * @Route(name="manage_skill_category")
     */
    public function manage(SkillCategoryRepository $skillCategoryRepository): Response
    {
        return $this->render('back_office/skillCategory/manage.html.twig', [
            'skillCategories' => $skillCategoryRepository->findAll()
        ]);
    }

    /**
     * @Route("/creer", name="create_skill_category")
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(SkillCategoryType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $skillCategory = $form->getData();
            $this->getDoctrine()->getManager()->persist($skillCategory);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('manage_skill_category');
        }

        return $this->render('back_office/skillCategory/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/{id<\d+>}/modifier", name="update_skill_category")
     */
    public function update(Request $request, SkillCategory $skillCategory): Response
    {
        $form = $this->createForm(SkillCategoryType::class, $skillCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La catégorie a été modifiée avec succès !");
            return $this->redirectToRoute('manage_skill_category');
        }

        return $this->render('back_office/skillCategory/update.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/{id<\d+>}/supprimer", name="delete_skill_category")
     */
    public function delete(SkillCategory $skillCategory): RedirectResponse
    {
        $this->getDoctrine()->getManager()->remove($skillCategory);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash("success", "La catégorie a été supprimée avec succès !");

        return $this->redirectToRoute('manage_skill_category');
    }
}
