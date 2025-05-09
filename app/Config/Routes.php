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