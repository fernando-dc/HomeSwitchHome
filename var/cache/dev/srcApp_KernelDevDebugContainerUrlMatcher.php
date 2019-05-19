<?php

use Symfony\Component\Routing\Matcher\Dumper\PhpMatcherTrait;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcApp_KernelDevDebugContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    use PhpMatcherTrait;

    public function __construct(RequestContext $context)
    {
        $this->context = $context;
        $this->staticRoutes = [
            '/inicio' => [[['_route' => 'inicio', '_controller' => 'App\\Controller\\InicioController::inicio'], null, null, null, false, false, null]],
            '/residencias' => [[['_route' => 'residencias_index', '_controller' => 'App\\Controller\\ResidenciasController::index'], null, ['GET' => 0], null, true, false, null]],
            '/residencias/new' => [[['_route' => 'residencias_new', '_controller' => 'App\\Controller\\ResidenciasController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
            '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
            '/subasta/new' => [[['_route' => 'subasta_nueva', '_controller' => 'App\\Controller\\SubastasController::new'], null, null, null, false, false, null]],
            '/subastas/listado' => [[['_route' => 'subastas_listado', '_controller' => 'App\\Controller\\SubastasController::subastas'], null, null, null, false, false, null]],
        ];
        $this->regexpList = [
            0 => '{^(?'
                    .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                    .'|/residencias/(?'
                        .'|([^/]++)(?'
                            .'|(*:69)'
                            .'|/edit(*:81)'
                            .'|(*:88)'
                        .')'
                        .'|residencia([^/]++)(*:114)'
                    .')'
                    .'|/subasta(?'
                        .'|s/residencia([^/]++)(*:154)'
                        .'|/(?'
                            .'|detalles([^/]++)(*:182)'
                            .'|finalizar/([^/]++)(*:208)'
                        .')'
                    .')'
                .')/?$}sDu',
        ];
        $this->dynamicRoutes = [
            35 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
            69 => [[['_route' => 'residencias_show', '_controller' => 'App\\Controller\\ResidenciasController::show'], ['idResidencia'], ['GET' => 0], null, false, true, null]],
            81 => [[['_route' => 'residencias_edit', '_controller' => 'App\\Controller\\ResidenciasController::edit'], ['idResidencia'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
            88 => [[['_route' => 'residencias_delete', '_controller' => 'App\\Controller\\ResidenciasController::delete'], ['idResidencia'], ['DELETE' => 0], null, false, true, null]],
            114 => [[['_route' => 'residencia_detalle', '_controller' => 'App\\Controller\\ResidenciasController::detallesResidencia'], ['id'], null, null, false, true, null]],
            154 => [[['_route' => 'subastas_de_residenciaX', '_controller' => 'App\\Controller\\SubastasController::subastasResidencia'], ['id'], null, null, false, true, null]],
            182 => [[['_route' => 'subasta_detalles', '_controller' => 'App\\Controller\\SubastasController::subastasDetalles'], ['id'], null, null, false, true, null]],
            208 => [[['_route' => 'subasta_finalizar', '_controller' => 'App\\Controller\\SubastasController::finalizarSubasta'], ['id'], null, null, false, true, null]],
        ];
    }
}
