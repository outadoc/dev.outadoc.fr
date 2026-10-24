<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Screenshot
 */
#[ORM\Entity]
#[ORM\Table]
class Screenshot
{
    /**
     * @var integer
     */
    #[ORM\Id]
    #[ORM\Column(name: 'screenshot_id', type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'file_name', type: 'string')]
    private ?string $fileName = null;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'screenshots')]
    #[ORM\JoinColumn(name: 'project_id', referencedColumnName: 'project_id', nullable: false)]
    private ?Project $project = null;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     */
    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    /**
     * @return Project
     */
    public function getProject(): ?Project
    {
        return $this->project;
    }

    /**
     * @param Project $project
     */
    public function setProject(Project $project): void
    {
        $this->project = $project;
    }
}