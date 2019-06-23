<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

use App\Entity\Usuarios;
use App\Entity\Tarjetas;
use App\Entity\Suscripciones;
use App\Entity\SemanasReserva;
use App\Entity\Pujas;
use App\Entity\Notificaciones;

use App\Form\TarjetasType;
use App\Form\UsuariosType;
use App\Form\TarjetasType2;


class UsuariosController extends AbstractController
{

    /**
    * @Route("/usuarios/perfil", name="miPerfil")
    */
    
    public function perfil(){
        $usuario = $this->getUser();
        /*if($this->isGranted('ROLE_ADMIN')){
            $usuario = $usuario->getIdUsuario();
        }*/
        
        $id = $usuario->getIdUsuario(); 
        $em = $this-> getDoctrine()->getManager();
        $tarjeta = $em->getRepository(Tarjetas::class)->findOneBy(['idUsuario' => $id]);
        if($this->isGranted('ROLE_ADMIN')){
        $vencimiento = strtotime( '+1 year' , strtotime( $usuario->getIdUsuario()->getFechaRegistro()->format('Y-m-d')));
        }
        else{
        $vencimiento = $usuario->getFechaRegistro()->add(date_interval_create_from_date_string('1 years'));
        }

        return $this->render('/usuarios/perfil.html.twig', ['usuario' => $usuario, 'tarjeta' => $tarjeta, 'vencimiento' => $vencimiento]);
    }
    /**
     * @Route("ver_perfil_de_{idUsuario}", name="ver_perfil_de_un_usuario")
     */
    public function verPerfilDe(int $idUsuario): Response{
        $usuario = $this->getDoctrine()->getManager()->getRepository(Usuarios::class)->findOneBy(['idUsuario' => $idUsuario]);
        $em = $this-> getDoctrine()->getManager();
        $tarjeta = $em->getRepository(Tarjetas::class)->findOneBy(['idUsuario' => $usuario->getIdUsuario()]);

        return $this->render("/usuarios/verPerfilDe.html.twig", ['usuario' => $usuario, 'tarjeta' => $tarjeta]);
    }

    /**
     * @Route("/usuarios/notificaciones", name="notificaciones")
     */
    public function notificaciones(){

        $usuario = $this->getUser();
        if($usuario != null){
            $notificaciones = $this->getDoctrine()->getManager()->getRepository(Notificaciones::class)->findBy(['idUsuario' => $usuario->getIdUsuario()]);

            return $this->render("/usuarios/notificaciones.html.twig", ['notificaciones' => $notificaciones]);
        }
        else{
            return $this->render('/login/inicie_sesion.html.twig');
        }
    }


    /**
     * @Route("/usuarios/registrarsePaso1", name="registrarse_paso1")
     */
    public function mayorDeEdad(Request $request){

        return $this->render("/usuarios/mayoriaDeEdad.html.twig");
    }

    /**
     * @Route("/usuarios/registrarsePaso2", name="registrarse_paso2")
     */
    public function registrarse(Request $request): Response{

        $tarjeta = new Tarjetas();
        $form = $this->createForm(TarjetasType::class, $tarjeta);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            //ver vencimiento  
            $tarjeta = $form->getData();
            $emailNuevo = $form->getData()->getIdUsuario()->getEmail();

                $entityManager = $this->getDoctrine()->getManager();
                $tarjeta->getIdUsuario()->setSuscripcion($this->getDoctrine()->getManager()->getRepository(Suscripciones::class)->findOneBy(['nombre' => 'standard']));
                $tarjeta->getIdUsuario()->setFechaRegistro(date_create(date('Y-m-d')));
                $entityManager->persist($tarjeta->getIDUsuario());
                
                $entityManager->persist($tarjeta);
                $entityManager->flush();
                
                $this->addFlash('success', 'Ya estás registrado en nuestra plataforma. Por favor, inicia sesión');
                return $this->redirectToRoute('inicio');
            
        }

