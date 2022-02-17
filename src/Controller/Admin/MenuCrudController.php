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
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MenuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Menu::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        $imageFichier = TextareaField::new('imageFichier', 'Image')->setFormType(VichImageType::class);  

        $Association = AssociationField::new('categorie', 'Catégorie');

        $AssociationText = TextField::new('categorie', 'Catégorie');      
               
        $image = ImageField::new('image')->setBasePath('/img/upload');

        $date = DateTimeField::new('updatedAt', 'Mise a jour le');

        $fields = [
            TextField::new('nom'),
            Field::new('prix'),
            TextField::new('description'),
        ];

        if($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            $fields[] = $AssociationText;
            $fields[] = $image;
            $fields[] = $date;
        } else {
            $fields[] = $Association;
            $fields[] = $imageFichier;
        }

        return $fields;
            
    }
    
}
