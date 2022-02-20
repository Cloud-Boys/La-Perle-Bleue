<?php

namespace App\Controller\Admin;

use App\Entity\AccueilEcrit;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AccueilEcritCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AccueilEcrit::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom')->setFormTypeOption('disabled','disabled'),
            TextField::new('texte'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
    return $actions

        ->disable(Action::NEW, Action::DELETE);
    }
}
