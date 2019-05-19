<?php

namespace App\Controller;

use App\Entity\Administradores;
use App\Entity\SemanasReserva;

use App\Form\SubastaFormType;
use App\Entity\Subastas;
use App\Entity\Pujas;
use App\Entity\Usuarios;

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

        $em = $this-> getDoctrine()->getManager();
        $subasta = $em->getRepository(Subastas::class)->find(1);



        $form =$this->createForm(SubastaFormType::class);
        $form -> handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $subasta = $form->getData();
            $subasta->setTokenAdmin($em->getRepository(Administradores::class)->find('AAA000aaa111'));

            //$repoReservas = $em->getRepository(SemanasReserva::class);
            //$reservas = $repoReservas->reservasEnFecha($subasta->getIdResidencia(), $subasta->getFechaInicio());


            //Deberian ser +6 days pero el constructor resta un dia a la fecha
            $duracion = '+ 7 days';
            $fecha_fin_subasta = $subasta->getFechaInicio()->format('Y-m-d');

            $subasta->setFechaFin(new \DateTime('@'.strtotime( $fecha_fin_subasta . $duracion)));
            //Si se usa "today" en vez de "tomorrow" por alguna razon asigna la fecha actual - 1, por eso se usa el valor "tomorrow" para la fecha
            $subasta->setFechaSubasta(new \DateTime('@'.strtotime( "tomorrow")));

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
        $subastas = $em->getRepository(Subastas::class)->findBy($id);

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

    /**
     * @Route("/subasta/finalizar/{id}", name="subasta_finalizar")
     */
    public function finalizarSubasta($id){
        /**
         * Logica:
         * Si todavia no se alcanzo la fecha de finalizacion de la subasta, la subasta se cancela (queda como finalizada) si nadie pujo o los que hayan pujado no tienen creditos al momento de cerrarla.
         * Si alguien pujo pero la fecha de finalizacion no se alcanzo, se impide cancelar la subasta.
         *
         * Si ya se alcanzo la fecha de finalizacion y se encuentra un ganador (alguien que haya pujado y tenga creditos suficientes) se crea la reserva y se finaliza la subasta
         * Caso contrario se finaliza la subasta sin generar la reserva y sin ganador.
         */


        $em = $this->getDoctrine()->getManager();
        $subasta = $em->getRepository(Subastas::class)->find($id);

        $duracion = '+'. $subasta->getDuracion() . ' days';

        if ($subasta->getFinalizada()){
            $this -> addFlash('danger','La subasta ya fue finalizada');
            return $this ->redirectToRoute('residencias_listado');
        }

        $usuario = $this->obtenerGanador($subasta);

        //si la fecha actual es menor a la fecha en la que debe finalizar la subasta (duracion + fecha_subasta)
        if(date('Y-m-d', strtotime('today')) < ($subasta->getFechaSubasta()->modify($duracion))->format('Y-m-d') ){
            if (!is_null($usuario)){
                $this -> addFlash('danger','La subasta tiene pujas, por lo que no puede finalizarse antes de la duracion de la misma');
                return $this ->redirectToRoute('residencias_listado');
            }
        }
        //si ya se cumplio la duracion de la subasta
        else{

            if (!is_null($usuario)){
                $reserva = new SemanasReserva();
                $reserva -> setPrecio($subasta->getPrecioActual());
                $reserva -> setFechaInicio($subasta->getFechaInicio());
                $reserva -> setFechaFin($subasta->getFechaFin());
                $reserva -> setIdResidencia($subasta->getIdResidencia());
                $reserva -> setEmail($usuario);

                //se establece el ganador en la subasta
                $subasta -> setEmail($usuario);
                $subasta -> setFinalizada(true);
                $usuario -> restarCredito();

                $em->persist($reserva);
                $em->flush();

                $this -> addFlash('success','Subasta finalizada con exito. El ganador de la subasta es: ' . $usuario->getNombre() . ' ' . $usuario->getApellido());
                return $this ->redirectToRoute('residencias_listado');
            }
        }

        $subasta -> setFinalizada(true);
        $em ->flush();

        $this -> addFlash('danger','No hay ganadores posibles, la subasta queda cancelada');
        return $this ->redirectToRoute('residencias_listado');

    }


    private function obtenerGanador($subasta){
        if(!($subasta->getPujas()->isEmpty())){
            $em = $this->getDoctrine()->getManager();
            $pujas = $em->getRepository(Pujas::class)->pujasOrdenadasMontoUsuarioValido($subasta->getIdSubasta());
            if (!empty($pujas)){
                return $em->getRepository(Usuarios::class)->find($pujas[0]->getEmail());
            }
        }
        return null;
    }


}
