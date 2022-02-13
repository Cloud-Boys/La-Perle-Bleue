<?php

namespace App\Controller\Admin;

use App\Entity\Alerte;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AlerteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Alerte::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            EmailField::new('email'),
            BooleanField::new('statut')
        ];
    }
    
}
