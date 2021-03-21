<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['startYear' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('simpleName')->hideOnIndex(),
            ImageField::new('thumbnailFileName', 'Thumbnail')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setBasePath('assets/img/data/thumb')
                ->setUploadDir('public/assets/img/data/thumb'),
            TextField::new('shortDescription'),
            TextField::new('frenchShortDescription')->hideOnIndex(),
            IntegerField::new('startYear'),
            IntegerField::new('endYear'),
            BooleanField::new('featured'),
            BooleanField::new('visible'),
            AssociationField::new('category'),
            AssociationField::new('downloads'),
            CodeEditorField::new('description')
                ->hideOnIndex()
                ->setLanguage('markdown')
                ->setIndentWithTabs(false)
                ->setTabSize(4),
            CodeEditorField::new('frenchDescription')
                ->hideOnIndex()
                ->setLanguage('markdown')
                ->setIndentWithTabs(false)
                ->setTabSize(4)
        ];
    }
}
