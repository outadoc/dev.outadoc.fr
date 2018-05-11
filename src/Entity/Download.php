<?php

	namespace App\Entity;

	use Doctrine\ORM\Mapping as ORM;

	/**
	 * Download
	 *
	 * @ORM\Table()
	 * @ORM\Entity
	 */
	class Download
	{
		/**
		 * @var integer
		 *
		 * @ORM\Id
		 * @ORM\Column(name="project_id", type="integer")
		 */
		private $projectId;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="download_url", type="string", length=512)
		 */
		private $downloadUrl;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="download_source_url", type="string", length=512)
		 */
		private $sourceUrl;

		/**
		 * @var integer
		 *
		 * @ORM\Id
		 * @ORM\Column(name="platform_id", type="integer")
		 */
		private $platformId;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="download_price", type="decimal")
		 */
		private $price;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="download_version", type="string", length=6)
		 */
		private $version;


		/**
		 * @ORM\ManyToOne(targetEntity="Project", inversedBy="downloads")
		 * @ORM\JoinColumn(name="project_id", referencedColumnName="project_id")
		 */
		private $project;

		/**
		 * @ORM\ManyToOne(targetEntity="Platform", inversedBy="downloads")
		 * @ORM\JoinColumn(name="platform_id", referencedColumnName="platform_id")
		 */
		private $platform;


		/**
		 * Get id
		 *
		 * @return integer
		 */
		public function getProjectId()
		{
			return $this->projectId;
		}

		/**
		 * Set downloadUrl
		 *
		 * @param string $downloadUrl
		 * @return Download
		 */
		public function setDownloadUrl($downloadUrl)
		{
			$this->downloadUrl = $downloadUrl;

			return $this;
		}

		/**
		 * Get downloadUrl
		 *
		 * @return string
		 */
		public function getDownloadUrl()
		{
			return $this->downloadUrl;
		}

		/**
		 * Set sourceUrl
		 *
		 * @param string $sourceUrl
		 * @return Download
		 */
		public function setSourceUrl($sourceUrl)
		{
			$this->sourceUrl = $sourceUrl;

			return $this;
		}

		/**
		 * Get sourceUrl
		 *
		 * @return string
		 */
		public function getSourceUrl()
		{
			return $this->sourceUrl;
		}

		/**
		 * Set platformId
		 *
		 * @param integer $platformId
		 * @return Download
		 */
		public function setPlatformId($platformId)
		{
			$this->platformId = $platformId;

			return $this;
		}

		/**
		 * Get platformId
		 *
		 * @return integer
		 */
		public function getPlatformId()
		{
			return $this->platformId;
		}

		/**
		 * Set downloadPrice
		 *
		 * @param string $price
		 * @return Download
		 */
		public function setPrice($price)
		{
			$this->price = $price;

			return $this;
		}

		/**
		 * Get downloadPrice
		 *
		 * @return string
		 */
		public function getPrice()
		{
			return $this->price;
		}

		/**
		 * Set downloadVersion
		 *
		 * @param string $version
		 * @return Download
		 */
		public function setVersion($version)
		{
			$this->version = $version;

			return $this;
		}

		/**
		 * Get downloadVersion
		 *
		 * @return string
		 */
		public function getVersion()
		{
			return $this->version;
		}

		/**
		 * Set projectId
		 *
		 * @param integer $projectId
		 * @return Download
		 */
		public function setProjectId($projectId)
		{
			$this->projectId = $projectId;

			return $this;
		}

		/**
		 * Set projects
		 *
		 * @param \App\Entity\Project $project
		 * @return Download
		 */
		public function setProject(\App\Entity\Project $project = null)
		{
			$this->project = $project;

			return $this;
		}

		/**
		 * Get projects
		 *
		 * @return \App\Entity\Project
		 */
		public function getProject()
		{
			return $this->project;
		}

		/**
		 * Set platform
		 *
		 * @param \App\Entity\Platform $platform
		 * @return Download
		 */
		public function setPlatform(\App\Entity\Platform $platform = null)
		{
			$this->platform = $platform;

			return $this;
		}

		/**
		 * Get platform
		 *
		 * @return \App\Entity\Platform
		 */
		public function getPlatform()
		{
			return $this->platform;
		}
	}
