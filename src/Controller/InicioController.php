<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class InicioController extends Controller{

    /**
     * @Route("/inicio", name="inicio")
     */

    public function inicio(){
      return $this->render('/login/inicio.html.twig');
    }

    /**
     * @Route("/inicie_sesion", name="inicie_sesion")
     */

    public function inicieSesion(){

      return $this->render('/login/inicie_sesion.html.twig');
    }
}