<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ref', null, [
                'label' => 'Référence',
            ])
            ->add('name')
            ->add('description')
            ->add('image')
            ->add('price')
            ->add('size', null, [
                'label' => 'Taille',
            ])
            ->add('not_size', null, [
                'label' => 'Pas de taille',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
