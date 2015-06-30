<?php

    namespace AppBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use AppBundle\Controller\Twig_Environment;
    use AppBundle\Controller\Twig_SimpleFunction;

    class AboutController extends Controller
    {

        /**
         * @Route("/about", name="about")
         */
        public function indexAction()
        {
            return $this->render('about/index.html.twig');
        }

        /**
         * @deprecated
         * @Route("/about.html")
         */
        public function oldIndexAction()
        {
            return $this->redirectToRoute('about', array(), 301);
        }

    }
