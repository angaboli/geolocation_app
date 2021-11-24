<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $user =  new User();
        //dd($user->getGenderChoices());
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('prenom'),
            EmailField::new('email'),
            BooleanField::new('isVerified')->hideOnForm()->hideWhenCreating()->setDisabled(),
            ChoiceField::new('genre')->setChoices($user->getGenderChoices()),
            CountryField::new('pays'),
            ChoiceField::new('metier')->setChoices($user->getMetierChoices()),
            TextField::new('dateDeNaissance'),
            TextField::new('password')->hideOnIndex()->setFormType(PasswordType::class)
        ];
    }





}
