<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Residencias;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Validator\Constraints\GreaterThan;

class FiltroController extends AbstractController
{
    /**
     * @Route("/filtro", name="filtro")
     */
    public function index(Request $request)
    {
        //Se crea el formulario del filtro que tiene 3 campos: la localidad, la fecha de inicio y la fecha de fin del rango.
        $defaultData = ['message' => 'Buscar residencias para el lugar:'];
        $form = $this->createFormBuilder($defaultData)
            ->add('lugar', TextType::class)

            ->add('fecha_inicial', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker-start', 'onkeydown'=>'return false', 'autocomplete'=>'off', ],
                'html5' => false,
            ])

            ->add('fecha_final', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker-end', 'onkeydown'=>'return false', 'autocomplete'=>'off', ],
                'html5' => false,

            ])
            ->add('buscar', SubmitType::class, ['label'=>'Buscar!', 'attr'=>['class'=> 'btn btn-success']])
            ->getForm();
        
        $form-> handleRequest($request);


        if ($form->isSubmitted()){

            $formData = $form->getData();
            $em = $this->getDoctrine()->getManager();

            //Cuando el form se envia, se evalua que el rango de fechas no sea mayor a 2 meses.
            $twoMonths = clone $formData['fecha_inicial'];
            $twoMonths->add(date_interval_create_from_date_string('2 months'));

            if ($formData['fecha_final'] <= $twoMonths) {

            $residencias = $em->getRepository(Residencias::class)->residenciasEnCiudad($formData['lugar']);
            $semanasDisponibles =[];
            
            foreach ($residencias as $residencia) {
                
                $fecha_inicial = clone $formData['fecha_inicial'];
                while ($fecha_inicial < $formData['fecha_final']) {

                    //$fecha_final = date('Y-m-d', strtotime($fecha_inicial.' + 6 days'));
                    $fecha_final = clone $fecha_inicial;
                    $fecha_final->add(date_interval_create_from_date_string('6 days'));
                    if (!$residencia->ocupadaEntreFechas($fecha_inicial,$fecha_final)) {
                        array_push($semanasDisponibles,['residencia'=> $residencia, 'fecha_inicial'=>$fecha_inicial->format('Y-m-d'), 'fecha_final'=>$fecha_final->format('Y-m-d')]);
                        
                    }
                    $fecha_inicial ->add(date_interval_create_from_date_string('7 days'));
                }
            }
            return $this->render('filtro/resultado.html.twig', ['semanas' => $semanasDisponibles]);

            }
            else {
                $this->addFlash('danger','El rango de las fechas debe ser menor o igual a 2 meses!');
            }


        }
        

        return $this->render('filtro/index.html.twig', [
            'controller_name' => 'FiltroController',
            'filtroForm' => $form->createView() ,
        ]);
    }


}
