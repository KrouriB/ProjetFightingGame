<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Equipe;
use App\Entity\Weapon;
use App\Entity\Element;
use App\Entity\Accessory;
use App\Entity\Personnage;
use App\Entity\TypeWeapon;
use App\Entity\StockWeapon;
use App\Entity\CategoryWeapon;
use App\Entity\StockAccessory;
use App\Entity\TypeStatAction;
use App\Entity\StockPersonnage;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\ElementCrudController;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use App\Controller\Admin\CategoryWeaponCrudController;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
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
    }
}
