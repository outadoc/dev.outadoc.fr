<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name", type="string", length=128)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name_long", type="string", length=128)
     */
    private $nameLong;


    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="category")
     * @ORM\OrderBy({"startYear" = "DESC", "name" = "ASC"})
     */
    private $projects;

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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName(string $name): Category
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
     * Set nameLong
     *
     * @param string $nameLong
     * @return Category
     */
    public function setNameLong(string $nameLong): Category
    {
        $this->nameLong = $nameLong;

        return $this;
    }

    /**
     * Get nameLong
     *
     * @return string
     */
    public function getNameLong(): string
    {
        return $this->nameLong;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    /**
     * Add projects
     *
     * @param Project $projects
     * @return Category
     */
    public function addProject(Project $projects): Category
    {
        $this->projects[] = $projects;

        return $this;
    }

    /**
     * Remove projects
     *
     * @param Project $projects
     */
    public function removeProject(Project $projects)
    {
        $this->projects->removeElement($projects);
    }

    /**
     * Get projects
     *
     * @return Collection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    public function __toString(): string
    {
        return $this->nameLong;
    }
}
