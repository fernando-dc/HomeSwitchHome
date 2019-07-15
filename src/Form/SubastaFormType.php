<?php

namespace App\Form;

use App\Entity\Subastas;
use App\Entity\Residencias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class SubastaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('precioActual', IntegerType::class, ['label' => 'Precio minimo inicial'])

            //->add('duracion',TextType::class,['label' => 'Duracion de la subasta en dias (por defecto es 3)' ])
            
            ->add('fechaInicio', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker-start',
                    'onkeydown'=>'return false',
                    'autocomplete'=>'off',  
                ],
                'html5'=>false,
                //'format' => 'dd-mm-yyyy',
                //'format' => 'yyyy-mm-dd',
                'label' => 'Fecha de inicio de reserva'  
            ])
            

            ->add('idResidencia', EntityType::class,[
                'class' => Residencias::class,
                'choice_label' => function($residencia){
                    return '(' . $residencia->getNombre() . ') ' . $residencia->getTipo() . '; habitaciones: ' . $residencia->getHabitaciones(). '. En ciudad: '.$residencia->getIdDireccion()->getCiudad(). ', '. $residencia->getIdDireccion()->getProvincia();
                },
                'multiple'=>false,
                'label' => 'Residencia'
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
