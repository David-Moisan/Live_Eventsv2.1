<?php

namespace App\Form;

use App\Entity\Partenaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartenairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'Nom de la société'])
            ->add('fb', null, ['label' => 'Profil Facebook'])
            ->add('tw', null, ['label' => 'Profil Twitter'])
            ->add('yt', null, ['label' => 'Profil YouTube'])
            ->add('insta', null, ['label' => 'Profil Instagram'])
            ->add('image')
            ->add('id_categorie', null, ['label' => 'La catégorie'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partenaires::class,
        ]);
    }
}
