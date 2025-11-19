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
$routes->post('post_news', 'Auth::save_news');
$routes->get('single_news/(:segment)', 'Home::single_news/$1');
$routes->get('category_news/(:segment)', 'Home::category_news/$1');
$routes->get('publish_news', 'Home::publish_news');
$routes->get('read_news/(:segment)', 'Home::read_news/$1');
$routes->get('publish/(:segment)', 'Home::publish/$1');










