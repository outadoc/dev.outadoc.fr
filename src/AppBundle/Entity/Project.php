<?php

	namespace AppBundle\Entity;

	use Doctrine\ORM\Mapping as ORM;

	/**
	 * Project
	 *
	 * @ORM\Table()
	 * @ORM\Entity(repositoryClass="AppBundle\Entity\ProjectRepository")
	 */
	class Project
	{
		/**
		 * @var integer
		 *
		 * @ORM\Column(name="project_id", type="integer")
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 */
		private $id;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="project_name", type="string", length=60)
		 */
		private $name;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="project_simple_name", type="string", length=30)
		 */
		private $simpleName;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="project_description_short", type="string", length=500)
		 */
		private $descriptionShort;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="project_description", type="text")
		 */
		private $description;

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="category_id", type="integer")
		 */
		private $categoryId;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="project_source_url", type="string", length=512)
		 */
		private $sourceUrl;

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="project_featured", type="smallint")
		 */
		private $featured;

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="project_french_only", type="smallint")
		 */
		private $frenchOnly;

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="project_visible", type="smallint")
		 */
		private $visible;


		/**
		 * @ORM\OneToMany(targetEntity="Download", mappedBy="project")
		 */
		private $downloads;

		/**
		 * @ORM\ManyToOne(targetEntity="Category", inversedBy="projects")
		 * @ORM\JoinColumn(name="category_id", referencedColumnName="category_id")
		 */
		private $category;

		public function __construct()
		{
			$this->downloads = new \Doctrine\Common\Collections\ArrayCollection();
		}

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
		 * @return Project
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
		 * Set nameNormalized
		 *
		 * @param string $simpleName
		 * @return Project
		 */
		public function setSimpleName($simpleName)
		{
			$this->simpleName = $simpleName;

			return $this;
		}

		/**
		 * Get nameNormalized
		 *
		 * @return string
		 */
		public function getSimpleName()
		{
			return $this->simpleName;
		}

		/**
		 * Set descriptionShort
		 *
		 * @param string $descriptionShort
		 * @return Project
		 */
		public function setDescriptionShort($descriptionShort)
		{
			$this->descriptionShort = $descriptionShort;

			return $this;
		}

		/**
		 * Get descriptionShort
		 *
		 * @return string
		 */
		public function getDescriptionShort()
		{
			return $this->descriptionShort;
		}

		/**
		 * Set description
		 *
		 * @param string $description
		 * @return Project
		 */
		public function setDescription($description)
		{
			$this->description = $description;

			return $this;
		}

		/**
		 * Get description
		 *
		 * @return string
		 */
		public function getDescription()
		{
			return $this->description;
		}

		/**
		 * Set categoryId
		 *
		 * @param integer $categoryId
		 * @return Project
		 */
		public function setCategoryId($categoryId)
		{
			$this->categoryId = $categoryId;

			return $this;
		}

		/**
		 * Get categoryId
		 *
		 * @return integer
		 */
		public function getCategoryId()
		{
			return $this->categoryId;
		}

		/**
		 * Set browseSource
		 *
		 * @param string $sourceUrl
		 * @return Project
		 */
		public function setSourceUrl($sourceUrl)
		{
			$this->sourceUrl = $sourceUrl;

			return $this;
		}

		/**
		 * Get browseSource
		 *
		 * @return string
		 */
		public function getSourceUrl()
		{
			return $this->sourceUrl;
		}

		/**
		 * Set showOnHome
		 *
		 * @param integer $featured
		 * @return Project
		 */
		public function setFeatured($featured)
		{
			$this->featured = $featured;

			return $this;
		}

		/**
		 * Get showOnHome
		 *
		 * @return integer
		 */
		public function getFeatured()
		{
			return $this->featured;
		}

		/**
		 * Set frenchOnly
		 *
		 * @param integer $frenchOnly
		 * @return Project
		 */
		public function setFrenchOnly($frenchOnly)
		{
			$this->frenchOnly = $frenchOnly;

			return $this;
		}

		/**
		 * Get frenchOnly
		 *
		 * @return integer
		 */
		public function getFrenchOnly()
		{
			return $this->frenchOnly;
		}

		/**
		 * Set visible
		 *
		 * @param integer $visible
		 * @return Project
		 */
		public function setVisible($visible)
		{
			$this->visible = $visible;

			return $this;
		}

		/**
		 * Get visible
		 *
		 * @return integer
		 */
		public function getVisible()
		{
			return $this->visible;
		}

		/**
		 * Add downloads
		 *
		 * @param \AppBundle\Entity\Download $downloads
		 * @return Project
		 */
		public function addDownload(\AppBundle\Entity\Download $downloads)
		{
			$this->downloads[] = $downloads;

			return $this;
		}

		/**
		 * Remove downloads
		 *
		 * @param \AppBundle\Entity\Download $downloads
		 */
		public function removeDownload(\AppBundle\Entity\Download $downloads)
		{
			$this->downloads->removeElement($downloads);
		}

		/**
		 * Get downloads
		 *
		 * @return \Doctrine\Common\Collections\Collection
		 */
		public function getDownloads()
		{
			return $this->downloads;
		}

		/**
		 * Set category
		 *
		 * @param \AppBundle\Entity\Category $category
		 * @return Project
		 */
		public function setCategory(\AppBundle\Entity\Category $category = null)
		{
			$this->category = $category;

			return $this;
		}

		/**
		 * Get category
		 *
		 * @return \AppBundle\Entity\Category
		 */
		public function getCategory()
		{
			return $this->category;
		}

		public function getPlatforms()
		{
			$platforms = array();

			foreach ($this->getDownloads() as $dl) {
				$platforms[] = $dl->getPlatform()->getName();
			}

			return $platforms;
		}

	}
