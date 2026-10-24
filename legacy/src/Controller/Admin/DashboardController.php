<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function __construct(private readonly AdminUrlGeneratorInterface $adminUrlGenerator)
    {
    }

    public function index(): Response
    {
        return $this->redirect($this->adminUrlGenerator->setController(ProjectCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('dev.outadoc.fr admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Projects', 'fa fa-home');

        yield MenuItem::section('Details');
        yield MenuItem::linkTo(ScreenshotCrudController::class, 'Screenshots', 'fas fa-images');
        yield MenuItem::linkTo(DownloadCrudController::class, 'Downloads', 'fas fa-download');
        yield MenuItem::linkTo(CategoryCrudController::class, 'Categories', 'fas fa-boxes');
        yield MenuItem::linkTo(PlatformCrudController::class, 'Platforms', 'fas fa-microchip');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return UserMenu::new();
    }
}
