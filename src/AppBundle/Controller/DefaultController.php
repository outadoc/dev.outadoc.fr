<?php

	namespace AppBundle\Controller;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

	class DefaultController extends Controller
	{
		/**
		 * @Route("/", name="home")
		 */
		public function indexAction()
		{
			$featured = $this->getDoctrine()
				->getRepository('AppBundle:Project')
				->findByFeatured(1);

			$all = $this->getDoctrine()
				->getRepository('AppBundle:Project')
				->findAll();

			$nb_rand_items = 3;
			$random        = array();

			// Get $nb_rand_items random projects and put them in $random
			while (count($random) !== $nb_rand_items) {
				$rand_nb = mt_rand(0, count($all) - 1);

				if (!in_array($all[$rand_nb], $random)) {
					$random[] = $all[$rand_nb];
				}
			}

			return $this->render('default/index.html.twig', array(
				"featured" => $featured,
				"random"   => $random
			));
		}
	}
