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

    $routes->applyMiddleware('csrf');
    $routes->connect('/', ['controller' => 'Main']);
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
    $routes->fallbacks(DashedRoute::class);

    //User
    $routes->connect('/user/sign_up',   ['controller'=>'Users','action'=>'add']);
    $routes->connect('/user/login',     ['controller'=>'Users','action'=>'login']);
    $routes->connect('/user/logout',    ['controller'=>'Users','action'=>'logout']);

    //Diagnosis
    $routes->connect('/diagnosis/read' ,    ['controller'=>'Diagnosis','actions'=>'index']);
    $routes->connect('/diagnosis/write',    ['controller'=>'Diagnosis','actions'=>'add']);
    $routes->connect('/diagnosis/edit' ,    ['controller'=>'Diagnosis','actions'=>'edit']);
    $routes->connect('/diagnosis/delete',   ['controller'=>'Diagnosis','actions'=>'delete']);
    $routes->connect('/diagnosis/department/:num' , ['controller'=>'Diagnosis','actions'=>'departmentIndex'])->setPass(['num']);
    // $routes->connect('/diagnosis/search/:num' , ['controller'=>'Diagnosis','actions'=>'search'])->setPass(['num']);

});

