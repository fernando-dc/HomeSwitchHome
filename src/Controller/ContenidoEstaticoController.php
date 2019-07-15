<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContenidoEstaticoController extends Controller{

    /**
     * @Route("/contacto", name="contacto")
     */
    public function contacto(){

        return $this->render("/contenidoEstatico/contacto.html.twig");
    }

    /**
     * @Route("/preguntas_frecuentes", name="preguntas_frecuentes")
     */
    public function preguntas_frecuentes(){

        return $this->render("/contenidoEstatico/preguntasFrecuentes.html.twig");
    }
}