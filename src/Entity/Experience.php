<?php

namespace App\Entity;

use App\Repository\ExperienceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExperienceRepository::class)
 */
class Experience
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $company;

    /**
     * @ORM\Column(type="datetime", name="start_at")
     */
    private $startAt;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="end_at")
     */
    private $endAt;

    /**
     * @ORM\Column(type="array")
     */
    private $works = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getWorks(): ?array
    {
        return $this->works;
    }

    public function setWorks(array $works): self
    {
        $newWorks = [];
        foreach ($works as $work) {
            if ($work !== null) {
                $newWorks[] = $work;
            }
        }

        $this->works = $newWorks;

        return $this;
    }


    public function getLocation(): ?string
    {
        return $this->location;
    }


    public function setLocation($location): self
    {
        $this->location = $location;

        return $this;
    }
}
