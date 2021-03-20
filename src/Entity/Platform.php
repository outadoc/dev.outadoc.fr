<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Platform
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Platform
{
    /**
     * @var integer
     *
     * @ORM\Column(name="platform_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="platform_name", type="string", length=128)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Download", mappedBy="platform")
     */
    private $downloads;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): int
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
}
