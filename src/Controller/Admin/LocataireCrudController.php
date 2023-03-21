<?php

namespace App\Controller\Admin;

use App\Entity\Locataire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LocataireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Locataire::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
