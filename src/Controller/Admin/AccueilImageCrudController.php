<?php

namespace App\Controller\Admin;

use App\Entity\AccueilImage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AccueilImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AccueilImage::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $imageFichier = TextareaField::new('imageFichier', 'Image')->setFormType(VichImageType::class); 
        $image = ImageField::new('image')->setBasePath('/img/upload');

        $fields = [
            TextField::new('nom'),
        ];

        if($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            $fields[] = $image;
        } else {
            $fields[] = $imageFichier;
        }

        return $fields;
    }

    public function configureActions(Actions $actions): Actions
    {
    return $actions

        ->disable(Action::NEW, Action::DELETE);
    }
}
