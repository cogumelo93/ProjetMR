<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_project;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProject(): ?int
    {
        return $this->id_project;
    }

    public function setIdProject(int $id_project): self
    {
        $this->id_project = $id_project;

        return $this;
    }
}
