<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Download
 */
#[ORM\Entity]
#[ORM\Table]
class Download
{
    /**
     * @var integer
     */
    #[ORM\Id]
    #[ORM\Column(name: 'download_id', type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'download_url', type: 'string', length: 512)]
    private ?string $downloadUrl = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'download_source_url', type: 'string', length: 512)]
    private ?string $sourceUrl = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'download_price', type: 'decimal', precision: 10, scale: 0)]
    private ?string $price = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'download_version', type: 'string', length: 6)]
    private ?string $version = null;


    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'downloads')]
    #[ORM\JoinColumn(name: 'project_id', referencedColumnName: 'project_id', nullable: false)]
    private ?Project $project = null;

    #[ORM\ManyToOne(targetEntity: Platform::class, inversedBy: 'downloads')]
    #[ORM\JoinColumn(name: 'platform_id', referencedColumnName: 'platform_id', nullable: false)]
    private ?Platform $platform = null;


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
     * Set downloadUrl
     *
     * @param string $downloadUrl
     * @return Download
     */
    public function setDownloadUrl(string $downloadUrl): Download
    {
        $this->downloadUrl = $downloadUrl;

        return $this;
    }

    /**
     * Get downloadUrl
     *
     * @return string
     */
    public function getDownloadUrl(): string
    {
        return $this->downloadUrl;
    }

    /**
     * Set sourceUrl
     *
     * @param string $sourceUrl
     * @return Download
     */
    public function setSourceUrl(string $sourceUrl): Download
    {
        $this->sourceUrl = $sourceUrl;

        return $this;
    }

    /**
     * Get sourceUrl
     *
     * @return string
     */
    public function getSourceUrl(): string
    {
        return $this->sourceUrl;
    }

    /**
     * Set downloadPrice
     *
     * @param string $price
     * @return Download
     */
    public function setPrice(string $price): Download
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get downloadPrice
     *
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * Set downloadVersion
     *
     * @param string $version
     * @return Download
     */
    public function setVersion(string $version): Download
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get downloadVersion
     *
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Set projects
     *
     * @param Project|null $project
     * @return Download
     */
    public function setProject(?Project $project = null): Download
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get projects
     *
     * @return Project
     */
    public function getProject(): ?Project
    {
        return $this->project;
    }

    /**
     * Set platform
     *
     * @param Platform|null $platform
     * @return Download
     */
    public function setPlatform(?Platform $platform = null): Download
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * Get platform
     *
     * @return Platform
     */
    public function getPlatform(): ?Platform
    {
        return $this->platform;
    }

    public function __toString(): string
    {
        return "$this->project / $this->platform";
    }
}
