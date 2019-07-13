<?php

namespace App\Form;

use App\Entity\Tarjetas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Form\UsuariosType;

class TarjetasType2 extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('numeroTarjeta', TextType::class, ['attr' => ['class' => 'form-control'], 'help' => 'Ingrese los 16 digitos de su tarjeta'])
        ->add('codigo', NumberType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'XXXX'
            ],
            'help' => 'Codigo al dorso de su tarjeta'
            ])
        ->add('vencimiento', TextType::class, [
            'attr' => ['class' => 'form-control',
            'placeholder' => 'MMAA',],
            'help' => 'Utilize 2 digitos para el mes y 2 para el año'
            ])
        ->add('save', SubmitType::class, array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-lg btn-success')))  
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tarjetas::class,
        ]);
    }
}