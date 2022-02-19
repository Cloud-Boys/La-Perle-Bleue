<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Entity\Categorie;
use App\Entity\AccueilEcrit;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    /**
     * @Route("/menu", name="menu")
     */
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $menus = $doctrine
                ->getRepository(Menu::class)
                ->findAll();

        $categories = $doctrine
                ->getRepository(Categorie::class)
                ->findAll();
        $textes = $doctrine
                ->getRepository(AccueilEcrit::class)
                ->findAll();

        return $this->render('menu/index.html.twig', [
            'menus' => $menus,
            'categories' => $categories,
            'textes' => $textes,
        ]);

    }
}
