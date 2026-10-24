<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Platform
 */
#[ORM\Entity]
#[ORM\Table]
class Platform
{
    /**
     * @var integer
     */
    #[ORM\Column(name: 'platform_id', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    /**
     * @var string
     */
    #[ORM\Column(name: 'platform_name', type: 'string', length: 128)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Download::class, mappedBy: 'platform')]
    private Collection $downloads;

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
     * Set platformName
     *
     * @param string $name
     * @return Platform
     */
    public function setName(string $name): Platform
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get platformName
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->downloads = new ArrayCollection();
    }

    /**
     * Add downloads
     *
     * @param Download $downloads
     * @return Platform
     */
    public function addDownload(Download $downloads): Platform
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

    public function __toString(): string
    {
        return $this->name;
    }
}
