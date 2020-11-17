<?php

namespace App\Controller\FrontOffice;

use App\Services\SkillService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SkillsController extends AbstractController
{
    /**
     * @Route("/competences", name="skills")
     */
    public function index(SkillService $skill): Response
    {
        return $this->render('front_office/skills/index.html.twig', [
            "skills" => $skill->getSkills()
        ]);
    }
}
