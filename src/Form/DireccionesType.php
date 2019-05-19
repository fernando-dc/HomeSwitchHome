<?php

namespace App\Form;

use App\Entity\Direcciones;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DireccionesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codigo_postal')
            ->add('calle')
            ->add('numero')
            ->add('ciudad')
            ->add('provincia')
            ->add('piso')
            ->add('depto')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Direcciones::class,
        ]);
    }
}
