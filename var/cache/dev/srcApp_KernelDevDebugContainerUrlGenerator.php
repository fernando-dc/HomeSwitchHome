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
        'inicio' => [[], ['_controller' => 'App\\Controller\\InicioController::inicio'], [], [['text', '/inicio']], [], []],
        'inicie_sesion' => [[], ['_controller' => 'App\\Controller\\InicioController::inicieSesion'], [], [['text', '/inicie_sesion']], [], []],
        'residencias_index' => [[], ['_controller' => 'App\\Controller\\ResidenciasController::index'], [], [['text', '/residencias/']], [], []],
        'residencias_new' => [[], ['_controller' => 'App\\Controller\\ResidenciasController::new'], [], [['text', '/residencias/new']], [], []],
        'residencias_show' => [['idResidencia'], ['_controller' => 'App\\Controller\\ResidenciasController::show'], [], [['variable', '/', '[^/]++', 'idResidencia', true], ['text', '/residencias']], [], []],
        'residencias_edit' => [['idResidencia'], ['_controller' => 'App\\Controller\\ResidenciasController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'idResidencia', true], ['text', '/residencias']], [], []],
        'residencias_delete' => [['idResidencia'], ['_controller' => 'App\\Controller\\ResidenciasController::delete'], [], [['variable', '/', '[^/]++', 'idResidencia', true], ['text', '/residencias']], [], []],
        'residencia_detalle' => [['id'], ['_controller' => 'App\\Controller\\ResidenciasController::detallesResidencia'], [], [['variable', '', '[^/]++', 'id', true], ['text', '/residencias/residencia']], [], []],
        'app_login' => [[], ['_controller' => 'App\\Controller\\SecurityController::login'], [], [['text', '/login']], [], []],
        'app_logout' => [[], ['_controller' => 'App\\Controller\\SecurityController::logout'], [], [['text', '/logout']], [], []],
        'subasta_nueva' => [[], ['_controller' => 'App\\Controller\\SubastasController::new'], [], [['text', '/subasta/new']], [], []],
        'subastas_de_residenciaX' => [['id'], ['_controller' => 'App\\Controller\\SubastasController::subastasResidencia'], [], [['variable', '', '[^/]++', 'id', true], ['text', '/subastas/residencia']], [], []],
        'subastas_listado' => [[], ['_controller' => 'App\\Controller\\SubastasController::subastas'], [], [['text', '/subastas/listado']], [], []],
        'subasta_detalles' => [['id'], ['_controller' => 'App\\Controller\\SubastasController::subastasDetalles'], [], [['variable', '', '[^/]++', 'id', true], ['text', '/subasta/detalles']], [], []],
        'subasta_finalizar' => [['id'], ['_controller' => 'App\\Controller\\SubastasController::finalizarSubasta'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/subasta/finalizar']], [], []],
        'subastas_participar' => [['id'], ['_controller' => 'App\\Controller\\SubastasController::participarDeSubasta'], [], [['variable', '', '[^/]++', 'id', true], ['text', '/subasta/participarDeLaSubasta']], [], []],
        'subastas_participando' => [[], ['_controller' => 'App\\Controller\\SubastasController::subastasParticipando'], [], [['text', '/subasta/participando']], [], []],
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
