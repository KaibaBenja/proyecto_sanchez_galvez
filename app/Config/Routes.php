<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/contact', 'Home::contact');
$routes->get('/about', 'Home::about');
$routes->get('/terms', 'Home::terms');
$routes->get('/commercial', 'Home::commercial');
$routes->get('/login', 'Auth::login');
$routes->post('auth/login_action', 'Auth::login_action');
$routes->post('auth/register-action', 'Auth::register_action');
$routes->get('logout', 'Auth::logout');
$routes->post('/register-action', 'Auth::registerAction');
$routes->get('/products',            'Products::index');
$routes->get('/products/create',     'Products::create');
$routes->post('/products/store',     'Products::store');
$routes->get('/products/edit/(:num)',   'Products::edit/$1');
$routes->post('/products/update/(:num)', 'Products::update/$1');
$routes->get('/products/delete/(:num)',  'Products::delete/$1');
