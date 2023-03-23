<?php

namespace App\Controller\Admin;

use App\Entity\MapAPI;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MapAPICrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MapAPI::class;
        
    }

    public function configureCrud(Crud $crud): Crud
    {
        return Crud::new()

            ->overrideTemplates([
                'crud/index' => 'admin/mapAPI.html.twig',
            ])
            ->setEntityLabelInPlural('Chasse map - Map');
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
