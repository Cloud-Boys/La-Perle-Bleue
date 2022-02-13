<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            EmailField::new('email'),
            TextField::new('telephone'),
            Field::new('nbAdulte', 'Adulte(s)'),
            Field::new('nbEnfant', 'Enfant(s)'),
            Field::new('nbBebe', 'Bébé(s)'),
            DateField::new('date'),
            TimeField::new('heure'),
            TextEditorField::new('message'),
            DateTimeField::new('createdAt', 'Réservé le'),

        ];
    }

}
