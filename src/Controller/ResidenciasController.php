<?php

namespace App\Controller;

use App\Entity\Residencias;
use App\Entity\Direcciones;
use App\Entity\Fotos;
use App\Form\ResidenciasType;

use App\Form\FotoType;
use App\Repository\ResidenciasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @Route("/residencias")
 */
class ResidenciasController extends AbstractController
{
    public function listadoResidencias()
    {
        $em = $this->getDoctrine()->getManager();
        $residencias = $em->getRepository(Residencias::class)->findBy(['eliminado'=>0]);
        return $this-> render('residencias/listado.html.twig', ['residencias' => $residencias]);
    }
    /**
     * @Route("/", name="residencias_index", methods={"GET"})
     */
    public function index(ResidenciasRepository $residenciasRepository): Response
    {
        if ($hasAccess = $this->isGranted('ROLE_ADMIN')){
        return $this->render('residencias/index.html.twig', [
            'residencias' => $residenciasRepository->findBy(['eliminado'=>0]),
        ]);
        }
    }

    /**
     * @Route("/new", name="residencias_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $residencia = new Residencias();
        $form = $this->createForm(ResidenciasType::class, $residencia);
        //$form = $this->createForm(FotoType::class,$foto);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            
            if($em->getRepository(Residencias::class)->findBy(['nombre'=>$residencia->getNombre()]) == null)
            {
                if($em->getRepository(Direcciones::class)->findBy(['calle' => $residencia->getCalle(),'numero' => $residencia->getNumero()])==null)
                {        
                    /** @var UploadedFile $foto */

                    $foto= $form['imageFile']->getData();
                    $destino = $this->getParameter('directorio_imagenes_residencias');
                    
                    $originalFilename = pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME);
                    $newFilename = md5(uniqid()).'.'.$foto->guessExtension();

                    try {                     
                        $foto->move(
                            $destino,
                            $newFilename
                        );
                    
                    } catch (FileException $e){
                        $this->addFlash('danger','Ocurrió un problema al cargar la foto, intente nuevamente.');
                        return $this->redirectToRoute('residencias_index');
                        
                    }


                    $foto = new Fotos();
                    $foto->setRuta($this->getParameter('relativo_imagenes_residencias').$newFilename);
                    $foto->setIdResidencia($residencia);

                    $entityManager = $this->getDoctrine()->getManager();   
                    $entityManager->persist($residencia->getIDdireccion());
                    $entityManager->persist($residencia);
                    $entityManager->persist($foto);
                    $entityManager->flush();
                    $this->addFlash('success','Se creo correctamente la residencia.');
                    return $this->redirectToRoute('residencias_index');
                }
                else
                {
                     $this->addFlash('danger','Ya existe una residencia con esa direccion.');
                }
            }
            else 
            {
                $this->addFlash('danger','Ya existe una residencia con ese nombre.');                     
            }           
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
        
        $em = $this->getDoctrine()->getManager();
        if ($this->isCsrfTokenValid('delete'.$residencia->getIdResidencia(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager(); 
            $residencia->setEliminado(1);
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
