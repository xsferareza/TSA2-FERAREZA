<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Pages::index');
$routes->get('about', 'Pages::about');
$routes->get('customers', 'Customers::index');
$routes->get('users', 'Users::index');

use App\Controllers\TaskController;

$routes->get('/', [TaskController::class, 'index']);
$routes->get('/tasks', [TaskController::class, 'list']);
$routes->get('/profile', [TaskController::class, 'profile']);
$routes->get('/about', [TaskController::class, 'about']);

// Customer Routes
$routes->get('customers', 'Customers::index');
$routes->get('customers/new', 'Customers::new');
$routes->post('customers/create', 'Customers::create');
$routes->get('customers/edit/(:num)', 'Customers::edit/$1');
$routes->post('customers/update/(:num)', 'Customers::update/$1');

// User Routes
$routes->get('users', 'Users::index');
$routes->get('users/new', 'Users::new');
$routes->post('users/create', 'Users::create');
$routes->get('users/edit/(:num)', 'Users::edit/$1');
$routes->post('users/update/(:num)', 'Users::update/$1');

// Customer Routes
$routes->get('customers', 'Customers::index');
$routes->get('customers/new', 'Customers::new');
$routes->post('customers/create', 'Customers::create');
$routes->get('customers/edit/(:num)', 'Customers::edit/$1');
$routes->post('customers/update/(:num)', 'Customers::update/$1');

// User Routes
$routes->get('users', 'Users::index');
$routes->get('users/new', 'Users::new');
$routes->post('users/create', 'Users::create');
$routes->get('users/edit/(:num)', 'Users::edit/$1');
$routes->post('users/update/(:num)', 'Users::update/$1');

// Authentication Routes
$routes->get('login', 'Auth::login');
$routes->post('auth/attemptLogin', 'Auth::attemptLogin');
$routes->get('logout', 'Auth::logout');

// Protected Routes (Require Login)
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    // Customers
    $routes->get('customers', 'Customers::index');
    $routes->get('customers/new', 'Customers::new');
    $routes->post('customers/create', 'Customers::create');
    $routes->get('customers/edit/(:num)', 'Customers::edit/$1');
    $routes->post('customers/update/(:num)', 'Customers::update/$1');

    // Users
    $routes->get('users', 'Users::index');
    $routes->get('users/new', 'Users::new');
    $routes->post('users/create', 'Users::create');
    $routes->get('users/edit/(:num)', 'Users::edit/$1');
    $routes->post('users/update/(:num)', 'Users::update/$1');
});

// Public Routes (Accessible to everyone)
$routes->get('/', 'Home::index');
$routes->get('/tasks', 'TaskController::index');
$routes->get('/profile', 'UserController::profile');
$routes->get('/about', 'Home::about');

// Auth Routes
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');

// Protected Routes (Requires Login)
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/tasks/new', 'TaskController::new');
    $routes->post('/tasks/create', 'TaskController::create');
    $routes->get('/tasks/edit/(:num)', 'TaskController::edit/$1');
    $routes->post('/tasks/update/(:num)', 'TaskController::update/$1');
    $routes->get('/tasks/delete/(:num)', 'TaskController::delete/$1'); // Soft delete
});