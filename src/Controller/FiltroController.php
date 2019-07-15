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
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class FiltroController extends AbstractController
{
    /**
     * @Route("/filtro", name="filtro")
     */
    public function index(Request $request)
    {
        //Se crea el formulario del filtro que tiene 3 campos: la localidad, la fecha de inicio y la fecha de fin del rango.
        $formData = ['message' => 'Buscar residencias para el lugar:'];
        $form = $this->createFormBuilder($formData)
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
                'constraints'=> [
                    new Callback([$this, 'validarRangoFechas'])
                ]

            ])
            ->add('buscar', SubmitType::class, ['label'=>'Buscar!', 'attr'=>['class'=> 'btn btn-success']])
            ->getForm();
        
        $form-> handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()){

            $formData = $form->getData();
            $em = $this->getDoctrine()->getManager();


            $residencias = $em->getRepository(Residencias::class)->residenciasEnCiudad($formData['lugar']);
            //$residencias = $em->getRepository(Residencias::class)->findBy(['eliminado' => '0', 'idDireccion.getCiudad' => $formData['lugar']]);
            $semanasDisponibles =[];
            
            foreach ($residencias as $residencia) {
                
                $fecha_inicial = clone $formData['fecha_inicial'];
                while ($fecha_inicial < $formData['fecha_final']) {

                    //$fecha_final = date('Y-m-d', strtotime($fecha_inicial.' + 6 days'));
                    $fecha_final = clone $fecha_inicial;
                    $fecha_final->add(date_interval_create_from_date_string('6 days'));
                    //Se evalua si la residencia esta ocupada en la semana dada, si no lo esta se agrega al arreglo de semanas libres para esa residencia
                    if (!$residencia->ocupadaEntreFechas($fecha_inicial,$fecha_final)) {
                        array_push($semanasDisponibles,['residencia'=> $residencia, 'fecha_inicial'=>$fecha_inicial->format('Y-m-d'), 'fecha_final'=>$fecha_final->format('Y-m-d')]);
                        
                    }
                    $fecha_inicial ->add(date_interval_create_from_date_string('7 days'));
                }
            }
            return $this->render('filtro/resultado.html.twig', ['semanas' => $semanasDisponibles, 'ubicacion' => ucwords(strtolower($formData['lugar'])) ]);
            
        }

        return $this->render('filtro/index.html.twig', [
            'controller_name' => 'FiltroController',
            'filtroForm' => $form->createView() ,
        ]);
    }

    public function validarRangoFechas($valor, ExecutionContextInterface $context){
        $form = $context->getRoot();
        $data = $form->getData();

        $twoMonths = clone $data['fecha_inicial'];
        $twoMonths->add(date_interval_create_from_date_string('2 months'));

        if ($data['fecha_final'] > $twoMonths){
            $context
                ->buildViolation('filtro.rango.fechas.mayor')
                ->addViolation();
        }

    }


}
