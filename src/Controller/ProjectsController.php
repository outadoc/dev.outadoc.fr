<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController
{
    /**
     * @Route("/projects", name="projects")
     * @Route("/projects/")
     */
    public function indexAction(): Response
    {
        $featured = $this->getDoctrine()
            ->getRepository(Project::class)
            ->findBy(array(
                "visible" => 1,
                "featured" => 1
            ));

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
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
            ->getRepository(Project::class)
            ->findOneBySimpleName($project);

        if ($_project === null) {
            throw $this->createNotFoundException("Project not found");
        }

        $has_source_links = false;

        foreach ($_project->getDownloads() as $download) {
            if ($download->getSourceUrl() != null) {
                $has_source_links = true;
            }
        }

        return $this->render('projects/single.html.twig', array(
            "project" => $_project,
            "has_source_links" => $has_source_links
        ));
    }
}
