<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjectsController extends AbstractController
{
    #[Route('/projects', name: 'projects')]
    #[Route('/projects/')]
    public function indexAction(ProjectRepository $projectRepository, CategoryRepository $categoryRepository): Response
    {
        $featured = $projectRepository
            ->findBy(array(
                "visible" => 1,
                "featured" => 1
            ));

        $categories = $categoryRepository->findAll();

        return $this->render('projects/index.html.twig', array(
            "categories" => $categories,
            "featured" => $featured
        ));
    }

    #[Route('/projects/{project}', name: 'project')]
    #[Route('/projects/{project}/')]
    public function viewAction(string $project, ProjectRepository $projectRepository): Response
    {
        $_project = $projectRepository->findOneBy(array("simpleName" => $project));

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
