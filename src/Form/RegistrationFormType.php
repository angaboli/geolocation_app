<?php

namespace App\Form;

use App\Entity\User;
use App\Geolocation\Geolocate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $geolocate = new Geolocate();
        $cooridnates = $geolocate->getIPCoordinate();
        $country = $cooridnates["country_code"];

        $builder
            ->add('nom', TextType::class, [
                'label'=>false,
                'attr' => [
                    'placeholder' => 'Nom',
                    'class' => 'form-control'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label'=>false,
                'attr' => [
                    'placeholder' => 'Prénom',
                    'class' => 'form-control'
                ]
            ])
            ->add('email', TextType::class, [
                'label'=>false,
                'attr' => [
                    'placeholder' => 'Email',
                    'class' => 'form-control'
                ]
            ])
            ->add('genre', ChoiceType::class, [
                'choices' => $this->getGenderChoices(),
                'label'=>false,
                'placeholder' => 'Genre',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('pays', CountryType::class, [
                'label'=>false,
                'preferred_choices' => [$country],
                'attr' => [
                    'placeholder' => 'Choisissez votre pays',
                    'class' => 'form-control',
                ]
            ])
            ->add('dateDeNaissance', TextType::class, [
                'label'=>false,
                'attr' => [
                    'placeholder' => 'Date de naissance, au format JJ/MM/AAAA',
                    'class' => 'form-control'
                ]
            ])
            ->add('metier', ChoiceType::class, [
                'choices' => $this->getMetierChoices(),
                'label'=>false,
                'placeholder' => 'Choisissez votre métier',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
/*            ->add('plainPassword', PasswordType::class, [
                'label'=>false,
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Mot de passe',
                    'class' => 'form-control'
                ]
            ])*/
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Mot de passe',
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    private function getGenderChoices()
    {
        $choices = User::SEXE;
        $output = [];
        foreach ($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }

    private function getMetierChoices()
    {
        $choices = User::SECTEUR;
        $output = [];
        foreach ($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }
}
