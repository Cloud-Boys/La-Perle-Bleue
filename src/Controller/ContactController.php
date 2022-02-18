<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $contactData = $form->getData();
            $email_client = (new TemplatedEmail())
                ->from('PerleBleue@gmail.com')
                ->to($contactData->getEmail())
                ->subject($contactData->getSujet())
                ->htmlTemplate('email/contact.html.twig')
                ->context([
                    'nom' => $contactData->getNom(),
                    'message' => $contactData->getMessage(),
                    'mail' => $contactData->getEmail(),
                ]);
            $mailer->send($email_client);

            $this->addFlash('success', 'Votre message à était envoyé avec succès');
            return $this->redirectToRoute('accueil');
        }


        return $this->render('contact/index.html.twig', [
            'formContact' => $form->createView(),
        ]);
    }
}
