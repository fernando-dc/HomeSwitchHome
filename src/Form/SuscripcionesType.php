<?php

namespace App\Form;

use App\Entity\Suscripciones;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SuscripcionesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('precio', IntegerType::class, ['label' => 'Precio'])        
            ->add('save', SubmitType::class, array('label' => 'Aceptar', 'attr' => array('class' => 'btn btn-info')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Suscripciones::class,
        ]);
    }
}