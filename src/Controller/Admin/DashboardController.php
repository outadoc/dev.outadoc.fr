<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Download;
use App\Entity\Platform;
use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('dev.outadoc.fr admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Projects');
        yield MenuItem::linkToCrud('Projects', 'fas fa-mobile-alt', Project::class);
        yield MenuItem::linkToCrud('Downloads', 'fas fa-download', Download::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-boxes', Category::class);
        yield MenuItem::linkToCrud('Platforms', 'fas fa-microchip', Platform::class);
    }
}
