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
$routes->get('/login', 'Auth::showLogin');
$routes->post('/login', 'Auth::login');
$routes->post('/register', 'Auth::register');
$routes->get('/logout', 'Auth::logout');
$routes->get('/productos', 'Products::showProducts');
$routes->get('/producto/(:num)', 'Products::show/$1');
$routes->group('dashboard',  function ($routes) {
    $routes->get('products', 'Products::index');
    $routes->get('products/create', 'Products::create');
    $routes->post('products/store', 'Products::store');
    $routes->get('products/edit/(:num)', 'Products::edit/$1');
    $routes->post('products/update/(:num)', 'Products::update/$1');
    $routes->get('products/delete/(:num)', 'Products::delete/$1');
});
$routes->group('cart', ['filter' => 'roleGuard:cliente'], function ($routes) {
    $routes->get('/', 'Cart::index');
    $routes->post('add', 'Cart::add');
    $routes->post('update', 'Cart::update');
    $routes->get('remove/(:num)', 'Cart::remove/$1');
    $routes->get('clear', 'Cart::clear');
});

