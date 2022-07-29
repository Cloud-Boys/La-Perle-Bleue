<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use App\Entity\Alerte;
use App\Entity\Categorie;
use App\Entity\Fermeture;
use App\Entity\Reservation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\ReservationCrudController;
use App\Entity\AccueilEcrit;
use App\Entity\AccueilImage;
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
        yield MenuItem::section('Restaurant');
        yield MenuItem::linkToCrud('Reservations', 'fa fa-file-pdf', Reservation::class);
        yield MenuItem::linkToCrud('Fermer les réservations', 'fa fa-file-pdf', Fermeture::class);
        yield MenuItem::linkToCrud('Alerte', 'fa fa-file-pdf', Alerte::class);
        yield MenuItem::section("Page d'accueil");
        yield MenuItem::linkToCrud("Texte page d'accueil", 'fa fa-file-pdf', AccueilEcrit::class);
        yield MenuItem::linkToRoute('Accueil', 'fa fa-file-pdf', 'accueil');
        yield MenuItem::section("Menu");
        yield MenuItem::linkToCrud('Catégorie', 'fa fa-file-pdf', Categorie::class);
        yield MenuItem::linkToCrud('Plats', 'fa fa-file-pdf', Menu::class);
        yield MenuItem::linkToRoute('Menu', 'fa fa-file-pdf', 'menu');
        yield MenuItem::section('Administration');
        yield MenuItem::linkToRoute('Crée un Admin', 'fa fa-file-pdf', 'app_register');
    }
    
    
}
