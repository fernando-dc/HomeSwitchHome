<?php

namespace App\Form;

use App\Entity\SemanasReserva;
use App\Entity\Residencias;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class SemanasType2 extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('precio', IntegerType::class, ['label' => 'Precio'])
        
        
        //->add('tokenAdmin')
        //->add('email')
        //->add('idResidencia')
    ;
}


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SemanasReserva::class,
            'validation_groups' => false,
        ]);
    }
}