<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\SuscripcionesType;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Suscripciones;

class SuscripcionesController extends AbstractController{

    /**
     * @Route("/suscripciones/configurar", name="configurar_precios")
     */
    public function configurarSuscripciones(){

        $suscripcionStandard = $this->getDoctrine()->getManager()->getRepository(Suscripciones::class)->findOneBy(['nombre' => 'standard']);
        $suscripcionPremium = $this->getDoctrine()->getManager()->getRepository(Suscripciones::class)->findOneBy(['nombre' => 'premium']);
        

        return $this->render("/suscripciones/configurar.html.twig", ["suscripcionStandard" => $suscripcionStandard, "suscripcionPremium" => $suscripcionPremium]);
    }


    /**
     * @Route("/suscripciones/configurar/{suscripcion}", name="configurar_suscripcion", methods={"GET","POST"})
     */
    public function configurarSuscripcion(Request $request, Suscripciones $suscripcion): Response{
        
        $form = $this->createForm(SuscripcionesType::class, $suscripcion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success','Ha configurado el precio exitosamente.');
            return $this->redirectToRoute('configurar_precios');
        }

        

        return $this->render('/suscripciones/configurarSuscripcion.html.twig', [
            'suscripcion' => $suscripcion,
            'form' => $form->createView(),
        ]);
    }


}