<?php

namespace App\Form;

use App\Entity\Usuarios;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Form\TarjetasType;

class UsuariosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email', EmailType::class, array('attr' => array('class' => 'form-control')))
        ->add('nombre', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('apellido', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('password', PasswordType::class, array('attr' => array('class' => 'form-control')))
        ->add('DNI', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('save', SubmitType::class, array('label' => 'Siguiente', 'attr' => array('class' => 'btn btn-info')))  
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Usuarios::class,
        ]);
    }
}