<?php

namespace App\Entity;

use App\Repository\SchoolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SchoolRepository::class)
 */
class School
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide.")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Degree::class, mappedBy="school")
     */
    private $degrees;

    public function __construct()
    {
        $this->degrees = new ArrayCollection();
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
     * @return Collection|Degree[]
     */
    public function getDegrees(): Collection
    {
        return $this->degrees;
    }

    public function addDegree(Degree $degree): self
    {
        if (!$this->degrees->contains($degree)) {
            $this->degrees[] = $degree;
            $degree->setSchool($this);
        }

        return $this;
    }

    public function removeDegree(Degree $degree): self
    {
        if ($this->degrees->removeElement($degree)) {
            // set the owning side to null (unless already changed)
            if ($degree->getSchool() === $this) {
                $degree->setSchool(null);
            }
        }

        return $this;
    }
}
