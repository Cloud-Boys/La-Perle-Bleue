<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil/reservation", name="reservation")
     */
    public function reservation(Request $request, ManagerRegistry $em, Reservation $reservation): Response
    {
        $reservation = new Reservation(); 

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $reservation = $form->getData();
            $em = $em->getManager();
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('accueil');
        }
    }

    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(Request $request): Response
    {
        $reservation = new Reservation();

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $reservation->setCreatedAt(new \DateTime());

            $reservation = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('accueil');
        }

        return $this->render('accueil/index.html.twig', [
            'formReservation' => $form->createView()
        ]);
    }
}
