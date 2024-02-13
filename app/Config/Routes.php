<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('mustahik', static function($routes){
    $routes->get('/', 'Admin\Mustahik::index');
    $routes->get('read', 'Admin\Mustahik::read');
    $routes->post('post', 'Admin\Mustahik::post');
    $routes->put('put', 'Admin\Mustahik::put');
    $routes->delete('delete', 'Admin\Mustahik::delete');
});
