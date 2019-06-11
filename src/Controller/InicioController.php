<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Entity\Subastas;


class InicioController extends Controller{

    /**
     * @Route("/", name="index")
     */
    public function index(){

      return $this->redirectToRoute('residencias_index');
    }

    /**
     * @Route("/inicio", name="inicio")
     */

    public function inicio(){

      $em = $this-> getDoctrine()->getManager();
      $subastasActivas = $em->getRepository(Subastas::class)->findBy( ['finalizada' => '0'] );


      return $this->render('/login/inicio.html.twig', ['subastas' => $subastasActivas]);
    }

    /**
     * @Route("/inicie_sesion", name="inicie_sesion")
     */

    public function inicieSesion(){

      return $this->render('/login/inicie_sesion.html.twig');
    }
}