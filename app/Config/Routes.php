<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('beranda', 'Home::index');
$routes->get('register', 'Auth::register');
$routes->group('auth', static function($routes){
    $routes->get('/', 'Auth::index');
    $routes->get('read', 'Auth::read');
    $routes->post('login', 'Auth::login');
    $routes->put('put', 'Auth::put');
    $routes->get('logout', 'Auth::logout');
});

$routes->group('mustahik', static function($routes){
    $routes->get('/', 'Admin\Mustahik::index');
    $routes->get('read', 'Admin\Mustahik::read');
    $routes->post('post', 'Admin\Mustahik::post');
    $routes->put('put', 'Admin\Mustahik::put');
    $routes->delete('delete/(:any)', 'Admin\Mustahik::delete/$1');
});

$routes->group('kelengkapan', static function($routes){
    $routes->get('/', 'Admin\Kelengkapan::index');
    $routes->get('read', 'Admin\Kelengkapan::read');
    $routes->post('post', 'Admin\Kelengkapan::post');
    $routes->put('put', 'Admin\Kelengkapan::put');
    $routes->delete('delete/(:any)', 'Admin\Kelengkapan::delete/$1');
});


// mustahik
$routes->group('pengajuan', static function($routes){
    $routes->get('/', 'User\Pengajuan::index');
    $routes->get('read', 'User\Pengajuan::read');
    $routes->get('add', 'User\Pengajuan::add');
    $routes->get('kelengkapan', 'User\Pengajuan::kelengkapan');
    $routes->post('post', 'User\Pengajuan::post');
    $routes->put('put', 'User\Pengajuan::put');
    $routes->delete('delete/(:any)', 'User\Pengajuan::delete/$1');
});
