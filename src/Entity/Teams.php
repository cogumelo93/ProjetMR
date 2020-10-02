<?php

namespace App\Entity;

use App\Repository\TeamsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamsRepository::class)
 */
class Teams
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Project::class,cascade={"persist"})
     */
    private $project_ids;


    public function __construct()
    {
        $this->Teamid = new ArrayCollection();
        $this->project_ids = new ArrayCollection();
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
     * @return Collection|Project[]
     */
    public function getProjectIds(): Collection
    {
        return $this->project_ids;
    }

    public function addProjectId(Project $projectId): self
    {
        if (!$this->project_ids->contains($projectId)) {
            $this->project_ids[] = $projectId;
        }

        return $this;
    }

    public function removeProjectId(Project $projectId): self
    {
        if ($this->project_ids->contains($projectId)) {
            $this->project_ids->removeElement($projectId);
        }

        return $this;
    }

}
