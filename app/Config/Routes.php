<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter'=>'user']);
$routes->get('beranda', 'Home::index');
$routes->get('register', 'Auth::register');
$routes->get('kirim_pesan', 'Pesan::kirim');
$routes->group('auth', static function($routes){
    $routes->get('/', 'Auth::index');
    $routes->get('read', 'Auth::read');
    $routes->post('login', 'Auth::login');
    $routes->post('post', 'Auth::post');
    $routes->put('put', 'Auth::put');
    $routes->get('logout', 'Auth::logout');
});

$routes->group('mustahik', ['filter'=>'auth'], static function($routes){
    $routes->get('/', 'Admin\Mustahik::index');
    $routes->get('read', 'Admin\Mustahik::read');
    $routes->post('post', 'Admin\Mustahik::post');
    $routes->put('put', 'Admin\Mustahik::put');
    $routes->delete('delete/(:any)', 'Admin\Mustahik::delete/$1');
});

$routes->group('kelengkapan', ['filter'=>'auth'],static function($routes){
    $routes->get('/', 'Admin\Kelengkapan::index');
    $routes->get('read', 'Admin\Kelengkapan::read');
    $routes->post('post', 'Admin\Kelengkapan::post');
    $routes->put('put', 'Admin\Kelengkapan::put');
    $routes->delete('delete/(:any)', 'Admin\Kelengkapan::delete/$1');
});

$routes->group('nominal', ['filter'=>'auth'],static function($routes){
    $routes->get('/', 'Admin\Nominal::index');
    $routes->get('read', 'Admin\Nominal::read');
    $routes->post('post', 'Admin\Nominal::post');
    $routes->put('put', 'Admin\Nominal::put');
    $routes->delete('delete/(:any)', 'Admin\Nominal::delete/$1');
});

$routes->group('permohonan', ['filter'=>'auth'],static function($routes){
    $routes->get('/', 'Admin\Permohonan::index');
    $routes->get('read/(:any)', 'Admin\Permohonan::read/$1');
    $routes->post('post', 'Admin\Permohonan::post');
    $routes->put('put', 'Admin\Permohonan::put');
    $routes->delete('delete/(:any)', 'Admin\Permohonan::delete/$1');
});

$routes->group('pembayaran', ['filter'=>'auth'],static function($routes){
    $routes->get('/', 'Admin\Pembayaran::index');
    $routes->get('read/(:any)', 'Admin\Pembayaran::read/$1');
    $routes->put('put', 'Admin\Pembayaran::put');
});


// mustahik
$routes->group('pengajuan', ['filter'=>'user'],static function($routes){
    $routes->get('/', 'User\Pengajuan::index');
    $routes->get('read', 'User\Pengajuan::read');
    $routes->get('add', 'User\Pengajuan::add');
    $routes->get('kelengkapan', 'User\Pengajuan::kelengkapan');
    $routes->post('post', 'User\Pengajuan::post');
    $routes->put('put', 'User\Pengajuan::put');
    $routes->delete('delete/(:any)', 'User\Pengajuan::delete/$1');
});

$routes->group('angsuran', ['filter'=>'user'],static function($routes){
    $routes->get('/', 'User\Angsuran::index');
    $routes->get('detail/(:any)', 'User\Angsuran::detail/$1');
    $routes->get('read', 'User\Angsuran::read');
    $routes->get('jadwal/(:any)', 'User\Angsuran::jadwal/$1');
    $routes->put('put', 'User\Angsuran::put');
});

$routes->group('info_infak', ['filter'=>'user'],static function($routes){
    $routes->get('/', 'User\Infak::index');
    $routes->get('read', 'User\Infak::read');
});
