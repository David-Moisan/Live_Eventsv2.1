<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, [
                'label' => 'Identifiant utilisateur* :',
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe* :',
            ])
            ->add('email', null, [
                'label' => 'E-mail* :',
            ])
            ->add('firstname', null, [
                'label' => 'Prénom :',
            ])
            ->add('name', null, [
                'label' => 'Nom :',
            ])
            ->add('address', null, [
                'label' => 'Adresse :',
            ])
            ->add('city', null, [
                'label' => 'Ville :',
            ])
            ->add('postal_code', null, [
                'label' => 'Code postal :',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
