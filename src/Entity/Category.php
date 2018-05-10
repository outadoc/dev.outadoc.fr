<?php

	namespace App\Entity;

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
		public function getId()
		{
			return $this->id;
		}

		/**
		 * Set name
		 *
		 * @param string $name
		 * @return Category
		 */
		public function setName($name)
		{
			$this->name = $name;

			return $this;
		}

		/**
		 * Get name
		 *
		 * @return string
		 */
		public function getName()
		{
			return $this->name;
		}

		/**
		 * Set nameLong
		 *
		 * @param string $nameLong
		 * @return Category
		 */
		public function setNameLong($nameLong)
		{
			$this->nameLong = $nameLong;

			return $this;
		}

		/**
		 * Get nameLong
		 *
		 * @return string
		 */
		public function getNameLong()
		{
			return $this->nameLong;
		}

		/**
		 * Constructor
		 */
		public function __construct()
		{
			$this->projects = new \Doctrine\Common\Collections\ArrayCollection();
		}

		/**
		 * Add projects
		 *
		 * @param \App\Entity\Project $projects
		 * @return Category
		 */
		public function addProject(\App\Entity\Project $projects)
		{
			$this->projects[] = $projects;

			return $this;
		}

		/**
		 * Remove projects
		 *
		 * @param \App\Entity\Project $projects
		 */
		public function removeProject(\App\Entity\Project $projects)
		{
			$this->projects->removeElement($projects);
		}

		/**
		 * Get projects
		 *
		 * @return \Doctrine\Common\Collections\Collection
		 */
		public function getProjects()
		{
			return $this->projects;
		}
	}
