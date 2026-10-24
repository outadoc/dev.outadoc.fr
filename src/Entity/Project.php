<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 */
#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\Table]
class Project
{
    /**
     * @var integer
     */
    #[ORM\Column(name: 'project_id', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'project_name', type: 'string', length: 60)]
    private ?string $name = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'project_simple_name', type: 'string', length: 30)]
    private ?string $simpleName = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'project_description_short', type: 'string', length: 500)]
    private ?string $shortDescription = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'project_description_short_fr', type: 'string', length: 500)]
    private ?string $frenchShortDescription = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'project_description', type: 'text')]
    private ?string $description = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'project_description_fr', type: 'text')]
    private ?string $frenchDescription = null;

    /**
     * @var integer
     */
    #[ORM\Column(name: 'project_start_year', type: 'integer')]
    private ?int $startYear = null;

    /**
     * @var integer
     */
    #[ORM\Column(name: 'project_end_year', type: 'integer', nullable: true)]
    private ?int $endYear = null;

    /**
     * @var boolean
     */
    #[ORM\Column(name: 'project_featured', type: 'boolean')]
    private ?bool $featured = null;

    /**
     * @var boolean
     */
    #[ORM\Column(name: 'project_visible', type: 'boolean')]
    private ?bool $visible = null;

    /**
     * @var string|null
     */
    #[ORM\Column(name: 'thumbnail_file_name', type: 'string', nullable: true)]
    private ?string $thumbnailFileName = null;

    #[ORM\OneToMany(targetEntity: Download::class, mappedBy: 'project')]
    private Collection $downloads;

    #[ORM\OneToMany(targetEntity: Screenshot::class, mappedBy: 'project')]
    private Collection $screenshots;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'projects')]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'category_id', nullable: false)]
    private ?Category $category = null;

    public function __construct()
    {
        $this->downloads = new ArrayCollection();
        $this->screenshots = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Project
     */
    public function setName(string $name): Project
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set nameNormalized
     *
     * @param string $simpleName
     * @return Project
     */
    public function setSimpleName(string $simpleName): Project
    {
        $this->simpleName = $simpleName;

        return $this;
    }

    /**
     * Get nameNormalized
     *
     * @return string
     */
    public function getSimpleName(): string
    {
        return $this->simpleName;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return Project
     */
    public function setShortDescription(string $shortDescription): Project
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get frenchShortDescription
     *
     * @return string
     */
    public function getFrenchShortDescription(): string
    {
        return $this->frenchShortDescription;
    }

    /**
     * Set frenchShortDescription
     *
     * @param string $frenchShortDescription
     * @return Project
     */
    public function setFrenchShortDescription(string $frenchShortDescription): Project
    {
        $this->frenchShortDescription = $frenchShortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Project
     */
    public function setDescription(string $description): Project
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set frenchDescription
     *
     * @param string $frenchDescription
     * @return Project
     */
    public function setFrenchDescription(string $frenchDescription): Project
    {
        $this->frenchDescription = $frenchDescription;

        return $this;
    }

    /**
     * Get frenchDescription
     *
     * @return string
     */
    public function getFrenchDescription(): string
    {
        return $this->frenchDescription;
    }

    /**
     * Set startYear
     *
     * @param integer $startYear
     * @return Project
     */
    public function setStartYear(int $startYear): Project
    {
        $this->startYear = $startYear;

        return $this;
    }

    /**
     * Get startYear
     *
     * @return integer
     */
    public function getStartYear(): int
    {
        return $this->startYear;
    }

    /**
     * Set endYear
     *
     * @param integer|null $endYear
     * @return Project
     */
    public function setEndYear(?int $endYear): Project
    {
        $this->endYear = $endYear;

        return $this;
    }

    /**
     * Get endYear
     *
     * @return integer
     */
    public function getEndYear(): ?int
    {
        return $this->endYear;
    }

    /**
     * Set showOnHome
     *
     * @param boolean $featured
     * @return Project
     */
    public function setFeatured(bool $featured): Project
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get showOnHome
     *
     * @return boolean
     */
    public function getFeatured(): bool
    {
        return $this->featured;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     * @return Project
     */
    public function setVisible(bool $visible): Project
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function getVisible(): bool
    {
        return $this->visible;
    }

    /**
     * @return string
     */
    public function getThumbnailFileName(): ?string
    {
        return $this->thumbnailFileName;
    }

    /**
     * @param string|null $thumbnailFileName
     */
    public function setThumbnailFileName(?string $thumbnailFileName): void
    {
        $this->thumbnailFileName = $thumbnailFileName;
    }

    /**
     * @return mixed
     */
    public function getScreenshots()
    {
        return $this->screenshots;
    }

    /**
     * Add downloads
     *
     * @param Download $downloads
     * @return Project
     */
    public function addDownload(Download $downloads): Project
    {
        $this->downloads[] = $downloads;

        return $this;
    }

    /**
     * Remove downloads
     *
     * @param Download $downloads
     */
    public function removeDownload(Download $downloads)
    {
        $this->downloads->removeElement($downloads);
    }

    /**
     * Get downloads
     *
     * @return Collection
     */
    public function getDownloads()
    {
        return $this->downloads;
    }

    /**
     * Set category
     *
     * @param Category|null $category
     * @return Project
     */
    public function setCategory(?Category $category = null): Project
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function getPlatforms(): array
    {
        $platforms = array();

        foreach ($this->getDownloads() as $dl) {
            $platforms[] = $dl->getPlatform()->getName();
        }

        return $platforms;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
