<?php

use CodeIgniter\Router\RouteCollection;
// use CodeIgniter\Router\Router;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'NotesController::index', ['filter' => 'auth']);

// $routes = Services::routes();

//--------------------------------------------------------------------
// Endpoint-Endpoint Aplikasi
//--------------------------------------------------------------------

$routes->group('api', function (RouteCollection $routes) {
  // Rute untuk auth pengguna
  $routes->post('register', 'AuthController::register');
  $routes->post('login', 'AuthController::auth');
  $routes->post('logout', 'AuthController::logout');

  // Rute untuk catatan pengguna
  $routes->group('notes', function (RouteCollection $routes) {
    $routes->get('/', 'NotesController::index');
    $routes->post('/', 'NotesController::create');
    $routes->get('(:num)', 'NotesController::show/$1');
    $routes->put('(:num)', 'NotesController::update/$1');
    $routes->delete('(:num)', 'NotesController::delete/$1');
  });

  // Rute untuk mengelola pengguna
  $routes->group('users', function (RouteCollection $routes) {
    $routes->get('/', 'UsersController::index');
    $routes->get('(:num)', 'UsersController::show/$1');
    $routes->put('(:num)', 'UsersController::update/$1');
    $routes->delete('(:num)', 'UsersController::delete/$1');
  });
});

$routes->get('notes/create', 'NotesController::create');
$routes->get('notes/(:num)/edit', 'NotesController::edit/$1');

$routes->get('register', 'AuthController::register');
$routes->get('login', 'AuthController::index');
