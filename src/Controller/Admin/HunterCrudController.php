<?php

namespace App\Controller\Admin;

use App\Entity\Hunter;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HunterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hunter::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Hunter')
        ->setEntityLabelInSingular('Hunter')
    
        ->setPageTitle('index', 'Chasse map - Administration des Hunters')
        ->setPaginatorPageSize('10');
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
