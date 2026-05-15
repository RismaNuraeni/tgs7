<?php
use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Publik
$routes->get('/',      'AuthController::login');
$routes->get('login',  'AuthController::login');
$routes->post('login', 'AuthController::loginProcess');
$routes->get('logout', 'AuthController::logout');

// Login wajib (semua role)
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('anggaran',  'AnggaranController::index');
    $routes->get('anggaran/export/(:any)', 'AnggaranController::export/$1');
    $routes->get('profil', 'ProfilController::index');

    // Super Admin only
    $routes->group('', ['filter' => 'role:super_admin'], function($routes) {
        $routes->get('pengadaan', 'PengadaanController::index');
        $routes->get('anomali',   'AnomalyController::index');
        $routes->get('opd',       'OpdController::index');

        $routes->get('users',                  'UserController::index');
        $routes->get('users/create',           'UserController::create');
        $routes->post('users/store',           'UserController::store');
        $routes->get('users/edit/(:num)',      'UserController::edit/$1');
        $routes->post('users/update/(:num)',   'UserController::update/$1');
        $routes->delete('users/delete/(:num)', 'UserController::delete/$1');
        $routes->post('users/toggle/(:num)',   'UserController::toggleActive/$1');

        $routes->get('laporan', 'LaporanController::index');
    });
});