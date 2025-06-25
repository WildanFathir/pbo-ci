<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth_controller::login');

$routes->group('auth', function ($routes) {
    $routes->get('login', 'auth\Auth_controller::login', ['as' => 'login']);
    $routes->get('logout', 'auth\Auth_controller::logout', ['as' => 'logout']);
    $routes->post('proses', 'auth\Auth_controller::proses', ['as' => 'prosesLogin']);
});

$routes->group('dashboard', function ($routes) {
    // main dashboard route
    $routes->get('/', 'dashboard\Dashboard_controller::index', ['as' => 'dashboard']);

    // karyawan routes
    $routes->get('karyawan', 'dashboard\Karyawan_controller::index', ['as' => 'karyawan']);
    $routes->post('karyawan/simpan', 'dashboard\Karyawan_controller::simpan', ['as' => 'simpanKaryawan']);
    $routes->post('karyawan/edit', 'dashboard\Karyawan_controller::ubah', ['as' => 'editKaryawan']);
    $routes->get('karyawan/hapus/(:any)', 'dashboard\Karyawan_controller::hapus/$1');
    $routes->get('karyawan/cetak', 'dashboard\Karyawan_controller::cetak', ['as' => 'cetakKaryawan']);
});
