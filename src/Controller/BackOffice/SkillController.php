<?php

namespace App\Controller\BackOffice;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/competences")
 * @IsGranted("ROLE_ADMIN", statusCode=404, message="Page non trouvée...")
 */
class SkillController extends AbstractController
{
    /**
     * @Route(name="manage_skill")
     */
    public function manage(SkillRepository $skillRepository): Response
    {
        return $this->render('back_office/skill/manage.html.twig', [
            'skills' => $skillRepository->findAll()
        ]);
    }

    /**
     * @Route("/creer", name="create_skill")
     */
    public function create(Request $request): Response
    {
        
        $form = $this->createForm(SkillType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $skill = $form->getData();            
            $this->getDoctrine()->getManager()->persist($skill);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('manage_skill');
        }

        return $this->render('back_office/skill/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/{id<\d+>}/modifier", name="update_skill")
     */
    public function update(Request $request, Skill $skill): Response
    {
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "La compétence a été modifiée avec succès !");
            return $this->redirectToRoute('manage_skill');
        }

        return $this->render('back_office/skill/update.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/{id<\d+>}/supprimer", name="delete_skill")
     */
    public function delete(Skill $skill): RedirectResponse
    {
        $this->getDoctrine()->getManager()->remove($skill);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash("success", "La compétence a été supprimée avec succès !");

        return $this->redirectToRoute('manage_skill');
    }
}
