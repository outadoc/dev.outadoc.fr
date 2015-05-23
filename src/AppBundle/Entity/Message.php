<?php

	namespace AppBundle\Entity;

	use Symfony\Component\Validator\Constraints as Assert;
	use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;

	class Message
	{
		/**
		 * @Assert\NotBlank()
		 */
		protected $name;

		/**
		 * @Assert\NotBlank()
		 * @Assert\Email(checkMX = true)
		 */
		protected $email;

		/**
		 * @Assert\NotBlank()
		 */
		protected $message;

		/**
		 * @Recaptcha\IsTrue
		 */
		public $recaptcha;

		/**
		 * @return string
		 */
		public function getName()
		{
			return $this->name;
		}

		/**
		 * @param string $name
		 */
		public function setName($name)
		{
			$this->name = $name;
		}

		/**
		 * @return string
		 */
		public function getEmail()
		{
			return $this->email;
		}

		/**
		 * @param string $email
		 */
		public function setEmail($email)
		{
			$this->email = $email;
		}

		/**
		 * @return string
		 */
		public function getMessage()
		{
			return $this->message;
		}

		/**
		 * @param string $message
		 */
		public function setMessage($message)
		{
			$this->message = $message;
		}
	}