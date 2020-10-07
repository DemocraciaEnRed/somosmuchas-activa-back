<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes.
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true
    ]));

    /**
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered via `Application::routes()` with `registerMiddleware()`
     */
    $routes->applyMiddleware('csrf');

    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Users', 'action' => 'login']);
    $routes->connect('/cerrar-sesion', ['controller' => 'Users', 'action' => 'logout']);

    $routes->connect('/usuarixs', ['controller' => 'Users', 'action' => 'index']);
    $routes->connect('/alta', ['controller' => 'Users', 'action' => 'add']);

    $routes->connect('/inicio', ['controller' => 'Pages', 'action' => 'display', 'home']);

    $routes->connect('/candidatxs', ['controller' => 'Politicians', 'action' => 'index']);
    $routes->connect('/candidatx/*', ['controller' => 'Politicians', 'action' => 'view']);
    $routes->connect('/candidatx/nuevo', ['controller' => 'Politicians', 'action' => 'add']);
    $routes->connect('/candidatx/editar/*', ['controller' => 'Politicians', 'action' => 'edit']);
    $routes->connect('/candidatx/eliminar/*', ['controller' => 'Politicians', 'action' => 'delete']);

    $routes->connect('/proyectos', ['controller' => 'Projects', 'action' => 'index']);
    $routes->connect('/proyecto/*', ['controller' => 'Projects', 'action' => 'view']);
    $routes->connect('/proyecto/nuevo', ['controller' => 'Projects', 'action' => 'add']);
    $routes->connect('/proyecto/editar/*', ['controller' => 'Projects', 'action' => 'edit']);
    $routes->connect('/proyecto/eliminar/*', ['controller' => 'Projects', 'action' => 'delete']);

    $routes->connect('/bloques', ['controller' => 'Parties', 'action' => 'index']);
    $routes->connect('/bloque/*', ['controller' => 'Parties', 'action' => 'view']);
    $routes->connect('/bloque/nuevo', ['controller' => 'Parties', 'action' => 'add']);
    $routes->connect('/bloque/editar/*', ['controller' => 'Parties', 'action' => 'edit']);
    $routes->connect('/bloque/eliminar/*', ['controller' => 'Parties', 'action' => 'delete']);

    $routes->connect('/distritos', ['controller' => 'Districts', 'action' => 'index']);
    $routes->connect('/distrito/*', ['controller' => 'Districts', 'action' => 'view']);
    $routes->connect('/distrito/nuevo', ['controller' => 'Districts', 'action' => 'add']);
    $routes->connect('/distrito/editar/*', ['controller' => 'Districts', 'action' => 'edit']);
    $routes->connect('/distrito/eliminar/*', ['controller' => 'Districts', 'action' => 'delete']);

    $routes->connect('/cargos', ['controller' => 'Districts', 'action' => 'index']);
    $routes->connect('/cargo/*', ['controller' => 'Districts', 'action' => 'view']);
    $routes->connect('/cargo/nuevo', ['controller' => 'Districts', 'action' => 'add']);
    $routes->connect('/cargo/editar/*', ['controller' => 'Districts', 'action' => 'edit']);
    $routes->connect('/cargo/eliminar/*', ['controller' => 'Districts', 'action' => 'delete']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *
     * ```
     * $routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);
     * $routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);
     * ```
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/**
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * Router::scope('/api', function (RouteBuilder $routes) {
 *     // No $routes->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */
Router::scope('/api/v1', function (RouteBuilder $routes) {
    $routes->connect('/projects/tally', ['controller' => 'Projects', 'action' => 'getFullTally']);
    $routes->connect('/districts', ['controller' => 'Districts', 'action' => 'getAll']);
    $routes->connect('/politicians/*', ['controller' => 'Politicians', 'action' => 'getAll']);
    $routes->connect('/politicians/:slug/cover', ['controller' => 'Politicians', 'action' => 'getAll', true], ['pass' => ['slug']]);
    $routes->connect('/parties', ['controller' => 'Parties', 'action' => 'getAll']);
    $routes->connect('/projects', ['controller' => 'Projects', 'action' => 'getAll']);
    $routes->connect('/projects/*', ['controller' => 'Projects', 'action' => 'getByName']);
    $routes->connect('/projects/:slug/tally', ['controller' => 'Projects', 'action' => 'getTally'], ['pass' => ['slug']]);
    $routes->connect('/subscribe', ['controller' => 'Newsletter', 'action' => 'subscribe']);
});
