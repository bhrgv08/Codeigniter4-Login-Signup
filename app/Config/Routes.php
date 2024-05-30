<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'User::index');
$routes->get('/user', 'User::index');
$routes->get('/user/register', 'User::register');
$routes->post('/user/processRegister', 'User::processRegister');
$routes->post('/user/processLogin', 'User::processLogin');
$routes->get('/dashboard', 'User::dashboard');
$routes->get('/user/logout', 'User::logout');
$routes->get('/user/forgotPassword', 'User::forgotPassword');
$routes->post('/user/sendResetLink', 'User::sendResetLink');
$routes->get('/user/resetPassword/(:any)', 'User::resetPassword/$1');
$routes->post('/user/processResetPassword', 'User::processResetPassword');