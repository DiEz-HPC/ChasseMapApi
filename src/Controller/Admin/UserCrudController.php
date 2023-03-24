<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
    }

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
                ->allowMultipleChoices(),

            TextField::new('password')
                ->setFormType(RepeatedType::class)
                ->setFormTypeOptions([
                    'type' => PasswordType::class,
                    'first_options' => ['label' => 'Mot de passe'],
                    'second_options' => ['label' => 'Confirmation du mot de passe'],
                ])
                ->setRequired($pageName === Crud::PAGE_NEW)
                ->onlyOnForms()

        ];
    }
}
