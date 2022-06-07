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
        yield Field::new('title');
        yield TextareaField::new('content');
        yield DateField::new('date');
        yield AssociationField::new('author');
        yield ImageField::new('articleImageSmall')
            ->setBasePath('uploads/blogImages')
            ->setUploadDir('public/uploads/blogImages')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');
        yield ImageField::new('articleImageBig')
            ->setBasePath('uploads/blogImages')
            ->setUploadDir('public/uploads/blogImages')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
            ->hideOnIndex();
    }
}
