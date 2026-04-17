<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default settings
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Landing');
$routes->setDefaultMethod('index');

// Routes
$routes->get('/', 'Landing::index');
$routes->get('/admin', 'Dashboard::index');

// Security: disable auto routing
$routes->setAutoRoute(false);