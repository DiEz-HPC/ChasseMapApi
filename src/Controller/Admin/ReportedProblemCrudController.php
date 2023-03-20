<?php

namespace App\Controller\Admin;

use App\Entity\ReportedProblem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReportedProblemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ReportedProblem::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Problème')
        ->setEntityLabelInSingular('Problème')
    
        ->setPageTitle('index', 'Chasse map - Gestion des questions-Help')
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
