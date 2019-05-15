<?php

namespace App\Form;

use App\Entity\Subastas;
use App\Entity\Residencias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class SubastaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('precioActual')
            
            ->add('fechaInicio', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker-start'],
                'html5'=>false,
            ])
            ->add('fechaFin')

            
            ->add('finalizada')
            ->add('residencias', EntityType::class,[
                'class' => Residencias::class,
                'choice_label' => function($residencia){
                    return $residencia->getTipo() . ' habitaciones: ' . $residencia->getHabitaciones();
                },
                'multiple'=>false,
            ])
            
            //->add('tokenAdmin')
            //->add('email')
            //->add('idResidencia')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Subastas::class,
        ]);
    }
}
