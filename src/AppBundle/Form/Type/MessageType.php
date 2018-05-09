<?php

	namespace AppBundle\Form\Type;

	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue;

	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\Extension\Core\Type\EmailType;
	use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;

	class MessageType extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options)
		{
			$builder
				->add('name', TextType::class)
				->add('email', EmailType::class)
				->add('message', TextareaType::class)
				->add('recaptcha', EWZRecaptchaType::class)
				->add('send', SubmitType::class);
		}

		public function getName()
		{
			return 'message';
		}
	}