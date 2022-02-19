<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Entity\Categorie;
use App\Entity\Fermeture;
use App\Entity\Reservation;
use App\Entity\AccueilEcrit;
use App\Entity\AccueilImage;
use App\Form\ReservationType;
use App\Repository\MenuRepository;
use App\Repository\AlerteRepository;
use App\Repository\FermetureRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Date;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(ManagerRegistry $doctrine,MenuRepository $repo_menu,FermetureRepository $repo_ferm): Response
    {
        $fermetures = $repo_ferm->findMinDate();


        $menu_images= $doctrine
                    ->getRepository(AccueilImage::class)
                    ->findBy(["nom" => "menu_image"]);
        $gallery_images = $doctrine
                    ->getRepository(AccueilImage::class)
                    ->findBy(["nom" => "gallery_intérieur"]);

        
        $menus = $repo_menu->findRandProducts();


        $textes = $doctrine
                    ->getRepository(AccueilEcrit::class)
                    ->findAll();
 
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);

        return $this->render('accueil/index.html.twig', [
            'formReservation' => $form->createView(),
            'fermetures' => $fermetures,
            'menu_images' => $menu_images,
            'gallery_images' => $gallery_images,
            'menus' => $menus,
            'textes' => $textes
        ]);

        return $this->render('base.html.twig', [
            'textes' => $textes
        ]);
    }



    /**
     * @Route("/Email", name="Email")
     */
    public function Email(FermetureRepository $ferm_repo,AlerteRepository $repo,Request $request, MailerInterface $mailer): Response
    {

        $dates_ferm= $ferm_repo->findBY([],["debut" => "ASC"]);
        $reservation = new Reservation();

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            
            $date_reserv = $form->getData()->getDate();
            $message = nl2br("Les Réservation sont indisponible pour les dates suivantes : \n");
            if($date_reserv<new Date()){
                    $this->addFlash('error', "La Date est incorrect");
                    return $this->redirectToRoute('accueil');        
            }
            foreach ($dates_ferm as $date) {
                $date_debut = $date->getDebut();
                $date_fin = $date->getFin();

                $message .= $date_debut->format('d-m-y')." Au ".$date_fin->format('d-m-y')."\n";
                
                if($date_reserv>=$date_debut && $date_reserv<=$date_fin){
                    $this->addFlash('error', $message);
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
