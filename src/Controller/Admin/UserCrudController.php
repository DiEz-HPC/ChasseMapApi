<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{

    public const ROLES = [
        "ROLE_ADMIN" => "Administrateur",
        "ROLE_MEMBER" => "Member",
    ];

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()

            ->overrideTemplates([
                'crud/field/choice' => 'admin/_roleChoiceField.twig',
            ])
            ->setEntityLabelInPlural('Chasse map - Liste des membres');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('email'),
            ChoiceField::new('roles', 'Role du compte')
                ->setChoices([
                    "Administrateur" => "ROLE_ADMIN",
                    "Membre" => "ROLE_USER",
                ])
       
                ->allowMultipleChoices()

        ];
    }
}
