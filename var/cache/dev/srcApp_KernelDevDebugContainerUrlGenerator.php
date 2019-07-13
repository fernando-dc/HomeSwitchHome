<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcApp_KernelDevDebugContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;
    private $defaultLocale;

    public function __construct(RequestContext $context, LoggerInterface $logger = null, string $defaultLocale = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        $this->defaultLocale = $defaultLocale;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = [
        '_twig_error_test' => [['code', '_format'], ['_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], []],
        '_wdt' => [['token'], ['_controller' => 'web_profiler.controller.profiler::toolbarAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_wdt']], [], []],
        '_profiler_home' => [[], ['_controller' => 'web_profiler.controller.profiler::homeAction'], [], [['text', '/_profiler/']], [], []],
        '_profiler_search' => [[], ['_controller' => 'web_profiler.controller.profiler::searchAction'], [], [['text', '/_profiler/search']], [], []],
        '_profiler_search_bar' => [[], ['_controller' => 'web_profiler.controller.profiler::searchBarAction'], [], [['text', '/_profiler/search_bar']], [], []],
        '_profiler_phpinfo' => [[], ['_controller' => 'web_profiler.controller.profiler::phpinfoAction'], [], [['text', '/_profiler/phpinfo']], [], []],
        '_profiler_search_results' => [['token'], ['_controller' => 'web_profiler.controller.profiler::searchResultsAction'], [], [['text', '/search/results'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_open_file' => [[], ['_controller' => 'web_profiler.controller.profiler::openAction'], [], [['text', '/_profiler/open']], [], []],
        '_profiler' => [['token'], ['_controller' => 'web_profiler.controller.profiler::panelAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_router' => [['token'], ['_controller' => 'web_profiler.controller.router::panelAction'], [], [['text', '/router'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_exception' => [['token'], ['_controller' => 'web_profiler.controller.exception::showAction'], [], [['text', '/exception'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_exception_css' => [['token'], ['_controller' => 'web_profiler.controller.exception::cssAction'], [], [['text', '/exception.css'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        'contacto' => [[], ['_controller' => 'App\\Controller\\ContenidoEstaticoController::contacto'], [], [['text', '/contacto']], [], []],
        'preguntas_frecuentes' => [[], ['_controller' => 'App\\Controller\\ContenidoEstaticoController::preguntas_frecuentes'], [], [['text', '/preguntas_frecuentes']], [], []],
        'filtro' => [[], ['_controller' => 'App\\Controller\\FiltroController::index'], [], [['text', '/filtro']], [], []],
        'index' => [[], ['_controller' => 'App\\Controller\\InicioController::index'], [], [['text', '/']], [], []],
        'inicio' => [[], ['_controller' => 'App\\Controller\\InicioController::inicio'], [], [['text', '/inicio']], [], []],
        'inicie_sesion' => [[], ['_controller' => 'App\\Controller\\InicioController::inicieSesion'], [], [['text', '/inicie_sesion']], [], []],
        'residencias_index' => [[], ['_controller' => 'App\\Controller\\ResidenciasController::index'], [], [['text', '/residencias/']], [], []],
        'residencias_new' => [[], ['_controller' => 'App\\Controller\\ResidenciasController::new'], [], [['text', '/residencias/new']], [], []],
        'residencias_show' => [['idResidencia'], ['_controller' => 'App\\Controller\\ResidenciasController::show'], [], [['variable', '/', '[^/]++', 'idResidencia', true], ['text', '/residencias']], [], []],
        'residencias_edit' => [['idResidencia'], ['_controller' => 'App\\Controller\\ResidenciasController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'idResidencia', true], ['text', '/residencias']], [], []],
        'residencias_delete' => [['idResidencia'], ['_controller' => 'App\\Controller\\ResidenciasController::delete'], [], [['variable', '/', '[^/]++', 'idResidencia', true], ['text', '/residencias']], [], []],
        'residencia_detalle' => [['id'], ['_controller' => 'App\\Controller\\ResidenciasController::detallesResidencia'], [], [['variable', '', '[^/]++', 'id', true], ['text', '/residencias/residencia']], [], []],
        'app_login' => [[], ['_controller' => 'App\\Controller\\SecurityController::login'], [], [['text', '/loginAdmin']], [], []],
        'app_logout' => [[], ['_controller' => 'App\\Controller\\SecurityController::logout'], [], [['text', '/logout']], [], []],
        'semana' => [[], ['_controller' => 'App\\Controller\\SemanaController::index'], [], [['text', '/semana']], [], []],
        'semana_residencia' => [['f_i', 'f_f', 'idRes'], ['_controller' => 'App\\Controller\\SemanaController::semanaDeReserva'], [], [['variable', '_', '[^/]++', 'idRes', true], ['variable', '_', '[^/_]++', 'f_f', true], ['variable', '/', '[^/_]++', 'f_i', true], ['text', '/semana']], [], []],
        'adjudicar_semana' => [['f_i', 'f_f', 'idRes'], ['_controller' => 'App\\Controller\\SemanaController::adjudicarSemana'], [], [['variable', '_', '[^/]++', 'idRes', true], ['variable', '_', '[^/_]++', 'f_f', true], ['variable', '/', '[^/_]++', 'f_i', true], ['text', '/semana/adjudicar']], [], []],
        'subasta_nueva' => [[], ['_controller' => 'App\\Controller\\SubastasController::new'], [], [['text', '/subasta/new']], [], []],
        'subastas_de_residenciaX' => [['id'], ['_controller' => 'App\\Controller\\SubastasController::subastasResidencia'], [], [['variable', '', '[^/]++', 'id', true], ['text', '/subastas/residencia']], [], []],
        'subastas_listado' => [[], ['_controller' => 'App\\Controller\\SubastasController::subastas'], [], [['text', '/subastas/listado']], [], []],
        'subasta_detalles' => [['id'], ['_controller' => 'App\\Controller\\SubastasController::subastasDetalles'], [], [['variable', '', '[^/]++', 'id', true], ['text', '/subasta/detalles']], [], []],
        'subasta_finalizar' => [['id'], ['_controller' => 'App\\Controller\\SubastasController::finalizarSubasta'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/subasta/finalizar']], [], []],
        'subastas_participar' => [['id'], ['_controller' => 'App\\Controller\\SubastasController::participarDeSubasta'], [], [['variable', '', '[^/]++', 'id', true], ['text', '/subasta/participarDeLaSubasta']], [], []],
        'subastas_participando' => [[], ['_controller' => 'App\\Controller\\SubastasController::subastasParticipando'], [], [['text', '/subasta/participando']], [], []],
        'subastas_edit' => [['idSubasta'], ['_controller' => 'App\\Controller\\SubastasController::modificarSubasta'], [], [['variable', '/', '[^/]++', 'idSubasta', true], ['text', '/subastas/edit']], [], []],
        'subasta_delete' => [['idSubasta'], ['_controller' => 'App\\Controller\\SubastasController::eliminarSubasta'], [], [['variable', '/', '[^/]++', 'idSubasta', true], ['text', '/subastas/delete']], [], []],
        'configurar_precios' => [[], ['_controller' => 'App\\Controller\\SuscripcionesController::configurarSuscripciones'], [], [['text', '/suscripciones/configurar']], [], []],
        'configurar_suscripcion' => [['suscripcion'], ['_controller' => 'App\\Controller\\SuscripcionesController::configurarSuscripcion'], [], [['variable', '/', '[^/]++', 'suscripcion', true], ['text', '/suscripciones/configurar']], [], []],
        'miPerfil' => [[], ['_controller' => 'App\\Controller\\UsuariosController::perfil'], [], [['text', '/usuarios/perfil']], [], []],
        'ver_perfil_de_un_usuario' => [['idUsuario'], ['_controller' => 'App\\Controller\\UsuariosController::verPerfilDe'], [], [['variable', '_', '[^/]++', 'idUsuario', true], ['text', '/ver_perfil_de']], [], []],
        'notificaciones' => [[], ['_controller' => 'App\\Controller\\UsuariosController::notificaciones'], [], [['text', '/usuarios/notificaciones']], [], []],
        'registrarse_paso1' => [[], ['_controller' => 'App\\Controller\\UsuariosController::mayorDeEdad'], [], [['text', '/usuarios/registrarsePaso1']], [], []],
        'registrarse_paso2' => [[], ['_controller' => 'App\\Controller\\UsuariosController::registrarse'], [], [['text', '/usuarios/registrarsePaso2']], [], []],
        'usuario_edit' => [[], ['_controller' => 'App\\Controller\\UsuariosController::editarUsuario'], [], [['text', '/usuarios/edit']], [], []],
        'usuarios_listado' => [[], ['_controller' => 'App\\Controller\\UsuariosController::listado'], [], [['text', '/usuarios/listado']], [], []],
        'cambiar_suscripcion' => [['usuario_email'], ['_controller' => 'App\\Controller\\UsuariosController::cambiarSuscripcion'], [], [['variable', '/', '[^/]++', 'usuario_email', true], ['text', '/usuarios/cambiarSuscripcion']], [], []],
        'mis_reservas' => [[], ['_controller' => 'App\\Controller\\UsuariosController::misReservas'], [], [['text', '/usuarios/misReservas']], [], []],
        'ver_reservas_de_un_usuario' => [['idUsuario'], ['_controller' => 'App\\Controller\\UsuariosController::verReservasDe'], [], [['variable', '/', '[^/]++', 'idUsuario', true], ['text', '/usuarios/reservasDe']], [], []],
        'ver_subastas_de_un_usuario' => [['idUsuario'], ['_controller' => 'App\\Controller\\UsuariosController::verSubastasDe'], [], [['variable', '', '[^/]++', 'idUsuario', true], ['text', '/usuarios/subastasDe']], [], []],
        'modificar_tarjeta' => [[], ['_controller' => 'App\\Controller\\UsuariosController::modificarTarjeta'], [], [['text', '/usuarios/modificarTarjeta']], [], []],
    ];
        }
    }

    public function generate($name, $parameters = [], $referenceType = self::ABSOLUTE_PATH)
    {
        $locale = $parameters['_locale']
            ?? $this->context->getParameter('_locale')
            ?: $this->defaultLocale;

        if (null !== $locale && null !== $name) {
            do {
                if ((self::$declaredRoutes[$name.'.'.$locale][1]['_canonical_route'] ?? null) === $name) {
                    unset($parameters['_locale']);
                    $name .= '.'.$locale;
                    break;
                }
            } while (false !== $locale = strstr($locale, '_', true));
        }

        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
