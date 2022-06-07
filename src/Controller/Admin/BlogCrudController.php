<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class BlogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Blog::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield Field::new('title', 'Titel');
        yield TextareaField::new('content')
            ->hideOnIndex();
        yield DateField::new('date', 'Datum');
        yield AssociationField::new('author', 'Auteur');
        yield ImageField::new('articleImageSmall', 'Kleine image (preview)')
            ->setBasePath('uploads/blogImages')
            ->setUploadDir('public/uploads/blogImages')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');
        yield ImageField::new('articleImageBig', 'Grote image (artikel)')
            ->setBasePath('uploads/blogImages')
            ->setUploadDir('public/uploads/blogImages')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
            ->hideOnIndex();
    }
}
