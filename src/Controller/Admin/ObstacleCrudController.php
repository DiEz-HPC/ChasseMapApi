<?php

namespace App\Controller\Admin;

use App\Entity\Obstacle;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ObstacleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Obstacle::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Obstacle')
        ->setEntityLabelInSingular('Obstacle')
    
        ->setPageTitle('index', 'Chasse map - Administration des Obstacles')
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
