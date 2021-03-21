<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('simpleName'),
            IntegerField::new("startYear"),
            IntegerField::new("endYear"),
            BooleanField::new("featured"),
            BooleanField::new("visible"),
            AssociationField::new('category'),
            ImageField::new('thumbnailFileName', 'Thumbnail')
                ->setUploadedFileNamePattern("[randomhash].[extension]")
                ->setBasePath("assets/img/data/thumb")
                ->setUploadDir("public/assets/img/data/thumb"),
            TextField::new('shortDescription'),
            TextField::new('frenchShortDescription')->hideOnIndex(),
            TextareaField::new('description')->hideOnIndex(),
            TextareaField::new('frenchDescription')->hideOnIndex()
        ];
    }
}
