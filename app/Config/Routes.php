<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::register');
$routes->get('dashboard', 'Auth::dashboard');
$routes->get('logout', 'Auth::logout');
$routes->post('upload_passport', 'Auth::upload_passport');
$routes->get('post_news', 'Auth::post_news');


