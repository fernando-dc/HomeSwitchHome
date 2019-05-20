<?php

namespace App\Controller;

use App\Entity\Residencias;
use App\Form\ResidenciasType;
use App\Repository\ResidenciasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/residencias")
 */
class ResidenciasController extends AbstractController
{
    public function listadoResidencias()
    {
        $em = $this->getDoctrine()->getManager();
        $residencias = $em->getRepository(Residencias::class)->findAll();


        return $this-> render('residencias/listado.html.twig', ['residencias' => $residencias]);
    }
    /**
     * @Route("/", name="residencias_index", methods={"GET"})
     */
    public function index(ResidenciasRepository $residenciasRepository): Response
    {
        return $this->render('residencias/index.html.twig', [
            'residencias' => $residenciasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="residencias_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $residencia = new Residencias();
        $form = $this->createForm(ResidenciasType::class, $residencia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($residencia->getIDdireccion());
            $entityManager->persist($residencia);
            $entityManager->flush();

            return $this->redirectToRoute('residencias_index');
        }

        return $this->render('residencias/new.html.twig', [
            'residencia' => $residencia,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idResidencia}", name="residencias_show", methods={"GET"})
     */
    public function show(Residencias $residencia): Response
    {
        return $this->render('residencias/show.html.twig', [
            'residencia' => $residencia,
        ]);
    }

    /**
     * @Route("/{idResidencia}/edit", name="residencias_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Residencias $residencia): Response
    {
        $form = $this->createForm(ResidenciasType::class, $residencia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('residencias_index', [
                'idResidencia' => $residencia->getIdResidencia(),
            ]);
        }

        return $this->render('residencias/edit.html.twig', [
            'residencia' => $residencia,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idResidencia}", name="residencias_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Residencias $residencia): Response
    {
        if ($this->isCsrfTokenValid('delete'.$residencia->getIdResidencia(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($residencia);
            $entityManager->flush();
        }

        return $this->redirectToRoute('residencias_index');
    }
    /**
     * @Route("/residencia{id}", name="residencia_detalle", methods={"GET"});
     */
    public function detallesResidencia($id){

        $residencia = $this->getDoctrine()->getRepository(Residencias::class)->find($id);

        return $this-> render('residencias/detalles.html.twig', ['residencia' => $residencia]);
    }
}
