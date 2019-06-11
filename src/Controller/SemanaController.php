<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SemanaController extends AbstractController
{
    /*
     * @Route("/semana", name="semana")
        public function index()
        {
        return $this->render('semana/index.html.twig', [
             'controller_name' => 'SemanaController',
             ]);
        }
    */
            
    /**
     * @Route("/semana_{$f_i}_{$f_f}_{$idRes}", name="semana")
     */
    public function semanaDeReserva($f_i, $f_f, $idRes)
    {
        

        return $this->render('semana/semanaResidencia.html.twig', [
            'controller_name' => 'SemanaController',
            
        ]);
    }
}
