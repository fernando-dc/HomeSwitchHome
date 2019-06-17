<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;




use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



use App\Entity\Subastas;


class InicioController extends AbstractController{

    /**
     * @Route("/", name="index")
     */
    public function index(){

      return $this->redirectToRoute('residencias_index');
    }

    /**
     * @Route("/inicio", name="inicio")
     */

    public function inicio(AuthenticationUtils $authenticationUtils): Response{

      $em = $this-> getDoctrine()->getManager();
      $subastasActivas = $em->getRepository(Subastas::class)->findBy( ['finalizada' => '0'] );

      // get the login error if there is one
      $error = $authenticationUtils->getLastAuthenticationError();
      // last username entered by the user
      $lastUsername = $authenticationUtils->getLastUsername();

      return $this->render('/login/inicio.html.twig', ['subastas' => $subastasActivas, 'last_username' => $lastUsername, 'error' => $error]);
    }

    /*public function inicio(){

      $em = $this-> getDoctrine()->getManager();
      $subastasActivas = $em->getRepository(Subastas::class)->findBy( ['finalizada' => '0'] );


      return $this->render('/login/inicio.html.twig', ['subastas' => $subastasActivas]);
    }*/

    /**
     * @Route("/inicie_sesion", name="inicie_sesion")
     */

    public function inicieSesion(){

      return $this->render('/login/inicie_sesion.html.twig');
    }
}