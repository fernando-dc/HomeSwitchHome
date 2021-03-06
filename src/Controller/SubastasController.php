<?php

namespace App\Controller;

use App\Entity\Administradores;
use App\Entity\SemanasReserva;
USE App\Entity\Residencias;

use App\Form\SubastaFormType;
use App\Form\SubastaFormType2;
use App\Entity\Subastas;
use App\Entity\Pujas;
use App\Entity\Usuarios;
use App\Entity\Notificaciones;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;

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
            //$subasta->setTokenAdmin($em->getRepository(Administradores::class)->find('AAA000aaa111'));

            //TODO : checkear si el que esta loggeado es un admin
            $subasta->setTokenAdmin($this->getUser());

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
            return $this->redirectToRoute('subastas_listado');
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
        if($this->isGranted('ROLE_ADMIN')){

            $subastasActivas = $em->getRepository(Subastas::class)->findBy(['finalizada' => '0']);
            $subastasFinalizadas = $em->getRepository(Subastas::class)->findBy(['finalizada' => '1']);
            $subastas = array_merge($subastasActivas, $subastasFinalizadas);
            return $this->render("/subastas/listado.html.twig", ['subastas' => $subastas ]);
        }
        else{
            $subastasActivas = $em->getRepository(Subastas::class)->findBy(['finalizada' => '0']);
            return $this->render("/subastas/listado.html.twig", ['subastas' => $subastasActivas ]);
        }
        
    }

    /**
     * @Route("/subasta/detalles{id}", name="subasta_detalles")
     */
    public function subastasDetalles($id){
        $em = $this-> getDoctrine()->getManager();
        $subasta = $em->getRepository(Subastas::class)->find($id);
        $pujas = $em->getRepository(Pujas::class)->pujasOrdenadasMonto($id);
        return $this->render("/subastas/detalles.html.twig", ['subasta' => $subasta, 'pujas' =>$pujas ]);
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
            return $this ->redirectToRoute('subastas_listado');
        }

        $usuario = $this->obtenerGanador($subasta);

        //si la fecha actual es menor a la fecha en la que debe finalizar la subasta (duracion + fecha_subasta)
        /*
        if(date('Y-m-d', strtotime('today')) < ($subasta->getFechaSubasta()->modify($duracion))->format('Y-m-d') ){
            if (!is_null($usuario)){
                $this -> addFlash('danger','La subasta tiene pujas, por lo que no puede finalizarse antes de la duracion de la misma');
                return $this ->redirectToRoute('subastas_listado');
            }
        }
        //si ya se cumplio la duracion de la subasta
        
        else{
            */
            
            
        if (!is_null($usuario)){
            $reserva = new SemanasReserva();
            $reserva -> setPrecio($subasta->getPrecioActual());
            $reserva -> setFechaInicio($subasta->getFechaInicio());
            $reserva -> setFechaFin($subasta->getFechaFin());
            $reserva -> setIdResidencia($subasta->getIdResidencia());
            $reserva -> setIdUsuario($usuario);

            //se establece el ganador en la subasta
            $subasta -> setIdUsuario($usuario);
            $subasta -> setFinalizada(true);
            $usuario -> restarCredito();

            $em->persist($reserva);
            $em->flush();

            //aca se hace la notificación para el ganador
            $notificacion = new Notificaciones();
            $notificacion->setIdUsuario($usuario);
            $notificacion->setIdSubasta($subasta);
            $notificacion->setIdResidencia($subasta->getIdResidencia());
            $notificacion->setFecha((date_create(date('Y-m-d'))));
            $notificacion->setTexto('¡Has ganado la subasta! ' );
            $em->persist($notificacion);
            $em->flush();


            $this -> addFlash('success','Subasta finalizada con exito. El ganador de la subasta es: ' . $usuario->getNombre() . ' ' . $usuario->getApellido());
            return $this ->redirectToRoute('subastas_listado');
        }
            
        $subasta -> setFinalizada(true);
        $em ->flush();

        $this -> addFlash('danger','No hay ganadores posibles, la subasta queda cancelada');
        return $this ->redirectToRoute('subastas_listado');

    }


    private function obtenerGanador($subasta){
        if(!($subasta->getPujas()->isEmpty())){
            $em = $this->getDoctrine()->getManager();
            $pujas = $em->getRepository(Pujas::class)->pujasOrdenadasMontoUsuarioValido($subasta->getIdSubasta());
            if (!empty($pujas)){
                return $em->getRepository(Usuarios::class)->find($pujas[0]->getIdUsuario());
            }
        }
        return null;
    }

    /**
     * @Route("/subasta/participarDeLaSubasta{id}", name="subastas_participar")
     */
    public function participarDeSubasta($id, Request $request){
        $user = $this->getUser();
        if($user != null){
            
            if ($hasAccess = $this->isGranted('ROLE_ADMIN')){ $user = $this->getUser()->getIdUsuario(); }

            $coleccion = Array();
            $idUsuarioLogeado = $user;
            $pujas = $this-> getDoctrine()->getManager()->getRepository(Pujas::class)->findBy(['idUsuario' => $idUsuarioLogeado]);
            if($pujas){
                for ($i = 0; $i < sizeOf($pujas); $i++){    
                    $subastaDePuja = $pujas[$i]->getIdSubasta();
                    if($subastaDePuja->getFinalizada() != 1 && !( in_array($subastaDePuja, $coleccion )) ){
                        array_push($coleccion, $subastaDePuja );
                    }
                }
            }
        
            $puja = new Pujas();
            $form = $this->createFormBuilder($puja)
            ->add('monto', IntegerType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Pujar', 'attr' => array('class' => 'btn btn-info')))
            ->getForm();
            $form -> handleRequest($request);

            if( $form->isSubmitted() && $form->isValid() ){

                $em = $this-> getDoctrine()->getManager();
                $subasta = $em->getRepository(Subastas::class)->find($id);    

                $puja = $form->getData();
                if(($puja->getMonto()) > ($subasta->getPrecioActual()) ){
                
                    //crea la puja del usuario
                    $puja->setMonto($puja->getMonto());
                    $puja->setIdUsuario($user);
                    $puja->setIdSubasta($subasta);

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($puja);
                    $entityManager->flush();

                    //actualiza el precio actual de la subasta
                    $subasta->setPrecioActual($puja->getMonto());
                    $entityManager->flush();
                
                    $this -> addFlash('success', "Usted se encuentra participando de la subasta.");
                    return $this ->redirectToRoute('subasta_detalles',['id'=> $subasta->getIdSubasta()]);
                }
                else{
                    $this -> addFlash('danger', "Su monto no supera el monto mínimo.");
                }
            }

            
            if((sizeOf($coleccion)) < (($user->getCreditos())*2)){
                //el usuario puede participar
                $subasta = $this-> getDoctrine()->getManager()->getRepository(Subastas::class)->find($id);  
                return $this ->render('/subastas/participar.html.twig', ['form' => $form->createView(), 'subasta' => $subasta] );
            }
            else{
                //el usuario no puede participar
                $this -> addFlash('danger', "No tiene créditos suficientes para participar de la subasta.");
                return $this ->redirectToRoute('subastas_listado');
                }
            }
        else{
            //
            return $this->render('/login/inicie_sesion.html.twig');
        }
    }

    /**
     * @Route("/subasta/participando", name="subastas_participando")
     */
    public function subastasParticipando(){
        $user = $this->getUser()->getIdUsuario();
        if ($user != null){

        //$user = $user->getEmail(); 
        
        $coleccion = Array();
        $idUsuarioLogeado = $user;
        $pujas = $this-> getDoctrine()->getManager()->getRepository(Pujas::class)->findBy(['idUsuario' => $idUsuarioLogeado]);
        if($pujas){
            for ($i = 0; $i < sizeOf($pujas); $i++){
                $subastaDePuja = $pujas[$i]->getIdSubasta();
                if($subastaDePuja->getFinalizada() != 1 && !( in_array($subastaDePuja, $coleccion ) ) ){
                    array_push($coleccion, $subastaDePuja );
                }
            }
        }

        return $this->render('/subastas/participando.html.twig', ['subastas' => $coleccion]);
        }
        else{
            //
            return $this->render('/login/inicie_sesion.html.twig');
        }
    }
    /**
     * @Route("/subastas/edit/{idSubasta}", name="subastas_edit", Methods={"GET","POST"})
     */

    public function modificarSubasta (Request $request, Subastas $subasta): Response{

        $form = $this->createForm(SubastaFormType2::class, $subasta);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            //$subastaModificada = $form->getData();
            //$subasta->setPrecioActual($subastaModificada->getPrecioActual());

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subastas_listado');
        }

        return $this->render('subastas/edit.html.twig', [
            'subasta' => $subasta,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/subastas/delete/{idSubasta}", name="subasta_delete")
     */
    public function eliminarSubasta(Subastas $subasta){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($subasta);
        $entityManager->flush();

        return $this->redirectToRoute('subastas_listado');
    }

}