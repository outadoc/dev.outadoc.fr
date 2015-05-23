<?php

	namespace AppBundle\Controller;

	use AppBundle\Entity\Message;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Symfony\Component\HttpFoundation\Request;

	class ContactController extends Controller
	{

		/**
		 * @Route("/contact", name="contact")
		 * @param Request $request
		 * @return \Symfony\Component\HttpFoundation\Response
		 */
		public function indexAction(Request $request)
		{
			$message = new Message();
			$form    = $this->createForm('message', $message);

			$form->handleRequest($request);

			if ($form->isValid()) {
				// perform some action, such as saving the task to the database
				print "valid";
			}

			return $this->render('contact/index.html.twig', array(
				'form' => $form->createView()
			));
		}

	}
