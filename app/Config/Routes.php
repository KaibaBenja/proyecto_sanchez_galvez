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
$routes->group('dashboard',['filter' => 'roleGuard'],  function ($routes) {
    $routes->get('products', 'Products::index');
    $routes->get('products/create', 'Products::create');
    $routes->post('products/store', 'Products::store');
    $routes->get('products/edit/(:num)', 'Products::edit/$1');
    $routes->post('products/update/(:num)', 'Products::update/$1');
    $routes->post('products/delete/(:num)', 'Products::delete/$1');
});
$routes->group('cart', ['filter' => 'roleGuard:cliente'], function ($routes) {
    $routes->get('/', 'Cart::index');
    $routes->post('add', 'Cart::add');
    $routes->post('update', 'Cart::update');
    $routes->post('remove/(:num)', 'Cart::remove/$1');
    $routes->post('checkout', 'Cart::checkout');
    $routes->get('clear', 'Cart::clear');
});
$routes->get('/orders', 'Orders::index', ['filter' => 'roleGuard:cliente']);
$routes->get('/orders/all', 'Orders::all', ['filter' => 'roleGuard']);
$routes->set404Override(function(){
    return view('/errors/html/error_404.php');
});