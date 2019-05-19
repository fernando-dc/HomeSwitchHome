<?php

namespace App\Form;

use App\Entity\Residencias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResidenciasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo')
            ->add('habitaciones')
            ->add('descripcion')        
            ->add('IdDireccion',DireccionesType::class, ['label'=>'Direccion:'])  
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Residencias::class,
        ]);
    }
}
