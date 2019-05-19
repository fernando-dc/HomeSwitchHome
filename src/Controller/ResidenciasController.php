<?php

namespace App\Controller;

use App\Entity\Residencias;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ResidenciasController extends AbstractController
{
    /**
     * @Route("/residencias", name="residencias_listado")
     */
    public function listadoResidencias()
    {
        $em = $this->getDoctrine()->getManager();
        $residencias = $em->getRepository(Residencias::class)->findAll();


        return $this-> render('residencias/listado.html.twig', ['residencias' => $residencias]);
        
    }
    /**
     * @Route("/residencia{id}", name="residencia_detalle");
     */
    public function detallesResidencia($id){

        $residencia = $this->getDoctrine()->getRepository(Residencias::class)->find($id);

        return $this-> render('residencias/detalles.html.twig', ['residencia' => $residencia]);
    }
}
