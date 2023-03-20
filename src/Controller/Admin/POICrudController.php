<?php

namespace App\Controller\Admin;

use App\Entity\POI;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class POICrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return POI::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('POI')
            ->setEntityLabelInSingular('POI')

            ->setPageTitle('index', 'Chasse map - Administration des POI')
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
