<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth Routes
$routes->get('/login', 'Auth::login');
$routes->post('/login/auth', 'Auth::attemptLogin');
$routes->get('/logout', 'Auth::logout');

// Public Routes
$routes->get('/', 'Home::index');
$routes->get('/menu', 'Menu::index');
$routes->get('/buffet', 'Buffet::index');
$routes->post('/buffet/book', 'Buffet::book');
$routes->get('/reservation', 'Reservation::index');
$routes->post('/reservation/book', 'Reservation::book');

// API Routes
$routes->group('api', function($routes) {
    $routes->get('menu', 'Api::getMenu');
    $routes->get('buffet-packages', 'Api::getBuffetPackages');
    $routes->post('reserve', 'Api::createReservation');
    $routes->post('buffet/book', 'Api::createBuffetBooking');
});

// Admin Routes (Protected)
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    // Tables
    $routes->get('tables', 'Admin\Tables::index');
    $routes->post('tables/add', 'Admin\Tables::add');
    $routes->get('tables/edit/(:num)', 'Admin\Tables::edit/$1');
    $routes->post('tables/update/(:num)', 'Admin\Tables::update/$1');
    $routes->get('tables/delete/(:num)', 'Admin\Tables::delete/$1');
    
    // Reservations
    $routes->get('reservations', 'Admin\Reservations::index');
    $routes->get('reservations/approve/(:num)', 'Admin\Reservations::approve/$1');
    $routes->get('reservations/delete/(:num)', 'Admin\Reservations::delete/$1');
    
    // Menu
    $routes->get('menu', 'Admin\MenuController::index');
    $routes->post('menu/add', 'Admin\MenuController::add');
    $routes->get('menu/edit/(:num)', 'Admin\MenuController::edit/$1');
    $routes->post('menu/update/(:num)', 'Admin\MenuController::update/$1');
    $routes->get('menu/delete/(:num)', 'Admin\MenuController::delete/$1');
    
    // Buffet
    $routes->get('buffet', 'Admin\BuffetController::index');
    $routes->post('buffet/add', 'Admin\BuffetController::add');
    $routes->get('buffet/edit/(:num)', 'Admin\BuffetController::edit/$1');
    $routes->post('buffet/update/(:num)', 'Admin\BuffetController::update/$1');
    $routes->get('buffet/delete/(:num)', 'Admin\BuffetController::delete/$1');
    
    // Staff
    $routes->get('staff', 'Admin\Staff::index');
    $routes->post('staff/add', 'Admin\Staff::add');
    $routes->get('staff/edit/(:num)', 'Admin\Staff::edit/$1');
    $routes->post('staff/update/(:num)', 'Admin\Staff::update/$1');
    $routes->get('staff/delete/(:num)', 'Admin\Staff::delete/$1');
    
    // Orders
    $routes->get('orders', 'Admin\Orders::index');
    $routes->post('orders/create', 'Admin\Orders::create');
    $routes->get('orders/delete/(:num)', 'Admin\Orders::delete/$1');
    
    // KDS
    $routes->get('kds', 'Admin\KDS::index');
    $routes->get('kds/update/(:num)/(:segment)', 'Admin\KDS::update/$1/$2');
    $routes->post('kds/update-status/(:num)', 'Admin\KDS::updateStatus/$1');
    
    // Inventory
    $routes->get('inventory', 'Admin\Inventory::index');
    $routes->post('inventory/add', 'Admin\Inventory::add');
    $routes->get('inventory/edit/(:num)', 'Admin\Inventory::edit/$1');
    $routes->post('inventory/update/(:num)', 'Admin\Inventory::update/$1');
    $routes->get('inventory/delete/(:num)', 'Admin\Inventory::delete/$1');
    
    // Reports
    $routes->get('reports', 'Admin\Reports::index');
    $routes->post('reports/export', 'Admin\Reports::export');
    
    // Notifications
    $routes->get('notifications', 'Admin\Notifications::index');
    $routes->get('notifications/recent', 'Admin\Notifications::recent');
    $routes->post('notifications/create', 'Admin\Notifications::create');
    $routes->post('notifications/mark-read/(:num)', 'Admin\Notifications::markRead/$1');
    $routes->post('notifications/mark-all-read', 'Admin\Notifications::markAllRead');
    $routes->get('notifications/delete/(:num)', 'Admin\Notifications::delete/$1');
});
