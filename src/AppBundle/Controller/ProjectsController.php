<?php

	namespace AppBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Symfony\Component\Finder\Finder;

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
		 * @Route("/projects/{project}", name="project")
		 */
		public function viewAction($project)
		{
			$_project = $this->getDoctrine()
				->getRepository('AppBundle:Project')
				->findOneBySimpleName($project);

			// List all screenshots available to display on the homepage
			$finder = new Finder();
			$finder->files()
				->in("../web/assets/img/data/screen/" . $project)
				->name("*.png")
				->depth("== 0");

			// Get the screenshot file names in an array
			$screenshots = array();

			foreach ($finder as $file) {
				$screenshots[] = $file->getRelativePathname();
			}

			// Remove the first item
			array_shift($screenshots);

			return $this->render('projects/single.html.twig', array(
				"project"     => $_project,
				"screenshots" => $screenshots
			));
		}

		/**
		 * @deprecated
		 * @Route("/projects.html")
		 */
		public function oldIndexAction()
		{
			return $this->redirectToRoute('projects', array(), 301);
		}

		/**
		 * @deprecated
		 * @Route("/project/{project}")
		 */
		public function oldProjectsAction($project)
		{
			return $this->redirectToRoute('project', array("project" => $project), 301);
		}
	}
