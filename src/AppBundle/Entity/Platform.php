<?php

	namespace AppBundle\Entity;

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
		public function getId()
		{
			return $this->id;
		}

		/**
		 * Set platformName
		 *
		 * @param string $name
		 * @return Platform
		 */
		public function setName($name)
		{
			$this->name = $name;

			return $this;
		}

		/**
		 * Get platformName
		 *
		 * @return string
		 */
		public function getName()
		{
			return $this->name;
		}

		/**
		 * Constructor
		 */
		public function __construct()
		{
			$this->downloads = new \Doctrine\Common\Collections\ArrayCollection();
		}

		/**
		 * Add downloads
		 *
		 * @param \AppBundle\Entity\Download $downloads
		 * @return Platform
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
	}
