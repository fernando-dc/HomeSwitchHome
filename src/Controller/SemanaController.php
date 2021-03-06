<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\SemanasReserva;
use App\Entity\Residencias;
use App\Entity\Notificaciones;
use App\Entity\Suscripciones;
use App\Entity\Hotsales;

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
        $usuario = $this->getUser();

        $premium = $em->getRepository(Suscripciones::class)->findOneBy(['nombre' => 'premium']);
        $precioPremium = $premium->getPrecio();
        
        return $this->render('semana/semanaResidencia.html.twig', [
            'controller_name' => 'SemanaController',
            'residencia'=> $residencia,
            'semana' => ['fecha_inicial' =>$f_i, 'fecha_final'=> $f_f],
            'usuario' => $usuario, 'precioPremium' =>  $precioPremium
            
        ]);
        //return new Response($f_i.' '.$f_f.' '.$idRes);
    }

    /**
     * @Route("/semana/adjudicar/{f_i}_{f_f}_{idRes}", name="adjudicar_semana")
     */
    public function adjudicarSemana($f_i, $f_f, $idRes)
    {
        $user = $this->getUser();
        $em= $this->getDoctrine()->getManager();
        if($this->isGranted('ROLE_ADMIN')){
            $user = $user->getIdUsuario();
        }
        $residencia = $em->getRepository(Residencias::class)->find($idRes);
        
        
        //Si la residencia existe y no esta ocupada en la semana deseada, se crea la reserva y se resta un credito al usuario

        if(!is_null($residencia)){
            if(!$residencia->ocupadaEntreFechas($f_i,$f_f)){
                $semanaReserva = new SemanasReserva();
                $semanaReserva->setPrecio(3000);
                $semanaReserva->setFechaInicio(date_create($f_i));
                $semanaReserva->setFechaFin(date_create($f_f));
                $semanaReserva->setIdResidencia($residencia);
                $semanaReserva->setIdUsuario($user);

                $user->restarCredito();

                $em->persist($semanaReserva);
                $em->flush();

                //se genera la notificacion para el usuario
                $notificacion = new Notificaciones();
                $notificacion->setIdUsuario($user);
                $notificacion->setIdResidencia($residencia);
                $notificacion->setFecha((date_create(date('Y-m-d'))));
                $notificacion->setTexto('¡Has reservado la residencia! ' );
                $em->persist($notificacion);
                $em->flush();



                $this->addFlash('success','La residencia ha sido correctamente reservada.');

            } else{

                $this->addFlash('danger','La residencia ya fue reservada para esa semana, operacion anulada.');
            }
        }

        return $this->redirectToRoute('filtro');
    }

    /**
     * @Route("/cancelarReserva/{idSemana}", name="cancelar_reserva")
     */
    public function cancelarReserva(SemanasReserva $semana){

        $entityManager = $this->getDoctrine()->getManager();

        $hotsale =$this->getDoctrine()->getManager()->getRepository(Hotsales::class)->findOneBy(['idSemana' => $semana->getIdSemana()]);
        if( $hotsale != null){
            $entityManager->remove($hotsale);
            $entityManager->flush();
        }

       
        $entityManager->remove($semana);
        $entityManager->flush();
        
         $this->addFlash('success','Se ha cancelado correctamente la reserva.');
         return $this->redirectToRoute('mis_reservas');
    }
}
