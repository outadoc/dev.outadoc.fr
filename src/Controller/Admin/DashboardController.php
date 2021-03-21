<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Download;
use App\Entity\Platform;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(ProjectCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('dev.outadoc.fr admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Projects', 'fa fa-home');

        yield MenuItem::section('Details');
        yield MenuItem::linkToCrud('Downloads', 'fas fa-download', Download::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-boxes', Category::class);
        yield MenuItem::linkToCrud('Platforms', 'fas fa-microchip', Platform::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return UserMenu::new();
    }
}
