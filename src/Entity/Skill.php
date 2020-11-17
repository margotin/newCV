<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 */
class Skill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\ManyToMany(targetEntity=SkillCategory::class, cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $skillCategories;

    public function __construct()
    {
        $this->skillCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|SkillCategorie[]
     */
    public function getSkillCategories(): Collection
    {
        return $this->skillCategories;
    }

    public function addSkillCategory(SkillCategory $skillCategory): self
    {
        if (!$this->skillCategories->contains($skillCategory)) {
            $this->skillCategories[] = $skillCategory;           
        }

        return $this;
    }

    public function removeSkillCategory(SkillCategory $skillCategory): self
    {
        if ($this->skillCategories->contains($skillCategory)) {
            $this->skillCategories->removeElement($skillCategory);            
        }          

        return $this;
    }
}
