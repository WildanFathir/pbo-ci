<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth_controller::login');

$routes->group('auth', function ($routes) {
    $routes->get('login', 'Auth_controller::login');
    $routes->get('logout', 'Auth_controller::logout');
    $routes->post('proses', 'Auth_controller::proses');
});

$routes->group('dashboard', function ($routes) {
    // main dashboard route
    $routes->get('/', 'Dashboard_controller::index', ['as' => 'dashboard']);

    // karyawan routes
    $routes->get('karyawan', 'Karyawan_controller::index', ['as' => 'karyawan']);
    $routes->post('dashboard/karyawan/simpan', 'Karyawan_controller::simpan', ['as' => 'simpanKaryawan']);
    $routes->post('dashboard/karyawan/edit', 'Karyawan_controller::ubah', ['as' => 'editKaryawan']);
});
