<?php

namespace App\Controller\Admin;

use App\Entity\Fermeture;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FermetureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Fermeture::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('debut'),
            DateField::new('fin')
        ];
    }
}
