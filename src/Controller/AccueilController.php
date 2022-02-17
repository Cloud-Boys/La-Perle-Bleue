<?php

namespace App\Controller;

use App\Entity\Alerte;
use App\Entity\Fermeture;
use App\Entity\Reservation;
use App\Form\ReservationType;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use App\Repository\AlerteRepository;
use App\Repository\FermetureRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bridge\Doctrine\ManagerRegistry as DoctrineManagerRegistry;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $fermetures = $doctrine
                    ->getRepository(Fermeture::class)
                    ->findAll();

        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);

        return $this->render('accueil/index.html.twig', [
            'formReservation' => $form->createView(),
            'fermetures' => $fermetures
        ]);
    }



    /**
     * @Route("/Email", name="Email")
     */
    public function Email(FermetureRepository $ferm_repo,AlerteRepository $repo,Request $request, MailerInterface $mailer): Response
    {

        $dates_ferm= $ferm_repo->findAll();
        $reservation = new Reservation();

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            
            $date_reserv = $form->getData()->getDate();
            echo $date_reserv->format('d-m-y')."<br>";

            foreach ($dates_ferm as $date) {
                $date_debut = $date->getDebut();
                $date_fin = $date->getFin();
                echo $date_debut->format('d-m-y')."<br>";
                echo $date_fin->format('d-m-y')."<br>";
                if($date_reserv>=$date_debut && $date_reserv<=$date_fin){
                    echo "ici";
                    
                    $this->addFlash('success', 'La date est incorrect');
                    return $this->redirectToRoute('accueil');
                }
            }
           
            
            
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
        }else{
            $this->addFlash('success', 'Error');
            return $this->redirectToRoute('accueil');
        }
        /*
        if($form->isValid()){
            $this->addFlash('error', 'Veuillez verifié les données du formulaire');
        }*/
    }


}
