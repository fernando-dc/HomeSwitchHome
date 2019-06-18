<?php

namespace App\Form;

use App\Entity\Residencias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ResidenciasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('tipo')
            ->add('habitaciones')
            ->add('descripcion', TextareaType::class ,)        
            ->add('IdDireccion',DireccionesType::class, ['label'=>'Direccion:'])  
            //->add('fotos', FileType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Residencias::class,
        ]);
    }
}
