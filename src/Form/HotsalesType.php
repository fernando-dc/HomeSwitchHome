<?php

namespace App\Form;

use App\Entity\Hotsales;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\SemanasReserva2;


use App\Entity\SemanasReserva;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\SemanasType;



class HotsalesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idSemana', SemanasType::class, ['label'=>'Datos de la semana:'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hotsales::class,
        ]);
    }
}
