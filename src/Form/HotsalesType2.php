<?php

namespace App\Form;

use App\Entity\Hotsales;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Entity\SemanasReserva;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\SemanasType2;



class HotsalesType2 extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idSemana', SemanasType2::class, ['label'=>' '])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hotsales::class,
            'validation_groups' => false,
        ]);
    }
}
