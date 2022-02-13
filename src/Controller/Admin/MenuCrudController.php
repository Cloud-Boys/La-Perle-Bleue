<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class MenuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Menu::class;
    }
    
    public function configureFields(string $pageName): iterable
    {

        $imageFichier = AssociationField::new('categorie');
        TextareaField::new('imageFichier', 'Image')->setFormType(VichImageType::class);
        $image = ImageField::new('image')->setBasePath('/img/upload'); 
        DateTimeField::new('updatedAt');

        $fields = [
            TextField::new('nom'),
            Field::new('prix'),
            TextField::new('description')
        ];

        if($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            $fields[] = $image;
        } else {
            $fields[] = $imageFichier;
        }

        return $fields;
            
    }
    
}
