<?php


namespace App\Controller\Admin;


use App\Entity\Screenshot;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ScreenshotCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Screenshot::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('project'),
            ImageField::new('fileName', 'Image')
                ->setUploadedFileNamePattern("[randomhash].[extension]")
                ->setBasePath("assets/img/data/screen")
                ->setUploadDir("public/assets/img/data/screen"),
        ];
    }

}