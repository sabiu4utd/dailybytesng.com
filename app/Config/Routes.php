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
$routes->post('update_news', 'Auth::update_news');
$routes->get('edit_news/(:segment)', 'Home::edit_news/$1');
$routes->get('delete_news/(:segment)', 'Home::delete_news/$1');
$routes->post('upload_video', 'Home::upload_video');
$routes->get('view_video/(:segment)', 'Home::view_video/$1');
$routes->get('publish_vid/(:segment)', 'Home::publish_vid/$1');
$routes->get('edit_video/(:segment)', 'Home::edit_video/$1');
$routes->post('update_video', 'Home::update_video');
$routes->post('save_comment', 'Home::save_comment');
$routes->get('mystories', 'Home::mystories');
$routes->get('delete_news/(:segment)', 'Home:delete_news');
$routes->post('user', 'Home::user');
$routes->get('about', 'Home::about');
$routes->get('category/(:segment)', 'Home::category/$1');
$route->get('archive', 'Home::archive');











