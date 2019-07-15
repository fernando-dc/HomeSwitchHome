<?php

namespace App\Form;

use App\Entity\Residencias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
//use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\File;

class ResidenciasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('tipo')
            ->add('habitaciones')
            ->add('descripcion', TextareaType::class[])        
            ->add('IdDireccion',DireccionesType::class, ['label'=>'Direccion:'])
            ->add('imageFile', FileType::class, [
                'label'=>'Foto de la residencia:',
                'mapped' => false,
                'constraints' => [ new File([
                    'mimeTypes' => 'image/*',
                    'mimeTypesMessage' => 'El archivo debe ser una imagen',
                        
                ])],
                ])
            //->add('fotos', FileType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Residencias::class,
        ]);
    }
}
