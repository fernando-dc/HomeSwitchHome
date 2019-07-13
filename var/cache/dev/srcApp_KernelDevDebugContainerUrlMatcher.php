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
            '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
            '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
            '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
            '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
            '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
            '/contacto' => [[['_route' => 'contacto', '_controller' => 'App\\Controller\\ContenidoEstaticoController::contacto'], null, null, null, false, false, null]],
            '/preguntas_frecuentes' => [[['_route' => 'preguntas_frecuentes', '_controller' => 'App\\Controller\\ContenidoEstaticoController::preguntas_frecuentes'], null, null, null, false, false, null]],
            '/filtro' => [[['_route' => 'filtro', '_controller' => 'App\\Controller\\FiltroController::index'], null, null, null, false, false, null]],
            '/' => [[['_route' => 'index', '_controller' => 'App\\Controller\\InicioController::index'], null, null, null, false, false, null]],
            '/inicio' => [[['_route' => 'inicio', '_controller' => 'App\\Controller\\InicioController::inicio'], null, null, null, false, false, null]],
            '/inicie_sesion' => [[['_route' => 'inicie_sesion', '_controller' => 'App\\Controller\\InicioController::inicieSesion'], null, null, null, false, false, null]],
            '/residencias' => [[['_route' => 'residencias_index', '_controller' => 'App\\Controller\\ResidenciasController::index'], null, ['GET' => 0], null, true, false, null]],
            '/residencias/new' => [[['_route' => 'residencias_new', '_controller' => 'App\\Controller\\ResidenciasController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
            '/loginAdmin' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
            '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, ['GET' => 0], null, false, false, null]],
            '/semana' => [[['_route' => 'semana', '_controller' => 'App\\Controller\\SemanaController::index'], null, null, null, false, false, null]],
            '/subasta/new' => [[['_route' => 'subasta_nueva', '_controller' => 'App\\Controller\\SubastasController::new'], null, null, null, false, false, null]],
            '/subastas/listado' => [[['_route' => 'subastas_listado', '_controller' => 'App\\Controller\\SubastasController::subastas'], null, null, null, false, false, null]],
            '/subasta/participando' => [[['_route' => 'subastas_participando', '_controller' => 'App\\Controller\\SubastasController::subastasParticipando'], null, null, null, false, false, null]],
            '/suscripciones/configurar' => [[['_route' => 'configurar_precios', '_controller' => 'App\\Controller\\SuscripcionesController::configurarSuscripciones'], null, null, null, false, false, null]],
            '/usuarios/perfil' => [[['_route' => 'miPerfil', '_controller' => 'App\\Controller\\UsuariosController::perfil'], null, null, null, false, false, null]],
            '/usuarios/notificaciones' => [[['_route' => 'notificaciones', '_controller' => 'App\\Controller\\UsuariosController::notificaciones'], null, null, null, false, false, null]],
            '/usuarios/registrarsePaso1' => [[['_route' => 'registrarse_paso1', '_controller' => 'App\\Controller\\UsuariosController::mayorDeEdad'], null, null, null, false, false, null]],
            '/usuarios/registrarsePaso2' => [[['_route' => 'registrarse_paso2', '_controller' => 'App\\Controller\\UsuariosController::registrarse'], null, null, null, false, false, null]],
            '/usuarios/edit' => [[['_route' => 'usuario_edit', '_controller' => 'App\\Controller\\UsuariosController::editarUsuario'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
            '/usuarios/listado' => [[['_route' => 'usuarios_listado', '_controller' => 'App\\Controller\\UsuariosController::listado'], null, null, null, false, false, null]],
            '/usuarios/misReservas' => [[['_route' => 'mis_reservas', '_controller' => 'App\\Controller\\UsuariosController::misReservas'], null, null, null, false, false, null]],
            '/usuarios/modificarTarjeta' => [[['_route' => 'modificar_tarjeta', '_controller' => 'App\\Controller\\UsuariosController::modificarTarjeta'], null, null, null, false, false, null]],
        ];
        $this->regexpList = [
            0 => '{^(?'
                    .'|/_(?'
                        .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                        .'|wdt/([^/]++)(*:57)'
                        .'|profiler/([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:102)'
                                .'|router(*:116)'
                                .'|exception(?'
                                    .'|(*:136)'
                                    .'|\\.css(*:149)'
                                .')'
                            .')'
                            .'|(*:159)'
                        .')'
                    .')'
                    .'|/residencias/(?'
                        .'|([^/]++)(?'
                            .'|(*:196)'
                            .'|/edit(*:209)'
                            .'|(*:217)'
                        .')'
                        .'|residencia([^/]++)(*:244)'
                    .')'
                    .'|/s(?'
                        .'|emana/(?'
                            .'|([^/_]++)_([^/_]++)_([^/]++)(*:295)'
                            .'|adjudicar/([^/_]++)_([^/_]++)_([^/]++)(*:341)'
                        .')'
                        .'|u(?'
                            .'|basta(?'
                                .'|s/(?'
                                    .'|residencia([^/]++)(*:385)'
                                    .'|edit/([^/]++)(*:406)'
                                    .'|delete/([^/]++)(*:429)'
                                .')'
                                .'|/(?'
                                    .'|detalles([^/]++)(*:458)'
                                    .'|finalizar/([^/]++)(*:484)'
                                    .'|participarDeLaSubasta([^/]++)(*:521)'
                                .')'
                            .')'
                            .'|scripciones/configurar/([^/]++)(*:562)'
                        .')'
                    .')'
                    .'|/ver_perfil_de_([^/]++)(*:595)'
                    .'|/usuarios/(?'
                        .'|cambiarSuscripcion/([^/]++)(*:643)'
                        .'|reservasDe/([^/]++)(*:670)'
                        .'|subastasDe([^/]++)(*:696)'
                    .')'
                .')/?$}sDu',
        ];
        $this->dynamicRoutes = [
            38 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
            57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
            102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
            116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
            136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception::showAction'], ['token'], null, null, false, false, null]],
            149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception::cssAction'], ['token'], null, null, false, false, null]],
            159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
            196 => [[['_route' => 'residencias_show', '_controller' => 'App\\Controller\\ResidenciasController::show'], ['idResidencia'], ['GET' => 0], null, false, true, null]],
            209 => [[['_route' => 'residencias_edit', '_controller' => 'App\\Controller\\ResidenciasController::edit'], ['idResidencia'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
            217 => [[['_route' => 'residencias_delete', '_controller' => 'App\\Controller\\ResidenciasController::delete'], ['idResidencia'], ['DELETE' => 0], null, false, true, null]],
            244 => [[['_route' => 'residencia_detalle', '_controller' => 'App\\Controller\\ResidenciasController::detallesResidencia'], ['id'], ['GET' => 0], null, false, true, null]],
            295 => [[['_route' => 'semana_residencia', '_controller' => 'App\\Controller\\SemanaController::semanaDeReserva'], ['f_i', 'f_f', 'idRes'], null, null, false, true, null]],
            341 => [[['_route' => 'adjudicar_semana', '_controller' => 'App\\Controller\\SemanaController::adjudicarSemana'], ['f_i', 'f_f', 'idRes'], null, null, false, true, null]],
            385 => [[['_route' => 'subastas_de_residenciaX', '_controller' => 'App\\Controller\\SubastasController::subastasResidencia'], ['id'], null, null, false, true, null]],
            406 => [[['_route' => 'subastas_edit', '_controller' => 'App\\Controller\\SubastasController::modificarSubasta'], ['idSubasta'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
            429 => [[['_route' => 'subasta_delete', '_controller' => 'App\\Controller\\SubastasController::eliminarSubasta'], ['idSubasta'], null, null, false, true, null]],
            458 => [[['_route' => 'subasta_detalles', '_controller' => 'App\\Controller\\SubastasController::subastasDetalles'], ['id'], null, null, false, true, null]],
            484 => [[['_route' => 'subasta_finalizar', '_controller' => 'App\\Controller\\SubastasController::finalizarSubasta'], ['id'], null, null, false, true, null]],
            521 => [[['_route' => 'subastas_participar', '_controller' => 'App\\Controller\\SubastasController::participarDeSubasta'], ['id'], null, null, false, true, null]],
            562 => [[['_route' => 'configurar_suscripcion', '_controller' => 'App\\Controller\\SuscripcionesController::configurarSuscripcion'], ['suscripcion'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
            595 => [[['_route' => 'ver_perfil_de_un_usuario', '_controller' => 'App\\Controller\\UsuariosController::verPerfilDe'], ['idUsuario'], null, null, false, true, null]],
            643 => [[['_route' => 'cambiar_suscripcion', '_controller' => 'App\\Controller\\UsuariosController::cambiarSuscripcion'], ['usuario_email'], ['GET' => 0], null, false, true, null]],
            670 => [[['_route' => 'ver_reservas_de_un_usuario', '_controller' => 'App\\Controller\\UsuariosController::verReservasDe'], ['idUsuario'], ['GET' => 0], null, false, true, null]],
            696 => [[['_route' => 'ver_subastas_de_un_usuario', '_controller' => 'App\\Controller\\UsuariosController::verSubastasDe'], ['idUsuario'], ['GET' => 0], null, false, true, null]],
        ];
    }
}
