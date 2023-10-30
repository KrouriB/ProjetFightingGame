<?php

namespace App\Controller\Admin;

use App\Entity\Element;
use App\Entity\TypeWeapon;
use App\Entity\CategoryWeapon;
use App\Entity\TypeStatAction;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use App\Controller\Admin\CategoryWeaponCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ElementCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ProjetFightingGame');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Element', 'fas fa-list', Element::class);
        yield MenuItem::linkToCrud('Categorie', 'fas fa-list', CategoryWeapon::class);
        yield MenuItem::linkToCrud('Type', 'fas fa-list', TypeWeapon::class);
        yield MenuItem::linkToCrud("Stat et Type d'équipement", 'fas fa-list', TypeStatAction::class);
    }
}
