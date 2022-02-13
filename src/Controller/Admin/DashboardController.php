<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use App\Entity\Alerte;
use App\Entity\Reservation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\ReservationCrudController;
use App\Entity\Categorie;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(ReservationCrudController::class)->generateUrl());
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Administration');
        yield MenuItem::linkToCrud('Reservation', 'fa fa-file-pdf', Reservation::class);
        yield MenuItem::linkToCrud('Alerte', 'fa fa-file-pdf', Alerte::class);
        yield MenuItem::linkToCrud('Catégorie', 'fa fa-file-pdf', Categorie::class);
        yield MenuItem::linkToCrud('Menu', 'fa fa-file-pdf', Menu::class);
    }
    
}
