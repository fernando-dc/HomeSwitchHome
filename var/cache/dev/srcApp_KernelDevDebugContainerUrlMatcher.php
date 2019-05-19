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
            '/residencias' => [[['_route' => 'residencias_index', '_controller' => 'App\\Controller\\ResidenciasController::index'], null, ['GET' => 0], null, true, false, null]],
            '/residencias/new' => [[['_route' => 'residencias_new', '_controller' => 'App\\Controller\\ResidenciasController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
            '/subasta/new' => [[['_route' => 'subasta_nueva', '_controller' => 'App\\Controller\\SubastasController::new'], null, null, null, false, false, null]],
        ];
        $this->regexpList = [
            0 => '{^(?'
                    .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                    .'|/residencias/([^/]++)(?'
                        .'|(*:66)'
                        .'|/edit(*:78)'
                        .'|(*:85)'
                    .')'
                .')/?$}sDu',
        ];
        $this->dynamicRoutes = [
            35 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
            66 => [[['_route' => 'residencias_show', '_controller' => 'App\\Controller\\ResidenciasController::show'], ['idResidencia'], ['GET' => 0], null, false, true, null]],
            78 => [[['_route' => 'residencias_edit', '_controller' => 'App\\Controller\\ResidenciasController::edit'], ['idResidencia'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
            85 => [[['_route' => 'residencias_delete', '_controller' => 'App\\Controller\\ResidenciasController::delete'], ['idResidencia'], ['DELETE' => 0], null, false, true, null]],
        ];
    }
}
