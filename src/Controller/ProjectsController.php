<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;

class ProjectsController extends AbstractController
{
    /**
     * @Route("/projects", name="projects")
     * @Route("/projects/")
     */
    public function indexAction(): Response
    {
        $featured = $this->getDoctrine()
            ->getRepository('App:Project')
            ->findBy(array(
                "visible" => 1,
                "featured" => 1
            ));

        $categories = $this->getDoctrine()
            ->getRepository('App:Category')
            ->findAll();

        return $this->render('projects/index.html.twig', array(
            "categories" => $categories,
            "featured" => $featured
        ));
    }

    /**
     * @Route("/projects/{project}", name="project")
     * @Route("/projects/{project}/")
     * @param $project
     * @return Response
     */
    public function viewAction($project): Response
    {
        $_project = $this->getDoctrine()
            ->getRepository('App:Project')
            ->findOneBySimpleName($project);

        if ($_project === null) {
            throw $this->createNotFoundException("Project not found");
        }

        try {
            // List all screenshots available to display on the homepage
            $finder = new Finder();
            $finder->files()
                ->in($this->getParameter('kernel.project_dir') . "/public/assets/img/data/screen/" . $project)
                ->name("*.png")
                ->depth("== 0");

            $screenshot_count = iterator_count($finder);
        } catch (DirectoryNotFoundException $e) {
            $screenshot_count = 0;
        }

        $has_source_links = false;

        foreach ($_project->getDownloads() as $download) {
            if ($download->getSourceUrl() != null) {
                $has_source_links = true;
            }
        }

        return $this->render('projects/single.html.twig', array(
            "project" => $_project,
            "screen_count" => $screenshot_count,
            "has_source_links" => $has_source_links
        ));
    }
}
