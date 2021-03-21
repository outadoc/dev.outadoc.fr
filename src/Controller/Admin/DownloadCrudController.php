<?php

namespace App\Controller\Admin;

use App\Entity\Download;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class DownloadCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Download::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('project'),
            AssociationField::new('platform'),
            UrlField::new('downloadUrl'),
            UrlField::new('sourceUrl'),
            MoneyField::new('price')
                ->setCurrency('EUR')
                ->setStoredAsCents(false),
            TextField::new('version')
        ];
    }
}
