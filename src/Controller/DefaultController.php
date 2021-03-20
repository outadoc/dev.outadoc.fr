<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(): Response
    {
        // List all screenshots available to display on the homepage
        $finder = new Finder();
        $finder->files()
            ->in($this->getParameter('kernel.project_dir') . "/public/assets/img/hello")
            ->name("*.png")
            ->depth("== 0");

        // Get the screenshot file names in an array
        $screenshots = array();

        foreach ($finder as $file) {
            $screenshots[] = $file->getRelativePathname();
        }

        // Select a random screenshot
        $index = mt_rand(0, count($screenshots) - 1);

        return $this->render('default/index.html.twig', array(
            "screenshot" => $screenshots[$index]
        ));
    }
}
