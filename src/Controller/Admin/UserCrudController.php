<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

public function configureCrud(Crud $crud): Crud
{
    return $crud
    ->setEntityLabelInPlural('Membres')
    ->setEntityLabelInSingular('Membres')

    ->setPageTitle('index', 'Chasse map - Administration des membres')
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
