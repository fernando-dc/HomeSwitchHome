<?php

namespace App\Controller;

use App\Entity\Hotsales;
use App\Form\HotsalesType;
use App\Repository\HotsalesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hotsales")
 */
class HotsalesController extends AbstractController
{
    /**
     * @Route("/", name="hotsales_index", methods={"GET"})
     */
    public function index(HotsalesRepository $hotsalesRepository): Response
    {
        return $this->render('hotsales/index.html.twig', [
            'hotsales' => $hotsalesRepository->findAll(),
        ]);
    }
    
    /** 
     * @Route("/adjudicar/{idHotsale}", name ="adjudicar_Hotsale")
     */
     public function adjudicar($idHotsale)
     {
        $em=$this->getDoctrine()->getManager();
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')){
           if ($this->isGranted("ROLE_ADMIN")){
              $usuario = $this->getUser()->getidUsuario();
           }
              else{
              $usuario = $this->getUser();
              }
        }
        $usuario->restarCredito();
        $hotsale = $this->getDoctrine()->getRepository(Hotsales::class)->find($idHotsale);
        $hotsale->getIdSemana()->setidUsuario($usuario);
        $em->flush();
        return $this->redirectToRoute('hotsales_index');
     }




    /**
     * @Route("/new", name="hotsales_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $hotsale = new Hotsales();
        $form = $this->createForm(HotsalesType::class, $hotsale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hotsale);
            $entityManager->flush();

            return $this->redirectToRoute('hotsales_index');
        }

        return $this->render('hotsales/new.html.twig', [
            'hotsale' => $hotsale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idHotsale}", name="hotsales_show", methods={"GET"})
     */
    public function show(Hotsales $hotsale): Response
    {
        return $this->render('hotsales/show.html.twig', [
            'hotsale' => $hotsale,
        ]);
    }

    /**
     * @Route("/{idHotsale}/edit", name="hotsales_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Hotsales $hotsale): Response
    {
        $form = $this->createForm(HotsalesType::class, $hotsale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hotsales_index', [
                'idHotsale' => $hotsale->getIdHotsale(),
            ]);
        }

        return $this->render('hotsales/edit.html.twig', [
            'hotsale' => $hotsale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idHotsale}", name="hotsales_delete", methods={"DELETE"})
     */
    public function delete($idHotsale): Response
    {
        $hotsale = $this->getDoctrine()->getRepository(Hotsales::class)->find($idHotsale);
        $semana =  $this->getDoctrine()->getRepository(SemanasReserva::class)->find($hotsale->getIdSemana);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($semana);
        $entityManager->remove($hotsale);
        $entityManager->flush();

        return $this->redirectToRoute('hotsales_index');
    }
}
