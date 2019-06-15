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
            '/' => [[['_route' => 'index', '_controller' => 'App\\Controller\\InicioController::index'], null, null, null, false, false, null]],
            '/inicio' => [[['_route' => 'inicio', '_controller' => 'App\\Controller\\InicioController::inicio'], null, null, null, false, false, null]],
            '/inicie_sesion' => [[['_route' => 'inicie_sesion', '_controller' => 'App\\Controller\\InicioController::inicieSesion'], null, null, null, false, false, null]],
            '/residencias' => [[['_route' => 'residencias_index', '_controller' => 'App\\Controller\\ResidenciasController::index'], null, ['GET' => 0], null, true, false, null]],
            '/residencias/new' => [[['_route' => 'residencias_new', '_controller' => 'App\\Controller\\ResidenciasController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
            '/loginAdmin' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
            '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, ['GET' => 0], null, false, false, null]],
            '/subasta/new' => [[['_route' => 'subasta_nueva', '_controller' => 'App\\Controller\\SubastasController::new'], null, null, null, false, false, null]],
            '/subastas/listado' => [[['_route' => 'subastas_listado', '_controller' => 'App\\Controller\\SubastasController::subastas'], null, null, null, false, false, null]],
            '/subasta/participando' => [[['_route' => 'subastas_participando', '_controller' => 'App\\Controller\\SubastasController::subastasParticipando'], null, null, null, false, false, null]],
            '/suscripciones/configurar' => [[['_route' => 'configurar_precios', '_controller' => 'App\\Controller\\SuscripcionesController::configurarSuscripciones'], null, null, null, false, false, null]],
            '/usuarios/perfil' => [[['_route' => 'miPerfil', '_controller' => 'App\\Controller\\UsuariosController::perfil'], null, null, null, false, false, null]],
            '/usuarios/registrarsePaso1' => [[['_route' => 'registrarse_paso1', '_controller' => 'App\\Controller\\UsuariosController::mayorDeEdad'], null, null, null, false, false, null]],
            '/usuarios/registrarsePaso2' => [[['_route' => 'app_usuarios_registrarse', '_controller' => 'App\\Controller\\UsuariosController::registrarse'], null, null, null, false, false, null]],
            '/usuarios/listado' => [[['_route' => 'usuarios_listado', '_controller' => 'App\\Controller\\UsuariosController::listado'], null, null, null, false, false, null]],
            '/usuarios/misReservas' => [[['_route' => 'mis_reservas', '_controller' => 'App\\Controller\\UsuariosController::misReservas'], null, null, null, false, false, null]],
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
                    .'|/su(?'
                        .'|basta(?'
                            .'|s/residencia([^/]++)(*:157)'
                            .'|/(?'
                                .'|detalles([^/]++)(*:185)'
                                .'|finalizar/([^/]++)(*:211)'
                                .'|participarDeLaSubasta([^/]++)(*:248)'
                            .')'
                        .')'
                        .'|scripciones/configurar/([^/]++)(*:289)'
                    .')'
                    .'|/ver_perfil_de_([^/]++)(*:321)'
                    .'|/usuarios/(?'
                        .'|cambiarSuscripcion/([^/]++)(*:369)'
                        .'|reservasDe/([^/]++)(*:396)'
                        .'|subastasDe([^/]++)(*:422)'
                    .')'
                .')/?$}sDu',
        ];
        $this->dynamicRoutes = [
            35 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
            69 => [[['_route' => 'residencias_show', '_controller' => 'App\\Controller\\ResidenciasController::show'], ['idResidencia'], ['GET' => 0], null, false, true, null]],
            81 => [[['_route' => 'residencias_edit', '_controller' => 'App\\Controller\\ResidenciasController::edit'], ['idResidencia'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
            88 => [[['_route' => 'residencias_delete', '_controller' => 'App\\Controller\\ResidenciasController::delete'], ['idResidencia'], ['DELETE' => 0], null, false, true, null]],
            114 => [[['_route' => 'residencia_detalle', '_controller' => 'App\\Controller\\ResidenciasController::detallesResidencia'], ['id'], ['GET' => 0], null, false, true, null]],
            157 => [[['_route' => 'subastas_de_residenciaX', '_controller' => 'App\\Controller\\SubastasController::subastasResidencia'], ['id'], null, null, false, true, null]],
            185 => [[['_route' => 'subasta_detalles', '_controller' => 'App\\Controller\\SubastasController::subastasDetalles'], ['id'], null, null, false, true, null]],
            211 => [[['_route' => 'subasta_finalizar', '_controller' => 'App\\Controller\\SubastasController::finalizarSubasta'], ['id'], null, null, false, true, null]],
            248 => [[['_route' => 'subastas_participar', '_controller' => 'App\\Controller\\SubastasController::participarDeSubasta'], ['id'], null, null, false, true, null]],
            289 => [[['_route' => 'configurar_suscripcion', '_controller' => 'App\\Controller\\SuscripcionesController::configurarSuscripcion'], ['suscripcion'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
            321 => [[['_route' => 'ver_perfil_de_un_usuario', '_controller' => 'App\\Controller\\UsuariosController::verPerfilDe'], ['idUsuario'], null, null, false, true, null]],
            369 => [[['_route' => 'cambiar_suscripcion', '_controller' => 'App\\Controller\\UsuariosController::cambiarSuscripcion'], ['usuario_email'], ['GET' => 0], null, false, true, null]],
            396 => [[['_route' => 'ver_reservas_de_un_usuario', '_controller' => 'App\\Controller\\UsuariosController::verReservasDe'], ['idUsuario'], ['GET' => 0], null, false, true, null]],
            422 => [[['_route' => 'ver_subastas_de_un_usuario', '_controller' => 'App\\Controller\\UsuariosController::verSubastasDe'], ['idUsuario'], ['GET' => 0], null, false, true, null]],
        ];
    }
}
