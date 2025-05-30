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
$routes->post('/login-action', 'Auth::loginAction');
$routes->get('/logout', 'Auth::logout');
$routes->get('/register', 'Auth::register');
$routes->post('/register-action', 'Auth::registerAction');