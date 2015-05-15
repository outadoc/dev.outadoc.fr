<?php

	namespace AppBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

	class ProjectsController extends Controller
	{
		/**
		 * @Route("/projects", name="projects")
		 */
		public function indexAction()
		{
			$categories = $this->getDoctrine()
				->getRepository('AppBundle:Category')
				->findAll();

			return $this->render('projects/index.html.twig', array(
				"categories" => $categories
			));
		}
	}
