<?php

namespace App\Form;

use App\Entity\SemanasReserva;
use App\Entity\Residencias;
use App\Repository\ResidenciasRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class SemanasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('precio', IntegerType::class, ['label' => 'Precio'])

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
            'label' => 'Fecha de inicio de la semana' ,
            'help' => 'La duracion de la semana de reserva es de 7 dias', 
        ])

        ->add('idResidencia', EntityType::class,[
            'class' => Residencias::class,
            'query_builder' => function (ResidenciasRepository $er) {
                return $er->createQueryBuilder('r')
                    ->andWhere('r.eliminado = 0');
            },
            'choice_label' => function($residencia){
                return '(' . $residencia->getNombre() . ') ' . $residencia->getTipo() . '; habitaciones: ' . $residencia->getHabitaciones(). '. En ciudad: '.$residencia->getIdDireccion()->getCiudad(). ', '. $residencia->getIdDireccion()->getProvincia();
            },
            'multiple'=>false,
            'label' => 'Seleccione la residencia:'
        ])
        
        //->add('tokenAdmin')
        //->add('email')
        //->add('idResidencia')
    ;
}


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SemanasReserva::class,
        ]);
    }
}