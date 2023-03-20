<?php

namespace App\Controller\Admin;

use App\Entity\ReportedProblem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
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

            ->setPageTitle(crud::PAGE_INDEX, 'Chasse map - Gestion des questions-Help')
            ->setPageTitle(crud::PAGE_DETAIL, 'Problème reportée')
            ->setPaginatorPageSize('10');
    }



    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Prénom'),
            TextField::new('email'),
            TextareaField::new('comments', 'Message')
                ->setFormTypeOption('disabled', 'disabled')


        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_DETAIL, Action::EDIT)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)
            ;
    }
}
