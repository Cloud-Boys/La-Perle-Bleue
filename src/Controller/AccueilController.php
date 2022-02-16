<?php

namespace App\Controller;

use App\Entity\Alerte;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\AlerteRepository;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(): Response
    {
        

        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);

        return $this->render('accueil/index.html.twig', [
            'formReservation' => $form->createView()
        ]);
    }



    /**
     * @Route("/Email", name="Email")
     */
    public function Email(AlerteRepository $repo,Request $request, MailerInterface $mailer): Response
    {



        $reservation = new Reservation();

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {

            $reservation->setCreatedAt(new \DateTime());
            if($form->getData()->getNbEnfant() === null){
                $reservation->setNbEnfant(0);
            }
            if($form->getData()->getNbBebe() === null){
                $reservation->setNbBebe(0);
            }

        

            $reservation = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            
            
            $email_client = (new TemplatedEmail())
                ->from('PerleBleue@gmail.com')
                ->to($reservation->getEmail())
                ->subject('Récapitulatif de votre réservation')
                ->htmlTemplate('email/contact_reservation.html.twig')
                ->context([
                    'nom' => $reservation->getNom(),
                    'date' => $reservation->getDate(),
                    'heure' => $reservation->getHeure(),
                    'telephone' => $reservation->getTelephone(),
                    'nbAdulte' => $reservation->getNbAdulte(),
                    'nbEnfant' => $reservation->getNbEnfant(),
                    'nbBebe' => $reservation->getNbBebe()
                ]);
            $mailer->send($email_client);


            
            $emails= $repo->findEmailAllAlerte();
            $alerts = '';
            foreach($emails as $email){
                $alerts .= $email['email'].',';
            }
            $alerts= mb_substr($alerts, 0, -1);
           
            $email_employer = (new TemplatedEmail())
                ->from('PerleBleue@gmail.com')
                ->to('PerleBleue@gmail.com')
                ->cc($alerts)
                ->subject('Nouvelle réservation')
                ->htmlTemplate('email/alert_reservation.html.twig')
                ->context([
                    'nom' => $reservation->getNom(),
                    'mail' => $reservation->getEmail(),
                    'date' => $reservation->getDate(),
                    'heure' => $reservation->getHeure(),
                    'telephone' => $reservation->getTelephone(),
                    'nbAdulte' => $reservation->getNbAdulte(),
                    'nbEnfant' => $reservation->getNbEnfant(),
                    'nbBebe' => $reservation->getNbBebe()
                ]);
            $mailer->send($email_employer);
            
            $this->addFlash('success', 'Votre Réservation à était faite avec succès, Vous avez reçu un récapitulatif sur votre email "'.$reservation->getEmail().'"');
            return $this->redirectToRoute('accueil');
        }
        /*
        if($form->isValid()){
            $this->addFlash('error', 'Veuillez verifié les données du formulaire');
        }*/
    }


}
