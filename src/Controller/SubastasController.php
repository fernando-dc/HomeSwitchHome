<?php

namespace App\Controller;

use App\Entity\Administradores;
use App\Entity\SemanasReserva;
USE App\Entity\Residencias;

use App\Form\SubastaFormType;
use App\Entity\Subastas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class SubastasController extends AbstractController
{
    /**
     * @Route("/subasta/new", name="subasta_nueva")
     */
    public function new(Request $request)
    {

        /*
        return $this->render('subastas/index.html.twig', [
            'controller_name' => 'SubastasController',
        ]);
        */
        
        $em = $this-> getDoctrine()->getManager();
        $subasta = $em->getRepository(Subastas::class)->find(1);
        

        
        $form =$this->createForm(SubastaFormType::class);
        $form -> handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $subasta = $form->getData();
            $subasta->setTokenAdmin($em->getRepository(Administradores::class)->find('AAA000aaa111'));
            
            //$repoReservas = $em->getRepository(SemanasReserva::class);
            //$reservas = $repoReservas->reservasEnFecha($subasta->getIdResidencia(), $subasta->getFechaInicio());
            
            
           /* 
            if (!empty($reservas)) {
                
                return new Response('fecha ocupada'); 
            }
            
            
           */
            $duracion = '+ 7 days';
            $fecha_fin_subasta = $subasta->getFechaInicio()->format('Y-m-d');
            $subasta->setFechaFin(new \DateTime('@'.strtotime( $fecha_fin_subasta . $duracion)));

            $em->persist($subasta);
            $em->flush();
          
            //return new Response('fecha libre!!');
            $this->addFlash('success','Subasta creada exitosamente');
            return $this->redirectToRoute('subasta_nueva');
        }

        return $this->render('subastas/new.html.twig',['subastaForm'=> $form->createView(),]);
    }

    /**
     * @Route("/subastas/residencia{id}", name="subastas_de_residenciaX")
     */
    public function subastasResidencia($id){
        $em = $this-> getDoctrine()->getManager();
        //hacer query
        $residencia = $em->getRepository(Residencias::class)->find($id);
        $subastas = $residencia->getSubastas();

        return $this->render("/subastas/listado_de_residenciaX.html.twig", ['subastas' => $subastas ]);
    }

    /**
     * @Route("/subastas/listado", name="subastas_listado")
     */
    public function subastas(){
        $em = $this-> getDoctrine()->getManager();
        $subastas = $em->getRepository(Subastas::class)->findAll();

        return $this->render("/subastas/listado.html.twig", ['subastas' => $subastas ]);
    }

    /**
     * @Route("/subasta/detalles{id}", name="subasta_detalles")
     */
    public function subastasDetalles($id){
        $em = $this-> getDoctrine()->getManager();
        $subasta = $em->getRepository(Subastas::class)->find($id);

        return $this->render("/subastas/detalles.html.twig", ['subasta' => $subasta ]);
    }
}
