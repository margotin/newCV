<?php

namespace App\Services;

use App\Repository\SkillRepository;
use App\Repository\SkillCategoryRepository;

class SkillService
{

    private $skillRepository;
    private $skillCategoryRepository;


    public function __construct(SkillRepository $skillRepository, SkillCategoryRepository $skillCategoryRepository)
    {
        $this->skillRepository = $skillRepository;
        $this->skillCategoryRepository = $skillCategoryRepository;
    }


    public function getSkills(): array
    {
        // Récupération de toutes les catégories
        $categories = $this->skillCategoryRepository->findAll();
        $skillsByCategories = [];

        foreach ($categories as $category) {

            // Récupération des compétences pour une catégorie
            $skillsByCategory = $this->skillRepository->getSkillsByCategory($category->getName());
            $skillsNames = [];
            foreach ($skillsByCategory as $skill) {
                $skillsNames[] = $skill['name'];
            }

            $skillsByCategories[$category->getName()] = $skillsNames;
        }

        return $skillsByCategories;
    }
}
