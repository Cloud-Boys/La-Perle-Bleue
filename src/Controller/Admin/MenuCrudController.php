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
        $imageFichier = TextareaField::new('imageFichier', 'Image')->setFormType(VichImageType::class)->setFormTypeOption('allow_delete', false);  

        $Association = AssociationField::new('categorie', 'Catégorie');

        $AssociationText = TextField::new('categorie', 'Catégorie');      
               
        $image = ImageField::new('image')->setBasePath('/img/upload');

        $date = DateTimeField::new('updatedAt', 'Mise a jour le');

        $suggestion = Field::new('suggestion');

        $fields = [
            TextField::new('nom'),
            TextField::new('prix'),
            TextField::new('description'),
        ];

        if($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            $fields[] = $AssociationText;
            $fields[] = $image;
            $fields[] = $date;
            $fields[] = $suggestion;
        } else {
            $fields[] = $Association;
            $fields[] = $suggestion;
            $fields[] = $imageFichier;
        }

        return $fields;
            
    }
    
}
