<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'AuthController::loginPage');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/dashboard', 'AdminController::index');

$routes->get('/faculty', 'AdminController::faculty');
$routes->get('/faculty/add', 'AdminController::addFacultyPage');
$routes->post('/faculty/add', 'AdminController::addFaculty');
$routes->get('/faculty/delete/(:num)', 'AdminController::deleteFaculty/$1');

$routes->get('/faculty/schedule/(:num)', 'AdminController::facultySchedule/$1');
$routes->get('/faculty/addSchedule/(:num)', 'AdminController::addSchedulePage/$1');
$routes->post('/faculty/addSchedule', 'AdminController::addSchedule');
$routes->get('/faculty/deleteSchedule/(:num)', 'AdminController::deleteSchedule/$1');

$routes->get('/location', 'AdminController::location');
$routes->get('/location/add', 'AdminController::addLocationPage');
$routes->post('/location/add', 'AdminController::addLocation');
$routes->get('/location/delete/(:num)', 'AdminController::deleteLocation/$1');
$routes->get('/location/get-qrcode/(:num)', 'AdminController::getLocationQRCode/$1');