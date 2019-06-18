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
        ->add('numero_tarjeta', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('codigo', NumberType::class, array('attr' => array('class' => 'form-control')))
        ->add('vencimiento', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('save', SubmitType::class, array('label' => 'Siguiente', 'attr' => array('class' => 'btn btn-info')))  
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tarjetas::class,
        ]);
    }
}