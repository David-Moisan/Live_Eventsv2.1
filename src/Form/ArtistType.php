<?php

namespace App\Form;

use App\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => "Nom de l'artiste"])
            ->add('hours', null, ['label' => 'Heure de passage'])
            ->add('scene', null, ['label' => 'Scène'])
            ->add('genre', null, ['label' => 'Genre musical'])
            ->add('id_program', null, ['label' => 'Date de passage'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
