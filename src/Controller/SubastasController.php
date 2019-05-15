<?php

namespace App\Controller;

use App\Form\SubastaFormType;
use App\Entity\Subastas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


class SubastasController extends AbstractController
{
    /**
     * @Route("/subastas", name="subastas")
     */
    public function index()
    {

        /*
        return $this->render('subastas/index.html.twig', [
            'controller_name' => 'SubastasController',
        ]);
        */
        
        $em = $this-> getDoctrine()->getManager();
        $subasta = $em->getRepository(Subastas::class)->find(1);
        
        /*
        $form = $this->createFormBuilder($subasta)
            ->add('precioActual')
            ->add('fechaInicio', DateType::class)
            ->add('fechaFin', DateType::class)
            ->add('finalizada')
            ->add('save',SubmitType::class,['label'=>'Guardar Subasta'])
            ->getForm();
        */

        $form =$this->createForm(SubastaFormType::class);
        return $this->render('subastas/new.html.twig',['subastaForm'=> $form->createView(),]);
    }
}
