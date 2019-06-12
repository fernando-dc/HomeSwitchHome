<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\SemanasReserva;
use App\Entity\Residencias;

class SemanaController extends AbstractController
{
    /**
     * @Route("/semana", name="semana")
     */
    public function index()
    {
        return $this->render('semana/index.html.twig', [
            'controller_name' => 'SemanaController',
        ]);
    }

    /**
     * @Route("/semana/{f_i}_{f_f}_{idRes}", name="semana_residencia")
     */
    public function semanaDeReserva($f_i, $f_f, $idRes)
    {
        /*
        $form = $this->createFormBuilder()
            ->add('')
            ->getForm();
        */
        $em = $this->getDoctrine()->getManager();
        $residencia = $em->getRepository(Residencias::class)->find($idRes);



        
        return $this->render('semana/semanaResidencia.html.twig', [
            'controller_name' => 'SemanaController',
            'residencia'=> $residencia,
            'semana' => ['fecha_inicial' =>$f_i, 'fecha_final'=> $f_f]
            
        ]);
        //return new Response($f_i.' '.$f_f.' '.$idRes);
    }
}