        return $this->render('/usuarios/registrarse.html.twig', [
            'tarjeta' => $tarjeta,
            'form' => $form->createView(),
        ]);


    }

    /**
     * @var string
     */
    private $emailInvalido;

    /**
     * @Route("/usuarios/edit", name="usuario_edit",  methods={"GET","POST"})
     */
    public function editarUsuario(Request $request): Response{

        $emailInvalido = 'false';

        $usuario = $this->getUser();

        if($this->isGranted('ROLE_ADMIN')){
            $usuario = $usuario->getIdUsuario();
        }
        $emailLogeado = $usuario->getEmail();

        if($usuario != null){
            $form = $this->createForm(UsuariosType::class, $usuario);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $emailNuevo = $form->getData()->getEmail();
                if($emailNuevo != $emailLogeado){
                    if($this->getDoctrine()->getManager()->getRepository(Usuarios::class)->findBy(['email' => $emailNuevo]) == null){
                        $this->getDoctrine()->getManager()->flush();

                        return $this->redirectToRoute('miPerfil');
                    }
                    else{
                        $emailInvalido = 'true';
                        //$this->addFlash('danger', 'Email ya existente en el sistema. Modificación fallida.');
                        //return $this->redirectToRoute('miPerfil');
                    }
                }
                if($emailNuevo == $emailLogeado){
                        $this->getDoctrine()->getManager()->flush();

                        return $this->redirectToRoute('miPerfil');
                }
                
            }
            if($emailInvalido == 'true'){
                $this->addFlash('danger', 'Email ya existente en el sistema. Modificación fallida.');
                return $this->redirectToRoute('usuario_edit');
            }
            return $this->render('/usuarios/edit.html.twig', [
                'usuario' => $usuario,
                'form' => $form->createView(),
            ]); 
        }
        else{
            //
            return $this->render('/login/inicie_sesion.html.twig');
        }
    }


    /**
     * @Route("/usuarios/listado", name="usuarios_listado")
     */
    public function listado(Request $request){

        $usuarios = $this->getDoctrine()->getManager()->getRepository(Usuarios::class)->findAll();

        ksort($usuarios);

        return $this->render("/usuarios/listado.html.twig", ['usuarios' => $usuarios]);
    }

    /**
     * @Route("/usuarios/cambiarSuscripcion/{usuario_email}", name="cambiar_suscripcion", methods={"GET"})
     * 
     */

    public function cambiarSuscripcion(string $usuario_email): Response{
            $usuario = $this->getDoctrine()->getManager()->getRepository(Usuarios::class)->findOneBy(['email' => $usuario_email]);
            if ($usuario->getSuscripcion()->getNombre() == 'standard'){
                $usuario->setSuscripcion( $this->getDoctrine()->getManager()->getRepository(Suscripciones::class)->findOneBy(['nombre' => 'premium']));
            }
            else{
                $usuario->setSuscripcion( $this->getDoctrine()->getManager()->getRepository(Suscripciones::class)->findOneBy(['nombre' => 'standard']));
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this -> addFlash('succes','Has cambiado la suscripción del usuario exitosamente');
            return $this->redirectToRoute('ver_perfil_de_un_usuario', ["idUsuario" => $usuario->getIdUsuario()]);
    }

    /**
     * @Route("/usuarios/misReservas", name="mis_reservas")
     */
    public function misReservas(){
         $usuario = $this->getUser();

         if($this->isGranted('ROLE_ADMIN')){
            $usuario = $usuario->getIdUsuario();
        }

         $reservas = $this->getDoctrine()->getManager()->getRepository(SemanasReserva::class)->findBy(['idUsuario' => $usuario->getIdUsuario()]);

         return $this->render("/usuarios/misReservas.html.twig", ['reservas' => $reservas]);
    }

    /**
     * @Route("/usuarios/reservasDe/{idUsuario}", name="ver_reservas_de_un_usuario", methods={"GET"})
     */
    public function verReservasDe(Usuarios $idUsuario){

        $reservas = $this->getDoctrine()->getManager()->getRepository(SemanasReserva::class)->findBy(['idUsuario' => $idUsuario->getIdUsuario()]);

        return $this->render("/usuarios/reservasDe.html.twig", ['reservas' => $reservas, 'usuario' =>$idUsuario]);
    }

    /**
     * @Route("/usuarios/subastasDe{idUsuario}", name="ver_subastas_de_un_usuario", methods={"GET"})
     */
    public function verSubastasDe(Usuarios $idUsuario){
        
        $coleccion = Array();
        $pujas = $this-> getDoctrine()->getManager()->getRepository(Pujas::class)->findBy(['idUsuario' => $idUsuario]);
        if($pujas){
            for ($i = 0; $i < sizeOf($pujas); $i++){
                $subastaDePuja = $pujas[$i]->getIdSubasta();
                if($subastaDePuja->getFinalizada() != 1 && !( in_array($subastaDePuja, $coleccion ) ) ){
                    array_push($coleccion, $subastaDePuja );
                }
            }
        }

        return $this->render('/usuarios/subastasDe.html.twig', ['subastas' => $coleccion, 'usuario' => $idUsuario]);
        }
     
    /**
     * @Route("/usuarios/modificarTarjeta", name="modificar_tarjeta")
     */
    public function modificarTarjeta(Request $request): Response{
        $usuario = $this->getUser();
        if($usuario != null){
            $tarjeta = $this->getDoctrine()->getManager()->getRepository(Tarjetas::class)->findOneBy(['idUsuario' => $usuario->getIdUsuario()]);
        $form = $this->createForm(TarjetasType2::class, $tarjeta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('miPerfil');
        }
        
        return $this->render('/usuarios/modificarTarjeta.html.twig', 
        ['tarjeta' => $tarjeta,
            'form' => $form->createView(),
        ]);
        }
        else{
            return $this->render('/login/inicie_sesion.html.twig');
        }
    }
}