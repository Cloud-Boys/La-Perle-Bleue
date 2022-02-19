<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'placeholder' => "Nom",
                    'class' => 'reserv_inputs required'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => "Email",
                    'class' => 'reserv_inputs'
                ]
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'html5' => FALSE,
                'format' => 'dd/MM/yyyy',
                'attr' => [
                    'placeholder' => "Date",
                    'class' => 'form-control reserv_inputs cursor-text'
                ],
            ])
            ->add('heure', TimeType::class, [
                'widget' => 'single_text',
                'html5' => FALSE,
                'attr' => [
                    'placeholder' => "Heure",
                    'class' => 'form-control timepicker reserv_inputs cursor-text'
                ]
            ])
            ->add('telephone',TextType::class, [
                'attr' => [
                    'placeholder' => "Numéro de téléphone",
                    'class' => 'reserv_inputs'
                ]
            ])
            ->add('nb_adulte', IntegerType::class, [
                'attr' => [
                    'placeholder' => "Nombre d'adulte",
                    'class' => 'reserv_inputs',
                    'min' => '1',
                    'max' => '90',
                    'empty_data' => '1'
                ]
                
            ])
            ->add('nb_enfant', IntegerType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => "Nombre d'enfant",
                    'class' => 'reserv_inputs',
                    'min' => '0',
                    'max' => '30',
                ]
            ])
            ->add('nb_bebe', IntegerType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => "Nombre de bébe",
                    'class' => 'reserv_inputs',
                    'min' => '0',
                    'max' => '30',
                    'empty_data' => '0'
                    
                ]
            ])
            ->add('message',TextareaType::class, [
                'required'   => false,
                'attr' => [
                    'placeholder' => "Message",
                    'class' => 'reserv_inputs'
                ]
            ])
            ->add('Valider', SubmitType::class, [
                'attr' =>[
                    'class' => 'btn_valide pt pb'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
