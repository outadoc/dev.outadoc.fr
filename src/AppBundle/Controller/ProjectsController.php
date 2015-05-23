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
			$featured = $this->getDoctrine()
				->getRepository('AppBundle:Project')
				->findBy(array(
					"visible"  => 1,
					"featured" => 1
				));

			$categories = $this->getDoctrine()
				->getRepository('AppBundle:Category')
				->findAll();

			return $this->render('projects/index.html.twig', array(
				"categories" => $categories,
				"featured"   => $featured
			));
		}

		/**
		 * @deprecated
		 * @Route("/projects.html")
		 */
		public function oldIndexAction()
		{
			return $this->redirectToRoute('projects');
		}
	}
