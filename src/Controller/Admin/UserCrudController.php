<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AvatarField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Choice;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
            yield IdField::new('id')
                ->onlyOnIndex();
            yield AvatarField::new('avatar')
                ->formatValue(static function($value, ?User $user) {
                   return $user?->getAvatarUrl();
                })
                ->onlyOnIndex();
            yield ImageField::new('avatar')
                ->setBasePath('uploads/avatars')
                ->setUploadDir('public/uploads/avatars')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
                ->hideOnIndex();
            yield TextField::new('username');
            yield EmailField::new('email');
            yield BooleanField::new('isVerified')
                ->renderAsSwitch(false);
            yield AssociationField::new('blogs')
                ->setFormTypeOption('choice_label', 'slug')
                ->setFormTypeOption('by_reference', false);
            $roles = ['ROLE_USER', 'ROLE_ADMIN'];
            yield ChoiceField::new('roles')
                ->setChoices(array_combine($roles, $roles))
                ->allowMultipleChoices()
                ->renderExpanded()
                ->renderAsBadges();
    }
}
